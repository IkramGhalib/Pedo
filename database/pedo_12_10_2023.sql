-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2023 at 01:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pedo_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `bank_desc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `code`, `title`, `bank_desc`) VALUES
(1, '0013', 'HBL', 'kohat road branch');

-- --------------------------------------------------------

--
-- Table structure for table `bill_generates`
--

CREATE TABLE `bill_generates` (
  `id` int(11) NOT NULL,
  `month_year` date NOT NULL,
  `status` varchar(50) DEFAULT 'generated',
  `generated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `due_date` date DEFAULT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill_generates`
--

INSERT INTO `bill_generates` (`id`, `month_year`, `status`, `generated_by`, `created_at`, `updated_at`, `due_date`, `is_verified`) VALUES
(30, '2023-10-01', 'generated', 1, '2023-10-09 06:13:12', '2023-10-09 06:13:12', '2023-10-09', 0),
(31, '2023-11-01', 'generated', 1, '2023-10-09 11:22:59', '2023-10-09 11:22:59', '2023-10-09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `charges_types`
--

CREATE TABLE `charges_types` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `charges_types`
--

INSERT INTO `charges_types` (`id`, `title`, `is_active`) VALUES
(1, 'F.P.A', 1),
(2, 'Financing Cost Surcharges life line Consumer a', 1),
(10, 'aBC CHARGES', 1),
(11, 'CFA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `consumers`
--

CREATE TABLE `consumers` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `cnic` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `consumer_code` varchar(50) DEFAULT NULL,
  `connection_date` date DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `total_credits` decimal(10,2) NOT NULL DEFAULT 0.00,
  `consumer_category_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `feeder_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consumers`
--

INSERT INTO `consumers` (`id`, `full_name`, `father_name`, `cnic`, `address`, `consumer_code`, `connection_date`, `telephone`, `mobile`, `total_credits`, `consumer_category_id`, `status`, `created_at`, `updated_at`, `feeder_id`) VALUES
(1, 'IKRAM ULLAH', 'KHAN GHALIB', '1710142738347', 'new colony , sardheri charsadda', '1', NULL, NULL, '03335959967', 0.00, 1, 'active', '2023-09-27 05:43:11', '2023-09-27 05:43:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `consumer_bills`
--

CREATE TABLE `consumer_bills` (
  `id` int(11) NOT NULL,
  `generate_bill_id` int(11) NOT NULL,
  `reading_id` int(11) NOT NULL,
  `ref_no` varchar(100) NOT NULL,
  `billing_month_year` date DEFAULT NULL,
  `peak_units` int(11) NOT NULL DEFAULT 0,
  `offpeak_units` double NOT NULL DEFAULT 0,
  `PrevU` int(11) DEFAULT 0,
  `PresU` int(11) DEFAULT 0,
  `Units` int(11) DEFAULT 0,
  `FreeU` int(11) DEFAULT 0,
  `currentbill` int(11) DEFAULT 0,
  `net_bill` double NOT NULL,
  `Arrears` int(11) DEFAULT 0,
  `GTotal` int(11) DEFAULT 0,
  `off_peak_bill_breakup` text DEFAULT NULL,
  `charges_breakup` text DEFAULT NULL,
  `taxes_breakup` text DEFAULT NULL,
  `WithinDuedate` int(11) NOT NULL DEFAULT 0,
  `AfterdueDate` int(11) NOT NULL DEFAULT 0,
  `Rec` int(11) DEFAULT 0,
  `IssueDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `DueDate` datetime DEFAULT NULL,
  `IsPayed` varchar(1) NOT NULL DEFAULT '0',
  `paid_amount` double NOT NULL DEFAULT 0,
  `paid_on` date DEFAULT NULL,
  `paid_by` varchar(10) DEFAULT NULL,
  `uploaded_datetime` datetime DEFAULT NULL,
  `Observation` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `consumer_bills`
--

INSERT INTO `consumer_bills` (`id`, `generate_bill_id`, `reading_id`, `ref_no`, `billing_month_year`, `peak_units`, `offpeak_units`, `PrevU`, `PresU`, `Units`, `FreeU`, `currentbill`, `net_bill`, `Arrears`, `GTotal`, `off_peak_bill_breakup`, `charges_breakup`, `taxes_breakup`, `WithinDuedate`, `AfterdueDate`, `Rec`, `IssueDate`, `DueDate`, `IsPayed`, `paid_amount`, `paid_on`, `paid_by`, `uploaded_datetime`, `Observation`) VALUES
(6, 30, 2, '8261420391904', '2023-10-01', 0, 200, 0, 0, 0, 0, 2012, 0, 0, 0, '[{\"units\":200,\"charges\":10.06}]', '[]', '[{\"tax_type\":\"Fuel Price Adjustment\",\"percentage\":2.1,\"calculated_tax\":4.2},{\"tax_type\":\"Financing Cost Surcharges life line Consumer\",\"percentage\":0,\"calculated_tax\":0},{\"tax_type\":\"Financing Cost Surcharges protected Consumer\",\"percentage\":0.43,\"calculated_tax\":0.86},{\"tax_type\":\"Financing Cost Surcharges un-protected Consumer\",\"percentage\":3.24,\"calculated_tax\":6.480000000000001},{\"tax_type\":\"Quarterly Tarrif Adjustment\",\"percentage\":1.24,\"calculated_tax\":2.48},{\"tax_type\":\"Electircity Duty Domestic\",\"percentage\":1.5,\"calculated_tax\":3},{\"tax_type\":\"Electricity duty Commercial\",\"percentage\":3,\"calculated_tax\":6},{\"tax_type\":\"G.S.T\",\"percentage\":0,\"calculated_tax\":0},{\"tax_type\":\"ab\",\"percentage\":2,\"calculated_tax\":4}]', 0, 0, 0, '2023-10-09 06:13:12', NULL, '0', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `consumer_categories`
--

CREATE TABLE `consumer_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consumer_categories`
--

INSERT INTO `consumer_categories` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Domestic', 1, '2023-09-27 05:36:16', '2023-09-27 05:36:16'),
(2, 'Commericial', 1, '2023-09-27 05:36:25', '2023-09-27 05:36:25');

-- --------------------------------------------------------

--
-- Table structure for table `consumer_meters`
--

CREATE TABLE `consumer_meters` (
  `cm_id` int(11) NOT NULL,
  `consumer_id` int(11) NOT NULL,
  `meter_id` int(11) NOT NULL,
  `ref_no` varchar(100) NOT NULL,
  `connection_date` date DEFAULT NULL,
  `definition_date` date DEFAULT NULL,
  `previous_reading` int(11) NOT NULL DEFAULT 0,
  `arrear` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consumer_meters`
--

INSERT INTO `consumer_meters` (`cm_id`, `consumer_id`, `meter_id`, `ref_no`, `connection_date`, `definition_date`, `previous_reading`, `arrear`) VALUES
(1, 1, 3, '8261420391904', '2023-08-27', '2023-09-01', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `consumer_sub_categories`
--

CREATE TABLE `consumer_sub_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `consumer_category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_conditon_start` int(11) NOT NULL,
  `category_conditon_end` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `check_months` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consumer_sub_categories`
--

INSERT INTO `consumer_sub_categories` (`id`, `consumer_category_id`, `name`, `category_conditon_start`, `category_conditon_end`, `is_active`, `created_at`, `updated_at`, `check_months`) VALUES
(1, 1, 'Life line', 1, 100, 1, NULL, NULL, 12),
(2, 1, 'Protected', 101, 200, 1, NULL, NULL, 6),
(3, 1, 'un-protected', 201, 700, 1, NULL, NULL, 1),
(4, 2, 'Commerial', 1000, 70000, 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(11) NOT NULL,
  `division_code` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `division_code`, `name`, `description`, `is_active`) VALUES
(1, 42, 'Charsadda', NULL, 1);

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
-- Table structure for table `feeders`
--

CREATE TABLE `feeders` (
  `id` int(11) NOT NULL,
  `feeder_code` int(11) NOT NULL,
  `name` text NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `sub_division_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feeders`
--

INSERT INTO `feeders` (`id`, `feeder_code`, `name`, `is_active`, `sub_division_id`) VALUES
(1, 8, 'Sardhari 132 kv charsada', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `general_taxs`
--

CREATE TABLE `general_taxs` (
  `id` int(11) NOT NULL,
  `tax_percentage` float NOT NULL,
  `tax_type_id` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `con_cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `general_taxs`
--

INSERT INTO `general_taxs` (`id`, `tax_percentage`, `tax_type_id`, `is_active`, `con_cat_id`) VALUES
(1, 2.2, 1, 1, 1),
(2, 0, 1, 1, 1),
(3, 0.43, 1, 1, 1),
(4, 3.24, 1, 1, 1),
(5, 1.24, 1, 1, 1),
(6, 1.5, 1, 1, 1),
(7, 3, 1, 1, 1),
(8, 0, 1, 1, 1),
(9, 2, 1, 1, 1),
(10, 2.1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `instruction_levels`
--

CREATE TABLE `instruction_levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instruction_levels`
--

INSERT INTO `instruction_levels` (`id`, `level`) VALUES
(1, 'Introductory'),
(2, 'Intermediate'),
(3, 'Advanced'),
(4, 'Comprehensive');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'un-paid',
  `created_at` timestamp NULL DEFAULT NULL,
  `create_from_place` varchar(30) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uploaded_receipt` text DEFAULT NULL,
  `uploaded_receipt_date` datetime DEFAULT NULL,
  `invoice_amount` int(11) NOT NULL DEFAULT 0,
  `other_charges` int(11) NOT NULL DEFAULT 0,
  `other_charges_desc` text DEFAULT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `invoice_total_amount` int(11) NOT NULL DEFAULT 0,
  `paid_from` varchar(50) DEFAULT NULL,
  `total_paid_amount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `user_id`, `created_by`, `status`, `created_at`, `create_from_place`, `updated_at`, `uploaded_receipt`, `uploaded_receipt_date`, `invoice_amount`, `other_charges`, `other_charges_desc`, `discount`, `invoice_total_amount`, `paid_from`, `total_paid_amount`) VALUES
(1, '1', 1, 'paid', '2023-09-01 05:30:18', 'FEP', '2023-09-01 18:22:00', NULL, NULL, 0, 0, NULL, 0, 0, NULL, 0),
(2, '2', 2, 'paid', '2023-09-01 05:33:13', 'FEP', '2023-09-01 05:36:48', 'uploads_receipt_evidance/2.jpg', '2023-08-31 22:35:05', 0, 0, NULL, 0, 0, NULL, 0),
(3, '2', 2, 'paid', '2023-08-31 17:20:58', 'FEP', '2023-08-31 17:25:26', NULL, NULL, 0, 0, NULL, 0, 0, NULL, 0),
(4, '2', 2, 'paid', '2023-09-06 01:44:25', 'FEP', '2023-09-06 02:30:40', NULL, NULL, 0, 0, NULL, 0, 0, NULL, 0),
(5, '2', 2, 'un-paid', '2023-09-11 05:08:00', 'FEP', '2023-09-11 05:08:00', NULL, NULL, 0, 0, NULL, 0, 0, NULL, 0),
(6, '2', 2, 'un-paid', '2023-09-12 02:27:48', 'FEP', '2023-09-12 02:27:48', NULL, NULL, 0, 0, NULL, 0, 0, NULL, 0),
(7, '2', 2, 'un-paid', '2023-09-12 04:29:09', 'FEP', '2023-09-12 04:29:09', NULL, NULL, 0, 0, NULL, 0, 0, NULL, 0),
(8, '2', 2, 'un-paid', '2023-09-15 00:58:57', 'FEP', '2023-09-15 00:58:57', NULL, NULL, 0, 0, NULL, 0, 0, NULL, 0),
(9, '2', 2, 'un-paid', '2023-09-15 05:52:16', 'FEP', '2023-09-15 05:52:16', NULL, NULL, 0, 0, NULL, 0, 10500, NULL, 0),
(10, '1', 0, 'paid', '2023-09-19 00:24:29', NULL, '2023-09-19 00:24:29', NULL, NULL, 0, 0, NULL, 0, 0, NULL, 0),
(11, '1', 0, 'paid', '2023-09-19 00:28:08', NULL, '2023-09-19 00:28:08', NULL, NULL, 0, 0, NULL, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `group_id` varchar(255) DEFAULT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `course_id` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `price` varchar(255) DEFAULT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `fee_type` varchar(50) NOT NULL DEFAULT 'course' COMMENT 'course/exam',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_id`, `group_id`, `category_id`, `course_id`, `qty`, `price`, `discount`, `fee_type`, `created_at`, `updated_at`) VALUES
(52, '73', '23', NULL, NULL, 1, '650', 0, 'course', '2023-08-21 02:49:54', '2023-08-21 02:49:54'),
(53, '', NULL, NULL, NULL, 1, NULL, 0, 'course', '2023-08-21 23:48:59', '2023-08-21 23:48:59'),
(54, '', NULL, NULL, NULL, 1, NULL, 0, 'course', '2023-08-22 00:02:32', '2023-08-22 00:02:32'),
(55, '', NULL, NULL, NULL, 1, NULL, 0, 'course', '2023-08-22 00:09:12', '2023-08-22 00:09:12'),
(56, '', NULL, NULL, NULL, 1, NULL, 0, 'course', '2023-08-22 00:10:48', '2023-08-22 00:10:48'),
(57, '', NULL, NULL, NULL, 1, NULL, 0, 'course', '2023-08-22 00:29:54', '2023-08-22 00:29:54'),
(58, '83', '23', '29', '28', 1, '350', 0, 'course', NULL, NULL),
(59, '83', '23', '29', '27', 1, '300', 0, 'course', NULL, NULL),
(60, '83', '24', '30', '30', 1, '300', 0, 'course', NULL, NULL),
(61, '83', '24', '30', '29', 1, '140', 0, 'course', NULL, NULL),
(62, '84', '23', '29', '28', 1, '350', 0, 'course', NULL, NULL),
(63, '84', '23', '29', '27', 1, '300', 0, 'course', NULL, NULL),
(64, '85', '24', '30', '30', 1, '300', 0, 'course', NULL, NULL),
(65, '85', '24', '30', '29', 1, '140', 0, 'course', NULL, NULL),
(66, '85', '23', '29', '28', 1, '350', 0, 'course', NULL, NULL),
(67, '85', '23', '29', '27', 1, '300', 0, 'course', NULL, NULL),
(68, '86', '24', '30', '30', 1, '300', 0, 'course', NULL, NULL),
(69, '87', '23', '29', '28', 1, '350', 0, 'course', NULL, NULL),
(70, '87', '23', '29', '27', 1, '300', 0, 'course', NULL, NULL),
(71, '87', '24', '30', '29', 1, '140', 0, 'course', NULL, NULL),
(72, '88', '23', '29', '28', 1, '350', 0, 'course', NULL, NULL),
(73, '88', '23', '29', '27', 1, '300', 0, 'course', NULL, NULL),
(74, '89', '24', '30', '30', 1, '300', 0, 'course', NULL, NULL),
(75, '89', '24', '30', '29', 1, '140', 0, 'course', NULL, NULL),
(76, '1', '1', '1', '1', 1, '1000', 0, 'course', NULL, NULL),
(77, '1', '1', '1', '2', 1, '2000', 0, 'course', NULL, NULL),
(78, '1', '1', '1', '3', 1, '3000', 0, 'course', NULL, NULL),
(79, '1', '1', '1', '4', 1, '4000', 0, 'course', NULL, NULL),
(80, '2', '1', '1', '1', 1, '1000', 0, 'course', NULL, NULL),
(81, '2', '1', '1', '2', 1, '2000', 0, 'course', NULL, NULL),
(82, '2', '1', '1', '3', 1, '3000', 0, 'course', NULL, NULL),
(83, '2', '1', '1', '4', 1, '4000', 0, 'course', NULL, NULL),
(84, '3', '3', '3', '9', 1, '10000.00', 0, 'course', NULL, NULL),
(85, '3', '3', '3', '10', 1, '20000.00', 0, 'course', NULL, NULL),
(86, '4', '1', '1', '1', 1, '1000', 0, 'course', NULL, NULL),
(87, '4', '1', '1', '2', 1, '2000', 0, 'course', NULL, NULL),
(88, '4', '1', '1', '3', 1, '3000', 0, 'course', NULL, NULL),
(89, '4', '1', '1', '4', 1, '4000', 0, 'course', NULL, NULL),
(90, '5', '1', '1', '1', 1, '1000', 0, 'course', NULL, NULL),
(91, '5', '1', '1', '2', 1, '2000', 0, 'course', NULL, NULL),
(92, '5', '1', '1', '3', 1, '3000', 0, 'course', NULL, NULL),
(93, '5', '1', '1', '4', 1, '4000', 0, 'course', NULL, NULL),
(94, '6', '1', '1', '1', 1, '1000', 0, 'course', NULL, NULL),
(95, '6', '1', '1', '2', 1, '2000', 0, 'course', NULL, NULL),
(96, '6', '1', '1', '3', 1, '3000', 0, 'course', NULL, NULL),
(97, '6', '1', '1', '4', 1, '4000', 0, 'course', NULL, NULL),
(98, '7', '1', '1', '1', 1, '1000', 0, 'course', NULL, NULL),
(99, '7', '1', '1', '2', 1, '2000', 0, 'course', NULL, NULL),
(100, '7', '1', '1', '3', 1, '3000', 0, 'course', NULL, NULL),
(101, '7', '1', '1', '4', 1, '4000', 0, 'course', NULL, NULL),
(102, '8', NULL, NULL, NULL, 1, '500', 0, 'test', NULL, NULL),
(103, '9', '1', '1', '1', 1, '1000', 0, 'course', NULL, NULL),
(104, '9', '1', '1', '2', 1, '2000', 0, 'course', NULL, NULL),
(105, '9', '1', '1', '3', 1, '3000', 0, 'course', NULL, NULL),
(106, '9', '1', '1', '4', 1, '4000', 0, 'course', NULL, NULL),
(107, '9', NULL, NULL, NULL, 1, '500', 0, 'test', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_categories`
--

CREATE TABLE `master_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `icon_class` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_categories`
--

INSERT INTO `master_categories` (`id`, `name`, `slug`, `icon_class`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'ETEA', 'etea', 'fa-user', 1, '2023-09-01 04:12:10', '2023-09-01 04:12:10'),
(2, 'MDCAT', 'mdcat', 'fa-user', 1, '2023-09-01 04:12:25', '2023-09-01 04:12:25'),
(6, '1st Year', '1st-year', 'fa-user', 1, '2023-09-01 04:13:44', '2023-09-01 04:13:44'),
(4, '10th', '10th', 'fa-user', 1, '2023-09-01 04:12:52', '2023-09-01 04:12:52'),
(5, '9th', '9th', 'fa-user', 1, '2023-09-01 04:13:05', '2023-09-01 04:13:05'),
(7, '2nd Year', '2nd-year', 'fa-user', 1, '2023-09-01 04:13:58', '2023-09-01 04:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `meters`
--

CREATE TABLE `meters` (
  `meter_id` int(11) NOT NULL,
  `meter_no` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'free'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meters`
--

INSERT INTO `meters` (`meter_id`, `meter_no`, `status`) VALUES
(1, '01', 'free'),
(2, '02', 'free'),
(3, '0391904', 'assigned'),
(4, '039194', 'free');

-- --------------------------------------------------------

--
-- Table structure for table `meter_readings`
--

CREATE TABLE `meter_readings` (
  `id` int(11) NOT NULL,
  `meter_no` varchar(50) DEFAULT NULL,
  `ref_no` varchar(50) DEFAULT NULL,
  `month_year` date DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `offpeak` double DEFAULT 0,
  `offpeak_units` int(11) NOT NULL DEFAULT 0,
  `peak` double DEFAULT 0,
  `peak_units` int(11) NOT NULL DEFAULT 0,
  `pkimage` varchar(500) DEFAULT NULL,
  `offpkimage` varchar(500) DEFAULT NULL,
  `datetime` timestamp NULL DEFAULT current_timestamp(),
  `longitude` varchar(20) DEFAULT NULL,
  `latitude` varchar(20) DEFAULT NULL,
  `Observation` varchar(50) DEFAULT NULL,
  `retake` bit(1) DEFAULT b'0',
  `varifier` varchar(50) DEFAULT NULL,
  `mrid` varchar(50) DEFAULT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT 0,
  `status` varchar(50) DEFAULT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `meter_readings`
--

INSERT INTO `meter_readings` (`id`, `meter_no`, `ref_no`, `month_year`, `year`, `month`, `offpeak`, `offpeak_units`, `peak`, `peak_units`, `pkimage`, `offpkimage`, `datetime`, `longitude`, `latitude`, `Observation`, `retake`, `varifier`, `mrid`, `sync`, `status`, `is_verified`) VALUES
(1, NULL, '8261420391904', '2023-09-01', '2023', '09', 250, 250, NULL, 0, NULL, NULL, '2023-09-27 10:44:35', NULL, NULL, NULL, b'0', '1', NULL, 0, NULL, 1),
(2, NULL, '8261420391904', '2023-10-01', '2023', '10', 50, 200, 100, 100, NULL, NULL, '2023-10-03 06:09:10', NULL, NULL, NULL, b'0', '1', NULL, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_02_18_062028_create_categories_table', 1),
(2, '2019_02_18_062028_create_course_files_table', 1),
(3, '2019_02_18_062028_create_course_videos_table', 1),
(4, '2019_02_18_062028_create_courses_table', 1),
(5, '2019_02_18_062028_create_curriculum_lectures_quiz_table', 1),
(6, '2019_02_18_062028_create_curriculum_sections_table', 1),
(7, '2019_02_18_062028_create_instruction_levels_table', 1),
(8, '2019_02_18_062028_create_password_resets_table', 1),
(9, '2019_02_18_062028_create_role_user_table', 1),
(10, '2019_02_18_062028_create_roles_table', 1),
(11, '2019_02_18_062028_create_users_table', 1),
(12, '2019_02_22_063348_create_instructors_table', 1),
(13, '2019_02_22_151526_create_payments_table', 1),
(14, '2019_03_02_084257_create_course_ratings', 1),
(15, '2019_03_03_072224_create_blogs_table', 1),
(16, '2019_03_04_141453_create_options_table', 1),
(17, '2019_03_08_072337_create_withdraw_requests_table', 1),
(18, '2019_04_07_145907_create_course_progress', 1),
(23, '2023_08_12_194346_create_carts_table', 2),
(24, '2023_08_15_144352_create_invoices_table', 3),
(25, '2023_08_15_154015_create_invoice_details_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('bc0952ad2726f88ca143a36ca10b959ce604a5a7d4d78755d743b1e3b38abcc3a77cba83f61c1c8b', 2, 1, 'accessToken', '[]', 0, '2023-08-08 23:28:27', '2023-08-08 23:28:27', '2024-08-08 16:28:27'),
('df0884c9872e5fceb8cc4799360dc174feb8d69558f8a16d679d1c9485e683b01d62b94fd8095d0a', 10, 1, 'accessToken', '[]', 1, '2023-08-24 13:48:05', '2023-08-24 14:16:04', '2024-08-24 06:48:05'),
('dacb3ea2c77cf47b6f506ea89035d647aba48ec02959edf5d994cf1ad56137b612fe8f071774033b', 10, 1, 'accessToken', '[]', 0, '2023-08-30 09:05:08', '2023-08-30 09:05:08', '2024-08-30 02:05:08'),
('54bd114336dd8ec887f831e5f9d19519eadd0ee7bb1510e41910cfa81f6d6ee4f65ab5d1b06caf10', 2, 1, 'accessToken', '[]', 0, '2023-08-31 16:06:06', '2023-08-31 16:06:06', '2024-08-31 12:06:06'),
('b1f33ed421e06d07c9e3fd9fbea400e14b7e79277b02511dcc94939904f68177568eb27024934a40', 2, 1, 'accessToken', '[]', 0, '2023-08-31 16:06:50', '2023-08-31 16:06:50', '2024-08-31 12:06:50'),
('0b6764592e78103fa07b641ee4055d0dc291c2b39b18802171c9fd1582c1fb5b5025e8bebc5de6ee', 2, 1, 'accessToken', '[]', 0, '2023-08-31 16:09:04', '2023-08-31 16:09:04', '2024-08-31 12:09:04'),
('9b3c024f7dac1e9ba38ab7a4612ac0ca1dafed0ca440ac8c780557511b05117fb95be4fb2668e850', 2, 1, 'accessToken', '[]', 0, '2023-08-31 16:18:46', '2023-08-31 16:18:46', '2024-08-31 12:18:46'),
('763ceeaa2cb659a2eb53557cc5db6fa3fab81ba2e0711ce95231c000564beedd170f0a3180cf433b', 2, 1, 'accessToken', '[]', 0, '2023-08-31 16:36:43', '2023-08-31 16:36:43', '2024-08-31 12:36:43'),
('39db23bfb236677fa9912f6f42cd9e6f264cebb1a439dd98cc4619b972e3feb5de1adce88b39c534', 2, 1, 'accessToken', '[]', 0, '2023-08-31 16:39:43', '2023-08-31 16:39:43', '2024-08-31 12:39:43'),
('b07c9f092458f2fc6a84bb504ad28d0f63235a420060b8172eec02872896a90b6bca46c9d51667d2', 2, 1, 'accessToken', '[]', 0, '2023-08-31 17:09:31', '2023-08-31 17:09:31', '2024-08-31 13:09:31'),
('3b8b5ab2a6a5ac7ffacfe53dd66474703fce886de717b29817d2270cc6f902653528bdc433c8b486', 2, 1, 'accessToken', '[]', 0, '2023-08-31 17:31:31', '2023-08-31 17:31:31', '2024-08-31 13:31:31'),
('43f7fbb8188c8f2c4c1a7b2c126611856d3ff024c1104ebfbefd3ba348da51b8ba5ad18b768d55ea', 2, 1, 'accessToken', '[]', 0, '2023-08-31 17:48:14', '2023-08-31 17:48:14', '2024-08-31 13:48:14'),
('d33a948e8873793541148711c92bbebf05c595d95f2f0ffd3fffdd0615770e2a29ed2ebf49e1bc1a', 1, 3, 'accessToken', '[]', 0, '2023-09-11 01:56:22', '2023-09-11 01:56:22', '2024-09-11 06:56:22'),
('a28b10d251ce6b604071088f88689d21a098504906d3fd0156c1e34205dd84d9060a2972b83c7d81', 2, 3, 'accessToken', '[]', 0, '2023-09-11 01:56:44', '2023-09-11 01:56:44', '2024-09-11 06:56:44'),
('77ee9075d2894b2c19240dbfe55acdab01d5fca96b8c901496927f6374dc7c2c4957a486c688af1f', 2, 3, 'accessToken', '[]', 0, '2023-09-12 00:07:09', '2023-09-12 00:07:09', '2024-09-12 05:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
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
  `name` varchar(191) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(191) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Quality Coaching Academy Personal Access Client', 'Y3eQfv8agu3wVUVNqJfgtVHFhLayZ1HB6bfaN0Bu', NULL, 'http://localhost', 1, 0, 0, '2023-08-08 23:01:25', '2023-08-08 23:01:25'),
(2, NULL, 'Quality Coaching Academy Password Grant Client', 'CGwRel0IfbjHjSFYtMDtMmVI3D0XzsBiWKAMPKLC', 'users', 'http://localhost', 0, 1, 0, '2023-08-08 23:01:25', '2023-08-08 23:01:25'),
(3, NULL, 'CLEAN PROJECT 2 Personal Access Client', 'JFPv4tPmSt2iZtPf6fDqK4uV8TYkePRXBdyV0JQn', NULL, 'http://localhost', 1, 0, 0, '2023-09-11 01:56:18', '2023-09-11 01:56:18'),
(4, NULL, 'CLEAN PROJECT 2 Password Grant Client', 'lnAyOduaUa80H7bjt56tNoywwvF9jaZ8TFnO3H67', 'users', 'http://localhost', 0, 1, 0, '2023-09-11 01:56:18', '2023-09-11 01:56:18');

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

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-08-08 23:01:25', '2023-08-08 23:01:25'),
(2, 3, '2023-09-11 01:56:18', '2023-09-11 01:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `option_key` varchar(255) NOT NULL,
  `option_value` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `code`, `option_key`, `option_value`) VALUES
(1, 'pageHome', 'banner_title', 'PEDO'),
(2, 'pageHome', 'banner_text', 'Search you bill by refrence Number from anywhere'),
(3, 'pageHome', 'instructor_text', 'We have more than 200 skilled & professional Instructors'),
(4, 'pageHome', 'learn_block_title', 'PEDO objective'),
(5, 'pageHome', 'learn_block_text', '<p style=\"box-sizing: border-box; padding: 0px; margin: 0px 0px 10px; border: none; outline: none; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff; color: #000000 !important;\"><strong style=\"box-sizing: border-box; padding: 0px; margin: 0px; border: none; outline: none;\">Established In 1986 as \"Small Hydel Development Organization\" with the objective to:</strong></p>\r\n<p style=\"box-sizing: border-box; padding: 0px; margin: 0px 0px 10px; border: none; outline: none; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff; color: #000000 !important;\">&nbsp;- Identify and develop hydel potential upto 5MW.</p>\r\n<p style=\"box-sizing: border-box; padding: 0px; margin: 0px 0px 10px; border: none; outline: none; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff; color: #000000 !important;\">&nbsp;- Construct small hydel stations for isolated load centers.</p>\r\n<p style=\"box-sizing: border-box; padding: 0px; margin: 0px 0px 10px; border: none; outline: none; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff; color: #000000 !important;\">&nbsp;- Operate and maintain off grid small Hydel Stations.</p>\r\n<p style=\"box-sizing: border-box; padding: 0px; margin: 0px 0px 10px; border: none; outline: none; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff; color: #000000 !important;\">In 1993, it was converted to an autonomous body under the 1993 Act and renamed as \"Sarhad Hydel Development Organization (SHYDO) \" In 2013, the name of organization was changed to \"Pakhtunkhwa Hydel Development Organization(PHYDO)\" Most recently in 2014 PHYDO was renamed as \"Pakhtunkhwa Energy Development Organization (PEDO)\" through passage of PEDO Act 2014.</p>'),
(6, 'pageAbout', 'content', '<article class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-12\">\r\n<h5 class=\"mt-3 underline-heading\">OUR MISSION IS SIMPLE</h5>\r\n<p>Cobem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla dolor sit amet, consectetuer adipiscing elit.</p>\r\n<p>Aenean commodo ligula eget dolor. Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, eta rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis. Lorem ipsum dolor sit amet,Aenean commodo ligula eget dolor. Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, eta rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis. Lorem ipsum dolor sit amet,</p>\r\n<ul class=\"ul-no-padding about-ul\">\r\n<li>Commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.Commodo ligula eget dolor. Aenean massa. Port sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>\r\n<li>Dum sociis natoque penatibus et magnis dis parturient montes</li>\r\n<li>Nascetur ridiculus mus, Nulla consequat massa quis enim, Cum sociis natoque penatibus et magnis dis parturient montes</li>\r\n<li>Commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.Commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>\r\n<li>Nascetur ridiculus mus, Nulla consequat massa quis enim</li>\r\n<li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus, Nulla consequat massa quis enim</li>\r\n<li>Consectetuer adipiscing elit. Aenean commodo ligula eget dolor</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</article>\r\n<article class=\"count-block jumbotron\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6\">\r\n<h3 class=\"underline-heading\">150</h3>\r\n<h6>COUNTRIES REACHED</h6>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6\">\r\n<h3 class=\"underline-heading\">850</h3>\r\n<h6>COUNTRIES REACHED</h6>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6\">\r\n<h3 class=\"underline-heading\">38300</h3>\r\n<h6>PASSED GRADUATES</h6>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6\">\r\n<h3 class=\"underline-heading\">3400</h3>\r\n<h6>COURSES PUBLISHED</h6>\r\n</div>\r\n</div>\r\n</div>\r\n</article>\r\n<article class=\"about-features-block\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-12 text-center seperator-head mt-3\">\r\n<h3>Why choose QCA</h3>\r\n<p class=\"mt-3\">Cum doctus civibus efficiantur in imperdiet deterruisset.</p>\r\n</div>\r\n</div>\r\n<div class=\"row mt-4 mb-5\">\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-file-signature\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Hi-Tech Learning</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-users-cog\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Course Discussion</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-shield-alt\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Website Security</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-chalkboard-teacher\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Qualified teachers</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-building\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Equiped class rooms</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-digital-tachograph\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Advanced teaching</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-puzzle-piece\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Adavanced study plans</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-bullseye\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Focus on target</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-thumbs-up\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Focus on success</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-tablet-alt\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Responsive Design</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-credit-card\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Payment Gateways</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-search-plus\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">SEO Friendly</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n</div>\r\n</div>\r\n</article>'),
(7, 'pageContact', 'telephone', '+92 (302) 5959967'),
(8, 'pageContact', 'email', 'qca@example.com'),
(9, 'pageContact', 'address', 'University Town, Peshawar , pakistan'),
(10, 'pageContact', 'map', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.940622898076!2d-74.00543578509465!3d40.74133204375838!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259bf14f1f51f%3A0xcc1b5ab35bd75df0!2sGoogle!5e0!3m2!1sen!2sin!4v1542693598934\" width=\"100%\" height=\"100%\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>'),
(11, 'settingGeneral', 'application_name', 'pedo'),
(12, 'settingGeneral', 'meta_key', 'Quality Coaching Academy'),
(13, 'settingGeneral', 'meta_description', 'Learn every topic. On time. Every time.'),
(14, 'settingGeneral', 'admin_commission', '20'),
(15, 'settingGeneral', 'admin_email', 'info@qca.com'),
(16, 'settingGeneral', 'minimum_withdraw', '100'),
(17, 'settingGeneral', 'header_logo', 'config/logo.png'),
(18, 'settingGeneral', 'fav_icon', 'config/favicon.ico'),
(19, 'settingGeneral', 'footer_logo', 'config/logo_footer.png'),
(20, 'settingPayment', 'username', ''),
(21, 'settingPayment', 'password', ''),
(22, 'settingPayment', 'signature', ''),
(23, 'settingPayment', 'test_mode', '1'),
(24, 'settingPayment', 'is_active', '1'),
(25, 'settingEmail', 'smtp_host', NULL),
(26, 'settingEmail', 'smtp_port', NULL),
(27, 'settingEmail', 'smtp_secure', NULL),
(28, 'settingEmail', 'smtp_username', NULL),
(29, 'settingEmail', 'smtp_password', NULL),
(30, 'settingGeneral', 'old_header_logo', 'config/logo.png'),
(31, 'settingGeneral', 'old_footer_logo', 'config/logo_footer.png'),
(32, 'settingGeneral', 'old_fav_icon', 'config/favicon.ico'),
(33, 'testFee', 'online_fee', '500'),
(34, 'testFee', 'offline_fee', '300'),
(38, 'settingCharges', 'late_fee_surcharge', '2.5');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(120) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payemnt_collection_methods`
--

CREATE TABLE `payemnt_collection_methods` (
  `id` int(11) NOT NULL,
  `payment_title` varchar(100) NOT NULL,
  `pay_method` varchar(30) NOT NULL,
  `unique_code` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `pay_details` text DEFAULT '[]',
  `description` text DEFAULT NULL,
  `slab_charges` text NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payemnt_collection_methods`
--

INSERT INTO `payemnt_collection_methods` (`id`, `payment_title`, `pay_method`, `unique_code`, `status`, `pay_details`, `description`, `slab_charges`) VALUES
(1, 'Bank Deposit', 'offline', 'BankDeposit', 1, '[{\"Bank Name\":\"Hbl\"},{\"Account No\":\"12121545412454\"},{\"Branch Code\":\"001\"},{\"Branch\":\"University Road\"}]', '<p>- Deposit fee in following Bank/wallet</p><p style=\"margin-left:30px;\"> <b> Bank Name: ABC </b>  <br><b> Branch Code: 0123 </b> <br/><b> Account: 0123456789</b> </p></p>\n          <p>- Go to My Payments .</p>\n          <p>- Click on Upload Receipt Button,and upload Receipt Image   </p>\n          <p>- Wait for Account Section to Verify   </p>\n          <p>- After Verification you Invoice status will become paid.</p>\n          <p>- Course will be open in myCourses Section.</p>', '[]'),
(2, 'Online Deposit', 'online', 'KuickPay', 1, '[]', '         <p>- Open Bank / Mobile Wallet Application</p>\n          <p>- Find \'Bill Payments\' And click .</p>\n          <p>- Find \'Others \' Option And click</p>\n          <p>- Find \'KuickPay\' and Click   </p>\n          <p>- Enter Consumer Number(also Called QuickPay Id)  Which is Available in Invoice   </p>\n          <p>- Retrive Bills  </p>\n          <p>- Pay Now.</p>\n          \n          <p>Note: You can pay from All Banks and Wallet . <br/> For further Details click <a href=\"https://www.youtube.com/watch?v=OXgPj_E07J0\"> How To Pay </a></p>', '[]');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway_charges`
--

CREATE TABLE `payment_gateway_charges` (
  `pgc_id` int(11) NOT NULL,
  `bill_amout` int(11) NOT NULL DEFAULT 0,
  `charges` int(11) NOT NULL DEFAULT 0,
  `payment_gateway` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_gateway_charges`
--

INSERT INTO `payment_gateway_charges` (`pgc_id`, `bill_amout`, `charges`, `payment_gateway`) VALUES
(1, 10000, 40, 'KuickPay'),
(2, 150000, 80, 'KuickPay'),
(3, 500000, 150, 'KuickPay');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway_historys`
--

CREATE TABLE `payment_gateway_historys` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_method` varchar(30) NOT NULL,
  `order_details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_receives`
--

CREATE TABLE `payment_receives` (
  `id` int(11) NOT NULL,
  `payment_month` date NOT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` float NOT NULL,
  `ref_no` bigint(20) NOT NULL,
  `bank_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_receives`
--

INSERT INTO `payment_receives` (`id`, `payment_month`, `payment_date`, `payment_amount`, `ref_no`, `bank_id`) VALUES
(3, '0000-00-00', '2023-10-12', 2000, 2147483647, 1),
(4, '0000-00-00', '2023-10-12', 2000, 2147483647, 1),
(5, '2023-10-01', '2023-10-12', 2000, 2147483647, 1),
(6, '2023-10-01', '2023-10-12', 2000, 2147483647, 1),
(7, '2023-10-01', '2023-10-12', 2000, 8261420391904, 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reading_approve`
--

CREATE TABLE `reading_approve` (
  `id` int(11) NOT NULL,
  `month_year` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reading_approve`
--

INSERT INTO `reading_approve` (`id`, `month_year`, `created_at`, `updated_at`, `is_verified`) VALUES
(1, '2023-10-01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reset_code_passwords`
--

CREATE TABLE `reset_code_passwords` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'reader', 'meter reading can put only', '2023-07-12 23:56:24', '2023-07-12 23:56:24'),
(2, 'incharge', 'verify reading', '2023-07-12 23:56:24', '2023-07-12 23:56:24'),
(3, 'admin', 'Admin Access of all application', '2023-07-12 23:56:24', '2023-07-12 23:56:24');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`) VALUES
(1, 3, 1),
(4, 1, 2),
(5, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slabs`
--

CREATE TABLE `slabs` (
  `id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `slab_start_unit` int(11) NOT NULL,
  `slab_end_unit` int(11) NOT NULL,
  `total_units` int(11) NOT NULL DEFAULT 0,
  `charges` float NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slabs`
--

INSERT INTO `slabs` (`id`, `sub_cat_id`, `slab_start_unit`, `slab_end_unit`, `total_units`, `charges`, `is_active`) VALUES
(1, 1, 1, 50, 50, 3.95, 1),
(2, 1, 51, 100, 50, 7.74, 1),
(3, 2, 1, 100, 100, 7.74, 1),
(4, 2, 101, 200, 100, 10.06, 1),
(5, 3, 1, 100, 100, 16.48, 1),
(6, 3, 101, 200, 100, 22.95, 1),
(7, 3, 201, 300, 100, 27.95, 1),
(8, 4, 1, 7000, 7000, 37.95, 1),
(9, 3, 301, 400, 100, 35.24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category_charges`
--

CREATE TABLE `sub_category_charges` (
  `id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `charges_type_id` int(11) NOT NULL,
  `charges` float NOT NULL DEFAULT 0,
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category_charges`
--

INSERT INTO `sub_category_charges` (`id`, `sub_cat_id`, `charges_type_id`, `charges`, `is_active`) VALUES
(1, 1, 2, 2.2, 1),
(2, 3, 11, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_divisions`
--

CREATE TABLE `sub_divisions` (
  `id` int(11) NOT NULL,
  `sub_division_code` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `division_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_divisions`
--

INSERT INTO `sub_divisions` (`id`, `sub_division_code`, `name`, `description`, `is_active`, `division_id`) VALUES
(1, 261, 'Sardhari', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tax_types`
--

CREATE TABLE `tax_types` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tax_types`
--

INSERT INTO `tax_types` (`id`, `title`, `is_active`) VALUES
(1, 'F.P.A', 1),
(2, 'Financing Cost Surcharges life line Consumer a', 1),
(10, 'aBC CHARGES', 1),
(11, 'CFA', 1),
(12, 'abc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `payment_method` varchar(30) NOT NULL,
  `order_details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `course_id`, `amount`, `status`, `payment_method`, `order_details`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0.00, 'completed', 'paypal_express_checkout', '{\"TOKEN\":\"success\",\"status\":\"succeeded\",\"Timestamp\":1561787415,\"ACK\":\"Success\"}', '2023-07-12 23:56:24', '2023-07-12 23:56:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reg_no` varchar(30) DEFAULT NULL,
  `retrive_uniq_code` varchar(50) DEFAULT NULL,
  `card_expire_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `email`, `password`, `is_active`, `remember_token`, `created_at`, `updated_at`, `reg_no`, `retrive_uniq_code`, `card_expire_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2a$12$lcNe9KsxRGEoKvU6vGDhdu5ZZeEhmMyttzqyx9urNxvEvh./39V/m', 1, NULL, '2023-07-12 23:56:24', '2023-07-12 23:56:24', NULL, NULL, NULL),
(2, 'reader', 'reader@gmail.com', '$2a$12$lcNe9KsxRGEoKvU6vGDhdu5ZZeEhmMyttzqyx9urNxvEvh./39V/m', 1, NULL, '2023-09-01 05:32:55', '2023-09-01 05:32:55', NULL, NULL, NULL),
(3, 'incharge', 'incharge@gmail.com', '$2a$12$lcNe9KsxRGEoKvU6vGDhdu5ZZeEhmMyttzqyx9urNxvEvh./39V/m', 1, NULL, '2023-09-01 05:32:55', '2023-09-01 05:32:55', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_balance`
--

CREATE TABLE `user_balance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `is_expire` int(11) NOT NULL DEFAULT 0 COMMENT '0/1 1 means expire',
  `remarks` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_balance`
--

INSERT INTO `user_balance` (`id`, `user_id`, `amount`, `is_expire`, `remarks`, `created_at`) VALUES
(1, 2, 450, 0, 'Test Fee inv#1', '2023-09-17 00:01:07'),
(2, 2, 450, 0, 'Test Fee inv#2', '2023-09-17 00:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_requests`
--

CREATE TABLE `withdraw_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `paypal_id` varchar(150) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0-pending,1-processed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_generates`
--
ALTER TABLE `bill_generates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charges_types`
--
ALTER TABLE `charges_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consumers`
--
ALTER TABLE `consumers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consumer_bills`
--
ALTER TABLE `consumer_bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consumer_categories`
--
ALTER TABLE `consumer_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consumer_meters`
--
ALTER TABLE `consumer_meters`
  ADD PRIMARY KEY (`cm_id`);

--
-- Indexes for table `consumer_sub_categories`
--
ALTER TABLE `consumer_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feeders`
--
ALTER TABLE `feeders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_taxs`
--
ALTER TABLE `general_taxs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instruction_levels`
--
ALTER TABLE `instruction_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_categories`
--
ALTER TABLE `master_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meters`
--
ALTER TABLE `meters`
  ADD PRIMARY KEY (`meter_id`);

--
-- Indexes for table `meter_readings`
--
ALTER TABLE `meter_readings`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payemnt_collection_methods`
--
ALTER TABLE `payemnt_collection_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_gateway_charges`
--
ALTER TABLE `payment_gateway_charges`
  ADD PRIMARY KEY (`pgc_id`);

--
-- Indexes for table `payment_gateway_historys`
--
ALTER TABLE `payment_gateway_historys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_receives`
--
ALTER TABLE `payment_receives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reading_approve`
--
ALTER TABLE `reading_approve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_code_passwords`
--
ALTER TABLE `reset_code_passwords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reset_code_passwords_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slabs`
--
ALTER TABLE `slabs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category_charges`
--
ALTER TABLE `sub_category_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_divisions`
--
ALTER TABLE `sub_divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_types`
--
ALTER TABLE `tax_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_balance`
--
ALTER TABLE `user_balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bill_generates`
--
ALTER TABLE `bill_generates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `charges_types`
--
ALTER TABLE `charges_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `consumers`
--
ALTER TABLE `consumers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `consumer_bills`
--
ALTER TABLE `consumer_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `consumer_categories`
--
ALTER TABLE `consumer_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `consumer_meters`
--
ALTER TABLE `consumer_meters`
  MODIFY `cm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `consumer_sub_categories`
--
ALTER TABLE `consumer_sub_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feeders`
--
ALTER TABLE `feeders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `general_taxs`
--
ALTER TABLE `general_taxs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `instruction_levels`
--
ALTER TABLE `instruction_levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `master_categories`
--
ALTER TABLE `master_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `meters`
--
ALTER TABLE `meters`
  MODIFY `meter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `meter_readings`
--
ALTER TABLE `meter_readings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `payemnt_collection_methods`
--
ALTER TABLE `payemnt_collection_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_gateway_charges`
--
ALTER TABLE `payment_gateway_charges`
  MODIFY `pgc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_gateway_historys`
--
ALTER TABLE `payment_gateway_historys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_receives`
--
ALTER TABLE `payment_receives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reading_approve`
--
ALTER TABLE `reading_approve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reset_code_passwords`
--
ALTER TABLE `reset_code_passwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `slabs`
--
ALTER TABLE `slabs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sub_category_charges`
--
ALTER TABLE `sub_category_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_divisions`
--
ALTER TABLE `sub_divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tax_types`
--
ALTER TABLE `tax_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_balance`
--
ALTER TABLE `user_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
