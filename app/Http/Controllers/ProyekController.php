<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\Klien;
use App\Models\BoqHeader;
use App\Models\BoqDetail;
use App\Models\MasterBarangJasa;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Setting;

class ProyekController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'Klien') {
            // Klien HANYA bisa melihat proyek yang BOQ-nya sudah 'Approved' atau status proyeknya 'Selesai'
            $proyek = Proyek::with('klien')
                ->where('klien_id', $user->klien_id)
                ->where(function ($query) {
                    $query->where('status_proyek', 'Selesai')
                          ->orWhereHas('boqHeaders', function ($q) {
                              $q->where('status_approval', 'Approved');
                          });
                })->get();
        } elseif ($user->role === 'Site Manager') {
            $proyek = Proyek::with('klien')->where('site_manager_id', $user->id)->get();
        } else {
            $proyek = Proyek::with(['klien', 'siteManager'])->get();
        }
        return view('proyek.index', compact('proyek'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'Admin') abort(403);
        $klien = Klien::all();
        $siteManagers = \App\Models\User::where('role', 'Site Manager')->get();
        return view('proyek.create', compact('klien', 'siteManagers'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'Admin') abort(403);
        $request->validate([
            'nama_proyek' => 'required|string|max:255',
            'klien_id' => 'required|exists:tb_klien,id',
            'site_manager_id' => 'required|exists:users,id',
        ]);

        Proyek::create([
            'nama_proyek' => $request->nama_proyek,
            'klien_id' => $request->klien_id,
            'site_manager_id' => $request->site_manager_id,
            'status_proyek' => 'Berjalan',
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Membuat Proyek Baru',
            'description' => 'Proyek ' . $request->nama_proyek . ' berhasil didaftarkan.'
        ]);

        return redirect()->route('proyek.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function show($id)
    {
        $proyek = Proyek::with(['klien', 'boqHeaders.boqDetails.barangJasa', 'laporanHarian.user', 'kendalaLapangan.user'])->findOrFail($id);
        
        // Proteksi untuk klien
        if (Auth::user()->role === 'Klien' && $proyek->klien_id !== Auth::user()->klien_id) {
            abort(403, 'Unauthorized access to this project.');
        }

        // Proteksi untuk Site Manager
        if (Auth::user()->role === 'Site Manager' && $proyek->site_manager_id !== Auth::user()->id) {
            abort(403, 'Akses ditolak. Anda bukan Site Manager untuk proyek ini.');
        }

        $proyek->load(['boqHeaders' => function($q) {
            $q->latest();
        }, 'boqHeaders.boqDetails.barangJasa', 'klien', 'siteManager', 'laporanHarian', 'kendalaLapangan']);

        $changeRequests = \App\Models\ChangeRequest::where('proyek_id', $id)->latest()->get();
        $tiketPemeliharaans = \App\Models\TiketPemeliharaan::where('proyek_id', $id)->latest()->get();

        $latestBoq = $proyek->boqHeaders->first();
        
        $finansial = [
            'total_kontrak' => 0,
            'total_aktual' => 0,
            'deviasi' => 0,
            'persentase' => 0
        ];

        if ($proyek->boqHeaders->count() > 0) {
            foreach ($proyek->boqHeaders as $boq) {
                // Hanya jumlahkan yang sudah Approved
                if ($boq->status_approval === 'Approved') {
                    foreach ($boq->boqDetails as $detail) {
                        $harga_total = $detail->harga_material_satuan + $detail->harga_jasa_satuan;
                        $finansial['total_kontrak'] += ($harga_total * $detail->qty_kontrak);
                        
                        $qty_hitung = $detail->qty_aktual ?? 0;
                        $finansial['total_aktual'] += ($harga_total * $qty_hitung);
                    }
                }
            }
            
            if ($finansial['total_kontrak'] > 0) {
                $finansial['deviasi'] = $finansial['total_aktual'] - $finansial['total_kontrak'];
                $finansial['persentase'] = ($finansial['total_aktual'] / $finansial['total_kontrak']) * 100;
            }
        }

        $masterData = MasterBarangJasa::all();

        return view('proyek.show', compact('proyek', 'latestBoq', 'finansial', 'masterData', 'changeRequests', 'tiketPemeliharaans'));
    }

    public function uploadBoq(Request $request, $proyek_id)
    {
        set_time_limit(0);
        
        $request->validate([
            'file_excel' => 'required|file|mimes:xlsx,xls|max:5120',
        ]);

        $proyek = Proyek::findOrFail($proyek_id);
        $file = $request->file('file_excel');

        DB::beginTransaction();
        try {
            // Hitung revisi
            $countRevisi = BoqHeader::where('proyek_id', $proyek->id)->count();
            $revisiString = 'Rev ' . $countRevisi;

            // Buat header BOQ
            $boqHeader = BoqHeader::create([
                'proyek_id' => $proyek->id,
                'nomor_surat' => 'BOQ-' . strtoupper(uniqid()),
                'versi_revisi' => $revisiString,
                'status_approval' => 'Draft',
            ]);

            $reader = IOFactory::createReaderForFile($file->getRealPath());
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath());
            
            $importedCount = 0;
            $ignoredCount = 0;
            
            // Ambil semua master data ke memory (karena datanya biasanya tidak sampai jutaan)
            $masterData = MasterBarangJasa::all();

            // 0. BACA SEMUA SHEET! Bukan cuma sheet pertama.
            foreach ($spreadsheet->getAllSheets() as $worksheet) {
                $rows = $worksheet->toArray();

                foreach ($rows as $index => $row) {
                    $barangMatched = null;
                    $qty_kontrak = 0;

                // 1. GABUNGKAN TEKS untuk pencocokan yang lebih akurat
                $combinedText = '';
                for ($i = 2; $i <= 5; $i++) {
                    if (isset($row[$i]) && !empty(trim((string)$row[$i])) && !is_numeric(trim((string)$row[$i]))) {
                        $combinedText .= trim((string)$row[$i]) . ' ';
                    }
                }
                $combinedText = trim($combinedText);

                $normalize = function($str) {
                    $str = preg_replace('/[^a-zA-Z0-9\s]/', '', $str);
                    $str = preg_replace('/\s+/', ' ', $str);
                    return strtolower(trim($str));
                };

                $combinedNormalized = $normalize($combinedText);

                $match = $masterData->first(function($m) use ($combinedText, $combinedNormalized, $row, $normalize) {
                    $mNama = trim($m->nama_barang);
                    $mNamaNorm = $normalize($mNama);
                    $mKode = trim($m->kode_barang);

                    // 1. Exact Match (100% Cocok)
                    if ($combinedText !== '' && strcasecmp($mNama, $combinedText) === 0) return true;
                    
                    // 2. Normalized Match (Abaikan simbol -, +, spasi ganda, dll)
                    if ($combinedNormalized !== '' && $mNamaNorm === $combinedNormalized) return true;

                    // 3. AI Fuzzy Match (Typo Tolerance) untuk gabungan teks
                    if ($combinedNormalized !== '' && strlen($combinedNormalized) > 4 && strlen($mNamaNorm) > 4) {
                        similar_text($mNamaNorm, $combinedNormalized, $percent);
                        if ($percent >= 82) return true; // 82% mirip = Anggap Sama
                    }

                    // 4. Pencarian per sel (untuk kode barang atau nama di kolom terpisah)
                    foreach ($row as $cell) {
                        $cellStr = trim((string)$cell);
                        if ($cellStr === '') continue;

                        // Exact Match Kode atau Nama
                        if (strcasecmp($mKode, $cellStr) === 0 || strcasecmp($mNama, $cellStr) === 0) return true;

                        // Normalized Match
                        $cellNorm = $normalize($cellStr);
                        if ($cellNorm !== '' && $mNamaNorm === $cellNorm) return true;

                        // Fuzzy Match
                        if ($cellNorm !== '' && strlen($cellNorm) > 4 && strlen($mNamaNorm) > 4) {
                            similar_text($mNamaNorm, $cellNorm, $percent);
                            if ($percent >= 82) return true;
                        }
                    }

                    return false;
                });

                if ($match) {
                    $barangMatched = $match;
                }

                if (!$barangMatched) {
                    $ignoredCount++;
                    continue; // Jika di seluruh baris tidak ada yang cocok dengan DB Master, lewati.
                }

                // 2. CARI QTY PINTAR
                // Asumsi standar: Qty ada di $row[6] (Kolom G)
                if (isset($row[6]) && is_numeric($row[6]) && $row[6] > 0) {
                    $qty_kontrak = (float) $row[6];
                } else {
                    // Jika kolom G kosong, cari angka pertama dari belakang
                    $reversedRow = array_reverse($row);
                    foreach ($reversedRow as $val) {
                        if (is_numeric(trim($val)) && trim($val) > 0) {
                            $qty_kontrak = (float) trim($val);
                            break;
                        }
                    }
                }

                // 3. Ekstrak Lokasi/Zona secara aman (hindari salah ambil satuan 'set', 'ttk', 'bh')
                $rawLantai = isset($row[7]) ? trim((string)$row[7]) : null;
                $rawZona = isset($row[8]) ? trim((string)$row[8]) : null;

                $unitKeywords = ['set', 'ttk', 'titik', 'bh', 'buah', 'ls', 'lot', 'unit', 'm', 'm1', 'm2', 'm3', 'roll', 'btg', 'batang', 'pcs'];
                
                $isUnit = function($str) use ($unitKeywords) {
                    if (!$str) return false;
                    $lower = strtolower($str);
                    return in_array($lower, $unitKeywords);
                };

                // Jika kolom 7 atau 8 ternyata adalah satuan atau qty, kita kosongkan saja lokasinya
                $lokasi_lantai = $isUnit($rawLantai) || is_numeric($rawLantai) ? null : $rawLantai;
                $lokasi_zona = $isUnit($rawZona) || is_numeric($rawZona) ? null : $rawZona;

                // Masukkan ke rincian BOQ
                BoqDetail::create([
                    'boq_header_id' => $boqHeader->id,
                    'barang_jasa_id' => $barangMatched->id,
                    'lokasi_lantai' => $lokasi_lantai,
                    'lokasi_zona' => $lokasi_zona,
                    'qty_kontrak' => $qty_kontrak,
                    'harga_material_satuan' => $barangMatched->harga_material,
                    'harga_jasa_satuan' => $barangMatched->harga_jasa,
                ]);
                
                $importedCount++;
                }
            }

            if ($importedCount === 0) {
                DB::rollBack();
                return redirect()->route('proyek.show', $proyek->id)
                    ->with('error', "Sistem Super Scanner aktif: Telah memindai SEMUA KOLOM & NAMA BARANG, tapi tetap tidak menemukan satupun data yang cocok dengan Master Data. (Mengabaikan {$ignoredCount} baris). Pastikan file Excel Anda memuat nama/kode barang yang benar-benar ada di Master Data!");
            }

            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'Mengunggah BOQ ' . $revisiString,
                'description' => "Mengunggah dokumen BOQ. Berhasil mengekstrak {$importedCount} item."
            ]);

            DB::commit();
            return redirect()->route('proyek.show', $proyek->id)
                ->with('success', "File BOQ berhasil diunggah! Sistem secara pintar berhasil mengekstrak {$importedCount} item pekerjaan (dan mengabaikan {$ignoredCount} baris header/judul).");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('proyek.show', $proyek->id)->with('error', 'Terjadi kesalahan sistem saat memproses file: ' . $e->getMessage());
        }
    }

    public function submitToSiteManager($id)
    {
        $boqHeader = BoqHeader::findOrFail($id);
        
        if ($boqHeader->status_approval !== 'Draft') {
            return back()->with('error', 'Dokumen tidak dalam status Draft.');
        }

        $boqHeader->update([
            'status_approval' => 'Pending'
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Kirim BOQ ke Site Manager',
            'description' => 'Meneruskan BOQ ' . $boqHeader->nomor_surat . ' ke lapangan untuk diverifikasi.'
        ]);

        $boqHeader->load('proyek.siteManager');
        $assignedSm = $boqHeader->proyek->siteManager;

        if (!$assignedSm) {
            return back()->with('error', 'Proyek belum memiliki Site Manager yang ditugaskan.');
        }

        $verifyLink = route('sitemanager.verify', $boqHeader->id);

        \App\Models\Notification::create([
            'user_id' => $assignedSm->id,
            'title' => 'Verifikasi BOQ Baru',
            'message' => 'Admin meminta Anda memverifikasi BOQ Proyek ' . $boqHeader->proyek->nama_proyek,
            'link' => $verifyLink,
        ]);

        if ($assignedSm->email) {
            try {
                \Illuminate\Support\Facades\Mail::to($assignedSm->email)->send(
                    new \App\Mail\BoqNotificationMail(
                        'Tugas Verifikasi BOQ Baru — ' . $boqHeader->proyek->nama_proyek,
                        'Admin telah mengirimkan dokumen BOQ yang membutuhkan verifikasi lapangan Anda. Silakan login ke sistem dan periksa rincian item pekerjaan proyek tersebut.',
                        $boqHeader->proyek->nama_proyek,
                        $assignedSm->nama_lengkap,
                        $verifyLink
                    )
                );
            } catch (\Exception $e) {
                // Lanjutkan tanpa error jika email gagal
            }
        }

        return back()->with('success', 'Dokumen BOQ berhasil dikirim ke Site Manager untuk diverifikasi.');
    }

    public function deleteBoq($id)
    {
        $boqHeader = BoqHeader::findOrFail($id);
        
        if ($boqHeader->status_approval !== 'Draft') {
            return back()->with('error', 'Hanya BOQ berstatus Draft yang dapat dihapus.');
        }

        // Hapus detail BOQ terlebih dahulu
        $boqHeader->boqDetails()->delete();
        
        // Simpan info untuk activity log
        $versi = $boqHeader->versi_revisi;
        $namaProyek = $boqHeader->proyek->nama_proyek;
        
        // Hapus header
        $boqHeader->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Menghapus Draft BOQ',
            'description' => 'Menghapus ' . $versi . ' dari proyek ' . $namaProyek
        ]);

        return back()->with('success', 'Draft BOQ berhasil dihapus.');
    }

    public function markAsCompleted($id)
    {
        $proyek = Proyek::findOrFail($id);
        $latestBoq = $proyek->boqHeaders()->latest()->first();

        if (!$latestBoq || $latestBoq->status_approval !== 'Approved') {
            return back()->with('error', 'Proyek tidak bisa ditutup karena BOQ belum disetujui (Approved).');
        }

        if (!$latestBoq->is_client_approved) {
            return back()->with('error', 'Proyek tidak bisa ditutup sebelum Klien menyetujui BAST secara digital.');
        }

        $proyek->update(['status_proyek' => 'Selesai']);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Menutup Proyek Secara Final',
            'description' => 'Proyek ' . $proyek->nama_proyek . ' telah ditandai Selesai.'
        ]);

        return back()->with('success', 'Proyek berhasil ditandai sebagai Selesai.');
    }

    public function exportPdf($id)
    {
        $latestBoq = BoqHeader::with(['proyek.klien', 'boqDetails.barangJasa'])->findOrFail($id);
        $proyek = $latestBoq->proyek;
        
        if (Auth::user()->role === 'Klien' && $proyek->klien_id !== Auth::user()->klien_id) {
            abort(403, 'Unauthorized');
        }

        if (Auth::user()->role === 'Site Manager') {
            abort(403, 'Akses ditolak. Site Manager tidak memiliki izin untuk mengunduh dokumen RAB.');
        }

        if ($latestBoq->status_approval !== 'Approved') {
            return back()->with('error', 'Hanya BOQ berstatus Approved yang dapat dicetak.');
        }

        $totalKontrak = 0;
        $totalAktual = 0;
        $items = [];

        foreach ($latestBoq->boqDetails as $detail) {
            $hargaSatuan = $detail->harga_material_satuan + $detail->harga_jasa_satuan;
            $subtotalKontrak = $hargaSatuan * $detail->qty_kontrak;
            $subtotalAktual = $hargaSatuan * ($detail->qty_aktual ?? 0);

            $totalKontrak += $subtotalKontrak;
            $totalAktual += $subtotalAktual;

            $items[] = [
                'kode' => $detail->barangJasa->kode_barang,
                'nama' => $detail->barangJasa->nama_barang,
                'satuan' => $detail->barangJasa->satuan,
                'harga_satuan' => $hargaSatuan,
                'qty_kontrak' => $detail->qty_kontrak,
                'qty_aktual' => $detail->qty_aktual ?? 0,
                'subtotal_kontrak' => $subtotalKontrak,
                'subtotal_aktual' => $subtotalAktual,
            ];
        }

        $pajak = (float) Setting::getValue('pajak_persen', 11);
        $ppnKontrak = $totalKontrak * ($pajak / 100);
        $ppnAktual = $totalAktual * ($pajak / 100);
        $grandKontrak = $totalKontrak + $ppnKontrak;
        $grandAktual = $totalAktual + $ppnAktual;
        $deviasi = $grandAktual - $grandKontrak;

        $tanggalCetak = now()->translatedFormat('d F Y H:i:s');
        $hashData = md5($latestBoq->id . $tanggalCetak);
        $qrUrl = "https://quickchart.io/qr?text=" . urlencode($hashData) . "&size=150";
        
        $qrImageRaw = null;
        if (function_exists('curl_init')) {
            $ch = curl_init($qrUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            $qrImageRaw = curl_exec($ch);
            curl_close($ch);
        }
        if (!$qrImageRaw) {
            $qrImageRaw = @file_get_contents($qrUrl);
        }
        $qrBase64 = $qrImageRaw ? 'data:image/png;base64,' . base64_encode($qrImageRaw) : null;

        $data = [
            'proyek' => $proyek,
            'latestBoq' => $latestBoq,
            'items' => $items,
            'totalKontrak' => $totalKontrak,
            'totalAktual' => $totalAktual,
            'ppnKontrak' => $ppnKontrak,
            'ppnAktual' => $ppnAktual,
            'grandKontrak' => $grandKontrak,
            'grandAktual' => $grandAktual,
            'deviasi' => $deviasi,
            'pajak' => $pajak,
            'namaPerusahaan' => Setting::getValue('nama_perusahaan', 'PT Indotama Media Teknologi'),
            'alamatPerusahaan' => Setting::getValue('alamat_perusahaan', 'Jakarta, Indonesia'),
            'teleponPerusahaan' => Setting::getValue('telepon_perusahaan', '-'),
            'emailPerusahaan' => Setting::getValue('email_perusahaan', 'info@indotama.co.id'),
            'logoPath' => Setting::getValue('logo_path', null),
            'tanggalCetak' => $tanggalCetak,
            'qrBase64' => $qrBase64,
        ];

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Mencetak PDF',
            'description' => 'Mencetak laporan ' . $latestBoq->versi_revisi . ' untuk proyek ' . $proyek->nama_proyek
        ]);

        $pdf = Pdf::loadView('proyek.pdf_rab', $data);
        $pdf->setPaper('A4', 'landscape');

        $filename = 'Laporan_BOQ_' . str_replace(' ', '_', $proyek->nama_proyek) . '_' . str_replace(' ', '_', $latestBoq->versi_revisi) . '_' . date('Ymd_His') . '.pdf';
        return $pdf->download($filename);
    }

    public function storeBoqDetail(Request $request)
    {
        $request->validate([
            'boq_header_id' => 'required|exists:tb_boq_header,id',
            'barang_jasa_id' => 'required|exists:tb_master_barang_jasa,id',
            'qty_kontrak' => 'required|numeric|min:0',
            'lokasi_lantai' => 'nullable|string|max:100',
            'lokasi_zona' => 'nullable|string|max:100',
        ]);

        $header = BoqHeader::findOrFail($request->boq_header_id);
        
        if ($header->status_approval !== 'Draft') {
            return back()->with('error', 'Hanya BOQ dengan status Draft yang dapat ditambah item.');
        }

        $barang = MasterBarangJasa::findOrFail($request->barang_jasa_id);

        BoqDetail::create([
            'boq_header_id' => $header->id,
            'barang_jasa_id' => $barang->id,
            'harga_material_satuan' => $barang->harga_material,
            'harga_jasa_satuan' => $barang->harga_jasa,
            'qty_kontrak' => $request->qty_kontrak,
            'lokasi_lantai' => $request->lokasi_lantai,
            'lokasi_zona' => $request->lokasi_zona,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Menambah Item BOQ Manual',
            'description' => 'Menambahkan item ' . $barang->kode_barang . ' pada ' . $header->versi_revisi
        ]);

        return back()->with('success', 'Item berhasil ditambahkan ke BOQ.');
    }

    public function updateBoqDetail(Request $request, $id)
    {
        $request->validate([
            'qty_kontrak' => 'required|numeric|min:0',
            'lokasi_lantai' => 'nullable|string|max:255',
            'lokasi_zona' => 'nullable|string|max:255',
        ]);

        $detail = BoqDetail::findOrFail($id);
        $header = $detail->boqHeader;

        if ($header->status_approval !== 'Draft') {
            return back()->with('error', 'Hanya BOQ dengan status Draft yang dapat diedit.');
        }

        $detail->update([
            'qty_kontrak' => $request->qty_kontrak,
            'lokasi_lantai' => $request->lokasi_lantai,
            'lokasi_zona' => $request->lokasi_zona,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Edit Item BOQ',
            'description' => 'Mengubah qty/lokasi pada item ' . $detail->barangJasa->kode_barang . ' di proyek ' . $header->proyek->nama_proyek
        ]);

        return back()->with('success', 'Item BOQ berhasil diperbarui!');
    }

    public function approveByClient($id)
    {
        abort_if(Auth::user()->role !== 'Klien', 403);
        
        $boqHeader = BoqHeader::findOrFail($id);
        
        // Ensure Klien can only approve their own project's BOQ
        if ($boqHeader->proyek->klien_id !== Auth::user()->klien_id) {
            abort(403);
        }

        if ($boqHeader->status_approval !== 'Approved') {
            return back()->with('error', 'Hanya BOQ dengan status Approved yang dapat disetujui.');
        }

        $boqHeader->update([
            'is_client_approved' => true,
            'client_approved_at' => now(),
            'client_approved_by' => Auth::id()
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Klien Menyetujui BAST',
            'description' => 'Klien ' . Auth::user()->nama_lengkap . ' (PT ' . $boqHeader->proyek->klien->nama_perusahaan . ') telah menyetujui BAST untuk proyek ' . $boqHeader->proyek->nama_proyek
        ]);

        // Notifikasi ke Admin/Direktur
        $admins = \App\Models\User::whereIn('role', ['Admin', 'Direktur'])->get();
        foreach($admins as $admin) {
            \App\Models\Notification::create([
                'user_id' => $admin->id,
                'title' => 'BAST Disetujui Klien',
                'message' => 'PT ' . $boqHeader->proyek->klien->nama_perusahaan . ' telah menyetujui dokumen BAST untuk proyek: ' . $boqHeader->proyek->nama_proyek,
                'link' => '/proyek/' . $boqHeader->proyek_id,
                'is_read' => false
            ]);
        }

        return back()->with('success', 'Berita Acara Serah Terima (BAST) telah disetujui secara digital. Terima kasih.');
    }

    public function submitCCO(Request $request, $id)
    {
        abort_if(Auth::user()->role !== 'Klien', 403);
        
        $request->validate([
            'subjek' => 'required|string|max:255',
            'deskripsi_perubahan' => 'required|string',
            'lampiran' => 'nullable|image|mimes:jpg,jpeg,png|max:5120'
        ]);

        $proyek = Proyek::findOrFail($id);

        if ($proyek->klien_id !== Auth::user()->klien_id) {
            abort(403, 'Anda tidak memiliki akses ke proyek ini.');
        }
        
        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('cco_lampiran', 'public');
        }

        \App\Models\ChangeRequest::create([
            'proyek_id' => $proyek->id,
            'klien_id' => Auth::user()->klien_id,
            'diajukan_oleh' => Auth::id(),
            'subjek' => $request->subjek,
            'deskripsi_perubahan' => $request->deskripsi_perubahan,
            'lampiran' => $lampiranPath,
            'status' => 'Pending'
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Klien Mengajukan CCO',
            'description' => 'Klien ' . Auth::user()->nama_lengkap . ' (PT ' . $proyek->klien->nama_perusahaan . ') mengajukan Pekerjaan Tambah/Kurang untuk proyek ' . $proyek->nama_proyek
        ]);

        return back()->with('success', 'Request Pekerjaan Tambah/Kurang (CCO) berhasil diajukan. Silakan tunggu review dari Admin.');
    }

    public function submitTiket(Request $request, $id)
    {
        abort_if(Auth::user()->role !== 'Klien', 403);
        
        $request->validate([
            'subjek' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto_kerusakan' => 'nullable|image|mimes:jpg,jpeg,png|max:5120'
        ]);

        $proyek = Proyek::findOrFail($id);

        if ($proyek->klien_id !== Auth::user()->klien_id) {
            abort(403, 'Anda tidak memiliki akses ke proyek ini.');
        }

        if ($proyek->status_proyek !== 'Selesai') {
            return back()->with('error', 'Tiket pemeliharaan hanya dapat diajukan untuk proyek yang sudah Selesai.');
        }
        
        $lampiranPath = null;
        if ($request->hasFile('foto_kerusakan')) {
            $lampiranPath = $request->file('foto_kerusakan')->store('tiket_lampiran', 'public');
        }

        \App\Models\TiketPemeliharaan::create([
            'proyek_id' => $proyek->id,
            'pelapor_id' => Auth::id(),
            'subjek' => $request->subjek,
            'deskripsi' => $request->deskripsi,
            'foto_kerusakan' => $lampiranPath,
            'status' => 'Open'
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Klien Membuat Tiket Komplain',
            'description' => 'Klien ' . Auth::user()->nama_lengkap . ' (PT ' . $proyek->klien->nama_perusahaan . ') membuat tiket pemeliharaan: ' . $request->subjek
        ]);

        // Notifikasi ke Admin dan SM
        $notifUsers = \App\Models\User::whereIn('role', ['Admin', 'Direktur'])
            ->orWhere('id', $proyek->site_manager_id)->get();
            
        foreach($notifUsers as $u) {
            \App\Models\Notification::create([
                'user_id' => $u->id,
                'title' => 'Tiket Komplain Baru',
                'message' => 'PT ' . $proyek->klien->nama_perusahaan . ' mengajukan komplain: ' . $request->subjek,
                'link' => '/tiket',
                'is_read' => false
            ]);
        }

        return back()->with('success', 'Tiket pemeliharaan berhasil dikirim. Teknisi kami akan segera memproses.');
    }
}
