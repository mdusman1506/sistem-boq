<?php

namespace App\Http\Controllers;

use App\Models\ChangeRequest;
use App\Models\BoqHeader;
use App\Models\BoqDetail;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChangeRequestController extends Controller
{
    public function index()
    {
        abort_if(!in_array(Auth::user()->role, ['Admin', 'Direktur']), 403);
        $requests = ChangeRequest::with('proyek', 'klien', 'pelapor')->latest()->get();
        return view('cco.index', compact('requests'));
    }

    public function process($id)
    {
        abort_if(Auth::user()->role !== 'Admin', 403);
        $cco = ChangeRequest::findOrFail($id);
        
        DB::beginTransaction();
        try {
            $cco->update(['status' => 'Diproses']);
            
            // Duplikasi BOQ terakhir ke versi revisi baru
            $latestBoq = BoqHeader::where('proyek_id', $cco->proyek_id)->latest()->first();
            
            if ($latestBoq) {
                $countRevisi = BoqHeader::where('proyek_id', $cco->proyek_id)->count();
                
                $newBoq = BoqHeader::create([
                    'proyek_id' => $cco->proyek_id,
                    'nomor_surat' => $latestBoq->nomor_surat,
                    'versi_revisi' => 'Rev ' . $countRevisi,
                    'status_approval' => 'Draft',
                    'is_client_approved' => false,
                ]);

                // Duplikasi detail BOQ
                foreach ($latestBoq->boqDetails as $detail) {
                    BoqDetail::create([
                        'boq_header_id' => $newBoq->id,
                        'barang_jasa_id' => $detail->barang_jasa_id,
                        'lokasi_lantai' => $detail->lokasi_lantai,
                        'lokasi_zona' => $detail->lokasi_zona,
                        'qty_kontrak' => $detail->qty_kontrak,
                        'qty_aktual' => $detail->qty_aktual,
                        'harga_material_satuan' => $detail->harga_material_satuan,
                        'harga_jasa_satuan' => $detail->harga_jasa_satuan,
                    ]);
                }
            }

            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'Admin Memproses CCO',
                'description' => 'Admin membuat Revisi BOQ baru untuk memproses CCO: ' . $cco->subjek
            ]);

            DB::commit();
            return back()->with('success', 'Request CCO sedang diproses. Draft Revisi BOQ baru telah berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses CCO: ' . $e->getMessage());
        }
    }
}
