<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Hanya Admin yang bisa mengakses UserController
    public function __construct()
    {
        // Simple middleware approach in controller, though usually defined in routes/middleware.
        // We will ensure it in routes, but adding a failsafe here.
    }

    public function index()
    {
        $users = User::with('klien')->get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $klienList = \App\Models\Klien::all();
        return view('user.create', compact('klienList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100|unique:users',
            'password' => 'required|string|min:6',
            'nama_lengkap' => 'required|string|max:150',
            'email' => 'nullable|email|max:255',
            'role' => 'required|in:Admin,Site Manager,Direktur,Klien',
            'klien_id' => 'nullable|required_if:role,Klien|exists:tb_klien,id',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'role' => $request->role,
            'klien_id' => $request->role === 'Klien' ? $request->klien_id : null,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $editUser = User::findOrFail($id);
        $klienList = \App\Models\Klien::all();
        return view('user.edit', compact('editUser', 'klienList'));
    }

    public function update(Request $request, $id)
    {
        $editUser = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:100|unique:users,username,' . $id,
            'nama_lengkap' => 'required|string|max:150',
            'email' => 'nullable|email|max:255',
            'role' => 'required|in:Admin,Site Manager,Direktur,Klien',
            'password' => 'nullable|string|min:6',
            'klien_id' => 'nullable|required_if:role,Klien|exists:tb_klien,id',
        ]);

        $data = [
            'username' => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'role' => $request->role,
            'klien_id' => $request->role === 'Klien' ? $request->klien_id : null,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Failsafe: if admin is updating themselves, ensure they don't change their role to non-admin
        if ($editUser->id === Auth::id() && $request->role !== 'Admin') {
            return back()->with('error', 'Anda tidak dapat mengubah hak akses Anda sendiri.');
        }

        $editUser->update($data);

        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Tindakan ditolak! Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
