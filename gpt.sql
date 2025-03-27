-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2025 at 09:45 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gpt`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `certificate_id` bigint(20) UNSIGNED NOT NULL,
  `template_id` bigint(20) UNSIGNED NOT NULL,
  `recipient_id` bigint(20) UNSIGNED NOT NULL,
  `issued_by` bigint(20) UNSIGNED DEFAULT NULL,
  `issue_date` date DEFAULT curdate(),
  `status` enum('draft','published','revoked') NOT NULL DEFAULT 'draft',
  `verification_code` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`certificate_id`, `template_id`, `recipient_id`, `issued_by`, `issue_date`, `status`, `verification_code`, `created_at`, `updated_at`) VALUES
(4, 1, 1, NULL, '2025-03-21', 'published', 'dd833dad-0610-11f0-9df2-089798c81e69', '2025-03-21 04:56:35', '2025-03-21 08:57:06'),
(5, 2, 2, NULL, '2025-03-21', 'draft', '1ebfa4d1-0611-11f0-9df2-089798c81e69', '2025-03-21 04:58:24', '2025-03-23 16:17:03'),
(80691319, 3, 2, 9, '2025-03-26', 'draft', 'JVDXCBCDVI', '2025-03-25 23:58:01', '2025-03-25 23:58:01'),
(80691321, 3, 1, 7, '2025-03-27', 'published', '4FSUMO9GPP', '2025-03-27 01:36:14', '2025-03-27 01:36:25');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, '550e8400-e29b-41d4-a716-446655440000', 'database', 'default', '{\"job\": \"ExampleJob\"}', 'Sample exception message', '2025-03-21 04:51:27'),
(3, '1ec26621-0611-11f0-9df2-089798c81e69', 'database', 'default', '{\"job\": \"ExampleJob\"}', 'Sample exception message', '2025-03-21 04:58:24'),
(4, '38a03474-0611-11f0-9df2-089798c81e69', 'database', 'default', '{\"job\": \"ExampleJob\"}', 'Sample exception message', '2025-03-21 04:59:08'),
(5, '5f5af9f0-0611-11f0-9df2-089798c81e69', 'database', 'default', '{\"job\": \"ExampleJob\"}', 'Sample exception message', '2025-03-21 05:00:13'),
(6, '8cc6d3a9-0611-11f0-9df2-089798c81e69', 'database', 'default', '{\"job\": \"ExampleJob\"}', 'Sample exception message', '2025-03-21 05:01:29'),
(7, 'a68fe295-0611-11f0-9df2-089798c81e69', 'database', 'default', '{\"job\": \"ExampleJob\"}', 'Sample exception message', '2025-03-21 05:02:12');

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
(1, '2025_03_21_000001_create_certificates_table', 1),
(2, '2025_03_21_000001_create_certificates_table', 1),
(3, '2025_03_21_000001_create_certificates_table', 1),
(4, '2025_03_21_000001_create_certificates_table', 1),
(5, '2025_03_21_000001_create_certificates_table', 1),
(6, '2025_03_21_000001_create_certificates_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('sari@example.com', '38a46b63-0611-11f0-9df2-089798c81e69', NULL),
('user@example.com', 'hashed-reset-token', NULL);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'API Token', '', '[\"*\"]', '2025-03-21 04:51:27', '2025-03-21 04:51:27', '2025-03-21 04:51:27'),
(3, 'App\\Models\\User', 1, 'API Token', '8ccf1557-0611-11f0-9df2-089798c81e69', '[\"*\"]', '2025-03-21 05:01:29', '2025-03-21 05:01:29', '2025-03-21 05:01:29'),
(4, 'App\\Models\\User', 1, 'API Token', 'a694dc30-0611-11f0-9df2-089798c81e69', '[\"*\"]', '2025-03-21 05:02:12', '2025-03-21 05:02:12', '2025-03-21 05:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `recipients`
--

CREATE TABLE `recipients` (
  `recipient_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipients`
--

INSERT INTO `recipients` (`recipient_id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'johndoe@example.com', '2025-03-21 04:51:27', '2025-03-21 04:51:27'),
(2, 'Dwi', 'dwiyours@gmail.com', '2025-03-23 04:32:30', '2025-03-23 04:32:30'),
(4, 'Afifah Nur', 'nur@gmail.com', '2025-03-26 07:57:19', '2025-03-26 07:57:19'),
(5, 'Syarifah N', 'syarifah@gmail.com', '2025-03-26 21:25:16', '2025-03-26 23:48:50'),
(6, 'Nanda', 'nanda@example.com', '2025-03-26 23:49:23', '2025-03-26 23:53:03'),
(8, 'Azzah', 'azzah@example.com', '2025-03-26 23:58:45', '2025-03-26 23:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `layout_storage` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `name`, `file_path`, `created_by`, `created_at`, `updated_at`, `layout_storage`) VALUES
(1, 'Certificate Template 1', '/storage/templates/template1.pdf', 1, '2025-03-21 04:51:27', '2025-03-21 04:51:27', NULL),
(2, 'Certificate Template 2', 'templates/7JOlqCGXSKXd8lcI7dXdlXgRl4ge4SiMyyYZCfU8.png', 1, '2025-03-21 05:02:12', '2025-03-24 03:12:53', 'f'),
(3, 'Test 1', 'templates/jXU28EsY9b5ctMHGE2vQgulWfsneR0fX4yZsXBWn.png', 7, '2025-03-24 03:08:18', '2025-03-25 22:24:20', 'p');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', '2025-03-20 10:02:12', '$2y$10$C.OUcReLSndQMN8ETEoWuOu62E/b1Tp1povDnNa6J7kjyaCUsuCne', '2DVaJ4RoEy', '2025-03-20 10:02:12', '2025-03-20 10:02:12'),
(7, 'ws', 'ws@gmail.com', NULL, '$2y$10$5UNbYhEd9Cp7HMYTYtLvg.keaUfFQ4bxdEleVD1EeSMwVbfxDAply', NULL, '2025-03-24 00:01:46', '2025-03-24 00:01:46'),
(8, 'Athikah Dwi Hapsari', 'you1@gmail.com', NULL, '$2y$10$fOf2lIJtBl/HGjJFKYImjureXZn3A87VmBIQ7fJ3xLrpMsnlqxpr.', NULL, '2025-03-24 02:05:39', '2025-03-24 02:05:39'),
(9, 'Afifah Nur', 'nur@gmail.com', NULL, '$2y$10$Jei0QtYYBHMgUxmXtx1fWeiUqcxdF7DrKkjMx7JdrGU8IbRhggnTS', NULL, '2025-03-24 15:07:07', '2025-03-24 15:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `verifications`
--

CREATE TABLE `verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `verification_code` varchar(50) NOT NULL,
  `verified_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verified_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verifications`
--

INSERT INTO `verifications` (`id`, `verification_code`, `verified_at`, `verified_by`, `created_at`, `updated_at`) VALUES
(7, 'dd833dad-0610-11f0-9df2-089798c81e69', '2025-03-26 07:04:31', 'i', '2025-03-26 07:04:03', '2025-03-26 07:04:03'),
(8, 'JVDXCBCDVI', '2025-03-26 20:05:27', 'Perusahaan', '2025-03-26 20:05:27', '2025-03-26 20:05:27'),
(9, '1ebfa4d1-0611-11f0-9df2-089798c81e69', '2025-03-26 20:06:23', 'Pribadi', '2025-03-26 20:06:23', '2025-03-26 20:06:23'),
(10, '4FSUMO9GPP', '2025-03-27 01:37:09', 'Test', '2025-03-27 01:37:09', '2025-03-27 01:37:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`certificate_id`),
  ADD UNIQUE KEY `verification_code` (`verification_code`),
  ADD KEY `template_id` (`template_id`),
  ADD KEY `recipient_id` (`recipient_id`),
  ADD KEY `issued_by` (`issued_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `recipients`
--
ALTER TABLE `recipients`
  ADD PRIMARY KEY (`recipient_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `verifications`
--
ALTER TABLE `verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_verifications_certificate` (`verification_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `certificate_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80691322;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `recipients`
--
ALTER TABLE `recipients`
  MODIFY `recipient_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `verifications`
--
ALTER TABLE `verifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `certificates_ibfk_2` FOREIGN KEY (`recipient_id`) REFERENCES `recipients` (`recipient_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `certificates_ibfk_3` FOREIGN KEY (`issued_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `templates`
--
ALTER TABLE `templates`
  ADD CONSTRAINT `templates_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `verifications`
--
ALTER TABLE `verifications`
  ADD CONSTRAINT `fk_verifications_certificate` FOREIGN KEY (`verification_code`) REFERENCES `certificates` (`verification_code`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
