-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2023 at 11:39 AM
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
(1, '2023-01-01', 'generated', 1, '2023-11-20 07:10:10', '2023-11-20 07:10:10', '2023-11-22', 0),
(2, '2023-02-01', 'generated', 1, '2023-11-20 07:54:08', '2023-11-20 07:54:08', '2023-11-25', 0);

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
(1, 'F.S Surcharge', 1),
(2, 'F.P.A', 1),
(3, 'Q.T Adjustment', 1);

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
(1, 'IKRAM ULLAH', 'KHAN GHALIB', '0', 'new colony , sardheri charsadda', '1', NULL, NULL, '03335959967', 0.00, 1, 'active', '2023-09-27 05:43:11', '2023-11-16 07:50:30', 1),
(2, 'Khan', 'Khan Ghalib', '0', 'Peshawar', '2', NULL, NULL, '034812334568', 0.00, 1, 'active', '2023-10-17 06:32:43', '2023-11-16 05:39:18', 1),
(3, 'Sultan Murad', 'Khan', '0', 'Village Reshun Chitral', '3', NULL, NULL, '11111', 0.00, 1, 'active', '2023-10-19 05:09:39', '2023-11-16 05:39:48', 3),
(4, 'ali', 'ahmad', '0', 'chitral', '4', NULL, NULL, '2', 0.00, 1, 'active', '2023-10-19 05:29:02', '2023-11-16 05:39:56', 3),
(5, 'shop', 'shah', '0', 'chitral', '5', NULL, NULL, '1', 0.00, 1, 'active', '2023-10-20 06:27:38', '2023-11-16 05:40:03', 3),
(10, 'Kamran', 'Ahmad', '7', 'Upper Chitral Booni', '6', NULL, NULL, '0', 0.00, 1, 'active', '2023-11-16 07:23:22', '2023-11-16 07:43:00', 5),
(12, 'Shahid', 'Nazar khan', '1', 'Reshun Green Lasht', '11', NULL, NULL, '1', 0.00, 1, 'active', '2023-11-16 07:51:58', '2023-11-16 07:51:58', 4),
(13, 'Muhammad Umer', 'khan jee', '6', 'Koghuzi', '13', NULL, NULL, '0', 0.00, 1, 'active', '2023-11-16 07:58:31', '2023-11-16 07:58:31', 4),
(14, 'Shop C/o Tahir', 'khan', '99', 'Booni', '14', NULL, NULL, '1', 0.00, 2, 'active', '2023-11-16 08:02:00', '2023-11-16 08:02:00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `consumer_bills`
--

CREATE TABLE `consumer_bills` (
  `id` int(11) NOT NULL,
  `cm_id` int(11) NOT NULL,
  `generate_bill_id` int(11) NOT NULL,
  `reading_id` int(11) NOT NULL,
  `billing_month_year` date DEFAULT NULL,
  `peak_units` int(11) NOT NULL DEFAULT 0,
  `offpeak_units` double NOT NULL DEFAULT 0,
  `Units` int(11) DEFAULT 0,
  `currentbill` double NOT NULL DEFAULT 0,
  `total_taxes` double NOT NULL DEFAULT 0,
  `total_charges` double NOT NULL DEFAULT 0,
  `net_bill` double NOT NULL,
  `arrears` double DEFAULT 0,
  `gTotal` double NOT NULL DEFAULT 0,
  `off_peak_bill_breakup` text DEFAULT NULL,
  `charges_breakup` text DEFAULT NULL,
  `taxes_breakup` text DEFAULT NULL,
  `WithinDuedate` double NOT NULL DEFAULT 0,
  `AfterdueDate` double NOT NULL DEFAULT 0,
  `IssueDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `DueDate` datetime DEFAULT NULL,
  `IsPayed` varchar(1) NOT NULL DEFAULT '0',
  `is_payed_on_date` int(11) NOT NULL DEFAULT 0,
  `consider_amount` double NOT NULL DEFAULT 0,
  `paid_amount` double NOT NULL DEFAULT 0,
  `paid_on` date DEFAULT NULL,
  `paid_by` varchar(10) DEFAULT NULL,
  `l_p_surcharge` float NOT NULL DEFAULT 0,
  `sub_cat_finded_id` int(11) DEFAULT NULL,
  `tarrif_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `consumer_bills`
--

INSERT INTO `consumer_bills` (`id`, `cm_id`, `generate_bill_id`, `reading_id`, `billing_month_year`, `peak_units`, `offpeak_units`, `Units`, `currentbill`, `total_taxes`, `total_charges`, `net_bill`, `arrears`, `gTotal`, `off_peak_bill_breakup`, `charges_breakup`, `taxes_breakup`, `WithinDuedate`, `AfterdueDate`, `IssueDate`, `DueDate`, `IsPayed`, `is_payed_on_date`, `consider_amount`, `paid_amount`, `paid_on`, `paid_by`, `l_p_surcharge`, `sub_cat_finded_id`, `tarrif_code`) VALUES
(1, 0, 1, 1, '2023-01-01', 0, 50, 0, 824, 13, 223.95, 1061.25, 0, 1061, '[{\"units\":50,\"charges\":16.48}]', '[{\"code\":\"QTRTA\",\"charges\":1.2489,\"calculated_charges\":62.45,\"charges_type\":\"Q.T Adjustment\"},{\"code\":null,\"charges\":3.23,\"calculated_charges\":161.5,\"charges_type\":\"F.S Surcharge\"}]', '[{\"code\":\"ED\",\"tax_type\":\"E.D\",\"percentage\":1.5,\"calculated_tax\":13.3},{\"code\":\"EDFPA\",\"tax_type\":\"E.D on FPA\",\"percentage\":1.5,\"calculated_tax\":0}]', 1061, 1144, '2023-11-20 07:10:10', '2023-11-22 00:00:00', '0', 0, 1144, 0, NULL, NULL, 82.4, 3, 'A1'),
(2, 0, 1, 2, '2023-01-01', 0, 0, 0, 75, 1, 0, 76.13, 0, 76, '[]', '[{\"code\":\"QTRTA\",\"charges\":1.2489,\"calculated_charges\":0,\"charges_type\":\"Q.T Adjustment\"},{\"code\":null,\"charges\":3.23,\"calculated_charges\":0,\"charges_type\":\"F.S Surcharge\"}]', '[{\"code\":\"ED\",\"tax_type\":\"E.D\",\"percentage\":1.5,\"calculated_tax\":1.13},{\"code\":\"EDFPA\",\"tax_type\":\"E.D on FPA\",\"percentage\":1.5,\"calculated_tax\":0}]', 76, 84, '2023-11-20 07:10:10', '2023-11-22 00:00:00', '0', 0, 84, 0, NULL, NULL, 7.5, 3, 'A1'),
(3, 0, 1, 3, '2023-01-01', 0, 0, 0, 75, 1, 0, 76.13, 0, 76, '[]', '[{\"code\":\"QTRTA\",\"charges\":1.2489,\"calculated_charges\":0,\"charges_type\":\"Q.T Adjustment\"},{\"code\":null,\"charges\":3.23,\"calculated_charges\":0,\"charges_type\":\"F.S Surcharge\"}]', '[{\"code\":\"ED\",\"tax_type\":\"E.D\",\"percentage\":1.5,\"calculated_tax\":1.13},{\"code\":\"EDFPA\",\"tax_type\":\"E.D on FPA\",\"percentage\":1.5,\"calculated_tax\":0}]', 76, 84, '2023-11-20 07:10:10', '2023-11-22 00:00:00', '0', 0, 84, 0, NULL, NULL, 7.5, 3, 'A1'),
(4, 0, 1, 4, '2023-01-01', 0, 0, 0, 75, 1, 0, 76.13, 0, 76, '[]', '[{\"code\":\"QTRTA\",\"charges\":1.2489,\"calculated_charges\":0,\"charges_type\":\"Q.T Adjustment\"},{\"code\":null,\"charges\":3.23,\"calculated_charges\":0,\"charges_type\":\"F.S Surcharge\"}]', '[{\"code\":\"ED\",\"tax_type\":\"E.D\",\"percentage\":1.5,\"calculated_tax\":1.13},{\"code\":\"EDFPA\",\"tax_type\":\"E.D on FPA\",\"percentage\":1.5,\"calculated_tax\":0}]', 76, 84, '2023-11-20 07:10:10', '2023-11-22 00:00:00', '0', 0, 84, 0, NULL, NULL, 7.5, 3, 'A1'),
(5, 0, 1, 5, '2023-01-01', 0, 0, 0, 75, 1, 0, 76.13, 0, 76, '[]', '[{\"code\":\"QTRTA\",\"charges\":1.2489,\"calculated_charges\":0,\"charges_type\":\"Q.T Adjustment\"},{\"code\":null,\"charges\":3.23,\"calculated_charges\":0,\"charges_type\":\"F.S Surcharge\"}]', '[{\"code\":\"ED\",\"tax_type\":\"E.D\",\"percentage\":1.5,\"calculated_tax\":1.13},{\"code\":\"EDFPA\",\"tax_type\":\"E.D on FPA\",\"percentage\":1.5,\"calculated_tax\":0}]', 76, 84, '2023-11-20 07:10:11', '2023-11-22 00:00:00', '0', 0, 84, 0, NULL, NULL, 7.5, 3, 'A1'),
(6, 0, 1, 6, '2023-01-01', 0, 0, 0, 75, 1, 0, 76.13, 0, 76, '[]', '[{\"code\":\"QTRTA\",\"charges\":1.2489,\"calculated_charges\":0,\"charges_type\":\"Q.T Adjustment\"},{\"code\":null,\"charges\":3.23,\"calculated_charges\":0,\"charges_type\":\"F.S Surcharge\"}]', '[{\"code\":\"ED\",\"tax_type\":\"E.D\",\"percentage\":1.5,\"calculated_tax\":1.13},{\"code\":\"EDFPA\",\"tax_type\":\"E.D on FPA\",\"percentage\":1.5,\"calculated_tax\":0}]', 76, 84, '2023-11-20 07:10:11', '2023-11-22 00:00:00', '0', 0, 84, 0, NULL, NULL, 7.5, 3, 'A1'),
(7, 0, 1, 7, '2023-01-01', 0, 0, 0, 75, 1, 0, 76.13, 0, 76, '[]', '[{\"code\":\"QTRTA\",\"charges\":1.2489,\"calculated_charges\":0,\"charges_type\":\"Q.T Adjustment\"},{\"code\":null,\"charges\":3.23,\"calculated_charges\":0,\"charges_type\":\"F.S Surcharge\"}]', '[{\"code\":\"ED\",\"tax_type\":\"E.D\",\"percentage\":1.5,\"calculated_tax\":1.13},{\"code\":\"EDFPA\",\"tax_type\":\"E.D on FPA\",\"percentage\":1.5,\"calculated_tax\":0}]', 76, 84, '2023-11-20 07:10:11', '2023-11-22 00:00:00', '0', 0, 84, 0, NULL, NULL, 7.5, 3, 'A1'),
(8, 0, 1, 8, '2023-01-01', 0, 0, 0, 75, 1, 0, 76.13, 0, 76, '[]', '[{\"code\":\"QTRTA\",\"charges\":1.2489,\"calculated_charges\":0,\"charges_type\":\"Q.T Adjustment\"},{\"code\":null,\"charges\":3.23,\"calculated_charges\":0,\"charges_type\":\"F.S Surcharge\"}]', '[{\"code\":\"ED\",\"tax_type\":\"E.D\",\"percentage\":1.5,\"calculated_tax\":1.13},{\"code\":\"EDFPA\",\"tax_type\":\"E.D on FPA\",\"percentage\":1.5,\"calculated_tax\":0}]', 76, 84, '2023-11-20 07:10:11', '2023-11-22 00:00:00', '0', 0, 84, 0, NULL, NULL, 7.5, 3, 'A1'),
(9, 0, 1, 9, '2023-01-01', 0, 0, 0, 150, 5, 0, 154.5, 0, 155, '[]', '[{\"code\":\"QTRTA\",\"charges\":1.2489,\"calculated_charges\":0,\"charges_type\":\"Q.T Adjustment\"},{\"code\":null,\"charges\":3.23,\"calculated_charges\":0,\"charges_type\":\"F.S Surcharge\"}]', '[{\"code\":\"ED\",\"tax_type\":\"E.D\",\"percentage\":3,\"calculated_tax\":4.5},{\"code\":\"EDFPA\",\"tax_type\":\"E.D on FPA\",\"percentage\":3,\"calculated_tax\":0}]', 155, 170, '2023-11-20 07:10:11', '2023-11-22 00:00:00', '0', 0, 170, 0, NULL, NULL, 15, 4, 'A2'),
(10, 0, 2, 10, '2023-02-01', 0, 100, 0, 1648, 27, 447.89, 2122.48, 1144, 3266, '[{\"units\":100,\"charges\":16.48}]', '[{\"code\":\"QTRTA\",\"charges\":1.2489,\"calculated_charges\":124.89,\"charges_type\":\"Q.T Adjustment\"},{\"code\":null,\"charges\":3.23,\"calculated_charges\":323,\"charges_type\":\"F.S Surcharge\"}]', '[{\"code\":\"ED\",\"tax_type\":\"E.D\",\"percentage\":1.5,\"calculated_tax\":26.59},{\"code\":\"EDFPA\",\"tax_type\":\"E.D on FPA\",\"percentage\":1.5,\"calculated_tax\":0}]', 3266, 3431, '2023-11-20 07:54:08', '2023-11-25 00:00:00', '0', 0, 3431, 0, NULL, NULL, 164.8, 3, 'A1'),
(11, 0, 2, 11, '2023-02-01', 0, 0, 0, 75, 1, 0, 76.13, 84, 160, '[]', '[{\"code\":\"QTRTA\",\"charges\":1.2489,\"calculated_charges\":0,\"charges_type\":\"Q.T Adjustment\"},{\"code\":null,\"charges\":3.23,\"calculated_charges\":0,\"charges_type\":\"F.S Surcharge\"}]', '[{\"code\":\"ED\",\"tax_type\":\"E.D\",\"percentage\":1.5,\"calculated_tax\":1.13},{\"code\":\"EDFPA\",\"tax_type\":\"E.D on FPA\",\"percentage\":1.5,\"calculated_tax\":0}]', 160, 168, '2023-11-20 07:54:08', '2023-11-25 00:00:00', '0', 0, 168, 0, NULL, NULL, 7.5, 3, 'A1'),
(12, 0, 2, 12, '2023-02-01', 0, 0, 0, 75, 1, 0, 76.13, 84, 160, '[]', '[{\"code\":\"QTRTA\",\"charges\":1.2489,\"calculated_charges\":0,\"charges_type\":\"Q.T Adjustment\"},{\"code\":null,\"charges\":3.23,\"calculated_charges\":0,\"charges_type\":\"F.S Surcharge\"}]', '[{\"code\":\"ED\",\"tax_type\":\"E.D\",\"percentage\":1.5,\"calculated_tax\":1.13},{\"code\":\"EDFPA\",\"tax_type\":\"E.D on FPA\",\"percentage\":1.5,\"calculated_tax\":0}]', 160, 168, '2023-11-20 07:54:08', '2023-11-25 00:00:00', '0', 0, 168, 0, NULL, NULL, 7.5, 3, 'A1'),
(13, 0, 2, 13, '2023-02-01', 0, 0, 0, 75, 1, 0, 76.13, 84, 160, '[]', '[{\"code\":\"QTRTA\",\"charges\":1.2489,\"calculated_charges\":0,\"charges_type\":\"Q.T Adjustment\"},{\"code\":null,\"charges\":3.23,\"calculated_charges\":0,\"charges_type\":\"F.S Surcharge\"}]', '[{\"code\":\"ED\",\"tax_type\":\"E.D\",\"percentage\":1.5,\"calculated_tax\":1.13},{\"code\":\"EDFPA\",\"tax_type\":\"E.D on FPA\",\"percentage\":1.5,\"calculated_tax\":0}]', 160, 168, '2023-11-20 07:54:08', '2023-11-25 00:00:00', '0', 0, 168, 0, NULL, NULL, 7.5, 3, 'A1'),
(14, 0, 2, 14, '2023-02-01', 0, 0, 0, 75, 1, 0, 76.13, 84, 160, '[]', '[{\"code\":\"QTRTA\",\"charges\":1.2489,\"calculated_charges\":0,\"charges_type\":\"Q.T Adjustment\"},{\"code\":null,\"charges\":3.23,\"calculated_charges\":0,\"charges_type\":\"F.S Surcharge\"}]', '[{\"code\":\"ED\",\"tax_type\":\"E.D\",\"percentage\":1.5,\"calculated_tax\":1.13},{\"code\":\"EDFPA\",\"tax_type\":\"E.D on FPA\",\"percentage\":1.5,\"calculated_tax\":0}]', 160, 168, '2023-11-20 07:54:08', '2023-11-25 00:00:00', '0', 0, 168, 0, NULL, NULL, 7.5, 3, 'A1'),
(15, 0, 2, 15, '2023-02-01', 0, 0, 0, 75, 1, 0, 76.13, 84, 160, '[]', '[{\"code\":\"QTRTA\",\"charges\":1.2489,\"calculated_charges\":0,\"charges_type\":\"Q.T Adjustment\"},{\"code\":null,\"charges\":3.23,\"calculated_charges\":0,\"charges_type\":\"F.S Surcharge\"}]', '[{\"code\":\"ED\",\"tax_type\":\"E.D\",\"percentage\":1.5,\"calculated_tax\":1.13},{\"code\":\"EDFPA\",\"tax_type\":\"E.D on FPA\",\"percentage\":1.5,\"calculated_tax\":0}]', 160, 168, '2023-11-20 07:54:08', '2023-11-25 00:00:00', '0', 0, 168, 0, NULL, NULL, 7.5, 3, 'A1'),
(16, 0, 2, 16, '2023-02-01', 0, 0, 0, 75, 1, 0, 76.13, 84, 160, '[]', '[{\"code\":\"QTRTA\",\"charges\":1.2489,\"calculated_charges\":0,\"charges_type\":\"Q.T Adjustment\"},{\"code\":null,\"charges\":3.23,\"calculated_charges\":0,\"charges_type\":\"F.S Surcharge\"}]', '[{\"code\":\"ED\",\"tax_type\":\"E.D\",\"percentage\":1.5,\"calculated_tax\":1.13},{\"code\":\"EDFPA\",\"tax_type\":\"E.D on FPA\",\"percentage\":1.5,\"calculated_tax\":0}]', 160, 168, '2023-11-20 07:54:09', '2023-11-25 00:00:00', '0', 0, 168, 0, NULL, NULL, 7.5, 3, 'A1'),
(17, 0, 2, 17, '2023-02-01', 0, 0, 0, 75, 1, 0, 76.13, 84, 160, '[]', '[{\"code\":\"QTRTA\",\"charges\":1.2489,\"calculated_charges\":0,\"charges_type\":\"Q.T Adjustment\"},{\"code\":null,\"charges\":3.23,\"calculated_charges\":0,\"charges_type\":\"F.S Surcharge\"}]', '[{\"code\":\"ED\",\"tax_type\":\"E.D\",\"percentage\":1.5,\"calculated_tax\":1.13},{\"code\":\"EDFPA\",\"tax_type\":\"E.D on FPA\",\"percentage\":1.5,\"calculated_tax\":0}]', 160, 168, '2023-11-20 07:54:09', '2023-11-25 00:00:00', '0', 0, 168, 0, NULL, NULL, 7.5, 3, 'A1'),
(18, 0, 2, 18, '2023-02-01', 0, 0, 0, 150, 5, 0, 154.5, 170, 325, '[]', '[{\"code\":\"QTRTA\",\"charges\":1.2489,\"calculated_charges\":0,\"charges_type\":\"Q.T Adjustment\"},{\"code\":null,\"charges\":3.23,\"calculated_charges\":0,\"charges_type\":\"F.S Surcharge\"}]', '[{\"code\":\"ED\",\"tax_type\":\"E.D\",\"percentage\":3,\"calculated_tax\":4.5},{\"code\":\"EDFPA\",\"tax_type\":\"E.D on FPA\",\"percentage\":3,\"calculated_tax\":0}]', 325, 340, '2023-11-20 07:54:09', '2023-11-25 00:00:00', '0', 0, 340, 0, NULL, NULL, 15, 4, 'A2');

-- --------------------------------------------------------

--
-- Table structure for table `consumer_categories`
--

CREATE TABLE `consumer_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `tarrif_code` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consumer_categories`
--

INSERT INTO `consumer_categories` (`id`, `name`, `tarrif_code`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Domestic', 'A1', 1, '2023-09-27 05:36:16', '2023-10-30 01:27:31'),
(2, 'Commericial', 'A2', 1, '2023-09-27 05:36:25', '2023-09-27 05:36:25'),
(3, 'Industrial', 'A3', 1, '2023-10-17 05:43:15', '2023-10-17 05:43:25'),
(4, 'ABC', 'A+', 1, '2023-10-30 01:25:07', '2023-10-30 01:25:07');

-- --------------------------------------------------------

--
-- Table structure for table `consumer_ledgers`
--

CREATE TABLE `consumer_ledgers` (
  `id` int(11) NOT NULL,
  `consumer_id` int(11) NOT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `late_fee` double NOT NULL DEFAULT 0,
  `remarks` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consumer_ledgers`
--

INSERT INTO `consumer_ledgers` (`id`, `consumer_id`, `amount`, `late_fee`, `remarks`, `created_at`, `bill_id`, `payment_id`) VALUES
(1, 10, 1144, 0, '', NULL, 1, NULL),
(2, 1, 84, 0, '', NULL, 2, NULL),
(3, 2, 84, 0, '', NULL, 3, NULL),
(4, 3, 84, 0, '', NULL, 4, NULL),
(5, 4, 84, 0, '', NULL, 5, NULL),
(6, 5, 84, 0, '', NULL, 6, NULL),
(7, 12, 84, 0, '', NULL, 7, NULL),
(8, 13, 84, 0, '', NULL, 8, NULL),
(9, 14, 170, 0, '', NULL, 9, NULL),
(10, 10, 2287, 0, '', NULL, 10, NULL),
(11, 1, 84, 0, '', NULL, 11, NULL),
(12, 2, 84, 0, '', NULL, 12, NULL),
(13, 3, 84, 0, '', NULL, 13, NULL),
(14, 4, 84, 0, '', NULL, 14, NULL),
(15, 5, 84, 0, '', NULL, 15, NULL),
(16, 12, 84, 0, '', NULL, 16, NULL),
(17, 13, 84, 0, '', NULL, 17, NULL),
(18, 14, 170, 0, '', NULL, 18, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `consumer_meters`
--

CREATE TABLE `consumer_meters` (
  `cm_id` int(11) NOT NULL,
  `consumer_id` int(11) NOT NULL,
  `meter_id` int(11) NOT NULL,
  `ref_no` varchar(100) NOT NULL,
  `system_unique_no` bigint(20) NOT NULL,
  `mannual_ref_no` bigint(20) NOT NULL DEFAULT 0,
  `connection_date` date DEFAULT NULL,
  `definition_date` date DEFAULT NULL,
  `previous_reading` int(11) NOT NULL DEFAULT 0,
  `arrear` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consumer_meters`
--

INSERT INTO `consumer_meters` (`cm_id`, `consumer_id`, `meter_id`, `ref_no`, `system_unique_no`, `mannual_ref_no`, `connection_date`, `definition_date`, `previous_reading`, `arrear`) VALUES
(1, 1, 3, '8261420391904', 0, 10, '2023-08-27', '2023-09-01', 0, 0),
(2, 2, 6, '42261812', 0, 20, '2023-10-16', '2023-10-17', 0, 0),
(3, 3, 7, '16822600001000', 0, 30, '2023-10-01', '2023-10-01', 2, 1),
(4, 4, 1, '16822600001010', 0, 40, '2023-10-10', '2023-10-10', 2, 0),
(5, 5, 2, '1682261', 0, 50, '2023-10-21', '2023-10-19', 5, 0),
(7, 10, 5, '00000001', 0, 1, '2023-11-16', '2023-11-16', 8, 0),
(8, 11, 8, '121212121', 0, 121212121, '2023-11-16', '2023-11-16', 0, 0),
(9, 12, 9, '00000002', 0, 2, '2023-11-16', '2023-11-16', 5, 0),
(10, 13, 10, '00000003', 0, 3, '2016-11-23', '2016-11-23', 0, 0),
(11, 14, 11, '00000005', 0, 5, '2016-11-23', '2016-11-23', 0, 0);

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
  `priority` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `check_months` int(11) NOT NULL,
  `last_slab_apply` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consumer_sub_categories`
--

INSERT INTO `consumer_sub_categories` (`id`, `consumer_category_id`, `name`, `category_conditon_start`, `category_conditon_end`, `priority`, `is_active`, `created_at`, `updated_at`, `check_months`, `last_slab_apply`) VALUES
(1, 1, 'Life line', 1, 100, 3, 1, NULL, NULL, 12, 0),
(2, 1, 'Protected', 101, 200, 2, 1, NULL, NULL, 6, 0),
(3, 1, 'un-protected', 201, 70000, 1, 1, NULL, NULL, 6, 1),
(4, 2, 'Commerial', 1, 70000, 1, 1, NULL, NULL, 0, 1),
(7, 3, 'industrial', 1, 100000, 1, 1, NULL, NULL, 1, 0);

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
(1, 42, 'Charsadda', NULL, 1),
(2, 6, 'Dir', NULL, 1),
(3, 1, 'Upper Chitral', NULL, 1);

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
(1, 8, 'Sardhari 132 kv charsada', 1, 1),
(2, 26, 'Chitral Area', 1, 2),
(3, 6, 'Reshun', 1, 3),
(4, 7, 'Reshun', 1, 2),
(5, 8, 'Reshun-3', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `general_taxs`
--

CREATE TABLE `general_taxs` (
  `id` int(11) NOT NULL,
  `tax_percentage` float NOT NULL,
  `tax_type_id` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `con_cat_id` int(11) NOT NULL,
  `applicable_on` varchar(20) NOT NULL DEFAULT 'units',
  `code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `general_taxs`
--

INSERT INTO `general_taxs` (`id`, `tax_percentage`, `tax_type_id`, `is_active`, `con_cat_id`, `applicable_on`, `code`) VALUES
(15, 1.5, 14, 1, 1, 'charges', 'ED'),
(16, 3, 14, 1, 2, 'charges', 'ED'),
(17, 1.5, 15, 1, 1, 'charges', 'EDFPA'),
(18, 3, 15, 1, 2, 'units', 'EDFPA');

-- --------------------------------------------------------

--
-- Table structure for table `import_data`
--

CREATE TABLE `import_data` (
  `id` int(11) NOT NULL,
  `YEAR` int(11) NOT NULL,
  `MO` int(11) NOT NULL,
  `DY` int(11) NOT NULL,
  `HR` int(11) NOT NULL,
  `FR` int(11) NOT NULL,
  `complete_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instruction_levels`
--

CREATE TABLE `instruction_levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, '01', 'assigned'),
(2, '02', 'assigned'),
(3, '0391904', 'assigned'),
(4, '039194', 'assigned'),
(5, '09584', 'assigned'),
(6, '123', 'assigned'),
(7, '1234', 'assigned'),
(8, '8888', 'assigned'),
(9, '1', 'assigned'),
(10, '2', 'assigned'),
(11, '010', 'assigned');

-- --------------------------------------------------------

--
-- Table structure for table `meter_readings`
--

CREATE TABLE `meter_readings` (
  `id` int(11) NOT NULL,
  `cm_id` int(11) NOT NULL COMMENT 'consumer_meter id',
  `month_year` date DEFAULT NULL,
  `offpeak_prev` int(11) NOT NULL DEFAULT 0,
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

INSERT INTO `meter_readings` (`id`, `cm_id`, `month_year`, `offpeak_prev`, `offpeak`, `offpeak_units`, `peak`, `peak_units`, `pkimage`, `offpkimage`, `datetime`, `longitude`, `latitude`, `Observation`, `retake`, `varifier`, `mrid`, `sync`, `status`, `is_verified`) VALUES
(1, 0, '2023-01-01', 0, 50, 50, NULL, 0, NULL, NULL, '2023-11-20 07:09:45', NULL, NULL, NULL, b'0', NULL, NULL, 0, NULL, 1),
(2, 0, '2023-01-01', 0, 0, 0, 0, 0, NULL, NULL, '2023-11-20 07:09:51', NULL, NULL, NULL, b'0', NULL, NULL, 0, NULL, 1),
(3, 0, '2023-01-01', 0, 0, 0, 0, 0, NULL, NULL, '2023-11-20 07:09:51', NULL, NULL, NULL, b'0', NULL, NULL, 0, NULL, 1),
(4, 0, '2023-01-01', 0, 0, 0, 0, 0, NULL, NULL, '2023-11-20 07:09:51', NULL, NULL, NULL, b'0', NULL, NULL, 0, NULL, 1),
(5, 0, '2023-01-01', 0, 0, 0, 0, 0, NULL, NULL, '2023-11-20 07:09:51', NULL, NULL, NULL, b'0', NULL, NULL, 0, NULL, 1),
(6, 0, '2023-01-01', 0, 0, 0, 0, 0, NULL, NULL, '2023-11-20 07:09:51', NULL, NULL, NULL, b'0', NULL, NULL, 0, NULL, 1),
(7, 0, '2023-01-01', 0, 0, 0, 0, 0, NULL, NULL, '2023-11-20 07:09:51', NULL, NULL, NULL, b'0', NULL, NULL, 0, NULL, 1),
(8, 0, '2023-01-01', 0, 0, 0, 0, 0, NULL, NULL, '2023-11-20 07:09:51', NULL, NULL, NULL, b'0', NULL, NULL, 0, NULL, 1),
(9, 0, '2023-01-01', 0, 0, 0, 0, 0, NULL, NULL, '2023-11-20 07:09:51', NULL, NULL, NULL, b'0', NULL, NULL, 0, NULL, 1),
(10, 0, '2023-02-01', 50, 150, 100, NULL, 0, NULL, NULL, '2023-11-20 07:53:53', NULL, NULL, NULL, b'0', NULL, NULL, 0, NULL, 1),
(11, 0, '2023-02-01', 0, 0, 0, 0, 0, NULL, NULL, '2023-11-20 07:53:58', NULL, NULL, NULL, b'0', NULL, NULL, 0, NULL, 1),
(12, 0, '2023-02-01', 0, 0, 0, 0, 0, NULL, NULL, '2023-11-20 07:53:58', NULL, NULL, NULL, b'0', NULL, NULL, 0, NULL, 1),
(13, 0, '2023-02-01', 0, 0, 0, 0, 0, NULL, NULL, '2023-11-20 07:53:58', NULL, NULL, NULL, b'0', NULL, NULL, 0, NULL, 1),
(14, 0, '2023-02-01', 0, 0, 0, 0, 0, NULL, NULL, '2023-11-20 07:53:58', NULL, NULL, NULL, b'0', NULL, NULL, 0, NULL, 1),
(15, 0, '2023-02-01', 0, 0, 0, 0, 0, NULL, NULL, '2023-11-20 07:53:58', NULL, NULL, NULL, b'0', NULL, NULL, 0, NULL, 1),
(16, 0, '2023-02-01', 0, 0, 0, 0, 0, NULL, NULL, '2023-11-20 07:53:58', NULL, NULL, NULL, b'0', NULL, NULL, 0, NULL, 1),
(17, 0, '2023-02-01', 0, 0, 0, 0, 0, NULL, NULL, '2023-11-20 07:53:58', NULL, NULL, NULL, b'0', NULL, NULL, 0, NULL, 1),
(18, 0, '2023-02-01', 0, 0, 0, 0, 0, NULL, NULL, '2023-11-20 07:53:58', NULL, NULL, NULL, b'0', NULL, NULL, 0, NULL, 1);

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
  `option_value` text DEFAULT NULL,
  `ref_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `code`, `option_key`, `option_value`, `ref_id`) VALUES
(1, 'pageHome', 'banner_title', 'PEDO', NULL),
(2, 'pageHome', 'banner_text', 'Search you bill by refrence Number from anywhere', NULL),
(3, 'pageHome', 'instructor_text', 'We have more than 200 skilled & professional Instructors', NULL),
(4, 'pageHome', 'learn_block_title', 'PEDO objective', NULL),
(5, 'pageHome', 'learn_block_text', '<p style=\"box-sizing: border-box; padding: 0px; margin: 0px 0px 10px; border: none; outline: none; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff; color: #000000 !important;\"><strong style=\"box-sizing: border-box; padding: 0px; margin: 0px; border: none; outline: none;\">Established In 1986 as \"Small Hydel Development Organization\" with the objective to:</strong></p>\r\n<p style=\"box-sizing: border-box; padding: 0px; margin: 0px 0px 10px; border: none; outline: none; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff; color: #000000 !important;\">&nbsp;- Identify and develop hydel potential upto 5MW.</p>\r\n<p style=\"box-sizing: border-box; padding: 0px; margin: 0px 0px 10px; border: none; outline: none; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff; color: #000000 !important;\">&nbsp;- Construct small hydel stations for isolated load centers.</p>\r\n<p style=\"box-sizing: border-box; padding: 0px; margin: 0px 0px 10px; border: none; outline: none; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff; color: #000000 !important;\">&nbsp;- Operate and maintain off grid small Hydel Stations.</p>\r\n<p style=\"box-sizing: border-box; padding: 0px; margin: 0px 0px 10px; border: none; outline: none; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff; color: #000000 !important;\">In 1993, it was converted to an autonomous body under the 1993 Act and renamed as \"Sarhad Hydel Development Organization (SHYDO) \" In 2013, the name of organization was changed to \"Pakhtunkhwa Hydel Development Organization(PHYDO)\" Most recently in 2014 PHYDO was renamed as \"Pakhtunkhwa Energy Development Organization (PEDO)\" through passage of PEDO Act 2014.</p>', NULL),
(6, 'pageAbout', 'content', '<article class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-12\">\r\n<h5 class=\"mt-3 underline-heading\">OUR MISSION IS SIMPLE</h5>\r\n<p>Cobem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla dolor sit amet, consectetuer adipiscing elit.</p>\r\n<p>Aenean commodo ligula eget dolor. Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, eta rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis. Lorem ipsum dolor sit amet,Aenean commodo ligula eget dolor. Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, eta rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis. Lorem ipsum dolor sit amet,</p>\r\n<ul class=\"ul-no-padding about-ul\">\r\n<li>Commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.Commodo ligula eget dolor. Aenean massa. Port sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>\r\n<li>Dum sociis natoque penatibus et magnis dis parturient montes</li>\r\n<li>Nascetur ridiculus mus, Nulla consequat massa quis enim, Cum sociis natoque penatibus et magnis dis parturient montes</li>\r\n<li>Commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.Commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>\r\n<li>Nascetur ridiculus mus, Nulla consequat massa quis enim</li>\r\n<li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus, Nulla consequat massa quis enim</li>\r\n<li>Consectetuer adipiscing elit. Aenean commodo ligula eget dolor</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</article>\r\n<article class=\"count-block jumbotron\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6\">\r\n<h3 class=\"underline-heading\">150</h3>\r\n<h6>COUNTRIES REACHED</h6>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6\">\r\n<h3 class=\"underline-heading\">850</h3>\r\n<h6>COUNTRIES REACHED</h6>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6\">\r\n<h3 class=\"underline-heading\">38300</h3>\r\n<h6>PASSED GRADUATES</h6>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6\">\r\n<h3 class=\"underline-heading\">3400</h3>\r\n<h6>COURSES PUBLISHED</h6>\r\n</div>\r\n</div>\r\n</div>\r\n</article>\r\n<article class=\"about-features-block\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-12 text-center seperator-head mt-3\">\r\n<h3>Why choose QCA</h3>\r\n<p class=\"mt-3\">Cum doctus civibus efficiantur in imperdiet deterruisset.</p>\r\n</div>\r\n</div>\r\n<div class=\"row mt-4 mb-5\">\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-file-signature\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Hi-Tech Learning</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-users-cog\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Course Discussion</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-shield-alt\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Website Security</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-chalkboard-teacher\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Qualified teachers</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-building\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Equiped class rooms</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-digital-tachograph\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Advanced teaching</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-puzzle-piece\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Adavanced study plans</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-bullseye\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Focus on target</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-thumbs-up\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Focus on success</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-tablet-alt\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Responsive Design</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-credit-card\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">Payment Gateways</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n<div class=\"col-xl-3 col-lg-4 col-md-6 col-sm-6\">\r\n<div class=\"feature-box mx-auto text-center\"><main><i class=\"fas fa-search-plus\"></i>\r\n<div class=\"col-md-12\">\r\n<h6 class=\"instructor-title\">SEO Friendly</h6>\r\n<p>Aenean massa. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n</div>\r\n</main></div>\r\n</div>\r\n</div>\r\n</div>\r\n</article>', NULL),
(7, 'pageContact', 'telephone', '+92 (302) 5959967', NULL),
(8, 'pageContact', 'email', 'qca@example.com', NULL),
(9, 'pageContact', 'address', 'University Town, Peshawar , pakistan', NULL),
(10, 'pageContact', 'map', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.940622898076!2d-74.00543578509465!3d40.74133204375838!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259bf14f1f51f%3A0xcc1b5ab35bd75df0!2sGoogle!5e0!3m2!1sen!2sin!4v1542693598934\" width=\"100%\" height=\"100%\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', NULL),
(11, 'settingGeneral', 'application_name', 'pedo', NULL),
(12, 'settingGeneral', 'meta_key', 'Quality Coaching Academy', NULL),
(13, 'settingGeneral', 'meta_description', 'Learn every topic. On time. Every time.', NULL),
(14, 'settingGeneral', 'admin_commission', '20', NULL),
(15, 'settingGeneral', 'admin_email', 'info@qca.com', NULL),
(16, 'settingGeneral', 'minimum_withdraw', '100', NULL),
(17, 'settingGeneral', 'header_logo', 'config/logo.png', NULL),
(18, 'settingGeneral', 'fav_icon', 'config/favicon.ico', NULL),
(19, 'settingGeneral', 'footer_logo', 'config/logo_footer.png', NULL),
(20, 'settingPayment', 'username', '', NULL),
(21, 'settingPayment', 'password', '', NULL),
(22, 'settingPayment', 'signature', '', NULL),
(23, 'settingPayment', 'test_mode', '1', NULL),
(24, 'settingPayment', 'is_active', '1', NULL),
(25, 'settingEmail', 'smtp_host', NULL, NULL),
(26, 'settingEmail', 'smtp_port', NULL, NULL),
(27, 'settingEmail', 'smtp_secure', NULL, NULL),
(28, 'settingEmail', 'smtp_username', NULL, NULL),
(29, 'settingEmail', 'smtp_password', NULL, NULL),
(30, 'settingGeneral', 'old_header_logo', 'config/logo.png', NULL),
(31, 'settingGeneral', 'old_footer_logo', 'config/logo_footer.png', NULL),
(32, 'settingGeneral', 'old_fav_icon', 'config/favicon.ico', NULL),
(38, 'settingCharges', 'late_fee_surcharge', '10', NULL),
(39, 'zaroBillPayment', 'if_unit_zero_for_domestic', '75', 1),
(40, 'zaroBillPayment', 'if_unit_zero_for_commerical', '150', 2);

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
-- Table structure for table `payment_receives`
--

CREATE TABLE `payment_receives` (
  `id` int(11) NOT NULL,
  `payment_month` date NOT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` float NOT NULL,
  `ref_no` bigint(20) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `conumer_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `is_verified` tinyint(4) NOT NULL DEFAULT 0,
  `varify_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reading_approve`
--

INSERT INTO `reading_approve` (`id`, `month_year`, `created_at`, `updated_at`, `is_verified`, `varify_by`) VALUES
(1, '2023-01-01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1),
(2, '2023-02-01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1);

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
(9, 3, 1),
(10, 1, 4),
(8, 2, 1);

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
(9, 3, 301, 400, 100, 32.03, 1),
(10, 7, 1, 100000, 0, 50, 1),
(11, 8, 301, 400, 0, 32.03, 1),
(12, 8, 401, 500, 0, 35.24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category_charges`
--

CREATE TABLE `sub_category_charges` (
  `id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `charges_type_id` int(11) NOT NULL,
  `charges` float NOT NULL DEFAULT 0,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `applicable_on` varchar(20) NOT NULL DEFAULT 'units',
  `code` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category_charges`
--

INSERT INTO `sub_category_charges` (`id`, `sub_cat_id`, `charges_type_id`, `charges`, `is_active`, `applicable_on`, `code`) VALUES
(1, 1, 2, 1.8, 1, 'units', 'FPA'),
(2, 2, 2, 1.8, 1, 'units', 'FPA'),
(4, 4, 2, 1.81, 1, 'units', 'FPA'),
(5, 1, 3, 1.2489, 1, 'units', 'QTRTA'),
(6, 2, 3, 1.2489, 1, 'units', 'QTRTA'),
(7, 4, 3, 1.2489, 1, 'units', 'QTRTA'),
(9, 1, 1, 0, 1, 'units', NULL),
(10, 2, 1, 0.43, 1, 'units', NULL),
(12, 3, 3, 1.2489, 1, 'units', 'QTRTA'),
(13, 3, 1, 3.23, 1, 'units', NULL),
(14, 3, 2, 1.81, 1, 'units', 'FPA'),
(15, 4, 1, 3.23, 1, 'units', NULL);

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
(1, 261, 'Sardhari', NULL, 1, 1),
(2, 7, 'Chitral', NULL, 1, 2),
(3, 6, 'Reshun-1', NULL, 1, 3),
(4, 1, 'Upper Chitral', NULL, 1, 2);

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
(14, 'E.D', 1),
(15, 'E.D on FPA', 1);

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
(3, 'incharge', 'incharge@gmail.com', '$2a$12$lcNe9KsxRGEoKvU6vGDhdu5ZZeEhmMyttzqyx9urNxvEvh./39V/m', 1, NULL, '2023-09-01 05:32:55', '2023-09-01 05:32:55', NULL, NULL, NULL),
(4, 'Ikram', 'ikramghalib@gmail.com', '$2y$10$5GK60r45E58AIOW/q/xuROlij/e9f.PvqJCr8Pb7gnPrhrDwBwAnO', 1, NULL, '2023-10-17 06:49:43', '2023-10-17 06:49:43', NULL, NULL, NULL);

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
-- Indexes for table `consumer_ledgers`
--
ALTER TABLE `consumer_ledgers`
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
-- Indexes for table `import_data`
--
ALTER TABLE `import_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instruction_levels`
--
ALTER TABLE `instruction_levels`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `charges_types`
--
ALTER TABLE `charges_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `consumers`
--
ALTER TABLE `consumers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `consumer_bills`
--
ALTER TABLE `consumer_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `consumer_categories`
--
ALTER TABLE `consumer_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `consumer_ledgers`
--
ALTER TABLE `consumer_ledgers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `consumer_meters`
--
ALTER TABLE `consumer_meters`
  MODIFY `cm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `consumer_sub_categories`
--
ALTER TABLE `consumer_sub_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feeders`
--
ALTER TABLE `feeders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `general_taxs`
--
ALTER TABLE `general_taxs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `import_data`
--
ALTER TABLE `import_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instruction_levels`
--
ALTER TABLE `instruction_levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_categories`
--
ALTER TABLE `master_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meters`
--
ALTER TABLE `meters`
  MODIFY `meter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `meter_readings`
--
ALTER TABLE `meter_readings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `payment_receives`
--
ALTER TABLE `payment_receives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reading_approve`
--
ALTER TABLE `reading_approve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `slabs`
--
ALTER TABLE `slabs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sub_category_charges`
--
ALTER TABLE `sub_category_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sub_divisions`
--
ALTER TABLE `sub_divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tax_types`
--
ALTER TABLE `tax_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
