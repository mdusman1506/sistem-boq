<?php

namespace App\Http\Controllers;

use App\Models\TiketPemeliharaan;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TiketPemeliharaanController extends Controller
{
    public function index()
    {
        $query = TiketPemeliharaan::with('proyek.klien', 'pelapor')->latest();
        
        // Jika Site Manager, hanya lihat tiket dari proyeknya
        if (Auth::user()->role === 'Site Manager') {
            $query->whereHas('proyek', function($q) {
                $q->where('site_manager_id', Auth::id());
            });
        }
        
        $tikets = $query->get();
        return view('tiket.index', compact('tikets'));
    }

    public function progress(Request $request, $id)
    {
        $tiket = TiketPemeliharaan::findOrFail($id);
        
        // Validasi akses SM
        if (Auth::user()->role === 'Site Manager' && $tiket->proyek->site_manager_id !== Auth::id()) {
            abort(403);
        }

        $tiket->update(['status' => 'On Progress']);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Tiket Diproses',
            'description' => 'Site Manager memproses tiket komplain: ' . $tiket->subjek
        ]);

        return back()->with('success', 'Status tiket diubah menjadi On Progress. Tim sedang menuju lokasi/mengerjakan.');
    }

    public function resolve(Request $request, $id)
    {
        $request->validate([
            'foto_perbaikan' => 'required|image|mimes:jpg,jpeg,png|max:5120'
        ], [
            'foto_perbaikan.required' => 'Wajib melampirkan foto bukti perbaikan!',
            'foto_perbaikan.image' => 'File harus berupa gambar (JPG, JPEG, PNG).',
            'foto_perbaikan.max' => 'Ukuran gambar maksimal 5 MB.',
        ]);

        $tiket = TiketPemeliharaan::findOrFail($id);
        
        if (Auth::user()->role === 'Site Manager' && $tiket->proyek->site_manager_id !== Auth::id()) {
            abort(403);
        }

        $fotoPath = $request->file('foto_perbaikan')->store('tiket_bukti', 'public');

        $tiket->update([
            'status' => 'Resolved',
            'foto_perbaikan' => $fotoPath,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Tiket Selesai',
            'description' => 'Site Manager menyelesaikan perbaikan komplain: ' . $tiket->subjek
        ]);

        return back()->with('success', 'Tiket telah diselesaikan dengan bukti perbaikan.');
    }
}
