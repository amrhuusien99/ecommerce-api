-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2021 at 07:25 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce-api`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `is_activate` int(11) NOT NULL DEFAULT 1,
  `pin_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `created_at`, `updated_at`, `name`, `email`, `password`, `phone`, `photo`, `role_id`, `is_activate`, `pin_code`) VALUES
(2, '2021-03-21 18:49:40', '2021-04-01 08:15:45', 'amrr', 'amr@gmail.com', '$2y$10$NEkOXyhfF.yVotNztwzpdOpnrF65FpIQdrdtB5uc4e01Ww2IErN7i', '123479', 'files/admin/images/admins/161646715040664.jpg', 0, 1, NULL),
(3, '2021-03-22 23:45:48', '2021-04-02 08:07:43', 'amrr', 'mora@gmail.com', '$2y$10$6v85k.08jCDNhIJFd3hZ0eRvdY5/0hjnBheF8K/p8jN38TwS5r/Rm', '1234788', 'files/admin/images/admins/161735806388321.jpg', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activate` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `created_at`, `updated_at`, `is_activate`) VALUES
(2, '2021-01-15 16:01:55', '2021-01-15 16:04:28', 1),
(3, '2021-02-06 08:03:41', '2021-02-06 08:03:41', 1),
(5, '2021-03-26 02:45:34', '2021-03-26 03:17:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_translations`
--

CREATE TABLE `attribute_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_translations`
--

INSERT INTO `attribute_translations` (`id`, `name`, `locale`, `attribute_id`) VALUES
(1, 'imagesgggg', 'en', 2),
(2, 'imagesgggg ar', 'ar', 2),
(3, 'imagesgggg es', 'es', 2),
(4, 'color x22', 'en', 3),
(6, 'color x227854', 'en', 5),
(10, 'vendor attributes aaa api ar 33', 'ar', 5),
(11, 'vendor options aaa api ess 22', 'es', 5);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_activate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `created_at`, `updated_at`, `photo`, `is_activate`) VALUES
(1, '2021-01-05 11:26:01', '2021-01-05 13:19:38', 'files/admin/images/brands/160985527782069.png', '1'),
(4, '2021-01-05 20:42:44', '2021-01-05 20:42:44', NULL, '1'),
(13, '2021-03-23 14:40:39', '2021-03-23 14:50:16', 'files/admin/images/brands/161651821696128.png', '1'),
(15, '2021-04-04 05:50:42', '2021-04-04 05:50:42', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `brand_translations`
--

CREATE TABLE `brand_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand_translations`
--

INSERT INTO `brand_translations` (`id`, `name`, `locale`, `brand_id`) VALUES
(1, 'ccccc', 'en', 1),
(3, 'vvvvv', 'ar', 1),
(5, 'imagesgggg', 'en', 4),
(8, 'gggggggg', 'es', 1),
(9, 'asas', 'es', 4),
(16, 'brand api 1144', 'en', 13),
(17, 'brands aaa api ar', 'ar', 13),
(18, 'brand aaa api ess', 'es', 13),
(20, 'brand api 11', 'en', 15);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `created_at`, `updated_at`, `user_id`, `product_id`) VALUES
(11, '2021-02-11 21:08:19', '2021-02-11 21:08:19', 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_activate` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `created_at`, `updated_at`, `parent_id`, `slug`, `is_activate`) VALUES
(1, '2021-01-05 10:21:04', '2021-01-05 13:14:59', NULL, 'aaaa-aaaa55', 1),
(2, '2021-01-05 10:23:49', '2021-01-05 10:23:49', 1, 'bbbb-bbbbbb', 1),
(3, '2021-01-06 09:36:38', '2021-01-06 09:36:38', 2, 'momo-mo', 1),
(14, '2021-03-23 03:41:10', '2021-04-03 14:14:05', NULL, 'aaa-api-ee', 1),
(17, '2021-03-23 11:22:47', '2021-04-04 05:43:03', 1, 'sub-aaa-api-ee22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_translations`
--

CREATE TABLE `category_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_translations`
--

INSERT INTO `category_translations` (`id`, `category_id`, `locale`, `name`) VALUES
(1, 1, 'en', 'aaaaaaaaa'),
(2, 1, 'ar', 'اااااااا'),
(3, 2, 'en', 'bbbbbb'),
(4, 3, 'en', 'momomomo'),
(5, 3, 'ar', 'momom55'),
(6, 2, 'ar', 'bbbb55'),
(13, 1, 'es', 'aaaaaaaaa ES'),
(14, 2, 'es', 'aaaaaaccaaa ES'),
(15, 3, 'es', 'imagesgggg es 500'),
(18, 14, 'en', 'aaaa api ee44'),
(20, 14, 'ar', 'aaa api ar'),
(21, 14, 'es', 'brand aaa api ess'),
(24, 17, 'en', 'sub aaaa api ee22'),
(26, 17, 'ar', 'sub aaa api ar'),
(27, 17, 'es', 'sub aaa api es');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_of_message` enum('complaint','suggestion','enquiry') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `created_at`, `updated_at`, `name`, `email`, `phone`, `content`, `type_of_message`) VALUES
(1, NULL, NULL, 'agrgc rgsrfg', 'sdvsdv@gmail.com', '0452452452', 'dfvsfb sgbsfgbta sfgbsfgbsfgb bsdfafvad', 'complaint');

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
-- Table structure for table `favorates`
--

CREATE TABLE `favorates` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorates`
--

INSERT INTO `favorates` (`user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 5, '2021-01-26 22:33:54', '2021-01-26 22:33:54'),
(6, 5, '2021-01-26 22:33:54', '2021-01-26 22:33:54');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_17_134649_create_attributes_table', 1),
(4, '2019_12_17_134649_create_brands_table', 1),
(5, '2019_12_17_134649_create_categories_table', 1),
(6, '2019_12_17_134649_create_options_table', 1),
(7, '2019_12_17_134649_create_payment_methods_table', 1),
(8, '2019_12_17_134649_create_products_table', 1),
(9, '2019_12_17_134649_create_sliders_table', 1),
(10, '2020_12_17_134649_create_admins_table', 1),
(11, '2020_12_17_134649_create_attribute_translations_table', 1),
(12, '2020_12_17_134649_create_brand_translations_table', 1),
(14, '2020_12_17_134649_create_category_translations_table', 1),
(15, '2020_12_17_134649_create_contact_us_table', 1),
(17, '2020_12_17_134649_create_notifications_table', 1),
(18, '2020_12_17_134649_create_option_translations_table', 1),
(20, '2020_12_17_134649_create_product_categories_table', 1),
(21, '2020_12_17_134649_create_product_tags_table', 1),
(22, '2020_12_17_134649_create_product_translations_table', 1),
(23, '2020_12_17_134649_create_settings_table', 1),
(24, '2020_12_17_134649_create_slider_translations_table', 1),
(25, '2020_12_17_134649_create_tags_table', 1),
(26, '2020_12_17_134649_create_tags_translations_table', 1),
(27, '2020_12_17_134649_create_vendors_table', 1),
(28, '2020_12_17_134649_create_payment_method_translations_table', 2),
(29, '2020_12_17_134649_create_carts_table', 3),
(30, '2020_11_28_182605_create_favorates_table', 4),
(31, '2018_08_07_135631306565_create_orders_table', 5),
(32, '2018_09_11_213926106353_create_transactions_table', 5),
(33, '2021_03_30_033819_create_permission_tables', 6),
(34, '2020_11_28_182605_create_order_products_table', 7),
(35, '2020_12_17_134649_create_permissions_table', 8),
(36, '2020_11_17_134649_create_roles_table', 9),
(37, '2020_12_17_134649_create_role_has_permissions_table', 9),
(38, '2020_12_17_134649_create_roles_table', 10),
(39, '2021_11_17_134649_create_permissions_table', 11),
(40, '2021_11_17_134649_create_roles_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notifiable_id` int(11) NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `created_at`, `updated_at`, `notifiable_id`, `notifiable_type`, `title`, `content`) VALUES
(1, '2021-01-06 15:16:11', '2021-01-06 15:16:19', 1, 'App\\Models\\Admin', 'qaceaeefa esfsfsdefWF EFefsd\\fawf Fwfsdvzrfg', 'EFefsd\\fawf Fwfsdvzrfg EFefsd\\fawf Fwfsdvzrfg EFefsd\\fawf Fwfsdvzrfg EFefsd\\fawf Fwfsdvzrfg');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attribute_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_activate` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `created_at`, `updated_at`, `attribute_id`, `product_id`, `is_activate`) VALUES
(3, '2021-01-16 13:49:38', '2021-01-16 15:30:13', '2', '5', 1),
(6, '2021-02-06 08:04:08', '2021-02-06 08:04:08', '3', '5', 1),
(7, '2021-02-06 08:36:00', '2021-02-06 08:36:00', '3', '5', 1),
(10, '2021-03-26 04:00:57', '2021-03-26 04:05:03', '3', '5', 1);

-- --------------------------------------------------------

--
-- Table structure for table `option_translations`
--

CREATE TABLE `option_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `option_translations`
--

INSERT INTO `option_translations` (`id`, `option_id`, `locale`, `name`, `created_at`, `updated_at`) VALUES
(1, 3, 'en', 'option 1', NULL, NULL),
(3, 3, 'ar', 'option ar 11', NULL, NULL),
(4, 3, 'es', 'option es 1', NULL, NULL),
(5, 6, 'en', 'red', NULL, NULL),
(6, 7, 'en', 'black', NULL, NULL),
(9, 10, 'en', 'vendor options api 2355', NULL, NULL),
(10, 10, 'ar', 'vendor options aaa api ar 33', NULL, NULL),
(11, 10, 'es', 'vendor options aaa api ess 22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `cost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_cost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `net_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` enum('pending','rejected','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_method_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `created_at`, `updated_at`, `user_phone`, `user_name`, `address`, `quantity`, `cost`, `delivery_cost`, `total_cost`, `commission`, `net_cost`, `locale`, `status`, `state`, `product_id`, `payment_method_id`, `user_id`, `vendor_id`) VALUES
(23, '2021-02-10 16:06:07', '2021-02-10 16:06:07', '0148765489', 'AmrHussienHassan', 'cairo', 4, '1600', '100', '1700', '170', '1530', 'en', 'paid', 'pending', 5, 2, 1, 11),
(24, '2021-02-10 16:07:55', '2021-02-10 16:07:55', '0148765489', 'AmrHussienHassan', 'cairo', 5, '2000', '100', '2100', '210', '1890', 'en', 'paid', 'pending', 5, 2, 1, 11),
(27, '2021-02-11 21:08:59', '2021-02-11 21:08:59', '0148765489', 'AmrHussienHassan', 'cairo', 4, '4000', '100', '4100', '410', '3690', 'en', 'paid', 'pending', 21, 2, 1, 4),
(28, '2021-02-11 21:36:54', '2021-02-11 21:36:54', '0148765489', 'AmrHussienHassan', 'cairo', 5, '5000', '100', '5100', '510', '4590', 'en', 'paid', 'pending', 21, 2, 1, 4),
(29, '2021-02-11 21:36:54', '2021-02-11 21:36:54', '014876548988', 'AmrHussienHassan', 'cairo', 5, '5000', '100', '5100', '510', '4590', 'en', 'paid', 'pending', 21, 2, 1, 4),
(32, '2021-03-29 00:33:44', '2021-03-29 00:33:44', '1231235', 'ahmed500', 'cairo', NULL, '10000', '100', '10100', '1010', '9090', 'en', 'paid', 'pending', NULL, 2, 6, 4),
(33, '2021-03-29 00:37:40', '2021-03-29 00:37:40', '1231235', 'ahmed500', 'cairo', NULL, '10000', '100', '10100', '1010', '9090', 'en', 'paid', 'pending', NULL, 2, 6, 4),
(34, '2021-04-07 12:28:20', '2021-04-07 12:28:20', '0148765489', 'AmrHussienHassan55566', 'cairo', NULL, '1400', '100', '1500', '150', '1350', 'en', 'paid', 'pending', NULL, 2, 1, 11),
(35, '2021-04-07 12:31:02', '2021-04-07 12:31:02', '0148765489', 'AmrHussienHassan55566', 'cairo', NULL, '1400', '100', '1500', '150', '1350', 'en', 'paid', 'pending', NULL, 2, 1, 11),
(36, '2021-04-07 12:31:21', '2021-04-07 12:31:21', '0148765489', 'AmrHussienHassan55566', 'cairo', NULL, '1400', '100', '1500', '150', '1350', 'en', 'paid', 'pending', NULL, 2, 1, 11),
(37, '2021-04-07 12:32:11', '2021-04-07 12:32:11', '0148765489', 'AmrHussienHassan55566', 'cairo', NULL, '1400', '100', '1500', '150', '1350', 'en', 'paid', 'pending', NULL, 2, 1, 11),
(38, '2021-04-07 12:32:14', '2021-04-07 12:32:14', '0148765489', 'AmrHussienHassan55566', 'cairo', NULL, '5000', '100', '5100', '510', '4590', 'en', 'paid', 'pending', NULL, 2, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`order_id`, `product_id`, `quantity`, `price`, `note`, `created_at`, `updated_at`) VALUES
(34, 5, 1, 8500, NULL, NULL, NULL),
(34, 21, 1, 1000, NULL, NULL, NULL),
(35, 5, 1, 8500, NULL, NULL, NULL),
(35, 21, 1, 1000, NULL, NULL, NULL),
(36, 5, 1, 8500, NULL, NULL, NULL),
(36, 21, 1, 1000, NULL, NULL, NULL),
(37, 5, 1, 8500, NULL, NULL, NULL),
(37, 21, 1, 1000, NULL, NULL, NULL),
(38, 22, 1, 5000, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activate` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `created_at`, `updated_at`, `is_activate`) VALUES
(6, '2021-01-06 20:30:33', '2021-01-06 20:30:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method_translations`
--

CREATE TABLE `payment_method_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_method_translations`
--

INSERT INTO `payment_method_translations` (`id`, `name`, `locale`, `payment_method_id`) VALUES
(1, 'Cache', 'en', 6),
(2, 'aaaaaaaaa5000', 'ar', 6),
(3, 'momomomo ES', 'es', 6);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `route_name`, `created_at`, `updated_at`) VALUES
(1, 'Admins Show', 'admin/index', '2021-04-02 07:28:02', '2021-04-02 07:28:02'),
(2, 'Admin Add', 'admin/store', '2021-04-02 07:28:02', '2021-04-02 07:28:02'),
(3, 'Admin Delete', 'admin/delete', '2021-04-02 07:28:02', '2021-04-02 07:28:02'),
(4, 'Admin Activate', 'admin/activate', '2021-04-02 07:28:02', '2021-04-02 07:28:02'),
(5, 'Admin UnActivate', 'admin/deactivate', '2021-04-02 07:28:02', '2021-04-02 07:28:02'),
(6, 'Roles Show', 'admin/roles/index', '2021-04-02 07:28:02', '2021-04-02 07:28:02'),
(7, 'Role Add', 'admin/roles/store', '2021-04-02 07:28:02', '2021-04-02 07:28:02'),
(8, 'Role Delete', 'admin/roles/delete', '2021-04-02 07:28:02', '2021-04-02 07:28:02'),
(9, 'Role Information', 'admin/roles/show', '2021-04-02 07:28:02', '2021-04-02 07:28:02'),
(10, 'Role Edit', 'admin/roles/edit', '2021-04-02 07:28:02', '2021-04-02 07:28:02'),
(11, 'Role Update', 'admin/roles/update', '2021-04-02 07:28:02', '2021-04-02 07:28:02'),
(12, 'Vendors Show', 'admin/vendors', '2021-04-02 07:28:02', '2021-04-02 07:28:02'),
(13, 'Vendor Add', 'admin/vendors/store', '2021-04-02 07:28:02', '2021-04-02 07:28:02'),
(14, 'Vendor Delete', 'admin/vendors/delete', '2021-04-02 07:28:02', '2021-04-02 07:28:02'),
(15, 'Vendor Activate', 'admin/vendors/activate', '2021-04-02 07:28:02', '2021-04-02 07:28:02'),
(16, 'Vendor UnActivate', 'admin/vendors/deactivate', '2021-04-02 07:28:02', '2021-04-02 07:28:02'),
(17, 'Vendor Special', 'admin/vendors/special', '2021-04-02 07:28:02', '2021-04-02 07:28:02'),
(18, 'Vendor UnSpecial', 'admin/vendors/unspecial', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(19, 'Users Show', 'admin/users', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(20, 'User Add', 'admin/users/store', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(21, 'User Delete', 'admin/users/delete', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(22, 'User Activate', 'admin/users/activate', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(23, 'User UnActivate', 'admin/users/deactivate', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(24, 'Main Categories Show', 'main-category', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(25, 'Main Category Add', 'admin/main-category/store', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(26, 'Main Category Edit', 'admin/main-category/edit', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(27, 'Main Category Delete', 'admin/main-category/delete', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(28, 'Main Category Activate', 'admin/main-category/activate', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(29, 'Main Category UnActivate', 'admin/main-category/deactivate', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(30, 'Main Category Lang AR', 'admin/main-category/lang-ar', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(31, 'Main Category Lang ES', 'admin/main-category/lang_es', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(32, 'Sub Categories Show', 'sub-category', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(33, 'Sub Category Add', 'admin/sub-category/store', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(34, 'Sub Category Edit', 'admin/sub-category/edit', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(35, 'Sub Category Delete', 'admin/sub-category/delete', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(36, 'Sub Category Activate', 'admin/sub-category/activate', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(37, 'Sub Category UnActivate', 'admin/sub-category/deactivate', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(38, 'Sub Category Lang AR', 'admin/sub-category/lang-ar', '2021-04-02 07:28:03', '2021-04-02 07:28:03'),
(39, 'Sub Category Lang ES', 'admin/sub-category/lang-es', '2021-04-02 07:28:03', '2021-04-02 07:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photos` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `special_price` int(11) DEFAULT NULL,
  `special_price_start` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_price_end` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_stock` int(11) DEFAULT NULL,
  `is_activate` int(11) NOT NULL DEFAULT 0,
  `special_product` int(11) NOT NULL DEFAULT 0,
  `brand_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `created_at`, `updated_at`, `slug`, `photo`, `photos`, `quantity`, `sku`, `price`, `special_price`, `special_price_start`, `special_price_end`, `in_stock`, `is_activate`, `special_product`, `brand_id`, `vendor_id`) VALUES
(5, '2021-01-13 01:32:13', '2021-04-07 12:32:11', 'product-11-en', 'files/admin/images/products/161171473213362.png', NULL, 200, 'aas55', 8500, 400, '2021-01-20', '2021-01-30', 146, 1, 1, 1, 11),
(21, '2021-01-27 01:11:18', '2021-04-07 12:32:11', 'product-3-en', 'files/admin/images/products/161171714789160.png', NULL, 95, NULL, 1000, NULL, NULL, NULL, 86, 1, 1, 4, 11),
(22, '2021-02-14 15:57:44', '2021-04-07 12:32:14', 'product-1223', 'files/admin/images/products/161332557182495.jpg', NULL, 100, NULL, 5000, NULL, NULL, NULL, 99, 1, 1, 1, 4),
(26, '2021-03-27 02:27:51', '2021-04-04 06:29:23', 'product-api-en-000 2200', 'files/admin/images/products/161684971512230.png', 'files/admin/images/products/161684971526326.png,files/admin/images/products/161684971552140.png', 200, 'aef-54s', 2500, 2000, '2021-01-20', '2021-01-30', 190, 0, 0, 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `created_at`, `updated_at`, `product_id`, `category_id`) VALUES
(5, NULL, NULL, 5, 1),
(6, NULL, NULL, 5, 2),
(27, NULL, NULL, 20, 1),
(28, NULL, NULL, 20, 2),
(29, NULL, NULL, 21, 1),
(30, NULL, NULL, 21, 2),
(31, NULL, NULL, 22, 1),
(32, NULL, NULL, 22, 2),
(33, NULL, NULL, 22, 3),
(34, NULL, NULL, 23, 1),
(35, NULL, NULL, 23, 2),
(36, NULL, NULL, 23, 3),
(37, NULL, NULL, 24, 1),
(38, NULL, NULL, 24, 2),
(39, NULL, NULL, 24, 3),
(40, NULL, NULL, 26, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE `product_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_tags`
--

INSERT INTO `product_tags` (`id`, `created_at`, `updated_at`, `product_id`, `tag_id`) VALUES
(2, NULL, NULL, 5, 1),
(11, NULL, NULL, 20, 1),
(12, NULL, NULL, 21, 1),
(13, NULL, NULL, 22, 1),
(14, NULL, NULL, 23, 1),
(15, NULL, NULL, 24, 1),
(16, NULL, NULL, 24, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_translations`
--

CREATE TABLE `product_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_translations`
--

INSERT INTO `product_translations` (`id`, `name`, `locale`, `description`, `short_description`, `product_id`) VALUES
(1, 'product 1 en', 'en', 'the first product 1 en', 'first product 1 en', 5),
(2, 'product 1 ar', 'ar', 'the first product 1 ar', 'first product 1 ar', 5),
(3, 'product 1 es', 'es', 'the first product 1 es', 'first product 1 es', 5),
(17, 'product 3 en', 'en', 'product 3 en', 'product 3 en', 21),
(18, 'product 2 en', 'en', 'the first product 111  en', 'first product 2 en', 22),
(21, 'product api en 500000', 'en', 'product api enproduct api en  500000', 'productapi en product api en00000 500000', 26),
(22, 'vendor products update api ar 00', 'ar', 'vendor products updatr api ar 11', 'vendor products update api ar 22', 26),
(23, 'vendor products update api es 00', 'es', 'vendor products updatr api es 11', 'vendor products update api es 22', 26);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 4),
(21, 1),
(21, 2),
(21, 4),
(22, 1),
(22, 2),
(22, 3),
(22, 4);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `insta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whats_app` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `created_at`, `updated_at`, `email`, `phone`, `facebook`, `insta`, `whats_app`, `bank_name`, `commission`, `app_link`, `twitter`, `youtube`) VALUES
(1, '2021-01-08 11:05:19', '2021-03-25 04:50:45', 'ahmedu@gmail.com', '1233', 'ahmedu@gmail.com', 'ahmedu@gmail.com', '1231232', 'ahmedu55', '.10', 'ahmedugmailcomahmedu@gmail.com', 'ahmedu@gmail.com', 'ahmedu@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activate` int(11) NOT NULL DEFAULT 1,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `created_at`, `updated_at`, `is_activate`, `photo`) VALUES
(2, '2021-01-07 22:31:29', '2021-01-18 02:45:32', 1, 'files/admin/images/sliders/161094513296934.jpg'),
(4, '2021-01-18 03:26:29', '2021-01-18 03:26:29', 1, 'files/admin/images/sliders/161094758911323.jpg'),
(7, '2021-03-24 02:13:53', '2021-03-24 02:14:31', 1, 'files/admin/images/sliders/161655923374408.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `slider_translations`
--

CREATE TABLE `slider_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slider_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider_translations`
--

INSERT INTO `slider_translations` (`id`, `title`, `description`, `locale`, `slider_id`) VALUES
(1, 'INTERIOR REMODELING', 'asdg xagsfxgfasx xasgfdxgasx asfgxcasgxas asgfxcgas ascfgcashgca asgfchsgavashga jhafcastgx', 'en', 2),
(3, 'INTERIOR REMODELING5000', 'aaaaaa aaaa aaaa5000', 'ar', 2),
(4, 'INTERIOR REMODELING ES', 'aaaaaa aaaa aaaa5000 ES', 'es', 2),
(5, 'INTERIOR REMODELING 500500', 'the first product 111  the first product 111', 'en', 4),
(8, 'slider api 1155', 'slider-api-1155', 'en', 7),
(9, 'slider aaa api ar', 'slider slider slider aaa api  ar', 'ar', 7),
(10, 'tags aaa api ess', 'slider slider slider aaa api  es', 'es', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `is_activate` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `created_at`, `updated_at`, `slug`, `vendor_id`, `is_activate`) VALUES
(1, '2021-01-05 20:47:21', '2021-01-06 09:18:34', 'image-name55', 11, 1),
(3, '2021-02-14 22:44:25', '2021-02-14 22:46:43', 'aaaa-aaaa', 6, 1),
(7, '2021-03-24 01:28:54', '2021-03-24 01:30:04', 'tags-api', 11, 1),
(9, '2021-03-26 02:23:03', '2021-04-04 06:45:49', 'vendor-tags-api-5555', 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags_translations`
--

CREATE TABLE `tags_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags_translations`
--

INSERT INTO `tags_translations` (`id`, `name`, `locale`, `tag_id`) VALUES
(1, 'imagesgggg995', 'en', 1),
(2, 'imagesgggg55', 'ar', 1),
(4, 'imagesgggg es 500', 'es', 1),
(5, 'aaaaaaaaa', 'en', 3),
(6, 'aaaaaaa ar', 'ar', 3),
(7, 'aaaaaa es', 'es', 3),
(10, 'tags api', 'en', 7),
(11, 'vendor tasg aaa api ar', 'ar', 7),
(12, 'vendor tags aaa api ess', 'es', 7),
(14, 'vendor tags api 2355', 'en', 9),
(15, 'vendor tasg aaa api ar 22', 'ar', 9),
(16, 'vendor tags aaa api ess 22', 'es', 9);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `transaction_id`, `payment_method_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(21, 23, '060646043735741962', '2', NULL, '2021-02-10 16:06:07', '2021-02-10 16:06:07'),
(22, 24, '060646043935742062', '2', NULL, '2021-02-10 16:07:55', '2021-02-10 16:07:55'),
(25, 27, '060655620245281462', '2', NULL, '2021-02-11 21:08:59', '2021-02-11 21:08:59'),
(26, 28, '060655621045281962', '2', NULL, '2021-02-11 21:36:54', '2021-02-11 21:36:54'),
(27, 32, '060660280948972964', '2', NULL, '2021-03-29 00:33:44', '2021-03-29 00:33:44'),
(28, 33, '060660281348973162', '2', NULL, '2021-03-29 00:37:40', '2021-03-29 00:37:40'),
(29, 34, '060660973849507063', '2', NULL, '2021-04-07 12:28:20', '2021-04-07 12:28:20'),
(30, 35, '060660974149507463', '2', NULL, '2021-04-07 12:31:02', '2021-04-07 12:31:02'),
(31, 36, '060660974249507563', '2', NULL, '2021-04-07 12:31:21', '2021-04-07 12:31:21'),
(32, 37, '060660974549507864', '2', NULL, '2021-04-07 12:32:11', '2021-04-07 12:32:11'),
(33, 38, '060660974649507964', '2', NULL, '2021-04-07 12:32:14', '2021-04-07 12:32:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_activate` int(11) NOT NULL DEFAULT 1,
  `pin_code` int(11) DEFAULT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `photo`, `phone`, `is_activate`, `pin_code`, `api_token`) VALUES
(1, 'AmrHussienHassan55566', 'amrrr@gmail.com', NULL, '$2y$10$Cdn4dLfm8IbELdjNy3USc.tdkcIptgaqen7oUXoTSNaoNsWOzx.cy', NULL, '2021-01-06 18:05:15', '2021-02-12 13:33:53', 'files/admin/images/users/160996351563894.png', '0148765489', 1, NULL, 'I8LDf4e8yPNGSbt5lh4IR3VUsQnlfXuSgY3hF2MNzFVesYUjePyjH6sB7qjt'),
(4, 'amrhussien', 'am@gamil.com', NULL, '$2y$10$YcvlKzf6.ZGNZLdyBa9tiu5BuJQA9402XXI8Wcz7NGcFSi3FgFztO', NULL, '2021-02-12 14:06:37', '2021-02-12 14:06:37', 'files/admin/images/users/161314599730999.jpg', '01533456789', 1, NULL, 'PjJN1sjddiZm6RV58rXuIMxj05ENZE0lsBOlVxm7cUUJldvpHHy9nwCYdtwk'),
(6, 'ahmed500', 'ahmed400@gmail.com', NULL, '$2y$10$yUPMz.9e8aB0aPV/kTKxfeMH5pRyr9Fhc3LmHYo6NzVcAQaK3Awgu', NULL, '2021-03-25 04:37:43', '2021-03-27 20:42:21', 'files/admin/images/users/161688486373888.jpg', '1231235', 1, NULL, 'z29dor8ftkBLccoGTTw0dcvojASMA2oUZb9O9vzlYKrb9WRYsZajXsiQCvJS'),
(8, 'eeehmed ahemd', 'eehmedu@gmail.com', NULL, '$2y$10$9BCGo0LSrulBEyf3vwOwauVvS41/1Z2ebAy.EFA9jWRLWfg5jgWB6', NULL, '2021-03-27 14:50:19', '2021-03-27 14:50:19', 'files/admin/images/users/161686381958200.png', '1231235789', 1, NULL, 'dS38RQYR7NOxUs81xhvEmRT88bY733tkn7P8YLQpKQfn7fYkRFtNnuqp2Y5g');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_cost` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minimum_order` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_activate` int(11) NOT NULL DEFAULT 1,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'close',
  `special_vendor` int(11) NOT NULL DEFAULT 0,
  `pin_code` int(11) DEFAULT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `created_at`, `updated_at`, `name`, `email`, `phone`, `password`, `photo`, `address`, `delivery_cost`, `minimum_order`, `is_activate`, `state`, `special_vendor`, `pin_code`, `api_token`) VALUES
(4, '2021-01-07 11:31:43', '2021-02-14 13:43:09', 'AmrHussienHassan', 'amrhuusien999@gmail.com', '0201867608', '$2y$10$IxYDXmWlV07prkjgVaRuP.oTlvGfK1wPEwj66jgI9dCdBxC7nySb2', 'files/admin/images/vendors/161036951953174.png', 'cairo', '100', '200', 1, 'close', 1, NULL, 'I8LDf4e8yPNGSbt5lh4IR3VUsQnlfXuSgY3hF2MNzFVesYUjePyjH6sB7iRf'),
(6, '2021-02-14 21:34:51', '2021-02-14 21:35:05', 'momomomo', 'mo@gamil.com', '01533456789000', '$2y$10$UVRT6/V7F1cDz2u7aLn8V.YpfD4Ll0yh0aMssviSfMXFPWGkovnny', 'files/admin/images/vendors/161334569168723.jpg', 'cairo', '50', '200', 1, 'close', 1, NULL, 'ZofoYyi6FjlfqXFVLNyMDVgtKjdv207s8Pbbw9h2xvZ5S0Fdlu6nwSAGnTM5'),
(7, '2021-03-25 02:35:52', '2021-03-25 02:35:52', 'ahmed ahemd', 'ahmed@gmail.com', '123123', '$2y$10$qBYqHWh4/ECBB12o.vrKB.oiGWUD3OPPjNIdPezcjZTb86n7Rd2CS', 'files/admin/images/vendors/161664695259448.png', 'cairo', '50', '500', 1, 'close', 0, NULL, '1bePmNhdZYb03FXa1z9IJf5LSrRwlwBDwrz1GaSl1uPCHJLTBl7XX7MxkvQx'),
(10, '2021-03-25 04:03:49', '2021-03-25 04:03:49', 'ahmed ahemd', 'ahmed@gmail.com', '123123', '$2y$10$C9GwMcsaMDhA52CdXfm4SuLzL8mS/dgDqp.59ggZQj1WTbkqMz3Bi', 'files/admin/images/vendors/161665222983003.jpg', 'cairo', '50', '500', 1, 'close', 0, NULL, 'Axa1qzvfhHoILTcAv02FWDJE1O68p9sUpKq9h6X0J80AOrNfemExye9eeG6a'),
(11, '2021-03-25 04:36:11', '2021-03-25 14:35:28', 'ahmed500', 'ahmedu@gmail.com', '12345', '$2y$10$8.yjBcRrz/x/nlzajwh/P.sziP6FGxBA9ZV5fyI8HRBQwWyLfQ5PC', 'files/admin/images/vendors/161668975336419.jpg', 'cairo', '100', '500', 1, 'open', 0, NULL, 'pkSCZduRSsT4E59XTC2BhdkcHDUfDa3Wekojcl8qG03LAPnHC0CFwGFprcLs');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_translations`
--
ALTER TABLE `attribute_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attribute_translations_attribute_id_locale_unique` (`attribute_id`,`locale`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_translations`
--
ALTER TABLE `brand_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brand_translations_brand_id_locale_unique` (`brand_id`,`locale`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_translations_category_id_locale_unique` (`category_id`,`locale`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorates`
--
ALTER TABLE `favorates`
  ADD PRIMARY KEY (`user_id`,`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `option_translations`
--
ALTER TABLE `option_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `option_translations_option_id_locale_unique` (`option_id`,`locale`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_id`,`product_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_method_translations`
--
ALTER TABLE `payment_method_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_method_translations_payment_method_id_locale_unique` (`payment_method_id`,`locale`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_route_name_unique` (`name`,`route_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_translations`
--
ALTER TABLE `product_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_translations_product_id_locale_unique` (`product_id`,`locale`),
  ADD KEY `product_translations_locale_unique` (`locale`) USING BTREE;

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_translations`
--
ALTER TABLE `slider_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slider_translations_slider_id_locale_unique` (`slider_id`,`locale`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags_translations`
--
ALTER TABLE `tags_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_translations_tag_id_locale_unique` (`tag_id`,`locale`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_order_id_unique` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `attribute_translations`
--
ALTER TABLE `attribute_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `brand_translations`
--
ALTER TABLE `brand_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category_translations`
--
ALTER TABLE `category_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `option_translations`
--
ALTER TABLE `option_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_method_translations`
--
ALTER TABLE `payment_method_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `product_tags`
--
ALTER TABLE `product_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_translations`
--
ALTER TABLE `product_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `slider_translations`
--
ALTER TABLE `slider_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tags_translations`
--
ALTER TABLE `tags_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_translations`
--
ALTER TABLE `attribute_translations`
  ADD CONSTRAINT `attribute_translations_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `brand_translations`
--
ALTER TABLE `brand_translations`
  ADD CONSTRAINT `brand_translations_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD CONSTRAINT `category_translations_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `option_translations`
--
ALTER TABLE `option_translations`
  ADD CONSTRAINT `option_translations_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_method_translations`
--
ALTER TABLE `payment_method_translations`
  ADD CONSTRAINT `payment_method_translations_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_translations`
--
ALTER TABLE `product_translations`
  ADD CONSTRAINT `product_translations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `slider_translations`
--
ALTER TABLE `slider_translations`
  ADD CONSTRAINT `slider_translations_slider_id_foreign` FOREIGN KEY (`slider_id`) REFERENCES `sliders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tags_translations`
--
ALTER TABLE `tags_translations`
  ADD CONSTRAINT `tags_translations_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
