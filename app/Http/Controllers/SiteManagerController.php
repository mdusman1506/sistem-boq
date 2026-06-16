<?php

namespace App\Http\Controllers;

use App\Models\BoqHeader;
use App\Models\BoqDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiteManagerController extends Controller
{
    public function verify($id)
    {
        // Pastikan hanya Site Manager yang bisa mengakses ini (bisa dicek lewat middleware atau logic)
        if (Auth::user()->role !== 'Site Manager') {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak. Anda bukan Site Manager.');
        }

        // Ambil BOQ beserta relasinya, tidak perlu fetch relasi yang menampilkan detail harga yang tidak perlu
        $boq = BoqHeader::with(['proyek.klien', 'boqDetails.barangJasa'])->findOrFail($id);

        if ($boq->proyek->site_manager_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak. Anda bukan Site Manager untuk proyek ini.');
        }

        if ($boq->status_approval !== 'Pending') {
            return redirect()->route('dashboard')->with('error', 'Dokumen ini tidak dalam status Pending/Menunggu Verifikasi.');
        }

        return view('sitemanager.verify', compact('boq'));
    }

    public function submitVerification(Request $request, $id)
    {
        if (Auth::user()->role !== 'Site Manager') {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $boq = BoqHeader::with('proyek')->findOrFail($id);

        if ($boq->proyek->site_manager_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak. Anda bukan Site Manager untuk proyek ini.');
        }
        
        if ($boq->status_approval !== 'Pending') {
            return redirect()->route('dashboard')->with('error', 'Dokumen tidak dalam status valid untuk diverifikasi.');
        }

        $action = $request->input('action'); // 'approve' or 'reject'

        if ($action === 'reject') {
            $boq->update(['status_approval' => 'Rejected']);
            
            \App\Models\ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'Menolak BOQ',
                'description' => 'Site Manager menolak dokumen BOQ ' . $boq->nomor_surat . ' dari proyek ' . $boq->proyek->nama_proyek
            ]);

            $notifyUsers = \App\Models\User::whereIn('role', ['Admin', 'Direktur'])->get();
            foreach ($notifyUsers as $nu) {
                \App\Models\Notification::create([
                    'user_id' => $nu->id,
                    'title' => 'BOQ Ditolak',
                    'message' => 'Site Manager menolak BOQ Proyek ' . $boq->proyek->nama_proyek,
                    'link' => route('proyek.show', $boq->proyek->id)
                ]);

                if ($nu->email) {
                    try {
                        \Illuminate\Support\Facades\Mail::to($nu->email)->send(
                            new \App\Mail\BoqNotificationMail(
                                'BOQ Ditolak — ' . $boq->proyek->nama_proyek,
                                'Site Manager telah menolak dokumen BOQ proyek ini. Silakan periksa dan unggah revisi baru.',
                                $boq->proyek->nama_proyek,
                                $nu->nama_lengkap,
                                route('proyek.show', $boq->proyek->id)
                            )
                        );
                    } catch (\Exception $e) {}
                }
            }

            return redirect()->route('dashboard')->with('success', 'Dokumen BOQ berhasil ditolak dan dikembalikan ke Admin.');
        }

        if ($action === 'approve') {
            // Validasi data input qty_aktual dan file_bukti_lapangan
            $request->validate([
                'qty_aktual' => 'required|array',
                'qty_aktual.*' => 'numeric|min:0',
                'file_bukti_lapangan' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120', // Maksimal 5MB
                'catatan_sitemanager' => 'nullable|string'
            ]);

            DB::beginTransaction();
            try {
                $qtyData = $request->input('qty_aktual');
                
                // Bulk update (Iterasi melalui input dan update masing-masing detail)
                foreach ($qtyData as $detail_id => $qty) {
                    BoqDetail::where('id', $detail_id)
                        ->where('boq_header_id', $boq->id)
                        ->update(['qty_aktual' => $qty]);
                }

                $filePath = null;
                if ($request->hasFile('file_bukti_lapangan')) {
                    $file = $request->file('file_bukti_lapangan');
                    $fileName = 'bukti_lapangan_' . $boq->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                    // Simpan di storage/app/public/bukti_lapangan
                    $filePath = $file->storeAs('bukti_lapangan', $fileName, 'public');
                }

                $boq->update([
                    'status_approval' => 'Approved',
                    'file_bukti_lapangan' => $filePath,
                    'catatan_sitemanager' => $request->input('catatan_sitemanager')
                ]);

                \App\Models\ActivityLog::create([
                    'user_id' => Auth::id(),
                    'action' => 'Menyetujui BOQ',
                    'description' => 'Site Manager telah memverifikasi dan menyetujui BOQ ' . $boq->nomor_surat . ' dengan data aktual lapangan.'
                ]);

                $notifyUsers = \App\Models\User::whereIn('role', ['Admin', 'Direktur'])->get();
                foreach ($notifyUsers as $nu) {
                    \App\Models\Notification::create([
                        'user_id' => $nu->id,
                        'title' => 'BOQ Disetujui',
                        'message' => 'Site Manager menyetujui BOQ Proyek ' . $boq->proyek->nama_proyek,
                        'link' => route('proyek.show', $boq->proyek->id)
                    ]);

                    if ($nu->email) {
                        try {
                            \Illuminate\Support\Facades\Mail::to($nu->email)->send(
                                new \App\Mail\BoqNotificationMail(
                                    'BOQ Disetujui ✅ — ' . $boq->proyek->nama_proyek,
                                    'Site Manager telah memverifikasi dan menyetujui dokumen BOQ beserta data volume aktual di lapangan. Silakan cek detail proyek.',
                                    $boq->proyek->nama_proyek,
                                    $nu->nama_lengkap,
                                    route('proyek.show', $boq->proyek->id)
                                )
                            );
                        } catch (\Exception $e) {}
                    }
                }

                DB::commit();
                return redirect()->route('dashboard')->with('success', 'Dokumen BOQ berhasil diverifikasi dan disetujui.');

            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Terjadi kesalahan saat menyimpan data verifikasi: ' . $e->getMessage());
            }
        }

        return back()->with('error', 'Aksi tidak valid.');
    }
}
