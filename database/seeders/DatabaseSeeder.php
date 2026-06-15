<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Klien;
use App\Models\MasterBarangJasa;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Default Settings
        Setting::setValue('nama_perusahaan', 'PT Indotama Media Teknologi');
        Setting::setValue('alamat_perusahaan', 'Jl. Raya Kalimalang No. 88, Jakarta Timur 13450');
        Setting::setValue('telepon_perusahaan', '(021) 8888-1234');
        Setting::setValue('email_perusahaan', 'info@indotama.co.id');
        Setting::setValue('pajak_persen', '11');

        // Klien
        $klien = Klien::create([
            'nama_perusahaan' => 'PT. Maju Mundur Kena',
            'alamat' => 'Jl. Kebahagiaan No. 123, Jakarta',
            'kontak_person' => 'Bpk. Budi',
        ]);

        // Users
        User::create([
            'username' => 'admin',
            'email' => 'admin@indotama.co.id',
            'password' => Hash::make('password'),
            'nama_lengkap' => 'Administrator',
            'role' => 'Admin',
        ]);

        User::create([
            'username' => 'usman',
            'email' => 'usman@indotama.co.id',
            'password' => Hash::make('password'),
            'nama_lengkap' => 'Muhammad Usman',
            'role' => 'Site Manager',
        ]);

        User::create([
            'username' => 'direktur',
            'email' => 'direktur@indotama.co.id',
            'password' => Hash::make('password'),
            'nama_lengkap' => 'Jajaran Eksekutif',
            'role' => 'Direktur',
        ]);

        User::create([
            'username' => 'klien',
            'email' => 'klien@majumundur.co.id',
            'password' => Hash::make('password'),
            'nama_lengkap' => 'PT. Maju Mundur',
            'role' => 'Klien',
            'klien_id' => $klien->id,
        ]);

        // Master Barang Jasa
        MasterBarangJasa::create([
            'kode_barang' => 'BRG-01',
            'nama_barang' => 'Kabel UTP Cat6',
            'satuan' => 'Roll',
            'harga_material' => 650000,
            'harga_jasa' => 0,
        ]);

        MasterBarangJasa::create([
            'kode_barang' => 'BRG-02',
            'nama_barang' => 'Switch Managed 24 Port',
            'satuan' => 'Unit',
            'harga_material' => 2500000,
            'harga_jasa' => 0,
        ]);

        MasterBarangJasa::create([
            'kode_barang' => 'JSA-01',
            'nama_barang' => 'Jasa Instalasi Jaringan LAN',
            'satuan' => 'Titik',
            'harga_material' => 0,
            'harga_jasa' => 150000,
        ]);

        MasterBarangJasa::create([
            'kode_barang' => 'BRG-03',
            'nama_barang' => 'Access Point WiFi 6',
            'satuan' => 'Unit',
            'harga_material' => 1850000,
            'harga_jasa' => 0,
        ]);

        MasterBarangJasa::create([
            'kode_barang' => 'JSA-02',
            'nama_barang' => 'Jasa Konfigurasi Server',
            'satuan' => 'Unit',
            'harga_material' => 0,
            'harga_jasa' => 750000,
        ]);
    }
}

