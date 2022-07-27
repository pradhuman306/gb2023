-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 09, 2021 at 11:17 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gbconvent`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_02_23_060335_create_permission_tables', 1),
(5, '2021_02_23_083636_create_gbs_table', 1),
(6, '2021_03_05_114441_create_years_table', 2),
(7, '2021_03_05_115135_create_student_classes_table', 3),
(8, '2021_03_06_053318_create_students_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

DROP TABLE IF EXISTS `records`;
CREATE TABLE IF NOT EXISTS `records` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `students_id` bigint(3) UNSIGNED NOT NULL,
  `class_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fees` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `students_id`, `class_name`, `session`, `fees`, `created_at`, `updated_at`) VALUES
(1, 1, '4', '1', NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19'),
(2, 2, '4', '1', NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19'),
(3, 3, '4', '1', NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19'),
(4, 4, '4', '1', NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19'),
(5, 5, '4', '1', NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19'),
(6, 6, '4', '1', NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19'),
(7, 7, '4', '1', NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19'),
(8, 8, '4', '1', NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19'),
(9, 9, '4', '1', NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19'),
(10, 10, '4', '1', NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `records_id` bigint(3) UNSIGNED NOT NULL,
  `receipt_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fees` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `records_id`, `receipt_no`, `fees`, `date`, `description`, `created_at`, `updated_at`) VALUES
(1, 9, '1', '3000', '04/01/2020', 'father', '2021-04-08 00:21:53', '2021-04-08 00:21:53'),
(2, 4, '1', '7000', '04/08/2021', 'self pay', '2021-04-08 00:22:25', '2021-04-08 00:22:25'),
(3, 3, '1', '2000', '04/03/2021', 'father', '2021-04-08 00:22:58', '2021-04-08 00:22:58'),
(4, 7, '1', '5000', '04/05/2021', 'self pay', '2021-04-08 00:23:19', '2021-04-08 00:23:19');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scholar_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `samarg_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `scholar_no`, `name`, `father_name`, `mother_name`, `dob`, `address`, `aadhar_no`, `samarg_id`, `mobile_no`, `mobile_no2`, `account_no`, `profile_picture`, `created_at`, `updated_at`) VALUES
(1, '014', 'GBC000-424', 'PAYAL BHABOR', 'MR. DILEEP BHABOR', 'MRS. HUKLI BHABOR', '01/01/2010', 'SUTRETI', '729320287511', NULL, '9327723099', NULL, NULL, '1617445905.jpg', '2021-04-03 00:06:19', '2021-04-03 05:01:45'),
(2, '015', 'GBC000-425', 'JAGDISH  MAIDA', 'MR. RAKESH MAIDA', 'MRS. ANITA MAIDA', '07/06/2012', 'UMARDA', '238506085910', NULL, '7224094014', NULL, NULL, NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19'),
(3, '016', 'GBC000-426', 'MANSVI BHABOR', 'MR. SURESH BHABOR', 'MRS. ROSHNI BHABOR', '01/31/2012', 'HATYADELI', '916428047721', NULL, '8435562027', NULL, NULL, NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19'),
(4, '027', 'GBC000-427', 'AVINASH KHADIYA', 'MR. SUNIL KHADIYA', 'MRS. JANI KHAdiya', '11/01/2012', 'SEMALPADA', '601584040433', NULL, '6260503166', NULL, NULL, NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19'),
(5, '032', 'GBC000-428', 'GAURAV KATARA', 'MR. JITENDRA KATARA', 'MRS. PARWATI KATARA', '10/04/2011', 'KHALKHANDWI', '859922132395', NULL, '9589848702', NULL, NULL, NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19'),
(6, '034', 'GBC000-429', 'HEMLATA THANDAR', 'MR. MANGLIYA THANDAR', 'MRS. LALITA THANDAR', '01/10/2012', 'GUDA', '576370844154', NULL, '7974078336', NULL, NULL, NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19'),
(7, '036', 'GBC000-430', 'SUNIL MAVI', 'MR. DULESH MAVI', 'MRS. NARMADA  MAVI', '06/03/2011', 'SUTRETI ', NULL, NULL, '9571315575', NULL, NULL, NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19'),
(8, '037', 'GBC000-431', 'PINTU KHADIYA', 'MR. NANKU KHADIYA', 'MRS. DASU KHADIYA', '05/21/2012', 'KOTNAI', NULL, NULL, '6263220980', NULL, NULL, NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19'),
(9, '039', 'GBC000-432', 'ANIL DAMOR', 'MR. BALLU  DAMOR', 'MRS. JHANGU DAMOR', '01/01/2011', NULL, '880053575521', NULL, '8827881996', NULL, NULL, NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19'),
(10, '045', 'GBC000-433', 'VANSHIKA PRAJAPAT', 'MR. PAWAN PRAJAPAT', 'MRS. JYOTI PRAJAPAT', '10/23/2013', 'ASHRAM FALIYA ', '874548566786', NULL, '6260349770', NULL, NULL, NULL, '2021-04-03 00:06:19', '2021-04-03 00:06:19');

-- --------------------------------------------------------

--
-- Table structure for table `student_classes`
--

DROP TABLE IF EXISTS `student_classes`;
CREATE TABLE IF NOT EXISTS `student_classes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `class_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_classes`
--

INSERT INTO `student_classes` (`id`, `class_name`, `created_at`, `updated_at`) VALUES
(1, 'Nursery', NULL, NULL),
(2, 'LKG', NULL, NULL),
(3, 'UKG', NULL, NULL),
(4, 'First', NULL, NULL),
(5, 'Second', NULL, NULL),
(6, 'Third', NULL, NULL),
(7, 'Fourth', NULL, NULL),
(8, 'Fifth', NULL, NULL),
(9, 'Sixth', NULL, NULL),
(10, 'Seventh', NULL, NULL),
(11, 'Eigth', NULL, NULL),
(12, 'Ninth', NULL, NULL),
(13, 'Tenth', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_fees`
--

DROP TABLE IF EXISTS `student_fees`;
CREATE TABLE IF NOT EXISTS `student_fees` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_classes_id` bigint(3) UNSIGNED NOT NULL,
  `years_id` bigint(3) UNSIGNED NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_fees`
--

INSERT INTO `student_fees` (`id`, `student_classes_id`, `years_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '6000', '2021-04-03 00:40:03', '2021-04-03 00:40:03'),
(2, 2, 1, '8000', '2021-04-03 00:40:28', '2021-04-03 00:40:28'),
(3, 4, 1, '8000', '2021-04-03 01:14:57', '2021-04-03 01:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lname`, `email`, `email_verified_at`, `password`, `user_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(13, 'Ram', NULL, 'balmukund1998@gmail.com', NULL, '$2y$10$q6TCTtUuTU2bNQEKOQIYz.taefT7nWkD5.1xnaBwWc3I2dQuDJmq.', 'Accountant', NULL, '2021-03-03 23:33:52', '2021-03-03 23:33:52'),
(34, 'Ram', NULL, NULL, NULL, '$2y$10$yNqK4QGPKbPKiGlOxvcOHOQeUxBK3lSx3/SZvpv.02lZfxyCp2Y82', 'Admin', NULL, '2021-03-23 05:29:17', '2021-03-23 05:29:17'),
(35, 'Monu', NULL, 'admin@admin.com', NULL, '$2y$10$esHWwZhg9P4iwe34y9/O0.igoo7iXXG7T0v8qkY7/GYdzVAazinYK', 'Admin', NULL, '2021-04-06 06:40:18', '2021-04-06 06:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

DROP TABLE IF EXISTS `years`;
CREATE TABLE IF NOT EXISTS `years` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `years` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `years`, `status`, `created_at`, `updated_at`) VALUES
(1, '2018-2019', 1, '2021-04-02 23:13:36', '2021-04-02 23:13:36');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
