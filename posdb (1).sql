-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2021 at 09:33 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `posdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Madina Venture', 'madina-venture', 'ajwa-dates.png', NULL, '2021-03-12 03:31:34', '2021-03-12 07:05:23');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `parent_category_id` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `is_published`, `parent_category_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Dates', 'dates', 'dates.jpg', 1, 0, NULL, '2021-03-12 03:30:39', '2021-03-12 07:04:27');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `number`, `address`, `email`, `create_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'walk in customer', '0900', 'Walk In', 'ejazhamza524@gmail.com', 15, NULL, '2021-03-12 04:19:47', '2021-03-15 09:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `create_by` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `create_by`, `warehouse_id`, `category_id`, `amount`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 15, 2, 1, 100, 'ejaz', NULL, '2021-03-15 05:54:04', '2021-03-15 05:54:04'),
(2, 15, 2, 2, 80, '90', NULL, '2021-03-16 02:40:17', '2021-03-16 02:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `create_by` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `create_by`, `code`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 15, 'Office', 'Office Expense', NULL, '2021-03-15 05:53:34', '2021-03-15 05:53:34'),
(2, 15, 'office 2', 'Hamza', NULL, '2021-03-16 02:39:53', '2021-03-16 02:39:53');

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
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `slug`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'super-admin', NULL, NULL, '2020-02-29 03:31:02', '2020-09-08 00:34:56'),
(5, 'Support Staff', 'support-staff', NULL, NULL, '2020-03-12 08:51:11', '2021-03-12 09:42:18'),
(6, 'Testing Group', 'testing-group', NULL, NULL, '2021-03-12 05:52:18', '2021-03-12 05:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `group_has_permissions`
--

CREATE TABLE `group_has_permissions` (
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_has_permissions`
--

INSERT INTO `group_has_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 6),
(5, 7),
(5, 8),
(5, 9),
(5, 10),
(5, 11),
(5, 12),
(5, 13),
(5, 14),
(5, 15),
(5, 16),
(5, 17),
(5, 18),
(5, 19),
(5, 20),
(5, 21),
(5, 22),
(5, 23),
(5, 29),
(5, 30),
(5, 31),
(5, 32),
(5, 37),
(5, 38),
(5, 39),
(5, 40),
(5, 41),
(5, 42),
(5, 43),
(5, 44),
(5, 45),
(5, 46),
(5, 47),
(5, 48),
(5, 61),
(5, 62),
(5, 63),
(5, 64),
(5, 65),
(5, 66),
(5, 67),
(5, 68),
(6, 11);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `image`, `created_at`, `updated_at`) VALUES
(2, 'English', 'en', 'Flag_of_the_United_States.png', '2020-03-06 23:33:56', '2020-03-06 23:33:56');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_03_16_005237_create_permissions_table', 1),
(4, '2019_03_16_005538_create_user_has_permissions_table', 1),
(5, '2019_03_16_005634_create_groups_table', 1),
(6, '2019_03_16_005759_create_group_has_permissions_table', 1),
(7, '2019_03_16_005834_create_user_has_groups_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2020_02_18_053228_create_categories_table', 1),
(10, '2020_02_18_053331_create_units_table', 1),
(11, '2020_02_18_053439_create_brands_table', 1),
(12, '2020_02_18_114744_create_taxes_table', 1),
(13, '2020_02_18_114745_create_products_table', 1),
(14, '2020_02_19_070401_create_ware_houses_table', 1),
(15, '2020_02_19_091619_create_stocks_table', 1),
(16, '2020_02_20_053849_create_stock_products_table', 1),
(17, '2020_02_20_070226_create_suppliers_table', 1),
(23, '2020_02_22_095542_create_customers_table', 1),
(24, '2020_02_22_100845_create_product_stocks_table', 1),
(25, '2020_02_24_091846_create_sales_table', 1),
(26, '2020_02_24_092016_create_sale_products_table', 1),
(27, '2020_02_25_044238_create_expense_categories_table', 1),
(28, '2020_02_25_044245_create_expenses_table', 1),
(30, '2020_02_20_121447_create_purchases_table', 2),
(31, '2020_02_20_122742_create_purchase_payments_table', 2),
(32, '2020_02_20_123342_create_purchase_products_table', 2),
(34, '2020_02_27_043200_create_organizations_table', 3),
(35, '2020_03_07_051551_create_languages_table', 4),
(37, '2020_02_20_090857_create_quotations_table', 5),
(38, '2020_02_20_091058_create_quotation_products_table', 6),
(41, '2020_09_01_025101_create_stock_adjustments_table', 7),
(42, '2020_09_01_025206_create_stock_adjustment_products_table', 7),
(44, '2020_09_08_051945_create_return_products_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '$',
  `align` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `logo`, `email`, `phone`, `about`, `header`, `footer`, `symbol`, `align`, `created_at`, `updated_at`) VALUES
(1, 'Dates', '1615558981.png', 'ejazhamza524@gmail.com', '03004336883', NULL, NULL, NULL, ' PKR ', '0', NULL, '2021-03-12 09:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@example.com', '$2y$10$S3B2cj0MdCzqF5XfPFPHYOhBTAY7H.tT4jg9Zwq5KXoEk144nuuuO', '2020-03-13 05:34:53'),
('admin@mail.com', '$2y$10$o81N3OJwd0APe9Rgy5OkdeI5oOSSblB.p/1UWZ/77NASWPYc8d5fa', '2020-05-20 10:22:24'),
('admin@example.com', '$2y$10$S3B2cj0MdCzqF5XfPFPHYOhBTAY7H.tT4jg9Zwq5KXoEk144nuuuO', '2020-03-13 05:34:53'),
('admin@mail.com', '$2y$10$o81N3OJwd0APe9Rgy5OkdeI5oOSSblB.p/1UWZ/77NASWPYc8d5fa', '2020-05-20 10:22:24'),
('admin@example.com', '$2y$10$S3B2cj0MdCzqF5XfPFPHYOhBTAY7H.tT4jg9Zwq5KXoEk144nuuuO', '2020-03-13 05:34:53'),
('admin@mail.com', '$2y$10$o81N3OJwd0APe9Rgy5OkdeI5oOSSblB.p/1UWZ/77NASWPYc8d5fa', '2020-05-20 10:22:24'),
('admin@example.com', '$2y$10$S3B2cj0MdCzqF5XfPFPHYOhBTAY7H.tT4jg9Zwq5KXoEk144nuuuO', '2020-03-13 05:34:53'),
('admin@mail.com', '$2y$10$o81N3OJwd0APe9Rgy5OkdeI5oOSSblB.p/1UWZ/77NASWPYc8d5fa', '2020-05-20 10:22:24');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'organization', 'organization', NULL, NULL, '2020-02-29 01:55:03', '2020-02-29 01:55:03'),
(2, 'report', 'report', NULL, NULL, '2020-02-29 03:12:22', '2020-02-29 03:12:22'),
(3, 'expense-create', 'expense-create', NULL, NULL, '2020-02-29 03:12:31', '2020-02-29 03:12:31'),
(4, 'expense-show', 'expense-show', NULL, NULL, '2020-02-29 03:12:39', '2020-02-29 03:12:39'),
(5, 'expense-update', 'expense-update', NULL, NULL, '2020-02-29 03:12:47', '2020-02-29 03:12:47'),
(6, 'expense-destroy', 'expense-destroy', NULL, NULL, '2020-02-29 03:12:56', '2020-02-29 03:12:56'),
(7, 'expense-categories-create', 'expense-categories-create', NULL, NULL, '2020-02-29 03:13:05', '2020-02-29 03:13:05'),
(8, 'expense-categories-update', 'expense-categories-update', NULL, NULL, '2020-02-29 03:13:14', '2020-02-29 03:13:14'),
(9, 'expense-categories-destroy', 'expense-categories-destroy', NULL, NULL, '2020-02-29 03:13:22', '2020-02-29 03:13:22'),
(10, 'expense-categories-show', 'expense-categories-show', NULL, NULL, '2020-02-29 03:13:30', '2020-02-29 03:13:30'),
(11, 'pos', 'pos', NULL, NULL, '2020-02-29 03:13:38', '2020-02-29 03:13:38'),
(12, 'customer-create', 'customer-create', NULL, NULL, '2020-02-29 03:13:46', '2020-02-29 03:13:46'),
(13, 'customer-update', 'customer-update', NULL, NULL, '2020-02-29 03:13:54', '2020-02-29 03:13:54'),
(14, 'customer-show', 'customer-show', NULL, NULL, '2020-02-29 03:14:02', '2020-02-29 03:14:02'),
(15, 'customer-destroy', 'customer-destroy', NULL, NULL, '2020-02-29 03:14:09', '2020-02-29 03:14:09'),
(16, 'purchase', 'purchase', NULL, NULL, '2020-02-29 03:14:29', '2020-02-29 03:14:29'),
(17, 'purchase-destroy', 'purchase-destroy', NULL, NULL, '2020-02-29 03:14:38', '2020-02-29 03:14:38'),
(18, 'purchase-show', 'purchase-show', NULL, NULL, '2020-02-29 03:14:47', '2020-02-29 03:14:47'),
(19, 'purchase-create', 'purchase-create', NULL, NULL, '2020-02-29 03:14:55', '2020-02-29 03:14:55'),
(20, 'quotation-create', 'quotation-create', NULL, NULL, '2020-02-29 03:15:04', '2020-02-29 03:15:04'),
(21, 'quotation-show', 'quotation-show', NULL, NULL, '2020-02-29 03:15:12', '2020-02-29 03:15:12'),
(22, 'quotation-destroy', 'quotation-destroy', NULL, NULL, '2020-02-29 03:15:20', '2020-02-29 03:15:20'),
(23, 'quotation', 'quotation', NULL, NULL, '2020-02-29 03:15:29', '2020-02-29 03:15:29'),
(24, 'supplier-create', 'supplier-create', NULL, NULL, '2020-02-29 03:15:38', '2020-02-29 03:15:38'),
(25, 'supplier-update', 'supplier-update', NULL, NULL, '2020-02-29 03:15:45', '2020-02-29 03:15:45'),
(26, 'supplier-show', 'supplier-show', NULL, NULL, '2020-02-29 03:15:53', '2020-02-29 03:15:53'),
(27, 'supplier-destroy', 'supplier-destroy', NULL, NULL, '2020-02-29 03:16:04', '2020-02-29 03:16:04'),
(28, 'stock', 'stock', NULL, NULL, '2020-02-29 03:16:12', '2020-02-29 03:16:12'),
(29, 'stock-create', 'stock-create', NULL, NULL, '2020-02-29 03:16:20', '2020-02-29 03:16:20'),
(30, 'stock-update', 'stock-update', NULL, NULL, '2020-02-29 03:16:31', '2020-02-29 03:16:31'),
(31, 'stock-destroy', 'stock-destroy', NULL, NULL, '2020-02-29 03:16:40', '2020-02-29 03:16:40'),
(32, 'stock-show', 'stock-show', NULL, NULL, '2020-02-29 03:16:48', '2020-02-29 03:16:48'),
(33, 'warehouse-create', 'warehouse-create', NULL, NULL, '2020-02-29 03:17:37', '2020-02-29 03:17:37'),
(34, 'warehouse-update', 'warehouse-update', NULL, NULL, '2020-02-29 03:17:46', '2020-02-29 03:17:46'),
(35, 'warehouse-destroy', 'warehouse-destroy', NULL, NULL, '2020-02-29 03:17:55', '2020-02-29 03:17:55'),
(36, 'warehouse-show', 'warehouse-show', NULL, NULL, '2020-02-29 03:18:09', '2020-02-29 03:18:09'),
(37, 'brand-create', 'brand-create', NULL, NULL, '2020-02-29 03:18:16', '2020-02-29 03:18:16'),
(38, 'brand-destroy', 'brand-destroy', NULL, NULL, '2020-02-29 03:18:24', '2020-02-29 03:18:24'),
(39, 'brand-update', 'brand-update', NULL, NULL, '2020-02-29 03:18:32', '2020-02-29 03:18:32'),
(40, 'brand-show', 'brand-show', NULL, NULL, '2020-02-29 03:18:40', '2020-02-29 03:18:40'),
(41, 'unit-create', 'unit-create', NULL, NULL, '2020-02-29 03:18:48', '2020-02-29 03:18:48'),
(42, 'unit-update', 'unit-update', NULL, NULL, '2020-02-29 03:19:30', '2020-02-29 03:19:30'),
(43, 'unit-destroy', 'unit-destroy', NULL, NULL, '2020-02-29 03:19:37', '2020-02-29 03:19:37'),
(44, 'unit-show', 'unit-show', NULL, NULL, '2020-02-29 03:19:43', '2020-02-29 03:19:43'),
(45, 'category-create', 'category-create', NULL, NULL, '2020-02-29 03:19:49', '2020-02-29 03:19:49'),
(46, 'category-update', 'category-update', NULL, NULL, '2020-02-29 03:19:56', '2020-02-29 03:19:56'),
(47, 'category-destroy', 'category-destroy', NULL, NULL, '2020-02-29 03:20:01', '2020-02-29 03:20:01'),
(48, 'category-show', 'category-show', NULL, NULL, '2020-02-29 03:20:08', '2020-02-29 03:20:08'),
(49, 'user-create', 'user-create', NULL, NULL, '2020-02-29 03:20:15', '2020-02-29 03:20:15'),
(50, 'user-update', 'user-update', NULL, NULL, '2020-02-29 03:20:20', '2020-02-29 03:20:20'),
(51, 'user-show', 'user-show', NULL, NULL, '2020-02-29 03:20:25', '2020-02-29 03:20:25'),
(52, 'user-destroy', 'user-destroy', NULL, NULL, '2020-02-29 03:20:32', '2020-02-29 03:20:32'),
(53, 'permission-destroy', 'permission-destroy', NULL, NULL, '2020-02-29 03:20:39', '2020-02-29 03:20:39'),
(54, 'permission-create', 'permission-create', NULL, NULL, '2020-02-29 03:20:45', '2020-02-29 03:20:45'),
(55, 'permission-update', 'permission-update', NULL, NULL, '2020-02-29 03:22:27', '2020-02-29 03:22:27'),
(56, 'permission-show', 'permission-show', NULL, NULL, '2020-02-29 03:22:59', '2020-02-29 03:22:59'),
(57, 'group-destroy', 'group-destroy', NULL, NULL, '2020-02-29 03:23:07', '2020-02-29 03:23:07'),
(58, 'group-create', 'group-create', NULL, NULL, '2020-02-29 03:23:15', '2020-02-29 03:23:15'),
(59, 'group-update', 'group-update', NULL, NULL, '2020-02-29 03:23:22', '2020-02-29 03:23:22'),
(60, 'group-show', 'group-show', NULL, NULL, '2020-02-29 03:23:30', '2020-02-29 03:23:30'),
(61, 'tax-create', 'tax-create', NULL, NULL, '2020-02-29 03:55:28', '2020-02-29 03:55:28'),
(62, 'tax-update', 'tax-update', NULL, NULL, '2020-02-29 03:55:50', '2020-02-29 03:55:50'),
(63, 'tax-destroy', 'tax-destroy', NULL, NULL, '2020-02-29 03:56:06', '2020-02-29 03:56:06'),
(64, 'tax-show', 'tax-show', NULL, NULL, '2020-02-29 03:56:25', '2020-02-29 03:56:25'),
(65, 'product-create', 'product-create', NULL, NULL, '2020-02-29 04:12:48', '2020-02-29 04:12:48'),
(66, 'product-update', 'product-update', NULL, NULL, '2020-02-29 04:13:02', '2020-02-29 04:13:02'),
(67, 'product-show', 'product-show', NULL, NULL, '2020-02-29 04:13:37', '2020-02-29 04:13:37'),
(68, 'product-destroy', 'product-destroy', NULL, NULL, '2020-02-29 04:13:50', '2020-02-29 04:13:50'),
(69, 'mail', 'mail', NULL, NULL, '2020-03-09 00:57:12', '2020-03-09 00:57:12'),
(70, 'language', 'language', NULL, NULL, '2020-03-09 00:57:24', '2020-03-09 00:57:24'),
(71, 'pos-delete', 'pos-delete', NULL, NULL, '2020-03-16 04:00:18', '2020-03-16 04:00:18'),
(72, 'stock-adjustment-return', 'stock-return', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `price` double NOT NULL,
  `unit_price` double DEFAULT NULL,
  `alert_quantity` int(11) NOT NULL DEFAULT 0,
  `type` enum('Standard','Combo','Digital') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_type` enum('Exclusive','Inclusive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `tax_id` bigint(20) UNSIGNED DEFAULT NULL,
  `create_by` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `slug`, `description`, `cost`, `price`, `unit_price`, `alert_quantity`, `type`, `tax_type`, `image`, `is_featured`, `is_published`, `tax_id`, `create_by`, `brand_id`, `unit_id`, `category_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Ajwa Dates', 'ajwa-1', 'ajwa-dates', NULL, 1000, 1500, 1500, 10, 'Standard', 'Inclusive', 'ajwa-dates.png', 0, 1, NULL, 15, 1, 1, 1, NULL, '2021-03-12 03:34:23', '2021-03-12 03:34:23'),
(2, 'Ajwa', 'dates-1', 'ajwa', NULL, 2000, 2650, 2650, 5, 'Standard', 'Inclusive', 'ajwa.jpg', 0, 1, NULL, 15, 1, 1, 1, NULL, '2021-03-12 07:10:15', '2021-03-12 07:10:15'),
(3, 'Akhlas', 'dates-2', 'akhlas', NULL, 2500, 2957, 2957, 5, 'Standard', 'Inclusive', 'akhlas.jpg', 0, 1, NULL, 15, 1, 1, 1, NULL, '2021-03-12 07:13:39', '2021-03-12 07:13:39'),
(4, 'Amber', 'dates-3', 'amber', NULL, 2500, 2957, 2957, 5, 'Standard', 'Inclusive', 'amber.jpg', 0, 1, NULL, 15, 1, 1, 1, NULL, '2021-03-12 07:14:35', '2021-03-12 07:14:35'),
(5, 'Barni', 'dates-4', 'barni', NULL, 700, 1215, 1215, 5, 'Standard', 'Inclusive', 'barni.jpg', 0, 1, NULL, 15, 1, 1, 1, NULL, '2021-03-12 07:16:17', '2021-03-12 07:16:17'),
(6, 'Kudhri', 'dates-5', 'kudhri', NULL, 900, 1315, 1315, 5, 'Standard', 'Inclusive', 'kudhri.jpg', 0, 1, NULL, 15, 1, 1, 1, NULL, '2021-03-12 07:17:07', '2021-03-12 07:17:07'),
(7, 'Mabroom', 'dates-6', 'mabroom', NULL, 2000, 2511, 2511, 5, 'Standard', 'Inclusive', 'mabroom.jpg', 0, 1, NULL, 15, 1, 1, 1, NULL, '2021-03-12 07:18:30', '2021-03-12 07:18:30'),
(8, 'Mashrooq', 'dates-7', 'mashrooq', NULL, 1500, 1913, 1913, 5, 'Standard', 'Inclusive', 'mashrooq.jpg', 0, 1, NULL, 15, 1, 1, 1, NULL, '2021-03-12 07:20:03', '2021-03-12 07:20:03'),
(10, 'Medjool', 'dates-8', 'medjool', NULL, 2200, 2773, 2773, 5, 'Standard', 'Inclusive', 'medjool.jpg', 0, 1, NULL, 15, 1, 1, 1, NULL, '2021-03-12 07:22:07', '2021-03-12 07:22:07'),
(12, 'Rabia', 'dates-9', 'rabia', NULL, 1100, 1315, 1315, 5, 'Standard', 'Inclusive', 'rabia.jpg', 0, 1, NULL, 15, 1, 1, 1, NULL, '2021-03-12 07:24:23', '2021-03-12 07:24:23'),
(13, 'Safawi/Kalima', 'dates-10', 'safawikalima', NULL, 1600, 2021, 2021, 5, 'Standard', 'Inclusive', 'safawikalima.jpg', 0, 1, NULL, 15, 1, 1, 1, NULL, '2021-03-12 07:26:33', '2021-03-12 07:26:33'),
(14, 'Shalbi', 'dates-11', 'shalbi', NULL, 1500, 1859, 1859, 5, 'Standard', 'Inclusive', 'shalbi.jpg', 0, 1, NULL, 15, 1, 1, 1, NULL, '2021-03-12 07:27:44', '2021-03-12 07:27:44'),
(16, 'Sughai', 'dates-12', 'sughai', NULL, 1500, 2021, 2021, 5, 'Standard', 'Inclusive', 'sughai.png', 0, 1, NULL, 15, 1, 1, 1, NULL, '2021-03-12 07:29:30', '2021-03-12 07:29:30'),
(17, 'Sukhal', 'dates-13', 'sukhal', NULL, 1000, 1424, 1424, 5, 'Standard', 'Inclusive', 'sukhal.jpg', 0, 1, NULL, 15, 1, 1, 1, NULL, '2021-03-12 07:31:03', '2021-03-12 07:31:03'),
(18, 'Sukkari Mufatal', 'dates-14', 'sukkari-mufatal', NULL, 1500, 1760, 1760, 5, 'Standard', 'Inclusive', 'sukkari-mufatal.jpg', 0, 1, NULL, 15, 1, 1, 1, NULL, '2021-03-12 07:32:32', '2021-03-12 07:32:32'),
(19, 'Dummy', 'uqfs223', 'dummy', NULL, 123, 1234, 1234, 5, 'Standard', 'Inclusive', 'dummy.png', 0, 1, NULL, 15, 1, 1, 1, NULL, '2021-03-15 02:38:11', '2021-03-15 02:38:11'),
(20, 'Ajwa-Small', 'ajwa-small', 'ajwa-small', NULL, 1500, 2036, 2036, 3, 'Standard', 'Inclusive', 'ajwa-small.jpg', 0, 1, NULL, 15, 1, 1, 1, NULL, '2021-03-15 06:50:26', '2021-03-15 06:50:26'),
(22, 'Ajwa-Small', 'ajwa-small1', 'ajwa-small', NULL, 1500, 2036, 2036, 3, 'Standard', 'Inclusive', 'ajwa-small.jpg', 0, 1, NULL, 15, 1, 1, 1, NULL, '2021-03-15 06:51:05', '2021-03-15 06:51:05'),
(23, 'test', 'uqfs2', 'test', NULL, 1100, 1320, 1200, 5, 'Standard', 'Exclusive', 'test.jpg', 0, 1, 1, 15, 1, 1, 1, NULL, '2021-03-18 05:50:47', '2021-03-18 05:50:47'),
(24, 'Hamza', 'Dummy', 'hamza', NULL, 69.6, 116, 100, 5, 'Standard', 'Exclusive', 'hamza.jpg', 0, 1, 2, 15, 1, 1, 1, NULL, '2021-03-19 02:18:32', '2021-03-19 02:18:32'),
(26, 'Test2', 'test2', 'test2', NULL, 110, 220, 200, 5, 'Standard', 'Exclusive', 'test2.jpg', 0, 1, 1, 15, 1, 1, 1, NULL, '2021-03-25 07:32:16', '2021-03-25 07:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `product_stocks`
--

CREATE TABLE `product_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` double DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_stocks`
--

INSERT INTO `product_stocks` (`id`, `product_id`, `warehouse_id`, `quantity`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 136, NULL, '2021-03-12 03:42:35', '2021-03-26 07:01:19'),
(2, 1, 2, 36, NULL, '2021-03-12 04:10:15', '2021-03-19 02:27:51'),
(3, 19, 1, 74, NULL, '2021-03-15 02:38:53', '2021-03-26 05:29:26'),
(4, 19, 2, -1, NULL, '2021-03-15 05:53:04', '2021-03-18 04:44:06'),
(5, 23, 2, 55, NULL, '2021-03-18 05:54:08', '2021-03-30 06:48:25'),
(6, 24, 1, 0, NULL, '2021-03-19 02:19:30', '2021-03-25 06:22:32'),
(7, 26, 1, 310, NULL, '2021-03-25 09:05:12', '2021-03-27 04:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `create_by` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Received','Pending','Ordered') COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_id` bigint(20) UNSIGNED DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `shipping_cost` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `pro_total_price` double DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_paid` double DEFAULT NULL,
  `total_due` double DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `warehouse_id`, `create_by`, `supplier_id`, `status`, `document`, `tax_id`, `discount`, `shipping_cost`, `total_amount`, `pro_total_price`, `description`, `total_paid`, `total_due`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 15, 1, 'Received', '1615538555.png', NULL, 0, 100, 100000, NULL, NULL, 100000, 0, NULL, '2021-03-12 03:42:35', '2021-03-12 03:42:35'),
(2, 1, 15, 1, 'Received', '1615793933.PNG', NULL, NULL, 100, 12300, NULL, NULL, 1200, -11100, NULL, '2021-03-15 02:38:53', '2021-03-15 02:38:53'),
(3, 1, 15, 1, 'Received', NULL, NULL, NULL, NULL, 10000, NULL, NULL, 1000, -9000, NULL, '2021-03-17 03:31:26', '2021-03-17 03:31:26'),
(4, 2, 15, 1, 'Received', NULL, NULL, NULL, NULL, 110000, NULL, NULL, 1100000, 990000, NULL, '2021-03-18 05:54:08', '2021-03-18 05:54:08'),
(5, 1, 15, 1, 'Received', '1616138370.jpg', NULL, NULL, NULL, 696, NULL, NULL, 696, 0, NULL, '2021-03-19 02:19:30', '2021-03-19 02:19:30'),
(6, 1, 15, 1, 'Received', NULL, NULL, NULL, 0, 73000, NULL, NULL, 90, -72910, NULL, '2021-03-24 03:08:23', '2021-03-24 03:08:23'),
(7, 1, 15, 1, 'Received', NULL, NULL, NULL, 0, 73000, NULL, NULL, 90, -72910, NULL, '2021-03-24 03:08:25', '2021-03-24 03:08:25'),
(8, 1, 15, 1, 'Received', NULL, NULL, NULL, NULL, 7810, NULL, NULL, 10, -7800, NULL, '2021-03-25 09:05:12', '2021-03-25 09:05:12'),
(9, 1, 15, 1, 'Received', NULL, NULL, NULL, NULL, 7810, NULL, NULL, 10, -7800, NULL, '2021-03-25 09:05:15', '2021-03-25 09:05:15'),
(10, 1, 15, 1, 'Received', NULL, NULL, NULL, NULL, 7810, NULL, NULL, 10, -7800, NULL, '2021-03-25 09:05:19', '2021-03-25 09:05:19'),
(11, 1, 15, 1, 'Received', NULL, NULL, NULL, NULL, 7810, NULL, NULL, 10, -7800, NULL, '2021-03-25 09:05:25', '2021-03-25 09:05:25'),
(12, 1, 15, 1, 'Received', NULL, NULL, NULL, NULL, 7810, NULL, NULL, 10, -7800, NULL, '2021-03-25 09:05:31', '2021-03-25 09:05:31');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_payments`
--

CREATE TABLE `purchase_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `create_by` bigint(20) UNSIGNED NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `paid_amount` double NOT NULL,
  `due_amount` double NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_payments`
--

INSERT INTO `purchase_payments` (`id`, `purchase_id`, `create_by`, `paid`, `paid_amount`, `due_amount`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 15, 0, 100000, 0, NULL, '2021-03-12 03:42:35', '2021-03-12 03:42:35'),
(2, 2, 15, 0, 1200, -11100, NULL, '2021-03-15 02:38:53', '2021-03-15 02:38:53'),
(3, 3, 15, 0, 1000, -9000, NULL, '2021-03-17 03:31:26', '2021-03-17 03:31:26'),
(4, 4, 15, 0, 1100000, 990000, NULL, '2021-03-18 05:54:08', '2021-03-18 05:54:08'),
(5, 5, 15, 0, 696, 0, NULL, '2021-03-19 02:19:30', '2021-03-19 02:19:30'),
(6, 6, 15, 0, 90, -72910, NULL, '2021-03-24 03:08:23', '2021-03-24 03:08:23'),
(7, 7, 15, 0, 90, -72910, NULL, '2021-03-24 03:08:25', '2021-03-24 03:08:25'),
(8, 8, 15, 0, 10, -7800, NULL, '2021-03-25 09:05:12', '2021-03-25 09:05:12'),
(9, 9, 15, 0, 10, -7800, NULL, '2021-03-25 09:05:15', '2021-03-25 09:05:15'),
(10, 10, 15, 0, 10, -7800, NULL, '2021-03-25 09:05:19', '2021-03-25 09:05:19'),
(11, 11, 15, 0, 10, -7800, NULL, '2021-03-25 09:05:25', '2021-03-25 09:05:25'),
(12, 12, 15, 0, 10, -7800, NULL, '2021-03-25 09:05:31', '2021-03-25 09:05:31');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_products`
--

CREATE TABLE `purchase_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` double NOT NULL,
  `unit_price` double NOT NULL,
  `sub_price` double NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_products`
--

INSERT INTO `purchase_products` (`id`, `purchase_id`, `product_id`, `quantity`, `unit_price`, `sub_price`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 100, 1000, 100000, NULL, '2021-03-12 03:42:35', '2021-03-12 03:42:35'),
(2, 2, 19, 100, 123, 12300, NULL, '2021-03-15 02:38:53', '2021-03-15 02:38:53'),
(3, 3, 1, 10, 1000, 10000, NULL, '2021-03-17 03:31:26', '2021-03-17 03:31:26'),
(4, 4, 23, 100, 1100, 110000, NULL, '2021-03-18 05:54:08', '2021-03-18 05:54:08'),
(5, 5, 24, 10, 69.6, 696, NULL, '2021-03-19 02:19:30', '2021-03-19 02:19:30'),
(6, 6, 1, 73, 1000, 73000, NULL, '2021-03-24 03:08:23', '2021-03-24 03:08:23'),
(7, 7, 1, 73, 1000, 73000, NULL, '2021-03-24 03:08:25', '2021-03-24 03:08:25'),
(8, 8, 26, 71, 110, 7810, NULL, '2021-03-25 09:05:12', '2021-03-25 09:05:12'),
(9, 9, 26, 71, 110, 7810, NULL, '2021-03-25 09:05:15', '2021-03-25 09:05:15'),
(10, 10, 26, 71, 110, 7810, NULL, '2021-03-25 09:05:19', '2021-03-25 09:05:19'),
(11, 11, 26, 71, 110, 7810, NULL, '2021-03-25 09:05:25', '2021-03-25 09:05:25'),
(12, 12, 26, 71, 110, 7810, NULL, '2021-03-25 09:05:31', '2021-03-25 09:05:31');

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_by` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `it_sale` tinyint(1) NOT NULL DEFAULT 0,
  `total_price` double DEFAULT NULL,
  `discount` int(255) DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`id`, `name`, `create_by`, `customer_id`, `it_sale`, `total_price`, `discount`, `phone`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'location', 15, NULL, 0, 1500, NULL, '03004336883', NULL, NULL, '2021-03-16 02:34:20', '2021-03-16 02:34:20'),
(2, 'Hamza', 15, NULL, 0, 15000, NULL, '03004336883', NULL, NULL, '2021-03-17 03:29:30', '2021-03-17 03:29:30'),
(3, 'location', 15, NULL, 0, 1500, NULL, '03004336883', NULL, NULL, '2021-03-17 03:32:46', '2021-03-17 03:32:46'),
(4, 'Hamza', 15, NULL, 0, 2650, NULL, '0900088601', NULL, NULL, '2021-03-17 04:16:12', '2021-03-17 04:16:12'),
(5, 'test', 15, NULL, 0, 1500, NULL, '03004336883', NULL, NULL, '2021-03-17 05:26:28', '2021-03-17 05:26:28'),
(6, 'Hamza', 15, NULL, 0, 1500, NULL, '03004336883', NULL, NULL, '2021-03-17 05:27:39', '2021-03-17 05:27:39'),
(7, 'Hamza', 15, NULL, 0, 1500, NULL, '03004336883', NULL, NULL, '2021-03-17 05:31:37', '2021-03-17 05:31:37'),
(8, 'Hamza', 15, NULL, 0, 1500, 90, '03004336883', NULL, NULL, '2021-03-17 06:18:28', '2021-03-17 06:18:28'),
(9, 'Hamza', 15, NULL, 0, NULL, 90, '03004336883', NULL, NULL, '2021-03-17 06:20:30', '2021-03-17 06:20:30'),
(10, 'Hamza', 15, NULL, 0, 1410, 90, '03004336883', NULL, NULL, '2021-03-17 06:20:54', '2021-03-17 06:20:54'),
(11, 'testing', 15, NULL, 0, 4439, 9, '0900088601', NULL, '2021-03-17 07:00:45', '2021-03-17 06:52:20', '2021-03-17 07:00:45'),
(12, 'test', 15, NULL, 0, 4437, 10, '03004336883', NULL, NULL, '2021-03-17 08:33:29', '2021-03-17 08:33:29'),
(13, 'Dummy', 15, NULL, 0, NULL, NULL, '03004336883', NULL, NULL, '2021-03-18 04:33:08', '2021-03-18 04:33:08'),
(14, 'Dummy', 15, NULL, 0, 2734, NULL, '03004336883', NULL, NULL, '2021-03-18 04:41:06', '2021-03-18 04:41:06'),
(15, 'hamzasss', 15, NULL, 0, 4456, 1, '09090', NULL, NULL, '2021-03-18 04:52:22', '2021-03-18 04:52:22'),
(16, 'Test update', 15, NULL, 0, 1320, NULL, '09090909', NULL, NULL, '2021-03-26 06:21:28', '2021-03-26 06:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_products`
--

CREATE TABLE `quotation_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quotation_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` double NOT NULL,
  `unit_price` double NOT NULL,
  `sub_price` double NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotation_products`
--

INSERT INTO `quotation_products` (`id`, `quotation_id`, `product_id`, `quantity`, `unit_price`, `sub_price`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1500, 1500, NULL, '2021-03-16 02:34:20', '2021-03-16 02:34:20'),
(2, 2, 1, 10, 1500, 15000, NULL, '2021-03-17 03:29:30', '2021-03-17 03:29:30'),
(3, 3, 1, 1, 1500, 1500, NULL, '2021-03-17 03:32:46', '2021-03-17 03:32:46'),
(4, 4, 2, 1, 2650, 2650, NULL, '2021-03-17 04:16:12', '2021-03-17 04:16:12'),
(5, 5, 1, 1, 1500, 1500, NULL, '2021-03-17 05:26:28', '2021-03-17 05:26:28'),
(6, 6, 1, 1, 1500, 1500, NULL, '2021-03-17 05:27:39', '2021-03-17 05:27:39'),
(7, 7, 1, 1, 1500, 1500, NULL, '2021-03-17 05:31:37', '2021-03-17 05:31:37'),
(8, 8, 1, 1, 1500, 1500, NULL, '2021-03-17 06:18:28', '2021-03-17 06:18:28'),
(9, 10, 1, 1, 1500, 1500, NULL, '2021-03-17 06:20:54', '2021-03-17 06:20:54'),
(10, 11, 1, 1, 1500, 1500, '2021-03-17 07:00:45', '2021-03-17 06:52:20', '2021-03-17 07:00:45'),
(11, 11, 4, 1, 2957, 2957, '2021-03-17 07:00:45', '2021-03-17 06:52:20', '2021-03-17 07:00:45'),
(12, 12, 1, 1, 1500, 1500, NULL, '2021-03-17 08:33:29', '2021-03-17 08:33:29'),
(13, 12, 3, 1, 2957, 2957, NULL, '2021-03-17 08:33:29', '2021-03-17 08:33:29'),
(14, 14, 1, 1, 1500, 1500, NULL, '2021-03-18 04:41:06', '2021-03-18 04:41:06'),
(15, 14, 19, 1, 1234, 1234, NULL, '2021-03-18 04:41:06', '2021-03-18 04:41:06'),
(16, 15, 1, 1, 1500, 1500, NULL, '2021-03-18 04:52:22', '2021-03-18 04:52:22'),
(17, 15, 3, 1, 2957, 2957, NULL, '2021-03-18 04:52:22', '2021-03-18 04:52:22'),
(18, 16, 23, 1, 1320, 1320, NULL, '2021-03-26 06:21:28', '2021-03-26 06:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `return_products`
--

CREATE TABLE `return_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_products`
--

INSERT INTO `return_products` (`id`, `sale_id`, `product_id`, `amount`, `user_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 19, 1, 1500, 15, 1, '2021-03-15 05:55:39', '2021-03-15 05:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `create_by` bigint(20) UNSIGNED NOT NULL,
  `total_price` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  `total_item` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `total_tax` int(255) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `status_updated_by` int(255) DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `follow_comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `customer_id`, `create_by`, `total_price`, `price`, `total_item`, `discount`, `total_tax`, `status`, `status_updated_by`, `payment_method`, `payment_reference`, `follow_comment`, `paid_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(146, NULL, 15, 4274, 4274, 4, NULL, NULL, 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-26 05:27:26', '2021-03-26 05:27:26'),
(147, NULL, 15, 5594, 5594, 5, NULL, NULL, 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-26 05:29:26', '2021-03-26 05:29:26'),
(148, NULL, 15, NULL, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-26 05:55:02', '2021-03-26 05:55:02'),
(149, NULL, 15, 3520, 3520, 6, NULL, NULL, 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-26 05:56:30', '2021-03-26 05:56:30'),
(150, NULL, 15, NULL, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-26 05:57:23', '2021-03-26 05:57:23'),
(151, NULL, 15, NULL, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-26 05:57:51', '2021-03-26 05:57:51'),
(152, NULL, 15, 5900, 5900, 6, NULL, NULL, 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-26 05:58:54', '2021-03-26 05:58:54'),
(153, NULL, 15, 4456, 4457, NULL, 1, NULL, 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-26 06:18:50', '2021-03-26 06:18:50'),
(154, NULL, 15, 4456, 4457, NULL, 1, NULL, 'paid', 15, 'bank', '0900oio', 'ok', '2021-04-02 13:48:50', NULL, '2021-03-26 06:19:14', '2021-04-02 13:48:50'),
(155, NULL, 15, 1500, 1500, NULL, NULL, NULL, 'reciveable', 15, NULL, NULL, 'ok', '2021-04-02 13:26:11', NULL, '2021-03-26 06:20:30', '2021-04-02 13:26:11'),
(157, NULL, 15, 1320, 1320, NULL, NULL, NULL, 'paid', 15, 'bank', '90', 'ok', '2021-04-02 08:20:40', NULL, '2021-03-26 06:22:03', '2021-04-02 08:20:40'),
(158, NULL, 15, 1320, 1320, NULL, NULL, NULL, 'paid', 15, 'cash', '0900oio', 'ok', '2021-04-02 08:15:39', NULL, '2021-03-26 06:23:09', '2021-04-02 08:15:39'),
(171, 1, 15, 1320, 1320, 1, NULL, 120, 'paid', 15, 'cash', '543', 'ok', '2021-04-02 06:56:27', NULL, '2021-03-30 06:48:25', '2021-04-02 06:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `sale_products`
--

CREATE TABLE `sale_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `sub_price` double NOT NULL,
  `unit_price` double NOT NULL,
  `cost_price_total` decimal(10,0) DEFAULT NULL,
  `tax_id` int(255) DEFAULT NULL,
  `tax_amount` int(11) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_products`
--

INSERT INTO `sale_products` (`id`, `sale_id`, `product_id`, `quantity`, `sub_price`, `unit_price`, `cost_price_total`, `tax_id`, `tax_amount`, `warehouse_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(118, 147, 1, 1, 1500, 1500, '1000', NULL, 100, 1, NULL, '2021-03-26 05:29:26', '2021-03-26 05:29:26'),
(119, 147, 23, 2, 2640, 1320, '2200', 1, NULL, 2, NULL, '2021-03-26 05:29:26', '2021-03-26 05:29:26'),
(120, 147, 26, 1, 220, 220, '110', 1, NULL, 1, NULL, '2021-03-26 05:29:26', '2021-03-26 05:29:26'),
(121, 147, 19, 1, 1234, 1234, '123', NULL, NULL, 1, NULL, '2021-03-26 05:29:26', '2021-03-26 05:29:26'),
(122, 149, 23, 2, 2640, 1320, '2200', 1, NULL, 2, NULL, '2021-03-26 05:56:30', '2021-03-26 05:56:30'),
(123, 149, 26, 4, 880, 220, '440', 1, NULL, 1, NULL, '2021-03-26 05:56:30', '2021-03-26 05:56:30'),
(124, 152, 26, 2, 440, 220, '220', 1, 40, 1, NULL, '2021-03-26 05:58:54', '2021-03-26 05:58:54'),
(125, 152, 23, 3, 3960, 1320, '3300', 1, 360, 2, NULL, '2021-03-26 05:58:54', '2021-03-26 05:58:54'),
(126, 152, 1, 1, 1500, 1500, '1000', NULL, 0, 1, NULL, '2021-03-26 05:58:54', '2021-03-26 05:58:54'),
(128, 158, 23, 1, 1320, 1320, '1100', NULL, NULL, 2, NULL, '2021-03-26 06:23:09', '2021-03-26 06:23:09'),
(145, 171, 23, 1, 1320, 1320, '1100', 1, 120, 2, NULL, '2021-03-30 06:48:25', '2021-03-30 06:48:25');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `to_warehouse` bigint(20) UNSIGNED NOT NULL,
  `from_warehouse` bigint(20) UNSIGNED NOT NULL,
  `create_by` bigint(20) UNSIGNED NOT NULL,
  `shipping_cost` double NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `to_warehouse`, `from_warehouse`, `create_by`, `shipping_cost`, `description`, `document`, `total_amount`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 15, 90, NULL, '1615539156.png', 15000, NULL, '2021-03-12 03:52:36', '2021-03-12 03:52:36'),
(2, 2, 1, 15, 10, NULL, NULL, 75000, NULL, '2021-03-12 04:10:15', '2021-03-12 04:10:15'),
(3, 2, 1, 15, 5000, NULL, NULL, 1234, NULL, '2021-03-15 05:53:04', '2021-03-15 05:53:04');

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustments`
--

CREATE TABLE `stock_adjustments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `confirm_by` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustment_products`
--

CREATE TABLE `stock_adjustment_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_adjustment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_products`
--

CREATE TABLE `stock_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `stock_id` bigint(20) UNSIGNED NOT NULL,
  `unit_price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `sub_price` double NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_products`
--

INSERT INTO `stock_products` (`id`, `product_id`, `stock_id`, `unit_price`, `quantity`, `sub_price`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1500, 10, 15000, NULL, '2021-03-12 03:52:36', '2021-03-12 03:52:36'),
(2, 1, 2, 1500, 50, 75000, NULL, '2021-03-12 04:10:15', '2021-03-12 04:10:15'),
(3, 19, 3, 1234, 1, 1234, NULL, '2021-03-15 05:53:04', '2021-03-15 05:53:04');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `org`, `email`, `phone`, `address`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Ali 1 Supplier', 'Bftech', 'supplier1@bftech.io', '0900088601', 'Lahore', '1615538376.png', NULL, '2021-03-12 03:39:36', '2021-03-12 03:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `name`, `rate`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'GST', 10, NULL, '2021-03-18 05:49:32', '2021-03-18 05:49:32'),
(2, 'vat', 16, NULL, '2021-03-18 05:49:44', '2021-03-18 05:49:44');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `code`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Kg', 'Kg', NULL, '2021-03-12 03:32:43', '2021-03-12 03:32:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(15, 'Hamza', NULL, 'admin@admin.com', '03004336883', NULL, '$2y$10$w2rTsJaCPiTK68rEIVE88u2AqLTglJK3VBy3Yo9k905Il4eOCUT6S', NULL, NULL, '2021-03-11 10:00:14', '2021-03-11 10:00:14'),
(16, 'Mujtaba', NULL, 'mujtaba@gmail.com', '0900088601', NULL, '$2y$10$9fdtB6H8wnz4qCNvXbkrg.zeFCFv6TPycvginm8lO3iy5U005Cw.e', NULL, NULL, '2021-03-12 02:19:18', '2021-03-12 02:19:18'),
(17, 'testing', 'testing@gmail.com.png', 'testing@gmail.com', '090000', NULL, '$2y$10$A2yhPcx1OzwJnrYJ7rzA2ejUdZn7hTsyZJSfjf.uMD.RIVmM3AGnC', NULL, NULL, '2021-03-12 05:53:05', '2021-03-12 05:53:05'),
(18, 'Staff', 'staff@madinaventure.pk.png', 'staff@madinaventure.pk', '00000', NULL, '$2y$10$OyZDgtuHxH3TKHcRqa4Nxu1YRNEEJ.KcQRRUhhuAr9UIIOH1I52Ge', NULL, NULL, '2021-03-12 09:36:11', '2021-03-12 09:36:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_has_groups`
--

CREATE TABLE `user_has_groups` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_has_groups`
--

INSERT INTO `user_has_groups` (`user_id`, `group_id`) VALUES
(15, 1),
(16, 5),
(17, 6),
(18, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_permissions`
--

CREATE TABLE `user_has_permissions` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ware_houses`
--

CREATE TABLE `ware_houses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ware_houses`
--

INSERT INTO `ware_houses` (`id`, `name`, `address`, `phone`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Saudia Cold Storage', 'Saudia Cold', '0900088601', NULL, '2021-03-12 03:37:57', '2021-03-12 03:37:57'),
(2, 'Cold Storage Pakistan', 'Lahore', '000', NULL, '2021-03-12 04:09:32', '2021-03-12 04:09:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_create_by_foreign` (`create_by`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_create_by_foreign` (`create_by`),
  ADD KEY `expenses_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `expenses_category_id_foreign` (`category_id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_categories_create_by_foreign` (`create_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_has_permissions`
--
ALTER TABLE `group_has_permissions`
  ADD PRIMARY KEY (`group_id`,`permission_id`),
  ADD KEY `group_has_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`),
  ADD KEY `products_tax_id_foreign` (`tax_id`),
  ADD KEY `products_create_by_foreign` (`create_by`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_unit_id_foreign` (`unit_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_stocks_product_id_foreign` (`product_id`),
  ADD KEY `product_stocks_warehouse_id_foreign` (`warehouse_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `purchases_create_by_foreign` (`create_by`),
  ADD KEY `purchases_supplier_id_foreign` (`supplier_id`),
  ADD KEY `purchases_tax_id_foreign` (`tax_id`);

--
-- Indexes for table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_payments_purchase_id_foreign` (`purchase_id`),
  ADD KEY `purchase_payments_create_by_foreign` (`create_by`);

--
-- Indexes for table `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_products_purchase_id_foreign` (`purchase_id`),
  ADD KEY `purchase_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quotations_create_by_foreign` (`create_by`);

--
-- Indexes for table `quotation_products`
--
ALTER TABLE `quotation_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quotation_products_quotation_id_foreign` (`quotation_id`),
  ADD KEY `quotation_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `return_products`
--
ALTER TABLE `return_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_customer_id_foreign` (`customer_id`),
  ADD KEY `sales_create_by_foreign` (`create_by`);

--
-- Indexes for table `sale_products`
--
ALTER TABLE `sale_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_products_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_to_warehouse_foreign` (`to_warehouse`),
  ADD KEY `stocks_from_warehouse_foreign` (`from_warehouse`),
  ADD KEY `stocks_create_by_foreign` (`create_by`);

--
-- Indexes for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_adjustment_products`
--
ALTER TABLE `stock_adjustment_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_products`
--
ALTER TABLE `stock_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_products_product_id_foreign` (`product_id`),
  ADD KEY `stock_products_stock_id_foreign` (`stock_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `user_has_groups`
--
ALTER TABLE `user_has_groups`
  ADD PRIMARY KEY (`user_id`,`group_id`),
  ADD KEY `user_has_groups_group_id_foreign` (`group_id`);

--
-- Indexes for table `user_has_permissions`
--
ALTER TABLE `user_has_permissions`
  ADD PRIMARY KEY (`user_id`,`permission_id`),
  ADD KEY `user_has_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `ware_houses`
--
ALTER TABLE `ware_houses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purchase_products`
--
ALTER TABLE `purchase_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `quotation_products`
--
ALTER TABLE `quotation_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `return_products`
--
ALTER TABLE `return_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `sale_products`
--
ALTER TABLE `sale_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_adjustment_products`
--
ALTER TABLE `stock_adjustment_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_products`
--
ALTER TABLE `stock_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ware_houses`
--
ALTER TABLE `ware_houses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `expense_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenses_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `expenses_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `ware_houses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD CONSTRAINT `expense_categories_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `group_has_permissions`
--
ALTER TABLE `group_has_permissions`
  ADD CONSTRAINT `group_has_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `taxes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD CONSTRAINT `product_stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_stocks_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `ware_houses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `purchases_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  ADD CONSTRAINT `purchases_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `taxes` (`id`),
  ADD CONSTRAINT `purchases_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `ware_houses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  ADD CONSTRAINT `purchase_payments_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `purchase_payments_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD CONSTRAINT `purchase_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_products_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quotations`
--
ALTER TABLE `quotations`
  ADD CONSTRAINT `quotations_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `quotation_products`
--
ALTER TABLE `quotation_products`
  ADD CONSTRAINT `quotation_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quotation_products_quotation_id_foreign` FOREIGN KEY (`quotation_id`) REFERENCES `quotations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `sale_products`
--
ALTER TABLE `sale_products`
  ADD CONSTRAINT `sale_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_products_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `stocks_from_warehouse_foreign` FOREIGN KEY (`from_warehouse`) REFERENCES `ware_houses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_to_warehouse_foreign` FOREIGN KEY (`to_warehouse`) REFERENCES `ware_houses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_products`
--
ALTER TABLE `stock_products`
  ADD CONSTRAINT `stock_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_products_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_has_groups`
--
ALTER TABLE `user_has_groups`
  ADD CONSTRAINT `user_has_groups_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_has_groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_has_permissions`
--
ALTER TABLE `user_has_permissions`
  ADD CONSTRAINT `user_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_has_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
