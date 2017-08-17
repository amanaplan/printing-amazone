-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2017 at 06:02 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `printing-amazone`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `profile_pic`, `password`, `remember_token`, `super_admin`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Sourav R', 'srv.nxr@gmail.com', 'avatar2.png', '$2y$10$1ehSKhL5I7eGaFs0f8VKMObmsFC10rBHXXdNpZG.cC9TUhtNsrd46', 'P3kRQNccqpr6Y3XvqzpxuIIBxSRy6yqklfcAlBdPpeRVExJWWBa7wx4vZAqv', 1, 1, '2017-05-03 11:34:00', '2017-05-12 17:20:06'),
(5, 'Printing Amazone', 'printingamazon0902@gmail.com', 'avatar2.png', '$2y$10$ZkuO1h6NJbJIdsuJx1a3hO0tas.XRvxNCR/HcPAg2/5X21WVK5sZC', NULL, 0, 1, '2017-05-26 16:15:40', '2017-06-19 13:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  `og_title` text COLLATE utf8mb4_unicode_ci,
  `meta_desc` text COLLATE utf8mb4_unicode_ci,
  `og_desc` text COLLATE utf8mb4_unicode_ci,
  `og_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `og_title`, `meta_desc`, `og_desc`, `og_img`, `category_name`, `category_slug`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'sticker page title', 'sticker page title', 'sticker page meta desc', 'sticker page meta desc', 'banner-bg.jpg', 'Sticker', 'sticker', 1, '2017-05-26 15:10:37', '2017-06-19 13:38:20'),
(2, NULL, NULL, NULL, NULL, NULL, 'Business Card', 'business-card', 2, '2017-06-19 13:00:47', '2017-06-19 13:38:27'),
(3, NULL, NULL, NULL, NULL, NULL, 'Brochures/Flyers', 'brochuresflyers', 3, '2017-06-19 13:14:34', '2017-06-19 13:38:35'),
(4, NULL, NULL, NULL, NULL, NULL, 'Postcards', 'postcards', 4, '2017-06-19 13:14:52', '2017-06-19 13:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `email_authentication`
--

CREATE TABLE `email_authentication` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_authentication`
--

INSERT INTO `email_authentication` (`id`, `email`, `token`, `created_at`, `updated_at`) VALUES
(1, 'reach@devsourav.com', 'c8891b64e71a0b45b6fc8c32d5f2027c0039278adf6fc02942861954f0a75c1c8f1e5de197384d10c11f6d7644f0b1dec89031353030343731373131', '2017-07-19 15:12:44', '2017-07-19 18:11:51');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_field_types`
--

CREATE TABLE `form_field_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_field_types`
--

INSERT INTO `form_field_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'paperstock', '2017-06-20 18:30:00', '2017-06-20 18:30:00'),
(2, 'size', '2017-06-20 18:30:00', '2017-06-20 18:30:00'),
(3, 'quantity', '2017-06-20 18:30:00', '2017-06-20 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `map_prod_form`
--

CREATE TABLE `map_prod_form` (
  `id` int(10) UNSIGNED NOT NULL,
  `form_field_id` int(11) NOT NULL COMMENT 'paperstock, size etc.',
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `map_prod_form`
--

INSERT INTO `map_prod_form` (`id`, `form_field_id`, `product_id`) VALUES
(38, 1, 4),
(39, 2, 4),
(40, 3, 4),
(41, 1, 2),
(42, 2, 2),
(43, 3, 2),
(44, 1, 17),
(45, 2, 17),
(46, 3, 17),
(50, 1, 19),
(51, 2, 19),
(52, 3, 19),
(53, 1, 20),
(54, 2, 20),
(55, 3, 20),
(56, 1, 21),
(57, 2, 21),
(58, 3, 21),
(59, 1, 22),
(60, 2, 22),
(61, 3, 22);

-- --------------------------------------------------------

--
-- Table structure for table `map_prod_form_options`
--

CREATE TABLE `map_prod_form_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `mapping_field_id` int(11) NOT NULL COMMENT 'mapping id of map_prod_form table',
  `option_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `map_prod_form_options`
--

INSERT INTO `map_prod_form_options` (`id`, `mapping_field_id`, `option_id`, `sort`) VALUES
(13, 38, 1, 1),
(14, 38, 5, 4),
(17, 39, 3, 1),
(18, 39, 4, 2),
(19, 39, 5, 3),
(20, 39, 6, 4),
(21, 39, 7, 5),
(22, 40, 1, 5),
(23, 40, 2, 1),
(24, 40, 3, 2),
(25, 40, 4, 4),
(26, 40, 5, 3),
(27, 44, 1, 1),
(28, 44, 5, 2),
(30, 44, 6, 3),
(31, 44, 7, 7),
(32, 45, 8, 1),
(33, 45, 9, 2),
(34, 45, 10, 3),
(35, 45, 11, 4),
(36, 46, 1, 5),
(37, 46, 2, 1),
(38, 46, 3, 2),
(39, 46, 4, 4),
(40, 46, 5, 3),
(42, 41, 5, 1),
(44, 41, 7, 2),
(45, 41, 4, 3),
(46, 41, 6, 4),
(47, 41, 3, 5),
(48, 42, 8, 0),
(49, 42, 9, 0),
(50, 42, 10, 0),
(51, 42, 11, 0),
(52, 43, 1, 5),
(53, 43, 2, 1),
(54, 43, 3, 2),
(55, 43, 4, 4),
(56, 43, 5, 3),
(57, 50, 1, 1),
(58, 50, 5, 2),
(59, 51, 8, 0),
(60, 51, 9, 0),
(61, 51, 10, 0),
(62, 51, 11, 0),
(63, 52, 1, 5),
(64, 52, 2, 1),
(65, 52, 3, 2),
(66, 52, 4, 4),
(67, 52, 5, 3),
(68, 53, 7, 1),
(69, 53, 3, 2),
(70, 54, 8, 1),
(71, 54, 9, 2),
(72, 54, 10, 3),
(73, 54, 11, 4),
(74, 55, 1, 5),
(75, 55, 2, 1),
(76, 55, 3, 2),
(77, 55, 4, 4),
(78, 55, 5, 3),
(79, 56, 1, 1),
(80, 56, 5, 4),
(81, 56, 3, 3),
(82, 56, 4, 2),
(83, 57, 8, 1),
(84, 57, 9, 2),
(85, 57, 10, 3),
(86, 57, 11, 4),
(87, 58, 1, 5),
(88, 58, 2, 1),
(89, 58, 3, 2),
(90, 58, 4, 4),
(91, 58, 5, 3),
(92, 59, 1, 1),
(93, 59, 5, 2),
(94, 59, 7, 3),
(95, 59, 4, 4),
(96, 61, 1, 5),
(97, 61, 2, 1),
(98, 61, 3, 2),
(99, 61, 4, 4),
(100, 61, 5, 3),
(101, 60, 8, 1),
(102, 60, 9, 2),
(103, 60, 10, 3),
(104, 60, 11, 4);

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
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2017_05_03_101119_create_admins_tablele', 1),
(9, '2017_05_06_093855_add_pic_active_col_to_admin', 2),
(10, '2017_05_19_215135_EmailAuthentication', 3),
(12, '2017_05_22_200726_add_pic_col_to_user', 4),
(13, '2017_05_24_191515_category_table', 4),
(14, '2017_05_26_181014_products_table', 4),
(15, '2017_05_26_185022_add_category_n_sort_col_to_products_table', 5),
(16, '2017_05_26_200907_add_description_col_to_products_table', 6),
(17, '2017_06_19_185132_add_sort_col_to_category', 7),
(22, '2017_06_21_185142_add_form_col_to_category', 8),
(23, '2017_06_21_190034_product_form_elements', 8),
(24, '2017_06_21_192946_create_paperstock_options_table', 8),
(25, '2017_06_21_200923_create_size_options_table', 9),
(26, '2017_06_21_201003_create_qty_options_table', 9),
(27, '2017_06_21_201804_mapping_of_product_and_form', 10),
(28, '2017_06_21_201853_mapping_of_product_and_form_options', 10),
(29, '2017_06_23_204532_add_sort_col_to_options_mapping', 11),
(30, '2017_07_10_214057_create_admin_password_reset_table', 12),
(31, '2017_07_14_184436_create_review_table', 12),
(32, '2017_07_14_185909_add_publish_column_to_review_table', 13),
(33, '2017_07_19_234257_create_jobs_table', 14),
(34, '2017_07_19_235016_create_failed_jobs_table', 15),
(35, '2017_07_26_205807_create_preset_general_pricing', 16),
(36, '2017_07_26_210109_create_preset_qtyrule_one', 16),
(37, '2017_07_26_210126_create_preset_qtyrule_two', 16),
(38, '2017_08_12_233433_create_special_products_review_table', 17),
(39, '2017_08_12_233958_create_special_products_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `paperstock_options`
--

CREATE TABLE `paperstock_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `option` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paperstock_options`
--

INSERT INTO `paperstock_options` (`id`, `option`) VALUES
(1, 'Glossy & Matt paperboard (Artboard)'),
(5, 'Kraft Paperboard'),
(6, 'PVC paperboard'),
(7, 'Silver Matt paperboard'),
(3, 'Transparent Paper'),
(4, 'Waterproof paperboard');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preset_general`
--

CREATE TABLE `preset_general` (
  `id` int(10) UNSIGNED NOT NULL,
  `map_prod_form_option` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `val_per_mmsq` double(4,2) DEFAULT NULL,
  `profit_percent` double(4,2) DEFAULT NULL,
  `min_size` int(11) NOT NULL,
  `max_size` int(11) NOT NULL,
  `is_base` tinyint(4) NOT NULL DEFAULT '0',
  `base_price` double(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `preset_general`
--

INSERT INTO `preset_general` (`id`, `map_prod_form_option`, `from`, `to`, `val_per_mmsq`, `profit_percent`, `min_size`, `max_size`, `is_base`, `base_price`) VALUES
(5, 13, 0, 47, NULL, NULL, 3, 45, 1, 69.00),
(6, 13, 48, 90, 0.25, 0.50, 3, 45, 0, NULL),
(7, 13, 91, 135, 0.24, 0.49, 3, 45, 0, NULL),
(8, 13, 136, 450, 0.23, 0.48, 3, 45, 0, NULL),
(9, 14, 0, 47, NULL, NULL, 3, 45, 1, 68.00),
(10, 14, 48, 90, 0.25, 0.50, 4, 45, 0, NULL),
(11, 14, 91, 135, 0.24, 0.49, 4, 45, 0, NULL),
(12, 14, 136, 450, 0.20, 0.40, 40, 450, 0, NULL),
(13, 27, 0, 470, 0.25, 0.50, 30, 250, 1, 63.00),
(14, 27, 471, 900, 0.24, 0.49, 30, 250, 0, NULL),
(15, 27, 901, 1350, 0.24, 0.49, 30, 250, 0, NULL),
(16, 27, 1351, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(17, 28, 0, 410, 0.25, 0.50, 30, 250, 1, 93.00),
(18, 28, 411, 600, 0.24, 0.49, 30, 250, 0, NULL),
(19, 28, 601, 800, 0.24, 0.49, 30, 250, 0, NULL),
(20, 28, 801, 1200, 0.24, 0.49, 30, 250, 0, NULL),
(22, 28, 1201, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(23, 30, 0, 320, 0.25, 0.50, 30, 250, 1, 99.99),
(24, 30, 321, 500, 0.24, 0.49, 30, 250, 0, NULL),
(25, 30, 501, 700, 0.24, 0.49, 30, 250, 0, NULL),
(26, 30, 701, 900, 0.24, 0.49, 30, 250, 0, NULL),
(27, 30, 901, 1200, 0.24, 0.49, 30, 250, 0, NULL),
(28, 30, 1201, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(29, 31, 0, 320, 0.25, 0.50, 30, 250, 1, 99.00),
(30, 31, 321, 500, 0.24, 0.49, 30, 250, 0, NULL),
(31, 31, 501, 800, 0.24, 0.49, 30, 250, 0, NULL),
(32, 31, 801, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(33, 42, 0, 410, 0.25, 0.50, 30, 250, 1, 93.00),
(34, 42, 411, 600, 0.24, 0.49, 30, 250, 0, NULL),
(35, 42, 601, 800, 0.24, 0.49, 30, 250, 0, NULL),
(36, 42, 801, 1200, 0.24, 0.49, 30, 250, 0, NULL),
(37, 42, 1201, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(38, 46, 0, 320, 0.24, 0.50, 30, 250, 1, 99.99),
(39, 46, 321, 500, 0.24, 0.49, 30, 250, 0, NULL),
(40, 46, 501, 700, 0.24, 0.49, 30, 250, 0, NULL),
(41, 46, 701, 900, 0.24, 0.49, 30, 250, 0, NULL),
(42, 46, 901, 1200, 0.24, 0.49, 30, 250, 0, NULL),
(43, 46, 1201, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(44, 44, 0, 320, 0.25, 0.50, 30, 250, 1, 99.00),
(45, 44, 321, 500, 0.24, 0.49, 30, 250, 0, NULL),
(46, 44, 501, 800, 0.24, 0.49, 30, 250, 0, NULL),
(47, 44, 801, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(48, 47, 0, 370, 0.25, 0.50, 30, 250, 1, 95.00),
(49, 47, 371, 700, 0.24, 0.49, 30, 250, 0, NULL),
(50, 47, 701, 900, 0.24, 0.49, 30, 250, 0, NULL),
(51, 47, 901, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(52, 45, 0, 370, 0.25, 0.50, 30, 250, 1, 91.00),
(53, 45, 371, 900, 0.24, 0.49, 30, 250, 0, NULL),
(54, 45, 901, 1200, 0.24, 0.49, 30, 250, 0, NULL),
(55, 45, 1201, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(56, 57, 0, 470, 0.25, 0.50, 30, 250, 1, 63.00),
(57, 57, 471, 900, 0.24, 0.49, 30, 250, 0, NULL),
(58, 57, 901, 1350, 0.24, 0.49, 30, 250, 0, NULL),
(59, 57, 1351, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(60, 58, 0, 470, 0.24, 0.49, 30, 250, 0, NULL),
(62, 58, 471, 900, 0.24, 0.49, 30, 250, 0, NULL),
(63, 58, 901, 1350, 0.24, 0.49, 30, 250, 0, NULL),
(64, 58, 1351, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(65, 69, 0, 470, 0.25, 0.50, 30, 250, 1, 69.00),
(66, 69, 471, 900, 0.24, 0.49, 30, 250, 0, NULL),
(67, 69, 901, 1350, 0.24, 0.49, 30, 250, 0, NULL),
(68, 69, 1351, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(69, 68, 0, 470, 0.25, 0.50, 30, 250, 1, 99.00),
(70, 68, 471, 900, 0.24, 0.49, 30, 250, 0, NULL),
(71, 68, 901, 1350, 0.24, 0.49, 30, 250, 0, NULL),
(72, 68, 1351, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(73, 79, 0, 250, 0.25, 0.50, 30, 250, 1, 75.00),
(74, 79, 251, 900, 0.24, 0.49, 30, 250, 0, NULL),
(75, 79, 901, 1350, 0.24, 0.49, 30, 250, 0, NULL),
(76, 79, 1351, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(77, 80, 0, 250, 0.25, 0.50, 30, 250, 1, 95.00),
(78, 80, 251, 600, 0.24, 0.49, 30, 250, 0, NULL),
(79, 80, 601, 800, 0.24, 0.49, 30, 250, 0, NULL),
(80, 80, 801, 1200, 0.24, 0.49, 30, 250, 0, NULL),
(81, 80, 1201, 1500, 0.24, 0.49, 30, 250, 0, NULL),
(82, 80, 1501, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(83, 81, 0, 250, 0.25, 0.50, 30, 250, 1, 99.00),
(84, 81, 251, 900, 0.24, 0.49, 30, 250, 0, NULL),
(85, 81, 901, 1200, 0.24, 0.49, 30, 250, 0, NULL),
(86, 81, 1201, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(87, 82, 0, 250, 0.25, 0.50, 30, 250, 1, 95.00),
(88, 82, 251, 900, 0.24, 0.49, 30, 250, 0, NULL),
(89, 82, 901, 1200, 0.24, 0.49, 30, 250, 0, NULL),
(90, 82, 1201, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(91, 92, 0, 470, 0.25, 0.50, 30, 250, 1, 99.00),
(92, 92, 471, 900, 0.24, 0.49, 30, 250, 0, NULL),
(93, 92, 901, 1350, 0.24, 0.49, 30, 250, 0, NULL),
(94, 92, 1351, 62500, 0.25, 0.49, 30, 250, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `preset_qty_rule_one`
--

CREATE TABLE `preset_qty_rule_one` (
  `id` int(10) UNSIGNED NOT NULL,
  `map_prod_form_option` int(11) NOT NULL,
  `order_qty_frm` int(11) NOT NULL,
  `order_qty_to` int(11) NOT NULL,
  `disc_rate` double(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `preset_qty_rule_one`
--

INSERT INTO `preset_qty_rule_one` (`id`, `map_prod_form_option`, `order_qty_frm`, `order_qty_to`, `disc_rate`) VALUES
(4, 13, 100, 199, 57.00),
(5, 13, 200, 299, 70.00),
(6, 13, 300, 399, 83.00),
(7, 13, 400, 499, 89.00),
(8, 13, 500, 599, 95.00),
(9, 14, 100, 199, 57.00),
(10, 14, 200, 299, 70.00),
(11, 14, 300, 399, 83.00),
(12, 14, 400, 499, 89.00),
(13, 14, 500, 599, 95.00);

-- --------------------------------------------------------

--
-- Table structure for table `preset_qty_rule_two`
--

CREATE TABLE `preset_qty_rule_two` (
  `id` int(10) UNSIGNED NOT NULL,
  `map_prod_form_option` int(11) NOT NULL,
  `every_extra_qty` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) DEFAULT NULL,
  `disc_rate` double(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `preset_qty_rule_two`
--

INSERT INTO `preset_qty_rule_two` (`id`, `map_prod_form_option`, `every_extra_qty`, `from`, `to`, `disc_rate`) VALUES
(5, 13, 2000, 1000, 4000, 8.00),
(6, 13, 1000, 5000, 20000, 1.00),
(7, 13, 1000, 20000, NULL, 0.20),
(8, 14, 2000, 1000, 4000, 8.00),
(9, 14, 1000, 5000, 20000, 1.00),
(10, 14, 1000, 20000, 50000, 0.20);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  `meta_desc` text COLLATE utf8mb4_unicode_ci,
  `og_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sample_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `meta_desc`, `og_img`, `category_id`, `product_name`, `product_slug`, `logo`, `description`, `sample_image`, `sort`, `created_at`, `updated_at`) VALUES
(2, 'Square Stickers - Printing Amazon', 'some meta', 'Square Sticker_3.jpg', 1, 'Square Stickers', 'square-stickers', 'cs-4.png', 'Our custom square stickers are great for logos, product labels, artwork reproductions and more. Our proof approval process lets you work directly with us to ensure the size, borders, and look are perfect for your business.', 'Square Sticker.png*Square Sticker_2.jpg*Square Sticker_3.jpg*Square Sticker_4.jpg', 2, '2017-05-30 14:35:51', '2017-08-15 13:46:29'),
(4, 'Free Shaping Business Card', NULL, NULL, 2, 'Free Shaping Cards', 'free-shaping-cards', 'f2.png', 'Printing Amazon’s Premium Business Cards will set you apart from the crowd with our carefully selected materials and high definition printing technology. Our proof approval process let you work directly with us to ensure the size, corners, and look are perfect. From every day to extra special. With a variety of stocks and specialty finishes, designing your unique custom business cards is easier than you think.', 'Lettering Decal_1.jpg', 2, '2017-06-19 15:22:41', '2017-08-15 16:07:48'),
(17, 'Rectangle Stickers - Printing Amazon', NULL, NULL, 1, 'Rectangle Stickers', 'rectangle-stickers', 'cs-4.png', 'Custom rectangle stickers make great business card stickers, product labels, envelope seals and more. Our proof approval process lets you work directly with us to ensure the size, borders, and look are perfect for your needs.', 'Rectangle Sticker_1.jpg', 3, '2017-08-15 14:00:51', '2017-08-15 14:19:28'),
(19, 'Rectangle Postcards', NULL, NULL, 4, 'Rectangle Postcards', 'rectangle-postcards', 'f2.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Postcard_1.jpg', 1, '2017-08-15 16:23:21', '2017-08-15 16:23:21'),
(20, 'Rounded Corner', NULL, NULL, 3, 'Rounded Corner', 'rounded-corner', 'f2.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Die-cutting_7.jpg', 1, '2017-08-15 16:42:47', '2017-08-15 16:42:47'),
(21, 'Circle Stickers', NULL, NULL, 1, 'Circle Stickers', 'circle-stickers', 'cs-4.png', 'Easy to hand out, Printing Amazon’s Circle Stickers are a great way to promote your brand or label your products. Our proof approval process lets you work directly with us to ensure the size, borders, and look are perfect.', 'Round Sticker_1.png', 4, '2017-08-15 16:57:52', '2017-08-15 16:57:52'),
(22, 'Name stickers - Printing Amazon', NULL, NULL, 1, 'Name stickers', 'name-stickers', 'cs-4.png', 'If you are getting headaches with your kids because they lose their belongings at school, try our Name stickers. We provide various forms of pre-designed artworks and you only simply need to let us know the detail that you would like to apply onto the sticker and you would a name sticker you would be proud of.', 'KidsStickers.jpg[Animal Town - 0004582] * NameStickers_V2.jpg[Ben10 Ultimate Pack]', 5, '2017-08-16 13:48:57', '2017-08-17 13:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `product_special`
--

CREATE TABLE `product_special` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  `meta_desc` text COLLATE utf8mb4_unicode_ci,
  `og_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sample_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_special`
--

INSERT INTO `product_special` (`id`, `title`, `meta_desc`, `og_img`, `product_name`, `product_slug`, `logo`, `description`, `sample_image`, `created_at`, `updated_at`) VALUES
(1, 'Labels', NULL, NULL, 'Labels', 'labels', 'cs-4.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices urna vitae mauris dictum dignissim. Pellentesque porta, lectus id pulvinar hendrerit, felis ligula varius lectus, eu auctor arcu lectus eleifend ipsum. Duis in magna nec tortor tincidunt feugiat eu ut eros. Morbi consectetur felis nec', 'Decal Sticker_4.jpg', '2017-08-11 18:30:00', '2017-08-16 13:44:31'),
(2, NULL, NULL, NULL, 'Graphic Designs', 'graphic-designs', 'cs-4.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices urna vitae mauris dictum dignissim. Pellentesque porta, lectus id pulvinar hendrerit, felis ligula varius lectus, eu auctor arcu lectus eleifend ipsum. Duis in magna nec tortor tincidunt feugiat eu ut eros. Morbi consectetur felis nec', 'hacker-internet-technology-computers-159195.jpeg*gshock-watch-sports-watch-stopwatch-158741.jpeg', '2017-08-11 18:30:00', '2017-08-16 13:45:10');

-- --------------------------------------------------------

--
-- Table structure for table `qty_options`
--

CREATE TABLE `qty_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `option` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qty_options`
--

INSERT INTO `qty_options` (`id`, `option`) VALUES
(1, 1000),
(2, 100),
(3, 200),
(4, 500),
(5, 300);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` decimal(4,1) NOT NULL,
  `publish` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `title`, `description`, `rating`, `publish`, `created_at`, `updated_at`) VALUES
(2, 4, 1, 'Lorem ipsum dolor sit amet, consectetur', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.', '2.5', 1, '2017-07-14 21:41:53', '2017-07-17 16:58:06'),
(3, 4, 2, 'est, qui dolorem ipsum quia dolor sit amet', 'est, qui dolorem ipsum quia dolor sit ametest, qui dolorem ipsum quia dolor sit ametest, qui dolorem ipsum quia dolor sit ametest, qui dolorem ipsum quia dolor sit ametest, qui dolorem ipsum quia dolor sit amet', '3.5', 1, '2017-07-14 21:44:15', '2017-07-14 21:44:44'),
(4, 4, 2, 'est, qui dolorem ipsum quia dolor sit', 'est, qui dolorem ipsum quia dolor sit ametest, qui dolorem ipsum quia dolor sit ametest, qui dolorem ipsum quia dolor sit amet', '3.0', 1, '2017-07-14 22:10:12', '2017-07-22 18:47:44'),
(8, 4, 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', '2.5', 1, '2017-07-17 14:45:16', '2017-07-20 22:25:04'),
(70, 2, 2, 'number_format — Format a number with grouped thousandsnumber', 'number_format — Format a number with grouped thousandsnumber_format — Format a number with grouped thousandsnumber_format — Format a number with grouped thousandsnumber_format — Format a number with grouped thousands', '3.5', 1, '2017-07-22 17:31:35', '2017-07-22 17:31:49'),
(73, 4, 2, 'Reference site about Lorem Ipsum, giving information', 'Reference site about Lorem Ipsum, giving informationReference site about Lorem Ipsum, giving informationReference site about Lorem Ipsum, giving informationReference site about Lorem Ipsum, giving information', '5.0', 1, '2017-07-22 21:49:17', '2017-07-22 21:50:26'),
(74, 4, 1, 'There are many variations of passages of Lorem Ipsum availab', 'but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet', '4.0', 1, '2017-07-22 21:52:53', '2017-08-16 13:43:42'),
(75, 22, 2, 'Sed ut perspiciatis unde omnis iste natus error sit voluptat', 'quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione', '4.0', 1, '2017-08-17 20:07:07', '2017-08-17 20:07:42');

-- --------------------------------------------------------

--
-- Table structure for table `review_special`
--

CREATE TABLE `review_special` (
  `id` int(10) UNSIGNED NOT NULL,
  `special_product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` decimal(4,1) NOT NULL,
  `publish` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `size_options`
--

CREATE TABLE `size_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `display_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `size_options`
--

INSERT INTO `size_options` (`id`, `display_value`, `width`, `height`) VALUES
(1, 'small (11cm x 20cm)', 11, 20),
(2, 'Large A1 Paper (17 x 10)', 17, 10),
(3, '5 x 5 mm', 5, 5),
(4, '7 x 7 mm', 7, 7),
(5, '9 x 9 mm', 9, 9),
(6, '12 x 12 mm', 12, 12),
(7, '15 x 15 mm', 15, 15),
(8, '50 x 50 mm', 50, 50),
(9, '70 x 70 mm', 70, 70),
(10, '90 x 90 mm', 90, 90),
(11, '120 x 120 mm', 120, 120);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `photo`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Sourav', 'developer.srv1@gmail.com', 'avatar21500453464.png', '$2y$10$1ehSKhL5I7eGaFs0f8VKMObmsFC10rBHXXdNpZG.cC9TUhtNsrd46', 'bvbc01TRl5wQWhm6r2HHGDqx8zHyt2G6jccFmgeb7Mh3ySHvlX863pRhw9uW', '2017-05-03 05:53:37', '2017-07-19 13:07:44'),
(2, 'Sourav Rakshit', 'srv.nxr@gmail.com', 'depositphotos_56695985-stock-illustration-male-avatar.jpg', '$2y$10$vTSYi53gm8fBEqEvZbD0l..Gm3Nioiv8A693txll7/3eR7qVy4hWq', 'ixGnpekPTDSjyzGjEFUvoPMohoUqyMj1aWVIyYFL5hyCfg7fQ6T6azgvJpH3', '2017-05-18 16:08:04', '2017-07-22 18:16:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD KEY `admin_password_resets_email_index` (`email`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_category_name_unique` (`category_name`),
  ADD UNIQUE KEY `category_category_slug_unique` (`category_slug`);

--
-- Indexes for table `email_authentication`
--
ALTER TABLE `email_authentication`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_authentication_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_field_types`
--
ALTER TABLE `form_field_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `form_field_types_name_unique` (`name`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_at_index` (`queue`,`reserved_at`);

--
-- Indexes for table `map_prod_form`
--
ALTER TABLE `map_prod_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `map_prod_form_options`
--
ALTER TABLE `map_prod_form_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paperstock_options`
--
ALTER TABLE `paperstock_options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paperstock_options_option_unique` (`option`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `preset_general`
--
ALTER TABLE `preset_general`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preset_qty_rule_one`
--
ALTER TABLE `preset_qty_rule_one`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preset_qty_rule_two`
--
ALTER TABLE `preset_qty_rule_two`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_product_name_unique` (`product_name`),
  ADD UNIQUE KEY `products_product_slug_unique` (`product_slug`);

--
-- Indexes for table `product_special`
--
ALTER TABLE `product_special`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_special_product_name_unique` (`product_name`),
  ADD UNIQUE KEY `product_special_product_slug_unique` (`product_slug`);

--
-- Indexes for table `qty_options`
--
ALTER TABLE `qty_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_special`
--
ALTER TABLE `review_special`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size_options`
--
ALTER TABLE `size_options`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `email_authentication`
--
ALTER TABLE `email_authentication`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `form_field_types`
--
ALTER TABLE `form_field_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `map_prod_form`
--
ALTER TABLE `map_prod_form`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `map_prod_form_options`
--
ALTER TABLE `map_prod_form_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `paperstock_options`
--
ALTER TABLE `paperstock_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `preset_general`
--
ALTER TABLE `preset_general`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT for table `preset_qty_rule_one`
--
ALTER TABLE `preset_qty_rule_one`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `preset_qty_rule_two`
--
ALTER TABLE `preset_qty_rule_two`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `product_special`
--
ALTER TABLE `product_special`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `qty_options`
--
ALTER TABLE `qty_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `review_special`
--
ALTER TABLE `review_special`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `size_options`
--
ALTER TABLE `size_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
