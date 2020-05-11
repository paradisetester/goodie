-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2020 at 12:07 PM
-- Server version: 5.6.41-84.1-log
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aisolsc8_goodiemenu`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` int(11) NOT NULL COMMENT 'who Insert',
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `uid`, `Name`, `Slug`, `created_at`, `updated_at`) VALUES
(25, 1, 'Ice Cream', 'Ice Cream', '2020-04-27 12:32:40', '2020-04-27 12:32:40'),
(24, 1, 'Pizza', 'Pizza', '2020-04-27 12:32:05', '2020-05-04 09:21:38'),
(33, 1, 'Chinese', 'Chinese', '2020-04-30 13:18:46', '2020-04-30 13:18:46'),
(26, 1, 'Non-Veg', 'Non-Veg', '2020-04-28 04:46:11', '2020-04-28 04:46:11'),
(27, 1, 'Burger', 'Burger', '2020-04-28 05:02:03', '2020-04-28 05:02:03'),
(28, 1, 'Drinks', 'Drinks', '2020-04-28 07:55:36', '2020-04-28 07:55:36');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2020_04_22_101317_create_categories_table', 2),
(10, '2020_04_22_101735_create_products_table', 3),
(11, '2020_04_22_102443_create_product_categories_table', 4),
(12, '2020_05_05_063103_create_restraunts_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('manishsinghnegi18@gmail.com', '$2y$10$AnheIVPKCg3DjFq4x.nFCOaUck.dYGFzJWHE3jubucK974yukQuN2', '2020-05-07 11:33:27');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` int(11) NOT NULL COMMENT 'who Insert',
  `productName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `uid`, `productName`, `price`, `image`, `description`, `created_at`, `updated_at`) VALUES
(21, 1, 'Burger', 201, 'images/uploads/2020/Apr/1588050220_sandwich.jpg', 'This is Sandwich Burger', '2020-04-28 05:03:40', '2020-04-28 05:03:40'),
(20, 1, 'Beef Burger', 786, 'images/uploads/2020/Apr/1588050182_Prime beef burger.jpg', 'This is Beef Burger', '2020-04-28 05:03:02', '2020-04-28 05:03:02'),
(19, 1, 'Pork Meat', 400, 'images/uploads/2020/Apr/1588049372_rib plate.jpg', 'Lorazepam, sold under the brand name.', '2020-04-28 04:47:43', '2020-04-28 04:49:32'),
(18, 1, 'Chocolate Cone', 120, 'images/uploads/2020/Apr/1587990981_ConeIcream.jpg', 'This is Chocolate ice Creams', '2020-04-27 12:36:21', '2020-04-27 12:36:21'),
(16, 1, 'Margarita Pizza', 200, 'images/uploads/2020/Apr/1587990846_cheese pizza.jpeg', 'This is delicious Margarita Pizza .Extra Large. very large', '2020-04-27 12:34:06', '2020-04-28 09:47:34'),
(17, 1, 'Cheese Burst Pizza', 400, 'images/uploads/2020/Apr/1587990925_mashrrom pizza.jpg', 'Cheese burst Pizza is yummy', '2020-04-27 12:35:25', '2020-04-28 09:45:27'),
(22, 1, 'Fried Chicken', 241, 'images/uploads/2020/Apr/1588050316_fried chicken.jpg', 'This is KFC fried Chicken', '2020-04-28 05:05:16', '2020-04-28 05:05:16'),
(23, 1, 'Oreo Shake', 210, 'images/uploads/2020/Apr/1588067554_Oreo shake.jpg', 'Oreo chocolates', '2020-04-28 07:59:03', '2020-04-28 09:52:34'),
(24, 1, 'Beers', 450, 'images/uploads/2020/Apr/1588060864_Ed_Picks_Web_Story_lead_image.jpg', 'Smooth Chill Beers', '2020-04-28 08:01:04', '2020-04-28 08:01:04'),
(25, 1, 'shrimp and grits', 786, 'images/uploads/2020/Apr/1588067726_shrimp and grits.jpg', 'This is Shrimps very good and tasty', '2020-04-28 09:55:26', '2020-04-30 10:39:04'),
(26, 1, 'Shakes', 1000, 'images/uploads/2020/Apr/1588071059_Refreshing-Summer-Drinks-Fifteen-Spatulas-1.jpg', 'fgfgfgfgfg', '2020-04-28 10:50:59', '2020-04-28 10:50:59'),
(27, 1, 'cheese burger', 20, 'images/uploads/2020/Apr/1588073394_tacos.jpg', 'Dummy description for the product', '2020-04-28 11:29:54', '2020-04-28 12:06:08'),
(29, 1, 'Noodles', 120, 'images/uploads/2020/Apr/1588252955_nooles.jpg', 'Chinese Noodles', '2020-04-30 13:22:35', '2020-04-30 13:22:35'),
(30, 1, 'Momos', 100, 'images/uploads/2020/Apr/1588252992_Momos.jpg', 'Steamed Momos', '2020-04-30 13:23:12', '2020-04-30 13:23:12'),
(31, 1, 'Honey Cauliflower', 180, 'images/uploads/2020/Apr/1588253186_7063_1530194281_0.jpg', 'Honey Cauliflower', '2020-04-30 13:23:58', '2020-04-30 13:26:26'),
(32, 1, 'Deluxe Burger', 22, 'images/uploads/2020/May/1588342172_goodie menu (1).png', 'I love burgers', '2020-05-01 14:09:32', '2020-05-01 14:09:32'),
(40, 14, 'MC Donald\'s', 120, 'images/uploads/2020/May/1588753328_the-true-story-behind-the-mysterious-mcdonalds-gold-card-673955074-Vytautas-Kielaitis-1024x683.jpg', 'I m Loving It', '2020-05-06 08:22:08', '2020-05-06 08:22:08'),
(39, 13, 'KFC Chicken', 400, 'images/uploads/2020/May/1588752467_1200px-KFC_logo.svg.png', 'asdsdasdsd', '2020-05-06 08:07:47', '2020-05-06 08:07:47'),
(41, 13, 'Subway roll', 1000, 'images/uploads/2020/May/1588753408_subway-logo-new-1200x630.png', 'Healty meal', '2020-05-06 08:23:28', '2020-05-06 08:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` int(11) NOT NULL COMMENT 'who Insert',
  `category_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `uid`, `category_id`, `product_id`, `created_at`, `updated_at`) VALUES
(25, 1, 26, 25, '2020-04-28 09:55:26', '2020-04-28 09:55:26'),
(24, 1, 28, 24, '2020-04-28 08:01:04', '2020-04-28 08:01:04'),
(23, 1, 28, 23, '2020-04-28 07:59:03', '2020-04-28 07:59:03'),
(22, 1, 26, 22, '2020-04-28 05:05:16', '2020-04-28 05:05:16'),
(21, 1, 27, 21, '2020-04-28 05:03:40', '2020-04-28 05:03:40'),
(20, 1, 27, 20, '2020-04-28 05:03:02', '2020-04-28 05:03:02'),
(19, 1, 26, 19, '2020-04-28 04:47:43', '2020-04-28 04:47:43'),
(18, 1, 25, 18, '2020-04-27 12:36:21', '2020-04-27 12:36:21'),
(17, 1, 24, 17, '2020-04-27 12:35:25', '2020-04-27 12:35:25'),
(16, 1, 24, 16, '2020-04-27 12:34:06', '2020-04-27 12:34:06'),
(26, 1, 28, 26, '2020-04-28 10:50:59', '2020-04-30 12:52:10'),
(27, 1, 27, 27, '2020-04-28 11:29:54', '2020-04-30 12:57:54'),
(28, 1, 32, 28, '2020-04-28 12:11:33', '2020-04-28 12:11:33'),
(29, 1, 33, 29, '2020-04-30 13:22:35', '2020-04-30 13:22:35'),
(30, 1, 33, 30, '2020-04-30 13:23:12', '2020-04-30 13:23:12'),
(31, 1, 33, 31, '2020-04-30 13:23:58', '2020-04-30 13:23:58'),
(32, 1, 27, 32, '2020-05-01 14:09:32', '2020-05-01 14:09:32'),
(34, 1, 28, 34, '2020-05-05 07:38:37', '2020-05-05 07:38:37'),
(35, 13, 25, 35, '2020-05-06 06:07:51', '2020-05-06 06:07:51'),
(36, 13, 38, 36, '2020-05-06 06:18:34', '2020-05-06 06:18:34'),
(39, 13, 26, 39, '2020-05-06 08:07:47', '2020-05-06 08:07:47'),
(40, 14, 27, 40, '2020-05-06 08:22:08', '2020-05-06 08:22:08'),
(41, 13, 27, 41, '2020-05-06 08:23:28', '2020-05-06 08:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `restraunts`
--

CREATE TABLE `restraunts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` int(11) NOT NULL,
  `restraunt_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Assignuser` int(11) NOT NULL,
  `ratings` int(11) NOT NULL DEFAULT '0',
  `contact` bigint(20) NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1=Unblock 2=Block',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restraunts`
--

INSERT INTO `restraunts` (`id`, `uid`, `restraunt_name`, `Assignuser`, `ratings`, `contact`, `address`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(10, 1, 'The Royal Hayat', 13, 0, 9999999, '10 downing Street, USA', 'images/uploads/2020/May/1588830322_download.jpg', 'the Hayat hotel Doom', 1, '2020-05-06 04:43:41', '2020-05-07 10:23:25'),
(11, 1, 'The Taaj', 14, 5, 74185296, '10 downing Street, London', 'images/uploads/2020/May/1588753228_134442_v3.webp', 'waah taj', 1, '2020-05-06 08:20:28', '2020-05-06 09:41:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=Unblock 2=Block',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', NULL, '$2y$10$yC7Kx3jx8a3r.GyK1msbs.5fGWHfr1Jmtt.0Lep759q6uvYpN59ca', 'ISEcvXYur0dVu3GQXfdHFUmXLwrfrjhwxeWkpBk6FsnOYp5KS7N8JgVu2xuF', 1, '2020-04-22 04:05:13', '2020-04-22 04:05:13'),
(14, 'The Taaj', 'user', 'taaj@gmail.com', NULL, '$2y$10$RgRINDx30WnwmZRZJYrOKOqN8Id5PgPKhaKOukO/HJ1hMl2eVzvEe', NULL, 1, '2020-05-06 08:20:28', '2020-05-06 09:41:35'),
(13, 'The Royal Hayat', 'user', 'manishsinghnegi18@gmail.com', NULL, '$2y$10$6CI.3OZYrvD21DARYshpNOBqkIlm2PHrcfJSNRGASWpAoaLxAYZqG', NULL, 1, '2020-05-06 04:43:41', '2020-05-07 11:32:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(250));

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restraunts`
--
ALTER TABLE `restraunts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `restraunts`
--
ALTER TABLE `restraunts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
