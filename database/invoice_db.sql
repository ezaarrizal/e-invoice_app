-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 16, 2025 at 05:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoice_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(20) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `invoice_date` date NOT NULL,
  `type` enum('HPJ','HPB','HPF') NOT NULL,
  `total` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `customer_name`, `invoice_date`, `type`, `total`, `created_at`, `updated_at`) VALUES
(26, '', 'RS UMM', '2025-10-06', 'HPJ', 800000.00, '2025-10-06 05:18:05', '2025-10-06 05:18:05'),
(27, '', 'Universitas Muhammadiyah Malang', '2025-10-07', 'HPJ', 3500000.00, '2025-10-06 18:59:47', '2025-10-06 18:59:47'),
(28, '', 'Bu Tanti', '2025-10-07', 'HPJ', 1825000.00, '2025-10-06 19:05:28', '2025-10-06 19:05:28'),
(35, '', 'Tio', '2025-10-07', 'HPJ', 16000.00, '2025-10-07 08:09:12', '2025-10-07 08:09:12'),
(36, '', 'Uji', '2025-10-09', 'HPB', 3500000.00, '2025-10-08 17:17:16', '2025-10-08 17:17:17'),
(37, '', 'Rozin', '2025-10-09', 'HPJ', 120000.00, '2025-10-09 00:53:20', '2025-10-09 00:53:20'),
(38, '', 'UB', '2025-10-10', 'HPJ', 16000.00, '2025-10-10 00:23:32', '2025-10-10 00:23:32'),
(39, '', 'Ojin', '2025-10-10', 'HPJ', 100000.00, '2025-10-10 00:24:40', '2025-10-10 00:24:40'),
(40, '', 'UB', '2025-10-10', 'HPB', 110000.00, '2025-10-10 00:26:40', '2025-10-10 00:26:40'),
(41, '', 'UMM', '2025-10-10', 'HPB', 120000.00, '2025-10-10 00:31:50', '2025-10-10 00:31:50'),
(42, '', 'Ojin', '2025-10-10', 'HPB', 120000.00, '2025-10-10 00:32:51', '2025-10-10 00:32:51'),
(43, '', 'Ala', '2025-10-10', 'HPJ', 240000.00, '2025-10-10 00:53:05', '2025-10-10 00:53:05'),
(44, '', 'UMM', '2025-10-10', 'HPB', 120000.00, '2025-10-10 01:02:20', '2025-10-10 01:02:20'),
(45, '', 'Cust1', '2025-10-10', 'HPJ', 100000.00, '2025-10-10 01:56:52', '2025-10-10 01:56:52'),
(46, '', 'UMM', '2025-10-10', 'HPJ', 220000.00, '2025-10-10 02:08:46', '2025-10-10 02:08:47'),
(47, '', 'UB', '2025-10-10', 'HPB', 220000.00, '2025-10-10 02:10:39', '2025-10-10 02:10:39'),
(48, '', 'Ojin', '2025-10-10', 'HPJ', 200000.00, '2025-10-10 02:27:06', '2025-10-10 02:27:06'),
(49, '', 'Cust1', '2025-10-10', 'HPJ', 200000.00, '2025-10-10 02:29:31', '2025-10-10 02:29:31'),
(50, '', 'Ojin', '2025-10-10', 'HPJ', 300000.00, '2025-10-10 02:32:43', '2025-10-10 02:32:43'),
(51, '', 'UB', '2025-10-10', 'HPJ', 200000.00, '2025-10-10 02:35:06', '2025-10-10 02:35:06'),
(52, '', 'Ojin', '2025-10-10', 'HPJ', 320000.00, '2025-10-10 02:47:21', '2025-10-10 02:47:21'),
(53, '', 'Ojin', '2025-10-10', 'HPJ', 320000.00, '2025-10-10 02:47:42', '2025-10-10 02:47:42'),
(54, '', 'Ala', '2025-10-10', 'HPB', 420000.00, '2025-10-10 02:49:33', '2025-10-10 02:49:33'),
(55, '', 'UMM', '2025-10-11', 'HPF', 20000.00, '2025-10-11 10:07:50', '2025-10-11 10:07:50'),
(56, '', 'UB', '2025-10-12', 'HPB', 100000.00, '2025-10-11 10:08:56', '2025-10-11 10:08:56'),
(57, '', 'RS UMM', '2025-10-12', 'HPF', 30000.00, '2025-10-12 08:49:39', '2025-10-12 08:49:39'),
(59, '', 'Udin', '2025-10-12', 'HPJ', 215000.00, '2025-10-12 08:59:34', '2025-10-12 09:15:41'),
(60, '0001/2025', 'UB', '2025-10-15', 'HPJ', 16000.00, '2025-10-15 02:31:58', '2025-10-15 02:31:58'),
(61, '0002/2025', 'Telkom', '2025-10-16', 'HPJ', 100000.00, '2025-10-15 20:15:35', '2025-10-15 20:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `item_id`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(22, 26, 3, 50, 16000.00, 800000.00, '2025-10-06 05:18:05', '2025-10-06 05:18:05'),
(23, 27, 4, 50, 70000.00, 3500000.00, '2025-10-06 18:59:47', '2025-10-06 18:59:47'),
(24, 28, 6, 22, 80000.00, 1760000.00, '2025-10-06 19:05:28', '2025-10-06 19:05:28'),
(25, 28, 7, 1, 65000.00, 65000.00, '2025-10-06 19:05:28', '2025-10-06 19:05:28'),
(26, 35, 3, 1, 16000.00, 16000.00, '2025-10-07 08:09:12', '2025-10-07 08:09:12'),
(27, 36, 6, 50, 70000.00, 3500000.00, '2025-10-08 17:17:17', '2025-10-08 17:17:17'),
(28, 37, 10, 1, 100000.00, 120000.00, '2025-10-09 00:53:20', '2025-10-09 00:53:20'),
(29, 38, 3, 1, 16000.00, 16000.00, '2025-10-10 00:23:32', '2025-10-10 00:23:32'),
(30, 39, 10, 1, 100000.00, 100000.00, '2025-10-10 00:24:40', '2025-10-10 00:24:40'),
(31, 40, 10, 1, 100000.00, 100000.00, '2025-10-10 00:26:40', '2025-10-10 00:26:40'),
(32, 41, 10, 1, 120000.00, 120000.00, '2025-10-10 00:31:50', '2025-10-10 00:31:50'),
(33, 42, 10, 1, 120000.00, 120000.00, '2025-10-10 00:32:51', '2025-10-10 00:32:51'),
(34, 43, 10, 2, 120000.00, 240000.00, '2025-10-10 00:53:05', '2025-10-10 00:53:05'),
(35, 44, 10, 1, 120000.00, 100000.00, '2025-10-10 01:02:20', '2025-10-10 01:02:20'),
(36, 45, 10, 1, 100000.00, 100000.00, '2025-10-10 01:56:52', '2025-10-10 01:56:52'),
(37, 46, 10, 2, 100000.00, 200000.00, '2025-10-10 02:08:47', '2025-10-10 02:08:47'),
(38, 47, 10, 2, 100000.00, 200000.00, '2025-10-10 02:10:39', '2025-10-10 02:10:39'),
(39, 48, 10, 2, 100000.00, 200000.00, '2025-10-10 02:27:06', '2025-10-10 02:27:06'),
(40, 49, 10, 2, 100000.00, 200000.00, '2025-10-10 02:29:31', '2025-10-10 02:29:31'),
(41, 50, 10, 3, 100000.00, 300000.00, '2025-10-10 02:32:43', '2025-10-10 02:32:43'),
(42, 51, 10, 2, 100000.00, 200000.00, '2025-10-10 02:35:06', '2025-10-10 02:35:06'),
(43, 52, 10, 3, 100000.00, 300000.00, '2025-10-10 02:47:21', '2025-10-10 02:47:21'),
(44, 53, 10, 3, 100000.00, 300000.00, '2025-10-10 02:47:42', '2025-10-10 02:47:42'),
(45, 54, 10, 4, 100000.00, 400000.00, '2025-10-10 02:49:33', '2025-10-10 02:49:33'),
(46, 55, 10, 1, 20000.00, 20000.00, '2025-10-11 10:07:50', '2025-10-11 10:07:50'),
(47, 56, 10, 1, 100000.00, 100000.00, '2025-10-11 10:08:56', '2025-10-11 10:08:56'),
(48, 57, 11, 1, 10000.00, 10000.00, '2025-10-12 08:49:39', '2025-10-12 08:49:39'),
(49, 57, 10, 1, 20000.00, 20000.00, '2025-10-12 08:49:39', '2025-10-12 08:49:39'),
(56, 59, 12, 1, 115000.00, 115000.00, '2025-10-12 09:15:41', '2025-10-12 09:15:41'),
(57, 59, 10, 1, 100000.00, 100000.00, '2025-10-12 09:15:41', '2025-10-12 09:15:41'),
(58, 60, 3, 1, 16000.00, 16000.00, '2025-10-15 02:31:58', '2025-10-15 02:31:58'),
(59, 61, 10, 1, 100000.00, 100000.00, '2025-10-15 20:15:35', '2025-10-15 20:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `hpj` decimal(15,2) NOT NULL DEFAULT 0.00,
  `hpb` decimal(15,2) NOT NULL DEFAULT 0.00,
  `hpf` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `hpj`, `hpb`, `hpf`, `created_at`, `updated_at`) VALUES
(3, 'Nota Resep RS UMM', 16000.00, 12000.00, 0.00, '2025-10-06 05:17:25', '2025-10-06 05:17:25'),
(4, 'Bendera Merah Putih Saten Ukuran 1 x 1.5', 70000.00, 50000.00, 0.00, '2025-10-06 18:56:28', '2025-10-06 18:56:28'),
(6, 'Kaos Lengan Panjang BT', 80000.00, 70000.00, 0.00, '2025-10-06 18:57:52', '2025-10-06 18:57:52'),
(7, 'Ongkos Jahit Batik', 65000.00, 50000.00, 1000.00, '2025-10-06 18:58:44', '2025-10-09 00:52:52'),
(10, 'Barang1', 100000.00, 100000.00, 20000.00, '2025-10-09 00:47:30', '2025-10-09 00:47:30'),
(11, 'Barang2', 0.00, 0.00, 10000.00, '2025-10-12 08:48:18', '2025-10-12 08:48:18'),
(12, 'Kaos', 115000.00, 100000.00, 10000.00, '2025-10-12 08:56:35', '2025-10-12 08:59:08');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_10_01_000000_create_items_table', 1),
(6, '2025_10_01_000001_create_invoices_table', 1),
(7, '2025_10_01_000002_create_invoice_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Eza', 'ezaarr2607@gmail.com', NULL, '$2y$12$EvophFj1wTBI0WPiFayjh.uXCxEnkPBtxYN.rhrU9N16y.5Jta3/u', NULL, '2025-10-12 21:02:02', '2025-10-12 21:02:02'),
(2, 'Fahrudin', 'admin@gmail.com', NULL, '$2y$12$BScTLhpvDSOOYJOu3/Qt.OSDN4byFjzGgSmTMIDNLJKBbSjowi2jq', NULL, '2025-10-13 00:01:53', '2025-10-13 00:01:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_items_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_items_item_id_foreign` (`item_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoice_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
