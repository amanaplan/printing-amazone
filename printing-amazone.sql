-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2017 at 01:18 PM
-- Server version: 10.2.6-MariaDB
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
  `super_admin` tinyint(4) NOT NULL DEFAULT 0,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `profile_pic`, `password`, `remember_token`, `super_admin`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Sourav R', 'srv.nxr@gmail.com', 'avatar2.png', '$2y$10$1ehSKhL5I7eGaFs0f8VKMObmsFC10rBHXXdNpZG.cC9TUhtNsrd46', 'P3kRQNccqpr6Y3XvqzpxuIIBxSRy6yqklfcAlBdPpeRVExJWWBa7wx4vZAqv', 1, 1, '2017-05-03 11:34:00', '2017-05-12 17:20:06'),
(5, 'Printing Amazone', 'printingamazon0902@gmail.com', 'avatar2.png', '$2y$10$ZkuO1h6NJbJIdsuJx1a3hO0tas.XRvxNCR/HcPAg2/5X21WVK5sZC', 'doaiZ0syVp3f0kdppl6dE3ZmS691BTIqNlYO0iIonQ1697LHoCgs0t6hI0Sl', 0, 1, '2017-05-26 16:15:40', '2017-09-05 00:05:13');

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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `cart_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL,
  `paperstock` int(11) NOT NULL,
  `width` double(7,2) NOT NULL,
  `height` double(7,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `sticker_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laminating` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sticker_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `artwork` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preset_mapper` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `cart_token`, `user_id`, `product_id`, `paperstock`, `width`, `height`, `qty`, `price`, `sticker_type`, `laminating`, `sticker_name`, `artwork`, `instructions`, `preset_mapper`, `created_at`, `updated_at`) VALUES
(1, 'c397da159a5a6f08cd71e36986795a6ed298d1ef', 0, 20, 3, 90.00, 90.00, 500, '4763.00', NULL, NULL, NULL, 'artworks/iMikZ3psK2FX2NcD9GccbGoowb74e3ALJy4LDi95.jpeg', NULL, 69, '2017-08-22 17:35:33', '2017-08-22 17:35:33'),
(62, 'f69cac096d0363504e604cc1d5f862128d513531', 0, 25, 1, 40.00, 40.00, 10, '26.00', NULL, NULL, NULL, NULL, NULL, 153, '2017-09-08 02:10:00', '2017-09-08 02:10:00'),
(68, '1cf01403e1a2a9f5e9008a57c6e86c0c6e5d5b3a', 0, 25, 1, 40.00, 40.00, 10, '26.00', NULL, NULL, NULL, NULL, NULL, 153, '2017-09-12 03:04:07', '2017-09-12 03:04:07'),
(70, '96181f0cb4e52467977ff1d9e28dc263d4565439', 1, 25, 1, 50.00, 50.00, 3000, '131.00', NULL, NULL, NULL, NULL, NULL, 153, '2017-09-13 09:57:45', '2017-09-13 09:57:45');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `show_in_menu` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `og_title`, `meta_desc`, `og_desc`, `og_img`, `category_name`, `category_slug`, `sort`, `show_in_menu`, `created_at`, `updated_at`) VALUES
(1, 'Sticker - Printing Amazon', 'Sticker - Printing Amazon', 'sticker page meta desc', 'sticker page meta desc', 'banner-bg.jpg', 'Custom Stickers', 'custom-stickers', 1, 1, '2017-05-26 15:10:37', '2017-09-05 13:59:32'),
(2, 'Business Card - Printing Amazon', 'Business Card - Printing Amazon', NULL, NULL, NULL, 'Business Card', 'business-card', 2, 0, '2017-06-19 13:00:47', '2017-09-05 13:59:44'),
(3, 'Brochures/Flyers - Printing Amazon', 'Brochures/Flyers - Printing Amazon', NULL, NULL, NULL, 'Brochures/Flyers', 'brochuresflyers', 3, 0, '2017-06-19 13:14:34', '2017-09-05 13:59:50'),
(4, 'Postcards - Printing Amazon', 'Postcards - Printing Amazon', NULL, NULL, NULL, 'Postcards', 'postcards', 4, 0, '2017-06-19 13:14:52', '2017-09-05 13:59:54'),
(5, NULL, NULL, NULL, NULL, NULL, 'Uncategorized', 'uncategorized', 0, 0, '2017-08-19 13:05:36', '2017-08-19 13:05:36'),
(6, 'Preset Sized Stickers', 'Preset Sized Stickers', NULL, NULL, NULL, 'Preset Sized Stickers', 'preset-sized-stickers', 0, 1, '2017-09-05 14:00:15', '2017-09-08 13:18:15');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(10) UNSIGNED NOT NULL,
  `cc_fips` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cc_iso` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tld` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `cc_fips`, `cc_iso`, `tld`, `country_name`) VALUES
(13, 'AS', 'AU', '.au', 'Australia');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
-- Table structure for table `lamination_options`
--

CREATE TABLE `lamination_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `option` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lamination_options`
--

INSERT INTO `lamination_options` (`id`, `option`, `sort`) VALUES
(6, 'Glossy', 1),
(7, 'Waterproof', 2);

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
(53, 1, 20),
(54, 2, 20),
(55, 3, 20),
(56, 1, 21),
(57, 2, 21),
(58, 3, 21),
(59, 1, 22),
(61, 3, 22),
(62, 1, 25),
(63, 2, 25),
(64, 3, 25),
(65, 2, 22);

-- --------------------------------------------------------

--
-- Table structure for table `map_prod_form_options`
--

CREATE TABLE `map_prod_form_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `mapping_field_id` int(11) NOT NULL COMMENT 'mapping id of map_prod_form table',
  `option_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `map_prod_form_options`
--

INSERT INTO `map_prod_form_options` (`id`, `mapping_field_id`, `option_id`, `sort`) VALUES
(13, 38, 1, 1),
(14, 38, 5, 3),
(22, 40, 1, 7),
(23, 40, 2, 3),
(24, 40, 3, 4),
(25, 40, 4, 6),
(26, 40, 5, 5),
(27, 44, 1, 1),
(28, 44, 5, 2),
(31, 44, 7, 7),
(32, 45, 8, 1),
(33, 45, 9, 2),
(34, 45, 10, 3),
(35, 45, 11, 4),
(36, 46, 1, 7),
(37, 46, 2, 3),
(38, 46, 3, 4),
(39, 46, 4, 6),
(40, 46, 5, 5),
(42, 41, 5, 2),
(44, 41, 7, 6),
(45, 41, 4, 3),
(47, 41, 3, 4),
(52, 43, 1, 8),
(53, 43, 2, 3),
(54, 43, 3, 4),
(55, 43, 4, 7),
(56, 43, 5, 5),
(68, 53, 7, 1),
(69, 53, 3, 2),
(70, 54, 8, 1),
(72, 54, 10, 3),
(73, 54, 11, 4),
(74, 55, 1, 7),
(75, 55, 2, 3),
(76, 55, 3, 4),
(77, 55, 4, 6),
(78, 55, 5, 5),
(79, 56, 1, 1),
(80, 56, 5, 4),
(81, 56, 3, 3),
(82, 56, 4, 2),
(83, 57, 8, 1),
(84, 57, 9, 2),
(85, 57, 10, 3),
(86, 57, 11, 4),
(87, 58, 1, 7),
(88, 58, 2, 3),
(89, 58, 3, 4),
(90, 58, 4, 6),
(91, 58, 5, 5),
(92, 59, 1, 1),
(95, 59, 4, 2),
(96, 61, 1, 7),
(97, 61, 2, 3),
(98, 61, 3, 4),
(99, 61, 4, 6),
(100, 61, 5, 5),
(107, 54, 9, 2),
(108, 61, 7, 1),
(109, 61, 8, 2),
(110, 58, 7, 1),
(111, 58, 8, 2),
(112, 55, 7, 1),
(113, 55, 8, 2),
(114, 43, 7, 1),
(115, 43, 8, 2),
(118, 46, 7, 1),
(119, 46, 8, 2),
(120, 40, 7, 1),
(121, 40, 8, 2),
(122, 43, 9, 9),
(123, 43, 10, 10),
(124, 43, 11, 11),
(125, 43, 12, 12),
(126, 43, 13, 13),
(127, 43, 14, 14),
(128, 43, 15, 15),
(129, 43, 16, 16),
(130, 43, 17, 17),
(131, 43, 18, 18),
(132, 43, 19, 19),
(136, 40, 9, 8),
(137, 40, 10, 9),
(138, 40, 11, 10),
(139, 40, 12, 11),
(140, 40, 13, 12),
(141, 40, 14, 13),
(142, 40, 15, 14),
(143, 40, 16, 15),
(144, 40, 17, 16),
(145, 40, 18, 17),
(146, 40, 19, 18),
(147, 38, 7, 5),
(148, 38, 3, 4),
(149, 38, 4, 2),
(150, 41, 1, 0),
(151, 41, 8, 1),
(152, 41, 9, 7),
(153, 62, 1, 1),
(154, 62, 5, 3),
(155, 62, 8, 2),
(156, 62, 9, 7),
(157, 62, 7, 6),
(158, 62, 3, 5),
(159, 62, 4, 4),
(160, 63, 8, 2),
(161, 63, 9, 4),
(162, 63, 10, 5),
(163, 63, 11, 7),
(164, 63, 12, 1),
(165, 63, 14, 6),
(166, 64, 7, 1),
(167, 64, 8, 2),
(168, 64, 2, 3),
(169, 64, 3, 4),
(170, 64, 5, 5),
(171, 64, 4, 6),
(172, 64, 1, 7),
(173, 64, 9, 8),
(174, 64, 10, 9),
(175, 64, 11, 10),
(176, 64, 12, 11),
(177, 64, 13, 12),
(178, 64, 14, 13),
(179, 64, 15, 14),
(180, 64, 16, 15),
(181, 64, 17, 16),
(182, 64, 18, 17),
(183, 64, 19, 18),
(184, 63, 15, 3),
(185, 42, 8, 2),
(186, 42, 9, 4),
(188, 42, 12, 1),
(189, 42, 13, 5),
(190, 42, 15, 3),
(191, 43, 20, 6),
(192, 41, 10, 5),
(193, 65, 8, 1),
(194, 65, 9, 2),
(195, 65, 10, 3),
(196, 65, 11, 4);

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
(39, '2017_08_12_233958_create_special_products_table', 18),
(40, '2017_08_18_222233_rename_and_remove_qty_preset_one_table', 19),
(41, '2017_08_19_181849_add_show_in_menu_col_to_category', 20),
(42, '2017_08_22_213717_create_cart_table', 21),
(45, '2017_08_24_210353_change_cart_price_length', 22),
(46, '2017_08_26_194900_add_sticker_type_col_rename_laminate_col', 23),
(47, '2017_08_26_210839_create_lamination_options_table', 24),
(48, '2017_08_26_214504_create_sticker_type_table', 25),
(49, '2017_08_26_215304_add_sort_col-to_sticker_type_table', 26),
(50, '2017_08_29_185728_create_country_table', 27),
(51, '2017_08_30_005123_create_order_table', 28),
(52, '2017_08_30_005214_create_order_billing_table', 28),
(53, '2017_08_30_005245_create_order_items_table', 28),
(54, '2017_08_30_190320_create_order_status_table', 29),
(55, '2017_08_30_190457_add_status_col_to_order_table', 29),
(56, '2017_08_31_184512_create_settiongs_table', 30),
(57, '2017_09_21_201505_add_min_max_dim_cols_to_product', 31);

-- --------------------------------------------------------

--
-- Table structure for table `notificationsetting`
--

CREATE TABLE `notificationsetting` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_ids` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notificationsetting`
--

INSERT INTO `notificationsetting` (`id`, `type`, `mail_ids`) VALUES
(1, 'order', 'julian@blendev.com, angellous99@gmail.com'),
(2, 'contact', 'julian@blendev.com, angellous99@gmail.com'),
(3, 'review', 'julian@blendev.com, angellous99@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `discount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `price` decimal(15,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_token`, `transaction_id`, `user_id`, `discount`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PA2017083001', 'pccq8g1h', 1, '0.00', '7906.00', 1, '2017-08-30 13:10:22', '2017-08-30 13:10:22'),
(2, 'PA2017083002', 'r1zkz7mq', 2, '170.00', '5481.00', 1, '2017-08-30 15:27:36', '2017-08-30 15:27:36'),
(4, 'PA2017083101', 'jw1jz7vc', NULL, '261.00', '8442.00', 1, '2017-08-31 10:56:12', '2017-08-31 10:56:12'),
(7, 'PA2017083104', 'mfes3cbb', 1, '180.00', '5811.00', 4, '2017-08-31 16:51:50', '2017-09-04 11:45:11'),
(8, 'PA2017083105', '7s9bwzjd', 1, '1097.00', '17181.00', 5, '2017-08-31 17:00:53', '2017-09-02 22:33:09'),
(9, 'PA2017083106', '3rnzp51j', 1, '500.00', '7838.00', 1, '2017-08-31 17:04:19', '2017-08-31 17:04:19'),
(10, 'PA2017083107', 'hmfk8s25', NULL, '93.00', '3001.00', 6, '2017-08-31 17:48:45', '2017-09-01 18:03:27'),
(11, 'PA2017083108', 'rrrzh90v', 2, '140.00', '4529.00', 5, '2017-08-31 18:00:05', '2017-09-01 18:03:39'),
(19, 'PA2017090303', '3exy7af3', NULL, '0.00', '1016.00', 4, '2017-09-03 19:10:13', '2017-09-05 00:54:39'),
(21, 'PA2017090601', '1v5yv6jw', NULL, '0.00', '26.00', 5, '2017-09-06 01:39:04', '2017-09-06 01:45:59');

-- --------------------------------------------------------

--
-- Table structure for table `order_billing`
--

CREATE TABLE `order_billing` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_fips` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_billing`
--

INSERT INTO `order_billing` (`id`, `order_id`, `name`, `email`, `phone`, `ip_address`, `country_fips`, `state`, `city`, `zipcode`, `street`, `company`) VALUES
(1, 1, 'Sourav', 'srv.nxr@gmail.com', '813463113', '::1', 'AS', 'WB', 'Kolkata', '712222', 'Baidyabati', 'my company'),
(2, 2, 'Sourav Rakshit', 'srv.nxr@gmail.com', '7278863258', '::1', 'AS', 'Abc', 'iojhio', '7122222', 'anywhere in world', NULL),
(4, 4, 'Brock Lesnar', 'brock@wwe.com', '54896547', '::1', 'AS', 'WB', 'KOL', '712222', 'Mn', NULL),
(7, 7, 'Sourav', 'developer.srv1@gmail.com', '5587654841', '::1', 'AS', 'West Bengal', 'Kolkata', '712222', 'cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL),
(8, 8, 'Sourav', 'developer.srv1@gmail.com', '58965478796', '::1', 'AS', 'West Bengal', 'Kolkata', '712222', 'cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL),
(9, 9, 'Sourav', 'developer.srv1@gmail.com', '8785459632', '::1', 'AS', 'West Bengal', 'Kolkata', '712222', 'cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL),
(10, 10, 'Sourav Rakshit', 'reach@devsourav.com', '8013463113', '::1', 'AS', 'West Bengal', 'Kolkata', '712222', '59 (25/C/D) Kaibarta Para Lane, Baidyabati, dist.- Hooghly', NULL),
(11, 11, 'Sourav Rakshit', 'srv.nxr@gmail.com', '5698745896', '::1', 'AS', 'West Bengal', 'KOlkata', '712222', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 'C Company'),
(16, 19, 'Brock Lesnar', 'atanu_das1985@yahoo.co.in', '8965854785', '223.223.129.189', 'AS', 'West Bengal', 'Kolkata', '702203', 'quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse', NULL),
(18, 21, 'Julian Dabbs', 'julian@blendev.com', '7472091732', '46.252.74.82', 'AS', 'NSW', 'Rouse Hill', '2115', '10 Dalton Cl', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `paperstock` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `width` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `height` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `sticker_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laminating` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sticker_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `artwork` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `paperstock`, `width`, `height`, `qty`, `price`, `sticker_type`, `laminating`, `sticker_name`, `artwork`, `instructions`) VALUES
(1, 1, 2, 'Kraft Paperboard', '90', '90', '300', '7906.00', NULL, NULL, NULL, NULL, NULL),
(2, 2, 2, 'Kraft Paperboard', '50', '50', '500', '2793.00', NULL, NULL, NULL, NULL, NULL),
(3, 2, 22, 'Silver Matt paperboard', '90', '90', '300', '2858.00', 'Ben 10 Ulimate Alien', '6', 'Sourav', 'artworks/IlzYrzwDzivlphZ4W2oqDJMPqIYxETOfnN2b1tTK.jpeg', 'I want it to be in oily paper'),
(5, 4, 21, 'Waterproof paperboard', '120', '120', '500', '8467.00', NULL, NULL, NULL, NULL, NULL),
(6, 4, 4, 'Glossy & Matt paperboard (Artboard)', '15', '15', '500', '236.00', NULL, NULL, NULL, 'artworks/Q6f8VWei6BqfC5QobFbgbzSlc2zyqqQcKbVQUeEC.jpeg', NULL),
(10, 7, 2, 'Kraft Paperboard', '50', '50', '2000', '5880.00', NULL, NULL, NULL, NULL, NULL),
(11, 7, 4, 'Kraft Paperboard', '12', '12', '200', '111.00', NULL, NULL, NULL, NULL, NULL),
(12, 8, 2, 'Kraft Paperboard', '90', '90', '300', '7906.00', NULL, NULL, NULL, NULL, NULL),
(13, 8, 21, 'Transparent Paper', '120', '120', '500', '8467.00', NULL, NULL, NULL, NULL, NULL),
(14, 8, 17, 'Silver Matt paperboard', '90', '90', '200', '1905.00', NULL, NULL, NULL, NULL, NULL),
(15, 9, 21, 'Glossy & Matt paperboard (Artboard)', '50', '50', '300', '882.00', NULL, NULL, NULL, NULL, NULL),
(16, 9, 2, 'Kraft Paperboard', '70', '70', '200', '4034.00', NULL, NULL, NULL, NULL, NULL),
(17, 9, 17, 'Silver Matt paperboard', '48.5', '200', '300', '3422.00', NULL, NULL, NULL, NULL, NULL),
(18, 10, 4, 'Glossy & Matt paperboard (Artboard)', '15', '15', '500', '236.00', NULL, NULL, NULL, NULL, NULL),
(19, 10, 21, 'Waterproof paperboard', '90', '90', '300', '2858.00', NULL, NULL, NULL, NULL, NULL),
(20, 11, 17, 'Kraft Paperboard', '70', '70', '300', '1729.00', NULL, NULL, NULL, NULL, NULL),
(21, 11, 2, 'Waterproof paperboard', '50', '50', '1000', '2940.00', NULL, NULL, NULL, NULL, NULL),
(28, 19, 2, 'Kraft Paperboard', '120', '120', '6000', '1016.00', NULL, NULL, NULL, NULL, NULL),
(30, 21, 25, 'Glossy Sticker', '40', '40', '10', '26.00', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `status_text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `status_text`) VALUES
(1, 'Processing'),
(3, 'Processed'),
(4, 'Shipped'),
(5, 'Completed'),
(6, 'Cancelled');

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
(1, 'Glossy Sticker'),
(5, 'Kraft Sticker'),
(8, 'Matte Sticker'),
(9, 'PVC Sticker'),
(7, 'Silver Vinyl Sticker (Matte)'),
(10, 'Transparent Sticker (Full Colour + White)'),
(3, 'Transparent Sticker (Full Colour)'),
(4, 'Waterproof Sticker');

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
  `is_base` tinyint(4) NOT NULL DEFAULT 0,
  `base_price` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `preset_general`
--

INSERT INTO `preset_general` (`id`, `map_prod_form_option`, `from`, `to`, `val_per_mmsq`, `profit_percent`, `is_base`, `base_price`) VALUES
(5, 13, 0, 4000, NULL, NULL, 1, '99.00'),
(13, 27, 0, 470, 0.25, 0.50, 1, '63.00'),
(14, 27, 471, 900, 0.24, 0.49, 0, NULL),
(15, 27, 901, 1350, 0.24, 0.49, 0, NULL),
(16, 27, 1351, 62500, 0.24, 0.49, 0, NULL),
(17, 28, 0, 410, 0.25, 0.50, 1, '93.00'),
(18, 28, 411, 600, 0.24, 0.49, 0, NULL),
(19, 28, 601, 800, 0.24, 0.49, 0, NULL),
(20, 28, 801, 1200, 0.24, 0.49, 0, NULL),
(22, 28, 1201, 62500, 0.24, 0.49, 0, NULL),
(29, 31, 0, 320, 0.25, 0.50, 1, '99.00'),
(30, 31, 321, 500, 0.24, 0.49, 0, NULL),
(31, 31, 501, 800, 0.24, 0.49, 0, NULL),
(32, 31, 801, 62500, 0.24, 0.49, 0, NULL),
(33, 42, 0, 5400, 0.00, 0.00, 1, '84.00'),
(34, 42, 5401, 7000, 0.29, 0.55, 0, NULL),
(35, 42, 7001, 9000, 0.29, 0.54, 0, NULL),
(36, 42, 9001, 12000, 0.28, 0.55, 0, NULL),
(37, 42, 12001, 15000, 0.28, 0.54, 0, NULL),
(44, 44, 0, 5400, 0.00, 0.00, 1, '200.25'),
(45, 44, 5401, 8000, 0.33, 0.55, 0, NULL),
(46, 44, 8001, 10000, 0.33, 0.54, 0, NULL),
(47, 44, 10001, 12000, 0.32, 0.55, 0, NULL),
(48, 47, 0, 5400, 0.00, 0.00, 1, '99.00'),
(49, 47, 5401, 6000, 0.33, 0.55, 0, NULL),
(50, 47, 6001, 8000, 0.33, 0.54, 0, NULL),
(51, 47, 8001, 10000, 0.32, 0.55, 0, NULL),
(65, 69, 0, 470, 0.25, 0.50, 1, '69.00'),
(66, 69, 471, 900, 0.24, 0.49, 0, NULL),
(67, 69, 901, 1350, 0.24, 0.49, 0, NULL),
(68, 69, 1351, 62500, 0.24, 0.49, 0, NULL),
(69, 68, 0, 470, 0.25, 0.50, 1, '99.00'),
(70, 68, 471, 900, 0.24, 0.49, 0, NULL),
(71, 68, 901, 1350, 0.24, 0.49, 0, NULL),
(72, 68, 1351, 62500, 0.24, 0.49, 0, NULL),
(73, 79, 0, 250, 0.25, 0.50, 1, '75.00'),
(74, 79, 251, 900, 0.24, 0.49, 0, NULL),
(75, 79, 901, 1350, 0.24, 0.49, 0, NULL),
(76, 79, 1351, 62500, 0.24, 0.49, 0, NULL),
(77, 80, 0, 250, 0.25, 0.50, 1, '95.00'),
(78, 80, 251, 600, 0.24, 0.49, 0, NULL),
(79, 80, 601, 800, 0.24, 0.49, 0, NULL),
(80, 80, 801, 1200, 0.24, 0.49, 0, NULL),
(81, 80, 1201, 1500, 0.24, 0.49, 0, NULL),
(82, 80, 1501, 62500, 0.24, 0.49, 0, NULL),
(83, 81, 0, 250, 0.25, 0.50, 1, '200.00'),
(84, 81, 251, 900, 0.24, 0.49, 0, NULL),
(85, 81, 901, 1200, 0.24, 0.49, 0, NULL),
(86, 81, 1201, 62500, 0.24, 0.49, 0, NULL),
(87, 82, 0, 250, 0.25, 0.50, 1, '95.00'),
(88, 82, 251, 900, 0.24, 0.49, 0, NULL),
(89, 82, 901, 1200, 0.24, 0.49, 0, NULL),
(90, 82, 1201, 62500, 0.24, 0.49, 0, NULL),
(91, 92, 0, 470, NULL, NULL, 1, '99.00'),
(92, 92, 471, 900, 0.24, 0.49, 0, NULL),
(93, 92, 901, 1350, 0.24, 0.49, 0, NULL),
(94, 92, 1351, 62500, 0.25, 0.49, 0, NULL),
(104, 95, 0, 470, 0.25, 0.50, 1, '69.00'),
(105, 95, 471, 900, 0.24, 0.49, 0, NULL),
(106, 95, 901, 1350, 0.24, 0.49, 0, NULL),
(107, 95, 1351, 62500, 0.24, 0.49, 0, NULL),
(108, 42, 15001, 18000, 0.27, 0.55, 0, NULL),
(109, 42, 18001, 20000, 0.27, 0.54, 0, NULL),
(110, 42, 20001, 23000, 0.26, 0.55, 0, NULL),
(111, 42, 23001, 26000, 0.26, 0.54, 0, NULL),
(112, 42, 26001, 29000, 0.25, 0.55, 0, NULL),
(113, 42, 29001, 90000, 0.25, 0.54, 0, NULL),
(116, 47, 10001, 12000, 0.32, 0.54, 0, NULL),
(117, 47, 12001, 15000, 0.31, 0.55, 0, NULL),
(118, 47, 15001, 18000, 0.31, 0.54, 0, NULL),
(119, 47, 18001, 20000, 0.30, 0.55, 0, NULL),
(121, 47, 20001, 23000, 0.30, 0.54, 0, NULL),
(122, 47, 23001, 26000, 0.29, 0.55, 0, NULL),
(124, 47, 26001, 90000, 0.29, 0.54, 0, NULL),
(125, 13, 4001, 6000, 0.41, 0.55, 0, NULL),
(126, 13, 6001, 8000, 0.40, 0.55, 0, NULL),
(127, 13, 8001, 10000, 0.39, 0.55, 0, NULL),
(128, 13, 10001, 12000, 0.38, 0.54, 0, NULL),
(129, 13, 12001, 15000, 0.37, 0.53, 0, NULL),
(130, 13, 15001, 18000, 0.36, 0.52, 0, NULL),
(131, 13, 18001, 20000, 0.35, 0.51, 0, NULL),
(132, 13, 20001, 23000, 0.34, 0.50, 0, NULL),
(133, 13, 23001, 25000, 0.33, 0.49, 0, NULL),
(134, 13, 25000, 90000, 0.32, 0.48, 0, NULL),
(135, 150, 0, 5400, 0.00, 0.00, 1, '65.00'),
(136, 150, 5401, 6000, 0.25, 0.47, 0, NULL),
(137, 150, 6001, 8000, 0.24, 0.48, 0, NULL),
(138, 150, 8001, 10000, 0.24, 0.47, 0, NULL),
(139, 150, 10001, 12000, 0.23, 0.48, 0, NULL),
(140, 150, 12001, 15000, 0.23, 0.47, 0, NULL),
(141, 150, 15001, 18000, 0.22, 0.48, 0, NULL),
(142, 150, 18001, 20000, 0.22, 0.47, 0, NULL),
(143, 150, 20001, 23000, 0.21, 0.48, 0, NULL),
(144, 150, 23001, 26000, 0.21, 0.47, 0, NULL),
(145, 150, 26001, 90000, 0.20, 0.48, 0, NULL),
(146, 153, 0, 5400, 0.00, 0.00, 1, '65.00'),
(148, 153, 8100, 8101, 0.00, 0.00, 1, '81.00'),
(150, 153, 10000, 10001, 0.00, 0.00, 1, '99.99'),
(151, 44, 12001, 15000, 0.32, 0.54, 0, NULL),
(152, 44, 15001, 18000, 0.31, 0.55, 0, NULL),
(153, 44, 18001, 20000, 0.31, 0.54, 0, NULL),
(154, 44, 20001, 23000, 0.30, 0.55, 0, NULL),
(155, 44, 23001, 26000, 0.30, 0.54, 0, NULL),
(156, 44, 26001, 90000, 0.29, 0.55, 0, NULL),
(157, 151, 0, 5400, 0.00, 0.00, 1, '65.00'),
(158, 151, 5401, 6000, 0.25, 0.47, 0, NULL),
(159, 151, 6001, 8000, 0.24, 0.48, 0, NULL),
(160, 151, 8001, 10000, 0.24, 0.47, 0, NULL),
(161, 151, 10001, 12000, 0.23, 0.48, 0, NULL),
(167, 151, 15001, 18000, 0.22, 0.48, 0, NULL),
(169, 151, 18001, 20000, 0.22, 0.47, 0, NULL),
(171, 151, 20001, 23000, 0.21, 0.48, 0, NULL),
(172, 151, 23001, 26000, 0.21, 0.47, 0, NULL),
(173, 151, 26001, 90000, 0.20, 0.48, 0, NULL),
(177, 45, 0, 5400, 0.00, 0.00, 1, '87.00'),
(178, 45, 5401, 6000, 0.29, 0.55, 0, NULL),
(179, 45, 6001, 8000, 0.29, 0.54, 0, NULL),
(180, 45, 8001, 10000, 0.28, 0.55, 0, NULL),
(181, 45, 10001, 12000, 0.28, 0.54, 0, NULL),
(182, 45, 12001, 15000, 0.27, 0.55, 0, NULL),
(184, 45, 15001, 18000, 0.27, 0.54, 0, NULL),
(186, 45, 18001, 20000, 0.26, 0.55, 0, NULL),
(187, 45, 20001, 23000, 0.26, 0.54, 0, NULL),
(188, 45, 23001, 26000, 0.25, 0.55, 0, NULL),
(189, 45, 26001, 90000, 0.25, 0.54, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `preset_qty_rule_one`
--

CREATE TABLE `preset_qty_rule_one` (
  `id` int(10) UNSIGNED NOT NULL,
  `map_prod_form_option` int(11) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `disc_rate` double(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `preset_qty_rule_one`
--

INSERT INTO `preset_qty_rule_one` (`id`, `map_prod_form_option`, `order_qty`, `disc_rate`) VALUES
(4, 13, 100, 83.00),
(5, 13, 200, 86.00),
(6, 13, 300, 89.00),
(7, 13, 400, 92.00),
(8, 13, 500, 95.00),
(15, 92, 10, 6.00),
(16, 92, 50, 20.00),
(17, 92, 100, 57.00),
(32, 13, 10, 75.00),
(33, 13, 50, 80.00),
(35, 150, 10, 40.00),
(36, 150, 50, 45.00),
(37, 150, 100, 50.00),
(38, 150, 200, 60.00),
(39, 150, 300, 68.00),
(40, 150, 400, 73.00),
(41, 150, 500, 80.00),
(42, 153, 10, 40.00),
(43, 153, 50, 45.00),
(44, 153, 100, 50.00),
(45, 153, 200, 62.00),
(46, 153, 300, 69.00),
(47, 153, 400, 75.00),
(48, 153, 500, 80.00),
(49, 44, 10, 45.00),
(50, 44, 50, 50.00),
(51, 44, 100, 53.00),
(52, 44, 200, 58.00),
(53, 44, 300, 63.00),
(54, 44, 400, 68.00),
(55, 44, 500, 73.00),
(56, 42, 10, 45.00),
(57, 42, 50, 50.00),
(58, 42, 100, 53.00),
(59, 42, 200, 58.00),
(60, 42, 300, 63.00),
(63, 42, 400, 68.00),
(64, 42, 500, 73.00),
(65, 47, 10, 45.00),
(66, 47, 50, 50.00),
(67, 47, 100, 53.00),
(68, 47, 200, 58.00),
(69, 47, 300, 63.00),
(70, 47, 400, 68.00),
(71, 47, 500, 73.00),
(72, 45, 10, 45.00),
(73, 45, 50, 50.00),
(74, 45, 100, 53.00),
(75, 45, 200, 58.00),
(76, 45, 300, 63.00),
(77, 45, 400, 68.00),
(78, 45, 500, 73.00);

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
(11, 42, 1000, 1000, 4000, 9.00),
(12, 42, 1000, 5000, 20000, 1.00),
(13, 47, 1000, 1000, 4000, 9.00),
(14, 47, 1000, 5000, 20000, 1.00),
(16, 13, 1000, 1000, 4000, 8.00),
(17, 13, 1000, 5000, 20000, 1.00),
(19, 150, 1000, 1000, 4000, 9.00),
(20, 150, 1000, 5000, 20000, 1.00),
(21, 153, 1000, 1000, 3000, 18.00),
(22, 153, 1000, 4000, 8000, 13.00),
(23, 153, 1000, 9000, 14000, 10.00),
(24, 153, 1000, 14000, 20000, 4.00),
(25, 44, 1000, 1000, 4000, 8.00),
(26, 44, 1000, 5000, 20000, 1.00),
(28, 151, 1000, 1000, 4000, 9.00),
(30, 151, 1000, 5000, 20000, 1.00),
(31, 45, 1000, 1000, 4000, 9.00),
(32, 45, 1000, 5000, 20000, 2.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sample_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_size` int(11) NOT NULL DEFAULT 0,
  `max_size` int(11) NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `meta_desc`, `og_img`, `category_id`, `product_name`, `product_slug`, `logo`, `description`, `sample_image`, `min_size`, `max_size`, `sort`, `created_at`, `updated_at`) VALUES
(2, 'Square Stickers - Printing Amazon', 'some meta', 'Square Sticker_3.jpg', 1, 'Square & Rectangle Stickers', 'square-rectangle-stickers', 'Square.png', 'Our custom square stickers are great for logos, product labels, artwork reproductions and more. Our proof approval process lets you work directly with us to ensure the size, borders, and look are perfect for your business.', '1.jpg*2.jpg*3.jpg*4.jpg', 0, 0, 2, '2017-05-30 14:35:51', '2017-09-05 14:01:50'),
(4, 'Die-Cutting Stickers', NULL, NULL, 1, 'Die Cutting Stickers', 'die-cutting-stickers', 'Diecut.png', 'Printing Amazon’s Premium Business Cards will set you apart from the crowd with our carefully selected materials and high definition printing technology. Our proof approval process let you work directly with us to ensure the size, corners, and look are perfect. From every day to extra special. With a variety of stocks and specialty finishes, designing your unique custom business cards is easier than you think.', 'Die-cutting_9.jpg', 0, 0, 2, '2017-06-19 15:22:41', '2017-09-04 22:50:52'),
(17, 'Rectangle Stickers - Printing Amazon', NULL, NULL, 1, 'Oval Stickers', 'oval-stickers', 'Oval.png', 'Custom Oval Stickers are a great way to represent your state, team or organisation. Our proof approval process lets you work directly with us to ensure the size, borders, and look are perfect for your needs.', 'Rectangle Sticker_1.jpg', 0, 0, 3, '2017-08-15 14:00:51', '2017-09-06 11:57:28'),
(20, 'Rounded Corner', NULL, NULL, 1, 'Rounded Corner', 'rounded-corner', 'Round-Corner.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Die-cutting_7.jpg', 0, 0, 1, '2017-08-15 16:42:47', '2017-09-06 11:55:37'),
(21, 'Circle Stickers', NULL, NULL, 1, 'Circle Stickers', 'circle-stickers', 'Circle.png', 'Easy to hand out, Printing Amazon’s Circle Stickers are a great way to promote your brand or label your products. Our proof approval process lets you work directly with us to ensure the size, borders, and look are perfect.', 'Round Sticker_1.png', 0, 0, 4, '2017-08-15 16:57:52', '2017-09-06 11:55:10'),
(22, 'Name stickers - Printing Amazon', NULL, NULL, 1, 'Name stickers', 'name-stickers', 'namesticker_icon.png', 'If you are getting headaches with your kids because they lose their belongings at school, try our Name stickers. We provide various forms of pre-designed artworks and you only simply need to let us know the detail that you would like to apply onto the sticker and you would a name sticker you would be proud of.', NULL, 30, 300, 5, '2017-08-16 13:48:57', '2017-09-21 15:37:30'),
(23, 'Labels - Printing Amazon', NULL, NULL, 5, 'Labels', 'labels', 'cs-4.png', 'Printing Amazon provides custom Label printing services by using flexographic and digital printing techniques. Both of these printing methods produce high-quality labels, and each method offers different capabilities that allow us to create a larger variety of label styles. Simply leave your brief requirements and contact details, and our service consultant will contact you within 24 hours. We provide quality and durable labels. Ordering from us means your stickers will withstand exposure and they would always portray your brand whenever.', 'PVC-paper-custom-label-sticker-logo-printing-self-adhesive-shipping-labels-custom-sticker-label-stickers.jpg', 0, 0, 1, '2017-08-19 13:08:47', '2017-09-06 11:53:58'),
(24, 'Graphic Designs - Printing Amazon', NULL, NULL, 5, 'Graphic Designs', 'graphic-designs', 'cs-4.png', 'Printing Amazon provides custom Graphic Design services for all business. Our professional graphic design team with more than 20 years of experience. We are well known because we provide quality graphic design for every demand by our clients and we get satisfactory feedbacks every time from our clients. Simply send us your requirements and contact details, and our service consultant will contact you within 24 hours to help you make your idea a reality.', 'gshock-watch-sports-watch-stopwatch-158741.jpeg*hacker-internet-technology-computers-159195.jpeg', 0, 0, 2, '2017-08-19 13:24:07', '2017-09-06 11:52:32'),
(25, NULL, NULL, NULL, 6, 'Square & Rectangle (Preset Size)', 'square-rectangle-preset-size', 'Square.png', 'Our custom square stickers are great for logos, product labels, artwork reproductions and more. Our proof approval process lets you work directly with us to ensure the size, borders, and look are perfect for your business.', 'Square Sticker_2.jpg', 30, 50, 1, '2017-09-05 14:03:30', '2017-09-05 14:06:34');

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
(5, 300),
(7, 10),
(8, 50),
(9, 2000),
(10, 3000),
(11, 4000),
(12, 5000),
(13, 6000),
(14, 7000),
(15, 8000),
(16, 9000),
(17, 10000),
(18, 15000),
(19, 20000),
(20, 400);

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
  `publish` int(11) NOT NULL DEFAULT 0,
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
(75, 22, 2, 'Sed ut perspiciatis unde omnis iste natus error sit voluptat', 'quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione', '4.0', 1, '2017-08-17 20:07:07', '2017-08-17 20:07:42'),
(76, 20, 2, 'nostrud exercitation ullamco laboris nisi aliquip', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non loqaugfa aytggu aghaewyese y4qaqalug', '5.0', 1, '2017-08-19 10:50:20', '2017-08-19 10:53:59'),
(77, 23, 1, 'sunt in culpa qui officia deserunt mollit anim id est', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip', '5.0', 1, '2017-08-19 13:47:49', '2017-08-19 13:49:23'),
(78, 24, 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam edit', '5.0', 1, '2017-08-19 13:49:54', '2017-09-04 09:28:24');

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
(8, '50 x 50 mm', 50, 50),
(9, '70 x 70 mm', 70, 70),
(10, '90 x 90 mm', 90, 90),
(11, '120 x 120 mm', 120, 120),
(12, '40 x 40 mm', 40, 40),
(13, '90 x 60 mm', 90, 60),
(14, '100 x 100 mm', 100, 100),
(15, '60 x 60mm', 60, 60);

-- --------------------------------------------------------

--
-- Table structure for table `sticker_types`
--

CREATE TABLE `sticker_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sticker_types`
--

INSERT INTO `sticker_types` (`id`, `name`, `image`, `sort`) VALUES
(2, 'Ben 10 Ulimate Alien', '8-bit-zombie-custom-rectangle-vinyl-stickers-kiss-cut-1.jpg', 2),
(3, 'Animal Town 007', '9e17.jpg', 1);

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
(1, 'Sourav', 'developer.srv1@gmail.com', 'avatar21500453464.png', '$2y$10$1ehSKhL5I7eGaFs0f8VKMObmsFC10rBHXXdNpZG.cC9TUhtNsrd46', 'c3PMMPMwdpB2GsistxSbMV9WeZSgTPBrGbWeJWVIhcfswHceMqAeKUcAYi27', '2017-05-03 05:53:37', '2017-07-19 13:07:44'),
(2, 'Sourav Rakshit', 'srv.nxr@gmail.com', 'depositphotos_56695985-stock-illustration-male-avatar.jpg', '$2y$10$vTSYi53gm8fBEqEvZbD0l..Gm3Nioiv8A693txll7/3eR7qVy4hWq', 'vRai1sABq9lLVyXScKUTWB2plJvocxFjz4DQ0v9mWwWisOQR17zNrgbqpc7P', '2017-05-18 16:08:04', '2017-07-22 18:16:07'),
(3, 'angellous99', 'angellous99@gmail.com', NULL, '$2y$10$0M3u8GJw6P5jedMqgf6hYe2gLJVExZCSAWdnhTd1ZDkX2D8VamP9i', 'nlxlHBj2MMuWQBBPV4hYX7dy453lvbadF3TWkGht4yeaeedLeOtCAwLT2TXD', '2017-08-22 11:25:02', '2017-08-22 11:25:13'),
(4, 'Atanu Das', 'technomind1985@gmail.com', NULL, '$2y$10$/6z6LNSCPYg.f6MfDlY6fORMAJy60FcRgNlor33qsZU7IAe2m93Wi', 'E8YULdUvh3X5dzZ8btsFMmSdCYqQF5vpETvFQhv40wuUXjNhZEDvwKLhnVI3', '2017-09-05 00:06:04', '2017-09-05 00:06:17');

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
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_category_name_unique` (`category_name`),
  ADD UNIQUE KEY `category_category_slug_unique` (`category_slug`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `lamination_options`
--
ALTER TABLE `lamination_options`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `notificationsetting`
--
ALTER TABLE `notificationsetting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_token_unique` (`order_token`);

--
-- Indexes for table `order_billing`
--
ALTER TABLE `order_billing`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_billing_order_id_unique` (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
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
-- Indexes for table `size_options`
--
ALTER TABLE `size_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sticker_types`
--
ALTER TABLE `sticker_types`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;
--
-- AUTO_INCREMENT for table `email_authentication`
--
ALTER TABLE `email_authentication`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `form_field_types`
--
ALTER TABLE `form_field_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `lamination_options`
--
ALTER TABLE `lamination_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `map_prod_form`
--
ALTER TABLE `map_prod_form`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `map_prod_form_options`
--
ALTER TABLE `map_prod_form_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `notificationsetting`
--
ALTER TABLE `notificationsetting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `order_billing`
--
ALTER TABLE `order_billing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `paperstock_options`
--
ALTER TABLE `paperstock_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `preset_general`
--
ALTER TABLE `preset_general`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;
--
-- AUTO_INCREMENT for table `preset_qty_rule_one`
--
ALTER TABLE `preset_qty_rule_one`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `preset_qty_rule_two`
--
ALTER TABLE `preset_qty_rule_two`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `qty_options`
--
ALTER TABLE `qty_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `size_options`
--
ALTER TABLE `size_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `sticker_types`
--
ALTER TABLE `sticker_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
