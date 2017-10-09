-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2017 at 09:06 AM
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
(70, '96181f0cb4e52467977ff1d9e28dc263d4565439', 1, 25, 1, 50.00, 50.00, 3000, '131.00', NULL, NULL, NULL, NULL, NULL, 153, '2017-09-13 09:57:45', '2017-09-13 09:57:45'),
(74, 'e8d1a803492fbd5d3d70e58721985517ee1308d5', 0, 2, 1, 40.00, 40.00, 10, '26.00', NULL, NULL, NULL, NULL, NULL, 150, '2017-09-25 21:04:21', '2017-09-25 21:04:21'),
(75, 'e8d1a803492fbd5d3d70e58721985517ee1308d5', 0, 2, 1, 40.00, 40.00, 10, '26.00', NULL, NULL, NULL, NULL, NULL, 150, '2017-09-25 21:05:38', '2017-09-25 21:05:38'),
(76, '59cb6ddbe06de24f9aeff57c186eab1e2492b883', 0, 21, 1, 50.00, 50.00, 100, '3.00', NULL, NULL, NULL, NULL, NULL, 79, '2017-09-25 22:32:55', '2017-09-25 22:32:55'),
(78, '5eed5ea94818f28cbd13b9d28afe3915ef3d2f66', 0, 2, 1, 40.00, 60.00, 10, '31.00', NULL, NULL, NULL, NULL, NULL, 150, '2017-09-27 14:32:19', '2017-09-27 14:32:19'),
(80, '885abda3cfe6902cd2eead26eb9ba4f8c0371ccc', 0, 4, 1, 50.00, 50.00, 10, '76.00', NULL, NULL, NULL, 'artworks/pabY2ezQQfpi4yQQzG2Pfj17rdxOEwlsT2HbNqDj.jpeg', NULL, 13, '2017-10-02 11:59:42', '2017-10-02 11:59:42'),
(81, '885abda3cfe6902cd2eead26eb9ba4f8c0371ccc', 0, 2, 1, 40.00, 60.00, 10, '31.00', NULL, NULL, NULL, NULL, NULL, 150, '2017-10-02 13:05:40', '2017-10-02 13:05:40'),
(82, '2ae2db8d1983f293e8050415068c8a37c18774c6', 3, 4, 1, 50.00, 50.00, 10, '76.00', NULL, NULL, NULL, 'artworks/J0OsYTZWiuKj29tuvHAlaklo4gDBsdVdboODrEcb.jpeg', NULL, 13, '2017-10-05 11:00:04', '2017-10-05 11:00:04'),
(83, 'a0fc14ceaf7e864b7555c5d7814c05f125aa2162', 0, 21, 4, 45.00, 45.00, 1000, '92.00', NULL, NULL, NULL, NULL, NULL, 82, '2017-10-08 07:24:44', '2017-10-08 07:24:44'),
(84, '9e2ce1dfa5e614fa71ed122b66aaebddfe28a802', 0, 2, 1, 40.00, 60.00, 10, '31.00', NULL, NULL, NULL, 'artworks/29JDDkiLbQCneIWlZGuRCnwkCjtiaJ5JWxvmbofG.gif', '1', 150, '2017-10-09 01:35:40', '2017-10-09 01:35:40');

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
(1, 'Sticker - Printing Amazon', 'Sticker - Printing Amazon', 'sticker page meta desc', 'sticker page meta desc', 'banner-bg.jpg', 'Badges', 'badges', 1, 1, '2017-05-26 15:10:37', '2017-09-25 09:00:29'),
(2, 'Magnets', 'Magnets', NULL, NULL, NULL, 'Magnets', 'magnets', 2, 1, '2017-06-19 13:00:47', '2017-09-25 09:06:30'),
(3, 'Brochures/Flyers - Printing Amazon', 'Brochures/Flyers - Printing Amazon', NULL, NULL, NULL, 'Brochures/Flyers', 'brochuresflyers', 3, 0, '2017-06-19 13:14:34', '2017-09-05 13:59:50'),
(4, 'Postcards - Printing Amazon', 'Postcards - Printing Amazon', NULL, NULL, NULL, 'Postcards', 'postcards', 4, 0, '2017-06-19 13:14:52', '2017-09-05 13:59:54'),
(5, NULL, NULL, NULL, NULL, NULL, 'Uncategorized', 'uncategorized', 0, 0, '2017-08-19 13:05:36', '2017-08-19 13:05:36'),
(6, 'Preset Sized Stickers', 'Preset Sized Stickers', NULL, NULL, NULL, 'Stickers', 'stickers', 0, 1, '2017-09-05 14:00:15', '2017-09-25 08:34:27');

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
(8, 'Matte', 2);

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
(66, 2, 27),
(67, 3, 27),
(68, 1, 27),
(69, 1, 28),
(70, 2, 28),
(71, 3, 28),
(72, 1, 29),
(73, 2, 29),
(74, 3, 29),
(78, 2, 22),
(79, 1, 31),
(80, 2, 31),
(81, 3, 31),
(85, 1, 33),
(86, 2, 33),
(87, 3, 33);

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
(22, 40, 1, 8),
(23, 40, 2, 3),
(24, 40, 3, 4),
(25, 40, 4, 7),
(26, 40, 5, 5),
(27, 44, 1, 1),
(28, 44, 5, 3),
(31, 44, 7, 7),
(36, 46, 1, 8),
(37, 46, 2, 3),
(38, 46, 3, 4),
(39, 46, 4, 7),
(40, 46, 5, 5),
(42, 41, 5, 2),
(44, 41, 7, 6),
(45, 41, 4, 3),
(47, 41, 3, 4),
(68, 53, 7, 7),
(69, 53, 3, 5),
(70, 54, 8, 1),
(72, 54, 10, 4),
(74, 55, 1, 8),
(75, 55, 2, 3),
(76, 55, 3, 4),
(77, 55, 4, 7),
(78, 55, 5, 5),
(79, 56, 1, 1),
(80, 56, 5, 4),
(81, 56, 3, 6),
(82, 56, 4, 5),
(88, 58, 2, 3),
(89, 58, 3, 4),
(91, 58, 5, 5),
(92, 59, 1, 1),
(95, 59, 4, 2),
(107, 54, 9, 3),
(110, 58, 7, 1),
(111, 58, 8, 2),
(112, 55, 7, 1),
(113, 55, 8, 2),
(118, 46, 7, 1),
(119, 46, 8, 2),
(120, 40, 7, 1),
(121, 40, 8, 2),
(136, 40, 9, 9),
(137, 40, 10, 10),
(138, 40, 11, 11),
(139, 40, 12, 12),
(140, 40, 13, 13),
(141, 40, 14, 14),
(142, 40, 15, 15),
(143, 40, 16, 16),
(144, 40, 17, 17),
(145, 40, 18, 18),
(146, 40, 19, 19),
(147, 38, 7, 7),
(148, 38, 3, 5),
(149, 38, 4, 4),
(150, 41, 1, 0),
(151, 41, 8, 1),
(152, 41, 9, 7),
(192, 41, 10, 5),
(197, 61, 21, 0),
(209, 43, 7, 1),
(210, 43, 8, 2),
(211, 43, 2, 3),
(212, 43, 3, 4),
(213, 43, 5, 5),
(214, 43, 20, 6),
(215, 43, 4, 7),
(216, 43, 1, 8),
(217, 43, 9, 9),
(218, 43, 10, 10),
(219, 43, 11, 11),
(220, 43, 12, 12),
(221, 43, 13, 13),
(222, 43, 14, 14),
(223, 43, 15, 15),
(224, 43, 16, 16),
(225, 43, 17, 17),
(226, 43, 18, 18),
(227, 43, 19, 19),
(228, 42, 8, 2),
(229, 42, 13, 4),
(230, 42, 15, 3),
(231, 42, 16, 1),
(232, 38, 8, 2),
(233, 38, 9, 8),
(234, 38, 10, 6),
(235, 40, 20, 6),
(236, 46, 20, 6),
(237, 46, 9, 9),
(238, 46, 10, 10),
(239, 46, 11, 11),
(240, 46, 12, 12),
(241, 46, 13, 13),
(242, 46, 14, 14),
(243, 46, 15, 15),
(244, 46, 16, 16),
(245, 46, 17, 17),
(246, 46, 18, 18),
(247, 46, 19, 19),
(248, 44, 8, 2),
(249, 44, 9, 8),
(250, 44, 10, 6),
(251, 44, 3, 5),
(252, 44, 4, 4),
(253, 45, 16, 1),
(254, 45, 18, 2),
(255, 45, 19, 3),
(257, 45, 21, 4),
(258, 45, 22, 5),
(259, 45, 23, 0),
(260, 53, 1, 1),
(261, 53, 5, 3),
(262, 53, 8, 2),
(263, 53, 9, 8),
(264, 53, 10, 6),
(265, 53, 4, 4),
(266, 54, 14, 5),
(267, 54, 15, 2),
(268, 55, 20, 6),
(269, 55, 9, 9),
(270, 55, 10, 10),
(271, 55, 11, 11),
(272, 55, 12, 12),
(273, 55, 13, 13),
(274, 55, 14, 14),
(275, 55, 15, 15),
(276, 55, 16, 16),
(277, 55, 17, 17),
(278, 55, 18, 18),
(279, 55, 19, 19),
(280, 39, 8, 1),
(281, 39, 9, 3),
(282, 39, 10, 4),
(283, 39, 15, 2),
(284, 66, 24, 1),
(285, 66, 25, 2),
(286, 66, 26, 3),
(287, 66, 27, 4),
(288, 67, 7, 0),
(289, 67, 8, 0),
(290, 67, 2, 0),
(291, 67, 3, 0),
(292, 67, 5, 0),
(293, 67, 20, 0),
(294, 67, 4, 0),
(295, 67, 1, 0),
(296, 68, 1, 0),
(297, 69, 1, 0),
(298, 70, 28, 0),
(299, 70, 29, 0),
(300, 71, 7, 0),
(301, 71, 8, 0),
(302, 71, 2, 0),
(303, 71, 3, 0),
(304, 71, 5, 0),
(305, 71, 20, 0),
(306, 71, 4, 0),
(307, 71, 1, 0),
(308, 72, 1, 0),
(309, 73, 30, 0),
(310, 74, 7, 0),
(311, 74, 8, 0),
(312, 74, 2, 0),
(313, 74, 3, 0),
(314, 74, 5, 0),
(315, 74, 20, 0),
(316, 74, 4, 0),
(317, 74, 1, 0),
(318, 61, 22, 0),
(319, 61, 23, 0),
(320, 61, 24, 0),
(321, 61, 25, 0),
(322, 61, 26, 0),
(323, 61, 27, 0),
(324, 61, 28, 0),
(325, 61, 29, 0),
(326, 61, 7, 0),
(327, 79, 1, 0),
(328, 81, 2, 1),
(329, 81, 3, 2),
(330, 81, 5, 3),
(331, 81, 20, 4),
(332, 81, 4, 5),
(333, 81, 1, 6),
(334, 81, 9, 7),
(335, 81, 10, 8),
(336, 81, 11, 9),
(337, 81, 12, 10),
(338, 81, 13, 11),
(339, 81, 14, 12),
(340, 81, 15, 13),
(341, 81, 16, 14),
(342, 81, 17, 15),
(343, 80, 32, 1),
(344, 80, 33, 2),
(345, 80, 34, 3),
(346, 80, 35, 4),
(347, 80, 36, 5),
(348, 80, 37, 6),
(349, 80, 38, 7),
(350, 85, 1, 0),
(351, 86, 29, 2),
(352, 86, 39, 1),
(353, 86, 40, 3),
(354, 86, 41, 4),
(355, 86, 42, 6),
(356, 86, 43, 7),
(357, 86, 44, 5),
(358, 87, 2, 1),
(359, 87, 3, 2),
(360, 87, 5, 3),
(361, 87, 20, 4),
(362, 87, 4, 5),
(363, 87, 1, 6),
(364, 87, 9, 7),
(365, 87, 10, 8),
(366, 87, 11, 9),
(367, 87, 13, 10),
(368, 87, 14, 11),
(369, 87, 15, 12),
(370, 87, 16, 13),
(371, 87, 17, 14),
(372, 56, 8, 3),
(373, 56, 9, 9),
(374, 56, 7, 8),
(375, 56, 10, 7),
(376, 57, 29, 2),
(377, 57, 39, 1),
(378, 57, 40, 3),
(379, 57, 41, 4),
(380, 57, 42, 6),
(381, 57, 43, 7),
(382, 57, 44, 5),
(383, 58, 20, 6),
(384, 58, 4, 7),
(385, 58, 1, 8),
(386, 58, 9, 9),
(387, 58, 10, 10),
(388, 58, 11, 11),
(389, 58, 12, 12),
(390, 58, 13, 13),
(391, 58, 14, 14),
(392, 58, 15, 15),
(393, 58, 16, 16),
(394, 58, 17, 17),
(395, 58, 18, 18),
(396, 58, 19, 19);

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
(57, '2017_09_21_201505_add_min_max_dim_cols_to_product', 31),
(58, '2017_09_21_213110_create_cms_pages_table', 32);

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
(21, 'PA2017090601', '1v5yv6jw', NULL, '0.00', '26.00', 5, '2017-09-06 01:39:04', '2017-09-06 01:45:59'),
(22, 'PA2017092301', '9kwczzce', 2, '2.00', '69.00', 1, '2017-09-23 21:32:36', '2017-09-23 21:32:36');

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
(18, 21, 'Julian Dabbs', 'julian@blendev.com', '7472091732', '46.252.74.82', 'AS', 'NSW', 'Rouse Hill', '2115', '10 Dalton Cl', NULL),
(19, 22, 'Sourav Rakshit', 'srv.nxr@gmail.com', '7278818541', '223.223.136.212', 'AS', 'West Bengal', 'Kolkata', '712203', 'proident, sunt in culpa qui officia deserunt', NULL);

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
(30, 21, 25, 'Glossy Sticker', '40', '40', '10', '26.00', NULL, NULL, NULL, NULL, NULL),
(31, 22, 25, 'Glossy Sticker', '40', '40', '100', '33.00', NULL, NULL, NULL, NULL, NULL),
(32, 22, 20, 'Transparent Sticker (Full Colour)', '90', '90', '400', '38.00', NULL, NULL, NULL, 'artworks/erdZEIXN5EF0Po0R4FtLJ6qkeFKgyySuYzkIwgpi.svg', NULL);

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
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contents` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `meta_desc`, `og_img`, `page_name`, `page_slug`, `contents`, `created_at`, `updated_at`) VALUES
(3, 'abc', NULL, NULL, 'Sample page', 'sample-page', '<p>some text</p>\r\n\r\n<p><img alt=\"\" src=\"[BASE_URL]/products/1242-gloss_stickers.jpg\" style=\"height:750px; width:1000px\" /></p>', '2017-09-22 16:36:52', '2017-09-22 16:41:58'),
(5, 'About Us - Printing Amazon', NULL, NULL, 'About Us', 'about-us', '<p><img alt=\"\" class=\"img-responsive\" src=\"[BASE_URL]/pages/About-Us.jpg\" style=\"height:1412px; width:1200px\" /></p>', '2017-09-23 12:44:21', '2017-10-05 21:06:21');

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
(33, 42, 2400, 5400, 0.00, 0.00, 1, '87.00'),
(34, 42, 5401, 7000, 0.29, 0.55, 0, NULL),
(35, 42, 7001, 9000, 0.29, 0.54, 0, NULL),
(36, 42, 9001, 12000, 0.28, 0.55, 0, NULL),
(37, 42, 12001, 15000, 0.28, 0.54, 0, NULL),
(44, 44, 2400, 5400, 0.00, 0.00, 1, '109.00'),
(45, 44, 5401, 8000, 0.37, 0.54, 0, NULL),
(46, 44, 8001, 10000, 0.36, 0.55, 0, NULL),
(47, 44, 10001, 12000, 0.36, 0.54, 0, NULL),
(48, 47, 2400, 5400, 0.00, 0.00, 1, '99.00'),
(49, 47, 5401, 6000, 0.33, 0.55, 0, NULL),
(50, 47, 6001, 8000, 0.33, 0.54, 0, NULL),
(51, 47, 8001, 10000, 0.32, 0.55, 0, NULL),
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
(135, 150, 2400, 3500, 0.00, 0.00, 1, '65.00'),
(136, 150, 5401, 6000, 0.27, 0.47, 0, NULL),
(137, 150, 6001, 8000, 0.27, 0.46, 0, NULL),
(138, 150, 8001, 10000, 0.26, 0.46, 0, NULL),
(139, 150, 10001, 12000, 0.26, 0.45, 0, NULL),
(140, 150, 12001, 15000, 0.25, 0.45, 0, NULL),
(141, 150, 15001, 18000, 0.25, 0.45, 0, NULL),
(142, 150, 18001, 20000, 0.24, 0.44, 0, NULL),
(143, 150, 20001, 23000, 0.24, 0.43, 0, NULL),
(144, 150, 23001, 26000, 0.23, 0.43, 0, NULL),
(145, 150, 26001, 90000, 0.23, 0.42, 0, NULL),
(151, 44, 12001, 15000, 0.35, 0.55, 0, NULL),
(152, 44, 15001, 18000, 0.35, 0.54, 0, NULL),
(153, 44, 18001, 20000, 0.34, 0.55, 0, NULL),
(154, 44, 20001, 23000, 0.34, 0.54, 0, NULL),
(155, 44, 23001, 26000, 0.33, 0.55, 0, NULL),
(156, 44, 26001, 90000, 0.33, 0.54, 0, NULL),
(157, 151, 2400, 3500, 0.00, 0.00, 1, '65.00'),
(158, 151, 5401, 6000, 0.27, 0.47, 0, NULL),
(159, 151, 6001, 8000, 0.27, 0.46, 0, NULL),
(160, 151, 8001, 10000, 0.26, 0.46, 0, NULL),
(161, 151, 10001, 12000, 0.26, 0.45, 0, NULL),
(167, 151, 15001, 18000, 0.25, 0.44, 0, NULL),
(169, 151, 18001, 20000, 0.24, 0.44, 0, NULL),
(171, 151, 20001, 23000, 0.24, 0.43, 0, NULL),
(172, 151, 23001, 26000, 0.23, 0.43, 0, NULL),
(173, 151, 26001, 90000, 0.23, 0.42, 0, NULL),
(177, 45, 2400, 5400, 0.00, 0.00, 1, '95.00'),
(178, 45, 5401, 6000, 0.32, 0.55, 0, NULL),
(179, 45, 6001, 8000, 0.32, 0.54, 0, NULL),
(180, 45, 8001, 10000, 0.31, 0.55, 0, NULL),
(181, 45, 10001, 12000, 0.31, 0.54, 0, NULL),
(182, 45, 12001, 15000, 0.30, 0.55, 0, NULL),
(184, 45, 15001, 18000, 0.30, 0.54, 0, NULL),
(186, 45, 18001, 20000, 0.29, 0.55, 0, NULL),
(187, 45, 20001, 23000, 0.29, 0.54, 0, NULL),
(188, 45, 23001, 26000, 0.28, 0.55, 0, NULL),
(189, 45, 26001, 90000, 0.28, 0.54, 0, NULL),
(190, 92, 0, 90000, 0.00, 0.00, 1, '10000.00'),
(191, 150, 3501, 5400, 0.00, 0.00, 1, '70.00'),
(192, 151, 3501, 5400, 0.00, 0.00, 1, '70.00'),
(193, 151, 12001, 15000, 0.25, 0.45, 0, NULL),
(194, 192, 2400, 5400, 0.00, 0.00, 1, '139.00'),
(195, 192, 5401, 6000, 0.46, 0.55, 0, NULL),
(196, 192, 6001, 8000, 0.46, 0.54, 0, NULL),
(197, 192, 8001, 10000, 0.45, 0.55, 0, NULL),
(198, 192, 10001, 12000, 0.45, 0.54, 0, NULL),
(199, 192, 12001, 15000, 0.44, 0.55, 0, NULL),
(200, 192, 15001, 18000, 0.44, 0.54, 0, NULL),
(201, 192, 18001, 20000, 0.43, 0.55, 0, NULL),
(202, 192, 20001, 23000, 0.43, 0.54, 0, NULL),
(203, 192, 23001, 26000, 0.42, 0.55, 0, NULL),
(204, 192, 26001, 90000, 0.42, 0.54, 0, NULL),
(205, 152, 2400, 5400, 0.00, 0.00, 1, '121.00'),
(206, 152, 5401, 8000, 0.41, 0.54, 0, NULL),
(207, 152, 8001, 10000, 0.40, 0.55, 0, NULL),
(208, 152, 10001, 12000, 0.40, 0.54, 0, NULL),
(209, 152, 12001, 15000, 0.39, 0.55, 0, NULL),
(210, 152, 15001, 18000, 0.39, 0.54, 0, NULL),
(211, 152, 18001, 20000, 0.38, 0.55, 0, NULL),
(212, 152, 20001, 23000, 0.38, 0.54, 0, NULL),
(213, 152, 23001, 25000, 0.37, 0.55, 0, NULL),
(214, 152, 25001, 90000, 0.37, 0.54, 0, NULL),
(215, 13, 0, 2000, 0.00, 0.00, 1, '99.00'),
(216, 13, 2001, 4000, 0.00, 0.00, 1, '109.00'),
(217, 13, 4001, 6000, 0.49, 0.55, 0, NULL),
(218, 13, 6001, 8000, 0.48, 0.55, 0, NULL),
(219, 13, 8001, 10000, 0.47, 0.55, 0, NULL),
(220, 13, 10001, 12000, 0.46, 0.54, 0, NULL),
(221, 13, 12001, 15000, 0.45, 0.53, 0, NULL),
(222, 13, 15001, 18000, 0.44, 0.52, 0, NULL),
(223, 13, 18001, 20000, 0.43, 0.51, 0, NULL),
(224, 13, 20001, 23000, 0.42, 0.50, 0, NULL),
(225, 13, 23001, 25000, 0.41, 0.49, 0, NULL),
(226, 13, 25001, 90000, 0.40, 0.48, 0, NULL),
(227, 149, 0, 2000, 0.00, 0.00, 1, '145.00'),
(228, 149, 2001, 4000, 0.00, 0.00, 1, '155.00'),
(229, 149, 4001, 6000, 0.69, 0.55, 0, NULL),
(230, 149, 6001, 8000, 0.68, 0.55, 0, NULL),
(231, 149, 8001, 10000, 0.67, 0.55, 0, NULL),
(232, 149, 10001, 12000, 0.66, 0.54, 0, NULL),
(233, 149, 12001, 15000, 0.65, 0.53, 0, NULL),
(234, 149, 15001, 18000, 0.62, 0.52, 0, NULL),
(235, 149, 18001, 20000, 0.61, 0.51, 0, NULL),
(236, 149, 20001, 23000, 0.60, 0.50, 0, NULL),
(237, 149, 23001, 25000, 0.59, 0.49, 0, NULL),
(238, 149, 25001, 90000, 0.58, 0.48, 0, NULL),
(239, 148, 0, 1500, 0.00, 0.00, 1, '110.00'),
(240, 148, 1501, 2500, 0.00, 0.00, 1, '130.00'),
(241, 148, 2501, 4000, 0.90, 0.56, 0, NULL),
(242, 148, 4001, 6000, 0.90, 0.55, 0, NULL),
(243, 148, 6001, 8000, 0.89, 0.55, 0, NULL),
(244, 148, 8001, 10000, 0.88, 0.54, 0, NULL),
(245, 148, 10001, 12000, 0.87, 0.53, 0, NULL),
(246, 148, 12001, 15000, 0.86, 0.52, 0, NULL),
(247, 148, 15001, 18000, 0.85, 0.51, 0, NULL),
(248, 148, 18001, 20000, 0.84, 0.50, 0, NULL),
(249, 148, 20001, 23000, 0.83, 0.49, 0, NULL),
(250, 148, 23001, 25000, 0.82, 0.48, 0, NULL),
(251, 148, 25001, 90000, 0.81, 0.47, 0, NULL),
(252, 234, 0, 1500, 0.00, 0.00, 1, '140.00'),
(253, 234, 1501, 2500, 0.00, 0.00, 1, '160.00'),
(254, 234, 2501, 4000, 1.10, 0.56, 0, NULL),
(255, 234, 4001, 6000, 1.09, 0.55, 0, NULL),
(256, 234, 6001, 8000, 1.08, 0.54, 0, NULL),
(257, 234, 8001, 10000, 1.07, 0.53, 0, NULL),
(258, 234, 10001, 12000, 1.06, 0.52, 0, NULL),
(259, 234, 12001, 15000, 1.05, 0.51, 0, NULL),
(260, 234, 15001, 18000, 1.03, 0.49, 0, NULL),
(261, 234, 20001, 23000, 1.02, 0.48, 0, NULL),
(262, 234, 23001, 25000, 1.01, 0.47, 0, NULL),
(263, 234, 25001, 90000, 1.00, 0.46, 0, NULL),
(264, 14, 0, 3000, 0.00, 0.00, 1, '115.00'),
(265, 14, 3001, 4000, 0.67, 0.56, 0, NULL),
(266, 14, 4001, 6000, 0.66, 0.55, 0, NULL),
(267, 14, 6001, 8000, 0.65, 0.54, 0, NULL),
(268, 14, 8001, 10000, 0.64, 0.53, 0, NULL),
(269, 14, 10001, 12000, 0.63, 0.52, 0, NULL),
(270, 14, 12001, 15000, 0.62, 0.51, 0, NULL),
(271, 14, 15001, 18000, 0.61, 0.50, 0, NULL),
(272, 14, 18001, 20000, 0.60, 0.49, 0, NULL),
(273, 14, 20001, 23000, 0.59, 0.48, 0, NULL),
(274, 14, 23001, 25000, 0.58, 0.47, 0, NULL),
(275, 14, 25001, 90000, 0.57, 0.46, 0, NULL),
(276, 147, 0, 2500, 0.00, 0.00, 1, '120.00'),
(277, 147, 2501, 4000, 0.83, 0.56, 0, NULL),
(278, 147, 4001, 6000, 0.82, 0.55, 0, NULL),
(279, 147, 6001, 8000, 0.81, 0.54, 0, NULL),
(280, 147, 8001, 10000, 0.80, 0.53, 0, NULL),
(281, 147, 10001, 12000, 0.79, 0.52, 0, NULL),
(282, 147, 12001, 15000, 0.78, 0.52, 0, NULL),
(283, 147, 15001, 18000, 0.77, 0.50, 0, NULL),
(284, 147, 18001, 20000, 0.76, 0.49, 0, NULL),
(285, 147, 20001, 23000, 0.75, 0.48, 0, NULL),
(287, 147, 25001, 90000, 0.73, 0.46, 0, NULL),
(288, 147, 23001, 25000, 0.74, 0.47, 0, NULL),
(289, 233, 0, 2500, 0.00, 0.00, 1, '140.00'),
(290, 233, 2501, 4000, 0.97, 0.56, 0, NULL),
(291, 233, 4001, 6000, 0.96, 0.55, 0, NULL),
(292, 233, 6001, 8000, 0.95, 0.54, 0, NULL),
(293, 233, 8001, 10000, 0.94, 0.53, 0, NULL),
(294, 233, 10001, 12000, 0.93, 0.52, 0, NULL),
(295, 233, 12001, 15000, 0.92, 0.51, 0, NULL),
(296, 233, 15001, 18000, 0.91, 0.50, 0, NULL),
(297, 233, 18001, 20000, 0.90, 0.49, 0, NULL),
(298, 233, 20001, 23000, 0.89, 0.48, 0, NULL),
(299, 233, 23001, 25000, 0.88, 0.47, 0, NULL),
(300, 233, 25001, 90000, 0.87, 0.46, 0, NULL),
(301, 27, 0, 2000, 0.00, 0.00, 1, '77.00'),
(302, 27, 2001, 4000, 0.00, 0.00, 1, '87.00'),
(303, 27, 4001, 6000, 0.39, 0.55, 0, NULL),
(304, 27, 6001, 8000, 0.38, 0.54, 0, NULL),
(305, 27, 8001, 10000, 0.37, 0.53, 0, NULL),
(306, 27, 10001, 12000, 0.36, 0.52, 0, NULL),
(307, 27, 12001, 15000, 0.35, 0.51, 0, NULL),
(308, 27, 15001, 18000, 0.34, 0.50, 0, NULL),
(309, 27, 18001, 20000, 0.33, 0.49, 0, NULL),
(310, 27, 20001, 23000, 0.32, 0.48, 0, NULL),
(311, 27, 23001, 25000, 0.31, 0.47, 0, NULL),
(312, 27, 25001, 90000, 0.30, 0.46, 0, NULL),
(313, 252, 0, 2000, 0.00, 0.00, 1, '95.00'),
(314, 252, 2001, 4000, 0.00, 0.00, 1, '117.00'),
(315, 252, 4001, 6000, 0.52, 0.55, 0, NULL),
(316, 252, 6001, 8000, 0.52, 0.54, 0, NULL),
(317, 252, 8001, 10000, 0.51, 0.53, 0, NULL),
(318, 252, 10001, 12000, 0.51, 0.52, 0, NULL),
(319, 252, 12001, 15000, 0.50, 0.51, 0, NULL),
(320, 252, 15001, 18000, 0.50, 0.50, 0, NULL),
(321, 252, 18001, 20000, 0.49, 0.49, 0, NULL),
(322, 252, 20001, 23000, 0.49, 0.48, 0, NULL),
(323, 252, 23001, 25000, 0.48, 0.47, 0, NULL),
(324, 252, 25001, 90000, 0.48, 0.46, 0, NULL),
(325, 251, 0, 2000, 0.00, 0.00, 1, '105.00'),
(326, 251, 2001, 4000, 0.00, 0.00, 1, '125.00'),
(327, 251, 4001, 6000, 0.56, 0.55, 0, NULL),
(328, 251, 6001, 8000, 0.56, 0.54, 0, NULL),
(329, 251, 8001, 10000, 0.55, 0.53, 0, NULL),
(330, 251, 10001, 12000, 0.55, 0.52, 0, NULL),
(331, 251, 12001, 15000, 0.54, 0.51, 0, NULL),
(332, 251, 15001, 18000, 0.54, 0.50, 0, NULL),
(333, 251, 18001, 20000, 0.53, 0.49, 0, NULL),
(334, 251, 20001, 23000, 0.53, 0.48, 0, NULL),
(335, 251, 23001, 25000, 0.52, 0.47, 0, NULL),
(336, 251, 25001, 90000, 0.52, 0.46, 0, NULL),
(337, 250, 0, 2000, 0.00, 0.00, 1, '135.00'),
(338, 250, 2001, 4000, 0.00, 0.00, 1, '155.00'),
(339, 250, 4001, 6000, 0.70, 0.54, 0, NULL),
(340, 250, 6001, 8000, 0.69, 0.53, 0, NULL),
(341, 250, 8001, 10000, 0.69, 0.52, 0, NULL),
(342, 250, 10001, 12000, 0.68, 0.51, 0, NULL),
(343, 250, 12001, 15000, 0.68, 0.50, 0, NULL),
(344, 250, 15001, 18000, 0.67, 0.49, 0, NULL),
(345, 250, 18001, 20000, 0.67, 0.48, 0, NULL),
(346, 250, 20001, 23000, 0.66, 0.47, 0, NULL),
(347, 250, 23001, 25000, 0.66, 0.46, 0, NULL),
(348, 250, 25001, 90000, 0.65, 0.45, 0, NULL),
(349, 28, 0, 2000, 0.00, 0.00, 1, '93.00'),
(350, 28, 2001, 4000, 0.00, 0.00, 1, '109.00'),
(351, 28, 4001, 6000, 0.49, 0.55, 0, NULL),
(352, 28, 6001, 8000, 0.49, 0.54, 0, NULL),
(353, 28, 8001, 10000, 0.48, 0.53, 0, NULL),
(354, 28, 10001, 12000, 0.48, 0.52, 0, NULL),
(355, 28, 12001, 15000, 0.47, 0.51, 0, NULL),
(356, 28, 15001, 18000, 0.47, 0.50, 0, NULL),
(357, 28, 18001, 20000, 0.46, 0.49, 0, NULL),
(358, 28, 20001, 23000, 0.46, 0.48, 0, NULL),
(359, 28, 23001, 25000, 0.45, 0.47, 0, NULL),
(360, 28, 25001, 90000, 0.45, 0.46, 0, NULL),
(361, 31, 0, 2000, 0.00, 0.00, 1, '140.00'),
(362, 31, 2001, 4000, 0.00, 0.00, 1, '155.00'),
(363, 31, 4001, 6000, 0.69, 0.55, 0, NULL),
(364, 31, 6001, 8000, 0.69, 0.54, 0, NULL),
(365, 31, 8001, 10000, 0.68, 0.53, 0, NULL),
(366, 31, 10001, 12000, 0.68, 0.52, 0, NULL),
(367, 31, 12001, 15000, 0.67, 0.51, 0, NULL),
(368, 31, 15001, 18000, 0.67, 0.50, 0, NULL),
(369, 31, 18001, 20000, 0.66, 0.49, 0, NULL),
(370, 31, 20001, 23000, 0.66, 0.48, 0, NULL),
(371, 31, 23001, 25000, 0.65, 0.47, 0, NULL),
(372, 31, 25001, 90000, 0.65, 0.46, 0, NULL),
(373, 249, 0, 2000, 0.00, 0.00, 1, '149.00'),
(374, 249, 2001, 4000, 0.00, 0.00, 1, '169.00'),
(375, 249, 4001, 6000, 0.68, 0.61, 0, NULL),
(376, 249, 6001, 8000, 0.68, 0.60, 0, NULL),
(377, 249, 8001, 10000, 0.67, 0.59, 0, NULL),
(378, 249, 10001, 12000, 0.67, 0.58, 0, NULL),
(379, 249, 12001, 15000, 0.66, 0.57, 0, NULL),
(380, 249, 15001, 18000, 0.66, 0.56, 0, NULL),
(381, 249, 18001, 20000, 0.65, 0.55, 0, NULL),
(382, 249, 20001, 23000, 0.65, 0.54, 0, NULL),
(383, 249, 23001, 25000, 0.64, 0.53, 0, NULL),
(384, 249, 25001, 90000, 0.64, 0.52, 0, NULL),
(385, 260, 0, 2000, 0.00, 0.00, 1, '65.00'),
(386, 260, 2001, 4000, 0.25, 0.50, 0, NULL),
(387, 260, 4001, 6000, 0.39, 0.55, 0, NULL),
(388, 260, 6001, 8000, 0.38, 0.54, 0, NULL),
(389, 260, 8001, 10000, 0.37, 0.53, 0, NULL),
(390, 260, 10001, 12000, 0.36, 0.52, 0, NULL),
(391, 260, 12001, 15000, 0.35, 0.51, 0, NULL),
(392, 260, 15001, 18000, 0.34, 0.50, 0, NULL),
(393, 260, 18001, 20000, 0.33, 0.49, 0, NULL),
(394, 260, 20001, 23000, 0.32, 0.48, 0, NULL),
(395, 260, 23001, 25000, 0.31, 0.47, 0, NULL),
(396, 260, 25001, 90000, 0.30, 0.46, 0, NULL),
(397, 262, 0, 2000, 0.00, 0.00, 1, '77.00'),
(398, 262, 2001, 4000, 0.00, 0.00, 1, '87.00'),
(399, 262, 4001, 6000, 0.39, 0.55, 0, NULL),
(400, 262, 6001, 8000, 0.38, 0.54, 0, NULL),
(401, 262, 8001, 10000, 0.37, 0.53, 0, NULL),
(402, 262, 10001, 12000, 0.36, 0.52, 0, NULL),
(403, 262, 12001, 15000, 0.35, 0.51, 0, NULL),
(404, 260, 15001, 18000, 0.34, 0.50, 0, NULL),
(405, 262, 18001, 20000, 0.33, 0.49, 0, NULL),
(406, 262, 20001, 23000, 0.32, 0.48, 0, NULL),
(407, 262, 23001, 25000, 0.31, 0.47, 0, NULL),
(408, 262, 25001, 90000, 0.30, 0.46, 0, NULL),
(409, 265, 0, 2000, 0.00, 0.00, 1, '95.00'),
(410, 265, 2001, 4000, 0.00, 0.00, 1, '117.00'),
(411, 265, 4001, 6000, 0.52, 0.55, 0, NULL),
(412, 265, 6001, 8000, 0.52, 0.54, 0, NULL),
(413, 265, 8001, 10000, 0.51, 0.53, 0, NULL),
(414, 265, 10001, 12000, 0.51, 0.52, 0, NULL),
(415, 265, 12001, 15000, 0.50, 0.51, 0, NULL),
(416, 265, 15001, 18000, 0.50, 0.50, 0, NULL),
(417, 265, 18001, 20000, 0.49, 0.49, 0, NULL),
(418, 265, 20001, 23000, 0.49, 0.48, 0, NULL),
(419, 265, 23001, 25000, 0.48, 0.47, 0, NULL),
(420, 265, 25001, 90000, 0.48, 0.46, 0, NULL),
(421, 69, 0, 2000, 0.00, 0.00, 1, '105.00'),
(422, 69, 2001, 4000, 0.00, 0.00, 1, '125.00'),
(423, 69, 4001, 6000, 0.56, 0.55, 0, NULL),
(424, 69, 6001, 8000, 0.56, 0.54, 0, NULL),
(425, 69, 8001, 10000, 0.55, 0.53, 0, NULL),
(426, 69, 10001, 12000, 0.55, 0.52, 0, NULL),
(427, 69, 12001, 15000, 0.54, 0.51, 0, NULL),
(428, 69, 15001, 18000, 0.54, 0.50, 0, NULL),
(429, 69, 18001, 20000, 0.53, 0.49, 0, NULL),
(430, 69, 20001, 23000, 0.53, 0.48, 0, NULL),
(431, 69, 23001, 25000, 0.52, 0.47, 0, NULL),
(432, 69, 25001, 90000, 0.52, 0.46, 0, NULL),
(433, 264, 0, 2000, 0.00, 0.00, 1, '135.00'),
(434, 264, 2001, 4000, 0.00, 0.00, 1, '155.00'),
(435, 264, 4001, 6000, 0.70, 0.54, 0, NULL),
(436, 264, 6001, 8000, 0.69, 0.53, 0, NULL),
(437, 264, 8001, 10000, 0.69, 0.52, 0, NULL),
(438, 264, 10001, 12000, 0.68, 0.51, 0, NULL),
(439, 264, 12001, 15000, 0.68, 0.50, 0, NULL),
(440, 264, 15001, 18000, 0.67, 0.49, 0, NULL),
(441, 264, 18001, 20000, 0.67, 0.48, 0, NULL),
(442, 264, 20001, 23000, 0.66, 0.47, 0, NULL),
(443, 264, 23001, 25000, 0.66, 0.46, 0, NULL),
(444, 264, 25001, 90000, 0.65, 0.45, 0, NULL),
(445, 261, 0, 2000, 0.00, 0.00, 1, '93.00'),
(446, 261, 2001, 4000, 0.00, 0.00, 1, '109.00'),
(447, 261, 4001, 6000, 0.49, 0.55, 0, NULL),
(448, 261, 6001, 8000, 0.49, 0.54, 0, NULL),
(449, 261, 8001, 10000, 0.48, 0.53, 0, NULL),
(450, 261, 10001, 12000, 0.48, 0.52, 0, NULL),
(451, 261, 12001, 15000, 0.47, 0.51, 0, NULL),
(452, 261, 15001, 18000, 0.47, 0.50, 0, NULL),
(453, 261, 18001, 20000, 0.46, 0.49, 0, NULL),
(454, 261, 20001, 23000, 0.46, 0.48, 0, NULL),
(455, 261, 23001, 25000, 0.45, 0.47, 0, NULL),
(456, 261, 25001, 90000, 0.45, 0.46, 0, NULL),
(457, 68, 0, 2000, 0.00, 0.00, 1, '140.00'),
(458, 68, 2001, 4000, 0.00, 0.00, 1, '155.00'),
(459, 68, 4001, 6000, 0.69, 0.55, 0, NULL),
(460, 68, 6001, 8000, 0.69, 0.54, 0, NULL),
(461, 68, 8001, 10000, 0.68, 0.53, 0, NULL),
(462, 68, 10001, 12000, 0.68, 0.52, 0, NULL),
(463, 68, 12001, 15000, 0.67, 0.51, 0, NULL),
(464, 68, 15001, 18000, 0.67, 0.50, 0, NULL),
(465, 68, 18001, 20000, 0.66, 0.49, 0, NULL),
(466, 68, 20001, 23000, 0.66, 0.48, 0, NULL),
(467, 68, 23001, 25000, 0.65, 0.47, 0, NULL),
(468, 68, 25001, 90000, 0.65, 0.46, 0, NULL),
(469, 263, 0, 2000, 0.00, 0.00, 1, '149.00'),
(470, 263, 2001, 4000, 0.00, 0.00, 1, '169.00'),
(471, 263, 4001, 6000, 0.68, 0.61, 0, NULL),
(472, 263, 6001, 8000, 0.68, 0.60, 0, NULL),
(473, 263, 8001, 10000, 0.67, 0.59, 0, NULL),
(474, 263, 10001, 12000, 0.67, 0.58, 0, NULL),
(475, 263, 12001, 15000, 0.66, 0.57, 0, NULL),
(476, 263, 15001, 18000, 0.66, 0.56, 0, NULL),
(477, 263, 18001, 20000, 0.65, 0.55, 0, NULL),
(478, 263, 20001, 23000, 0.65, 0.54, 0, NULL),
(479, 263, 23001, 25000, 0.64, 0.53, 0, NULL),
(480, 263, 25001, 90000, 0.64, 0.52, 0, NULL),
(481, 296, 1023, 1024, 0.00, 0.00, 1, '659.00'),
(482, 296, 1935, 1936, 0.00, 0.00, 1, '765.00'),
(483, 296, 3363, 3364, 0.00, 0.00, 1, '852.00'),
(484, 296, 5624, 5625, 0.00, 0.00, 1, '965.00'),
(485, 297, 1368, 1369, 0.00, 0.00, 1, '1132.00'),
(486, 297, 2499, 2500, 0.00, 0.00, 1, '1265.00'),
(487, 308, 2963, 2964, 0.00, 0.00, 1, '1331.00'),
(488, 327, 2089, 2090, 0.00, 0.00, 1, '154.00'),
(489, 327, 2399, 2400, 0.00, 0.00, 1, '172.00'),
(490, 327, 2924, 2925, 0.00, 0.00, 1, '209.00'),
(491, 327, 3499, 3500, 0.00, 0.00, 1, '235.00'),
(492, 327, 4399, 4400, 0.00, 0.00, 1, '245.00'),
(493, 327, 5849, 5850, 0.00, 0.00, 1, '291.00'),
(494, 327, 7199, 7200, 0.00, 0.00, 1, '387.00'),
(495, 350, 2024, 2025, 0.00, 0.00, 1, '154.00'),
(496, 350, 2499, 2500, 0.00, 0.00, 1, '174.00'),
(497, 350, 3024, 3025, 0.00, 0.00, 1, '193.00'),
(498, 350, 3599, 3600, 0.00, 0.00, 1, '213.00'),
(499, 350, 4224, 4225, 0.00, 0.00, 1, '232.00'),
(500, 350, 4899, 4900, 0.00, 0.00, 1, '252.00'),
(501, 350, 6399, 6400, 0.00, 0.00, 1, '291.00'),
(525, 79, 0, 2704, 0.00, 0.00, 1, '71.00'),
(526, 79, 2705, 4900, 0.00, 0.00, 1, '83.00'),
(527, 79, 4901, 8100, 0.30, 0.55, 0, NULL),
(528, 79, 8101, 12100, 0.29, 0.55, 0, NULL),
(529, 79, 12101, 16900, 0.28, 0.55, 0, NULL),
(530, 79, 16901, 22500, 0.27, 0.54, 0, NULL),
(531, 79, 22501, 32400, 0.26, 0.53, 0, NULL),
(532, 79, 32401, 40000, 0.25, 0.52, 0, NULL),
(533, 79, 40001, 52900, 0.24, 0.51, 0, NULL),
(534, 79, 52901, 62500, 0.23, 0.50, 0, NULL),
(535, 79, 62501, 78400, 0.22, 0.49, 0, NULL),
(536, 79, 78401, 90000, 0.21, 0.48, 0, NULL),
(537, 372, 0, 2704, 0.00, 0.00, 1, '71.00'),
(538, 372, 2705, 4900, 0.00, 0.00, 1, '83.00'),
(539, 372, 4901, 8100, 0.30, 0.55, 0, NULL),
(540, 372, 8101, 12100, 0.29, 0.55, 0, NULL),
(541, 372, 12101, 16900, 0.28, 0.55, 0, NULL),
(542, 372, 16901, 22500, 0.27, 0.54, 0, NULL),
(543, 372, 22501, 32400, 0.26, 0.53, 0, NULL),
(544, 372, 32401, 40000, 0.25, 0.52, 0, NULL),
(545, 372, 40001, 52900, 0.24, 0.51, 0, NULL),
(546, 372, 52901, 62500, 0.23, 0.50, 0, NULL),
(547, 372, 62501, 78400, 0.22, 0.49, 0, NULL),
(548, 372, 78401, 90000, 0.21, 0.48, 0, NULL),
(549, 82, 0, 2704, 0.00, 0.00, 1, '92.00'),
(550, 82, 2705, 4900, 0.00, 0.00, 1, '102.00'),
(551, 82, 4901, 8100, 0.37, 0.55, 0, NULL),
(552, 82, 8101, 12100, 0.37, 0.54, 0, NULL),
(553, 82, 12101, 16900, 0.36, 0.54, 0, NULL),
(554, 82, 16901, 22500, 0.36, 0.53, 0, NULL),
(555, 82, 22501, 32400, 0.35, 0.53, 0, NULL),
(556, 82, 32401, 40000, 0.35, 0.52, 0, NULL),
(557, 82, 40001, 52900, 0.34, 0.52, 0, NULL),
(558, 82, 52901, 62500, 0.34, 0.51, 0, NULL),
(559, 82, 62501, 78400, 0.33, 0.51, 0, NULL),
(560, 82, 78401, 90000, 0.33, 0.50, 0, NULL),
(561, 81, 0, 2704, 0.00, 0.00, 1, '109.00'),
(562, 81, 2705, 4900, 0.00, 0.00, 1, '119.00'),
(563, 81, 4901, 8100, 0.44, 0.55, 0, NULL),
(564, 81, 8101, 12100, 0.44, 0.54, 0, NULL),
(565, 81, 12101, 16900, 0.43, 0.54, 0, NULL),
(566, 81, 16901, 22500, 0.43, 0.53, 0, NULL),
(567, 81, 22501, 32400, 0.42, 0.53, 0, NULL),
(568, 81, 32401, 40000, 0.42, 0.52, 0, NULL),
(569, 81, 40001, 52900, 0.41, 0.52, 0, NULL),
(570, 81, 52901, 62500, 0.41, 0.51, 0, NULL),
(571, 81, 62501, 78400, 0.40, 0.51, 0, NULL),
(572, 81, 78401, 90000, 0.40, 0.50, 0, NULL),
(573, 375, 0, 2704, 0.00, 0.00, 1, '159.00'),
(574, 375, 2705, 4900, 0.00, 0.00, 1, '179.00'),
(575, 375, 4901, 8100, 0.65, 0.55, 0, NULL),
(576, 375, 8101, 12100, 0.65, 0.54, 0, NULL),
(577, 375, 12101, 16900, 0.64, 0.54, 0, NULL),
(578, 375, 16901, 22500, 0.64, 0.53, 0, NULL),
(579, 375, 22501, 32400, 0.63, 0.53, 0, NULL),
(580, 375, 32401, 40000, 0.63, 0.52, 0, NULL),
(581, 375, 40001, 52900, 0.62, 0.52, 0, NULL),
(582, 375, 52901, 62500, 0.62, 0.51, 0, NULL),
(583, 375, 62501, 78400, 0.61, 0.51, 0, NULL),
(584, 375, 78401, 90000, 0.61, 0.50, 0, NULL),
(585, 80, 0, 2704, 0.00, 0.00, 1, '89.00'),
(586, 80, 2705, 4900, 0.00, 0.00, 1, '99.00'),
(587, 80, 4901, 8100, 0.37, 0.55, 0, NULL),
(588, 80, 8101, 12100, 0.37, 0.54, 0, NULL),
(589, 80, 12101, 16900, 0.36, 0.54, 0, NULL),
(590, 80, 16901, 22500, 0.36, 0.53, 0, NULL),
(591, 80, 22501, 32400, 0.35, 0.53, 0, NULL),
(592, 80, 32401, 40000, 0.35, 0.52, 0, NULL),
(593, 80, 40001, 52900, 0.34, 0.52, 0, NULL),
(594, 80, 52901, 62500, 0.34, 0.51, 0, NULL),
(595, 80, 62501, 78400, 0.33, 0.51, 0, NULL),
(597, 80, 78401, 90000, 0.33, 0.50, 0, NULL),
(598, 374, 0, 2704, 0.00, 0.00, 1, '113.00'),
(599, 374, 2705, 4900, 0.00, 0.00, 1, '129.00'),
(600, 374, 4901, 8100, 0.47, 0.55, 0, NULL),
(601, 374, 8101, 12100, 0.47, 0.54, 0, NULL),
(602, 374, 12101, 16900, 0.46, 0.54, 0, NULL),
(603, 374, 16901, 22500, 0.46, 0.53, 0, NULL),
(604, 374, 22501, 32400, 0.45, 0.53, 0, NULL),
(605, 374, 32401, 40000, 0.45, 0.52, 0, NULL),
(606, 374, 40001, 52900, 0.44, 0.52, 0, NULL),
(607, 374, 52901, 62500, 0.44, 0.51, 0, NULL),
(608, 374, 62501, 78400, 0.43, 0.51, 0, NULL),
(609, 374, 78401, 90000, 0.43, 0.50, 0, NULL),
(610, 373, 0, 2704, 0.00, 0.00, 1, '137.00'),
(611, 373, 2705, 4900, 0.00, 0.00, 1, '147.00'),
(612, 373, 4901, 8100, 0.54, 0.55, 0, NULL),
(615, 373, 8101, 12100, 0.54, 0.54, 0, NULL),
(616, 373, 12101, 16900, 0.53, 0.54, 0, NULL),
(617, 373, 16901, 22500, 0.53, 0.53, 0, NULL),
(618, 373, 22501, 32400, 0.52, 0.53, 0, NULL),
(619, 373, 32401, 40000, 0.52, 0.52, 0, NULL),
(620, 373, 40001, 52900, 0.51, 0.52, 0, NULL),
(621, 373, 52901, 62500, 0.51, 0.51, 0, NULL),
(622, 373, 62501, 78400, 0.50, 0.51, 0, NULL),
(623, 373, 78401, 90000, 0.50, 0.50, 0, NULL);

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
(4, 13, 100, 80.00),
(5, 13, 200, 84.00),
(6, 13, 300, 89.00),
(7, 13, 400, 92.00),
(8, 13, 500, 95.00),
(32, 13, 10, 70.00),
(33, 13, 50, 76.00),
(35, 150, 10, 48.00),
(36, 150, 50, 52.00),
(37, 150, 100, 55.00),
(38, 150, 200, 65.00),
(39, 150, 300, 75.00),
(40, 150, 400, 83.00),
(41, 150, 500, 90.00),
(49, 44, 10, 48.00),
(50, 44, 50, 52.00),
(51, 44, 100, 55.00),
(52, 44, 200, 65.00),
(53, 44, 300, 75.00),
(54, 44, 400, 83.00),
(55, 44, 500, 90.00),
(56, 42, 10, 45.00),
(57, 42, 50, 50.00),
(58, 42, 100, 53.00),
(59, 42, 200, 58.00),
(60, 42, 300, 63.00),
(63, 42, 400, 68.00),
(64, 42, 500, 73.00),
(65, 47, 10, 45.00),
(66, 47, 50, 52.00),
(67, 47, 100, 55.00),
(68, 47, 200, 65.00),
(69, 47, 300, 71.00),
(70, 47, 400, 78.00),
(71, 47, 500, 80.00),
(72, 45, 10, 45.00),
(73, 45, 50, 52.00),
(74, 45, 100, 55.00),
(75, 45, 200, 65.00),
(76, 45, 300, 71.00),
(77, 45, 400, 78.00),
(78, 45, 500, 80.00),
(79, 92, 1, 10.00),
(92, 151, 10, 48.00),
(93, 151, 50, 52.00),
(94, 151, 100, 55.00),
(95, 151, 200, 65.00),
(96, 151, 300, 75.00),
(97, 151, 400, 83.00),
(98, 151, 500, 90.00),
(99, 192, 10, 55.00),
(100, 192, 50, 60.00),
(101, 192, 100, 70.00),
(102, 192, 200, 78.00),
(103, 192, 300, 83.00),
(104, 192, 400, 88.00),
(105, 192, 500, 93.00),
(106, 152, 10, 55.00),
(107, 152, 50, 80.00),
(108, 152, 100, 70.00),
(109, 152, 200, 78.00),
(110, 152, 300, 83.00),
(111, 152, 400, 88.00),
(112, 152, 500, 93.00),
(113, 149, 10, 70.00),
(114, 149, 50, 76.00),
(115, 149, 100, 80.00),
(116, 149, 200, 84.00),
(117, 149, 300, 89.00),
(118, 149, 400, 92.00),
(119, 149, 500, 95.00),
(120, 148, 10, 70.00),
(121, 148, 50, 76.00),
(122, 148, 100, 80.00),
(123, 148, 200, 84.00),
(124, 148, 300, 89.00),
(125, 148, 400, 92.00),
(126, 148, 500, 95.00),
(127, 234, 10, 70.00),
(128, 234, 50, 76.00),
(129, 234, 100, 80.00),
(130, 234, 200, 84.00),
(131, 234, 300, 89.00),
(132, 234, 400, 92.00),
(133, 234, 500, 95.00),
(134, 232, 10, 70.00),
(135, 232, 50, 76.00),
(136, 232, 100, 80.00),
(137, 232, 200, 84.00),
(138, 232, 300, 89.00),
(139, 232, 400, 92.00),
(140, 232, 500, 95.00),
(141, 14, 10, 70.00),
(142, 14, 50, 76.00),
(143, 14, 100, 80.00),
(147, 14, 200, 84.00),
(148, 14, 300, 89.00),
(149, 14, 400, 92.00),
(150, 14, 500, 95.00),
(151, 147, 10, 70.00),
(152, 147, 50, 76.00),
(153, 147, 100, 80.00),
(154, 147, 200, 84.00),
(155, 147, 300, 89.00),
(156, 147, 400, 92.00),
(157, 147, 500, 95.00),
(158, 233, 10, 70.00),
(159, 233, 50, 76.00),
(160, 233, 100, 80.00),
(161, 233, 200, 84.00),
(162, 233, 300, 89.00),
(163, 233, 400, 92.00),
(164, 233, 500, 95.00),
(165, 27, 10, 70.00),
(166, 27, 50, 76.00),
(167, 27, 100, 80.00),
(168, 27, 200, 84.00),
(169, 27, 300, 89.00),
(170, 27, 400, 92.00),
(171, 27, 500, 95.00),
(172, 28, 10, 70.00),
(173, 28, 50, 76.00),
(174, 28, 100, 80.00),
(175, 28, 200, 84.00),
(176, 28, 300, 89.00),
(177, 28, 400, 92.00),
(178, 28, 500, 95.00),
(179, 248, 10, 70.00),
(180, 248, 50, 76.00),
(181, 248, 100, 80.00),
(182, 248, 200, 84.00),
(183, 248, 300, 89.00),
(184, 248, 400, 92.00),
(185, 248, 500, 95.00),
(186, 249, 10, 70.00),
(187, 249, 50, 76.00),
(188, 249, 100, 80.00),
(189, 249, 200, 84.00),
(190, 249, 300, 89.00),
(191, 249, 400, 92.00),
(192, 249, 500, 95.00),
(193, 31, 10, 70.00),
(194, 31, 50, 76.00),
(195, 31, 100, 80.00),
(196, 31, 200, 84.00),
(197, 31, 300, 89.00),
(198, 31, 400, 92.00),
(199, 31, 500, 95.00),
(201, 250, 10, 70.00),
(202, 250, 50, 76.00),
(203, 250, 100, 80.00),
(204, 250, 200, 84.00),
(205, 250, 300, 89.00),
(206, 250, 400, 92.00),
(207, 250, 500, 95.00),
(208, 251, 10, 70.00),
(209, 251, 50, 76.00),
(210, 251, 100, 80.00),
(211, 251, 200, 84.00),
(212, 251, 300, 89.00),
(213, 251, 400, 92.00),
(214, 251, 500, 95.00),
(215, 252, 10, 70.00),
(216, 252, 50, 76.00),
(217, 252, 100, 80.00),
(218, 252, 200, 84.00),
(219, 252, 300, 89.00),
(220, 252, 400, 92.00),
(221, 252, 500, 95.00),
(222, 260, 10, 70.00),
(223, 260, 50, 76.00),
(224, 260, 100, 80.00),
(225, 260, 200, 84.00),
(226, 260, 300, 89.00),
(227, 260, 400, 92.00),
(228, 260, 500, 95.00),
(229, 261, 10, 70.00),
(230, 261, 50, 76.00),
(231, 261, 100, 80.00),
(232, 261, 200, 84.00),
(233, 261, 300, 89.00),
(234, 261, 400, 92.00),
(235, 261, 500, 95.00),
(236, 262, 10, 70.00),
(237, 262, 50, 76.00),
(238, 262, 100, 80.00),
(239, 262, 200, 84.00),
(240, 262, 300, 89.00),
(241, 262, 400, 92.00),
(242, 262, 500, 95.00),
(243, 263, 10, 70.00),
(244, 263, 50, 76.00),
(245, 263, 100, 80.00),
(246, 263, 200, 84.00),
(247, 263, 300, 89.00),
(248, 263, 400, 92.00),
(249, 263, 500, 95.00),
(250, 68, 10, 70.00),
(251, 68, 50, 76.00),
(252, 68, 100, 80.00),
(253, 68, 200, 84.00),
(254, 68, 300, 89.00),
(255, 68, 400, 92.00),
(256, 68, 500, 95.00),
(257, 264, 10, 70.00),
(258, 264, 50, 76.00),
(259, 264, 100, 80.00),
(260, 264, 200, 84.00),
(261, 264, 300, 89.00),
(262, 264, 400, 92.00),
(263, 264, 500, 95.00),
(264, 69, 10, 70.00),
(265, 69, 50, 76.00),
(266, 69, 100, 80.00),
(267, 69, 200, 84.00),
(268, 69, 300, 89.00),
(269, 69, 400, 92.00),
(270, 69, 500, 95.00),
(271, 265, 10, 70.00),
(272, 265, 50, 76.00),
(273, 265, 100, 80.00),
(274, 265, 200, 84.00),
(275, 265, 300, 89.00),
(276, 265, 400, 92.00),
(277, 265, 500, 95.00),
(278, 296, 10, 7.00),
(279, 296, 50, 8.50),
(280, 296, 100, 16.00),
(281, 296, 200, 29.00),
(282, 296, 300, 40.00),
(283, 296, 400, 49.00),
(284, 296, 500, 56.00),
(285, 297, 10, 7.00),
(286, 297, 50, 8.50),
(287, 297, 100, 16.00),
(288, 297, 200, 29.00),
(289, 297, 300, 40.00),
(290, 297, 400, 49.00),
(291, 297, 500, 56.00),
(292, 308, 10, 7.00),
(293, 308, 50, 8.50),
(294, 308, 100, 16.00),
(295, 308, 200, 29.00),
(296, 308, 300, 40.00),
(297, 308, 400, 49.00),
(298, 308, 500, 56.00),
(299, 327, 100, 60.00),
(300, 327, 200, 70.00),
(301, 327, 300, 80.00),
(302, 327, 400, 85.00),
(303, 327, 500, 90.00),
(304, 350, 100, 60.00),
(305, 350, 200, 70.00),
(306, 350, 300, 80.00),
(307, 350, 400, 85.00),
(308, 350, 500, 90.00),
(309, 79, 10, 75.00),
(310, 79, 50, 80.00),
(311, 79, 100, 83.00),
(312, 79, 200, 86.00),
(313, 79, 300, 89.00),
(314, 79, 400, 92.00),
(315, 79, 500, 95.00),
(316, 372, 10, 75.00),
(317, 372, 50, 80.00),
(318, 372, 100, 83.00),
(319, 372, 200, 86.00),
(320, 372, 300, 89.00),
(321, 372, 400, 92.00),
(322, 372, 500, 95.00),
(323, 80, 10, 75.00),
(324, 80, 50, 80.00),
(325, 80, 100, 83.00),
(326, 80, 200, 86.00),
(327, 80, 300, 89.00),
(328, 80, 400, 92.00),
(329, 80, 500, 95.00),
(330, 373, 10, 75.00),
(331, 373, 50, 80.00),
(332, 373, 100, 83.00),
(333, 373, 200, 86.00),
(334, 373, 300, 89.00),
(335, 373, 400, 92.00),
(336, 373, 500, 95.00),
(337, 374, 10, 75.00),
(338, 374, 50, 80.00),
(339, 374, 100, 83.00),
(340, 374, 200, 86.00),
(341, 374, 300, 89.00),
(342, 374, 400, 92.00),
(343, 374, 500, 95.00),
(344, 375, 10, 75.00),
(345, 375, 50, 80.00),
(346, 375, 100, 83.00),
(347, 375, 200, 86.00),
(348, 375, 300, 89.00),
(349, 375, 400, 92.00),
(350, 375, 500, 95.00),
(351, 81, 10, 75.00),
(352, 81, 50, 80.00),
(353, 81, 100, 83.00),
(354, 81, 200, 86.00),
(355, 81, 300, 89.00),
(356, 81, 400, 92.00),
(357, 81, 500, 95.00),
(358, 82, 10, 75.00),
(359, 82, 50, 80.00),
(360, 82, 100, 83.00),
(361, 82, 200, 86.00),
(362, 82, 300, 89.00),
(363, 82, 400, 92.00),
(364, 82, 500, 95.00);

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
(11, 42, 1000, 1000, 5000, 9.00),
(12, 42, 1000, 5000, 20000, 2.00),
(13, 47, 1000, 1000, 4000, 9.00),
(14, 47, 1000, 5000, 20000, 2.00),
(16, 13, 1000, 1000, 4000, 9.00),
(17, 13, 1000, 4000, 20000, 1.00),
(19, 150, 1000, 1000, 5000, 9.00),
(20, 150, 1000, 5000, 20000, 2.00),
(25, 44, 1000, 1000, 4000, 8.00),
(26, 44, 1000, 5000, 20000, 2.00),
(28, 151, 1000, 1000, 4000, 9.00),
(30, 151, 1000, 5000, 20000, 2.00),
(31, 45, 1000, 1000, 4000, 9.00),
(32, 45, 1000, 5000, 20000, 2.00),
(36, 192, 1000, 1000, 4000, 9.00),
(37, 192, 1000, 4000, 20000, 2.00),
(38, 152, 1000, 1000, 4000, 9.00),
(39, 152, 1000, 4000, 20000, 2.00),
(40, 14, 1000, 1000, 4000, 9.00),
(41, 14, 1000, 4000, 20000, 1.00),
(42, 232, 1000, 1000, 4000, 9.00),
(43, 232, 1000, 4000, 20000, 1.00),
(44, 233, 1000, 1000, 4000, 9.00),
(45, 233, 1000, 4000, 20000, 1.00),
(46, 147, 1000, 1000, 4000, 9.00),
(47, 147, 1000, 4000, 20000, 1.00),
(48, 234, 1000, 1000, 4000, 9.00),
(49, 234, 1000, 4000, 20000, 1.00),
(50, 148, 1000, 1000, 4000, 9.00),
(51, 148, 1000, 4000, 20000, 1.00),
(52, 149, 1000, 1000, 4000, 9.00),
(53, 149, 1000, 4000, 20000, 1.00),
(54, 27, 1000, 1000, 5000, 8.00),
(55, 27, 1000, 5000, 20000, 2.00),
(56, 28, 1000, 1000, 5000, 8.00),
(57, 28, 1000, 5000, 20000, 2.00),
(58, 248, 1000, 1000, 5000, 8.00),
(59, 248, 1000, 5000, 20000, 2.00),
(60, 249, 1000, 1000, 5000, 8.00),
(61, 249, 1000, 5000, 20000, 2.00),
(62, 250, 1000, 1000, 5000, 8.00),
(63, 250, 1000, 5000, 20000, 2.00),
(64, 251, 1000, 1000, 5000, 8.00),
(65, 251, 1000, 5000, 20000, 2.00),
(66, 252, 1000, 1000, 5000, 8.00),
(67, 252, 1000, 5000, 20000, 2.00),
(68, 260, 1000, 1000, 4000, 9.00),
(69, 260, 1000, 4000, 10000, 2.00),
(70, 261, 1000, 1000, 5000, 8.00),
(71, 261, 1000, 5000, 20000, 2.00),
(72, 262, 1000, 1000, 5000, 8.00),
(73, 262, 1000, 5000, 20000, 2.00),
(74, 263, 1000, 1000, 5000, 8.00),
(75, 263, 1000, 5000, 20000, 2.00),
(76, 68, 1000, 1000, 5000, 8.00),
(77, 68, 1000, 5000, 20000, 2.00),
(78, 264, 1000, 1000, 5000, 8.00),
(79, 264, 1000, 5000, 20000, 2.00),
(80, 69, 1000, 1000, 5000, 8.00),
(81, 69, 1000, 5000, 20000, 2.00),
(82, 265, 1000, 1000, 5000, 8.00),
(83, 265, 1000, 5000, 20000, 2.00),
(84, 327, 1000, 1000, 4000, 12.00),
(85, 327, 1000, 4000, 10000, 2.00),
(86, 350, 1000, 1000, 4000, 12.00),
(87, 350, 1000, 4000, 10000, 2.00),
(88, 79, 1000, 1000, 4000, 12.00),
(89, 79, 1000, 4000, 20000, 1.00),
(90, 372, 1000, 1000, 4000, 12.00),
(91, 372, 1000, 4000, 20000, 1.00),
(92, 82, 1000, 1000, 5000, 8.00),
(93, 82, 1000, 5000, 20000, 2.00),
(94, 81, 1000, 1000, 4000, 12.00),
(95, 81, 1000, 4000, 20000, 1.00),
(96, 375, 1000, 1000, 4000, 12.00),
(98, 375, 1000, 4000, 20000, 1.00),
(99, 80, 1000, 1000, 4000, 12.00),
(100, 80, 1000, 4000, 20000, 1.00),
(101, 374, 1000, 1000, 4000, 8.00),
(102, 374, 1000, 4000, 20000, 1.00),
(103, 373, 1000, 1000, 4000, 8.00),
(104, 373, 1000, 4000, 20000, 1.00),
(105, 260, 1000, 10000, 20000, 1.00);

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
(2, 'Square/Rectangle', 'some meta', 'Square Sticker_3.jpg', 6, 'Square/Rectangle', 'squarerectangle', 'Square-Stickers.png', 'Our custom square stickers are great for logos, product labels, artwork reproductions and more. Our proof approval process lets you work directly with us to ensure the size, borders, and look are perfect for your business.', 'Square Sticker_2.jpg', 40, 300, 2, '2017-05-30 14:35:51', '2017-10-06 14:40:20'),
(4, 'Custom Shape', NULL, NULL, 6, 'Custom Shape', 'custom-shape', 'Custom-Shape-Stickers.png', 'Printing Amazon’s Premium Business Cards will set you apart from the crowd with our carefully selected materials and high definition printing technology. Our proof approval process let you work directly with us to ensure the size, corners, and look are perfect. From every day to extra special. With a variety of stocks and specialty finishes, designing your unique custom business cards is easier than you think.', 'Die-cutting_9.jpg', 10, 300, 2, '2017-06-19 15:22:41', '2017-09-28 16:56:54'),
(17, 'Ovals', NULL, NULL, 6, 'Ovals', 'ovals', 'Oval-Stickers.png', 'Custom Oval Stickers are a great way to represent your state, team or organisation. Our proof approval process lets you work directly with us to ensure the size, borders, and look are perfect for your needs.', 'Rectangle Sticker_1.jpg', 10, 300, 3, '2017-08-15 14:00:51', '2017-09-28 16:56:45'),
(20, 'Rounded Corner', NULL, NULL, 6, 'Rounded Corner', 'rounded-corner', 'Round-Corner-Stickers.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Die-cutting_7.jpg', 10, 300, 1, '2017-08-15 16:42:47', '2017-09-28 16:56:35'),
(21, 'Circle Stickers', NULL, NULL, 6, 'Circle', 'circle', 'Circle-Stickers.png', 'Easy to hand out, Printing Amazon’s Circle Stickers are a great way to promote your brand or label your products. Our proof approval process lets you work directly with us to ensure the size, borders, and look are perfect.', 'Round Sticker_1.png', 10, 300, 4, '2017-08-15 16:57:52', '2017-09-28 16:56:25'),
(22, 'Name stickers - Printing Amazon', NULL, NULL, 6, 'Name stickers', 'name-stickers', 'Name-Stickers.png', 'If you are getting headaches with your kids because they lose their belongings at school, try our Name stickers. We provide various forms of pre-designed artworks and you only simply need to let us know the detail that you would like to apply onto the sticker and you would a name sticker you would be proud of. \r\n(***We may have to abbreviate your child\'s name due to limited sticker spaces.)', NULL, 30, 300, 5, '2017-08-16 13:48:57', '2017-09-29 11:38:01'),
(23, 'Labels - Printing Amazon', NULL, NULL, 5, 'Labels', 'labels', 'Labels.png', 'Printing Amazon provides custom Label printing services by using flexographic and digital printing techniques. Both of these printing methods produce high-quality labels, and each method offers different capabilities that allow us to create a larger variety of label styles. Simply leave your brief requirements and contact details, and our service consultant will contact you within 24 hours. We provide quality and durable labels. Ordering from us means your stickers will withstand exposure and they would always portray your brand whenever.', 'PVC-paper-custom-label-sticker-logo-printing-self-adhesive-shipping-labels-custom-sticker-label-stickers.jpg', 0, 0, 1, '2017-08-19 13:08:47', '2017-09-28 16:55:57'),
(24, 'Graphic Designs - Printing Amazon', NULL, NULL, 5, 'Graphic Designs', 'graphic-designs', 'Grahpic-Design.png', 'Printing Amazon provides custom Graphic Design services for all business. Our professional graphic design team with more than 20 years of experience. We are well known because we provide quality graphic design for every demand by our clients and we get satisfactory feedbacks every time from our clients. Simply send us your requirements and contact details, and our service consultant will contact you within 24 hours to help you make your idea a reality.', 'gshock-watch-sports-watch-stopwatch-158741.jpeg*hacker-internet-technology-computers-159195.jpeg', 0, 0, 2, '2017-08-19 13:24:07', '2017-09-28 16:56:06'),
(27, 'Circle Badge with Pin', NULL, NULL, 1, 'Circle with Pin', 'circle-with-pin', 'Circle-Pin-Badge.png', 'Small custom round buttons feature full color printing and a durable steel pin-back.', 'Pin Button 1.jpg*Pin Button 3.jpg*Pin Button 4.jpg', 0, 0, 1, '2017-09-28 15:34:59', '2017-10-06 14:38:59'),
(28, 'Square Badge with Pin', NULL, NULL, 1, 'Square Pin', 'square-pin', 'Square-Pin.png', 'Small custom square buttons feature full color printing and a durable steel pin-back.', 'Square Pin Button 1.jpg*Square Pin Button 2.jpg*Square Pin Button 3.jpg*Square Pin Button 4.jpg', 0, 0, 2, '2017-09-28 16:39:35', '2017-10-06 14:37:57'),
(29, 'Heart Pin', NULL, NULL, 1, 'Heart Pin', 'heart-pin', 'Heart-Pin.png', 'Custom heart buttons feature full color printing and a durable steel pin-back.', 'Heart Pint Button 1.jpg*Heart Pint Button 2.jpg', 0, 0, 3, '2017-09-28 22:48:42', '2017-10-06 14:37:38'),
(31, 'Round Corner Magnets', NULL, NULL, 2, 'Round Corner', 'round-corner', 'Round-Corner-Magnets.png', 'Varies of round corner magnets with your personal designs. Create personalized magnets to use on cars, refrigerators and more.', NULL, 0, 0, 1, '2017-09-29 12:21:20', '2017-10-06 14:09:42'),
(33, 'Circle Magnets', NULL, NULL, 2, 'Circle Magnets', 'circle-magnets', 'Circle Magnets.png', 'Varies sizes of circle magnets with your personal designs. Create personalized magnets to use on cars, refrigerators and more.', 'Magnet Button 1.jpg*Magnet Button 2.jpg', 0, 0, 2, '2017-09-29 13:24:48', '2017-10-06 14:15:47');

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
(20, 400),
(21, 1),
(22, 2),
(23, 3),
(24, 4),
(25, 5),
(26, 6),
(27, 7),
(28, 8),
(29, 9);

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
(81, 2, 3, 'Perfect Size, Outstanding Quality! Great service', 'I\'ve placed an order and received stickers after 6 days! Of course size was perfect, printing quality is perfect and service  was outstanding! It only took me 3-4 mins to complete order and next time I can complete order within 2 mins! Great thanks to Printing Amazon!', '5.0', 1, '2017-10-04 08:40:02', '2017-10-04 08:40:11');

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
(15, '60 x 60mm', 60, 60),
(16, '40 x 60 mm', 40, 60),
(17, 'A4 (210 x 297 mm)', 210, 297),
(18, '50 x 70 mm', 50, 70),
(19, '100 x 55 mm', 100, 55),
(21, '125 x 50 mm', 125, 50),
(22, '125 x 75 mm', 125, 75),
(23, '40 x 30 mm', 40, 30),
(24, '32mm', 32, 32),
(25, '44mm', 44, 44),
(26, '58mm', 58, 58),
(27, '75mm', 75, 75),
(28, '37mm', 37, 37),
(29, '50mm', 50, 50),
(30, '57 x 52mm', 57, 52),
(31, '25mm', 25, 25),
(32, '38 x 55mm', 38, 55),
(33, '40 x 60mm', 40, 60),
(34, '45 x 65mm', 45, 65),
(35, '50 x 70mm', 50, 70),
(36, '55 x 80mm', 55, 80),
(37, '65 x 90mm', 65, 90),
(38, '80 x 90mm', 80, 90),
(39, '45mm', 45, 45),
(40, '55mm', 55, 55),
(41, '60mm', 60, 60),
(42, '70mm', 70, 70),
(43, '80mm', 80, 80),
(44, '65mm', 65, 65);

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
(4, 'Animal Town Value Pack', 'N-Stickers Animal-Town.jpg', 1),
(5, 'Smile Colour Pack', 'N-Stickers Smile-Colour-Pack.jpg', 2),
(6, 'Fresh Fruits Pack', 'N-Stickers Fresh-Fruits.jpg', 3),
(7, 'Flower Garden', 'N-Stickers Flower-Garden.jpg', 4);

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
(3, 'angellous99', 'angellous99@gmail.com', NULL, '$2y$10$0M3u8GJw6P5jedMqgf6hYe2gLJVExZCSAWdnhTd1ZDkX2D8VamP9i', 'wkFA5aR1jsK3jrsO9bb9biIJUZmTKGw7TtKPCLPRKm9CfiZRCK0ARnM6oZec', '2017-08-22 11:25:02', '2017-08-22 11:25:13'),
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
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_page_slug_unique` (`page_slug`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `lamination_options`
--
ALTER TABLE `lamination_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `map_prod_form`
--
ALTER TABLE `map_prod_form`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `map_prod_form_options`
--
ALTER TABLE `map_prod_form_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=397;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `notificationsetting`
--
ALTER TABLE `notificationsetting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `order_billing`
--
ALTER TABLE `order_billing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `paperstock_options`
--
ALTER TABLE `paperstock_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `preset_general`
--
ALTER TABLE `preset_general`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=624;
--
-- AUTO_INCREMENT for table `preset_qty_rule_one`
--
ALTER TABLE `preset_qty_rule_one`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=365;
--
-- AUTO_INCREMENT for table `preset_qty_rule_two`
--
ALTER TABLE `preset_qty_rule_two`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `qty_options`
--
ALTER TABLE `qty_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `size_options`
--
ALTER TABLE `size_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `sticker_types`
--
ALTER TABLE `sticker_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
