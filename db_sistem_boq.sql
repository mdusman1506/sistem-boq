-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jun 2026 pada 22.46
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sistem_boq`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Membuat Proyek Baru', 'Proyek bangunan berhasil didaftarkan.', '2026-05-30 01:02:04', '2026-05-30 01:02:04'),
(2, 1, 'Mengunggah BOQ Rev 0', 'Mengunggah dokumen BOQ untuk proyek bangunan', '2026-05-30 01:09:19', '2026-05-30 01:09:19'),
(3, 1, 'Kirim BOQ ke Site Manager', 'Meneruskan BOQ BOQ-6A19D64E9A890 ke lapangan untuk diverifikasi.', '2026-05-30 01:11:48', '2026-05-30 01:11:48'),
(4, 2, 'Menyetujui BOQ', 'Site Manager telah memverifikasi dan menyetujui BOQ BOQ-6A19D64E9A890 dengan data aktual lapangan.', '2026-05-30 01:12:30', '2026-05-30 01:12:30'),
(5, 1, 'Mengunduh Laporan Excel', 'Mengekspor data final BOQ untuk proyek bangunan', '2026-05-30 01:13:43', '2026-05-30 01:13:43'),
(6, 1, 'Membuat Proyek Baru', 'Proyek bangun berhasil didaftarkan.', '2026-06-03 14:46:30', '2026-06-03 14:46:30'),
(7, 1, 'Mengunggah BOQ Rev 0', 'Mengunggah dokumen BOQ untuk proyek bangun', '2026-06-03 14:47:02', '2026-06-03 14:47:02'),
(8, 1, 'Mengunggah BOQ Rev 1', 'Mengunggah dokumen BOQ untuk proyek bangun', '2026-06-03 14:55:17', '2026-06-03 14:55:17'),
(9, 1, 'Menghapus Draft BOQ', 'Menghapus Rev 1 dari proyek bangun', '2026-06-03 14:57:24', '2026-06-03 14:57:24'),
(10, 1, 'Menghapus Draft BOQ', 'Menghapus Rev 0 dari proyek bangun', '2026-06-03 14:57:32', '2026-06-03 14:57:32'),
(11, 1, 'Mengunggah BOQ Rev 0', 'Mengunggah dokumen BOQ untuk proyek bangun', '2026-06-03 14:58:01', '2026-06-03 14:58:01'),
(12, 1, 'Kirim BOQ ke Site Manager', 'Meneruskan BOQ BOQ-6A1FDE8884CB1 ke lapangan untuk diverifikasi.', '2026-06-03 14:58:14', '2026-06-03 14:58:14'),
(13, 2, 'Menyetujui BOQ', 'Site Manager telah memverifikasi dan menyetujui BOQ BOQ-6A1FDE8884CB1 dengan data aktual lapangan.', '2026-06-03 15:01:23', '2026-06-03 15:01:23'),
(14, 1, 'Membuat Proyek Baru', 'Proyek bababa berhasil didaftarkan.', '2026-06-03 15:18:04', '2026-06-03 15:18:04'),
(15, 1, 'Mengunggah BOQ Rev 0', 'Mengunggah dokumen BOQ untuk proyek bababa', '2026-06-03 15:18:45', '2026-06-03 15:18:45'),
(16, 1, 'Kirim BOQ ke Site Manager', 'Meneruskan BOQ BOQ-6A1FE36571A8B ke lapangan untuk diverifikasi.', '2026-06-03 15:19:09', '2026-06-03 15:19:09'),
(17, 1, 'Membuat Proyek Baru', 'Proyek hgas berhasil didaftarkan.', '2026-06-03 15:29:54', '2026-06-03 15:29:54'),
(18, 1, 'Mengunggah BOQ Rev 0', 'Mengunggah dokumen BOQ untuk proyek hgas', '2026-06-03 15:30:09', '2026-06-03 15:30:09'),
(19, 1, 'Menghapus Draft BOQ', 'Menghapus Rev 0 dari proyek hgas', '2026-06-03 15:36:02', '2026-06-03 15:36:02'),
(20, 1, 'Mengunggah BOQ Rev 0', 'Mengunggah dokumen BOQ untuk proyek hgas', '2026-06-03 15:41:20', '2026-06-03 15:41:20'),
(21, 1, 'Kirim BOQ ke Site Manager', 'Meneruskan BOQ BOQ-6A1FE8B025F05 ke lapangan untuk diverifikasi.', '2026-06-03 15:48:51', '2026-06-03 15:48:51'),
(22, 2, 'Menyetujui BOQ', 'Site Manager telah memverifikasi dan menyetujui BOQ BOQ-6A1FE8B025F05 dengan data aktual lapangan.', '2026-06-03 15:52:06', '2026-06-03 15:52:06'),
(23, 2, 'Menyetujui BOQ', 'Site Manager telah memverifikasi dan menyetujui BOQ BOQ-6A1FE36571A8B dengan data aktual lapangan.', '2026-06-15 00:13:10', '2026-06-15 00:13:10'),
(24, 1, 'Mengunduh Laporan Excel', 'Mengekspor data final BOQ untuk proyek bababa', '2026-06-15 00:15:01', '2026-06-15 00:15:01'),
(25, 1, 'Mengunduh Laporan Excel', 'Mengekspor data final BOQ untuk proyek bababa', '2026-06-15 00:25:52', '2026-06-15 00:25:52'),
(26, 1, 'Menutup Proyek Secara Final', 'Proyek bangunan telah ditandai Selesai.', '2026-06-15 00:35:11', '2026-06-15 00:35:11'),
(27, 1, 'Mencetak BAST', 'Mencetak dokumen BAST untuk proyek bangunan', '2026-06-15 00:35:15', '2026-06-15 00:35:15'),
(28, 1, 'Mencetak PDF RAB', 'Mengunduh Laporan RAB untuk proyek bangunan', '2026-06-15 00:49:54', '2026-06-15 00:49:54'),
(29, 1, 'Mencetak BAST', 'Mencetak dokumen BAST untuk proyek bangunan', '2026-06-15 00:50:12', '2026-06-15 00:50:12'),
(30, 1, 'Mencetak PDF RAB', 'Mengunduh Laporan RAB untuk proyek bangun', '2026-06-15 01:06:11', '2026-06-15 01:06:11'),
(31, 1, 'Mencetak PDF RAB', 'Mengunduh Laporan RAB untuk proyek bangun', '2026-06-15 01:11:04', '2026-06-15 01:11:04'),
(32, 1, 'Mencetak BAST', 'Mencetak dokumen BAST untuk proyek bangunan', '2026-06-15 01:13:20', '2026-06-15 01:13:20'),
(33, 1, 'Mengubah Pengaturan Sistem', 'Memperbarui konfigurasi global perusahaan.', '2026-06-15 01:32:50', '2026-06-15 01:32:50'),
(34, 1, 'Mengubah Pengaturan Sistem', 'Memperbarui konfigurasi global perusahaan.', '2026-06-15 01:33:00', '2026-06-15 01:33:00'),
(35, 1, 'Mencetak PDF RAB', 'Mengunduh Laporan RAB untuk proyek bangunan', '2026-06-15 01:36:31', '2026-06-15 01:36:31'),
(36, 1, 'Mencetak BAST', 'Mencetak dokumen BAST untuk proyek bangunan', '2026-06-15 01:40:13', '2026-06-15 01:40:13'),
(37, 3, 'Mencetak PDF RAB', 'Mengunduh Laporan RAB untuk proyek bangun', '2026-06-15 02:31:29', '2026-06-15 02:31:29'),
(38, 1, 'Membuat Proyek Baru', 'Proyek SDN GANDARIA 03 berhasil didaftarkan.', '2026-06-15 02:55:21', '2026-06-15 02:55:21'),
(39, 1, 'Mengunggah BOQ Rev 0', 'Mengunggah dokumen BOQ untuk proyek SDN GANDARIA 03', '2026-06-15 03:04:12', '2026-06-15 03:04:12'),
(40, 1, 'Menghapus Draft BOQ', 'Menghapus Rev 0 dari proyek SDN GANDARIA 03', '2026-06-15 03:04:31', '2026-06-15 03:04:31'),
(41, 1, 'Mengunggah BOQ Rev 0', 'Mengunggah dokumen BOQ untuk proyek SDN GANDARIA 03', '2026-06-15 03:06:27', '2026-06-15 03:06:27'),
(42, 1, 'Menghapus Draft BOQ', 'Menghapus Rev 0 dari proyek SDN GANDARIA 03', '2026-06-15 03:06:30', '2026-06-15 03:06:30'),
(43, 1, 'Mengunggah BOQ Rev 0', 'Mengunggah dokumen BOQ. Berhasil mengekstrak 339 item.', '2026-06-15 04:12:11', '2026-06-15 04:12:11'),
(44, 1, 'Menghapus Draft BOQ', 'Menghapus Rev 0 dari proyek SDN GANDARIA 03', '2026-06-15 04:14:26', '2026-06-15 04:14:26'),
(45, 1, 'Mengunggah BOQ Rev 0', 'Mengunggah dokumen BOQ. Berhasil mengekstrak 88 item.', '2026-06-14 22:05:40', '2026-06-14 22:05:40'),
(46, 1, 'Menghapus Draft BOQ', 'Menghapus Rev 0 dari proyek SDN GANDARIA 03', '2026-06-14 22:08:29', '2026-06-14 22:08:29'),
(47, 1, 'Mengunggah BOQ Rev 0', 'Mengunggah dokumen BOQ. Berhasil mengekstrak 88 item.', '2026-06-14 22:08:44', '2026-06-14 22:08:44'),
(48, 1, 'Menghapus Draft BOQ', 'Menghapus Rev 0 dari proyek SDN GANDARIA 03', '2026-06-14 22:16:59', '2026-06-14 22:16:59'),
(49, 1, 'Mengunggah BOQ Rev 0', 'Mengunggah dokumen BOQ. Berhasil mengekstrak 88 item.', '2026-06-14 22:17:09', '2026-06-14 22:17:09'),
(50, 1, 'Menghapus Draft BOQ', 'Menghapus Rev 0 dari proyek SDN GANDARIA 03', '2026-06-14 22:41:49', '2026-06-14 22:41:49'),
(51, 1, 'Mengunggah BOQ Rev 1', 'Mengunggah dokumen BOQ. Berhasil mengekstrak 8 item.', '2026-06-14 22:45:25', '2026-06-14 22:45:25'),
(52, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item JS-5ED786 di proyek bababa', '2026-06-14 22:46:08', '2026-06-14 22:46:08'),
(53, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item JS-94B21A di proyek bababa', '2026-06-14 22:46:14', '2026-06-14 22:46:14'),
(54, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item BR-995305 di proyek bababa', '2026-06-14 22:46:20', '2026-06-14 22:46:20'),
(55, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item BR-D0DE10 di proyek bababa', '2026-06-14 22:46:25', '2026-06-14 22:46:25'),
(56, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item JS-AEE0D3 di proyek bababa', '2026-06-14 22:46:30', '2026-06-14 22:46:30'),
(57, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item BR-2B4DE6 di proyek bababa', '2026-06-14 22:46:37', '2026-06-14 22:46:37'),
(58, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item BR-2B4DE6 di proyek bababa', '2026-06-14 22:46:43', '2026-06-14 22:46:43'),
(59, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item BR-470128 di proyek bababa', '2026-06-14 22:46:49', '2026-06-14 22:46:49'),
(60, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item BR-995305 di proyek bababa', '2026-06-14 22:46:54', '2026-06-14 22:46:54'),
(61, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item BR-D0DE10 di proyek bababa', '2026-06-14 22:46:58', '2026-06-14 22:46:58'),
(62, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item JS-AEE0D3 di proyek bababa', '2026-06-14 22:47:01', '2026-06-14 22:47:01'),
(63, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item JS-94B21A di proyek bababa', '2026-06-14 22:47:05', '2026-06-14 22:47:05'),
(64, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item JS-5ED786 di proyek bababa', '2026-06-14 22:47:10', '2026-06-14 22:47:10'),
(65, 1, 'Kirim BOQ ke Site Manager', 'Meneruskan BOQ BOQ-6A2F2F0522C69 ke lapangan untuk diverifikasi.', '2026-06-14 22:47:46', '2026-06-14 22:47:46'),
(66, 2, 'Menyetujui BOQ', 'Site Manager telah memverifikasi dan menyetujui BOQ BOQ-6A2F2F0522C69 dengan data aktual lapangan.', '2026-06-14 22:49:14', '2026-06-14 22:49:14'),
(67, 1, 'Mencetak PDF RAB', 'Mengunduh Laporan RAB untuk proyek bababa', '2026-06-14 22:49:49', '2026-06-14 22:49:49'),
(68, 1, 'Mengunduh Laporan Excel', 'Mengekspor data final BOQ untuk proyek bababa', '2026-06-14 22:50:23', '2026-06-14 22:50:23'),
(69, 1, 'Mencetak PDF RAB', 'Mengunduh Laporan RAB untuk proyek bababa', '2026-06-14 22:50:51', '2026-06-14 22:50:51'),
(70, 1, 'Mencetak PDF RAB', 'Mengunduh Laporan RAB untuk proyek bababa', '2026-06-14 22:51:25', '2026-06-14 22:51:25'),
(71, 1, 'Mencetak PDF RAB', 'Mengunduh Laporan RAB untuk proyek bababa', '2026-06-14 22:51:44', '2026-06-14 22:51:44'),
(72, 1, 'Menutup Proyek Secara Final', 'Proyek bababa telah ditandai Selesai.', '2026-06-14 22:52:32', '2026-06-14 22:52:32'),
(73, 1, 'Mencetak BAST', 'Mencetak dokumen BAST untuk proyek bababa', '2026-06-14 22:52:34', '2026-06-14 22:52:34'),
(74, 1, 'Mencetak BAST', 'Mencetak dokumen BAST untuk proyek bababa', '2026-06-14 23:00:37', '2026-06-14 23:00:37'),
(75, 1, 'Mencetak PDF', 'Mencetak laporan Rev 0 untuk proyek bababa', '2026-06-14 23:01:36', '2026-06-14 23:01:36'),
(76, 1, 'Mencetak BAST', 'Mencetak dokumen BAST untuk proyek bangunan', '2026-06-14 23:08:20', '2026-06-14 23:08:20'),
(77, 1, 'Mencetak BAST', 'Mencetak dokumen BAST untuk proyek bababa', '2026-06-14 23:09:02', '2026-06-14 23:09:02'),
(78, 1, 'Mencetak PDF', 'Mencetak laporan Rev 0 untuk proyek bababa', '2026-06-14 23:10:03', '2026-06-14 23:10:03'),
(79, 1, 'Mencetak PDF', 'Mencetak laporan Rev 1 untuk proyek bababa', '2026-06-14 23:10:10', '2026-06-14 23:10:10'),
(80, 1, 'Mencetak PDF', 'Mencetak laporan Rev 1 untuk proyek bababa', '2026-06-14 23:11:27', '2026-06-14 23:11:27'),
(81, 1, 'Mencetak PDF', 'Mencetak laporan Rev 0 untuk proyek bababa', '2026-06-14 23:11:41', '2026-06-14 23:11:41'),
(82, 1, 'Mencetak PDF', 'Mencetak laporan Rev 1 untuk proyek bababa', '2026-06-14 23:14:48', '2026-06-14 23:14:48'),
(83, 1, 'Mencetak PDF', 'Mencetak laporan Rev 1 untuk proyek bababa', '2026-06-14 23:17:27', '2026-06-14 23:17:27'),
(84, 1, 'Mencetak PDF', 'Mencetak laporan Rev 1 untuk proyek bababa', '2026-06-14 23:20:37', '2026-06-14 23:20:37'),
(85, 1, 'Mencetak PDF', 'Mencetak laporan Rev 0 untuk proyek bababa', '2026-06-14 23:20:52', '2026-06-14 23:20:52'),
(86, 1, 'Mencetak PDF', 'Mencetak laporan Rev 0 untuk proyek bababa', '2026-06-14 23:23:46', '2026-06-14 23:23:46'),
(87, 1, 'Mencetak PDF', 'Mencetak laporan Rev 0 untuk proyek bababa', '2026-06-14 23:32:34', '2026-06-14 23:32:34'),
(88, 1, 'Mencetak BAST', 'Mencetak dokumen BAST untuk proyek bababa', '2026-06-14 23:34:00', '2026-06-14 23:34:00'),
(89, 1, 'Mengunggah BOQ Rev 1', 'Mengunggah dokumen BOQ. Berhasil mengekstrak 88 item.', '2026-06-14 23:39:58', '2026-06-14 23:39:58'),
(90, 1, 'Mencetak PDF', 'Mencetak laporan Rev 1 untuk proyek bababa', '2026-06-14 23:42:18', '2026-06-14 23:42:18'),
(91, 1, 'Mencetak PDF', 'Mencetak laporan Rev 0 untuk proyek bababa', '2026-06-14 23:43:29', '2026-06-14 23:43:29'),
(92, 1, 'Mencetak PDF', 'Mencetak laporan Rev 0 untuk proyek bababa', '2026-06-14 23:48:29', '2026-06-14 23:48:29'),
(93, 1, 'Mencetak PDF', 'Mencetak laporan Rev 1 untuk proyek bababa', '2026-06-14 23:48:50', '2026-06-14 23:48:50'),
(94, 1, 'Mencetak BAST', 'Mencetak dokumen BAST untuk proyek bababa', '2026-06-14 23:49:01', '2026-06-14 23:49:01'),
(95, 1, 'Mencetak PDF', 'Mencetak laporan Rev 0 untuk proyek hgas', '2026-06-14 23:50:18', '2026-06-14 23:50:18'),
(96, 1, 'Mencetak PDF', 'Mencetak laporan Rev 0 untuk proyek hgas', '2026-06-14 23:52:48', '2026-06-14 23:52:48'),
(97, 1, 'Mencetak PDF', 'Mencetak laporan Rev 0 untuk proyek bangunan', '2026-06-14 23:53:28', '2026-06-14 23:53:28'),
(98, 1, 'Mencetak PDF', 'Mencetak laporan Rev 1 untuk proyek bababa', '2026-06-14 23:53:44', '2026-06-14 23:53:44'),
(99, 1, 'Mencetak BAST', 'Mencetak dokumen BAST untuk proyek bababa', '2026-06-14 23:54:41', '2026-06-14 23:54:41'),
(100, 1, 'Mencetak PDF', 'Mencetak laporan Rev 0 untuk proyek bangunan', '2026-06-14 23:57:05', '2026-06-14 23:57:05'),
(101, 1, 'Mencetak PDF', 'Mencetak laporan Rev 1 untuk proyek bababa', '2026-06-14 23:57:22', '2026-06-14 23:57:22'),
(102, 1, 'Mencetak PDF', 'Mencetak laporan Rev 1 untuk proyek bababa', '2026-06-15 00:01:14', '2026-06-15 00:01:14'),
(103, 1, 'Mencetak BAST', 'Mencetak dokumen BAST untuk proyek bababa', '2026-06-15 00:01:22', '2026-06-15 00:01:22'),
(104, 1, 'Mencetak PDF', 'Mencetak laporan Rev 1 untuk proyek bababa', '2026-06-15 00:09:08', '2026-06-15 00:09:08'),
(105, 1, 'Mencetak BAST', 'Mencetak dokumen BAST untuk proyek bababa', '2026-06-15 00:09:23', '2026-06-15 00:09:23'),
(106, 1, 'Mengunggah BOQ Rev 1', 'Mengunggah dokumen BOQ. Berhasil mengekstrak 8 item.', '2026-06-15 00:40:41', '2026-06-15 00:40:41'),
(107, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item JS-5ED786 di proyek bangun', '2026-06-15 00:40:53', '2026-06-15 00:40:53'),
(108, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item JS-AEE0D3 di proyek bangun', '2026-06-15 00:40:59', '2026-06-15 00:40:59'),
(109, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item BR-995305 di proyek bangun', '2026-06-15 00:41:04', '2026-06-15 00:41:04'),
(110, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item BR-D0DE10 di proyek bangun', '2026-06-15 00:41:09', '2026-06-15 00:41:09'),
(111, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item BR-2B4DE6 di proyek bangun', '2026-06-15 00:41:15', '2026-06-15 00:41:15'),
(112, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item JS-94B21A di proyek bangun', '2026-06-15 00:41:25', '2026-06-15 00:41:25'),
(113, 1, 'Edit Item BOQ', 'Mengubah qty/lokasi pada item BR-470128 di proyek bangun', '2026-06-15 00:41:33', '2026-06-15 00:41:33'),
(114, 1, 'Kirim BOQ ke Site Manager', 'Meneruskan BOQ BOQ-6A2F4A0611C21 ke lapangan untuk diverifikasi.', '2026-06-15 00:41:51', '2026-06-15 00:41:51'),
(115, 4, 'Mencetak PDF', 'Mencetak laporan Rev 0 untuk proyek bangunan', '2026-06-15 01:40:25', '2026-06-15 01:40:25'),
(116, 4, 'Mencetak PDF', 'Mencetak laporan Rev 0 untuk proyek bangunan', '2026-06-15 01:40:31', '2026-06-15 01:40:31'),
(117, 4, 'Mencetak BAST', 'Mencetak dokumen BAST untuk proyek bangunan', '2026-06-15 01:40:45', '2026-06-15 01:40:45'),
(118, 4, 'Mencetak BAST', 'Mencetak dokumen BAST untuk proyek bangunan', '2026-06-15 02:16:21', '2026-06-15 02:16:21'),
(119, 4, 'Klien Menyetujui BAST', 'Klien PT. Maju Mundur (PT PT. Maju Mundur Kena) telah menyetujui BAST untuk proyek bangunan', '2026-06-15 02:16:38', '2026-06-15 02:16:38'),
(120, 4, 'Klien Membuka Tiket', 'Klien PT. Maju Mundur (PT PT. Maju Mundur Kena) membuka tiket komplain untuk proyek bangunan', '2026-06-15 02:41:30', '2026-06-15 02:41:30'),
(121, 2, 'Tiket Diproses', 'Site Manager memproses tiket komplain: cctv', '2026-06-15 04:01:53', '2026-06-15 04:01:53'),
(122, 2, 'Tiket Selesai', 'Site Manager menyelesaikan perbaikan komplain: cctv', '2026-06-15 04:07:42', '2026-06-15 04:07:42'),
(123, 1, 'Mencetak PDF', 'Mencetak laporan Rev 1 untuk proyek bababa', '2026-06-15 04:16:26', '2026-06-15 04:16:26'),
(124, 1, 'Mencetak PDF', 'Mencetak laporan Rev 1 untuk proyek bababa', '2026-06-15 04:16:29', '2026-06-15 04:16:29'),
(125, 1, 'Mencetak BAST', 'Mencetak dokumen BAST untuk proyek bababa', '2026-06-15 04:16:38', '2026-06-15 04:16:38'),
(126, 1, 'Mengunggah BOQ Rev 0', 'Mengunggah dokumen BOQ. Berhasil mengekstrak 88 item.', '2026-06-15 14:25:46', '2026-06-15 14:25:46'),
(127, 1, 'Kirim BOQ ke Site Manager', 'Meneruskan BOQ BOQ-6A300B622D826 ke lapangan untuk diverifikasi.', '2026-06-15 14:26:00', '2026-06-15 14:26:00'),
(128, 2, 'Menyetujui BOQ', 'Site Manager telah memverifikasi dan menyetujui BOQ BOQ-6A300B622D826 dengan data aktual lapangan.', '2026-06-15 14:27:01', '2026-06-15 14:27:01'),
(129, 6, 'Klien Mengajukan CCO', 'Klien saman (PT PT garmit) mengajukan Pekerjaan Tambah/Kurang untuk proyek SDN GANDARIA 03', '2026-06-15 14:28:11', '2026-06-15 14:28:11'),
(130, 4, 'Klien Membuat Tiket Komplain', 'Klien PT. Maju Mundur (PT PT. Maju Mundur Kena) membuat tiket pemeliharaan: ac', '2026-06-15 14:37:40', '2026-06-15 14:37:40'),
(131, 1, 'Admin Memproses CCO', 'Admin membuat Revisi BOQ baru untuk memproses CCO: cctv', '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(132, 1, 'Mencetak PDF', 'Mencetak laporan Rev 0 untuk proyek SDN GANDARIA 03', '2026-06-15 22:17:02', '2026-06-15 22:17:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_26_000001_create_tb_klien_table', 1),
(5, '2026_05_26_000002_create_tb_proyek_table', 1),
(6, '2026_05_26_000003_create_tb_master_barang_jasa_table', 1),
(7, '2026_05_26_000004_create_tb_boq_header_table', 1),
(8, '2026_05_26_000005_create_tb_boq_detail_table', 1),
(9, '2026_05_29_154500_add_klien_id_and_soft_deletes_to_users_table', 1),
(10, '2026_05_29_154600_add_soft_deletes_to_master_tables', 1),
(11, '2026_05_29_154700_create_activity_logs_table', 1),
(12, '2026_05_29_154800_create_notifications_table', 1),
(13, '2026_05_30_000001_create_settings_table', 1),
(14, '2026_05_30_000002_add_email_to_users_table', 1),
(15, '2026_06_03_142400_add_file_bukti_to_tb_boq_header_table', 2),
(16, '2026_06_14_000001_add_tipe_to_tb_master_barang_jasa_table', 3),
(17, '2026_06_14_000002_add_site_manager_id_to_tb_proyek_table', 4),
(20, '2026_06_15_000000_create_tb_laporan_harian_table', 5),
(21, '2026_06_15_000001_create_tb_kendala_lapangan_table', 5),
(22, '2026_06_15_000001_add_client_approval_to_boq_header_table', 6),
(23, '2026_06_15_000002_create_change_requests_table', 6),
(24, '2026_06_15_000002_create_tb_laporan_harian_table', 7),
(25, '2026_06_15_000003_create_tb_kendala_lapangan_table', 7),
(26, '2026_06_15_000003_create_tiket_pemeliharaan_table', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `is_read`, `link`, `created_at`, `updated_at`) VALUES
(1, 2, 'Verifikasi BOQ Baru', 'Admin meminta Anda memverifikasi BOQ Proyek bangunan', 0, 'http://127.0.0.1:8000/dashboard', '2026-05-30 01:11:48', '2026-05-30 01:11:48'),
(2, 1, 'BOQ Disetujui', 'Site Manager menyetujui BOQ Proyek bangunan', 0, 'http://127.0.0.1:8000/proyek/1', '2026-05-30 01:12:30', '2026-05-30 01:12:30'),
(3, 3, 'BOQ Disetujui', 'Site Manager menyetujui BOQ Proyek bangunan', 0, 'http://127.0.0.1:8000/proyek/1', '2026-05-30 01:12:30', '2026-05-30 01:12:30'),
(4, 2, 'Verifikasi BOQ Baru', 'Admin meminta Anda memverifikasi BOQ Proyek bangun', 0, 'http://127.0.0.1:8000/dashboard', '2026-06-03 14:58:14', '2026-06-03 14:58:14'),
(5, 1, 'BOQ Disetujui', 'Site Manager menyetujui BOQ Proyek bangun', 0, 'http://127.0.0.1:8000/proyek/2', '2026-06-03 15:01:23', '2026-06-03 15:01:23'),
(6, 3, 'BOQ Disetujui', 'Site Manager menyetujui BOQ Proyek bangun', 0, 'http://127.0.0.1:8000/proyek/2', '2026-06-03 15:01:23', '2026-06-03 15:01:23'),
(7, 2, 'Verifikasi BOQ Baru', 'Admin meminta Anda memverifikasi BOQ Proyek bababa', 0, 'http://127.0.0.1:8000/dashboard', '2026-06-03 15:19:09', '2026-06-03 15:19:09'),
(8, 2, 'Verifikasi BOQ Baru', 'Admin meminta Anda memverifikasi BOQ Proyek hgas', 0, 'http://127.0.0.1:8000/dashboard', '2026-06-03 15:48:51', '2026-06-03 15:48:51'),
(9, 1, 'BOQ Disetujui', 'Site Manager menyetujui BOQ Proyek hgas', 0, 'http://127.0.0.1:8000/proyek/4', '2026-06-03 15:52:06', '2026-06-03 15:52:06'),
(10, 3, 'BOQ Disetujui', 'Site Manager menyetujui BOQ Proyek hgas', 0, 'http://127.0.0.1:8000/proyek/4', '2026-06-03 15:52:06', '2026-06-03 15:52:06'),
(11, 1, 'BOQ Disetujui', 'Site Manager menyetujui BOQ Proyek bababa', 0, 'http://127.0.0.1:8000/proyek/3', '2026-06-15 00:13:10', '2026-06-15 00:13:10'),
(12, 3, 'BOQ Disetujui', 'Site Manager menyetujui BOQ Proyek bababa', 0, 'http://127.0.0.1:8000/proyek/3', '2026-06-15 00:13:13', '2026-06-15 00:13:13'),
(13, 2, 'Verifikasi BOQ Baru', 'Admin meminta Anda memverifikasi BOQ Proyek bababa', 0, 'http://127.0.0.1:8000/dashboard', '2026-06-14 22:47:46', '2026-06-14 22:47:46'),
(14, 5, 'Verifikasi BOQ Baru', 'Admin meminta Anda memverifikasi BOQ Proyek bababa', 0, 'http://127.0.0.1:8000/dashboard', '2026-06-14 22:47:46', '2026-06-14 22:47:46'),
(15, 1, 'BOQ Disetujui', 'Site Manager menyetujui BOQ Proyek bababa', 0, 'http://127.0.0.1:8000/proyek/3', '2026-06-14 22:49:14', '2026-06-14 22:49:14'),
(16, 3, 'BOQ Disetujui', 'Site Manager menyetujui BOQ Proyek bababa', 0, 'http://127.0.0.1:8000/proyek/3', '2026-06-14 22:49:14', '2026-06-14 22:49:14'),
(17, 2, 'Verifikasi BOQ Baru', 'Admin meminta Anda memverifikasi BOQ Proyek bangun', 0, 'http://127.0.0.1:8000/dashboard', '2026-06-15 00:41:51', '2026-06-15 00:41:51'),
(18, 5, 'Verifikasi BOQ Baru', 'Admin meminta Anda memverifikasi BOQ Proyek bangun', 0, 'http://127.0.0.1:8000/dashboard', '2026-06-15 00:41:54', '2026-06-15 00:41:54'),
(19, 2, 'Verifikasi BOQ Baru', 'Admin meminta Anda memverifikasi BOQ Proyek SDN GANDARIA 03', 0, 'http://127.0.0.1:8000/dashboard', '2026-06-15 14:26:00', '2026-06-15 14:26:00'),
(20, 5, 'Verifikasi BOQ Baru', 'Admin meminta Anda memverifikasi BOQ Proyek SDN GANDARIA 03', 0, 'http://127.0.0.1:8000/dashboard', '2026-06-15 14:26:02', '2026-06-15 14:26:02'),
(21, 1, 'BOQ Disetujui', 'Site Manager menyetujui BOQ Proyek SDN GANDARIA 03', 0, 'http://127.0.0.1:8000/proyek/5', '2026-06-15 14:27:01', '2026-06-15 14:27:01'),
(22, 3, 'BOQ Disetujui', 'Site Manager menyetujui BOQ Proyek SDN GANDARIA 03', 0, 'http://127.0.0.1:8000/proyek/5', '2026-06-15 14:27:01', '2026-06-15 14:27:01'),
(23, 1, 'Tiket Komplain Baru', 'PT PT. Maju Mundur Kena mengajukan komplain: ac', 0, '/tiket', '2026-06-15 14:37:40', '2026-06-15 14:37:40'),
(24, 2, 'Tiket Komplain Baru', 'PT PT. Maju Mundur Kena mengajukan komplain: ac', 0, '/tiket', '2026-06-15 14:37:40', '2026-06-15 14:37:40'),
(25, 3, 'Tiket Komplain Baru', 'PT PT. Maju Mundur Kena mengajukan komplain: ac', 0, '/tiket', '2026-06-15 14:37:40', '2026-06-15 14:37:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3IyrudHMy7o7SUcJ9yOIyJn8H9RjvZdYpztbiTyj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiODV6d09tRlEyT3FDM1FBREk0ZDU1a3FUY2RpcnczeUY1eFR6OEpRMCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL25vdGlmaWNhdGlvbnMvdW5yZWFkIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ub3RpZmljYXRpb25zL3VucmVhZCI7czo1OiJyb3V0ZSI7czoyMDoibm90aWZpY2F0aW9ucy51bnJlYWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781637391),
('4Ymr03ywAXPxiy1GHhSLBcgtlt3ndQtzrAron8yA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOWRJU21XbGJXbHoxM0w1OW50WmRTaHN3MjlxUW81MDlOZTRaWGdlZiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL25vdGlmaWNhdGlvbnMvdW5yZWFkIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781637393),
('9kRbZ7pnRMsJzOuykxnev5RzBGis3igKhUMYs1sf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaE1jd1N4bVlCdlR6V1pUeFdtV3dzS1pteGJnUk5hUHljcFp3c0dPRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ub3RpZmljYXRpb25zL3VucmVhZCI7fX0=', 1781639121),
('H8kqBmOlG1yREfJZnEvxgBn4fWmnwIv1MHmXwTiD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVGxNamVhWm9yRkFubmM5T2xFVDBtRzBMcDY0SkNNNmF3VVd1SHBlRCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL25vdGlmaWNhdGlvbnMvdW5yZWFkIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ub3RpZmljYXRpb25zL3VucmVhZCI7czo1OiJyb3V0ZSI7czoyMDoibm90aWZpY2F0aW9ucy51bnJlYWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781637392),
('IRm4okZ5UYvIkH2nS7GRx1eeqjJC2FMhNJ7Mqz7C', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic05LWmdSeURFWnFWV2F0TlluUmJxbm1US2xBYW5mSVk3YUFJd1AzciI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL25vdGlmaWNhdGlvbnMvdW5yZWFkIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ub3RpZmljYXRpb25zL3VucmVhZCI7czo1OiJyb3V0ZSI7czoyMDoibm90aWZpY2F0aW9ucy51bnJlYWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781637391),
('nvbPmrjcjCOSRBUekClHnBi6ZDdb1pM1k9uI2shQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQXgwTlJ0SFJKZmRmNXFPNWFwcEF0RGttbHlYNURKQldMMjJWQU55QSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL25vdGlmaWNhdGlvbnMvdW5yZWFkIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ub3RpZmljYXRpb25zL3VucmVhZCI7czo1OiJyb3V0ZSI7czoyMDoibm90aWZpY2F0aW9ucy51bnJlYWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781637391),
('P8IaWdQMVxtdLX5c55PaDPcptjr5EfWaWI5M6ZYQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRERWVW40allIVTVwaUNBRVU5WVFiNU1JcVVRcW9XS2EzWnFQNm1weCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL25vdGlmaWNhdGlvbnMvdW5yZWFkIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ub3RpZmljYXRpb25zL3VucmVhZCI7czo1OiJyb3V0ZSI7czoyMDoibm90aWZpY2F0aW9ucy51bnJlYWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781637392),
('pCFtoUHSRftUMKpH3VNemcBV4uAQWs6kVXviwVEE', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMEJscGQ3clZ5empaUENqQnptdzZiYm1zekVtc0dBS2ZnU205WmpRUiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL25vdGlmaWNhdGlvbnMvdW5yZWFkIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ub3RpZmljYXRpb25zL3VucmVhZCI7czo1OiJyb3V0ZSI7czoyMDoibm90aWZpY2F0aW9ucy51bnJlYWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781637391);

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'nama_perusahaan', 'PT Indotama Media Teknologi', '2026-05-29 10:57:41', '2026-05-29 10:57:41'),
(2, 'alamat_perusahaan', 'Jl. Raya Hankam No.159e, RT.009/RW.010, Jatirahayu, Kec. Pd. Melati, Kota Bks, Jawa Barat 17411', '2026-05-29 10:57:41', '2026-06-14 11:32:50'),
(3, 'telepon_perusahaan', '(0812) 8291-0672', '2026-05-29 10:57:41', '2026-06-14 11:32:50'),
(4, 'email_perusahaan', 'sales@imtech.co.id', '2026-05-29 10:57:41', '2026-06-14 11:32:50'),
(5, 'pajak_persen', '11', '2026-05-29 10:57:41', '2026-05-29 10:57:41'),
(6, 'logo_path', 'logos/CSt0znrVMLQKJx6rY1Nrm0O6UHxnkBjldoSGCLZy.png', '2026-06-14 11:33:00', '2026-06-14 11:33:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_boq_detail`
--

CREATE TABLE `tb_boq_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `boq_header_id` bigint(20) UNSIGNED NOT NULL,
  `barang_jasa_id` bigint(20) UNSIGNED NOT NULL,
  `lokasi_lantai` varchar(50) DEFAULT NULL,
  `lokasi_zona` varchar(50) DEFAULT NULL,
  `qty_kontrak` decimal(10,2) NOT NULL DEFAULT 0.00,
  `qty_aktual` decimal(10,2) DEFAULT NULL,
  `harga_material_satuan` decimal(15,2) DEFAULT NULL,
  `harga_jasa_satuan` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_boq_detail`
--

INSERT INTO `tb_boq_detail` (`id`, `boq_header_id`, `barang_jasa_id`, `lokasi_lantai`, `lokasi_zona`, `qty_kontrak`, `qty_aktual`, `harga_material_satuan`, `harga_jasa_satuan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Lantai 1', 'Lobby', 8.00, 8.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(2, 1, 2, 'Lantai 1', 'Ruang Meeting', 3.00, 3.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(3, 1, 3, 'Lantai 1', 'Lobby', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(4, 1, 1, 'Lantai 2', 'Ruang Direksi', 5.00, 5.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(5, 1, 2, 'Lantai 2', 'Ruang Direksi', 2.00, 2.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(6, 1, 3, 'Lantai 2', 'Lobby', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(7, 1, 1, 'Lantai 3', 'Koridor Utama', 13.00, 13.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(8, 1, 2, 'Lantai 3', 'Koridor Utama', 2.00, 2.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(9, 1, 3, 'Lantai 3', 'Ruang Server', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(10, 1, 1, 'Lantai 4', 'Area Staff', 2.00, 2.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(11, 1, 2, 'Lantai 4', 'Ruang Meeting', 3.00, 3.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(12, 1, 3, 'Lantai 4', 'Ruang Meeting', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(13, 1, 1, 'Lantai 5', 'Ruang Server', 12.00, 12.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(14, 1, 2, 'Lantai 5', 'Ruang Server', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(15, 1, 3, 'Lantai 5', 'Ruang Meeting', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(16, 1, 1, 'Lantai 6', 'Ruang Server', 13.00, 13.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(17, 1, 2, 'Lantai 6', 'Lobby', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(18, 1, 3, 'Lantai 6', 'Area Staff', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(19, 1, 1, 'Lantai 7', 'Ruang Meeting', 14.00, 14.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(20, 1, 2, 'Lantai 7', 'Ruang Meeting', 2.00, 2.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(21, 1, 3, 'Lantai 7', 'Koridor Utama', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(22, 1, 1, 'Lantai 8', 'Lobby', 12.00, 12.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(23, 1, 2, 'Lantai 8', 'Lobby', 3.00, 3.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(24, 1, 3, 'Lantai 8', 'Ruang Server', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(25, 1, 1, 'Lantai 9', 'Area Staff', 2.00, 2.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(26, 1, 2, 'Lantai 9', 'Koridor Utama', 3.00, 3.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(27, 1, 3, 'Lantai 9', 'Ruang Direksi', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(28, 1, 1, 'Lantai 10', 'Ruang Server', 8.00, 8.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(29, 1, 2, 'Lantai 10', 'Ruang Meeting', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(30, 1, 3, 'Lantai 10', 'Ruang Meeting', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(31, 1, 1, 'Lantai 11', 'Ruang Server', 9.00, 9.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(32, 1, 2, 'Lantai 11', 'Koridor Utama', 3.00, 3.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(33, 1, 3, 'Lantai 11', 'Area Staff', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(34, 1, 1, 'Lantai 12', 'Lobby', 13.00, 13.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(35, 1, 2, 'Lantai 12', 'Lobby', 3.00, 3.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:29'),
(36, 1, 3, 'Lantai 12', 'Koridor Utama', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:30'),
(37, 1, 1, 'Lantai 13', 'Koridor Utama', 15.00, 15.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:30'),
(38, 1, 2, 'Lantai 13', 'Ruang Direksi', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:30'),
(39, 1, 3, 'Lantai 13', 'Koridor Utama', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:30'),
(40, 1, 1, 'Lantai 14', 'Ruang Server', 12.00, 12.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:30'),
(41, 1, 2, 'Lantai 14', 'Ruang Direksi', 3.00, 3.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:30'),
(42, 1, 3, 'Lantai 14', 'Ruang Meeting', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:30'),
(43, 1, 1, 'Lantai 15', 'Ruang Meeting', 6.00, 6.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:30'),
(44, 1, 2, 'Lantai 15', 'Area Staff', 2.00, 2.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:30'),
(45, 1, 3, 'Lantai 15', 'Lobby', 1.00, 1.00, 0.00, 0.00, '2026-05-30 01:09:19', '2026-05-30 01:12:30'),
(136, 4, 1, 'Lantai 1', 'Lobby', 8.00, 8.00, 650000.00, 0.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(137, 4, 2, 'Lantai 1', 'Ruang Meeting', 3.00, 3.00, 2500000.00, 0.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(138, 4, 3, 'Lantai 1', 'Lobby', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(139, 4, 1, 'Lantai 2', 'Ruang Direksi', 5.00, 5.00, 650000.00, 0.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(140, 4, 2, 'Lantai 2', 'Ruang Direksi', 2.00, 2.00, 2500000.00, 0.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(141, 4, 3, 'Lantai 2', 'Lobby', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(142, 4, 1, 'Lantai 3', 'Koridor Utama', 13.00, 13.00, 650000.00, 0.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(143, 4, 2, 'Lantai 3', 'Koridor Utama', 2.00, 2.00, 2500000.00, 0.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(144, 4, 3, 'Lantai 3', 'Ruang Server', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(145, 4, 1, 'Lantai 4', 'Area Staff', 2.00, 2.00, 650000.00, 0.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(146, 4, 2, 'Lantai 4', 'Ruang Meeting', 3.00, 3.00, 2500000.00, 0.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(147, 4, 3, 'Lantai 4', 'Ruang Meeting', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(148, 4, 1, 'Lantai 5', 'Ruang Server', 12.00, 12.00, 650000.00, 0.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(149, 4, 2, 'Lantai 5', 'Ruang Server', 1.00, 1.00, 2500000.00, 0.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(150, 4, 3, 'Lantai 5', 'Ruang Meeting', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(151, 4, 1, 'Lantai 6', 'Ruang Server', 13.00, 13.00, 650000.00, 0.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(152, 4, 2, 'Lantai 6', 'Lobby', 1.00, 1.00, 2500000.00, 0.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(153, 4, 3, 'Lantai 6', 'Area Staff', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(154, 4, 1, 'Lantai 7', 'Ruang Meeting', 14.00, 14.00, 650000.00, 0.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(155, 4, 2, 'Lantai 7', 'Ruang Meeting', 2.00, 2.00, 2500000.00, 0.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(156, 4, 3, 'Lantai 7', 'Koridor Utama', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(157, 4, 1, 'Lantai 8', 'Lobby', 12.00, 12.00, 650000.00, 0.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(158, 4, 2, 'Lantai 8', 'Lobby', 3.00, 3.00, 2500000.00, 0.00, '2026-06-03 14:58:00', '2026-06-03 15:01:21'),
(159, 4, 3, 'Lantai 8', 'Ruang Server', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(160, 4, 1, 'Lantai 9', 'Area Staff', 2.00, 2.00, 650000.00, 0.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(161, 4, 2, 'Lantai 9', 'Koridor Utama', 3.00, 3.00, 2500000.00, 0.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(162, 4, 3, 'Lantai 9', 'Ruang Direksi', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(163, 4, 1, 'Lantai 10', 'Ruang Server', 8.00, 8.00, 650000.00, 0.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(164, 4, 2, 'Lantai 10', 'Ruang Meeting', 1.00, 1.00, 2500000.00, 0.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(165, 4, 3, 'Lantai 10', 'Ruang Meeting', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(166, 4, 1, 'Lantai 11', 'Ruang Server', 9.00, 9.00, 650000.00, 0.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(167, 4, 2, 'Lantai 11', 'Koridor Utama', 3.00, 3.00, 2500000.00, 0.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(168, 4, 3, 'Lantai 11', 'Area Staff', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(169, 4, 1, 'Lantai 12', 'Lobby', 13.00, 13.00, 650000.00, 0.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(170, 4, 2, 'Lantai 12', 'Lobby', 3.00, 3.00, 2500000.00, 0.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(171, 4, 3, 'Lantai 12', 'Koridor Utama', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(172, 4, 1, 'Lantai 13', 'Koridor Utama', 15.00, 15.00, 650000.00, 0.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(173, 4, 2, 'Lantai 13', 'Ruang Direksi', 1.00, 1.00, 2500000.00, 0.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(174, 4, 3, 'Lantai 13', 'Koridor Utama', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(175, 4, 1, 'Lantai 14', 'Ruang Server', 12.00, 12.00, 650000.00, 0.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(176, 4, 2, 'Lantai 14', 'Ruang Direksi', 3.00, 3.00, 2500000.00, 0.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(177, 4, 3, 'Lantai 14', 'Ruang Meeting', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(178, 4, 1, 'Lantai 15', 'Ruang Meeting', 6.00, 6.00, 650000.00, 0.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(179, 4, 2, 'Lantai 15', 'Area Staff', 2.00, 2.00, 2500000.00, 0.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(180, 4, 3, 'Lantai 15', 'Lobby', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 14:58:01', '2026-06-03 15:01:21'),
(181, 5, 1, 'Lantai 1', 'Lobby', 8.00, 8.00, 650000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(182, 5, 2, 'Lantai 1', 'Ruang Meeting', 3.00, 3.00, 2500000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(183, 5, 3, 'Lantai 1', 'Lobby', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(184, 5, 1, 'Lantai 2', 'Ruang Direksi', 5.00, 5.00, 650000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(185, 5, 2, 'Lantai 2', 'Ruang Direksi', 2.00, 2.00, 2500000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(186, 5, 3, 'Lantai 2', 'Lobby', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(187, 5, 1, 'Lantai 3', 'Koridor Utama', 13.00, 13.00, 650000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(188, 5, 2, 'Lantai 3', 'Koridor Utama', 2.00, 2.00, 2500000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(189, 5, 3, 'Lantai 3', 'Ruang Server', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(190, 5, 1, 'Lantai 4', 'Area Staff', 2.00, 2.00, 650000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(191, 5, 2, 'Lantai 4', 'Ruang Meeting', 3.00, 3.00, 2500000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(192, 5, 3, 'Lantai 4', 'Ruang Meeting', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(193, 5, 1, 'Lantai 5', 'Ruang Server', 12.00, 12.00, 650000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(194, 5, 2, 'Lantai 5', 'Ruang Server', 1.00, 1.00, 2500000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(195, 5, 3, 'Lantai 5', 'Ruang Meeting', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(196, 5, 1, 'Lantai 6', 'Ruang Server', 13.00, 13.00, 650000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(197, 5, 2, 'Lantai 6', 'Lobby', 1.00, 1.00, 2500000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(198, 5, 3, 'Lantai 6', 'Area Staff', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(199, 5, 1, 'Lantai 7', 'Ruang Meeting', 14.00, 14.00, 650000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(200, 5, 2, 'Lantai 7', 'Ruang Meeting', 2.00, 2.00, 2500000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(201, 5, 3, 'Lantai 7', 'Koridor Utama', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(202, 5, 1, 'Lantai 8', 'Lobby', 12.00, 12.00, 650000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(203, 5, 2, 'Lantai 8', 'Lobby', 3.00, 3.00, 2500000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(204, 5, 3, 'Lantai 8', 'Ruang Server', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(205, 5, 1, 'Lantai 9', 'Area Staff', 2.00, 2.00, 650000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(206, 5, 2, 'Lantai 9', 'Koridor Utama', 3.00, 3.00, 2500000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(207, 5, 3, 'Lantai 9', 'Ruang Direksi', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(208, 5, 1, 'Lantai 10', 'Ruang Server', 8.00, 8.00, 650000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(209, 5, 2, 'Lantai 10', 'Ruang Meeting', 1.00, 1.00, 2500000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(210, 5, 3, 'Lantai 10', 'Ruang Meeting', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(211, 5, 1, 'Lantai 11', 'Ruang Server', 9.00, 9.00, 650000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(212, 5, 2, 'Lantai 11', 'Koridor Utama', 3.00, 3.00, 2500000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(213, 5, 3, 'Lantai 11', 'Area Staff', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(214, 5, 1, 'Lantai 12', 'Lobby', 13.00, 13.00, 650000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(215, 5, 2, 'Lantai 12', 'Lobby', 3.00, 3.00, 2500000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(216, 5, 3, 'Lantai 12', 'Koridor Utama', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(217, 5, 1, 'Lantai 13', 'Koridor Utama', 15.00, 15.00, 650000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(218, 5, 2, 'Lantai 13', 'Ruang Direksi', 1.00, 1.00, 2500000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(219, 5, 3, 'Lantai 13', 'Koridor Utama', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(220, 5, 1, 'Lantai 14', 'Ruang Server', 12.00, 12.00, 650000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(221, 5, 2, 'Lantai 14', 'Ruang Direksi', 3.00, 3.00, 2500000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(222, 5, 3, 'Lantai 14', 'Ruang Meeting', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(223, 5, 1, 'Lantai 15', 'Ruang Meeting', 6.00, 6.00, 650000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(224, 5, 2, 'Lantai 15', 'Area Staff', 2.00, 2.00, 2500000.00, 0.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(225, 5, 3, 'Lantai 15', 'Lobby', 1.00, 1.00, 0.00, 150000.00, '2026-06-03 15:18:45', '2026-06-15 00:13:10'),
(271, 7, 1, 'Lantai 1', 'Ruang Server', 15.00, 15.00, 650000.00, 0.00, '2026-06-03 15:41:20', '2026-06-03 15:52:05'),
(272, 7, 3, 'Lantai 2', 'Ruang Meeting', 10.00, 10.00, 0.00, 150000.00, '2026-06-03 15:41:20', '2026-06-03 15:52:05'),
(1044, 30, 271, NULL, NULL, 4.00, 4.00, 310000.00, 460000.00, '2026-06-14 22:45:25', '2026-06-14 22:49:14'),
(1045, 30, 211, NULL, NULL, 5.00, 5.00, 920000.00, 70000.00, '2026-06-14 22:45:25', '2026-06-14 22:49:14'),
(1046, 30, 213, NULL, NULL, 3.00, 3.00, 950000.00, 170000.00, '2026-06-14 22:45:25', '2026-06-14 22:49:14'),
(1047, 30, 274, NULL, NULL, 3.00, 3.00, 40000.00, 240000.00, '2026-06-14 22:45:25', '2026-06-14 22:49:14'),
(1048, 30, 216, NULL, NULL, 2.00, 2.00, 500000.00, 440000.00, '2026-06-14 22:45:25', '2026-06-14 22:49:14'),
(1049, 30, 217, NULL, NULL, 2.00, 2.00, 440000.00, 190000.00, '2026-06-14 22:45:25', '2026-06-14 22:49:14'),
(1050, 30, 218, NULL, NULL, 4.00, 4.00, 500000.00, 300000.00, '2026-06-14 22:45:25', '2026-06-14 22:49:14'),
(1051, 30, 216, NULL, NULL, 5.00, 5.00, 500000.00, 440000.00, '2026-06-14 22:45:25', '2026-06-14 22:49:14'),
(1052, 31, 84, NULL, NULL, 1.00, NULL, 780000.00, 400000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1053, 31, 85, NULL, NULL, 1.00, NULL, 710000.00, 340000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1054, 31, 88, NULL, NULL, 0.00, NULL, 300000.00, 160000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1055, 31, 88, NULL, NULL, 0.00, NULL, 300000.00, 160000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1056, 31, 88, NULL, NULL, 1.00, NULL, 300000.00, 160000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1057, 31, 88, NULL, NULL, 1.00, NULL, 300000.00, 160000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1058, 31, 90, NULL, NULL, 76.00, NULL, 110000.00, 360000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1059, 31, 91, NULL, NULL, 19.00, NULL, 630000.00, 30000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1060, 31, 92, NULL, NULL, 17.00, NULL, 940000.00, 460000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1061, 31, 94, NULL, NULL, 2.00, NULL, 30000.00, 360000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1062, 31, 94, NULL, NULL, 1.00, NULL, 30000.00, 360000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1063, 31, 94, NULL, NULL, 1.00, NULL, 30000.00, 360000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1064, 31, 94, NULL, NULL, 5.00, NULL, 30000.00, 360000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1065, 31, 97, NULL, NULL, 76.00, NULL, 360000.00, 490000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1066, 31, 98, NULL, NULL, 19.00, NULL, 530000.00, 180000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1067, 31, 99, NULL, NULL, 17.00, NULL, 930000.00, 260000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1068, 31, 100, NULL, NULL, 2.00, NULL, 540000.00, 70000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1069, 31, 101, NULL, NULL, 1.00, NULL, 570000.00, 330000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1070, 31, 101, NULL, NULL, 1.00, NULL, 570000.00, 330000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1071, 31, 90, NULL, NULL, 54.00, NULL, 110000.00, 360000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1072, 31, 94, NULL, NULL, 2.00, NULL, 30000.00, 360000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1073, 31, 94, NULL, NULL, 1.00, NULL, 30000.00, 360000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1074, 31, 94, NULL, NULL, 1.00, NULL, 30000.00, 360000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1075, 31, 94, NULL, NULL, 3.00, NULL, 30000.00, 360000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1076, 31, 97, NULL, NULL, 54.00, NULL, 360000.00, 490000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1077, 31, 100, NULL, NULL, 2.00, NULL, 540000.00, 70000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1078, 31, 101, NULL, NULL, 1.00, NULL, 570000.00, 330000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1079, 31, 101, NULL, NULL, 1.00, NULL, 570000.00, 330000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1080, 31, 109, NULL, NULL, 1.00, NULL, 820000.00, 480000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1081, 31, 113, NULL, NULL, 1.00, NULL, 610000.00, 180000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1082, 31, 116, NULL, NULL, 1.00, NULL, 790000.00, 160000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1083, 31, 117, NULL, NULL, 1.00, NULL, 190000.00, 350000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1084, 31, 118, NULL, NULL, 2.00, NULL, 410000.00, 130000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1085, 31, 119, NULL, NULL, 1.00, NULL, 840000.00, 470000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1086, 31, 121, NULL, NULL, 114.00, NULL, 770000.00, 360000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1087, 31, 122, NULL, NULL, 1.00, NULL, 40000.00, 220000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1088, 31, 123, NULL, NULL, 9.00, NULL, 660000.00, 460000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1089, 31, 125, NULL, NULL, 124.00, NULL, 270000.00, 380000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1090, 31, 121, NULL, NULL, 74.00, NULL, 770000.00, 360000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1091, 31, 125, NULL, NULL, 74.00, NULL, 270000.00, 380000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1092, 31, 206, NULL, NULL, 0.00, NULL, 370000.00, 70000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1093, 31, 131, NULL, NULL, 0.00, NULL, 60000.00, 80000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1094, 31, 134, NULL, NULL, 0.00, NULL, 280000.00, 190000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1095, 31, 135, NULL, NULL, 0.00, NULL, 470000.00, 150000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1096, 31, 136, NULL, NULL, 0.00, NULL, 550000.00, 10000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1097, 31, 137, NULL, NULL, 0.00, NULL, 610000.00, 280000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1098, 31, 138, NULL, NULL, 0.00, NULL, 270000.00, 120000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1099, 31, 139, NULL, NULL, 0.00, NULL, 850000.00, 340000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1100, 31, 140, NULL, NULL, 1.00, NULL, 470000.00, 200000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1101, 31, 257, NULL, NULL, 0.00, NULL, 40000.00, 40000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1102, 31, 142, NULL, NULL, 0.00, NULL, 280000.00, 220000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1103, 31, 260, NULL, NULL, 0.00, NULL, 370000.00, 400000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1104, 31, 143, NULL, NULL, 0.00, NULL, 90000.00, 370000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1105, 31, 206, NULL, NULL, 0.00, NULL, 370000.00, 70000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1106, 31, 144, NULL, NULL, 0.00, NULL, 740000.00, 370000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1107, 31, 144, NULL, NULL, 0.00, NULL, 740000.00, 370000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1108, 31, 146, NULL, NULL, 0.00, NULL, 820000.00, 320000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1109, 31, 116, NULL, NULL, 2.00, NULL, 790000.00, 160000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1110, 31, 148, NULL, NULL, 0.00, NULL, 410000.00, 170000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1111, 31, 150, NULL, NULL, 3.00, NULL, 870000.00, 340000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1112, 31, 151, NULL, NULL, 1.00, NULL, 400000.00, 330000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1113, 31, 151, NULL, NULL, 1.00, NULL, 400000.00, 330000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1114, 31, 151, NULL, NULL, 2.00, NULL, 400000.00, 330000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1115, 31, 151, NULL, NULL, 2.00, NULL, 400000.00, 330000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1116, 31, 155, NULL, NULL, 1.00, NULL, 920000.00, 410000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1117, 31, 156, NULL, NULL, 0.00, NULL, 330000.00, 210000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1118, 31, 157, NULL, NULL, 0.00, NULL, 900000.00, 90000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1119, 31, 158, NULL, NULL, 0.00, NULL, 710000.00, 460000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1120, 31, 146, NULL, NULL, 0.00, NULL, 820000.00, 320000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1121, 31, 159, NULL, NULL, 20.00, NULL, 630000.00, 60000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1122, 31, 268, NULL, NULL, 4.00, NULL, 760000.00, 230000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1123, 31, 208, NULL, NULL, 18.00, NULL, 790000.00, 50000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1124, 31, 209, NULL, NULL, 1.00, NULL, 810000.00, 320000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1125, 31, 161, NULL, NULL, 16.00, NULL, 80000.00, 300000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1126, 31, 162, NULL, NULL, 9.00, NULL, 460000.00, 150000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1127, 31, 166, NULL, NULL, 84.00, NULL, 730000.00, 290000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1128, 31, 155, NULL, NULL, 1.00, NULL, 920000.00, 410000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1129, 31, 156, NULL, NULL, 0.00, NULL, 330000.00, 210000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1130, 31, 157, NULL, NULL, 0.00, NULL, 900000.00, 90000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1131, 31, 158, NULL, NULL, 0.00, NULL, 710000.00, 460000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1132, 31, 146, NULL, NULL, 0.00, NULL, 820000.00, 320000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1133, 31, 159, NULL, NULL, 126.00, NULL, 630000.00, 60000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1134, 31, 268, NULL, NULL, 4.00, NULL, 760000.00, 230000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1135, 31, 208, NULL, NULL, 57.00, NULL, 790000.00, 50000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1136, 31, 209, NULL, NULL, 2.00, NULL, 810000.00, 320000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1137, 31, 161, NULL, NULL, 1.00, NULL, 80000.00, 300000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1138, 31, 162, NULL, NULL, 5.00, NULL, 460000.00, 150000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1139, 31, 166, NULL, NULL, 200.00, NULL, 730000.00, 290000.00, '2026-06-14 23:39:57', '2026-06-14 23:39:57'),
(1140, 32, 271, NULL, NULL, 4.00, NULL, 310000.00, 460000.00, '2026-06-15 00:40:41', '2026-06-15 00:41:33'),
(1141, 32, 211, NULL, NULL, 5.00, NULL, 920000.00, 70000.00, '2026-06-15 00:40:41', '2026-06-15 00:41:04'),
(1142, 32, 213, NULL, NULL, 3.00, NULL, 950000.00, 170000.00, '2026-06-15 00:40:41', '2026-06-15 00:41:09'),
(1143, 32, 274, NULL, NULL, 8.00, NULL, 40000.00, 240000.00, '2026-06-15 00:40:41', '2026-06-15 00:41:15'),
(1144, 32, 216, NULL, NULL, 5.00, NULL, 500000.00, 440000.00, '2026-06-15 00:40:41', '2026-06-15 00:40:59'),
(1145, 32, 217, NULL, NULL, 2.00, NULL, 440000.00, 190000.00, '2026-06-15 00:40:41', '2026-06-15 00:41:25'),
(1146, 32, 218, NULL, NULL, 4.00, NULL, 500000.00, 300000.00, '2026-06-15 00:40:41', '2026-06-15 00:40:53'),
(1147, 32, 216, NULL, NULL, 5.00, NULL, 500000.00, 440000.00, '2026-06-15 00:40:41', '2026-06-15 00:40:41'),
(1148, 33, 84, NULL, NULL, 1.00, 1.00, 780000.00, 400000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1149, 33, 85, NULL, NULL, 1.00, 1.00, 710000.00, 340000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1150, 33, 88, NULL, NULL, 0.00, 0.00, 300000.00, 160000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1151, 33, 88, NULL, NULL, 0.00, 0.00, 300000.00, 160000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1152, 33, 88, NULL, NULL, 1.00, 1.00, 300000.00, 160000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1153, 33, 88, NULL, NULL, 1.00, 1.00, 300000.00, 160000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1154, 33, 90, NULL, NULL, 76.00, 76.00, 110000.00, 360000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1155, 33, 91, NULL, NULL, 19.00, 19.00, 630000.00, 30000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1156, 33, 92, NULL, NULL, 17.00, 17.00, 940000.00, 460000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1157, 33, 94, NULL, NULL, 2.00, 2.00, 30000.00, 360000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1158, 33, 94, NULL, NULL, 1.00, 1.00, 30000.00, 360000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1159, 33, 94, NULL, NULL, 1.00, 1.00, 30000.00, 360000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1160, 33, 94, NULL, NULL, 5.00, 5.00, 30000.00, 360000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1161, 33, 97, NULL, NULL, 76.00, 76.00, 360000.00, 490000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1162, 33, 98, NULL, NULL, 19.00, 19.00, 530000.00, 180000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1163, 33, 99, NULL, NULL, 17.00, 17.00, 930000.00, 260000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1164, 33, 100, NULL, NULL, 2.00, 2.00, 540000.00, 70000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1165, 33, 101, NULL, NULL, 1.00, 1.00, 570000.00, 330000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1166, 33, 101, NULL, NULL, 1.00, 1.00, 570000.00, 330000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1167, 33, 90, NULL, NULL, 54.00, 54.00, 110000.00, 360000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1168, 33, 94, NULL, NULL, 2.00, 2.00, 30000.00, 360000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1169, 33, 94, NULL, NULL, 1.00, 1.00, 30000.00, 360000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1170, 33, 94, NULL, NULL, 1.00, 1.00, 30000.00, 360000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1171, 33, 94, NULL, NULL, 3.00, 3.00, 30000.00, 360000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1172, 33, 97, NULL, NULL, 54.00, 54.00, 360000.00, 490000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1173, 33, 100, NULL, NULL, 2.00, 2.00, 540000.00, 70000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1174, 33, 101, NULL, NULL, 1.00, 1.00, 570000.00, 330000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1175, 33, 101, NULL, NULL, 1.00, 1.00, 570000.00, 330000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1176, 33, 109, NULL, NULL, 1.00, 1.00, 820000.00, 480000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1177, 33, 113, NULL, NULL, 1.00, 1.00, 610000.00, 180000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1178, 33, 116, NULL, NULL, 1.00, 1.00, 790000.00, 160000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1179, 33, 117, NULL, NULL, 1.00, 1.00, 190000.00, 350000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1180, 33, 118, NULL, NULL, 2.00, 2.00, 410000.00, 130000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1181, 33, 119, NULL, NULL, 1.00, 1.00, 840000.00, 470000.00, '2026-06-15 14:25:45', '2026-06-15 14:27:00'),
(1182, 33, 121, NULL, NULL, 114.00, 114.00, 770000.00, 360000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1183, 33, 122, NULL, NULL, 1.00, 1.00, 40000.00, 220000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1184, 33, 123, NULL, NULL, 9.00, 9.00, 660000.00, 460000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1185, 33, 125, NULL, NULL, 124.00, 124.00, 270000.00, 380000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1186, 33, 121, NULL, NULL, 74.00, 74.00, 770000.00, 360000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1187, 33, 125, NULL, NULL, 74.00, 74.00, 270000.00, 380000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1188, 33, 206, NULL, NULL, 0.00, 0.00, 370000.00, 70000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1189, 33, 131, NULL, NULL, 0.00, 0.00, 60000.00, 80000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1190, 33, 134, NULL, NULL, 0.00, 0.00, 280000.00, 190000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1191, 33, 135, NULL, NULL, 0.00, 0.00, 470000.00, 150000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1192, 33, 136, NULL, NULL, 0.00, 0.00, 550000.00, 10000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1193, 33, 137, NULL, NULL, 0.00, 0.00, 610000.00, 280000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1194, 33, 138, NULL, NULL, 0.00, 0.00, 270000.00, 120000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1195, 33, 139, NULL, NULL, 0.00, 0.00, 850000.00, 340000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1196, 33, 140, NULL, NULL, 1.00, 1.00, 470000.00, 200000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1197, 33, 257, NULL, NULL, 0.00, 0.00, 40000.00, 40000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1198, 33, 142, NULL, NULL, 0.00, 0.00, 280000.00, 220000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1199, 33, 260, NULL, NULL, 0.00, 0.00, 370000.00, 400000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1200, 33, 143, NULL, NULL, 0.00, 0.00, 90000.00, 370000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1201, 33, 206, NULL, NULL, 0.00, 0.00, 370000.00, 70000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1202, 33, 144, NULL, NULL, 0.00, 0.00, 740000.00, 370000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1203, 33, 144, NULL, NULL, 0.00, 0.00, 740000.00, 370000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1204, 33, 146, NULL, NULL, 0.00, 0.00, 820000.00, 320000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1205, 33, 116, NULL, NULL, 2.00, 2.00, 790000.00, 160000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1206, 33, 148, NULL, NULL, 0.00, 0.00, 410000.00, 170000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1207, 33, 150, NULL, NULL, 3.00, 3.00, 870000.00, 340000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1208, 33, 151, NULL, NULL, 1.00, 1.00, 400000.00, 330000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1209, 33, 151, NULL, NULL, 1.00, 1.00, 400000.00, 330000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1210, 33, 151, NULL, NULL, 2.00, 2.00, 400000.00, 330000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1211, 33, 151, NULL, NULL, 2.00, 2.00, 400000.00, 330000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1212, 33, 155, NULL, NULL, 1.00, 1.00, 920000.00, 410000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1213, 33, 156, NULL, NULL, 0.00, 0.00, 330000.00, 210000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1214, 33, 157, NULL, NULL, 0.00, 0.00, 900000.00, 90000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1215, 33, 158, NULL, NULL, 0.00, 0.00, 710000.00, 460000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1216, 33, 146, NULL, NULL, 0.00, 0.00, 820000.00, 320000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1217, 33, 159, NULL, NULL, 20.00, 20.00, 630000.00, 60000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1218, 33, 268, NULL, NULL, 4.00, 4.00, 760000.00, 230000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1219, 33, 208, NULL, NULL, 18.00, 18.00, 790000.00, 50000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1220, 33, 209, NULL, NULL, 1.00, 1.00, 810000.00, 320000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1221, 33, 161, NULL, NULL, 16.00, 16.00, 80000.00, 300000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1222, 33, 162, NULL, NULL, 9.00, 9.00, 460000.00, 150000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1223, 33, 166, NULL, NULL, 84.00, 84.00, 730000.00, 290000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1224, 33, 155, NULL, NULL, 1.00, 1.00, 920000.00, 410000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1225, 33, 156, NULL, NULL, 0.00, 0.00, 330000.00, 210000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1226, 33, 157, NULL, NULL, 0.00, 0.00, 900000.00, 90000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1227, 33, 158, NULL, NULL, 0.00, 0.00, 710000.00, 460000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1228, 33, 146, NULL, NULL, 0.00, 0.00, 820000.00, 320000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1229, 33, 159, NULL, NULL, 126.00, 126.00, 630000.00, 60000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1230, 33, 268, NULL, NULL, 4.00, 4.00, 760000.00, 230000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1231, 33, 208, NULL, NULL, 57.00, 57.00, 790000.00, 50000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1232, 33, 209, NULL, NULL, 2.00, 2.00, 810000.00, 320000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1233, 33, 161, NULL, NULL, 1.00, 1.00, 80000.00, 300000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1234, 33, 162, NULL, NULL, 5.00, 5.00, 460000.00, 150000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1235, 33, 166, NULL, NULL, 200.00, 200.00, 730000.00, 290000.00, '2026-06-15 14:25:46', '2026-06-15 14:27:00'),
(1236, 34, 84, NULL, NULL, 1.00, 1.00, 780000.00, 400000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1237, 34, 85, NULL, NULL, 1.00, 1.00, 710000.00, 340000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1238, 34, 88, NULL, NULL, 0.00, 0.00, 300000.00, 160000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1239, 34, 88, NULL, NULL, 0.00, 0.00, 300000.00, 160000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1240, 34, 88, NULL, NULL, 1.00, 1.00, 300000.00, 160000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1241, 34, 88, NULL, NULL, 1.00, 1.00, 300000.00, 160000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1242, 34, 90, NULL, NULL, 76.00, 76.00, 110000.00, 360000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1243, 34, 91, NULL, NULL, 19.00, 19.00, 630000.00, 30000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1244, 34, 92, NULL, NULL, 17.00, 17.00, 940000.00, 460000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1245, 34, 94, NULL, NULL, 2.00, 2.00, 30000.00, 360000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1246, 34, 94, NULL, NULL, 1.00, 1.00, 30000.00, 360000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1247, 34, 94, NULL, NULL, 1.00, 1.00, 30000.00, 360000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1248, 34, 94, NULL, NULL, 5.00, 5.00, 30000.00, 360000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1249, 34, 97, NULL, NULL, 76.00, 76.00, 360000.00, 490000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1250, 34, 98, NULL, NULL, 19.00, 19.00, 530000.00, 180000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1251, 34, 99, NULL, NULL, 17.00, 17.00, 930000.00, 260000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1252, 34, 100, NULL, NULL, 2.00, 2.00, 540000.00, 70000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1253, 34, 101, NULL, NULL, 1.00, 1.00, 570000.00, 330000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1254, 34, 101, NULL, NULL, 1.00, 1.00, 570000.00, 330000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1255, 34, 90, NULL, NULL, 54.00, 54.00, 110000.00, 360000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1256, 34, 94, NULL, NULL, 2.00, 2.00, 30000.00, 360000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1257, 34, 94, NULL, NULL, 1.00, 1.00, 30000.00, 360000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1258, 34, 94, NULL, NULL, 1.00, 1.00, 30000.00, 360000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1259, 34, 94, NULL, NULL, 3.00, 3.00, 30000.00, 360000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1260, 34, 97, NULL, NULL, 54.00, 54.00, 360000.00, 490000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1261, 34, 100, NULL, NULL, 2.00, 2.00, 540000.00, 70000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1262, 34, 101, NULL, NULL, 1.00, 1.00, 570000.00, 330000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1263, 34, 101, NULL, NULL, 1.00, 1.00, 570000.00, 330000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1264, 34, 109, NULL, NULL, 1.00, 1.00, 820000.00, 480000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1265, 34, 113, NULL, NULL, 1.00, 1.00, 610000.00, 180000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1266, 34, 116, NULL, NULL, 1.00, 1.00, 790000.00, 160000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1267, 34, 117, NULL, NULL, 1.00, 1.00, 190000.00, 350000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1268, 34, 118, NULL, NULL, 2.00, 2.00, 410000.00, 130000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1269, 34, 119, NULL, NULL, 1.00, 1.00, 840000.00, 470000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1270, 34, 121, NULL, NULL, 114.00, 114.00, 770000.00, 360000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1271, 34, 122, NULL, NULL, 1.00, 1.00, 40000.00, 220000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1272, 34, 123, NULL, NULL, 9.00, 9.00, 660000.00, 460000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1273, 34, 125, NULL, NULL, 124.00, 124.00, 270000.00, 380000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1274, 34, 121, NULL, NULL, 74.00, 74.00, 770000.00, 360000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1275, 34, 125, NULL, NULL, 74.00, 74.00, 270000.00, 380000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1276, 34, 206, NULL, NULL, 0.00, 0.00, 370000.00, 70000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1277, 34, 131, NULL, NULL, 0.00, 0.00, 60000.00, 80000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1278, 34, 134, NULL, NULL, 0.00, 0.00, 280000.00, 190000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1279, 34, 135, NULL, NULL, 0.00, 0.00, 470000.00, 150000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1280, 34, 136, NULL, NULL, 0.00, 0.00, 550000.00, 10000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1281, 34, 137, NULL, NULL, 0.00, 0.00, 610000.00, 280000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1282, 34, 138, NULL, NULL, 0.00, 0.00, 270000.00, 120000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1283, 34, 139, NULL, NULL, 0.00, 0.00, 850000.00, 340000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1284, 34, 140, NULL, NULL, 1.00, 1.00, 470000.00, 200000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1285, 34, 257, NULL, NULL, 0.00, 0.00, 40000.00, 40000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1286, 34, 142, NULL, NULL, 0.00, 0.00, 280000.00, 220000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1287, 34, 260, NULL, NULL, 0.00, 0.00, 370000.00, 400000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1288, 34, 143, NULL, NULL, 0.00, 0.00, 90000.00, 370000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1289, 34, 206, NULL, NULL, 0.00, 0.00, 370000.00, 70000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1290, 34, 144, NULL, NULL, 0.00, 0.00, 740000.00, 370000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1291, 34, 144, NULL, NULL, 0.00, 0.00, 740000.00, 370000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1292, 34, 146, NULL, NULL, 0.00, 0.00, 820000.00, 320000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1293, 34, 116, NULL, NULL, 2.00, 2.00, 790000.00, 160000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1294, 34, 148, NULL, NULL, 0.00, 0.00, 410000.00, 170000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1295, 34, 150, NULL, NULL, 3.00, 3.00, 870000.00, 340000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1296, 34, 151, NULL, NULL, 1.00, 1.00, 400000.00, 330000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1297, 34, 151, NULL, NULL, 1.00, 1.00, 400000.00, 330000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1298, 34, 151, NULL, NULL, 2.00, 2.00, 400000.00, 330000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1299, 34, 151, NULL, NULL, 2.00, 2.00, 400000.00, 330000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1300, 34, 155, NULL, NULL, 1.00, 1.00, 920000.00, 410000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1301, 34, 156, NULL, NULL, 0.00, 0.00, 330000.00, 210000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1302, 34, 157, NULL, NULL, 0.00, 0.00, 900000.00, 90000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1303, 34, 158, NULL, NULL, 0.00, 0.00, 710000.00, 460000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1304, 34, 146, NULL, NULL, 0.00, 0.00, 820000.00, 320000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1305, 34, 159, NULL, NULL, 20.00, 20.00, 630000.00, 60000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1306, 34, 268, NULL, NULL, 4.00, 4.00, 760000.00, 230000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1307, 34, 208, NULL, NULL, 18.00, 18.00, 790000.00, 50000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1308, 34, 209, NULL, NULL, 1.00, 1.00, 810000.00, 320000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1309, 34, 161, NULL, NULL, 16.00, 16.00, 80000.00, 300000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1310, 34, 162, NULL, NULL, 9.00, 9.00, 460000.00, 150000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1311, 34, 166, NULL, NULL, 84.00, 84.00, 730000.00, 290000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1312, 34, 155, NULL, NULL, 1.00, 1.00, 920000.00, 410000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1313, 34, 156, NULL, NULL, 0.00, 0.00, 330000.00, 210000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1314, 34, 157, NULL, NULL, 0.00, 0.00, 900000.00, 90000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1315, 34, 158, NULL, NULL, 0.00, 0.00, 710000.00, 460000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1316, 34, 146, NULL, NULL, 0.00, 0.00, 820000.00, 320000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1317, 34, 159, NULL, NULL, 126.00, 126.00, 630000.00, 60000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1318, 34, 268, NULL, NULL, 4.00, 4.00, 760000.00, 230000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1319, 34, 208, NULL, NULL, 57.00, 57.00, 790000.00, 50000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1320, 34, 209, NULL, NULL, 2.00, 2.00, 810000.00, 320000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1321, 34, 161, NULL, NULL, 1.00, 1.00, 80000.00, 300000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1322, 34, 162, NULL, NULL, 5.00, 5.00, 460000.00, 150000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04'),
(1323, 34, 166, NULL, NULL, 200.00, 200.00, 730000.00, 290000.00, '2026-06-15 17:57:04', '2026-06-15 17:57:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_boq_header`
--

CREATE TABLE `tb_boq_header` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proyek_id` bigint(20) UNSIGNED NOT NULL,
  `nomor_surat` varchar(100) NOT NULL,
  `versi_revisi` varchar(10) NOT NULL DEFAULT 'Rev 0',
  `status_approval` enum('Draft','Pending','Approved','Rejected') NOT NULL DEFAULT 'Draft',
  `file_bukti_lapangan` varchar(255) DEFAULT NULL COMMENT 'File PDF/Gambar bukti verifikasi lapangan',
  `catatan_sitemanager` text DEFAULT NULL COMMENT 'Catatan tambahan dari Site Manager saat verifikasi',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_client_approved` tinyint(1) NOT NULL DEFAULT 0,
  `client_approved_at` timestamp NULL DEFAULT NULL,
  `client_approved_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_boq_header`
--

INSERT INTO `tb_boq_header` (`id`, `proyek_id`, `nomor_surat`, `versi_revisi`, `status_approval`, `file_bukti_lapangan`, `catatan_sitemanager`, `created_at`, `updated_at`, `is_client_approved`, `client_approved_at`, `client_approved_by`) VALUES
(1, 1, 'BOQ-6A19D64E9A890', 'Rev 0', 'Approved', NULL, NULL, '2026-05-30 01:09:18', '2026-06-15 09:16:38', 1, '2026-06-14 19:16:38', 4),
(4, 2, 'BOQ-6A1FDE8884CB1', 'Rev 0', 'Approved', 'bukti_lapangan/bukti_lapangan_4_1780473681.png', 'tidak sesuai untuk lt 15', '2026-06-03 14:58:00', '2026-06-03 15:01:23', 0, NULL, NULL),
(5, 3, 'BOQ-6A1FE36571A8B', 'Rev 0', 'Approved', 'bukti_lapangan/bukti_lapangan_5_1781457190.pdf', 'banyak yg harus di rubah ini pak', '2026-06-03 15:18:45', '2026-06-15 00:13:10', 0, NULL, NULL),
(7, 4, 'BOQ-6A1FE8B025F05', 'Rev 0', 'Approved', 'bukti_lapangan/bukti_lapangan_7_1780476725.pdf', NULL, '2026-06-03 15:41:20', '2026-06-03 15:52:06', 0, NULL, NULL),
(30, 3, 'BOQ-6A2F2F0522C69', 'Rev 1', 'Approved', 'bukti_lapangan/bukti_lapangan_30_1781477354.png', NULL, '2026-06-14 22:45:25', '2026-06-14 22:49:14', 0, NULL, NULL),
(31, 4, 'BOQ-6A2F3BC842CFE', 'Rev 1', 'Draft', NULL, NULL, '2026-06-14 23:39:52', '2026-06-14 23:39:52', 0, NULL, NULL),
(32, 2, 'BOQ-6A2F4A0611C21', 'Rev 1', 'Pending', NULL, NULL, '2026-06-15 00:40:38', '2026-06-15 00:41:51', 0, NULL, NULL),
(33, 5, 'BOQ-6A300B622D826', 'Rev 0', 'Approved', 'bukti_lapangan/bukti_lapangan_33_1781533620.png', NULL, '2026-06-15 14:25:38', '2026-06-15 14:27:01', 0, NULL, NULL),
(34, 5, 'BOQ-6A300B622D826', 'Rev 1', 'Draft', NULL, NULL, '2026-06-15 17:57:04', '2026-06-15 17:57:04', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_change_requests`
--

CREATE TABLE `tb_change_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proyek_id` bigint(20) UNSIGNED NOT NULL,
  `klien_id` bigint(20) UNSIGNED NOT NULL,
  `diajukan_oleh` bigint(20) UNSIGNED NOT NULL,
  `subjek` varchar(255) NOT NULL,
  `deskripsi_perubahan` text NOT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Diproses','Selesai','Ditolak') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_change_requests`
--

INSERT INTO `tb_change_requests` (`id`, `proyek_id`, `klien_id`, `diajukan_oleh`, `subjek`, `deskripsi_perubahan`, `lampiran`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 5, 6, 'cctv', 'cctv di lantai 2 5 aja jangan 7', NULL, 'Diproses', '2026-06-15 14:28:11', '2026-06-15 17:57:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kendala_lapangan`
--

CREATE TABLE `tb_kendala_lapangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proyek_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `judul_kendala` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto_kendala` varchar(255) DEFAULT NULL,
  `status` enum('Open','Resolved') NOT NULL DEFAULT 'Open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_klien`
--

CREATE TABLE `tb_klien` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `kontak_person` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_klien`
--

INSERT INTO `tb_klien` (`id`, `nama_perusahaan`, `alamat`, `kontak_person`, `telepon`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PT. Maju Mundur Kena', 'Jl. Kebahagiaan No. 123, Jakarta', 'Bpk. Budi', NULL, '2026-05-30 00:57:41', '2026-05-30 00:57:41', NULL),
(2, 'pt jasjjajsa', 'cascas', 'asfas', '012947190271', '2026-06-03 14:46:11', '2026-06-03 14:46:11', NULL),
(3, 'pt hsadhbas', 'ahsdbasd', 'asdasd', '105281591124', '2026-06-03 15:17:48', '2026-06-03 15:17:48', NULL),
(4, 'pt man', 'cnd', 'sman', '0128491721', '2026-06-03 15:29:32', '2026-06-03 15:29:32', NULL),
(5, 'PT garmit', 'karawang', 'xiao yan', '087654632214', '2026-06-15 02:54:22', '2026-06-15 02:54:22', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_laporan_harian`
--

CREATE TABLE `tb_laporan_harian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proyek_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `cuaca` enum('Cerah','Berawan','Gerimis','Hujan Lebat') NOT NULL,
  `jumlah_pekerja` int(11) NOT NULL,
  `kegiatan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_laporan_harian`
--

INSERT INTO `tb_laporan_harian` (`id`, `proyek_id`, `user_id`, `tanggal`, `cuaca`, `jumlah_pekerja`, `kegiatan`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2026-06-10', 'Hujan Lebat', 2, 'Jam 08:00 - 14:00 cuaca cerah, tim berhasil menyelesaikan penarikan kabel lantai 1. Namun jam 14:00 turun hujan deras sehingga sisa pekerjaan luar terpaksa dihentikan lebih awal dan pekerja dialihkan merapikan material di gudang.', '2026-06-14 18:11:03', '2026-06-14 18:11:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_master_barang_jasa`
--

CREATE TABLE `tb_master_barang_jasa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  `tipe` varchar(255) DEFAULT NULL,
  `harga_material` decimal(15,2) NOT NULL DEFAULT 0.00,
  `harga_jasa` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_master_barang_jasa`
--

INSERT INTO `tb_master_barang_jasa` (`id`, `kode_barang`, `nama_barang`, `satuan`, `tipe`, `harga_material`, `harga_jasa`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'BRG-01', 'Kabel UTP Cat6', 'Roll', 'Material', 650000.00, 0.00, '2026-05-30 00:57:43', '2026-06-15 00:03:18', NULL),
(2, 'BRG-02', 'Switch Managed 24 Port', 'Unit', 'Material', 2500000.00, 0.00, '2026-05-30 00:57:43', '2026-06-15 00:03:26', NULL),
(3, 'JSA-01', 'Jasa Instalasi Jaringan LAN', 'Titik', 'Jasa', 0.00, 150000.00, '2026-05-30 00:57:43', '2026-06-15 00:03:39', NULL),
(4, 'BRG-03', 'Access Point WiFi 6', 'Unit', 'Material', 1850000.00, 0.00, '2026-05-30 00:57:43', '2026-06-15 00:03:45', NULL),
(5, 'JSA-02', 'Jasa Konfigurasi Server', 'Unit', 'Jasa', 0.00, 750000.00, '2026-05-30 00:57:43', '2026-06-15 00:03:51', NULL),
(6, 'JSA-FA01', 'Jasa Penarikan Kabel & Instalasi Titik Fire Alarm', 'Titik', 'Jasa', 0.00, 75000.00, '2026-06-03 15:48:09', '2026-06-15 00:03:58', NULL),
(7, 'brg 002', 'pvc', 'unit', 'Material', 50000.00, 0.00, '2026-06-14 23:53:25', '2026-06-15 00:04:03', NULL),
(8, 'MEP-PREP-01', 'Bobokan Dinding & Perapihan', 'm1', 'Jasa', 0.00, 35000.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(9, 'MEP-PREP-02', 'Pemasangan Scaffolding', 'Set', 'Jasa', 0.00, 150000.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(10, 'MEP-PREP-03', 'Sewa Scaffolding', 'Set/Bulan', 'Material', 75000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(11, 'ELC-KBL-001', 'Kabel NYA 1 x 1.5 mm2 Supreme', 'Roll', 'Material', 285000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(12, 'ELC-KBL-002', 'Kabel NYA 1 x 2.5 mm2 Supreme', 'Roll', 'Material', 425000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(13, 'ELC-KBL-003', 'Kabel NYM 3 x 1.5 mm2 Supreme', 'Roll', 'Material', 750000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(14, 'ELC-KBL-004', 'Kabel NYM 3 x 2.5 mm2 Supreme', 'Roll', 'Material', 980000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(15, 'ELC-KBL-005', 'Kabel NYY 4 x 4 mm2 Supreme', 'Meter', 'Material', 35000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(16, 'ELC-KBL-006', 'Kabel NYY 4 x 6 mm2 Supreme', 'Meter', 'Material', 48000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(17, 'ELC-AKM-001', 'Saklar Tunggal Broco', 'Pcs', 'Material', 18000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(18, 'ELC-AKM-002', 'Saklar Ganda Broco', 'Pcs', 'Material', 25000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(19, 'ELC-AKM-003', 'Stop Kontak Broco', 'Pcs', 'Material', 22000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(20, 'ELC-AKM-004', 'Stop Kontak AC Panasonic', 'Pcs', 'Material', 65000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(21, 'ELC-AKM-005', 'Pipa Conduit PVC 20mm Clipsal', 'Btg', 'Material', 15000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(22, 'ELC-AKM-006', 'T-Dus PVC / Inbow Dus', 'Pcs', 'Material', 3500.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(23, 'ELC-JSA-001', 'Jasa Instalasi Titik Lampu', 'Titik', 'Jasa', 0.00, 75000.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(24, 'ELC-JSA-002', 'Jasa Instalasi Stop Kontak', 'Titik', 'Jasa', 0.00, 75000.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(25, 'ELC-JSA-003', 'Jasa Penarikan Kabel NYY Panel Utama', 'Meter', 'Jasa', 0.00, 15000.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(26, 'ELC-PNL-001', 'MCB 1 Phase 10A Schneider', 'Pcs', 'Material', 55000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(27, 'ELC-PNL-002', 'MCB 1 Phase 16A Schneider', 'Pcs', 'Material', 55000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(28, 'ELC-PNL-003', 'MCB 3 Phase 32A Schneider', 'Pcs', 'Material', 215000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(29, 'ELC-PNL-004', 'Box Panel 40x60x20 cm Powder Coating', 'Unit', 'Material', 450000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(30, 'ELC-PNL-005', 'Jasa Rakit & Pemasangan Panel Listrik', 'Unit', 'Jasa', 0.00, 850000.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(31, 'PLM-PIP-001', 'Pipa PVC AW 1/2 inch Wavin', 'Btg', 'Material', 28000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(32, 'PLM-PIP-002', 'Pipa PVC AW 3/4 inch Wavin', 'Btg', 'Material', 35000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(33, 'PLM-PIP-003', 'Pipa PVC AW 4 inch Wavin (Air Kotor)', 'Btg', 'Material', 185000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(34, 'PLM-PIP-004', 'Lem Pipa Isarplas', 'Tube', 'Material', 12000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(35, 'PLM-PIP-005', 'Knee PVC 1/2 inch', 'Pcs', 'Material', 3500.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(36, 'PLM-PIP-006', 'Tee PVC 1/2 inch', 'Pcs', 'Material', 4500.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(37, 'PLM-SNT-001', 'Kloset Duduk Toto CW421J', 'Unit', 'Material', 2100000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(38, 'PLM-SNT-002', 'Wastafel Toto LW236CJ', 'Unit', 'Material', 850000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(39, 'PLM-SNT-003', 'Pompa Air Shimizu PS-135 E', 'Unit', 'Material', 650000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(40, 'PLM-SNT-004', 'Tangki Air Penguin 1000L', 'Unit', 'Material', 1850000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(41, 'PLM-JSA-001', 'Jasa Instalasi Pipa Air Bersih', 'Meter', 'Jasa', 0.00, 25000.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(42, 'PLM-JSA-002', 'Jasa Instalasi Pipa Air Kotor', 'Meter', 'Jasa', 0.00, 35000.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(43, 'PLM-JSA-003', 'Jasa Pemasangan Kloset', 'Unit', 'Jasa', 0.00, 250000.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(44, 'PLM-JSA-004', 'Jasa Pemasangan Pompa & Tangki', 'Lot', 'Jasa', 0.00, 450000.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(45, 'MCH-VAC-001', 'AC Split Daikin 1 PK Standard', 'Unit', 'Material', 3800000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(46, 'MCH-VAC-002', 'AC Split Daikin 2 PK Inverter', 'Unit', 'Material', 7500000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(47, 'MCH-VAC-003', 'Pipa Tembaga AC 1/4 x 3/8 (Roll 30m)', 'Roll', 'Material', 850000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(48, 'MCH-VAC-004', 'Kabel Kontrol AC NYMHY 3x1.5 (Meter)', 'Meter', 'Material', 12000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(49, 'MCH-VAC-005', 'Braket AC Outdoor Tebal', 'Set', 'Material', 45000.00, 0.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(50, 'MCH-JSA-001', 'Jasa Pemasangan AC Split 1 PK', 'Unit', 'Jasa', 0.00, 350000.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(51, 'MCH-JSA-002', 'Jasa Pemasangan AC Split 2 PK', 'Unit', 'Jasa', 0.00, 450000.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(52, 'MCH-JSA-003', 'Jasa Instalasi Pipa Tembaga (per Meter)', 'Meter', 'Jasa', 0.00, 25000.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(53, 'MCH-JSA-004', 'Jasa Vakum & Isi Freon R32', 'Unit', 'Jasa', 0.00, 250000.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(54, 'MEP-TST-001', 'Testing & Commissioning Elektrikal', 'Lot', 'Jasa', 0.00, 1500000.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(55, 'MEP-TST-002', 'Testing & Commissioning Plumbing (Test Tekan)', 'Lot', 'Jasa', 0.00, 1000000.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(56, 'MEP-MOB-001', 'Mobilisasi & Demobilisasi Alat', 'Lot', 'Jasa', 0.00, 2500000.00, '2026-06-15 03:46:35', '2026-06-15 03:46:35', NULL),
(84, 'BR-2A5D83', 'JBFA c/w Module', 'Unit', 'Material', 780000.00, 400000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(85, 'BR-3734C1', '- UPS FA & TS kap. 4 kVA Batt 4 jam', 'Unit', 'Material', 710000.00, 340000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(88, 'BR-2D9728', 'FA-Kabel', 'Roll', 'Material', 300000.00, 160000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(90, 'BR-EBBB6E', 'Photoelectric Smoke Detector', 'Unit', 'Material', 110000.00, 360000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(91, 'BR-FBFC33', 'Fixed Temperature Heat Detector', 'Unit', 'Material', 630000.00, 30000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(92, 'BR-EE8923', 'Gas Detector', 'Unit', 'Material', 940000.00, 460000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(94, 'BR-1D292F', 'FA-Detector', 'Unit', 'Material', 30000.00, 360000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(95, 'BR-1290E1', 'Tamper Switch', 'Unit', 'Material', 200000.00, 200000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(97, 'BR-D44D50', 'Kabel 4x 2x(NYA 1,5mm2) untuk Photoelectric Smoke Detector', 'Roll', 'Material', 360000.00, 490000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(98, 'BR-515271', 'Kabel 5x 2x(NYA 1,5mm2) untuk Fixed Temperature Heat Detector', 'Roll', 'Material', 530000.00, 180000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(99, 'BR-8C45B5', 'Kabel 5x(FRC 4x1,5mm2) untuk Gas Detector', 'Roll', 'Material', 930000.00, 260000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(100, 'BR-74D1E2', 'Kabel 6x(FRC 2x1,5mm2) untuk Manual Push Button', 'Roll', 'Material', 540000.00, 70000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(101, 'BR-DA7F1A', 'Kabel 6x(FRC 2x1,5mm2) untuk Flow Switch', 'Roll', 'Material', 570000.00, 330000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(102, 'BR-13F22B', 'Kabel 6x(FRC 2x1,5mm2) untuk Tamper Switch', 'Roll', 'Material', 680000.00, 100000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(103, 'BR-98123E', 'Kabel 2xNYA 1,5mm2) untuk Photoelectric Smoke Detector', 'Roll', 'Material', 100000.00, 210000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(104, 'BR-CF4FBF', 'Kabel (FRC 2x1,5mm2) untuk Manual Push Button', 'Roll', 'Material', 700000.00, 140000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(105, 'BR-F5E407', 'Kabel (FRC 2x1,5mm2) untuk Flow Switch', 'Roll', 'Material', 590000.00, 150000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(106, 'BR-26D84F', 'Kabel (FRC 2x1,5mm2) untuk Tamper Switch', 'Roll', 'Material', 670000.00, 280000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(109, 'BR-C2B553', 'Speaker Selector 10 - CH', 'Unit', 'Material', 820000.00, 480000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(113, 'BR-9C86D9', 'COS (Change Over Switch)', 'Unit', 'Material', 610000.00, 180000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(116, 'BR-34E6D4', 'UPS 2 kVA (1P in/1P out)', 'Unit', 'Material', 790000.00, 160000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(117, 'BR-B01D1D', 'Kabel NYM 2x2,5mm2 From COS ke Speaker Selector 10 - CH', 'Roll', 'Material', 190000.00, 350000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(118, 'BR-B08F8F', 'Kabel NYM 2x2,5mm2 From UPS ke Power Amplifier', 'Roll', 'Material', 410000.00, 130000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(119, 'BR-BCEBC8', 'Kabel NYM 2x2,5mm2 From UPS ke Digital Mixer', 'Roll', 'Material', 840000.00, 470000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(121, 'BR-1C7339', 'Ceiling Speaker EVAC 3 Watt', 'Unit', 'Material', 770000.00, 360000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(122, 'BR-E93FDF', 'Wall Speaker EVAC 6 Watt', 'Unit', 'Material', 40000.00, 220000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(123, 'BR-A0012F', 'Horn Speaker EVAC 15 Watt', 'Unit', 'Material', 660000.00, 460000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(125, 'BR-54A193', 'Kabel NYMHY 2x1,5mm2', 'Roll', 'Material', 270000.00, 380000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(126, 'BR-29F651', 'Kabel (NYMHY 2x1,5mm2)', 'Roll', 'Material', 870000.00, 470000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(131, 'BR-0DF1AE', 'Switch L3 c/w SFP Module', 'Unit', 'Material', 60000.00, 80000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(134, 'BR-2BFB0B', 'Router Firewall VPN, Anti Virus IPS/IDS Endskripsi for Internet (IT Scoope)', 'Unit', 'Material', 280000.00, 190000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(135, 'BR-D8C4FA', 'Router Firewall For Manager System (IT Scoope)', 'Unit', 'Material', 470000.00, 150000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(136, 'BR-5EF25A', 'Router Firewall ADM Control Manager (IT Scoope)', 'Unit', 'Material', 550000.00, 10000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(137, 'BR-9FFE0F', 'Keyboard (IT Scoope)', 'Unit', 'Material', 610000.00, 280000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(138, 'BR-C095E7', 'Monitor  (IT Scoope)', 'Unit', 'Material', 270000.00, 120000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(139, 'BR-A8336E', 'Power Outlet 12 Port (IT Scoope)', 'Pcs', 'Material', 850000.00, 340000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(140, 'BR-8564D4', 'Rack Security  19 INCH 12 U', 'Unit', 'Material', 470000.00, 200000.00, '2026-06-15 03:54:33', '2026-06-15 03:54:33', NULL),
(142, 'BR-437BB1', 'Keyboard & Mouse', 'Unit', 'Material', 280000.00, 220000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(143, 'BR-4B08D4', 'Access Switch 24 Port', 'Unit', 'Material', 90000.00, 370000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(144, 'BR-4BCB1F', 'NVR 1 - 16 Chanel HDD 2x2 TB', 'Unit', 'Material', 740000.00, 370000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(145, 'BR-FB3D0C', 'NVR 2 - 16 Chanel HDD 2x2 TB', 'Unit', 'Material', 510000.00, 190000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(146, 'BR-84F7CB', 'Power Outlet 12 Port', 'Pcs', 'Material', 820000.00, 320000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(147, 'BR-B09242', 'UPS = 5 kVa 1P IN/OUT', 'Unit', 'Material', 110000.00, 390000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(148, 'BR-349F39', 'Grounding NYA 50 mm2, 1 Ohm', 'Ls', 'Material', 410000.00, 170000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(150, 'BR-628E58', 'TV Monitor (minim 40\")', 'Unit', 'Material', 870000.00, 340000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(151, 'BR-AF37BD', 'Kabel Kabel 6x(FO Multimode 4 core) From Server Data ke DATA, IPTV Switch 6x24 Port (PoE)', 'Roll', 'Material', 400000.00, 330000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(152, 'BR-F46E26', 'Kabel Kabel 3x(FO Multimode 4 core) From Server Data ke DATA, IPTV Switch 3x24 Port (PoE)', 'Roll', 'Material', 180000.00, 60000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(153, 'BR-ECE8C4', 'Kabel Kabel 2x(FO Multimode 4 core) From Server Data ke DATA, IPTV Switch 2x24 Port (PoE)', 'Roll', 'Material', 460000.00, 340000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(154, 'BR-007CAA', 'Kabel Kabel 1x(FO Multimode 4 core) From Server Data ke DATA, IPTV Switch 1x24 Port (PoE)', 'Roll', 'Material', 470000.00, 220000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(155, 'BR-E9D1A9', 'Rack Path Panel Wall Type', 'Unit', 'Material', 920000.00, 410000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(156, 'BR-AA89A7', 'Access Switch 2x24 port data, IPTV, Access point + Wire Management', 'Unit', 'Material', 330000.00, 210000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(157, 'BR-34C5DF', 'Access Switch 2x24 port Telepone + Wire Management', 'Unit', 'Material', 900000.00, 90000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(158, 'BR-9B911F', 'Access Switch 1x16 Port (PoE) For CCTV + Wire Management', 'Unit', 'Material', 710000.00, 460000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(159, 'BR-5DDCB5', 'Outlet Data', 'Pcs', 'Material', 630000.00, 60000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(161, 'BR-5EC526', 'Telephone Extention Wall Type', 'Ls', 'Material', 80000.00, 300000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(162, 'BR-953F68', 'Access Point Support PoE', 'Ls', 'Material', 460000.00, 150000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(166, 'BR-7B9195', 'Kabel UTP CAT 6, 4 Pairs', 'Roll', 'Material', 730000.00, 290000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(168, 'BR-B98995', 'Access Switch 6x24 port data, IPTV, Access point + Wire Management', 'Unit', 'Material', 980000.00, 160000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(169, 'BR-E6AB3A', 'Access Switch 3x24 port Telepone + Wire Management', 'Unit', 'Material', 220000.00, 350000.00, '2026-06-15 03:55:01', '2026-06-15 03:55:01', NULL),
(173, 'BR-A042A8', 'Fire Intercome', 'Ls', 'Material', 410000.00, 450000.00, '2026-06-15 03:55:48', '2026-06-15 03:55:48', NULL),
(174, 'BR-768C5C', 'Flasher Lamp', 'Pcs', 'Material', 600000.00, 200000.00, '2026-06-15 03:55:48', '2026-06-15 03:55:48', NULL),
(175, 'BR-332DA1', 'Kabel 6x(FRC 2x1,5mm2) untuk Alarm Bell', 'Roll', 'Material', 680000.00, 440000.00, '2026-06-15 03:55:48', '2026-06-15 03:55:48', NULL),
(176, 'BR-52AB53', 'Kabel 6x(FRC 2x1,5mm2) untuk Flasher Lamp', 'Roll', 'Material', 300000.00, 360000.00, '2026-06-15 03:55:48', '2026-06-15 03:55:48', NULL),
(177, 'BR-910577', 'Kabel ITC 1 Pair untuk Intercome', 'Roll', 'Material', 240000.00, 70000.00, '2026-06-15 03:55:48', '2026-06-15 03:55:48', NULL),
(178, 'BR-08C5FB', 'Rack Sound System 32U', 'Unit', 'Material', 200000.00, 320000.00, '2026-06-15 03:55:48', '2026-06-15 03:55:48', NULL),
(181, 'BR-1D0555', 'Smoke Detector', 'Unit', 'Material', 10000.00, 160000.00, '2026-06-15 03:55:50', '2026-06-15 03:55:50', NULL),
(182, 'BR-9195EE', 'Fix Heat Detector', 'Unit', 'Material', 780000.00, 370000.00, '2026-06-15 03:55:50', '2026-06-15 03:55:50', NULL),
(183, 'BR-CC04FA', 'Gas Detector Horing Lih', 'Unit', 'Material', 570000.00, 310000.00, '2026-06-15 03:55:50', '2026-06-15 03:55:50', NULL),
(185, 'BR-2759DB', 'Alarm Bell', 'Pcs', 'Material', 710000.00, 320000.00, '2026-06-15 03:55:50', '2026-06-15 03:55:50', NULL),
(187, 'BR-81A5C9', 'Mini Module', 'Unit', 'Material', 360000.00, 410000.00, '2026-06-15 03:55:50', '2026-06-15 03:55:50', NULL),
(188, 'BR-2AAE26', 'Control Module', 'Unit', 'Material', 560000.00, 340000.00, '2026-06-15 03:55:50', '2026-06-15 03:55:50', NULL),
(189, 'BR-7CE0CF', 'Relay Module', 'Unit', 'Material', 830000.00, 340000.00, '2026-06-15 03:55:50', '2026-06-15 03:55:50', NULL),
(190, 'BR-0B3B98', 'Isolotor Module', 'Unit', 'Material', 880000.00, 300000.00, '2026-06-15 03:55:50', '2026-06-15 03:55:50', NULL),
(194, 'BR-FE695E', 'Dual Mic/Line Input Module with DSP', 'Unit', 'Material', 480000.00, 210000.00, '2026-06-15 03:55:50', '2026-06-15 03:55:50', NULL),
(195, 'BR-A74E34', 'Ambient Noise Controller Module', 'Unit', 'Material', 680000.00, 460000.00, '2026-06-15 03:55:50', '2026-06-15 03:55:50', NULL),
(199, 'BR-A81308', 'Speaker Selector 10 Ch', 'Unit', 'Material', 230000.00, 480000.00, '2026-06-15 03:55:50', '2026-06-15 03:55:50', NULL),
(200, 'BR-1B33E4', 'Emergency Message Panel', 'Unit', 'Material', 100000.00, 420000.00, '2026-06-15 03:55:50', '2026-06-15 03:55:50', NULL),
(203, 'BR-A28101', 'Ceiling Speaker', 'Unit', 'Material', 900000.00, 60000.00, '2026-06-15 03:55:50', '2026-06-15 03:55:50', NULL),
(204, 'BR-C25500', 'Box Speaker', 'Unit', 'Material', 860000.00, 260000.00, '2026-06-15 03:55:50', '2026-06-15 03:55:50', NULL),
(205, 'BR-D66CD4', 'Horn Speaker', 'Unit', 'Material', 750000.00, 410000.00, '2026-06-15 03:55:50', '2026-06-15 03:55:50', NULL),
(206, 'BR-676D04', 'Core Swich 16 Port', 'Ls', 'Material', 370000.00, 70000.00, '2026-06-15 03:55:55', '2026-06-15 03:55:55', NULL),
(207, 'BR-84DBBB', 'Core Switch 16 Port', 'Unit', 'Material', 930000.00, 360000.00, '2026-06-15 03:55:55', '2026-06-15 03:55:55', NULL),
(208, 'BR-710317', 'Telephone Extention', 'Ls', 'Material', 790000.00, 50000.00, '2026-06-15 03:55:55', '2026-06-15 03:55:55', NULL),
(209, 'BR-765DEB', 'Telephone Direct', 'Ls', 'Material', 810000.00, 320000.00, '2026-06-15 03:55:55', '2026-06-15 03:55:55', NULL),
(211, 'BR-995305', 'SAKLAR', 'Pcs', 'Material', 920000.00, 70000.00, '2026-06-15 03:55:59', '2026-06-15 03:55:59', NULL),
(213, 'BR-D0DE10', 'POWER AC DAN RACK', 'Unit', 'Material', 950000.00, 170000.00, '2026-06-15 03:55:59', '2026-06-15 03:55:59', NULL),
(216, 'JS-AEE0D3', 'PEMASANGAN RACK', 'Lot', 'Jasa', 500000.00, 440000.00, '2026-06-15 03:55:59', '2026-06-15 03:55:59', NULL),
(217, 'JS-94B21A', 'TERMINASI DAN PEMASANGAN OUTLET', 'Lot', 'Jasa', 440000.00, 190000.00, '2026-06-15 03:55:59', '2026-06-15 03:55:59', NULL),
(218, 'JS-5ED786', 'PEMASANGAN LAMPU', 'Lot', 'Jasa', 500000.00, 300000.00, '2026-06-15 03:55:59', '2026-06-15 03:55:59', NULL),
(225, 'BR-0779BC', 'WALL SPEAKER', 'Unit', 'Material', 620000.00, 480000.00, '2026-06-15 03:57:30', '2026-06-15 03:57:30', NULL),
(226, 'BR-07CBE2', 'HEAT DETECTOR', 'Unit', 'Material', 200000.00, 290000.00, '2026-06-15 03:57:30', '2026-06-15 03:57:30', NULL),
(227, 'BR-492D65', 'FLOW SWITCH', 'Unit', 'Material', 400000.00, 160000.00, '2026-06-15 03:57:30', '2026-06-15 03:57:30', NULL),
(247, 'BR-36C18E', 'UPS 2 kVA : - UPS FA & TS kap. 4 kVA Batt 4 jam', 'Unit', 'Material', 570000.00, 130000.00, '2026-06-15 04:06:27', '2026-06-15 04:06:27', NULL),
(251, 'BR-2221AC', 'UPS 2 kVA (1P in/1P out) - Digabung dengan UPS FA', 'Unit', 'Material', 410000.00, 140000.00, '2026-06-15 04:06:27', '2026-06-15 04:06:27', NULL),
(253, 'BR-2FAB11', 'Rack 42 U', 'Unit', 'Material', 70000.00, 190000.00, '2026-06-15 04:06:27', '2026-06-15 04:20:47', '2026-06-14 14:20:47'),
(254, 'BR-8ABC29', '- Core Swich 16 Port', 'Ls', 'Material', 380000.00, 340000.00, '2026-06-15 04:06:27', '2026-06-15 04:06:27', NULL),
(256, 'BR-123528', '- Switch L3 c/w SFP Module', 'Unit', 'Material', 90000.00, 430000.00, '2026-06-15 04:06:27', '2026-06-15 04:06:27', NULL),
(257, 'BR-5B4959', '- Exhaust 8 FAN', 'Ls', 'Material', 40000.00, 40000.00, '2026-06-15 04:06:27', '2026-06-15 04:06:27', NULL),
(259, 'BR-E6C0F8', '- Keyboard & Mouse', 'Unit', 'Material', 380000.00, 270000.00, '2026-06-15 04:06:27', '2026-06-15 04:06:27', NULL),
(260, 'BR-4D7220', '- Monitor', 'Unit', 'Material', 370000.00, 400000.00, '2026-06-15 04:06:27', '2026-06-15 04:06:27', NULL),
(261, 'BR-77D685', '- Access Switch 24 Port', 'Unit', 'Material', 870000.00, 360000.00, '2026-06-15 04:06:27', '2026-06-15 04:06:27', NULL),
(262, 'BR-D43AC6', '- Core Switch 16 Port', 'Unit', 'Material', 240000.00, 500000.00, '2026-06-15 04:06:27', '2026-06-15 04:06:27', NULL),
(263, 'BR-82C891', '- NVR 1 - 16 Chanel HDD 2x2 TB', 'Unit', 'Material', 310000.00, 50000.00, '2026-06-15 04:06:27', '2026-06-15 04:06:27', NULL),
(264, 'BR-CD2F2B', '- NVR 2 - 16 Chanel HDD 2x2 TB', 'Unit', 'Material', 850000.00, 220000.00, '2026-06-15 04:06:27', '2026-06-15 04:06:27', NULL),
(265, 'BR-FB282A', '- Access Switch 2x24 port data, IPTV, Access point + Wire Management', 'Unit', 'Material', 200000.00, 460000.00, '2026-06-15 04:06:27', '2026-06-15 04:06:27', NULL),
(266, 'BR-A78BFD', '- Access Switch 2x24 port Telepone + Wire Management', 'Unit', 'Material', 910000.00, 170000.00, '2026-06-15 04:06:27', '2026-06-15 04:06:27', NULL),
(267, 'BR-061F5C', '- Access Switch 1x16 Port (PoE) For CCTV + Wire Management', 'Unit', 'Material', 220000.00, 70000.00, '2026-06-15 04:06:27', '2026-06-15 04:06:27', NULL),
(268, 'BR-F99243', 'Outlet IPTV', 'Unit', 'Material', 760000.00, 230000.00, '2026-06-15 04:06:27', '2026-06-15 04:06:27', NULL),
(269, 'BR-0E0113', '- Access Switch 6x24 port data, IPTV, Access point + Wire Management', 'Unit', 'Material', 70000.00, 400000.00, '2026-06-15 04:06:27', '2026-06-15 04:06:27', NULL),
(270, 'BR-56AD45', '- Access Switch 3x24 port Telepone + Wire Management', 'Unit', 'Material', 10000.00, 420000.00, '2026-06-15 04:06:27', '2026-06-15 04:06:27', NULL),
(271, 'BR-470128', 'LAMPU', 'Pcs', 'Material', 310000.00, 460000.00, '2026-06-15 04:07:21', '2026-06-15 04:20:30', NULL),
(274, 'BR-2B4DE6', 'CCTV', 'Unit', 'Material', 40000.00, 240000.00, '2026-06-15 04:07:21', '2026-06-15 04:07:21', NULL),
(276, 'JS-F1A6A7', 'TATA SUARA CEILING SPEAKER', 'Unit', 'Jasa', 790000.00, 90000.00, '2026-06-15 04:07:24', '2026-06-15 04:07:24', NULL),
(277, 'BR-6531FD', 'FIRE ALARM SMOKE DETECTOR', 'Unit', 'Material', 570000.00, 50000.00, '2026-06-15 04:07:24', '2026-06-15 04:07:24', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_proyek`
--

CREATE TABLE `tb_proyek` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `klien_id` bigint(20) UNSIGNED NOT NULL,
  `site_manager_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_proyek` varchar(255) NOT NULL,
  `status_proyek` enum('Berjalan','Selesai') NOT NULL DEFAULT 'Berjalan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_proyek`
--

INSERT INTO `tb_proyek` (`id`, `klien_id`, `site_manager_id`, `nama_proyek`, `status_proyek`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 'bangunan', 'Selesai', '2026-05-30 01:02:04', '2026-06-15 00:35:11', NULL),
(2, 2, 2, 'bangun', 'Berjalan', '2026-06-03 14:46:30', '2026-06-03 14:46:30', NULL),
(3, 3, 2, 'bababa', 'Selesai', '2026-06-03 15:18:04', '2026-06-15 05:52:32', NULL),
(4, 4, 2, 'hgas', 'Berjalan', '2026-06-03 15:29:54', '2026-06-03 15:29:54', NULL),
(5, 5, 2, 'SDN GANDARIA 03', 'Berjalan', '2026-06-15 02:55:21', '2026-06-15 02:55:21', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tiket_pemeliharaan`
--

CREATE TABLE `tb_tiket_pemeliharaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proyek_id` bigint(20) UNSIGNED NOT NULL,
  `pelapor_id` bigint(20) UNSIGNED NOT NULL,
  `subjek` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto_kerusakan` varchar(255) DEFAULT NULL,
  `foto_perbaikan` varchar(255) DEFAULT NULL,
  `status` enum('Open','On Progress','Resolved') NOT NULL DEFAULT 'Open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_tiket_pemeliharaan`
--

INSERT INTO `tb_tiket_pemeliharaan` (`id`, `proyek_id`, `pelapor_id`, `subjek`, `deskripsi`, `foto_kerusakan`, `foto_perbaikan`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'cctv', 'cct 5 di lantai 2 mati', NULL, 'tiket_bukti/i5DVbBQgxfA0iWEnhJZ4J5wz37uzU8Fc2Ttht8Cx.jpg', 'Resolved', '2026-06-15 02:41:30', '2026-06-15 04:07:42'),
(2, 1, 4, 'ac', 'acnya mati ni ga nyala\"', NULL, NULL, 'Open', '2026-06-15 14:37:40', '2026-06-15 14:37:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'Site Manager',
  `klien_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `nama_lengkap`, `role`, `klien_id`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'admin@indotama.co.id', '$2y$12$bphLIhU8W6WloAYG/uwyJueXlb/vGR5vv97VdXX/tBmXuqjUESEhC', 'Administrator', 'Admin', NULL, NULL, '2026-05-30 00:57:41', '2026-05-30 00:57:41', NULL),
(2, 'usman', 'usman@indotama.co.id', '$2y$12$1ryurOvxMLEFqsTLImfuYOvbcO5TKR2cviasthABorw1E/GkTvPcW', 'Muhammad Usman', 'Site Manager', NULL, NULL, '2026-05-30 00:57:42', '2026-06-15 00:25:20', NULL),
(3, 'direktur', 'direktur@indotama.co.id', '$2y$12$U6jbedlqRKyLxmflA/FhM.uqy8seYcIWoaVF8oWsFuJuK/HBuVw6e', 'Jajaran Eksekutif', 'Direktur', NULL, NULL, '2026-05-30 00:57:42', '2026-05-30 00:57:42', NULL),
(4, 'klien', 'klien@majumundur.co.id', '$2y$12$UIwzMMip/WI7Q10q/x/ddOq4Y4dUh8Jm3ulEWkLRN3q1UPKqFR.EO', 'PT. Maju Mundur', 'Klien', 1, NULL, '2026-05-30 00:57:43', '2026-05-30 00:57:43', NULL),
(5, 'man', 'man@gmail.com', '$2y$12$MBhW4nZC3a1vMu66j0SSCe4KIsg1ICehJgQFwa3wJAXRKR04T7.gK', 'man', 'Site Manager', NULL, NULL, '2026-06-14 22:29:53', '2026-06-14 22:29:53', NULL),
(6, 'klien1', 'samaan@gmail.com', '$2y$12$qJlg1PajTWsizuXOlQP8xu3BrxsvNeNFNAoCREjPKnIRQHFMeHLEC', 'saman', 'Klien', 5, NULL, '2026-06-15 14:24:50', '2026-06-15 14:24:50', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indeks untuk tabel `tb_boq_detail`
--
ALTER TABLE `tb_boq_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_boq_detail_boq_header_id_foreign` (`boq_header_id`),
  ADD KEY `tb_boq_detail_barang_jasa_id_foreign` (`barang_jasa_id`);

--
-- Indeks untuk tabel `tb_boq_header`
--
ALTER TABLE `tb_boq_header`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_boq_header_proyek_id_foreign` (`proyek_id`),
  ADD KEY `tb_boq_header_client_approved_by_foreign` (`client_approved_by`);

--
-- Indeks untuk tabel `tb_change_requests`
--
ALTER TABLE `tb_change_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_change_requests_proyek_id_foreign` (`proyek_id`),
  ADD KEY `tb_change_requests_klien_id_foreign` (`klien_id`),
  ADD KEY `tb_change_requests_diajukan_oleh_foreign` (`diajukan_oleh`);

--
-- Indeks untuk tabel `tb_kendala_lapangan`
--
ALTER TABLE `tb_kendala_lapangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_kendala_lapangan_proyek_id_foreign` (`proyek_id`),
  ADD KEY `tb_kendala_lapangan_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `tb_klien`
--
ALTER TABLE `tb_klien`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_laporan_harian`
--
ALTER TABLE `tb_laporan_harian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_laporan_harian_proyek_id_foreign` (`proyek_id`),
  ADD KEY `tb_laporan_harian_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `tb_master_barang_jasa`
--
ALTER TABLE `tb_master_barang_jasa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tb_master_barang_jasa_kode_barang_unique` (`kode_barang`);

--
-- Indeks untuk tabel `tb_proyek`
--
ALTER TABLE `tb_proyek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_proyek_klien_id_foreign` (`klien_id`),
  ADD KEY `tb_proyek_site_manager_id_foreign` (`site_manager_id`);

--
-- Indeks untuk tabel `tb_tiket_pemeliharaan`
--
ALTER TABLE `tb_tiket_pemeliharaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_tiket_pemeliharaan_proyek_id_foreign` (`proyek_id`),
  ADD KEY `tb_tiket_pemeliharaan_pelapor_id_foreign` (`pelapor_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_klien_id_foreign` (`klien_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_boq_detail`
--
ALTER TABLE `tb_boq_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1324;

--
-- AUTO_INCREMENT untuk tabel `tb_boq_header`
--
ALTER TABLE `tb_boq_header`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `tb_change_requests`
--
ALTER TABLE `tb_change_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_kendala_lapangan`
--
ALTER TABLE `tb_kendala_lapangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_klien`
--
ALTER TABLE `tb_klien`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_laporan_harian`
--
ALTER TABLE `tb_laporan_harian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_master_barang_jasa`
--
ALTER TABLE `tb_master_barang_jasa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- AUTO_INCREMENT untuk tabel `tb_proyek`
--
ALTER TABLE `tb_proyek`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_tiket_pemeliharaan`
--
ALTER TABLE `tb_tiket_pemeliharaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_boq_detail`
--
ALTER TABLE `tb_boq_detail`
  ADD CONSTRAINT `tb_boq_detail_barang_jasa_id_foreign` FOREIGN KEY (`barang_jasa_id`) REFERENCES `tb_master_barang_jasa` (`id`),
  ADD CONSTRAINT `tb_boq_detail_boq_header_id_foreign` FOREIGN KEY (`boq_header_id`) REFERENCES `tb_boq_header` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_boq_header`
--
ALTER TABLE `tb_boq_header`
  ADD CONSTRAINT `tb_boq_header_client_approved_by_foreign` FOREIGN KEY (`client_approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tb_boq_header_proyek_id_foreign` FOREIGN KEY (`proyek_id`) REFERENCES `tb_proyek` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_change_requests`
--
ALTER TABLE `tb_change_requests`
  ADD CONSTRAINT `tb_change_requests_diajukan_oleh_foreign` FOREIGN KEY (`diajukan_oleh`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_change_requests_klien_id_foreign` FOREIGN KEY (`klien_id`) REFERENCES `tb_klien` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_change_requests_proyek_id_foreign` FOREIGN KEY (`proyek_id`) REFERENCES `tb_proyek` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_kendala_lapangan`
--
ALTER TABLE `tb_kendala_lapangan`
  ADD CONSTRAINT `tb_kendala_lapangan_proyek_id_foreign` FOREIGN KEY (`proyek_id`) REFERENCES `tb_proyek` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_kendala_lapangan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_laporan_harian`
--
ALTER TABLE `tb_laporan_harian`
  ADD CONSTRAINT `tb_laporan_harian_proyek_id_foreign` FOREIGN KEY (`proyek_id`) REFERENCES `tb_proyek` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_laporan_harian_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_proyek`
--
ALTER TABLE `tb_proyek`
  ADD CONSTRAINT `tb_proyek_klien_id_foreign` FOREIGN KEY (`klien_id`) REFERENCES `tb_klien` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_proyek_site_manager_id_foreign` FOREIGN KEY (`site_manager_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `tb_tiket_pemeliharaan`
--
ALTER TABLE `tb_tiket_pemeliharaan`
  ADD CONSTRAINT `tb_tiket_pemeliharaan_pelapor_id_foreign` FOREIGN KEY (`pelapor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_tiket_pemeliharaan_proyek_id_foreign` FOREIGN KEY (`proyek_id`) REFERENCES `tb_proyek` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_klien_id_foreign` FOREIGN KEY (`klien_id`) REFERENCES `tb_klien` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
