<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KlienController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('trashed')) {
            $klien = Klien::onlyTrashed()->get();
        } else {
            $klien = Klien::all();
        }
        
        return view('klien.index', compact('klien'));
    }

    public function create()
    {
        return view('klien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:150',
            'alamat' => 'nullable|string',
            'kontak_person' => 'nullable|string|max:100',
            'telepon' => 'nullable|string|max:50',
        ]);

        Klien::create($request->all());

        return redirect()->route('klien.index')->with('success', 'Data Klien berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $klien = Klien::findOrFail($id);
        return view('klien.edit', compact('klien'));
    }

    public function update(Request $request, $id)
    {
        $klien = Klien::findOrFail($id);
        
        $request->validate([
            'nama_perusahaan' => 'required|string|max:150',
            'alamat' => 'nullable|string',
            'kontak_person' => 'nullable|string|max:100',
            'telepon' => 'nullable|string|max:50',
        ]);

        $klien->update($request->all());

        return redirect()->route('klien.index')->with('success', 'Data Klien berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $klien = Klien::findOrFail($id);
        
        // Cek jika klien sedang dipakai di Proyek
        if ($klien->proyek()->count() > 0) {
            return back()->with('error', 'Gagal dihapus. Klien ini sedang terikat dengan satu atau beberapa proyek.');
        }

        $klien->delete();
        return redirect()->route('klien.index')->with('success', 'Data Klien berhasil dihapus sementara (Soft Delete).');
    }

    public function restore($id)
    {
        $klien = Klien::onlyTrashed()->findOrFail($id);
        $klien->restore();
        return back()->with('success', 'Data Klien berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $klien = Klien::onlyTrashed()->findOrFail($id);
        $klien->forceDelete();
        return back()->with('success', 'Data Klien berhasil dihapus permanen.');
    }
}
