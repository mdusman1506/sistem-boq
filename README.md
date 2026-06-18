# SIM BOQ Enterprise
## Sistem Informasi Administrasi Proyek Infrastruktur IT (RAB, BOQ, CCO, BAST, dan Pemeliharaan) Berbasis Web

**Versi:** 1.0 (Enterprise Edition)  
**Framework:** Laravel 11  
**Oleh:** Muhammad Usman — 411231141  
**Universitas:** Universitas Dian Nusantara — Prodi Teknik Informatika  

---

## 🔑 Akun Login Bawaan (Seeder)

| Role         | Username   | Password   | Keterangan                |
|:-------------|:-----------|:-----------|:--------------------------|
| Admin        | `admin`    | `password` | Kendali penuh semua fitur |
| Site Manager | `usman`    | `password` | Verifikasi lapangan & Tiket |
| Direktur     | `direktur` | `password` | Monitoring eksekutif      |
| Klien        | `klien`    | `password` | Customer portal & Tiket   |

---

## 🚀 Cara Menjalankan Sistem (Langkah demi Langkah)

Proyek ini dapat dijalankan dengan dua cara: **Cara Manual (menggunakan XAMPP)** atau **Cara Otomatis (menggunakan Docker)**.

### Opsi A: Cara Menjalankan via Docker (Sangat Mudah & Disarankan)

Jika Anda sudah menginstal **Docker Desktop**, Anda dapat menjalankan sistem ini tanpa perlu mengkonfigurasi web server, PHP, atau database secara manual.

1. Buka Terminal atau Command Prompt, *clone* repositori ini:
   ```bash
   git clone https://github.com/mdusman1506/sistem-boq.git
   cd sistem-boq
   ```
2. Salin file `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
   *(Untuk pengguna Windows CMD: `copy .env.example .env`)*
3. Jalankan Docker Compose:
   ```bash
   docker-compose up -d --build
   ```
4. Install dependensi dan jalankan migrasi database di dalam *container*:
   ```bash
   docker-compose exec app composer install
   docker-compose exec app php artisan key:generate
   docker-compose exec app php artisan migrate:fresh --seed
   ```
5. Buka browser: **http://localhost:8000** 🎉

---

### Opsi B: Cara Menjalankan Manual via XAMPP

Jika Anda belum memiliki Docker, pastikan software berikut sudah terinstal:
- **XAMPP** (dengan PHP versi 8.2 ke atas)
- **Composer** (https://getcomposer.org/)
- **Git** (https://git-scm.com/)

#### Langkah 1: Clone Repositori (Unduh Kode)
1. Buka **Terminal** atau **Git Bash** di folder `C:\xampp\htdocs\`
2. Jalankan perintah:
   ```bash
   git clone https://github.com/mdusman1506/sistem-boq.git
   cd sistem-boq
   ```

#### Langkah 2: Nyalakan Database
1. Buka **XAMPP Control Panel**.
2. Klik **Start** pada modul **Apache** dan **MySQL**.
3. Buka browser, akses: `http://localhost/phpmyadmin`
4. Buat database baru dengan nama: `db_sistem_boq` lalu **Create**.

#### Langkah 3: Install Dependensi Laravel
Di dalam terminal yang berada di folder `sistem-boq`, jalankan:
```bash
composer install
```
*(Proses ini membutuhkan koneksi internet dan memastikan semua pustaka yang diperlukan Laravel terunduh, jika gagal pastikan ekstensi PHP ZIP dan cURL aktif)*

#### Langkah 4: Setup Environment & Database
1. Salin `.env.example` ke `.env`:
   ```bash
   copy .env.example .env
   ```
2. Hasilkan *application key*:
   ```bash
   php artisan key:generate
   ```
3. Sesuaikan koneksi database di file `.env` jika diperlukan (Secara default `DB_DATABASE=db_sistem_boq`).
4. Jalankan perintah migrasi dan pengisian data otomatis:
   ```bash
   php artisan migrate:fresh --seed
   ```
   > **⚠️ PERINGATAN:** Perintah ini akan MENGHAPUS semua data lama di dalam `db_sistem_boq` dan mereset sistem dengan data awal (*Seeder*).

#### Langkah 5: Jalankan Server Laravel
Masih di terminal yang sama, ketik:
```bash
php artisan serve
```
Buka di Browser: **http://127.0.0.1:8000** 🎉

---

## 📂 Fitur Utama per Role 

### 👤 Admin (Super User)
- **Dashboard Analitik:** Grafik proyek, metrik keuangan, & daftar CCO/Tiket aktif.
- **Manajemen CCO (Change Request):** Proses permintaan CCO (Contract Change Order) dari Klien menjadi Draft BOQ Revisi secara otomatis.
- **Audit Log Terpusat:** Pantau seluruh pergerakan *user* (siapa, kapan, aksi apa).
- **Pengaturan Aplikasi (Branding):** Ubah Nama Aplikasi, Nama PT, dan Logo Perusahaan langsung dari sistem.
- **Siklus BOQ & BAST:** Upload Excel, kirim ke Site Manager, cetak BAST, tandai proyek selesai.
- **Kelola Master Data & User:** Termasuk sistem *Recycle Bin* (SoftDeletes).

### 🏗️ Site Manager (Operasional Lapangan)
- **Dashboard Verifikasi:** Metrik tugas lapangan dan notifikasi instan.
- **Verifikasi BOQ:** Input kuantitas lapangan (Qty Aktual), *Approve/Reject* revisi.
- **Manajemen Tiket Pemeliharaan:** Merespon keluhan Klien, mengubah status tiket (Diproses -> Selesai), dan menambahkan foto bukti perbaikan lapangan.
- **Laporan Harian & Kendala:** Kirim update lapangan harian.

### 🏢 Klien (Customer Portal)
- **Dashboard Personal:** Khusus menampilkan Proyek, CCO, dan BOQ milik sendiri.
- **Pengajuan CCO:** Minta perubahan kontrak (tambah/kurang) langsung dari sistem.
- **Klaim Tiket Pemeliharaan (Garansi):** Lapor kerusakan pasca-proyek (masa retensi), unggah foto kerusakan, dan lacak status perbaikan secara *real-time*.

### 📊 Direktur (Eksekutif)
- **Dashboard Eksekutif:** Pantauan ringkas performa seluruh proyek.
- **Monitoring CCO & Tiket:** Akses *read-only* untuk memantau kualitas layanan.

### ⚙️ Fitur Global (Semua Role)
- **Dark Mode / Light Mode:** Tersimpan otomatis di preferensi sistem (otomatis tanpa kedip).
- **Profil User:** Ganti password dan *update* profil mandiri.
- **Notifikasi Lonceng Real-Time:** Peringatan langsung ke *topbar* jika ada CCO masuk, BOQ disetujui, atau Tiket di-update.

---

## 🛡️ Arsitektur & Teknologi

Sistem ini dibangun dengan standar **Enterprise-Grade**:
- **UI/UX:** Bootstrap 5.3, efek *Glassmorphism*, palet warna dinamis, Font Inter & Poppins.
- **Database:** Relasional dengan `SoftDeletes`, proteksi hak cipta via `Middleware`.
- **Lokalisasi:** Zona waktu Asia/Jakarta (WIB) dengan format bacaan waktu Bahasa Indonesia (ex: *1 jam yang lalu*).
- **Keamanan Lapis Baja:** *Bcrypt hashing*, perlindungan XSS, CSRF Token, dan *Database Transactions* ganda (untuk mencegah data korup saat *upload*).

---

## 📋 Checklist Sidang / Demo
- [ ] XAMPP / Docker Start & Server Laravel jalan.
- [ ] Login multi-role berhasil diuji (Klien ajukan CCO -> Admin Proses -> SM Verifikasi).
- [ ] *Dark Mode* berfungsi halus.
- [ ] Fitur tiket pemeliharaan berjalan lancar (unggah & tampil foto).
- [ ] Export Excel & PDF berfungsi.
- [ ] Ganti Logo PT di Pengaturan berhasil.
