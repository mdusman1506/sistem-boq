# SIM BOQ Enterprise
## Sistem Informasi Administrasi Proyek Infrastruktur IT (RAB, BOQ, dan BAST) Berbasis Web

**Versi:** 1.0  
**Framework:** Laravel 11  
**Oleh:** Muhammad Usman — 411231141  
**Universitas:** Universitas Dian Nusantara — Prodi Teknik Informatika  

---

## 🔑 Akun Login Bawaan (Seeder)

| Role         | Username   | Password   | Keterangan                |
|:-------------|:-----------|:-----------|:--------------------------|
| Admin        | `admin`    | `password` | Kendali penuh semua fitur |
| Site Manager | `usman`    | `password` | Verifikasi lapangan       |
| Direktur     | `direktur` | `password` | Monitoring eksekutif      |
| Klien        | `klien`    | `password` | Customer portal           |

---

## 🚀 Cara Menjalankan Sistem (Langkah demi Langkah)

### Prasyarat
Pastikan software berikut sudah terinstal di laptop Anda:
- **XAMPP** (versi 8.2 ke atas) — [Download](https://www.apachefriends.org/)
- **Composer** — [Download](https://getcomposer.org/)
- **Node.js** (opsional, untuk asset frontend) — [Download](https://nodejs.org/)

### Langkah 1: Nyalakan XAMPP
1. Buka **XAMPP Control Panel**.
2. Klik **Start** pada modul **Apache** dan **MySQL**.
3. Pastikan keduanya berwarna hijau (running).

### Langkah 2: Buat Database
1. Buka browser, akses: `http://localhost/phpmyadmin`
2. Klik tab **Database** (di atas kiri).
3. Ketik nama database: `db_sistem_boq`
4. Klik **Create**.

### Langkah 3: Buka Terminal di Folder Proyek
1. Buka **Command Prompt** atau **PowerShell**.
2. Masuk ke folder proyek:
   ```
   cd C:\xampp\htdocs\sistemboq
   ```

### Langkah 4: Install Dependencies (Hanya Sekali)
Jalankan perintah ini HANYA jika pertama kali setup atau folder `vendor` hilang:
```
composer install
```

### Langkah 5: Salin File Environment (Hanya Sekali)
Jika file `.env` belum ada:
```
copy .env.example .env
php artisan key:generate
```
Lalu edit file `.env` dan pastikan konfigurasi database sudah benar:
```
DB_DATABASE=db_sistem_boq
DB_USERNAME=root
DB_PASSWORD=
```

### Langkah 6: Migrasi dan Seeder Database
```
php artisan migrate:fresh --seed
```
> **⚠️ PERINGATAN:** Perintah ini akan MENGHAPUS semua data lama dan mengisi ulang dengan data bawaan (seeder). Gunakan perintah ini HANYA saat pertama kali setup atau jika ingin reset total.

> **💡 TIPS:** Jika Anda sudah punya data dan hanya ingin menjalankan ulang tanpa reset, JANGAN jalankan perintah ini. Langsung lompat ke Langkah 7.

### Langkah 7: Jalankan Server Laravel
```
php artisan serve
```
Setelah muncul tulisan: `Server running on [http://127.0.0.1:8000]`

### Langkah 8: Buka di Browser
Akses: **http://127.0.0.1:8000**

Login dengan salah satu akun dari tabel di atas. Selesai! 🎉

---

## 🛡️ Arsitektur Keamanan Sistem

| Lapisan        | Teknologi                | Fungsi                                      |
|:---------------|:-------------------------|:--------------------------------------------|
| Middleware     | `CheckRole`              | Blokir akses URL ilegal per-role             |
| Controller     | Logic Guard              | Proteksi data antar Klien (klien_id check)   |
| Database       | `SoftDeletes`            | Data terhapus bisa dipulihkan (Recycle Bin)   |
| Anti-Duplikasi | Double Submit Prevention | Tombol mati saat loading, cegah data ganda   |
| Transaksi DB   | `DB::transaction`        | Rollback otomatis jika upload BOQ gagal       |
| Audit Trail    | `ActivityLog`            | Semua aksi tercatat (siapa, kapan, apa)       |
| Password       | `bcrypt (12 rounds)`     | Enkripsi sandi standar militer                |

---

## 📂 Struktur Fitur per Role

### 👤 Admin
- Dashboard Analitik + Chart
- Master Data (Klien & Barang/Jasa)
- Manajemen Pengguna (CRUD)
- Buat Proyek + Upload BOQ Excel
- Kirim BOQ ke Site Manager
- Cetak Laporan PDF + Export Excel
- Tandai Proyek Selesai
- Recycle Bin (Restore/Force Delete)
- Audit Trail

### 🏗️ Site Manager
- Dashboard Tugas Verifikasi
- Terima BOQ dari Admin
- Input Volume Aktual (Qty Lapangan)
- Approve / Reject BOQ
- Notifikasi Real-time (Lonceng)

### 📊 Direktur
- Dashboard Eksekutif + Chart Finansial
- Monitoring Semua Proyek
- Lihat Audit Trail
- Export Laporan Excel

### 🏢 Klien
- Dashboard Status Proyek Milik Sendiri
- Lihat Detail BOQ yang Sudah Disetujui
- Export Laporan Excel (Khusus Proyek Sendiri)

---

## 🔧 Troubleshooting (Jika Ada Masalah)

### "SQLSTATE Connection refused"
→ XAMPP belum dinyalakan. Buka XAMPP Control Panel, Start **Apache** dan **MySQL**.

### "Base table or view not found"
→ Database belum di-migrate. Jalankan:
```
php artisan migrate:fresh --seed
```

### "Class not found" atau "Vendor folder missing"
→ Dependencies belum terinstall. Jalankan:
```
composer install
```

### "Port 8000 already in use"
→ Server Laravel masih berjalan di terminal lain. Tutup terminal tersebut, atau gunakan port lain:
```
php artisan serve --port=8080
```

### Halaman tampil error merah (Whoops!)
→ Cek apakah file `.env` ada di root folder proyek. Jika tidak:
```
copy .env.example .env
php artisan key:generate
```

---

## 📋 Checklist Sebelum Demo Sidang

- [ ] XAMPP Apache & MySQL sudah **Start** (hijau)
- [ ] Database `db_sistem_boq` sudah ada di phpMyAdmin
- [ ] Terminal terbuka di folder `C:\xampp\htdocs\sistemboq`
- [ ] `php artisan serve` sudah running
- [ ] Browser sudah buka `http://127.0.0.1:8000`
- [ ] Login sebagai `admin` / `password` berhasil
- [ ] Coba login semua role (admin, usman, direktur, klien)
- [ ] Upload file Excel BOQ berhasil
- [ ] Kirim ke Site Manager berhasil
- [ ] Site Manager verifikasi dan Approve berhasil
- [ ] Export Excel berhasil di-download
- [ ] Cetak Laporan / Print berhasil

---

> **Catatan:** Sistem ini dibangun dengan standar Enterprise-Grade menggunakan Laravel 11, Bootstrap 5.3, Chart.js, Simple-DataTables, dan arsitektur RBAC berlapis. Seluruh fitur telah melalui pengujian keamanan dan fungsional.
