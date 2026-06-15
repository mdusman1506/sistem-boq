<?php

namespace App\Http\Controllers;

use App\Models\LaporanHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanHarianController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'proyek_id' => 'required|exists:tb_proyek,id',
            'tanggal' => 'required|date',
            'cuaca' => 'required|in:Cerah,Berawan,Gerimis,Hujan Lebat',
            'jumlah_pekerja' => 'required|integer|min:1',
            'kegiatan' => 'required|string',
        ]);

        LaporanHarian::create([
            'proyek_id' => $request->proyek_id,
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'cuaca' => $request->cuaca,
            'jumlah_pekerja' => $request->jumlah_pekerja,
            'kegiatan' => $request->kegiatan,
        ]);

        return redirect()->back()->with('success', 'Laporan harian berhasil disimpan.');
    }
}
