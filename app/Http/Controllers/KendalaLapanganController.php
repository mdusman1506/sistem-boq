<?php

namespace App\Http\Controllers;

use App\Models\KendalaLapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KendalaLapanganController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'proyek_id' => 'required|exists:tb_proyek,id',
            'judul_kendala' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto_kendala' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto_kendala')) {
            $fotoPath = $request->file('foto_kendala')->store('kendala_lapangan', 'public');
        }

        KendalaLapangan::create([
            'proyek_id' => $request->proyek_id,
            'user_id' => Auth::id(),
            'judul_kendala' => $request->judul_kendala,
            'deskripsi' => $request->deskripsi,
            'foto_kendala' => $fotoPath,
            'status' => 'Open',
        ]);

        return redirect()->back()->with('success', 'Kendala berhasil dilaporkan.');
    }

    public function resolve($id)
    {
        $kendala = KendalaLapangan::findOrFail($id);
        $kendala->update(['status' => 'Resolved']);

        return redirect()->back()->with('success', 'Status kendala berhasil diubah menjadi Resolved.');
    }
}
