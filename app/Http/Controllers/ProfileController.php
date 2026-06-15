<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'password_lama' => 'nullable|string',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = ['nama_lengkap' => $request->nama_lengkap];

        if ($request->filled('password_lama') && $request->filled('password')) {
            if (!Hash::check($request->password_lama, $user->password)) {
                return back()->with('error', 'Kata sandi lama tidak sesuai.');
            }
            $data['password'] = Hash::make($request->password);
        } elseif ($request->filled('password') && !$request->filled('password_lama')) {
            return back()->with('error', 'Silakan masukkan kata sandi lama untuk mengubah kata sandi baru.');
        }

        // Must cast to User model for IDE friendliness, though Auth::user() is valid.
        User::find($user->id)->update($data);

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
