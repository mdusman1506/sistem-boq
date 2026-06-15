<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\BoqHeader;
use App\Models\MasterBarangJasa;
use App\Models\User;
use App\Models\Klien;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Data Activity Log
        $recentActivities = ActivityLog::with('user')->latest()->take(5)->get();

        if ($user->role === 'Admin' || $user->role === 'Direktur') {
            $totalProyek = Proyek::where('status_proyek', 'Berjalan')->count();
            $boqPending = BoqHeader::where('status_approval', 'Pending')->count();
            $boqApproved = BoqHeader::where('status_approval', 'Approved')->count();
            $totalMaster = MasterBarangJasa::count();
            
            $ccoPending = \App\Models\ChangeRequest::where('status', 'Pending')->count();
            $tiketOpen = \App\Models\TiketPemeliharaan::where('status', '!=', 'Resolved')->count();
            
            // Chart 1: Proyek Status
            $proyekBerjalan = Proyek::where('status_proyek', 'Berjalan')->count();
            $proyekSelesai = Proyek::where('status_proyek', 'Selesai')->count();
            $chartStatus = [$proyekBerjalan, $proyekSelesai];

            // Chart 2: Keuangan 5 Proyek Terbaru yang Approved
            $chartKeuangan = [
                'labels' => [],
                'kontrak' => [],
                'aktual' => []
            ];

            $proyeks = Proyek::whereHas('boqHeaders', function($q) {
                $q->where('status_approval', 'Approved');
            })->with(['boqHeaders' => function($q) {
                $q->where('status_approval', 'Approved');
            }, 'boqHeaders.boqDetails'])->latest()->take(5)->get();

            foreach ($proyeks as $p) {
                $chartKeuangan['labels'][] = substr($p->nama_proyek, 0, 15) . '...';
                
                $totKontrak = 0;
                $totAktual = 0;

                foreach ($p->boqHeaders as $boq) {
                    foreach ($boq->boqDetails as $detail) {
                        $harga_satuan = $detail->harga_material_satuan + $detail->harga_jasa_satuan;
                        $totKontrak += ($harga_satuan * $detail->qty_kontrak);
                        $totAktual += ($harga_satuan * ($detail->qty_aktual ?? 0));
                    }
                }
                
                $chartKeuangan['kontrak'][] = $totKontrak;
                $chartKeuangan['aktual'][] = $totAktual;
            }
            
            return view('dashboard.index', compact(
                'user', 'totalProyek', 'boqPending', 'boqApproved', 'totalMaster', 'recentActivities', 
                'chartStatus', 'chartKeuangan', 'ccoPending', 'tiketOpen'
            ));
        } elseif ($user->role === 'Klien') {
            $klien_id = $user->klien_id;
            
            $totalProyek = Proyek::where('klien_id', $klien_id)
                ->where(function ($query) {
                    $query->where('status_proyek', 'Selesai')
                          ->orWhereHas('boqHeaders', function ($q) {
                              $q->where('status_approval', 'Approved');
                          });
                })->count();
            
            $boqDraft = BoqHeader::whereHas('proyek', function($q) use ($klien_id) {
                $q->where('klien_id', $klien_id);
            })->where('status_approval', 'Draft')->count();
            
            $boqPending = BoqHeader::whereHas('proyek', function($q) use ($klien_id) {
                $q->where('klien_id', $klien_id);
            })->where('status_approval', 'Pending')->count();

            $ccoAktif = \App\Models\ChangeRequest::whereHas('proyek', function($q) use ($klien_id) {
                $q->where('klien_id', $klien_id);
            })->where('status', 'Pending')->count();

            $tiketOpen = \App\Models\TiketPemeliharaan::whereHas('proyek', function($q) use ($klien_id) {
                $q->where('klien_id', $klien_id);
            })->where('status', '!=', 'Resolved')->count();

            $boqApproved = BoqHeader::whereHas('proyek', function($q) use ($klien_id) {
                $q->where('klien_id', $klien_id);
            })->where('status_approval', 'Approved')->count();

            $totalMaster = \App\Models\MasterBarangJasa::count();

            return view('dashboard.index', compact(
                'user', 'totalProyek', 'boqDraft', 'boqPending', 'boqApproved', 'totalMaster', 'recentActivities', 'ccoAktif', 'tiketOpen'
            ));

        } else {
            // Site Manager
            $proyekBerjalan = Proyek::where('site_manager_id', $user->id)->where('status_proyek', 'Berjalan')->count();
            
            $boqDiverifikasi = BoqHeader::whereHas('proyek', function($q) use ($user) {
                $q->where('site_manager_id', $user->id);
            })->where('status_approval', '!=', 'Pending')->count();

            $tugasVerifikasi = BoqHeader::with(['proyek.klien'])
                ->whereHas('proyek', function($q) use ($user) {
                    $q->where('site_manager_id', $user->id);
                })
                ->where('status_approval', 'Pending')
                ->latest()
                ->get();

            $tiketOpen = \App\Models\TiketPemeliharaan::whereHas('proyek', function($q) use ($user) {
                $q->where('site_manager_id', $user->id);
            })->where('status', '!=', 'Resolved')->count();

            $boqPending = BoqHeader::whereHas('proyek', function($q) use ($user) {
                $q->where('site_manager_id', $user->id);
            })->where('status_approval', 'Pending')->count();

            $smStats = [
                'pending' => $boqPending,
                'approved' => $boqDiverifikasi,
                'total' => $boqPending + $boqDiverifikasi
            ];

            return view('dashboard.index', compact('user', 'proyekBerjalan', 'smStats', 'tugasVerifikasi', 'recentActivities', 'tiketOpen', 'boqDiverifikasi'));
        }
    }
    public function exportGlobal()
    {
        if (Auth::user()->role !== 'Admin' && Auth::user()->role !== 'Direktur') {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $proyeks = Proyek::with(['klien', 'boqHeaders' => function($q) {
            $q->where('status_approval', 'Approved');
        }, 'boqHeaders.boqDetails'])->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Proyek');
        $sheet->setCellValue('C1', 'Klien');
        $sheet->setCellValue('D1', 'Status Proyek');
        $sheet->setCellValue('E1', 'Nilai Kontrak (Rp)');
        $sheet->setCellValue('F1', 'Nilai Aktual (Rp)');
        $sheet->setCellValue('G1', 'Deviasi (Rp)');

        // Header style
        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E2EFDA']],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
        ];
        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);

        $row = 2;
        foreach ($proyeks as $index => $p) {
            $totKontrak = 0;
            $totAktual = 0;

            foreach ($p->boqHeaders as $boq) {
                foreach ($boq->boqDetails as $detail) {
                    $harga = $detail->harga_material_satuan + $detail->harga_jasa_satuan;
                    $totKontrak += $harga * $detail->qty_kontrak;
                    $totAktual += $harga * ($detail->qty_aktual ?? 0);
                }
            }

            $deviasi = $totAktual - $totKontrak;

            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $p->nama_proyek);
            $sheet->setCellValue('C' . $row, $p->klien->nama_perusahaan);
            $sheet->setCellValue('D' . $row, $p->status_proyek);
            $sheet->setCellValue('E' . $row, $totKontrak);
            $sheet->setCellValue('F' . $row, $totAktual);
            $sheet->setCellValue('G' . $row, $deviasi);
            
            $sheet->getStyle('E' . $row . ':G' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $row++;
        }

        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $fileName = 'Rekap_Global_Proyek_' . date('Ymd') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        $writer->save('php://output');
        exit;
    }

    public function exportEksekutifPdf()
    {
        if (Auth::user()->role !== 'Admin' && Auth::user()->role !== 'Direktur') {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $proyeks = Proyek::with(['klien', 'boqHeaders' => function($q) {
            $q->where('status_approval', 'Approved')->latest()->take(1);
        }, 'boqHeaders.boqDetails'])->get();

        $totKontrakGlobal = 0;
        $totAktualGlobal = 0;

        foreach ($proyeks as $p) {
            $latestBoq = $p->boqHeaders->first();
            if ($latestBoq) {
                foreach ($latestBoq->boqDetails as $detail) {
                    $harga = $detail->harga_material_satuan + $detail->harga_jasa_satuan;
                    $totKontrakGlobal += $harga * $detail->qty_kontrak;
                    $totAktualGlobal += $harga * ($detail->qty_aktual ?? 0);
                }
            }
        }

        $deviasiGlobal = $totAktualGlobal - $totKontrakGlobal;

        // Generate QR Code for digital verification
        $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode(url('/'));
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
        $tanggalCetak = \Carbon\Carbon::now()->translatedFormat('d F Y H:i');

        // Using DomPDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('dashboard.pdf_eksekutif', compact('proyeks', 'totKontrakGlobal', 'totAktualGlobal', 'deviasiGlobal', 'qrBase64', 'tanggalCetak'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Laporan_Eksekutif_SIMBOQ_' . date('Ymd_His') . '.pdf');
    }
}
