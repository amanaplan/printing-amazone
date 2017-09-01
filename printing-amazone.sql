-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2017 at 04:51 PM
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
(1, 'c397da159a5a6f08cd71e36986795a6ed298d1ef', 0, 20, 3, 90.00, 90.00, 500, '4763.00', NULL, NULL, NULL, 'artworks/iMikZ3psK2FX2NcD9GccbGoowb74e3ALJy4LDi95.jpeg', NULL, 69, '2017-08-22 17:35:33', '2017-08-22 17:35:33');

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
(1, 'Sticker - Printing Amazon', 'Sticker - Printing Amazon', 'sticker page meta desc', 'sticker page meta desc', 'banner-bg.jpg', 'Sticker', 'sticker', 1, 1, '2017-05-26 15:10:37', '2017-08-19 15:08:22'),
(2, 'Business Card - Printing Amazon', 'Business Card - Printing Amazon', NULL, NULL, NULL, 'Business Card', 'business-card', 2, 1, '2017-06-19 13:00:47', '2017-08-19 15:08:36'),
(3, 'Brochures/Flyers - Printing Amazon', 'Brochures/Flyers - Printing Amazon', NULL, NULL, NULL, 'Brochures/Flyers', 'brochuresflyers', 3, 1, '2017-06-19 13:14:34', '2017-08-19 15:08:51'),
(4, 'Postcards - Printing Amazon', 'Postcards - Printing Amazon', NULL, NULL, NULL, 'Postcards', 'postcards', 4, 1, '2017-06-19 13:14:52', '2017-08-19 15:09:02'),
(5, NULL, NULL, NULL, NULL, NULL, 'Uncategorized', 'uncategorized', 0, 0, '2017-08-19 13:05:36', '2017-08-19 13:05:36');

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
(1, 'AA', 'AW', '.aw', 'Aruba'),
(2, 'AC', 'AG', '.ag', 'Antigua and Barbuda'),
(3, 'AE', 'AE', '.ae', 'United Arab Emirates'),
(4, 'AF', 'AF', '.af', 'Afghanistan'),
(5, 'AG', 'DZ', '.dz', 'Algeria'),
(6, 'AJ', 'AZ', '.az', 'Azerbaijan'),
(7, 'AL', 'AL', '.al', 'Albania'),
(8, 'AM', 'AM', '.am', 'Armenia'),
(9, 'AN', 'AD', '.ad', 'Andorra'),
(10, 'AO', 'AO', '.ao', 'Angola'),
(11, 'AQ', 'AS', '.as', 'American Samoa'),
(12, 'AR', 'AR', '.ar', 'Argentina'),
(13, 'AS', 'AU', '.au', 'Australia'),
(14, 'AT', '-', '-', 'Ashmore and Cartier Islands'),
(15, 'AU', 'AT', '.at', 'Austria'),
(16, 'AV', 'AI', '.ai', 'Anguilla'),
(17, 'AX', 'AX', '.ax', 'Åland Islands'),
(18, 'AY', 'AQ', '.aq', 'Antarctica'),
(19, 'BA', 'BH', '.bh', 'Bahrain'),
(20, 'BB', 'BB', '.bb', 'Barbados'),
(21, 'BC', 'BW', '.bw', 'Botswana'),
(22, 'BD', 'BM', '.bm', 'Bermuda'),
(23, 'BE', 'BE', '.be', 'Belgium'),
(24, 'BF', 'BS', '.bs', 'Bahamas, The'),
(25, 'BG', 'BD', '.bd', 'Bangladesh'),
(26, 'BH', 'BZ', '.bz', 'Belize'),
(27, 'BK', 'BA', '.ba', 'Bosnia and Herzegovina'),
(28, 'BL', 'BO', '.bo', 'Bolivia'),
(29, 'BM', 'MM', '.mm', 'Myanmar'),
(30, 'BN', 'BJ', '.bj', 'Benin'),
(31, 'BO', 'BY', '.by', 'Belarus'),
(32, 'BP', 'SB', '.sb', 'Solomon Islands'),
(33, 'BQ', '-', '-', 'Navassa Island'),
(34, 'BR', 'BR', '.br', 'Brazil'),
(35, 'BS', '-', '-', 'Bassas da India'),
(36, 'BT', 'BT', '.bt', 'Bhutan'),
(37, 'BU', 'BG', '.bg', 'Bulgaria'),
(38, 'BV', 'BV', '.bv', 'Bouvet Island'),
(39, 'BX', 'BN', '.bn', 'Brunei'),
(40, 'BY', 'BI', '.bi', 'Burundi'),
(41, 'CA', 'CA', '.ca', 'Canada'),
(42, 'CB', 'KH', '.kh', 'Cambodia'),
(43, 'CD', 'TD', '.td', 'Chad'),
(44, 'CE', 'LK', '.lk', 'Sri Lanka'),
(45, 'CF', 'CG', '.cg', 'Congo, Republic of the'),
(46, 'CG', 'CD', '.cd', 'Congo, Democratic Republic of the'),
(47, 'CH', 'CN', '.cn', 'China'),
(48, 'CI', 'CL', '.cl', 'Chile'),
(49, 'CJ', 'KY', '.ky', 'Cayman Islands'),
(50, 'CK', 'CC', '.cc', 'Cocos (Keeling) Islands'),
(51, 'CM', 'CM', '.cm', 'Cameroon'),
(52, 'CN', 'KM', '.km', 'Comoros'),
(53, 'CO', 'CO', '.co', 'Colombia'),
(54, 'CQ', 'MP', '.mp', 'Northern Mariana Islands'),
(55, 'CR', '-', '-', 'Coral Sea Islands'),
(56, 'CS', 'CR', '.cr', 'Costa Rica'),
(57, 'CT', 'CF', '.cf', 'Central African Republic'),
(58, 'CU', 'CU', '.cu', 'Cuba'),
(59, 'CV', 'CV', '.cv', 'Cape Verde'),
(60, 'CW', 'CK', '.ck', 'Cook Islands'),
(61, 'CY', 'CY', '.cy', 'Cyprus'),
(62, 'DA', 'DK', '.dk', 'Denmark'),
(63, 'DJ', 'DJ', '.dj', 'Djibouti'),
(64, 'DO', 'DM', '.dm', 'Dominica'),
(65, 'DQ', 'UM', '-', 'Jarvis Island'),
(66, 'DR', 'DO', '.do', 'Dominican Republic'),
(67, 'DX', '-', '-', 'Dhekelia Sovereign Base Area'),
(68, 'EC', 'EC', '.ec', 'Ecuador'),
(69, 'EG', 'EG', '.eg', 'Egypt'),
(70, 'EI', 'IE', '.ie', 'Ireland'),
(71, 'EK', 'GQ', '.gq', 'Equatorial Guinea'),
(72, 'EN', 'EE', '.ee', 'Estonia'),
(73, 'ER', 'ER', '.er', 'Eritrea'),
(74, 'ES', 'SV', '.sv', 'El Salvador'),
(75, 'ET', 'ET', '.et', 'Ethiopia'),
(76, 'EU', '-', '-', 'Europa Island'),
(77, 'EZ', 'CZ', '.cz', 'Czech Republic'),
(78, 'FG', 'GF', '.gf', 'French Guiana'),
(79, 'FI', 'FI', '.fi', 'Finland'),
(80, 'FJ', 'FJ', '.fj', 'Fiji'),
(81, 'FK', 'FK', '.fk', 'Falkland Islands (Islas Malvinas)'),
(82, 'FM', 'FM', '.fm', 'Micronesia, Federated States of'),
(83, 'FO', 'FO', '.fo', 'Faroe Islands'),
(84, 'FP', 'PF', '.pf', 'French Polynesia'),
(85, 'FQ', 'UM', '-', 'Baker Island'),
(86, 'FR', 'FR', '.fr', 'France'),
(87, 'FS', 'TF', '.tf', 'French Southern and Antarctic Lands'),
(88, 'GA', 'GM', '.gm', 'Gambia, The'),
(89, 'GB', 'GA', '.ga', 'Gabon'),
(90, 'GG', 'GE', '.ge', 'Georgia'),
(91, 'GH', 'GH', '.gh', 'Ghana'),
(92, 'GI', 'GI', '.gi', 'Gibraltar'),
(93, 'GJ', 'GD', '.gd', 'Grenada'),
(94, 'GK', '-', '.gg', 'Guernsey'),
(95, 'GL', 'GL', '.gl', 'Greenland'),
(96, 'GM', 'DE', '.de', 'Germany'),
(97, 'GO', '-', '-', 'Glorioso Islands'),
(98, 'GP', 'GP', '.gp', 'Guadeloupe'),
(99, 'GQ', 'GU', '.gu', 'Guam'),
(100, 'GR', 'GR', '.gr', 'Greece'),
(101, 'GT', 'GT', '.gt', 'Guatemala'),
(102, 'GV', 'GN', '.gn', 'Guinea'),
(103, 'GY', 'GY', '.gy', 'Guyana'),
(104, 'GZ', '-', '-', 'Gaza Strip'),
(105, 'HA', 'HT', '.ht', 'Haiti'),
(106, 'HK', 'HK', '.hk', 'Hong Kong'),
(107, 'HM', 'HM', '.hm', 'Heard Island and McDonald Islands'),
(108, 'HO', 'HN', '.hn', 'Honduras'),
(109, 'HQ', 'UM', '-', 'Howland Island'),
(110, 'HR', 'HR', '.hr', 'Croatia'),
(111, 'HU', 'HU', '.hu', 'Hungary'),
(112, 'IC', 'IS', '.is', 'Iceland'),
(113, 'ID', 'ID', '.id', 'Indonesia'),
(114, 'IM', 'IM', '.im', 'Isle of Man'),
(115, 'IN', 'IN', '.in', 'India'),
(116, 'IO', 'IO', '.io', 'British Indian Ocean Territory'),
(117, 'IP', '-', '-', 'Clipperton Island'),
(118, 'IR', 'IR', '.ir', 'Iran'),
(119, 'IS', 'IL', '.il', 'Israel'),
(120, 'IT', 'IT', '.it', 'Italy'),
(121, 'IV', 'CI', '.ci', 'Cote d\'Ivoire'),
(122, 'IZ', 'IQ', '.iq', 'Iraq'),
(123, 'JA', 'JP', '.jp', 'Japan'),
(124, 'JE', 'JE', '.je', 'Jersey'),
(125, 'JM', 'JM', '.jm', 'Jamaica'),
(126, 'JN', 'SJ', '-', 'Jan Mayen'),
(127, 'JO', 'JO', '.jo', 'Jordan'),
(128, 'JQ', 'UM', '-', 'Johnston Atoll'),
(129, 'JU', '-', '-', 'Juan de Nova Island'),
(130, 'KE', 'KE', '.ke', 'Kenya'),
(131, 'KG', 'KG', '.kg', 'Kyrgyzstan'),
(132, 'KN', 'KP', '.kp', 'Korea, North'),
(133, 'KQ', 'UM', '-', 'Kingman Reef'),
(134, 'KR', 'KI', '.ki', 'Kiribati'),
(135, 'KS', 'KR', '.kr', 'Korea, South'),
(136, 'KT', 'CX', '.cx', 'Christmas Island'),
(137, 'KU', 'KW', '.kw', 'Kuwait'),
(138, 'KV', 'KV', '-', 'Kosovo'),
(139, 'KZ', 'KZ', '.kz', 'Kazakhstan'),
(140, 'LA', 'LA', '.la', 'Laos'),
(141, 'LE', 'LB', '.lb', 'Lebanon'),
(142, 'LG', 'LV', '.lv', 'Latvia'),
(143, 'LH', 'LT', '.lt', 'Lithuania'),
(144, 'LI', 'LR', '.lr', 'Liberia'),
(145, 'LO', 'SK', '.sk', 'Slovakia'),
(146, 'LQ', 'UM', '-', 'Palmyra Atoll'),
(147, 'LS', 'LI', '.li', 'Liechtenstein'),
(148, 'LT', 'LS', '.ls', 'Lesotho'),
(149, 'LU', 'LU', '.lu', 'Luxembourg'),
(150, 'LY', 'LY', '.ly', 'Libyan Arab'),
(151, 'MA', 'MG', '.mg', 'Madagascar'),
(152, 'MB', 'MQ', '.mq', 'Martinique'),
(153, 'MC', 'MO', '.mo', 'Macau'),
(154, 'MD', 'MD', '.md', 'Moldova, Republic of'),
(155, 'MF', 'YT', '.yt', 'Mayotte'),
(156, 'MG', 'MN', '.mn', 'Mongolia'),
(157, 'MH', 'MS', '.ms', 'Montserrat'),
(158, 'MI', 'MW', '.mw', 'Malawi'),
(159, 'MJ', 'ME', '.me', 'Montenegro'),
(160, 'MK', 'MK', '.mk', 'The Former Yugoslav Republic of Macedonia'),
(161, 'ML', 'ML', '.ml', 'Mali'),
(162, 'MN', 'MC', '.mc', 'Monaco'),
(163, 'MO', 'MA', '.ma', 'Morocco'),
(164, 'MP', 'MU', '.mu', 'Mauritius'),
(165, 'MQ', 'UM', '-', 'Midway Islands'),
(166, 'MR', 'MR', '.mr', 'Mauritania'),
(167, 'MT', 'MT', '.mt', 'Malta'),
(168, 'MU', 'OM', '.om', 'Oman'),
(169, 'MV', 'MV', '.mv', 'Maldives'),
(170, 'MX', 'MX', '.mx', 'Mexico'),
(171, 'MY', 'MY', '.my', 'Malaysia'),
(172, 'MZ', 'MZ', '.mz', 'Mozambique'),
(173, 'NC', 'NC', '.nc', 'New Caledonia'),
(174, 'NE', 'NU', '.nu', 'Niue'),
(175, 'NF', 'NF', '.nf', 'Norfolk Island'),
(176, 'NG', 'NE', '.ne', 'Niger'),
(177, 'NH', 'VU', '.vu', 'Vanuatu'),
(178, 'NI', 'NG', '.ng', 'Nigeria'),
(179, 'NL', 'NL', '.nl', 'Netherlands'),
(180, 'NM', '', '', 'No Man\'s Land'),
(181, 'NO', 'NO', '.no', 'Norway'),
(182, 'NP', 'NP', '.np', 'Nepal'),
(183, 'NR', 'NR', '.nr', 'Nauru'),
(184, 'NS', 'SR', '.sr', 'Suriname'),
(185, 'NT', 'AN', '.an', 'Netherlands Antilles'),
(186, 'NU', 'NI', '.ni', 'Nicaragua'),
(187, 'NZ', 'NZ', '.nz', 'New Zealand'),
(188, 'PA', 'PY', '.py', 'Paraguay'),
(189, 'PC', 'PN', '.pn', 'Pitcairn Islands'),
(190, 'PE', 'PE', '.pe', 'Peru'),
(191, 'PF', '-', '-', 'Paracel Islands'),
(192, 'PG', '-', '-', 'Spratly Islands'),
(193, 'PK', 'PK', '.pk', 'Pakistan'),
(194, 'PL', 'PL', '.pl', 'Poland'),
(195, 'PM', 'PA', '.pa', 'Panama'),
(196, 'PO', 'PT', '.pt', 'Portugal'),
(197, 'PP', 'PG', '.pg', 'Papua New Guinea'),
(198, 'PS', 'PW', '.pw', 'Palau'),
(199, 'PU', 'GW', '.gw', 'Guinea-Bissau'),
(200, 'QA', 'QA', '.qa', 'Qatar'),
(201, 'RE', 'RE', '.re', 'Reunion'),
(202, 'RI', 'RS', '.rs', 'Serbia'),
(203, 'RM', 'MH', '.mh', 'Marshall Islands'),
(204, 'RN', 'MF', '-', 'Saint Martin'),
(205, 'RO', 'RO', '.ro', 'Romania'),
(206, 'RP', 'PH', '.ph', 'Philippines'),
(207, 'RQ', 'PR', '.pr', 'Puerto Rico'),
(208, 'RS', 'RU', '.ru', 'Russia'),
(209, 'RW', 'RW', '.rw', 'Rwanda'),
(210, 'SA', 'SA', '.sa', 'Saudi Arabia'),
(211, 'SB', 'PM', '.pm', 'Saint Pierre and Miquelon'),
(212, 'SC', 'KN', '.kn', 'Saint Kitts and Nevis'),
(213, 'SE', 'SC', '.sc', 'Seychelles'),
(214, 'SF', 'ZA', '.za', 'South Africa'),
(215, 'SG', 'SN', '.sn', 'Senegal'),
(216, 'SH', 'SH', '.sh', 'Saint Helena'),
(217, 'SI', 'SI', '.si', 'Slovenia'),
(218, 'SL', 'SL', '.sl', 'Sierra Leone'),
(219, 'SM', 'SM', '.sm', 'San Marino'),
(220, 'SN', 'SG', '.sg', 'Singapore'),
(221, 'SO', 'SO', '.so', 'Somalia'),
(222, 'SP', 'ES', '.es', 'Spain'),
(223, 'ST', 'LC', '.lc', 'Saint Lucia'),
(224, 'SU', 'SD', '.sd', 'Sudan'),
(225, 'SV', 'SJ', '.sj', 'Svalbard'),
(226, 'SW', 'SE', '.se', 'Sweden'),
(227, 'SX', 'GS', '.gs', 'South Georgia and the Islands'),
(228, 'SY', 'SY', '.sy', 'Syrian Arab Republic'),
(229, 'SZ', 'CH', '.ch', 'Switzerland'),
(230, 'TD', 'TT', '.tt', 'Trinidad and Tobago'),
(231, 'TE', '-', '-', 'Tromelin Island'),
(232, 'TH', 'TH', '.th', 'Thailand'),
(233, 'TI', 'TJ', '.tj', 'Tajikistan'),
(234, 'TK', 'TC', '.tc', 'Turks and Caicos Islands'),
(235, 'TL', 'TK', '.tk', 'Tokelau'),
(236, 'TN', 'TO', '.to', 'Tonga'),
(237, 'TO', 'TG', '.tg', 'Togo'),
(238, 'TP', 'ST', '.st', 'Sao Tome and Principe'),
(239, 'TS', 'TN', '.tn', 'Tunisia'),
(240, 'TT', 'TL', '.tl', 'East Timor'),
(241, 'TU', 'TR', '.tr', 'Turkey'),
(242, 'TV', 'TV', '.tv', 'Tuvalu'),
(243, 'TW', 'TW', '.tw', 'Taiwan'),
(244, 'TX', 'TM', '.tm', 'Turkmenistan'),
(245, 'TZ', 'TZ', '.tz', 'Tanzania, United Republic of'),
(246, 'UG', 'UG', '.ug', 'Uganda'),
(247, 'UK', 'GB', '.uk', 'United Kingdom'),
(248, 'UP', 'UA', '.ua', 'Ukraine'),
(249, 'US', 'US', '.us', 'United States'),
(250, 'UV', 'BF', '.bf', 'Burkina Faso'),
(251, 'UY', 'UY', '.uy', 'Uruguay'),
(252, 'UZ', 'UZ', '.uz', 'Uzbekistan'),
(253, 'VC', 'VC', '.vc', 'Saint Vincent and the Grenadines'),
(254, 'VE', 'VE', '.ve', 'Venezuela'),
(255, 'VI', 'VG', '.vg', 'British Virgin Islands'),
(256, 'VM', 'VN', '.vn', 'Vietnam'),
(257, 'VQ', 'VI', '.vi', 'Virgin Islands (US)'),
(258, 'VT', 'VA', '.va', 'Holy See (Vatican City)'),
(259, 'WA', 'NA', '.na', 'Namibia'),
(260, 'WE', '-', '-', 'West Bank'),
(261, 'WF', 'WF', '.wf', 'Wallis and Futuna'),
(262, 'WI', 'EH', '.eh', 'Western Sahara'),
(263, 'WQ', 'UM', '-', 'Wake Island'),
(264, 'WS', 'WS', '.ws', 'Samoa'),
(265, 'WZ', 'SZ', '.sz', 'Swaziland'),
(266, 'YI', 'CS', '.yu', 'Serbia and Montenegro'),
(267, 'YM', 'YE', '.ye', 'Yemen'),
(268, 'ZA', 'ZM', '.zm', 'Zambia'),
(269, 'ZI', 'ZW', '.zw', 'Zimbabwe');

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

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(16, 'order', '{\"displayName\":\"App\\\\Mail\\\\OrderCustomer\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":20,\"timeout\":120,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":3:{s:8:\\\"mailable\\\";O:22:\\\"App\\\\Mail\\\\OrderCustomer\\\":20:{s:5:\\\"tries\\\";i:20;s:7:\\\"timeout\\\";i:120;s:12:\\\"common_conts\\\";O:29:\\\"Illuminate\\\\Support\\\\Collection\\\":1:{s:8:\\\"\\u0000*\\u0000items\\\";a:4:{s:4:\\\"logo\\\";s:67:\\\"http:\\/\\/localhost\\/srv\\/printing-amazone\\/public\\/assets\\/images\\/logo.png\\\";s:7:\\\"website\\\";s:44:\\\"http:\\/\\/localhost\\/srv\\/printing-amazone\\/public\\\";s:12:\\\"delivery_img\\\";s:81:\\\"http:\\/\\/localhost\\/srv\\/printing-amazone\\/public\\/assets\\/images\\/email-img\\/delivery.png\\\";s:13:\\\"prod_logo_dir\\\";s:67:\\\"http:\\/\\/localhost\\/srv\\/printing-amazone\\/public\\/assets\\/images\\/products\\\";}}s:10:\\\"order_info\\\";O:29:\\\"Illuminate\\\\Support\\\\Collection\\\":1:{s:8:\\\"\\u0000*\\u0000items\\\";a:11:{s:8:\\\"order_id\\\";s:12:\\\"PA2017090201\\\";s:14:\\\"transaction_id\\\";s:8:\\\"fzk0wgcn\\\";s:7:\\\"country\\\";s:2:\\\"IN\\\";s:5:\\\"state\\\";s:4:\\\"\\\"WB\\\"\\\";s:4:\\\"city\\\";s:9:\\\"\\\"Kolkata\\\"\\\";s:7:\\\"zipcode\\\";s:8:\\\"\\\"712222\\\"\\\";s:6:\\\"street\\\";s:14:\\\"\\\"lorem street\\\"\\\";s:8:\\\"subtotal\\\";i:687;s:8:\\\"discount\\\";i:21;s:7:\\\"payable\\\";i:666;s:5:\\\"items\\\";s:811:\\\"[{\\\"id\\\":41,\\\"cart_token\\\":\\\"1f6deddb4250320528db5d45eaa24672c82c5282\\\",\\\"user_id\\\":2,\\\"product_id\\\":4,\\\"paperstock\\\":5,\\\"width\\\":12,\\\"height\\\":12,\\\"qty\\\":200,\\\"price\\\":\\\"111.00\\\",\\\"sticker_type\\\":null,\\\"laminating\\\":null,\\\"sticker_name\\\":null,\\\"artwork\\\":\\\"artworks\\\\\\/SUWLZ0DSz8kK9jPhaRn4zUTNO92Hy8na3AUSiQdm.jpeg\\\",\\\"instructions\\\":null,\\\"preset_mapper\\\":14,\\\"created_at\\\":\\\"2017-09-02 00:47:55\\\",\\\"updated_at\\\":\\\"2017-09-02 00:47:55\\\"},{\\\"id\\\":42,\\\"cart_token\\\":\\\"1f6deddb4250320528db5d45eaa24672c82c5282\\\",\\\"user_id\\\":2,\\\"product_id\\\":22,\\\"paperstock\\\":7,\\\"width\\\":70,\\\"height\\\":70,\\\"qty\\\":100,\\\"price\\\":\\\"576.00\\\",\\\"sticker_type\\\":\\\"Ben 10 Ulimate Alien\\\",\\\"laminating\\\":\\\"5\\\",\\\"sticker_name\\\":\\\"Sourav R\\\",\\\"artwork\\\":\\\"artworks\\\\\\/N07zLNAHqYUJhrvz9W5R4I246rP2NOrWIhjOjYL2.jpeg\\\",\\\"instructions\\\":null,\\\"preset_mapper\\\":94,\\\"created_at\\\":\\\"2017-09-02 00:48:23\\\",\\\"updated_at\\\":\\\"2017-09-02 00:48:23\\\"}]\\\";}}s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:17:\\\"srv.nxr@gmail.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:11:\\\"\\u0000*\\u0000markdown\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:5:\\\"order\\\";s:5:\\\"delay\\\";N;}s:5:\\\"tries\\\";i:20;s:7:\\\"timeout\\\";i:120;}\"}}', 0, NULL, 1504277348, 1504277348),
(17, 'order', '{\"displayName\":\"App\\\\Mail\\\\OrderAdmin\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":20,\"timeout\":120,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":3:{s:8:\\\"mailable\\\";O:19:\\\"App\\\\Mail\\\\OrderAdmin\\\":21:{s:5:\\\"tries\\\";i:20;s:7:\\\"timeout\\\";i:120;s:12:\\\"common_conts\\\";O:29:\\\"Illuminate\\\\Support\\\\Collection\\\":1:{s:8:\\\"\\u0000*\\u0000items\\\";a:4:{s:4:\\\"logo\\\";s:67:\\\"http:\\/\\/localhost\\/srv\\/printing-amazone\\/public\\/assets\\/images\\/logo.png\\\";s:7:\\\"website\\\";s:44:\\\"http:\\/\\/localhost\\/srv\\/printing-amazone\\/public\\\";s:12:\\\"delivery_img\\\";s:81:\\\"http:\\/\\/localhost\\/srv\\/printing-amazone\\/public\\/assets\\/images\\/email-img\\/delivery.png\\\";s:13:\\\"prod_logo_dir\\\";s:67:\\\"http:\\/\\/localhost\\/srv\\/printing-amazone\\/public\\/assets\\/images\\/products\\\";}}s:10:\\\"order_info\\\";O:29:\\\"Illuminate\\\\Support\\\\Collection\\\":1:{s:8:\\\"\\u0000*\\u0000items\\\";a:11:{s:8:\\\"order_id\\\";s:12:\\\"PA2017090201\\\";s:14:\\\"transaction_id\\\";s:8:\\\"fzk0wgcn\\\";s:7:\\\"country\\\";s:2:\\\"IN\\\";s:5:\\\"state\\\";s:4:\\\"\\\"WB\\\"\\\";s:4:\\\"city\\\";s:9:\\\"\\\"Kolkata\\\"\\\";s:7:\\\"zipcode\\\";s:8:\\\"\\\"712222\\\"\\\";s:6:\\\"street\\\";s:14:\\\"\\\"lorem street\\\"\\\";s:8:\\\"subtotal\\\";i:687;s:8:\\\"discount\\\";i:21;s:7:\\\"payable\\\";i:666;s:5:\\\"items\\\";s:811:\\\"[{\\\"id\\\":41,\\\"cart_token\\\":\\\"1f6deddb4250320528db5d45eaa24672c82c5282\\\",\\\"user_id\\\":2,\\\"product_id\\\":4,\\\"paperstock\\\":5,\\\"width\\\":12,\\\"height\\\":12,\\\"qty\\\":200,\\\"price\\\":\\\"111.00\\\",\\\"sticker_type\\\":null,\\\"laminating\\\":null,\\\"sticker_name\\\":null,\\\"artwork\\\":\\\"artworks\\\\\\/SUWLZ0DSz8kK9jPhaRn4zUTNO92Hy8na3AUSiQdm.jpeg\\\",\\\"instructions\\\":null,\\\"preset_mapper\\\":14,\\\"created_at\\\":\\\"2017-09-02 00:47:55\\\",\\\"updated_at\\\":\\\"2017-09-02 00:47:55\\\"},{\\\"id\\\":42,\\\"cart_token\\\":\\\"1f6deddb4250320528db5d45eaa24672c82c5282\\\",\\\"user_id\\\":2,\\\"product_id\\\":22,\\\"paperstock\\\":7,\\\"width\\\":70,\\\"height\\\":70,\\\"qty\\\":100,\\\"price\\\":\\\"576.00\\\",\\\"sticker_type\\\":\\\"Ben 10 Ulimate Alien\\\",\\\"laminating\\\":\\\"5\\\",\\\"sticker_name\\\":\\\"Sourav R\\\",\\\"artwork\\\":\\\"artworks\\\\\\/N07zLNAHqYUJhrvz9W5R4I246rP2NOrWIhjOjYL2.jpeg\\\",\\\"instructions\\\":null,\\\"preset_mapper\\\":94,\\\"created_at\\\":\\\"2017-09-02 00:48:23\\\",\\\"updated_at\\\":\\\"2017-09-02 00:48:23\\\"}]\\\";}}s:13:\\\"personal_info\\\";O:29:\\\"Illuminate\\\\Support\\\\Collection\\\":1:{s:8:\\\"\\u0000*\\u0000items\\\";a:4:{s:4:\\\"name\\\";s:16:\\\"\\\"Sourav Rakshit\\\"\\\";s:5:\\\"email\\\";s:19:\\\"\\\"srv.nxr@gmail.com\\\"\\\";s:5:\\\"phone\\\";s:12:\\\"\\\"2547896547\\\"\\\";s:7:\\\"company\\\";s:4:\\\"null\\\";}}s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:2:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:24:\\\"developer.srv1@gmail.com\\\";}i:1;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:17:\\\"srv.nxr@gmail.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:11:\\\"\\u0000*\\u0000markdown\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:5:\\\"order\\\";s:5:\\\"delay\\\";N;}s:5:\\\"tries\\\";i:20;s:7:\\\"timeout\\\";i:120;}\"}}', 0, NULL, 1504277348, 1504277348);

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
(3, 'Lamination 1', 1),
(4, 'Lamination 2', 2),
(5, 'lamination 3', 3);

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
  `sort` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `map_prod_form_options`
--

INSERT INTO `map_prod_form_options` (`id`, `mapping_field_id`, `option_id`, `sort`) VALUES
(13, 38, 1, 1),
(14, 38, 5, 4),
(17, 39, 3, 1),
(19, 39, 5, 3),
(20, 39, 6, 4),
(21, 39, 7, 5),
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
(42, 41, 5, 1),
(44, 41, 7, 2),
(45, 41, 4, 3),
(47, 41, 3, 5),
(48, 42, 8, 0),
(49, 42, 9, 0),
(50, 42, 10, 0),
(51, 42, 11, 0),
(52, 43, 1, 7),
(53, 43, 2, 3),
(54, 43, 3, 4),
(55, 43, 4, 6),
(56, 43, 5, 5),
(57, 50, 1, 1),
(58, 50, 5, 2),
(59, 51, 8, 0),
(60, 51, 9, 0),
(61, 51, 10, 0),
(62, 51, 11, 0),
(63, 52, 1, 7),
(64, 52, 2, 3),
(65, 52, 3, 4),
(66, 52, 4, 6),
(67, 52, 5, 5),
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
(93, 59, 5, 2),
(94, 59, 7, 3),
(95, 59, 4, 4),
(96, 61, 1, 7),
(97, 61, 2, 3),
(98, 61, 3, 4),
(99, 61, 4, 6),
(100, 61, 5, 5),
(101, 60, 8, 1),
(102, 60, 9, 2),
(103, 60, 10, 3),
(104, 60, 11, 4),
(107, 54, 9, 2),
(108, 61, 7, 1),
(109, 61, 8, 2),
(110, 58, 7, 1),
(111, 58, 8, 2),
(112, 55, 7, 1),
(113, 55, 8, 2),
(114, 43, 7, 1),
(115, 43, 8, 2),
(116, 52, 7, 1),
(117, 52, 8, 2),
(118, 46, 7, 1),
(119, 46, 8, 2),
(120, 40, 7, 1),
(121, 40, 8, 2);

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
(56, '2017_08_31_184512_create_settiongs_table', 30);

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
(1, 'order', 'developer.srv1@gmail.com, srv.nxr@gmail.com'),
(2, 'contact', 'srv.nxr@gmail.com'),
(3, 'review', 'developer.srv1@gmail.com, srv.nxr@gmail.com');

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
(3, 'PA2017083003', '8rpwsqqm', NULL, '0.00', '236.00', 1, '2017-08-30 15:29:48', '2017-08-30 15:29:48'),
(4, 'PA2017083101', 'jw1jz7vc', NULL, '261.00', '8442.00', 1, '2017-08-31 10:56:12', '2017-08-31 10:56:12'),
(5, 'PA2017083102', 'f111m0hs', 1, '453.00', '14655.00', 1, '2017-08-31 15:56:28', '2017-08-31 15:56:28'),
(6, 'PA2017083103', 'qd38txnk', 1, '0.00', '8467.00', 1, '2017-08-31 16:17:17', '2017-08-31 16:17:17'),
(7, 'PA2017083104', 'mfes3cbb', 1, '180.00', '5811.00', 1, '2017-08-31 16:51:50', '2017-08-31 16:51:50'),
(8, 'PA2017083105', '7s9bwzjd', 1, '1097.00', '17181.00', 1, '2017-08-31 17:00:53', '2017-08-31 17:00:53'),
(9, 'PA2017083106', '3rnzp51j', 1, '500.00', '7838.00', 1, '2017-08-31 17:04:19', '2017-08-31 17:04:19'),
(10, 'PA2017083107', 'hmfk8s25', NULL, '93.00', '3001.00', 6, '2017-08-31 17:48:45', '2017-09-01 18:03:27'),
(11, 'PA2017083108', 'rrrzh90v', 2, '140.00', '4529.00', 5, '2017-08-31 18:00:05', '2017-09-01 18:03:39');

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
(1, 1, 'Sourav', 'srv.nxr@gmail.com', '813463113', '::1', 'IN', 'WB', 'Kolkata', '712222', 'Baidyabati', 'my company'),
(2, 2, 'Sourav Rakshit', 'srv.nxr@gmail.com', '7278863258', '::1', 'IN', 'Abc', 'iojhio', '7122222', 'anywhere in world', NULL),
(3, 3, 'Sammy Gurho', 'abc@example.com', '96587456', '::1', 'US', 'TX', 'Houston', 'TX1234', 'Texas', 'Printing Comopany'),
(4, 4, 'Brock Lesnar', 'brock@wwe.com', '54896547', '::1', 'IN', 'WB', 'KOL', '712222', 'Mn', NULL),
(5, 5, 'Sourav', 'developer.srv1@gmail.com', '8013463113', '::1', 'IN', 'West Bengal', 'Kolkata', '712222', '59 (25/C/D) Kaibarta Para Lane, Baidyabati, dist.- Hooghly', NULL),
(6, 6, 'Sourav', 'developer.srv1@gmail.com', '8965874466', '::1', 'UK', 'West Bengal', 'Kolkata', '71254789', 'quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non', NULL),
(7, 7, 'Sourav', 'developer.srv1@gmail.com', '5587654841', '::1', 'IN', 'West Bengal', 'Kolkata', '712222', 'cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL),
(8, 8, 'Sourav', 'developer.srv1@gmail.com', '58965478796', '::1', 'IN', 'West Bengal', 'Kolkata', '712222', 'cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL),
(9, 9, 'Sourav', 'developer.srv1@gmail.com', '8785459632', '::1', 'IN', 'West Bengal', 'Kolkata', '712222', 'cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL),
(10, 10, 'Sourav Rakshit', 'reach@devsourav.com', '8013463113', '::1', 'IN', 'West Bengal', 'Kolkata', '712222', '59 (25/C/D) Kaibarta Para Lane, Baidyabati, dist.- Hooghly', NULL),
(11, 11, 'Sourav Rakshit', 'srv.nxr@gmail.com', '5698745896', '::1', 'IN', 'West Bengal', 'KOlkata', '712222', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 'C Company');

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
(3, 2, 22, 'Silver Matt paperboard', '90', '90', '300', '2858.00', 'Ben 10 Ulimate Alien', '3', 'Sourav', 'artworks/IlzYrzwDzivlphZ4W2oqDJMPqIYxETOfnN2b1tTK.jpeg', 'I want it to be in oily paper'),
(4, 3, 4, 'Glossy & Matt paperboard (Artboard)', '15', '15', '500', '236.00', NULL, NULL, NULL, NULL, 'lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem'),
(5, 4, 21, 'Waterproof paperboard', '120', '120', '500', '8467.00', NULL, NULL, NULL, NULL, NULL),
(6, 4, 4, 'Glossy & Matt paperboard (Artboard)', '15', '15', '500', '236.00', NULL, NULL, NULL, 'artworks/Q6f8VWei6BqfC5QobFbgbzSlc2zyqqQcKbVQUeEC.jpeg', NULL),
(7, 5, 22, 'Glossy & Matt paperboard (Artboard)', '50', '50', '4000', '12250.00', 'Animal Town 007', '3', 'Sourav', NULL, NULL),
(8, 5, 2, 'Waterproof paperboard', '90', '90', '300', '2858.00', NULL, NULL, NULL, NULL, NULL),
(9, 6, 19, 'Glossy & Matt paperboard (Artboard)', '120', '120', '500', '8467.00', NULL, NULL, NULL, NULL, NULL),
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
(21, 11, 2, 'Waterproof paperboard', '50', '50', '1000', '2940.00', NULL, NULL, NULL, NULL, NULL);

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
(1, 'Glossy & Matt paperboard (Artboard)'),
(5, 'Kraft Paperboard'),
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
  `is_base` tinyint(4) NOT NULL DEFAULT 0,
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
(29, 31, 0, 320, 0.25, 0.50, 30, 250, 1, 99.00),
(30, 31, 321, 500, 0.24, 0.49, 30, 250, 0, NULL),
(31, 31, 501, 800, 0.24, 0.49, 30, 250, 0, NULL),
(32, 31, 801, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(33, 42, 0, 410, 0.25, 0.50, 30, 250, 1, 93.00),
(34, 42, 411, 600, 0.24, 0.49, 30, 250, 0, NULL),
(35, 42, 601, 800, 0.24, 0.49, 30, 250, 0, NULL),
(36, 42, 801, 1200, 0.24, 0.49, 30, 250, 0, NULL),
(37, 42, 1201, 62500, 0.24, 0.49, 30, 250, 0, NULL),
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
(94, 92, 1351, 62500, 0.25, 0.49, 30, 250, 0, NULL),
(96, 93, 0, 470, 0.25, 0.50, 30, 250, 1, 69.00),
(97, 93, 471, 900, 0.24, 0.49, 30, 250, 0, NULL),
(98, 93, 901, 1350, 0.24, 0.49, 30, 250, 0, NULL),
(99, 93, 1351, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(100, 94, 0, 470, 0.25, 0.50, 30, 250, 1, 63.00),
(101, 94, 471, 900, 0.24, 0.49, 30, 250, 0, NULL),
(102, 94, 901, 1350, 0.24, 0.49, 30, 250, 0, NULL),
(103, 94, 1351, 62500, 0.24, 0.49, 30, 250, 0, NULL),
(104, 95, 0, 470, 0.25, 0.50, 30, 250, 1, 69.00),
(105, 95, 471, 900, 0.24, 0.49, 30, 250, 0, NULL),
(106, 95, 901, 1350, 0.24, 0.49, 30, 250, 0, NULL),
(107, 95, 1351, 62500, 0.24, 0.49, 30, 250, 0, NULL);

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
(4, 13, 100, 57.00),
(5, 13, 200, 70.00),
(6, 13, 300, 83.00),
(7, 13, 400, 89.00),
(8, 13, 500, 95.00),
(9, 14, 100, 57.00),
(10, 14, 200, 70.00),
(11, 14, 300, 83.00),
(12, 14, 400, 89.00),
(13, 14, 500, 95.00),
(15, 92, 10, 6.00),
(16, 92, 50, 20.00),
(17, 92, 100, 57.00),
(18, 42, 100, 57.00),
(19, 42, 200, 70.00),
(20, 42, 300, 83.00),
(21, 42, 400, 89.00),
(22, 42, 500, 95.00);

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
(2, 'Square Stickers - Printing Amazon', 'some meta', 'Square Sticker_3.jpg', 1, 'Square Stickers', 'square-stickers', 'cs-3.png', 'Our custom square stickers are great for logos, product labels, artwork reproductions and more. Our proof approval process lets you work directly with us to ensure the size, borders, and look are perfect for your business.', '1242-gloss_stickers.jpg*Square Sticker_3.jpg*Square Sticker_4.jpg', 2, '2017-05-30 14:35:51', '2017-08-19 16:12:51'),
(4, 'Free Shaping Business Card', NULL, NULL, 2, 'Free Shaping Cards', 'free-shaping-cards', 'f1.png', 'Printing Amazon’s Premium Business Cards will set you apart from the crowd with our carefully selected materials and high definition printing technology. Our proof approval process let you work directly with us to ensure the size, corners, and look are perfect. From every day to extra special. With a variety of stocks and specialty finishes, designing your unique custom business cards is easier than you think.', 'Lettering Decal_1.jpg', 2, '2017-06-19 15:22:41', '2017-08-19 16:22:27'),
(17, 'Rectangle Stickers - Printing Amazon', NULL, NULL, 1, 'Rectangle Stickers', 'rectangle-stickers', 'cs-4.png', 'Custom rectangle stickers make great business card stickers, product labels, envelope seals and more. Our proof approval process lets you work directly with us to ensure the size, borders, and look are perfect for your needs.', 'Rectangle Sticker_1.jpg', 3, '2017-08-15 14:00:51', '2017-08-15 14:19:28'),
(19, 'Rectangle Postcards', NULL, NULL, 4, 'Rectangle Postcards', 'rectangle-postcards', 'f2.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Postcard_1.jpg', 1, '2017-08-15 16:23:21', '2017-08-15 16:23:21'),
(20, 'Rounded Corner', NULL, NULL, 3, 'Rounded Corner', 'rounded-corner', 'cs-6.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Die-cutting_7.jpg', 1, '2017-08-15 16:42:47', '2017-08-19 16:20:42'),
(21, 'Circle Stickers', NULL, NULL, 1, 'Circle Stickers', 'circle-stickers', 'cs-2.png', 'Easy to hand out, Printing Amazon’s Circle Stickers are a great way to promote your brand or label your products. Our proof approval process lets you work directly with us to ensure the size, borders, and look are perfect.', 'Round Sticker_1.png', 4, '2017-08-15 16:57:52', '2017-08-19 16:13:40'),
(22, 'Name stickers - Printing Amazon', NULL, NULL, 1, 'Name stickers', 'name-stickers', 'namesticker_icon.png', 'If you are getting headaches with your kids because they lose their belongings at school, try our Name stickers. We provide various forms of pre-designed artworks and you only simply need to let us know the detail that you would like to apply onto the sticker and you would a name sticker you would be proud of.', NULL, 5, '2017-08-16 13:48:57', '2017-08-26 17:17:23'),
(23, 'Labels - Printing Amazon', NULL, NULL, 5, 'Labels', 'labels', 'cs-4.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo', 'PVC-paper-custom-label-sticker-logo-printing-self-adhesive-shipping-labels-custom-sticker-label-stickers.jpg', 1, '2017-08-19 13:08:47', '2017-08-19 15:57:18'),
(24, 'Graphic Designs - Printing Amazon', NULL, NULL, 5, 'Graphic Designs', 'graphic-designs', 'cs-4.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo', 'gshock-watch-sports-watch-stopwatch-158741.jpeg*hacker-internet-technology-computers-159195.jpeg', 2, '2017-08-19 13:24:07', '2017-08-19 13:24:07');

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
(8, 50);

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
(78, 24, 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam edit', '3.5', 1, '2017-08-19 13:49:54', '2017-08-19 14:02:05'),
(80, 19, 1, 'proident, sunt in culpa qui officia deserunt mollit anim', 'quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non', '4.0', 0, '2017-08-31 16:15:08', '2017-08-31 16:15:08');

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
(5, '9 x 9 mm', 9, 9),
(6, '12 x 12 mm', 12, 12),
(7, '15 x 15 mm', 15, 15),
(8, '50 x 50 mm', 50, 50),
(9, '70 x 70 mm', 70, 70),
(10, '90 x 90 mm', 90, 90),
(11, '120 x 120 mm', 120, 120);

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
(2, 'Sourav Rakshit', 'srv.nxr@gmail.com', 'depositphotos_56695985-stock-illustration-male-avatar.jpg', '$2y$10$vTSYi53gm8fBEqEvZbD0l..Gm3Nioiv8A693txll7/3eR7qVy4hWq', 'Vm6To5vtytN6KOw8gvAzDy4yuFzf96Gc4bgEdj1PXuGD4gI3TKlXneKM3S30', '2017-05-18 16:08:04', '2017-07-22 18:16:07'),
(3, 'angellous99', 'angellous99@gmail.com', NULL, '$2y$10$0M3u8GJw6P5jedMqgf6hYe2gLJVExZCSAWdnhTd1ZDkX2D8VamP9i', 'wqupgczDAwlp3sCuzfFMet8fC6EBIHvHteCGXtnyTFeh5T2ioufdAs9O8s7i', '2017-08-22 11:25:02', '2017-08-22 11:25:13');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `lamination_options`
--
ALTER TABLE `lamination_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `map_prod_form`
--
ALTER TABLE `map_prod_form`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `map_prod_form_options`
--
ALTER TABLE `map_prod_form_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `notificationsetting`
--
ALTER TABLE `notificationsetting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `order_billing`
--
ALTER TABLE `order_billing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `paperstock_options`
--
ALTER TABLE `paperstock_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `preset_general`
--
ALTER TABLE `preset_general`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `preset_qty_rule_one`
--
ALTER TABLE `preset_qty_rule_one`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `preset_qty_rule_two`
--
ALTER TABLE `preset_qty_rule_two`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `qty_options`
--
ALTER TABLE `qty_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `size_options`
--
ALTER TABLE `size_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `sticker_types`
--
ALTER TABLE `sticker_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
