-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2025 at 06:50 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ace_engineering`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `avatar`, `created_at`, `updated_at`) VALUES
(1, '1708414437.png', '2024-02-20 00:33:57', '2024-02-20 00:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `executions`
--

CREATE TABLE `executions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `executions`
--

INSERT INTO `executions` (`id`, `nama_item`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 'Galvalum', 'Buat kusen-kusen', '2024-02-18 19:13:42', '2024-02-18 19:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `internal_logistic_supports`
--

CREATE TABLE `internal_logistic_supports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_logistik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi_penyimpanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `internal_logistic_supports`
--

INSERT INTO `internal_logistic_supports` (`id`, `nama_logistik`, `lokasi_penyimpanan`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, 'Tes lagi', 'Gudang 2', '', '2024-02-19 00:49:50', '2024-02-19 00:49:50');

-- --------------------------------------------------------

--
-- Table structure for table `list_vendors`
--

CREATE TABLE `list_vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_vendor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturings`
--

CREATE TABLE `manufacturings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_manufacturing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_manufacturing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manufacturings`
--

INSERT INTO `manufacturings` (`id`, `kode_manufacturing`, `nama_manufacturing`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Tes1', 'Tes juga ya hud', 'Keterangan.........\r\nOkeee.....\r\nYaa.....', '2024-02-18 19:10:57', '2024-02-18 19:11:39'),
(2, 'Tes2', 'Tes2', 'Gassss....\r\nOkee.....', '2024-02-18 19:11:20', '2024-02-18 19:11:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '2024_02_07_021118_create_blogs_table', 2),
(14, '2024_02_07_021528_create_blogs_table', 3),
(25, '2014_10_12_000000_create_users_table', 4),
(26, '2014_10_12_100000_create_password_resets_table', 4),
(27, '2019_08_19_000000_create_failed_jobs_table', 4),
(28, '2019_12_14_000001_create_personal_access_tokens_table', 4),
(29, '2024_02_07_071855_create_employees_table', 4),
(30, '2024_02_12_152528_create_manufacturings_table', 4),
(31, '2024_02_15_040411_create_progres_projects_table', 4),
(32, '2024_02_15_064646_create_executions_table', 5),
(33, '2024_02_15_072931_create_status_materials_table', 6),
(34, '2024_02_15_080212_create_systems_table', 7),
(35, '2024_02_15_080338_create_status_inventories_table', 7),
(36, '2024_02_19_063048_create_internal_logistic_supports_table', 8),
(37, '2024_02_19_080934_create_list_vendors_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progres_projects`
--

CREATE TABLE `progres_projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_project` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `progres` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_progres` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `progres_projects`
--

INSERT INTO `progres_projects` (`id`, `nama_project`, `progres`, `status_progres`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Project Aspal', '40%', 'Progres', 'Trial hud', '2024-02-14 22:08:00', '2024-02-14 22:08:00'),
(2, 'Project Beton', '100%', 'Selesai', 'Coba lagi', '2024-02-14 22:08:34', '2024-02-14 22:12:24'),
(3, 'Project jembatan', '100%', 'Selesai', 'Kendala bahan material', '2024-02-18 19:12:28', '2024-02-18 19:12:54');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status_inventories`
--

CREATE TABLE `status_inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_inventory` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_inventory` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_inventories`
--

INSERT INTO `status_inventories` (`id`, `nama_inventory`, `status_inventory`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'xenia', 'ready', 'oke', '2024-02-15 01:51:25', '2024-02-15 01:51:25'),
(2, 'L300', 'Ready', 'Tes', '2024-02-15 01:51:55', '2024-02-15 01:53:30');

-- --------------------------------------------------------

--
-- Table structure for table `status_materials`
--

CREATE TABLE `status_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_material` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_material` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_materials`
--

INSERT INTO `status_materials` (`id`, `nama_material`, `status_material`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, 'Koral', 'Siap', 'Ya bisa', '2024-02-15 00:56:06', '2024-02-15 00:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `systems`
--

CREATE TABLE `systems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_system` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `systems`
--

INSERT INTO `systems` (`id`, `nama_system`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 'Marketing', 'Tesss aja hudi', '2024-02-18 19:16:19', '2024-02-18 19:16:34');

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian`
--

CREATE TABLE `t_pembelian` (
  `id` int(11) NOT NULL,
  `no_transaksi` varchar(255) DEFAULT NULL,
  `no_po_customer` varchar(255) DEFAULT NULL,
  `no_pembelian` varchar(255) DEFAULT NULL,
  `nama_customer` varchar(255) DEFAULT NULL,
  `nama_supplier` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `tanggal_pembelian` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `keterangan` varchar(300) DEFAULT NULL,
  `flag_ppn` varchar(255) DEFAULT NULL,
  `ppn` int(11) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `jenis_order` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembelian`
--

INSERT INTO `t_pembelian` (`id`, `no_transaksi`, `no_po_customer`, `no_pembelian`, `nama_customer`, `nama_supplier`, `alamat`, `total`, `tanggal_pembelian`, `created_date`, `updated_date`, `keterangan`, `flag_ppn`, `ppn`, `diskon`, `tanggal_kirim`, `jenis_order`) VALUES
(1, 'PB252408001', 'PO/ACME/0045/VIII/2025', 'PBL252308-001', 'PT Superior Prima Sukses Tbk', NULL, 'Jl. Raya Kupang Baru No.27, Surabaya, Jawa Timur 60225', 121500000, '2025-08-24 00:00:00', '2025-08-24 03:55:27', '2025-08-24 14:51:33', 'Membangun kemitraan yang saling menguntungkan untuk jangka panjang dengan seluruh pemangku kepentingan perusahaan.', 'PPN', 11, 3, '2025-08-26', 'ORDER PEMBELIAN'),
(2, 'PB252408002', 'PO-2025-00123', 'PBL252408-002', 'PT. Intan Pramadita', NULL, 'JL Kemirahan, Malang, 65147, Indonesia', 34500000, '2025-08-24 00:00:00', '2025-08-24 14:37:31', '2025-08-24 15:10:16', NULL, NULL, NULL, NULL, NULL, 'ORDER KERJA');

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian_detail`
--

CREATE TABLE `t_pembelian_detail` (
  `id` int(11) NOT NULL,
  `id_header` int(11) DEFAULT NULL,
  `nama_item` varchar(255) DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `keterangan_detail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembelian_detail`
--

INSERT INTO `t_pembelian_detail` (`id`, `id_header`, `nama_item`, `material`, `satuan`, `qty`, `harga`, `created_date`, `keterangan_detail`) VALUES
(5, 1, 'Beton niser', NULL, 'EA', 15, 6500000, '2025-08-24 14:51:33', NULL),
(6, 1, 'Wiremesh', NULL, 'EA', 8, 3000000, '2025-08-24 14:51:33', NULL),
(7, 2, 'barang A', NULL, 'DOS', 10, 1200000, '2025-08-24 15:10:16', NULL),
(8, 2, 'barang B', NULL, 'EA', 15, 1500000, '2025-08-24 15:10:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_penawaran`
--

CREATE TABLE `t_penawaran` (
  `id` int(11) NOT NULL,
  `no_transaksi` varchar(255) DEFAULT NULL,
  `no_penawaran` varchar(255) DEFAULT NULL,
  `nama_customer` varchar(255) DEFAULT NULL,
  `alamat_customer` varchar(255) DEFAULT NULL,
  `nama_sales` varchar(255) DEFAULT NULL,
  `tanggal_penawaran` datetime DEFAULT NULL,
  `flag_ppn` varchar(255) DEFAULT NULL,
  `ppn` int(11) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `total_penawaran` int(11) DEFAULT NULL,
  `keterangan` varchar(500) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_penawaran`
--

INSERT INTO `t_penawaran` (`id`, `no_transaksi`, `no_penawaran`, `nama_customer`, `alamat_customer`, `nama_sales`, `tanggal_penawaran`, `flag_ppn`, `ppn`, `diskon`, `total_penawaran`, `keterangan`, `created_date`, `updated_date`) VALUES
(1, 'PN252308001', '001/SP/III/2025', 'PT CIPTA ADHI KARYA SENTOSA', 'Tiban Riau Bertuah 2, blok G no 31 BATAM', 'PUTRI ARDIYANTI', '2025-08-23 19:53:43', 'PPN', 11, 2, 39072000, 'Pembayaran harus dilunasi pada tanggal 10 September 2025', '2025-08-23 19:53:43', NULL),
(2, 'PN252508002', '002/SP/III/2025', 'PT ABIPRAYA BETON', 'Gg. Melad Mlaten No.59, Sangglut, Karangrejo, Kec. Gempol, Pasuruan, Jawa Timur 67155', 'SUTIKNO', '2025-08-25 08:51:40', 'NON_PPN', 0, 0, 1000000, 'Penawaran harga dasar', '2025-08-25 08:51:40', NULL),
(3, 'PN253108003', '003/SP/III/2025', 'PT MALINDO PUTRA JAYA', 'MENARA STANDARD CHARTERED BANK, JL. PROF. DR. SATRIO KAV. 164', 'ZAINAL ABIDIN', '2025-08-31 16:14:13', 'PPN', 11, 15, 9906750, '', '2025-08-31 16:14:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_penawaran_detail`
--

CREATE TABLE `t_penawaran_detail` (
  `id` int(11) NOT NULL,
  `id_header` int(11) DEFAULT NULL,
  `nama_item` varchar(255) DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `keterangan_detail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_penawaran_detail`
--

INSERT INTO `t_penawaran_detail` (`id`, `id_header`, `nama_item`, `material`, `satuan`, `qty`, `harga`, `created_date`, `keterangan_detail`) VALUES
(1, 1, 'Aspal', 'hotmix', 'ton', 10, 1500000, '2025-08-23 19:53:43', 'aspal yang kasar'),
(2, 1, 'Batu split', 'kerikil', 'ton', 8, 1400000, '2025-08-23 19:53:43', 'batu split k1'),
(3, 1, 'Pasir Pasang', 'pasir', 'ton', 5, 1800000, '2025-08-23 19:53:43', 'pasir lumajang'),
(4, 2, 'Baja lembaran', 'baja', 'ea', 10, 100000, '2025-08-25 08:51:40', '-'),
(5, 3, 'Aluminium', 'logam', 'EA', 12, 250000, '2025-08-31 16:14:13', ''),
(6, 3, 'beton dasar / beton onderlaag', 'baja', 'EA', 15, 500000, '2025-08-31 16:14:13', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_sales_order`
--

CREATE TABLE `t_sales_order` (
  `id` int(11) NOT NULL,
  `no_transaksi` varchar(255) DEFAULT NULL,
  `id_penawaran` int(11) DEFAULT NULL,
  `total_pembayaran` int(11) DEFAULT NULL,
  `jenis_pembayaran` varchar(255) DEFAULT NULL,
  `nominal_dp` int(11) DEFAULT NULL,
  `sisa_pembayaran` int(11) DEFAULT NULL,
  `tanggal_tempo` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `keterangan` varchar(300) DEFAULT NULL,
  `no_ph` varchar(255) DEFAULT NULL,
  `no_po_customer` varchar(255) DEFAULT NULL,
  `tanggal_po` datetime DEFAULT NULL,
  `nama_customer` varchar(255) DEFAULT NULL,
  `untuk_perhatian` varchar(255) DEFAULT NULL,
  `alamat_customer` varchar(255) DEFAULT NULL,
  `no_telepon` varchar(255) DEFAULT NULL,
  `no_invoice` varchar(255) DEFAULT NULL,
  `tanggal_invoice` datetime DEFAULT NULL,
  `no_surat_jalan` varchar(255) DEFAULT NULL,
  `no_bon_surat_jalan` varchar(255) DEFAULT NULL,
  `flag_selesai` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_sales_order`
--

INSERT INTO `t_sales_order` (`id`, `no_transaksi`, `id_penawaran`, `total_pembayaran`, `jenis_pembayaran`, `nominal_dp`, `sisa_pembayaran`, `tanggal_tempo`, `created_date`, `keterangan`, `no_ph`, `no_po_customer`, `tanggal_po`, `nama_customer`, `untuk_perhatian`, `alamat_customer`, `no_telepon`, `no_invoice`, `tanggal_invoice`, `no_surat_jalan`, `no_bon_surat_jalan`, `flag_selesai`) VALUES
(1, 'SO252408001', 1, 39072000, 'DP', 14500000, 24572000, '2025-08-24 17:46:11', '2025-08-24 17:46:11', 'mohon dikirim sebelum tanggal 28 agustus 2025 karena urgent', 'PH2025-1445', 'PO-2025-1123', '2025-08-16 17:46:11', 'PT CIPTA ADHI KARYA SENTOSA', 'SIGIT ANDRI KURNIAWAN', 'Tiban Riau Bertuah 2, blok G no 31 BATAM', '089572382654', 'INV250828191754', NULL, 'SJ252408-001', '12312312', 'Ya'),
(2, 'SO250509002', 2, 1000000, 'FULL PAYMENT', 0, 0, '2025-09-05 23:21:21', '2025-09-05 23:21:21', '', '', 'PO142556-9023-2321', '2025-09-05 23:21:21', 'PT ABIPRAYA BETON', 'PAK ADIP SAPUTRO', 'Gg. Melad Mlaten No.59, Sangglut, Karangrejo, Kec. Gempol, Pasuruan, Jawa Timur 67155', '089212121313', 'INV250905221612', '2025-09-13 23:21:21', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `img_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `password_text`, `remember_token`, `created_at`, `updated_at`, `img_name`, `full_name`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', '2024-02-15 04:17:26', '$2a$12$DE0T5oLkdz/w4u4jGZUi6OlKLoYLO60nDAtGumtqdqrOJM70Ya7RS', '0', NULL, '2024-02-15 04:17:30', '2024-02-15 04:17:33', 'user.jpeg', 'M Hudi Asrori', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `executions`
--
ALTER TABLE `executions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `internal_logistic_supports`
--
ALTER TABLE `internal_logistic_supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_vendors`
--
ALTER TABLE `list_vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufacturings`
--
ALTER TABLE `manufacturings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `progres_projects`
--
ALTER TABLE `progres_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `status_inventories`
--
ALTER TABLE `status_inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_materials`
--
ALTER TABLE `status_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systems`
--
ALTER TABLE `systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_pembelian`
--
ALTER TABLE `t_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_pembelian_detail`
--
ALTER TABLE `t_pembelian_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_penawaran`
--
ALTER TABLE `t_penawaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_penawaran_detail`
--
ALTER TABLE `t_penawaran_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_sales_order`
--
ALTER TABLE `t_sales_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `executions`
--
ALTER TABLE `executions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `internal_logistic_supports`
--
ALTER TABLE `internal_logistic_supports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `list_vendors`
--
ALTER TABLE `list_vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manufacturings`
--
ALTER TABLE `manufacturings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `progres_projects`
--
ALTER TABLE `progres_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_inventories`
--
ALTER TABLE `status_inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_materials`
--
ALTER TABLE `status_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `systems`
--
ALTER TABLE `systems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
