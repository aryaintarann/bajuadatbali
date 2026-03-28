-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Feb 2026 pada 14.20
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
-- Database: `bajuadat_bali`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(10) UNSIGNED NOT NULL,
  `judul_berita` varchar(255) NOT NULL,
  `isi_berita` text NOT NULL,
  `gambar_berita` varchar(255) NOT NULL,
  `tanggal_berita` date NOT NULL,
  `slug_berita` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id_berita`, `judul_berita`, `isi_berita`, `gambar_berita`, `tanggal_berita`, `slug_berita`, `created_at`, `updated_at`) VALUES
(1, 'Fadli Ucut Celak Ucut', '<p><strong>Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;Ucut Celak&nbsp;</strong><img alt=\"\" src=\"http://localhost:8000/images/Screenshot 2026-01-27 225143_1769525544.png\" style=\"height:482px; width:439px\" /></p>', 'Berita20260127105238.jpg', '2026-01-27', 'fadli-ucut-celak-ucut', '2026-01-27 14:52:38', '2026-01-27 14:52:38');

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
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(10) UNSIGNED NOT NULL,
  `nama_galeri` varchar(255) DEFAULT NULL,
  `jenis_galeri` varchar(255) DEFAULT NULL,
  `keterangan_galeri` text DEFAULT NULL,
  `gambar_galeri` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `nama_galeri`, `jenis_galeri`, `keterangan_galeri`, `gambar_galeri`, `created_at`, `updated_at`) VALUES
(2, 'Mertha Dewata Destar Store', 'Banner', 'Produk Berkualitas & Harga Terjamin', 'Galeri20240927010656.jpg', '2024-09-26 16:06:56', '2025-04-08 03:28:55'),
(3, 'Platform Penjualan Busana Adat Bali Terpercaya', 'Banner', 'Uang Kembali Jika Tidak Sesuai', 'Galeri20250408020452.jpg', '2025-04-08 05:04:52', '2025-04-08 05:04:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_pakaians`
--

CREATE TABLE `kategori_pakaians` (
  `id_kategori_pakaian` int(10) UNSIGNED NOT NULL,
  `nama_kategori_pakaian` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_pakaians`
--

INSERT INTO `kategori_pakaians` (`id_kategori_pakaian`, `nama_kategori_pakaian`, `created_at`, `updated_at`) VALUES
(1, 'Dewasa Tradisional', '2025-04-08 01:52:27', '2025-04-08 01:52:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(10) UNSIGNED NOT NULL,
  `nama_layanan` varchar(255) NOT NULL,
  `gambar_layanan` varchar(255) NOT NULL,
  `keterangan_layanan` text NOT NULL,
  `slug_layanan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nama_layanan`, `gambar_layanan`, `keterangan_layanan`, `slug_layanan`, `created_at`, `updated_at`) VALUES
(1, 'Layanan 24 Jam', 'layanan20240925030343.png', '<p>Layanan 24 Jam</p>', 'layanan-24-jam', '2024-09-24 18:03:43', '2025-04-08 02:57:25'),
(2, 'Pengembalian Barang Bila Tidak Sesuai', 'layanan20240925030413.png', '<p>Pengembalian Barang Bila Tidak Sesuai</p>', 'pengembalian-barang-bila-tidak-sesuai', '2024-09-24 18:04:13', '2025-04-08 02:57:03'),
(3, 'Bebas Ongkir', 'layanan20240925030443.png', '<p>Bebas Ongkir</p>', 'bebas-ongkir', '2024-09-24 18:04:43', '2025-04-08 02:56:22'),
(4, 'Produk Berkualitas', 'layanan20240925031252.png', '<p>Produk Berkualitas</p>', 'produk-berkualitas', '2024-09-24 18:12:52', '2025-04-08 02:55:38');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2023_05_08_060922_create_sessions_table', 1),
(7, '2023_05_09_015610_create_galeris_table', 1),
(8, '2023_05_09_115746_create_settings_table', 1),
(9, '2023_05_09_151258_create_teams_table', 1),
(10, '2023_05_10_114136_create_beritas_table', 1),
(11, '2023_05_10_154455_create_partners_table', 1),
(12, '2023_05_13_222729_create_projects_table', 1),
(13, '2023_05_13_232938_create_rekenings_table', 1),
(14, '2023_05_14_224257_create_unit_bisnis_table', 1),
(15, '2023_05_15_001227_create_konsentrasis_table', 1),
(16, '2023_05_15_144125_create_visis_table', 1),
(17, '2023_07_04_072146_layanan', 2),
(18, '2023_07_07_161259_create_clients_table', 3),
(19, '2023_07_16_115555_create_kategori_partners_table', 4),
(20, '2023_07_18_002252_mahasiswa', 5),
(21, '2019_12_14_000001_create_personal_access_tokens_table', 6),
(22, '2024_05_19_193730_add_user_id_to_laporan_verifikasi_table', 7),
(23, '2024_05_21_182314_add_details_to_laporan_verifikasi_table', 8),
(24, '2024_09_23_123353_create_pending_orders_table', 9),
(25, '2024_09_24_151543_add_qty_to_orders_table', 10),
(26, '2024_09_27_000531_add_buku_id_to_orders_table', 11),
(27, '2024_09_27_014948_add_last_page_to_users_table', 12),
(28, '2024_09_27_210317_add_kode_pemesanan_to_orders_table', 13),
(29, '2025_04_08_154200_create_orders_table', 14),
(30, '2025_04_08_155658_add_produk_to_orders_table', 15),
(31, '2025_04_08_160229_create_order_items_table', 16),
(32, '2025_04_08_173014_add_metode_pembayaran_to_orders_table', 17),
(33, '2025_04_08_173839_add_status_to_orders_table', 18),
(34, '2025_04_08_180500_add_status_bukti_transfer_to_orders_table', 19),
(35, '2025_06_11_004642_add_order_id_midtrans_to_orders_table', 20),
(36, '2026_01_30_101129_add_stok_pakaian_to_pakaian_table', 21),
(37, '2026_02_02_000053_remove_ongkir_from_pakaian_table', 22),
(38, '2026_02_02_005513_add_pakaian_id_to_order_items', 23),
(39, '2026_02_02_022405_add_shipping_status_to_orders_table', 24),
(40, '2026_02_09_193649_add_return_fields_to_orders', 25),
(41, '2026_02_09_194956_add_return_fields_to_orders', 26),
(42, '2026_02_09_200304_add_bank_refund_columns_to_orders', 27),
(43, '2026_02_09_204445_add_refund_reject_reason_to_orders_table', 28);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_tlpn` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `kode_pos` varchar(255) NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `order_id_midtrans` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama_pakaian` varchar(255) DEFAULT NULL,
  `harga_pakaian` int(11) DEFAULT NULL,
  `metode_pembayaran` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `ongkir` int(10) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `shipping_status` varchar(255) NOT NULL DEFAULT 'diproses',
  `refund_status` varchar(255) DEFAULT NULL,
  `refund_reason` text DEFAULT NULL,
  `refund_requested_at` timestamp NULL DEFAULT NULL,
  `refund_processed_at` timestamp NULL DEFAULT NULL,
  `refund_bank_name` varchar(255) DEFAULT NULL,
  `refund_account_name` varchar(255) DEFAULT NULL,
  `refund_account_number` varchar(255) DEFAULT NULL,
  `refund_reject_reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `nama`, `no_tlpn`, `email`, `alamat`, `kota`, `provinsi`, `kode_pos`, `total`, `order_id_midtrans`, `created_at`, `updated_at`, `nama_pakaian`, `harga_pakaian`, `metode_pembayaran`, `status`, `ongkir`, `subtotal`, `shipping_status`, `refund_status`, `refund_reason`, `refund_requested_at`, `refund_processed_at`, `refund_bank_name`, `refund_account_name`, `refund_account_number`, `refund_reject_reason`) VALUES
(60, 'Roberth', '082147384256', 'pattroberth13@gmail.com', 'Desa Ayunan, Abiansemal, badung - Bali', 'Badung', 'Bali', '80352', 165000.00, 'ORDER-6989d9ef5ddc8', '2026-02-09 12:58:49', '2026-02-09 13:08:57', NULL, NULL, 'midtrans', 'paid', 20000, 145000, 'diproses', 'rejected', 'BARANG TIDAK SESUAI :(', '2026-02-09 13:08:31', '2026-02-09 13:08:57', 'BCA', 'Resky Hidayat', '6544567654', 'MASA SIHHH');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `pakaian_id` bigint(20) UNSIGNED NOT NULL,
  `nama_pakaian` varchar(255) NOT NULL,
  `harga_pakaian` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `pakaian_id`, `nama_pakaian`, `harga_pakaian`, `quantity`, `created_at`, `updated_at`) VALUES
(21, 60, 13, 'Pakaian Adat Bali COUPLE SET BLANKET', 145000, 1, '2026-02-09 12:58:49', '2026-02-09 12:58:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pakaian`
--

CREATE TABLE `pakaian` (
  `id_pakaian` bigint(20) UNSIGNED NOT NULL,
  `id_kategori_pakaian` bigint(20) UNSIGNED NOT NULL,
  `nama_pakaian` varchar(255) NOT NULL,
  `gambar_pakaian` varchar(255) NOT NULL,
  `harga_pakaian` float NOT NULL,
  `stok_pakaian` int(11) NOT NULL DEFAULT 0,
  `pratinjau_pakaian` text NOT NULL,
  `slug_pakaian` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pakaian`
--

INSERT INTO `pakaian` (`id_pakaian`, `id_kategori_pakaian`, `nama_pakaian`, `gambar_pakaian`, `harga_pakaian`, `stok_pakaian`, `pratinjau_pakaian`, `slug_pakaian`, `created_at`, `updated_at`) VALUES
(12, 1, 'Kebaya Bali', 'pakaian20250408110027.jpg', 75000, 9, '<p>Kebaya Bali merupakan busana tradisional wanita yang elegan dengan desain anggun dan detail feminin, cocok digunakan untuk acara formal, upacara adat, maupun kegiatan spesial lainnya. Dibuat dari bahan berkualitas yang nyaman dipakai, kebaya ini memberikan tampilan klasik sekaligus modern.</p>\r\n\r\n<p><strong>Detail Produk:</strong></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>✔ Model: Kebaya Bali modern</p>\r\n	</li>\r\n	<li>\r\n	<p>✔ Bahan: Brokat premium (nyaman dan ringan)</p>\r\n	</li>\r\n	<li>\r\n	<p>✔ Ukuran tersedia: S</p>\r\n	</li>\r\n	<li>\r\n	<p>✔ Pilihan warna: Putih</p>\r\n	</li>\r\n	<li>\r\n	<p>✔ Cocok untuk: Acara adat, pesta, wisuda, dan event formal</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Tampil lebih anggun dan percaya diri dengan Kebaya Bali yang memadukan keindahan tradisional dan sentuhan modern.</p>', 'kebaya-bali', '2025-04-08 02:00:27', '2026-02-09 13:12:37'),
(13, 1, 'Pakaian Adat Bali COUPLE SET BLANKET', 'pakaian20250408020106.jpg', 145000, 0, '<p><a href=\"https://shopee.co.id/ready-stock-Pakaian-Adat-Bali-COUPLE-SET-BLANKET-LASEM-SAPUT-DAN-UDENG-Slendang-Kamen-i.1479618854.29832101474?sp_atk=292882f2-ee18-4442-ae58-ce7f0bdebafe&amp;xptdk=292882f2-ee18-4442-ae58-ce7f0bdebafe\">ready stock Pakaian Adat Bali COUPLE SET BLANKET</a></p>', 'pakaian-adat-bali-couple-set-blanket', '2025-04-08 05:01:06', '2026-02-09 12:58:49');

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
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
('f2YIyhgl9u3h5U6uhjFMZAIAoGhWo5ilRy3g6LLi', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoieUJTRmNLaXRLaXZkWUwyUm9zdTFJWlVkdjFCMjdsWGptem1HYzZOMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jYXJ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRHRTVneXVPczV5TU9CRDg5ZHhQWnFlUi9ncGZra0c2eFlrdThxeDNPemRqZHRyRC5lTDVJbSI7czo0OiJjYXJ0IjthOjE6e2k6MTI7YTo1OntzOjEwOiJpZF9wYWthaWFuIjtpOjEyO3M6NDoibmFtYSI7czoxMToiS2ViYXlhIEJhbGkiO3M6NToiaGFyZ2EiO2Q6NzUwMDA7czo2OiJnYW1iYXIiO3M6MjU6InBha2FpYW4yMDI1MDQwODExMDAyNy5qcGciO3M6ODoicXVhbnRpdHkiO2k6Mjt9fX0=', 1770643083);

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(10) UNSIGNED NOT NULL,
  `instansi_setting` varchar(255) DEFAULT NULL,
  `pimpinan_setting` varchar(255) DEFAULT NULL,
  `logo_setting` varchar(255) DEFAULT NULL,
  `favicon_setting` varchar(255) DEFAULT NULL,
  `tentang_setting` text DEFAULT NULL,
  `misi_setting` text DEFAULT NULL,
  `visi_setting` text DEFAULT NULL,
  `keyword_setting` varchar(255) DEFAULT NULL,
  `alamat_setting` varchar(255) DEFAULT NULL,
  `instagram_setting` varchar(255) DEFAULT NULL,
  `youtube_setting` varchar(255) DEFAULT NULL,
  `email_setting` varchar(255) DEFAULT NULL,
  `no_hp_setting` varchar(255) DEFAULT NULL,
  `maps_setting` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id_setting`, `instansi_setting`, `pimpinan_setting`, `logo_setting`, `favicon_setting`, `tentang_setting`, `misi_setting`, `visi_setting`, `keyword_setting`, `alamat_setting`, `instagram_setting`, `youtube_setting`, `email_setting`, `no_hp_setting`, `maps_setting`, `created_at`, `updated_at`) VALUES
(2, 'Mertha Dewata Destar Store', 'Fadli', 'Screenshot (80).png', 'Screenshot (80).png', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>', NULL, NULL, 'Pakaian Adat Bali', 'Bali, Indonesia', 'roberth_colln', 'https://www.youtube.com/watch?v=D9GTa9w525A', 'office@e-book.id', '6285150914771', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1010296.3993742312!2d114.41200632575861!3d-8.453560101474046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd141d3e8100fa1%3A0x24910fb14b24e690!2sBali!5e0!3m2!1sid!2sid!4v1744094670172!5m2!1sid!2sid', NULL, '2025-04-08 04:45:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_pdf_page` int(10) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `last_pdf_page`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, NULL, '$2y$10$GE5gyuOs5yMOBD89dxPZqeR/gpfkkG6xYku8qx3OzdjdtrD.eL5Im', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indeks untuk tabel `kategori_pakaians`
--
ALTER TABLE `kategori_pakaians`
  ADD PRIMARY KEY (`id_kategori_pakaian`);

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indeks untuk tabel `pakaian`
--
ALTER TABLE `pakaian`
  ADD PRIMARY KEY (`id_pakaian`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kategori_pakaians`
--
ALTER TABLE `kategori_pakaians`
  MODIFY `id_kategori_pakaian` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `pakaian`
--
ALTER TABLE `pakaian`
  MODIFY `id_pakaian` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
