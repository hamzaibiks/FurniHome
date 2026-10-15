-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2026 at 10:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `furnihome_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address_line` text NOT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 3, '2026-06-24 17:18:48', '2026-06-24 17:18:48');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Living Room', 'Elegant sofas, coffee tables, TV stands, and lounge furniture for comfortable living spaces.', 'images/categories/living-room.png', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(2, 'Bedroom', 'Comfortable beds, wardrobes, nightstands, and bedroom furniture for peaceful interiors.', 'images/categories/bedroom.png', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(3, 'Dining Room', 'Dining tables, chairs, sideboards, and refined furniture for beautiful dining areas.', 'images/categories/dining-room.png', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(4, 'Office', 'Desks, ergonomic chairs, bookshelves, and workspace furniture for productive home offices.', 'images/categories/office.png', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(5, 'Storage', 'Smart storage cabinets, drawers, shelves, and organized furniture solutions.', 'images/categories/storage.png', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(6, 'Chairs', 'Accent chairs, lounge chairs, dining chairs, and seating pieces for every room.', 'images/categories/chairs.png', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(7, 'Lighting', 'Floor lamps, table lamps, and wall lighting to create a warm home atmosphere.', 'images/categories/lighting.png', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(8, 'Decor', 'Mirrors, rugs, vases, and decorative accessories to complete your home style.', 'images/categories/decor.png', '2026-06-23 09:45:00', '2026-06-23 09:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `delivery_note` text DEFAULT NULL,
  `delivery_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `delivery_staff_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delivery_status` enum('waiting','assigned','on_the_way','delivered','failed') NOT NULL DEFAULT 'waiting',
  `scheduled_date` date DEFAULT NULL,
  `delivered_at` datetime DEFAULT NULL,
  `delivery_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `order_id`, `full_name`, `phone`, `city`, `address`, `delivery_note`, `delivery_fee`, `status`, `delivery_staff_id`, `delivery_status`, `scheduled_date`, `delivered_at`, `delivery_notes`, `created_at`, `updated_at`) VALUES
(6, 9, 'Hamza Ibiks', '0626303274', 'Tanger', 'Tanja Balia comp Duodet imm c etage 04 no 21 Tanger', NULL, 50.00, 'delivered', NULL, 'waiting', NULL, NULL, NULL, '2026-06-24 17:21:48', '2026-06-24 17:23:23'),
(7, 10, 'Hamza Ibiks', '0626303274', 'Tanger', 'Tanja Balia comp Duodet imm c etage 04 no 21 Tanger', NULL, 50.00, 'delivered', NULL, 'waiting', NULL, NULL, NULL, '2026-06-26 12:31:00', '2026-06-26 12:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `installations`
--

CREATE TABLE `installations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `is_requested` tinyint(1) NOT NULL DEFAULT 0,
  `installation_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT 'not_requested',
  `installation_staff_id` bigint(20) UNSIGNED DEFAULT NULL,
  `installation_status` enum('not_required','waiting','assigned','in_progress','completed','cancelled') NOT NULL DEFAULT 'waiting',
  `scheduled_date` date DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `installation_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `installations`
--

INSERT INTO `installations` (`id`, `order_id`, `is_requested`, `installation_fee`, `status`, `installation_staff_id`, `installation_status`, `scheduled_date`, `completed_at`, `installation_notes`, `created_at`, `updated_at`) VALUES
(6, 9, 1, 0.00, 'completed', NULL, 'waiting', NULL, NULL, NULL, '2026-06-24 17:21:48', '2026-06-24 17:23:23'),
(7, 10, 1, 0.00, 'scheduled', NULL, 'waiting', NULL, NULL, NULL, '2026-06-26 12:31:00', '2026-06-26 12:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_22_121036_create_categories_table', 1),
(5, '2026_06_22_121107_create_products_table', 1),
(6, '2026_06_22_121109_create_product_images_table', 1),
(7, '2026_06_22_121111_create_addresses_table', 1),
(8, '2026_06_22_121113_create_carts_table', 1),
(9, '2026_06_22_121115_create_cart_items_table', 1),
(10, '2026_06_22_121117_create_orders_table', 1),
(11, '2026_06_22_121118_create_order_items_table', 1),
(12, '2026_06_22_121120_create_payments_table', 1),
(13, '2026_06_22_121122_create_deliveries_table', 1),
(14, '2026_06_22_121124_create_installations_table', 1),
(15, '2026_06_22_121127_create_reviews_table', 1),
(16, '2026_06_22_160208_create_product_variants_table', 2),
(17, '2026_06_23_132050_add_phone_and_role_to_users_table', 3),
(18, '2026_06_23_152427_add_product_variant_id_to_cart_items_table', 4),
(19, '2026_06_23_155053_prepare_checkout_tables_for_furnihome', 5),
(20, '2026_06_23_162251_make_address_id_nullable_in_orders_table', 6),
(21, '2026_06_23_163358_fix_payment_method_column_in_payments_table', 7),
(22, '2026_06_24_175144_add_role_to_users_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_number` varchar(255) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `delivery_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `installation_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `order_status` enum('pending','confirmed','preparing','out_for_delivery','delivered','installation_scheduled','installed','completed','cancelled') NOT NULL DEFAULT 'pending',
  `payment_status` enum('unpaid','paid','failed','refunded') NOT NULL DEFAULT 'unpaid',
  `installation_required` tinyint(1) NOT NULL DEFAULT 0,
  `preferred_delivery_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address_id`, `order_number`, `subtotal`, `delivery_fee`, `installation_fee`, `total`, `status`, `order_status`, `payment_status`, `installation_required`, `preferred_delivery_date`, `notes`, `created_at`, `updated_at`) VALUES
(9, 3, NULL, 'FH-20260624182147-3', 1200.00, 50.00, 0.00, 1250.00, 'completed', 'pending', 'unpaid', 0, NULL, NULL, '2026-06-24 17:21:47', '2026-06-24 17:23:23'),
(10, 3, NULL, 'FH-20260626133059-3', 2100.00, 50.00, 0.00, 2150.00, 'completed', 'pending', 'unpaid', 0, NULL, NULL, '2026-06-26 12:31:00', '2026-06-26 12:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_variant_id`, `product_name`, `product_price`, `quantity`, `price`, `total`, `created_at`, `updated_at`) VALUES
(9, 9, 2, 4, 'Wooden Coffee Table', 1200.00, 1, 1200.00, 1200.00, '2026-06-24 17:21:47', '2026-06-24 17:21:47'),
(10, 10, 11, 33, 'Office Desk', 2100.00, 1, 2100.00, 2100.00, '2026-06-26 12:31:00', '2026-06-26 12:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT 'pending',
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `transaction_reference` varchar(255) DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `payment_method`, `payment_status`, `amount`, `status`, `transaction_reference`, `paid_at`, `created_at`, `updated_at`) VALUES
(6, 9, 'cash_on_delivery', 'paid', 1250.00, 'pending', NULL, NULL, '2026-06-24 17:21:48', '2026-06-24 17:23:23'),
(7, 10, 'cash_on_delivery', 'paid', 2150.00, 'pending', NULL, NULL, '2026-06-26 12:31:00', '2026-06-26 12:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `width` decimal(8,2) DEFAULT NULL,
  `height` decimal(8,2) DEFAULT NULL,
  `depth` decimal(8,2) DEFAULT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `status` enum('available','out_of_stock','hidden') NOT NULL DEFAULT 'available',
  `main_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `old_price`, `material`, `color`, `width`, `height`, `depth`, `weight`, `stock_quantity`, `status`, `main_image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Modern Sofa', 'A comfortable modern sofa designed with clean lines and soft upholstery for elegant living rooms.', 4200.00, 4800.00, 'Fabric and solid wood', 'Multiple variants', 220.00, 85.00, 95.00, 45.00, 15, 'available', 'images/products/modern-sofa/variant-1.jpg', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(2, 1, 'Wooden Coffee Table', 'A warm wooden coffee table with a minimal design, perfect for modern living room styling.', 1200.00, 1450.00, 'Natural wood', 'Multiple variants', 110.00, 42.00, 60.00, 18.00, 15, 'available', 'images/products/wooden-coffee-table/variant-1.jpg', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(3, 1, 'TV Stand', 'A modern TV stand with practical storage space and a refined design for living room setups.', 1800.00, 2100.00, 'Engineered wood', 'Multiple variants', 160.00, 50.00, 40.00, 28.00, 15, 'available', 'images/products/tv-stand/variant-1.jpg', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(4, 2, 'Bed Frame', 'A modern bed frame with a refined structure, designed to create a calm and elegant bedroom.', 3500.00, 4000.00, 'Wood and upholstered fabric', 'Multiple variants', 160.00, 110.00, 200.00, 55.00, 15, 'available', 'images/products/bed-frame/variant-1.jpg', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(5, 2, 'Wardrobe', 'A spacious wardrobe with a clean modern design for organized and elegant bedroom storage.', 3900.00, 4500.00, 'Engineered wood', 'Multiple variants', 180.00, 220.00, 60.00, 85.00, 15, 'available', 'images/products/wardrobe/variant-1.jpg', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(6, 2, 'Nightstand', 'A compact bedside nightstand with elegant storage and a warm modern finish.', 750.00, 900.00, 'Wood', 'Multiple variants', 45.00, 55.00, 40.00, 10.00, 15, 'available', 'images/products/nightstand/variant-1.jpg', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(7, 3, 'Dining Table', 'A refined dining table designed for family meals, modern interiors, and elegant dining rooms.', 3200.00, 3700.00, 'Oak wood', 'Multiple variants', 180.00, 76.00, 90.00, 48.00, 15, 'available', 'images/products/dining-table/variant-1.jpg', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(8, 3, 'Dining Chair', 'A comfortable dining chair with a modern profile and refined finish for stylish dining spaces.', 650.00, 800.00, 'Wood and fabric', 'Multiple variants', 48.00, 86.00, 52.00, 7.00, 15, 'available', 'images/products/dining-chair/variant-1.jpg', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(9, 3, 'Sideboard', 'A modern sideboard with storage space, ideal for dining rooms and elegant interior organization.', 2800.00, 3300.00, 'Wood', 'Multiple variants', 150.00, 80.00, 45.00, 42.00, 15, 'available', 'images/products/sideboard/variant-1.jpg', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(10, 3, 'Bar Chair', 'A stylish bar chair suitable for kitchen islands, counters, and modern dining corners.', 600.00, 750.00, 'Metal, wood, and fabric', 'Multiple variants', 45.00, 105.00, 50.00, 9.00, 15, 'available', 'images/products/bar-chair/variant-1.jpg', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(11, 4, 'Office Desk', 'A refined office desk with a practical surface, perfect for modern home workspaces.', 2100.00, 2500.00, 'Wood and metal', 'Multiple variants', 140.00, 76.00, 70.00, 35.00, 15, 'available', 'images/products/office-desk/variant-1.jpg', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(12, 4, 'Ergonomic Chair', 'A comfortable ergonomic office chair designed for support, productivity, and daily work.', 1300.00, 1600.00, 'Mesh, fabric, and metal', 'Multiple variants', 62.00, 115.00, 60.00, 14.00, 15, 'available', 'images/products/ergonomic-chair/variant-1.jpg', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(13, 4, 'Bookshelf', 'A modern bookshelf with open storage for books, decor, and organized home office styling.', 1600.00, 1900.00, 'Wood', 'Multiple variants', 90.00, 180.00, 35.00, 30.00, 15, 'available', 'images/products/bookshelf/variant-1.jpg', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(14, 5, 'Drawer Chest', 'A practical drawer chest with multiple storage compartments for bedrooms and living spaces.', 1400.00, 1700.00, 'Engineered wood', 'Multiple variants', 85.00, 100.00, 45.00, 32.00, 15, 'available', 'images/products/drawer-chest/variant-1.jpg', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(15, 5, 'Wall Shelf', 'A clean wall shelf for displaying decor, books, and small essentials in modern interiors.', 650.00, 800.00, 'Wood', 'Multiple variants', 100.00, 30.00, 25.00, 8.00, 15, 'available', 'images/products/wall-shelf/variant-1.jpg', '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(16, 6, 'Arm Chair', 'A refined arm chair with a comfortable shape, ideal for living rooms, bedrooms, and reading areas.', 1450.00, 1750.00, 'Wood and fabric', 'Multiple variants', 72.00, 85.00, 78.00, 15.00, 15, 'available', 'images/products/arm-chair/variant-1.jpg', '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(17, 6, 'Lounge Chair', 'A premium lounge chair with a soft seat and elegant design for comfortable home corners.', 1700.00, 1950.00, 'Fabric and wood', 'Multiple variants', 75.00, 82.00, 80.00, 16.00, 15, 'available', 'images/products/lounge-chair/variant-1.jpg', '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(18, 7, 'Floor Lamp', 'A modern floor lamp that adds warm ambient lighting and elegance to any room.', 850.00, 1000.00, 'Metal and fabric', 'Multiple variants', 35.00, 160.00, 35.00, 6.00, 15, 'available', 'images/products/floor-lamp/variant-1.jpg', '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(19, 7, 'Table Lamp', 'A decorative table lamp with a soft glow, ideal for bedrooms, side tables, and reading spaces.', 450.00, 600.00, 'Ceramic and fabric', 'Multiple variants', 30.00, 50.00, 30.00, 4.00, 15, 'available', 'images/products/table-lamp/variant-1.jpg', '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(20, 7, 'Wall Lamp', 'A stylish wall lamp designed to add warm lighting and visual comfort to modern interiors.', 500.00, 650.00, 'Metal and glass', 'Multiple variants', 25.00, 35.00, 18.00, 3.00, 15, 'available', 'images/products/wall-lamp/variant-1.jpg', '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(21, 8, 'Wall Mirror', 'A decorative wall mirror that brings brightness, depth, and elegance to modern home spaces.', 700.00, 850.00, 'Glass and metal frame', 'Multiple variants', 80.00, 100.00, 4.00, 9.00, 15, 'available', 'images/products/mirror/variant-1.jpg', '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(22, 8, 'Area Rug', 'A soft area rug that adds comfort, texture, and warmth to living rooms and bedrooms.', 1100.00, 1350.00, 'Woven textile', 'Multiple variants', 200.00, 2.00, 300.00, 12.00, 15, 'available', 'images/products/rug/variant-1.jpg', '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(23, 8, 'Decorative Vase Set', 'A refined decorative vase set for shelves, tables, consoles, and elegant interior styling.', 350.00, 450.00, 'Ceramic', 'Multiple variants', 25.00, 40.00, 25.00, 3.00, 15, 'available', 'images/products/vase/variant-1.jpg', '2026-06-23 09:45:01', '2026-06-23 09:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_name` varchar(255) NOT NULL,
  `color_code` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `color_name`, `color_code`, `image`, `stock_quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 'Variant 1', NULL, 'images/products/modern-sofa/variant-1.jpg', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(2, 1, 'Variant 2', NULL, 'images/products/modern-sofa/variant-2.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(3, 1, 'Variant 3', NULL, 'images/products/modern-sofa/variant-3.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(4, 2, 'Variant 1', NULL, 'images/products/wooden-coffee-table/variant-1.jpg', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(5, 2, 'Variant 2', NULL, 'images/products/wooden-coffee-table/variant-2.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(6, 2, 'Variant 3', NULL, 'images/products/wooden-coffee-table/variant-3.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(7, 3, 'Variant 1', NULL, 'images/products/tv-stand/variant-1.jpg', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(8, 3, 'Variant 2', NULL, 'images/products/tv-stand/variant-2.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(9, 3, 'Variant 3', NULL, 'images/products/tv-stand/variant-3.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(10, 4, 'Variant 1', NULL, 'images/products/bed-frame/variant-1.jpg', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(11, 4, 'Variant 2', NULL, 'images/products/bed-frame/variant-2.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(12, 4, 'Variant 3', NULL, 'images/products/bed-frame/variant-3.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(13, 5, 'Variant 1', NULL, 'images/products/wardrobe/variant-1.jpg', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(14, 5, 'Variant 2', NULL, 'images/products/wardrobe/variant-2.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(15, 5, 'Variant 3', NULL, 'images/products/wardrobe/variant-3.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(16, 6, 'Variant 1', NULL, 'images/products/nightstand/variant-1.jpg', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(17, 6, 'Variant 2', NULL, 'images/products/nightstand/variant-2.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(18, 6, 'Variant 3', NULL, 'images/products/nightstand/variant-3.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(19, 7, 'Variant 1', NULL, 'images/products/dining-table/variant-1.jpg', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(20, 7, 'Variant 2', NULL, 'images/products/dining-table/variant-2.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(21, 7, 'Variant 3', NULL, 'images/products/dining-table/variant-3.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(22, 8, 'Variant 1', NULL, 'images/products/dining-chair/variant-1.jpg', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(23, 8, 'Variant 2', NULL, 'images/products/dining-chair/variant-2.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(24, 8, 'Variant 3', NULL, 'images/products/dining-chair/variant-3.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(25, 9, 'Variant 1', NULL, 'images/products/sideboard/variant-1.jpg', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(26, 9, 'Variant 2', NULL, 'images/products/sideboard/variant-2.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(27, 9, 'Variant 3', NULL, 'images/products/sideboard/variant-3.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(28, 10, 'Variant 1', NULL, 'images/products/bar-chair/variant-1.jpg', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(29, 10, 'Variant 2', NULL, 'images/products/bar-chair/variant-2.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(30, 10, 'Variant 3', NULL, 'images/products/bar-chair/variant-3.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(31, 11, 'Variant 1', NULL, 'images/products/office-desk/variant-1.jpg', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(32, 11, 'Variant 2', NULL, 'images/products/office-desk/variant-2.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(33, 11, 'Variant 3', NULL, 'images/products/office-desk/variant-3.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(34, 12, 'Variant 1', NULL, 'images/products/ergonomic-chair/variant-1.jpg', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(35, 12, 'Variant 2', NULL, 'images/products/ergonomic-chair/variant-2.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(36, 12, 'Variant 3', NULL, 'images/products/ergonomic-chair/variant-3.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(37, 13, 'Variant 1', NULL, 'images/products/bookshelf/variant-1.jpg', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(38, 13, 'Variant 2', NULL, 'images/products/bookshelf/variant-2.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(39, 13, 'Variant 3', NULL, 'images/products/bookshelf/variant-3.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(40, 14, 'Variant 1', NULL, 'images/products/drawer-chest/variant-1.jpg', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(41, 14, 'Variant 2', NULL, 'images/products/drawer-chest/variant-2.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(42, 14, 'Variant 3', NULL, 'images/products/drawer-chest/variant-3.png', 5, NULL, '2026-06-23 09:45:00', '2026-06-23 09:45:00'),
(43, 15, 'Variant 1', NULL, 'images/products/wall-shelf/variant-1.jpg', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(44, 15, 'Variant 2', NULL, 'images/products/wall-shelf/variant-2.png', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(45, 15, 'Variant 3', NULL, 'images/products/wall-shelf/variant-3.png', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(46, 16, 'Variant 1', NULL, 'images/products/arm-chair/variant-1.jpg', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(47, 16, 'Variant 2', NULL, 'images/products/arm-chair/variant-2.png', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(48, 16, 'Variant 3', NULL, 'images/products/arm-chair/variant-3.png', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(49, 17, 'Variant 1', NULL, 'images/products/lounge-chair/variant-1.jpg', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(50, 17, 'Variant 2', NULL, 'images/products/lounge-chair/variant-2.png', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(51, 17, 'Variant 3', NULL, 'images/products/lounge-chair/variant-3.png', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(52, 18, 'Variant 1', NULL, 'images/products/floor-lamp/variant-1.jpg', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(53, 18, 'Variant 2', NULL, 'images/products/floor-lamp/variant-2.png', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(54, 18, 'Variant 3', NULL, 'images/products/floor-lamp/variant-3.png', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(55, 19, 'Variant 1', NULL, 'images/products/table-lamp/variant-1.jpg', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(56, 19, 'Variant 2', NULL, 'images/products/table-lamp/variant-2.png', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(57, 19, 'Variant 3', NULL, 'images/products/table-lamp/variant-3.png', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(58, 20, 'Variant 1', NULL, 'images/products/wall-lamp/variant-1.jpg', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(59, 20, 'Variant 2', NULL, 'images/products/wall-lamp/variant-2.png', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(60, 20, 'Variant 3', NULL, 'images/products/wall-lamp/variant-3.png', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(61, 21, 'Variant 1', NULL, 'images/products/mirror/variant-1.jpg', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(62, 21, 'Variant 2', NULL, 'images/products/mirror/variant-2.png', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(63, 21, 'Variant 3', NULL, 'images/products/mirror/variant-3.png', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(64, 22, 'Variant 1', NULL, 'images/products/rug/variant-1.jpg', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(65, 22, 'Variant 2', NULL, 'images/products/rug/variant-2.png', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(66, 22, 'Variant 3', NULL, 'images/products/rug/variant-3.png', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(67, 23, 'Variant 1', NULL, 'images/products/vase/variant-1.jpg', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(68, 23, 'Variant 2', NULL, 'images/products/vase/variant-2.png', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01'),
(69, 23, 'Variant 3', NULL, 'images/products/vase/variant-3.png', 5, NULL, '2026-06-23 09:45:01', '2026-06-23 09:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `status` enum('pending','approved','hidden') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` enum('customer','admin','delivery_staff','installation_staff') NOT NULL DEFAULT 'customer',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'FurniHome Admin', 'admin@furnihome.com', NULL, '$2y$12$/YCY1O8KXIo73MOt5LF4guHT6.HyJQRvpeG3zpZ5HVzgiE1QbI6hK', '0600000000', 'customer', 'HvcHJP9Acgo8CZN6EIulTM4xBGG5l98o3k3TN0TCSCVQMNBDX8aN5b4ZH8dL', '2026-06-24 17:13:36', '2026-06-24 17:13:36'),
(3, 'Hamza Ibiks', 'hamzaibkis01@gmail.com', NULL, '$2y$12$G0bgUEDFT0RFU2y.dHJJXecCG4JSl33hjGYQnl672cbYquYgjcCPu', '0626303274', 'customer', NULL, '2026-06-24 17:18:43', '2026-06-24 17:18:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`),
  ADD KEY `cart_items_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deliveries_order_id_foreign` (`order_id`),
  ADD KEY `deliveries_delivery_staff_id_foreign` (`delivery_staff_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `installations`
--
ALTER TABLE `installations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `installations_order_id_foreign` (`order_id`),
  ADD KEY `installations_installation_staff_id_foreign` (`installation_staff_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_address_id_foreign` (`address_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_order_id_foreign` (`order_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `installations`
--
ALTER TABLE `installations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_delivery_staff_id_foreign` FOREIGN KEY (`delivery_staff_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `deliveries_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `installations`
--
ALTER TABLE `installations`
  ADD CONSTRAINT `installations_installation_staff_id_foreign` FOREIGN KEY (`installation_staff_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `installations_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
