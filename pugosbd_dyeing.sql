-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 23, 2020 at 04:07 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pugosbd_dyeing`
--

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grey_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_list_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `batch_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `machine_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compostion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stitch_length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mark_hole` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `y_lot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gray_wt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Finish_wt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `grey_id`, `order_id`, `order_list_id`, `date`, `batch_no`, `machine_no`, `po_no`, `compostion`, `stitch_length`, `mark_hole`, `y_lot`, `gray_wt`, `Finish_wt`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 4, '2020-08-23', '55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-23 02:15:41', '2020-08-23 02:15:41'),
(2, 1, 1, 4, '2020-08-21', '44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-23 02:16:02', '2020-08-23 02:16:02'),
(3, 3, 2, 6, '2020-08-19', '45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-23 02:16:23', '2020-08-23 02:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `factory_id` int(11) NOT NULL,
  `buyer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`id`, `factory_id`, `buyer`, `created_at`, `updated_at`) VALUES
(1, 1, 'Liam', '2020-08-23 01:49:10', '2020-08-23 01:49:10'),
(2, 1, 'Noah', '2020-08-23 01:49:18', '2020-08-23 01:49:18'),
(3, 2, 'William', '2020-08-23 01:49:27', '2020-08-23 01:49:27'),
(4, 2, 'James', '2020-08-23 01:49:37', '2020-08-23 01:49:37'),
(5, 3, 'Logan', '2020-08-23 01:49:46', '2020-08-23 01:49:46'),
(6, 3, 'Benjamin', '2020-08-23 01:49:54', '2020-08-23 01:49:54'),
(7, 4, 'Mason', '2020-08-23 01:50:02', '2020-08-23 01:50:02'),
(8, 4, 'Elijah', '2020-08-23 01:50:13', '2020-08-23 01:50:13'),
(9, 5, 'Oliver', '2020-08-23 01:50:23', '2020-08-23 01:50:23'),
(10, 5, 'Jacob', '2020-08-23 01:50:32', '2020-08-23 01:50:32'),
(11, 1, 'Lucas', '2020-08-23 01:50:46', '2020-08-23 01:50:46'),
(12, 2, 'Michael', '2020-08-23 01:50:55', '2020-08-23 01:50:55'),
(13, 3, 'Alexander', '2020-08-23 01:51:04', '2020-08-23 01:51:04'),
(14, 3, 'Ethan', '2020-08-23 01:51:12', '2020-08-23 01:51:12'),
(15, 5, 'Daniel', '2020-08-23 01:51:46', '2020-08-23 01:51:46'),
(16, 3, 'Matthew', '2020-08-23 01:52:10', '2020-08-23 01:52:10'),
(17, 5, 'Aiden', '2020-08-23 01:52:20', '2020-08-23 01:52:20'),
(18, 4, 'Henry', '2020-08-23 01:52:28', '2020-08-23 01:52:28'),
(19, 3, 'Joseph', '2020-08-23 01:52:36', '2020-08-23 01:52:36'),
(20, 1, 'aa', '2020-08-23 14:01:51', '2020-08-23 14:01:51');

-- --------------------------------------------------------

--
-- Table structure for table `colours`
--

CREATE TABLE `colours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `colour_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colours`
--

INSERT INTO `colours` (`id`, `colour_name`, `created_at`, `updated_at`) VALUES
(1, 'Black', '2020-08-23 01:54:32', '2020-08-23 01:54:32'),
(2, 'Blue', '2020-08-23 01:54:38', '2020-08-23 01:54:38'),
(3, 'Azure', '2020-08-23 01:54:51', '2020-08-23 01:54:51'),
(4, 'Brown', '2020-08-23 01:54:57', '2020-08-23 01:54:57'),
(5, 'Cerise', '2020-08-23 01:55:06', '2020-08-23 01:55:06');

-- --------------------------------------------------------

--
-- Table structure for table `factories`
--

CREATE TABLE `factories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `factory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `factories`
--

INSERT INTO `factories` (`id`, `factory_name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Anlima Group', NULL, 'Paltan, Dhaka - 1000 , Bangladesh', '2020-08-23 01:46:59', '2020-08-23 01:46:59'),
(2, 'Far East Knitting & Dyeing Ind. Ltd.', NULL, 'Gulshan, Dhaka - 1212 , Bangladesh', '2020-08-23 01:47:12', '2020-08-23 01:47:12'),
(3, 'Anwar Dying & Printing', NULL, 'Motijheel, Dhaka - 1000 , Bangladesh', '2020-08-23 01:47:25', '2020-08-23 01:47:25'),
(4, 'Pacific Associates Ltd.', NULL, 'Paltan, Dhaka - 1000 , Bangladesh', '2020-08-23 01:47:46', '2020-08-23 01:47:46'),
(5, 'Excelsior Trading Corpn. Ltd.', NULL, 'Malibagh, Dhaka - 1000 , Bangladesh', '2020-08-23 01:48:01', '2020-08-23 01:48:01'),
(6, 'SB Textile Mills Ltd.', NULL, 'Rampura, Dhaka - 1219 , Bangladesh', '2020-08-23 14:06:31', '2020-08-23 14:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `finisheds`
--

CREATE TABLE `finisheds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `gray_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finished_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waste` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `finisheds`
--

INSERT INTO `finisheds` (`id`, `batch_id`, `date`, `gray_qty`, `finished_qty`, `waste`, `created_at`, `updated_at`) VALUES
(1, 2, '2020-08-22', '500', '450', '50', '2020-08-23 02:17:00', '2020-08-23 02:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `greys`
--

CREATE TABLE `greys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_list_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `total_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `today_receive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remaining` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_create` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `greys`
--

INSERT INTO `greys` (`id`, `order_id`, `order_list_id`, `date`, `total_qty`, `today_receive`, `remaining`, `remarks`, `batch_create`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2020-08-23', '900', '500', '400', NULL, 1, '2020-08-23 02:12:17', '2020-08-23 02:16:02'),
(2, 1, 4, '2020-08-17', '400', '400', '0', NULL, 1, '2020-08-23 02:12:40', '2020-08-23 02:15:41'),
(3, 2, 6, '2020-08-21', '860', '550', '310', NULL, 1, '2020-08-23 02:13:05', '2020-08-23 02:16:23'),
(4, 4, 12, '2020-08-22', '500', '500', '0', NULL, 0, '2020-08-23 02:13:22', '2020-08-23 02:13:22'),
(5, 4, 11, '2020-08-23', '660', '500', '160', NULL, 0, '2020-08-23 02:13:58', '2020-08-23 02:13:58'),
(6, 1, 1, '2020-08-23', '800', '800', '0', NULL, 0, '2020-08-23 13:49:34', '2020-08-23 13:49:34'),
(7, 1, 2, '2020-08-23', '650', '650', '0', NULL, 0, '2020-08-23 13:50:40', '2020-08-23 13:50:40'),
(8, 5, 15, '2020-08-23', '1000', '500', '500', NULL, 0, '2020-08-23 14:05:22', '2020-08-23 14:05:22');

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
(27, '2014_10_12_000000_create_users_table', 1),
(28, '2014_10_12_100000_create_password_resets_table', 1),
(29, '2020_08_09_093917_create_factories_table', 1),
(30, '2020_08_09_201335_create_buyers_table', 1),
(31, '2020_08_10_054905_create_styles_table', 1),
(32, '2020_08_10_060951_create_colours_table', 1),
(33, '2020_08_10_100431_create_orders_table', 1),
(34, '2020_08_10_100444_create_order_lists_table', 1),
(35, '2020_08_14_085925_create_batches_table', 1),
(36, '2020_08_15_103057_create_processes_table', 1),
(37, '2020_08_15_103212_create_process_lists_table', 1),
(38, '2020_08_21_100221_create_greys_table', 1),
(39, '2020_08_21_190547_create_finisheds_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `factory_id` int(11) NOT NULL,
  `challan_no` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `total_roll` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `factory_id`, `challan_no`, `date`, `total_roll`, `total_qty`, `created_at`, `updated_at`) VALUES
(1, 1, 100, '2020-08-09', '51', '3100', '2020-08-23 01:57:55', '2020-08-23 01:57:55'),
(2, 2, 101, '2020-08-23', '50', '2530', '2020-08-23 01:58:47', '2020-08-23 01:58:47'),
(3, 3, 101, '2020-08-13', '130', '1390', '2020-08-23 01:59:32', '2020-08-23 01:59:32'),
(4, 1, 104, '2020-08-16', '166', '3385', '2020-08-23 02:00:50', '2020-08-23 02:00:50'),
(5, 1, 111, '2020-08-23', '1234', '1000', '2020-08-23 14:04:41', '2020-08-23 14:04:41');

-- --------------------------------------------------------

--
-- Table structure for table `order_lists`
--

CREATE TABLE `order_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `style_id` int(11) DEFAULT NULL,
  `work_order` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yarn_count` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fabrics_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f_dia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gray_gsm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gsm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colour_id` int(11) DEFAULT NULL,
  `roll` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_lists`
--

INSERT INTO `order_lists` (`id`, `order_id`, `buyer_id`, `style_id`, `work_order`, `yarn_count`, `fabrics_type`, `dia`, `f_dia`, `gray_gsm`, `gsm`, `colour_id`, `roll`, `quantity`, `remaining`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, '5', '7', NULL, NULL, NULL, NULL, NULL, 2, '8', '800', '0', '2020-08-23 01:57:55', '2020-08-23 13:49:34'),
(2, 1, 2, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '8', '650', '0', '2020-08-23 01:57:55', '2020-08-23 13:50:40'),
(3, 1, 11, 2, '5', '79', NULL, NULL, NULL, NULL, NULL, 2, '15', '750', '750', '2020-08-23 01:57:55', '2020-08-23 01:57:55'),
(4, 1, 1, 3, '2', NULL, NULL, NULL, NULL, NULL, NULL, 4, '20', '900', '0', '2020-08-23 01:57:55', '2020-08-23 02:12:40'),
(5, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '10', '680', '680', '2020-08-23 01:58:47', '2020-08-23 01:58:47'),
(6, 2, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '20', '860', '310', '2020-08-23 01:58:47', '2020-08-23 02:13:05'),
(7, 2, 12, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '20', '990', '990', '2020-08-23 01:58:47', '2020-08-23 01:58:47'),
(8, 3, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '60', '600', '600', '2020-08-23 01:59:32', '2020-08-23 01:59:32'),
(9, 3, 13, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '70', '790', '790', '2020-08-23 01:59:32', '2020-08-23 01:59:32'),
(10, 4, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '33', '780', '780', '2020-08-23 02:00:50', '2020-08-23 02:00:50'),
(11, 4, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '43', '660', '160', '2020-08-23 02:00:50', '2020-08-23 02:13:58'),
(12, 4, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '24', '500', '0', '2020-08-23 02:00:50', '2020-08-23 02:13:22'),
(13, 4, 11, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '13', '866', '866', '2020-08-23 02:00:50', '2020-08-23 02:00:50'),
(14, 4, 2, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, '53', '579', '579', '2020-08-23 02:00:50', '2020-08-23 02:00:50'),
(15, 5, 20, 1, '111', 'dfdsf', 'dfdasf', 'ffdgsd', 'fgsfdgsd', 'dfgsfdg', 'fgsfdg', 2, '1234', '1000', '500', '2020-08-23 14:04:41', '2020-08-23 14:05:22');

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
-- Table structure for table `processes`
--

CREATE TABLE `processes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `process_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `processes`
--

INSERT INTO `processes` (`id`, `process_name`, `created_at`, `updated_at`) VALUES
(1, 'Heatset', '2020-08-23 01:55:42', '2020-08-23 01:55:42'),
(2, 'Dyeing', '2020-08-23 01:55:47', '2020-08-23 01:55:47'),
(3, 'Enzyme', '2020-08-23 01:55:54', '2020-08-23 01:55:54'),
(4, 'Silicon', '2020-08-23 01:56:00', '2020-08-23 01:56:00'),
(5, 'Dryer', '2020-08-23 01:56:07', '2020-08-23 01:56:07');

-- --------------------------------------------------------

--
-- Table structure for table `process_lists`
--

CREATE TABLE `process_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `process_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `process_lists`
--

INSERT INTO `process_lists` (`id`, `process_id`, `batch_id`, `created_at`, `updated_at`) VALUES
(1, '[\"2\",\"4\",\"5\"]', 2, '2020-08-23 02:16:38', '2020-08-23 02:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `styles`
--

CREATE TABLE `styles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `style_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `styles`
--

INSERT INTO `styles` (`id`, `style_name`, `created_at`, `updated_at`) VALUES
(1, 'Vintage', '2020-08-23 01:53:15', '2020-08-23 01:53:15'),
(2, 'Artsy', '2020-08-23 01:53:22', '2020-08-23 01:53:22'),
(3, 'Casual', '2020-08-23 01:53:29', '2020-08-23 01:53:29'),
(4, 'Grunge', '2020-08-23 01:53:37', '2020-08-23 01:53:37'),
(5, 'Chic', '2020-08-23 01:53:44', '2020-08-23 01:53:44'),
(6, 'Bohemian', '2020-08-23 01:53:51', '2020-08-23 01:53:51'),
(7, 'Exotic', '2020-08-23 01:53:58', '2020-08-23 01:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'assets/images/user.png',
  `role_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `phone`, `image`, `role_id`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'Dhaka', '01712345678', 'storage/user/961597071370.jpg', NULL, 1, NULL, '$2y$10$kaH4GbyW5s7r.uUbPH7bcOsImVTBshnEzAj1HF8gn6rZnNfDia9wa', 'bKj0ONQZMq9WkdU3sgRpOlHP6a5Owr5Gm6TMFsivsUdi8sw72dQIlgVFe4ef', '2020-08-10 08:34:32', '2020-08-10 09:15:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colours`
--
ALTER TABLE `colours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `factories`
--
ALTER TABLE `factories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finisheds`
--
ALTER TABLE `finisheds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `greys`
--
ALTER TABLE `greys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_lists`
--
ALTER TABLE `order_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `processes`
--
ALTER TABLE `processes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `process_lists`
--
ALTER TABLE `process_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `styles`
--
ALTER TABLE `styles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `colours`
--
ALTER TABLE `colours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `factories`
--
ALTER TABLE `factories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `finisheds`
--
ALTER TABLE `finisheds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `greys`
--
ALTER TABLE `greys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_lists`
--
ALTER TABLE `order_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `processes`
--
ALTER TABLE `processes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `process_lists`
--
ALTER TABLE `process_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `styles`
--
ALTER TABLE `styles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
