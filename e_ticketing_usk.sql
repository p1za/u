-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 26 Jan 2025 pada 06.53
-- Versi server: 8.0.30
-- Versi PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_ticketing_usk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `airlines`
--

CREATE TABLE `airlines` (
  `id` bigint UNSIGNED NOT NULL,
  `airline_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `airline_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `airlines`
--

INSERT INTO `airlines` (`id`, `airline_name`, `airline_code`, `country`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Garuda Indonesia', 'GA - GIA', 'Indonesia', 'logos/XZyB3rl0M29PSlO9n4Dvvs8irVabELEI77uUvmBq.png', 1, '2025-01-21 22:39:45', '2025-01-22 21:17:04'),
(4, 'Batik Air', 'ID - BTK', 'Indonesia', 'logos/yEFD64e2xOIwtfWNSBAtdtULRL3vZ96q74HWN76i.webp', 1, '2025-01-22 21:25:32', '2025-01-22 21:25:32'),
(5, 'Lion Airlines', 'JT - LNI', 'Indonesia', 'logos/qnsOaR18BVaqy0Lr44eXFXOeYTBQUzGvGhUKT4iI.png', 1, '2025-01-23 02:31:47', '2025-01-23 02:31:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_id` bigint UNSIGNED NOT NULL,
  `seat_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `payment_id` bigint UNSIGNED NOT NULL,
  `payment_proof` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('diproses','setuju','dibatalkan','') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diproses',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bookings`
--

INSERT INTO `bookings` (`id`, `booking_code`, `schedule_id`, `seat_id`, `user_id`, `payment_id`, `payment_proof`, `status`, `created_at`, `updated_at`) VALUES
(12, 'BK-25012025RZV01', 5, 16, 2, 1, 'payment_proofs/LerWm9sZm6HnziCkg3ehkw2OtYPTOLbbYHSJTc4k.jpg', 'setuju', '2025-01-25 01:28:05', '2025-01-25 04:37:10'),
(13, 'BK-25012025N5T02', 5, 6, 2, 1, 'payment_proofs/LerWm9sZm6HnziCkg3ehkw2OtYPTOLbbYHSJTc4k.jpg', 'setuju', '2025-01-25 01:28:05', '2025-01-25 06:12:36'),
(14, 'BK-25012025L7Y03', 6, 16, 4, 1, 'payment_proofs/97ZvIAdEeXXPzd2HoBOqsU4oTO19hOXDezZmWDAh.png', 'dibatalkan', '2025-01-25 06:19:31', '2025-01-25 07:00:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('syaddad@gmail.com|127.0.0.1', 'i:1;', 1737625744),
('syaddad@gmail.com|127.0.0.1:timer', 'i:1737625744;', 1737625744),
('tes1@gmail.com|127.0.0.1', 'i:1;', 1737465512),
('tes1@gmail.com|127.0.0.1:timer', 'i:1737465512;', 1737465512);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE `kota` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kota`
--

INSERT INTO `kota` (`id`, `nama_kota`, `kode_kota`, `created_at`, `updated_at`) VALUES
(1, 'Jakarta', 'JKT', '2025-01-24 00:44:29', '2025-01-24 05:59:25'),
(2, 'Bandung', 'BDG', '2025-01-24 00:50:14', '2025-01-24 00:50:14'),
(3, 'Solo', 'SLO', '2025-01-24 00:50:24', '2025-01-24 00:50:24'),
(4, 'Surabaya', 'SBY', '2025-01-24 00:50:31', '2025-01-24 00:50:31'),
(5, 'Bali', 'BLI', '2025-01-24 00:50:37', '2025-01-24 00:50:37'),
(6, 'Nusa Tenggara Timur', 'NTT', '2025-01-24 00:50:45', '2025-01-24 00:50:45'),
(7, 'Semarang', 'SMG', '2025-01-24 00:50:50', '2025-01-24 00:50:50'),
(8, 'Papua', 'PPA', '2025-01-24 00:51:07', '2025-01-24 00:51:07'),
(9, 'Pontianak', 'PTK', '2025-01-24 00:51:19', '2025-01-24 00:51:19'),
(10, 'Palembang', 'PMB', '2025-01-24 00:51:35', '2025-01-24 00:51:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_20_015348_create_airlines_table', 1),
(5, '2025_01_20_015451_create_planes_table', 1),
(6, '2025_01_20_015553_create_seats_table', 1),
(7, '2025_01_20_015648_create_schedules_table', 1),
(8, '2025_01_20_015802_create_bookings_table', 1),
(9, '2025_01_21_001050_create_passenger_table', 2),
(10, '2025_01_24_061222_create_kota_table', 3),
(11, '2025_01_24_134333_create_payments_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$12$QFO45qmRPNPB5AjdVgYhuuvG4AmUj0Y3fhsYsT36EpMsnbJiz4uyC', '2025-01-25 23:18:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `logo` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`id`, `logo`, `payment_name`, `payment_to`, `payment_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 'logo_pembayaran/66HwHjzwPNPP9DwEbu4opMOmN3hP3gJQq5DlgIuB.png', 'QRIS', 'PT. Qris Indonesia', '2343233434', 1, '2025-01-24 07:07:32', '2025-01-24 07:52:00'),
(2, 'logo_pembayaran/vEZyZ9A0ExkywnkdUUhAQrNsq1DQFtAUxh8Pg8pZ.webp', 'Dana', 'PT. Dana Indonesia', '011112323', 1, '2025-01-24 08:43:27', '2025-01-24 08:43:27'),
(3, 'logo_pembayaran/gGn8rfTjiwgFYDtUtN8xqxsCZJ9ZEvZtAVPGHMmf.svg', 'BCA Virtual Account', 'PT. Bank Central Asia', '111111', 1, '2025-01-24 08:45:44', '2025-01-24 08:45:44'),
(4, 'logo_pembayaran/HJM8kETv44cHRBIEGKPQjrvzjVH2ciqa2At6hUo9.png', 'GoPay', 'PT. Karya Anak Bangsa', '234234234', 1, '2025-01-24 08:47:45', '2025-01-24 08:47:45'),
(5, 'logo_pembayaran/Uf3E5QQFTe8U4obo7i503ZjkaSxAAhqQJDMf0APh.png', 'Shopee Pay', 'PT. Shopee Internasional Indonesia', '20202002', 1, '2025-01-24 08:51:11', '2025-01-24 08:51:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `planes`
--

CREATE TABLE `planes` (
  `id` bigint UNSIGNED NOT NULL,
  `airline_id` bigint UNSIGNED NOT NULL,
  `plane_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `planes`
--

INSERT INTO `planes` (`id`, `airline_id`, `plane_name`, `created_at`, `updated_at`) VALUES
(1, 2, 'Boeing', '2025-01-22 19:20:16', '2025-01-25 07:08:36'),
(3, 4, 'Boeing 532', '2025-01-22 21:43:00', '2025-01-22 21:43:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `plane_id` bigint UNSIGNED NOT NULL,
  `departure_time` datetime NOT NULL,
  `arrival_time` datetime NOT NULL,
  `departure_city_id` bigint UNSIGNED NOT NULL,
  `arrival_city_id` bigint UNSIGNED NOT NULL,
  `price` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `schedules`
--

INSERT INTO `schedules` (`id`, `plane_id`, `departure_time`, `arrival_time`, `departure_city_id`, `arrival_city_id`, `price`, `created_at`, `updated_at`) VALUES
(4, 3, '2025-01-25 01:00:00', '2025-01-25 05:00:00', 1, 3, 250000, '2025-01-24 09:21:10', '2025-01-24 09:22:31'),
(5, 1, '2025-01-25 10:00:00', '2025-01-25 12:00:00', 4, 8, 200000, '2025-01-25 01:16:57', '2025-01-25 01:16:57'),
(6, 1, '2025-01-26 01:00:00', '2025-01-26 03:00:00', 1, 2, 300000, '2025-01-25 01:26:31', '2025-01-25 01:26:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `seats`
--

CREATE TABLE `seats` (
  `id` bigint UNSIGNED NOT NULL,
  `plane_id` bigint UNSIGNED NOT NULL,
  `seat_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seat_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Reguler',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `seats`
--

INSERT INTO `seats` (`id`, `plane_id`, `seat_number`, `seat_type`, `created_at`, `updated_at`) VALUES
(6, 3, '1A', 'Reguler', '2025-01-23 21:13:09', '2025-01-23 21:13:09'),
(7, 3, '1B', 'Reguler', '2025-01-23 21:13:09', '2025-01-23 21:13:09'),
(8, 3, '1C', 'Reguler', '2025-01-23 21:13:09', '2025-01-23 21:13:09'),
(9, 3, '2A', 'Reguler', '2025-01-23 21:13:09', '2025-01-23 21:13:09'),
(10, 3, '2B', 'Reguler', '2025-01-23 21:13:09', '2025-01-23 21:13:09'),
(11, 3, '2C', 'Reguler', '2025-01-23 21:13:09', '2025-01-23 21:13:09'),
(12, 3, '3A', 'Reguler', '2025-01-23 21:13:09', '2025-01-23 21:13:09'),
(13, 3, '3B', 'Reguler', '2025-01-23 21:13:09', '2025-01-23 21:13:09'),
(14, 3, '3C', 'Reguler', '2025-01-23 21:13:09', '2025-01-23 21:13:09'),
(15, 3, '4A', 'Reguler', '2025-01-23 21:13:09', '2025-01-23 21:13:09'),
(16, 1, '1A', 'Reguler', '2025-01-23 23:26:02', '2025-01-23 23:26:02'),
(17, 1, '1B', 'Reguler', '2025-01-24 06:25:58', '2025-01-24 06:29:57'),
(18, 1, '1C', 'Reguler', '2025-01-24 06:25:58', '2025-01-24 06:25:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('RWPMD2TwSjlCZRHx7DZkRpI8hOZ5l8oMkJAd9QIM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQjlyTTI1YmFnc1N0alJlemlSZjVITWV1eUEwdEw0MDB3R1VYRXQ4aSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHA6Ly9lLXRpY2tldGluZy50ZXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737873306);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','passenger','maskapai') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'passenger',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `address`, `phone`, `gender`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', NULL, '$2y$12$uxZ/eP9oMSTamBPvd5IyyusZt7045ytw5ozq1QqwcUETgC6aUbh6q', NULL, NULL, NULL, NULL, '2025-01-20 22:59:57', '2025-01-21 00:09:50'),
(2, 'Khaira', 'passenger', 'khaira@gmail.com', NULL, '$2y$12$JdGtPlvQr.CUrVSZbPEhzear8h/E.snCd365.Itbrg2ON5lRTkmmu', NULL, NULL, NULL, NULL, '2025-01-21 00:25:00', '2025-01-21 00:25:00'),
(3, 'Sabrina', 'passenger', 'sabrina@gmail.com', NULL, '$2y$12$/kjiAeacKST7aCCLJGWhb.J4y/XRGncryKx5QPost/0STYUVhOfE6', NULL, NULL, NULL, NULL, '2025-01-21 00:27:57', '2025-01-21 00:27:57'),
(4, 'Razad', 'passenger', 'razad@gmail.com', NULL, '$2y$12$rfWn/aGWTK8QCcHOYpHMMuEH6J1MALDKoe8C.L7U72qszLuDMvzpy', 'Jl. Maju terus, No. 5', '081398121212', NULL, NULL, '2025-01-21 00:29:42', '2025-01-21 00:29:42');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_schedule_id_foreign` (`schedule_id`),
  ADD KEY `bookings_seat_id_foreign` (`seat_id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

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
-- Indeks untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planes_airline_id_foreign` (`airline_id`);

--
-- Indeks untuk tabel `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_plane_id_foreign` (`plane_id`),
  ADD KEY `departure_city_id` (`departure_city_id`),
  ADD KEY `arrival_city_id` (`arrival_city_id`);

--
-- Indeks untuk tabel `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seats_plane_id_foreign` (`plane_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT untuk tabel `airlines`
--
ALTER TABLE `airlines`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kota`
--
ALTER TABLE `kota`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `planes`
--
ALTER TABLE `planes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `seats`
--
ALTER TABLE `seats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `bookings_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_seat_id_foreign` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `planes`
--
ALTER TABLE `planes`
  ADD CONSTRAINT `planes_airline_id_foreign` FOREIGN KEY (`airline_id`) REFERENCES `airlines` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `arrival_foreign_id` FOREIGN KEY (`arrival_city_id`) REFERENCES `kota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `departure_foreign_id` FOREIGN KEY (`departure_city_id`) REFERENCES `kota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedules_plane_id_foreign` FOREIGN KEY (`plane_id`) REFERENCES `planes` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_plane_id_foreign` FOREIGN KEY (`plane_id`) REFERENCES `planes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
