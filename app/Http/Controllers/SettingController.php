<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'nama_perusahaan' => Setting::getValue('nama_perusahaan', 'PT Indotama Media Teknologi'),
            'alamat_perusahaan' => Setting::getValue('alamat_perusahaan', 'Jakarta, Indonesia'),
            'telepon_perusahaan' => Setting::getValue('telepon_perusahaan', '-'),
            'email_perusahaan' => Setting::getValue('email_perusahaan', 'info@indotama.co.id'),
            'pajak_persen' => Setting::getValue('pajak_persen', '11'),
            'logo_path' => Setting::getValue('logo_path', null),
        ];

        return view('setting.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string|max:500',
            'telepon_perusahaan' => 'nullable|string|max:50',
            'email_perusahaan' => 'nullable|email|max:255',
            'pajak_persen' => 'required|numeric|min:0|max:100',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        Setting::setValue('nama_perusahaan', $request->nama_perusahaan);
        Setting::setValue('alamat_perusahaan', $request->alamat_perusahaan);
        Setting::setValue('telepon_perusahaan', $request->telepon_perusahaan);
        Setting::setValue('email_perusahaan', $request->email_perusahaan);
        Setting::setValue('pajak_persen', $request->pajak_persen);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            Setting::setValue('logo_path', $path);
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Mengubah Pengaturan Sistem',
            'description' => 'Memperbarui konfigurasi global perusahaan.'
        ]);

        return back()->with('success', 'Pengaturan sistem berhasil diperbarui.');
    }

    public function backupDatabase()
    {
        $databaseName = env('DB_DATABASE');
        $userName = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST', '127.0.0.1');
        
        $fileName = 'backup_db_sistemboq_' . date('Y-m-d_H-i-s') . '.sql';
        $filePath = storage_path('app/' . $fileName);
        
        // Asumsi server berjalan di XAMPP Windows default
        $mysqldumpPath = 'C:\xampp\mysql\bin\mysqldump.exe';
        if (file_exists($mysqldumpPath)) {
            $passParam = $password ? "--password={$password}" : "";
            $command = "\"$mysqldumpPath\" --user={$userName} {$passParam} --host={$host} {$databaseName} > \"{$filePath}\"";
            exec($command);
            
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'Backup Database',
                'description' => 'Admin membuat dan mengunduh file backup database sistem.'
            ]);
            
            return response()->download($filePath)->deleteFileAfterSend(true);
        }
        
        return back()->with('error', 'Fitur backup tidak tersedia karena file mysqldump.exe tidak ditemukan di C:\xampp\mysql\bin\.');
    }
}
