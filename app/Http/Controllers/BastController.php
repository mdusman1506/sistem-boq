<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\BoqHeader;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class BastController extends Controller
{
    public function cetak($proyek_id)
    {
        $proyek = Proyek::with(['klien', 'boqHeaders.boqDetails.barangJasa'])->findOrFail($proyek_id);

        // Proteksi: hanya proyek Selesai yang bisa cetak BAST
        if ($proyek->status_proyek !== 'Selesai') {
            return back()->with('error', 'BAST hanya dapat dicetak untuk proyek yang sudah Selesai.');
        }

        // Proteksi klien
        if (Auth::user()->role === 'Klien' && $proyek->klien_id !== Auth::user()->klien_id) {
            abort(403, 'Unauthorized');
        }

        $approvedBoqs = $proyek->boqHeaders()->where('status_approval', 'Approved')->orderBy('created_at', 'asc')->get();

        if ($approvedBoqs->isEmpty()) {
            return back()->with('error', 'Tidak ditemukan BOQ yang sudah disetujui.');
        }

        // Hitung finansial
        $totalKontrak = 0;
        $totalAktual = 0;
        $itemsByBoq = [];
        $revisiList = [];

        foreach ($approvedBoqs as $boq) {
            $revisiList[] = $boq->versi_revisi;
            $items = [];
            foreach ($boq->boqDetails as $detail) {
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
            $itemsByBoq[$boq->versi_revisi] = $items;
        }

        $pajak = (float) Setting::getValue('pajak_persen', 11);
        $ppnKontrak = $totalKontrak * ($pajak / 100);
        $ppnAktual = $totalAktual * ($pajak / 100);
        $grandKontrak = $totalKontrak + $ppnKontrak;
        $grandAktual = $totalAktual + $ppnAktual;
        $deviasi = $grandAktual - $grandKontrak;
        
        $versiDokumen = implode(', ', $revisiList);

        $tanggalCetak = now()->translatedFormat('d F Y H:i:s');
        $hashData = md5($approvedBoqs->last()->id . $tanggalCetak);
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
            'latestBoq' => $approvedBoqs->last(),
            'itemsByBoq' => $itemsByBoq,
            'versiDokumen' => $versiDokumen,
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

        \App\Models\ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Mencetak BAST',
            'description' => 'Mencetak dokumen BAST untuk proyek ' . $proyek->nama_proyek
        ]);

        $pdf = Pdf::loadView('bast.pdf', $data);
        $pdf->setPaper('A4', 'portrait');

        $filename = 'BAST_' . str_replace(' ', '_', $proyek->nama_proyek) . '_' . date('Ymd') . '.pdf';
        return $pdf->download($filename);
    }
}
