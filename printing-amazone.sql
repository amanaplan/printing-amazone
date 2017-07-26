-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2017 at 03:40 PM
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
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
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
(4, NULL, NULL, NULL, NULL, NULL, 'Postcards', 'postcards', 4, '2017-06-19 13:14:52', '2017-06-19 13:38:36'),
(5, NULL, NULL, NULL, NULL, NULL, 'Labels', 'labels', 5, '2017-06-19 13:15:09', '2017-06-19 13:38:38'),
(6, NULL, NULL, NULL, NULL, NULL, 'Graphic designs', 'graphic-designs', 6, '2017-06-19 13:15:24', '2017-07-19 12:15:19');

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
(1, 1, 6),
(2, 2, 6),
(31, 1, 16),
(33, 3, 16),
(35, 2, 3),
(36, 3, 3),
(37, 2, 16),
(38, 1, 4),
(39, 2, 4),
(40, 3, 4);

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
(5, 37, 1, 0),
(6, 31, 1, 1),
(7, 31, 2, 2),
(8, 36, 1, 0),
(9, 36, 3, 0),
(10, 36, 4, 0),
(11, 33, 2, 1),
(12, 33, 3, 2),
(13, 38, 1, 1),
(14, 38, 5, 4),
(15, 38, 3, 2),
(16, 38, 4, 3),
(17, 39, 3, 1),
(18, 39, 4, 2),
(19, 39, 5, 3),
(20, 39, 6, 4),
(21, 39, 7, 5),
(22, 40, 1, 5),
(23, 40, 2, 1),
(24, 40, 3, 2),
(25, 40, 4, 4),
(26, 40, 5, 3);

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
(37, '2017_07_26_210126_create_preset_qtyrule_two', 16);

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
(1, 'Artboard'),
(5, 'Kraft'),
(3, 'Transparent'),
(4, 'Waterproof'),
(2, 'Wooden Paper');

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
  `is_base` tinyint(4) NOT NULL DEFAULT 0,
  `base_price` double(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `preset_qty_rule_two`
--

CREATE TABLE `preset_qty_rule_two` (
  `id` int(10) UNSIGNED NOT NULL,
  `map_prod_form_option` int(11) NOT NULL,
  `every_extra_qty` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `disc_rate` double(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `sort` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `meta_desc`, `og_img`, `category_id`, `product_name`, `product_slug`, `logo`, `description`, `sample_image`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'asasasa', 'asasasas', 'li-active.jpg', 1, 'Free Shipping Sticker', 'free-shipping-sticker', 'cs-1.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices urna vitae mauris dictum dignissim. Pellentesque porta, lectus id pulvinar hendrerit, felis ligula varius lectus, eu auctor arcu lectus eleifend ipsum. Duis in magna nec tortor tincidunt feugiat eu ut eros. Morbi consectetur felis nec', 'li-active.jpg', 1, '2017-05-30 14:16:18', '2017-06-01 16:01:38'),
(2, 'ioi9iojo', 'some meta', 'cs-1.png', 1, 'Square Sticker', 'square-sticker', 'cs-4.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices urna vitae mauris dictum dignissim. Pellentesque porta, lectus id pulvinar hendrerit, felis ligula varius lectus, eu auctor arcu lectus eleifend ipsum. Duis in magna nec tortor tincidunt feugiat eu ut eros. Morbi consectetur felis nec', 'shape-img.jpg', 2, '2017-05-30 14:35:51', '2017-06-01 16:01:41'),
(3, NULL, NULL, NULL, 2, 'Rectangle Business Card', 'rectangle-business-card', 'cs-3.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices urna vitae mauris dictum dignissim. Pellentesque porta, lectus id pulvinar hendrerit, felis ligula varius lectus, eu auctor arcu lectus eleifend ipsum. Duis in magna nec tortor tincidunt feugiat eu ut eros. Morbi consectetur felis nec', 'shape-img.jpg', 1, '2017-06-19 15:21:40', '2017-06-19 15:21:40'),
(4, NULL, NULL, NULL, 2, 'Free Shaping Card', 'free-shaping-card', 'f2.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices urna vitae mauris dictum dignissim. Pellentesque porta, lectus id pulvinar hendrerit, felis ligula varius lectus, eu auctor arcu lectus eleifend ipsum. Duis in magna nec tortor tincidunt feugiat eu ut eros. Morbi consectetur felis nec', 'shape-img.jpg', 2, '2017-06-19 15:22:41', '2017-06-19 15:22:41'),
(5, NULL, NULL, NULL, 2, 'Some Demo card', 'some-demo-card', 'f3.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices urna vitae mauris dictum dignissim. Pellentesque porta, lectus id pulvinar hendrerit, felis ligula varius lectus, eu auctor arcu lectus eleifend ipsum. Duis in magna nec tortor tincidunt feugiat eu ut eros. Morbi consectetur felis nec', NULL, 3, '2017-06-19 15:23:31', '2017-06-19 15:23:31'),
(6, NULL, NULL, NULL, 2, 'Bumper Card', 'bumper-card', 'cs-1.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices urna vitae mauris dictum dignissim. Pellentesque porta, lectus id pulvinar hendrerit, felis ligula varius lectus, eu auctor arcu lectus eleifend ipsum. Duis in magna nec tortor tincidunt feugiat eu ut eros. Morbi consectetur felis nec', 'hacker-internet-technology-computers-159195.jpeg*gshock-watch-sports-watch-stopwatch-158741.jpeg*pexels-photo-174673.jpeg', 4, '2017-06-19 15:24:45', '2017-06-23 16:48:29'),
(16, 'whatever', 'whatever', NULL, 5, 'Somethinf testx', 'somethinf-testx', 'f2.png', 'whatever whatever whatever whatever whatever whatever whatever', 'cs-1.png', 1, '2017-06-22 15:54:12', '2017-06-22 15:54:12');

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
(9, 5, 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing edited', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod edited', '3.0', 0, '2017-07-17 16:44:42', '2017-07-21 22:09:18'),
(66, 6, 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing', 'Lorem ipsum dolor sit amet, consectetur adipisicing	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodLorem ipsum dolor sit amet, consectetur', '4.0', 0, '2017-07-20 21:37:12', '2017-07-21 22:19:47'),
(68, 5, 2, 'Lorem Ipsum is simply dummy text of the printing andLorem', 'Lorem Ipsum is simply dummy text of the printing andLorem Ipsum is simply dummy text of the printing andLorem Ipsum is simply dummy text of the printing andLorem Ipsum is simply dummy text of the printing andLorem Ipsum is simply dummy text of the printing and', '3.5', 0, '2017-07-21 23:13:44', '2017-07-21 23:16:19'),
(70, 2, 2, 'number_format — Format a number with grouped thousandsnumber', 'number_format — Format a number with grouped thousandsnumber_format — Format a number with grouped thousandsnumber_format — Format a number with grouped thousandsnumber_format — Format a number with grouped thousands', '3.5', 1, '2017-07-22 17:31:35', '2017-07-22 17:31:49'),
(73, 4, 2, 'Reference site about Lorem Ipsum, giving information', 'Reference site about Lorem Ipsum, giving informationReference site about Lorem Ipsum, giving informationReference site about Lorem Ipsum, giving informationReference site about Lorem Ipsum, giving information', '5.0', 1, '2017-07-22 21:49:17', '2017-07-22 21:50:26'),
(74, 4, 1, 'There are many variations of passages of Lorem Ipsum availab', 'but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet', '4.0', 1, '2017-07-22 21:52:53', '2017-07-22 21:53:08');

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
(2, 'Large A1 Paper (175 x 100)', 175, 100),
(3, '50 x 50 cm', 50, 50),
(4, '70 x 70 cm', 70, 70),
(5, '90 x 90 cm', 90, 90),
(6, '120 x 120 cm', 120, 120),
(7, '150 x 150 cm', 150, 150);

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
(2, 'Sourav Rakshit', 'srv.nxr@gmail.com', 'depositphotos_56695985-stock-illustration-male-avatar.jpg', '$2y$10$vTSYi53gm8fBEqEvZbD0l..Gm3Nioiv8A693txll7/3eR7qVy4hWq', 'EDu4vmu6ohdA0RyjUrbugmt5DZs6xAQnPH7Dj1utcNj7fK79WH3cXt7zWJmE', '2017-05-18 16:08:04', '2017-07-22 18:16:07');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `email_authentication`
--
ALTER TABLE `email_authentication`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `map_prod_form_options`
--
ALTER TABLE `map_prod_form_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `paperstock_options`
--
ALTER TABLE `paperstock_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `preset_general`
--
ALTER TABLE `preset_general`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `preset_qty_rule_one`
--
ALTER TABLE `preset_qty_rule_one`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `preset_qty_rule_two`
--
ALTER TABLE `preset_qty_rule_two`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `qty_options`
--
ALTER TABLE `qty_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `size_options`
--
ALTER TABLE `size_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
