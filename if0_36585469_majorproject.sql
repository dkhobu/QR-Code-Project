-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql300.infinityfree.com
-- Generation Time: Jun 19, 2024 at 12:46 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_36585469_majorproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_preference`
--

CREATE TABLE `admin_preference` (
  `admin_id` int(11) NOT NULL,
  `show_add_column` tinyint(1) DEFAULT NULL,
  `show_drop_column` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aetcomputers`
--

CREATE TABLE `aetcomputers` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) DEFAULT 1,
  `device_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `pc_number` varchar(255) NOT NULL,
  `processor` varchar(255) NOT NULL,
  `ram` varchar(255) NOT NULL,
  `system_type` varchar(255) NOT NULL,
  `pen_touch` varchar(255) NOT NULL,
  `problem` text NOT NULL,
  `qr_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aetcomputers`
--

INSERT INTO `aetcomputers` (`id`, `dept_id`, `device_name`, `brand`, `pc_number`, `processor`, `ram`, `system_type`, `pen_touch`, `problem`, `qr_img`, `created_at`) VALUES
(1, 1, 'DESKTOP-DIQ73VL', 'HP', '1', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.00 GB', '64-bit operating system x64 based processor', 'none', 'Defective', '../image/qr_image_1.png', '2024-05-22 17:44:12'),
(2, 1, 'DESKTOP-DIQ73VL', 'HP', '2', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.00 GB', '64-bit operating system x64 based processor', 'none', 'MALFUNCTION ', '../image/qr_image_2.png', '2024-05-23 18:45:05'),
(3, 1, 'DESKTOP-DIQ73VL', 'HP', '3', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_3.png', '2024-05-24 14:49:21'),
(4, 1, 'DESKTOP-2K90K3N', 'HP', '4', 'intel(R)core(TM)i3-6100 CPU@3.70GHZ 3.70GHZ', '8.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_4.png', '2024-05-24 15:09:10'),
(5, 1, 'DESKTOP-DIQ73VL', 'HP', '5', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_5.png', '2024-05-24 15:47:51'),
(6, 1, 'DESKTOP-2K90K3N', 'HP', '6', 'intel(R)core(TM)i3-6100 CPU@3.70GHZ 3.70GHZ', '16.0 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/6.png', '2024-06-05 04:37:46'),
(7, 1, 'DESKTOP-DIQ73VL', 'HP', '7', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_7.png', '2024-06-06 16:40:21'),
(8, 1, 'DESKTOP-DIQ73VL', 'HP', '8', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_8.png', '2024-06-07 04:00:00'),
(9, 1, 'DESKTOP-DIQ73VL', 'HP', '9', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.0 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_9.png', '2024-06-07 04:00:00'),
(10, 1, 'DESKTOP-NDCOMQ0', 'HP', '10', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.0 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_10.png', '2024-06-07 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `aetlaptops`
--

CREATE TABLE `aetlaptops` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) DEFAULT 1,
  `device_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `lap_number` int(11) NOT NULL,
  `processor` varchar(255) NOT NULL,
  `ram` varchar(255) NOT NULL,
  `system_type` varchar(255) NOT NULL,
  `problem` text NOT NULL,
  `qr_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aetlaptops`
--

INSERT INTO `aetlaptops` (`id`, `dept_id`, `device_name`, `brand`, `lap_number`, `processor`, `ram`, `system_type`, `problem`, `qr_img`, `created_at`) VALUES
(1, 1, 'LAPTOP-7PPEQMMC', 'ASUS', 1, 'Intel(R) Core(TM) i5-1035G1 CPU @ 1.00GHz   1.20 GHz', '8.0 GB', '64-bit operating system x64 based processor', 'no problem', '../image/qr_image_1.png', '2024-05-24 17:28:48'),
(2, 1, 'DESKTOP-DIQ73VL', 'HP', 2, '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.0 GB', '64-bit operating system x64 based processor', 'no defects', '../image/2.png', '2024-06-14 04:00:00'),
(3, 1, 'DESKTOP-DIQ73VL', 'asus', 3, '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '8.00 GB', '64-bit operating system x64 based processor', 'no problem', '../image/3.png', '2024-06-10 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `aetprinters`
--

CREATE TABLE `aetprinters` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL DEFAULT 1,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `pr_number` varchar(255) NOT NULL,
  `color` varchar(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `resolution` varchar(255) NOT NULL,
  `problem` text NOT NULL,
  `qr_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aetprinters`
--

INSERT INTO `aetprinters` (`id`, `dept_id`, `brand`, `model`, `pr_number`, `color`, `type`, `resolution`, `problem`, `qr_img`, `created_at`) VALUES
(1, 1, 'HP', '2020', '1', 'black ,white, color', 'inkjet', '1200 DPI', 'no problem', '../image/qr_image_1.png', '2024-06-10 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `biotechcomputers`
--

CREATE TABLE `biotechcomputers` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) DEFAULT 2,
  `device_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `pc_number` varchar(255) NOT NULL,
  `processor` varchar(255) NOT NULL,
  `ram` varchar(255) NOT NULL,
  `system_type` varchar(255) NOT NULL,
  `pen_touch` varchar(255) NOT NULL,
  `problem` text NOT NULL,
  `qr_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `biotechcomputers`
--

INSERT INTO `biotechcomputers` (`id`, `dept_id`, `device_name`, `brand`, `pc_number`, `processor`, `ram`, `system_type`, `pen_touch`, `problem`, `qr_img`, `created_at`) VALUES
(1, 2, 'DESKTOP-ETUAAFS', 'HP', '1', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_1.png', '2024-06-06 18:24:15'),
(2, 2, 'DESKTOP-BF08VE2', 'HP', '2', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '8.00gb', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/2.png', '2024-06-06 18:31:22');

-- --------------------------------------------------------

--
-- Table structure for table `btlaptops`
--

CREATE TABLE `btlaptops` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL DEFAULT 2,
  `device_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `lap_number` varchar(255) NOT NULL,
  `processor` varchar(255) NOT NULL,
  `ram` varchar(255) NOT NULL,
  `system_type` varchar(255) NOT NULL,
  `problem` text NOT NULL,
  `qr_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `btlaptops`
--

INSERT INTO `btlaptops` (`id`, `dept_id`, `device_name`, `brand`, `lap_number`, `processor`, `ram`, `system_type`, `problem`, `qr_img`, `created_at`) VALUES
(1, 2, 'LAPTOP-7PPEQMMC', 'ASUS', '1', 'core i5', '8.00gb', '64-bit operating system x64 based processor', 'no problem', '../image/1.png', '2024-05-24 18:04:28'),
(2, 2, 'DESKTOP-DIQ73VL', 'HP', '2', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.0 GB', '64-bit operating system x64 based processor', 'Cheking', '../image/2.png', '2024-06-07 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `btprinters`
--

CREATE TABLE `btprinters` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL DEFAULT 2,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `pr_number` varchar(255) NOT NULL,
  `color` varchar(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `resolution` varchar(255) NOT NULL,
  `problem` text NOT NULL,
  `qr_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `btprinters`
--

INSERT INTO `btprinters` (`id`, `dept_id`, `brand`, `model`, `pr_number`, `color`, `type`, `resolution`, `problem`, `qr_img`, `created_at`) VALUES
(1, 2, 'HP', '2020', '1', 'black ,white, color', 'inkjet', '1200 DPI', 'no problem', '../image/1.png', '2024-05-25 09:12:47'),
(2, 2, 'HP', '2010', '2', 'black ,white, color', 'inkjet', '1200 DPI', 'no problem', '../image/2.png', '2024-06-10 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `csecomputers`
--

CREATE TABLE `csecomputers` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) DEFAULT 3,
  `device_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `pc_number` varchar(255) NOT NULL,
  `processor` varchar(255) NOT NULL,
  `ram` varchar(255) NOT NULL,
  `system_type` varchar(255) NOT NULL,
  `pen_touch` varchar(255) NOT NULL,
  `problem` text NOT NULL,
  `qr_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `csecomputers`
--

INSERT INTO `csecomputers` (`id`, `dept_id`, `device_name`, `brand`, `pc_number`, `processor`, `ram`, `system_type`, `pen_touch`, `problem`, `qr_img`, `created_at`) VALUES
(1, 3, 'DESKTOP-DIQ73VL', 'HP', '1', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.00 GB', '64-bit operating system x64 based processor', 'none', 'Ram defect ', '../image/qr_image_1.png', '2024-05-22 18:06:26'),
(2, 3, 'DESKTOP-DIQ73VL', 'HP', '2', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.0 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_2.png', '2024-05-23 19:08:05'),
(3, 3, 'DESKTOP-DIQ73VL', 'HP', '3', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_3.png', '2024-05-23 19:16:59'),
(4, 3, 'DESKTOP-2K90K3N', 'HP', '4', 'intel(R)core(TM)i3-6100 CPU@3.70GHZ 3.70GHZ', '4.00GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_4.png', '2024-05-24 15:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `cselaptops`
--

CREATE TABLE `cselaptops` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL DEFAULT 3,
  `device_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `lap_number` varchar(255) NOT NULL,
  `processor` varchar(255) NOT NULL,
  `ram` varchar(255) NOT NULL,
  `system_type` varchar(255) NOT NULL,
  `problem` text NOT NULL,
  `qr_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cselaptops`
--

INSERT INTO `cselaptops` (`id`, `dept_id`, `device_name`, `brand`, `lap_number`, `processor`, `ram`, `system_type`, `problem`, `qr_img`, `created_at`) VALUES
(1, 3, 'LAPTOP-7PPEQMMC', 'HP', '1', 'core i9', '16.0 GB', '64-bit operating system x64 based processor', 'no problem', '../image/1.png', '2024-05-24 18:15:38'),
(2, 3, 'LAPTOP-7PPEQMMC', 'HP', '2', 'core i5', '16.0 GB', '64-bit operating system x64 based processor', 'no problem', '../image/2.png', '2024-06-10 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cseprinters`
--

CREATE TABLE `cseprinters` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL DEFAULT 3,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `pr_number` varchar(255) NOT NULL,
  `color` varchar(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `resolution` varchar(255) NOT NULL,
  `problem` text NOT NULL,
  `qr_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cseprinters`
--

INSERT INTO `cseprinters` (`id`, `dept_id`, `brand`, `model`, `pr_number`, `color`, `type`, `resolution`, `problem`, `qr_img`, `created_at`) VALUES
(1, 3, 'HP', '2020', '1', 'black ,white, color', 'inkjet', '1200 DPI', 'no problem', '../image/qr_image_1.png', '2024-05-25 09:13:27'),
(2, 3, 'HP', '2020', '2', 'black ,white, color', 'inkjet', '1200 DPI', 'no problem', '../image/qr_image_2.png', '2024-06-11 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(100) DEFAULT NULL,
  `computers` varchar(300) NOT NULL,
  `laptops` varchar(300) NOT NULL,
  `printers` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`, `computers`, `laptops`, `printers`) VALUES
(1, 'aetdept', 'aetcomputers', 'aetlaptops', 'aetprinters'),
(2, 'biodept', 'biotechcomputers', 'btlaptops', 'btprinters'),
(3, 'csedept', 'csecomputers', 'cselaptops', 'cseprinters'),
(4, 'ecedept', 'ececomputers', 'ecelaptops', 'eceprinters'),
(5, 'itdept', 'itcomputers', 'itlaptops', 'itprinters');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `device_id` int(11) NOT NULL,
  `device_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_fields`
--

CREATE TABLE `dynamic_fields` (
  `id` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `is_required` tinyint(1) DEFAULT 0,
  `target_table` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ececomputers`
--

CREATE TABLE `ececomputers` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) DEFAULT 4,
  `device_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `pc_number` varchar(255) NOT NULL,
  `processor` varchar(255) NOT NULL,
  `ram` varchar(255) NOT NULL,
  `system_type` varchar(255) NOT NULL,
  `pen_touch` varchar(255) NOT NULL,
  `problem` text NOT NULL,
  `qr_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ececomputers`
--

INSERT INTO `ececomputers` (`id`, `dept_id`, `device_name`, `brand`, `pc_number`, `processor`, `ram`, `system_type`, `pen_touch`, `problem`, `qr_img`, `created_at`) VALUES
(1, 4, 'DESKTOP-DIQ73VL', 'HP', '1', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_1.png', '2024-05-22 18:03:56'),
(2, 4, 'DESKTOP-DIQ73VL', 'HP', '2', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_2.png', '2024-05-24 15:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `ecelaptops`
--

CREATE TABLE `ecelaptops` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL DEFAULT 4,
  `device_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `lap_number` varchar(255) NOT NULL,
  `processor` varchar(255) NOT NULL,
  `ram` varchar(255) NOT NULL,
  `system_type` varchar(255) NOT NULL,
  `problem` text NOT NULL,
  `qr_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ecelaptops`
--

INSERT INTO `ecelaptops` (`id`, `dept_id`, `device_name`, `brand`, `lap_number`, `processor`, `ram`, `system_type`, `problem`, `qr_img`, `created_at`) VALUES
(1, 4, 'LAPTOP-7PPEQMMC', 'HP', '1', 'core i7', '8.00gb', '64-bit operating system x64 based processor', 'no problem', '../image/qr_image_1.png', '2024-05-24 18:20:41'),
(2, 4, 'LAPTOP-7PPEQMMC', 'HP', '2', 'core i5', '8.00 GB', '64-bit operating system x64 based processor', 'no problem', '../image/2.png', '2024-06-10 04:00:00'),
(3, 4, 'LAPTOP-7PPEQMMC', 'HP', '3', 'core i5', '16.0 GB', '64-bit operating system x64 based processor', 'no problem', '../image/3.png', '2024-06-10 04:00:00'),
(4, 4, 'LAPTOP-7PPEQMMC', 'HP', '4', 'core i5', '16.0 GB', '64-bit operating system x64 based processor', 'no problem', '../image/4.png', '2024-06-10 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `eceprinters`
--

CREATE TABLE `eceprinters` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL DEFAULT 4,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `pr_number` varchar(255) NOT NULL,
  `color` varchar(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `resolution` varchar(255) NOT NULL,
  `problem` text NOT NULL,
  `qr_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eceprinters`
--

INSERT INTO `eceprinters` (`id`, `dept_id`, `brand`, `model`, `pr_number`, `color`, `type`, `resolution`, `problem`, `qr_img`, `created_at`) VALUES
(1, 4, 'HP', '2010', '1', 'black ,white, color', 'inkjet', '1200 DPI', 'no problem', '../image/qr_image_1.png', '2024-05-25 09:14:05'),
(2, 4, 'HP', '2021', '2', 'black ,white, color', 'inkjet', '1200 DPI', 'no problem', '../image/qr_image_2.png', '2024-06-10 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `itcomputers`
--

CREATE TABLE `itcomputers` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) DEFAULT 5,
  `device_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `pc_number` varchar(255) NOT NULL,
  `processor` varchar(255) NOT NULL,
  `ram` varchar(255) NOT NULL,
  `system_type` varchar(255) NOT NULL,
  `pen_touch` varchar(255) NOT NULL,
  `problem` text NOT NULL,
  `qr_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itcomputers`
--

INSERT INTO `itcomputers` (`id`, `dept_id`, `device_name`, `brand`, `pc_number`, `processor`, `ram`, `system_type`, `pen_touch`, `problem`, `qr_img`, `created_at`) VALUES
(1, 5, 'DESKTOP-DIQ73VL', 'HP', '1', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_1.png', '2024-05-21 16:07:19'),
(2, 5, 'DESKTOP-DIQ73VL', 'HP', '2', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.0 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_2.png', '2024-05-21 16:30:24'),
(3, 5, 'DESKTOP-DIQ73VL', 'HP', '3', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.0 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_3.png', '2024-05-23 19:13:26'),
(4, 5, 'DESKTOP-DIQ73VL', 'HP', '4', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '16.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_4.png', '2024-05-24 15:56:13'),
(5, 5, 'DESKTOP-2K90K3N', 'HP', '5', '12th Gen intel(R) core(TM)i3-12100 3.30GGHZ', '8.0 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_5.png', '2024-05-24 15:57:34'),
(6, 5, 'DESKTOP-2K90K3N', 'HP', '6', '12th Gen intel(R) core(TM)i3-12100 3.30GGHZ', '8.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_6.png', '2024-05-24 15:57:55'),
(7, 5, 'DESKTOP-2K90K3N', 'HP', '7', '12th Gen intel(R) core(TM)i3-12100 3.30GGHZ', '8.0 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_7.png', '2024-05-24 15:58:20'),
(8, 5, 'DESKTOP-2K90K3N', 'HP', '8', '12th Gen intel(R) core(TM)i3-12100 3.30GGHZ', '8.0 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_8.png', '2024-05-24 15:58:49'),
(9, 5, 'DESKTOP-FE5DNFI', 'HP', '9', 'based processor', '4.00GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_9.png', '2024-05-24 16:00:30'),
(10, 5, 'DESKTOP-FE5DNFI', 'HP', '10', 'based processor', '4.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_10.png', '2024-05-24 16:01:20'),
(11, 5, 'DESKTOP-ETUAAFS', 'HP', '11', 'based processor', '4.00GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_11.png', '2024-05-24 16:01:43'),
(12, 5, 'DESKTOP-NDCOMQ0', 'HP', '12', 'pentinium(R) Dual-Core E5700', '2.00GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_12.png', '2024-05-24 16:03:20'),
(13, 5, 'DESKTOP-NDCOMQ0', 'HP', '13', 'pentinium(R) Dual-Core E5700', '2.0 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_13.png', '2024-05-24 16:04:10'),
(14, 5, 'DESKTOP-NDCOMQ0', 'HP', '14', 'pentinium(R) Dual-Core E5700', '2.0 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_14.png', '2024-05-24 16:04:37'),
(15, 5, 'DESKTOP-NDCOMQ0', 'HP', '15', 'pentinium(R) Dual-Core E5700', '2.0 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_15.png', '2024-05-24 16:05:01'),
(16, 5, 'DESKTOP-NDCOMQ0', 'HP', '16', 'pentinium(R) Dual-Core E5700', '2.0 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_16.png', '2024-05-24 16:05:24'),
(17, 5, 'DESKTOP-ETUAAFS', 'HP', '17', 'intel(R)core(TM)i3-6100 CPU@3.70GHZ 3.70GHZ', '4.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_17.png', '2024-05-24 16:06:33'),
(18, 5, 'DESKTOP-ETUAAFS', 'HP', '18', 'intel(R)core(TM)i3-6100 CPU@3.70GHZ 3.70GHZ', '4.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_18.png', '2024-05-24 16:07:10'),
(19, 5, 'DESKTOP-ETUAAFS', 'HP', '19', 'intel(R)core(TM)i3-6100 CPU@3.70GHZ 3.70GHZ', '4.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_19.png', '2024-05-24 16:07:34'),
(20, 5, 'DESKTOP-ETUAAFS', 'HP', '20', 'intel(R)core(TM)i3-6100 CPU@3.70GHZ 3.70GHZ', '4.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_20.png', '2024-05-24 16:08:02'),
(21, 5, 'DESKTOP-ETUAAFS', 'HP', '21', 'intel(R)core(TM)i3-6100 CPU@3.70GHZ 3.70GHZ', '4.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_21.png', '2024-05-24 16:08:39'),
(22, 5, 'DESKTOP-ETUAAFS', 'HP', '22', 'intel(R)core(TM)i3-6100 CPU@3.70GHZ 3.70GHZ', '4.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_22.png', '2024-05-24 16:09:17'),
(23, 5, 'DESKTOP-ETUAAFS', 'HP', '23', 'intel(R)core(TM)i3-6100 CPU@3.70GHZ 3.70GHZ', '4.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_23.png', '2024-05-24 16:09:46'),
(24, 5, 'DESKTOP-BF08VE2', 'HP', '24', 'intel(R)core(TM)i3-6100 CPU@3.70GHZ 3.70GHZ', '4.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_24.png', '2024-05-24 16:11:32'),
(25, 5, 'DESKTOP-BF08VE2', 'HP', '25', 'intel(R)core(TM)i3-6100 CPU@3.70GHZ 3.70GHZ', '4.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_25.png', '2024-05-24 16:11:58'),
(26, 5, 'DESKTOP-BF08VE2', 'HP', '26', 'intel(R)core(TM)i3-6100 CPU@3.70GHZ 3.70GHZ', '4.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_26.png', '2024-05-24 16:12:29'),
(27, 5, 'DESKTOP-BF08VE2', 'HP', '27', 'intel(R)core(TM)i3-6100 CPU@3.70GHZ 3.70GHZ', '4.00 GB', '64-bit operating system x64 based processor', 'none', 'no problem', '../image/qr_image_27.png', '2024-05-24 16:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `itlaptops`
--

CREATE TABLE `itlaptops` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL DEFAULT 5,
  `device_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `lap_number` varchar(255) NOT NULL,
  `processor` varchar(255) NOT NULL,
  `ram` varchar(255) NOT NULL,
  `system_type` varchar(255) NOT NULL,
  `problem` text NOT NULL,
  `qr_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itlaptops`
--

INSERT INTO `itlaptops` (`id`, `dept_id`, `device_name`, `brand`, `lap_number`, `processor`, `ram`, `system_type`, `problem`, `qr_img`, `created_at`) VALUES
(1, 5, 'LAPTOP-7PPEQMMC', 'ASUS', '1', '12th Gen intel(R) core(TM)i7-1255U 1.70GGHZ', '8.00 GB', '64-bit operating system x64 based processor', 'Testing', '../image/qr_image_1.png', '2024-05-24 18:24:59'),
(2, 5, 'LAPTOP-7PPEQMMC', 'HP', '2', 'intel(R)core(TM)i3-6100 CPU@3.70GHZ 3.70GHZ', '16.00 GB', '64-bit operating system x64 based processor', 'no problem', '../image/qr_image_2.png', '2024-06-10 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `itprinters`
--

CREATE TABLE `itprinters` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL DEFAULT 5,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `pr_number` varchar(255) NOT NULL,
  `color` varchar(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `resolution` varchar(255) NOT NULL,
  `problem` text NOT NULL,
  `qr_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itprinters`
--

INSERT INTO `itprinters` (`id`, `dept_id`, `brand`, `model`, `pr_number`, `color`, `type`, `resolution`, `problem`, `qr_img`, `created_at`) VALUES
(1, 5, 'HP', '2020', '1', 'black ,white, color', 'inkjet', '1200 DPI', 'no problem', '../image/qr_image_1.png', '2024-05-25 06:44:17'),
(2, 5, 'HP', '2021', '2', 'back,white', 'inkjet', '1100 DPI', 'no problem', '../image/qr_image_2.png', '2024-05-25 08:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `laptopreports`
--

CREATE TABLE `laptopreports` (
  `id` int(11) NOT NULL,
  `lap_number` varchar(255) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `report_message` text NOT NULL,
  `reported_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laptopreports`
--

INSERT INTO `laptopreports` (`id`, `lap_number`, `dept_id`, `report_message`, `reported_by`, `created_at`, `status`) VALUES
(1, '1', 1, 'Storage full', 'Yinga', '2024-05-24 17:37:25', 'Completed'),
(2, '1', 4, 'Testing', 'Yinga', '2024-05-28 18:12:36', 'In Progress'),
(3, '1', 1, 'Testing', 'yinga', '2024-06-06 19:44:48', 'Completed'),
(4, '1', 4, 'Testing', 'yinga', '2024-06-06 19:56:02', 'Pending'),
(5, '1', 1, 'Testinf', 'yinga', '2024-06-06 19:57:18', ''),
(6, '1', 1, 'Testinf', 'yinga', '2024-06-06 19:57:18', ''),
(7, '1', 1, 'Testing', 'yinga', '2024-06-06 19:58:51', ''),
(8, '1', 5, 'Testing', 'yinga', '2024-06-06 19:59:42', ''),
(9, '1', 1, 'Testing ', 'Yinga', '2024-06-10 14:11:15', ''),
(10, '2', 2, 'Cheking', 'Yinga', '2024-06-10 14:22:27', '');

-- --------------------------------------------------------

--
-- Table structure for table `printerreports`
--

CREATE TABLE `printerreports` (
  `id` int(11) NOT NULL,
  `pr_number` varchar(255) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `report_message` text NOT NULL,
  `reported_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `printerreports`
--

INSERT INTO `printerreports` (`id`, `pr_number`, `dept_id`, `report_message`, `reported_by`, `created_at`, `status`) VALUES
(1, '1', 5, 'No black color', 'Yinga', '2024-05-25 06:57:37', 'Completed'),
(2, '1', 5, 'No white', 'Yinga', '2024-05-25 08:41:12', 'Completed'),
(3, '1', 4, 'No Black color', 'Yinga', '2024-05-25 09:14:28', 'In Progress'),
(4, '2', 5, 'Testing ', 'Yinga', '2024-05-28 18:13:16', ''),
(5, '2', 1, 'Checking', 'Yinga', '2024-06-10 16:15:15', '');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `pc_number` varchar(255) NOT NULL,
  `dept_id` varchar(255) NOT NULL,
  `report_message` text NOT NULL,
  `reported_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT 'Pending'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `pc_number`, `dept_id`, `report_message`, `reported_by`, `created_at`, `status`) VALUES
(1, '1', '1', 'Testing', 'Yinga', '2024-06-10 18:47:44', 'Completed'),
(2, '27', '5', 'Ram defect\r\n', 'Yinga', '2024-06-11 02:52:39', 'Pending'),
(3, '27', '5', 'Testing', 'Yinga', '2024-06-11 04:00:19', 'Pending'),
(4, '27', '5', 'Testing', 'Yinga', '2024-06-11 04:00:19', 'Completed'),
(5, '27', '5', 'Testing', 'Yinga', '2024-06-11 04:00:33', 'Pending'),
(6, '2', '1', 'Testing', 'John', '2024-06-11 04:10:34', 'Pending'),
(7, '2', '1', 'MALFUNCTION ', 'Khobu', '2024-06-11 05:40:55', 'Pending'),
(8, '1', '1', 'Defective', 'Shanchamo Yanthan ', '2024-06-11 09:05:49', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `users_regis`
--

CREATE TABLE `users_regis` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_regis`
--

INSERT INTO `users_regis` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'yinga', 'yinga@gmail.com', '1111', 'admin', '2024-05-21 13:11:33'),
(2, 'george', 'george@gmail.com', '2222', 'staff', '2024-05-21 16:44:03'),
(3, 'Khobu', 'dkhobu@gmail.com', 'qwerty', 'admin', '2024-05-25 14:27:23'),
(4, 'Pete', 'mutulohe@gmail.com', '12345', 'staff', '2024-05-25 15:18:24'),
(8, 'John', 'john@gmail.com', '$2y$10$a9qv08rBhVXgL1x4Yshjce2exNNOQYLJDKjPUGqdbE01nqmKot.u2', 'staff', '2024-06-11 04:10:16'),
(6, 'Limugha chophy', 'limughachophy030@gmail.com', 'thesummeriturnedpretty', 'staff', '2024-05-27 18:15:28'),
(7, 'sam', 'sam@gmail.com', '0000', 'admin', '2024-05-28 16:24:09'),
(9, 'Shan', 'shan@gmail.com', '$2y$10$gD2pE1uKEwOc6LkogLKsdu1mz.D07ugF8xr5JjUs0R6UUUNHo5hPa', 'staff', '2024-06-11 06:34:01'),
(10, 'Shanchamo Yanthan ', 'syanthan@gmail.com', '$2y$10$5qRHCKc0eQgEusN1HS8KQ.vIRhlxrV1bNT8ExOF.FkTrr/eco5WWe', 'staff', '2024-06-11 09:05:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_preference`
--
ALTER TABLE `admin_preference`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `aetcomputers`
--
ALTER TABLE `aetcomputers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_pc_number` (`pc_number`),
  ADD KEY `fk_aetcomputers_dept_id` (`dept_id`);

--
-- Indexes for table `aetlaptops`
--
ALTER TABLE `aetlaptops`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_lap_number` (`lap_number`),
  ADD KEY `fk_aetlaptops_dept_id` (`dept_id`);

--
-- Indexes for table `aetprinters`
--
ALTER TABLE `aetprinters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_pr_number` (`pr_number`),
  ADD KEY `fk_dept_id` (`dept_id`);

--
-- Indexes for table `biotechcomputers`
--
ALTER TABLE `biotechcomputers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_pc_number` (`pc_number`),
  ADD KEY `fk_dept` (`dept_id`);

--
-- Indexes for table `btlaptops`
--
ALTER TABLE `btlaptops`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_lap_number` (`lap_number`),
  ADD KEY `fk_dept_id` (`dept_id`);

--
-- Indexes for table `btprinters`
--
ALTER TABLE `btprinters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_pr_number` (`pr_number`),
  ADD KEY `fk_dept_id` (`dept_id`);

--
-- Indexes for table `csecomputers`
--
ALTER TABLE `csecomputers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_pc_number` (`pc_number`),
  ADD KEY `fk_dept` (`dept_id`);

--
-- Indexes for table `cselaptops`
--
ALTER TABLE `cselaptops`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_lap_number` (`lap_number`),
  ADD KEY `fk_dept_id` (`dept_id`);

--
-- Indexes for table `cseprinters`
--
ALTER TABLE `cseprinters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_pr_number` (`pr_number`),
  ADD KEY `fk_dept_id` (`dept_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`),
  ADD UNIQUE KEY `dept_name` (`dept_name`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`device_id`);

--
-- Indexes for table `dynamic_fields`
--
ALTER TABLE `dynamic_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ececomputers`
--
ALTER TABLE `ececomputers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_pc_number` (`pc_number`),
  ADD KEY `fk_dept` (`dept_id`);

--
-- Indexes for table `ecelaptops`
--
ALTER TABLE `ecelaptops`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_lap_number` (`lap_number`),
  ADD KEY `fk_dept_id` (`dept_id`);

--
-- Indexes for table `eceprinters`
--
ALTER TABLE `eceprinters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_pr_number` (`pr_number`),
  ADD KEY `fk_dept_id` (`dept_id`);

--
-- Indexes for table `itcomputers`
--
ALTER TABLE `itcomputers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_pc_number` (`pc_number`),
  ADD KEY `fk_dept` (`dept_id`);

--
-- Indexes for table `itlaptops`
--
ALTER TABLE `itlaptops`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_lap_number` (`lap_number`),
  ADD KEY `fk_dept_id` (`dept_id`);

--
-- Indexes for table `itprinters`
--
ALTER TABLE `itprinters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_pr_number` (`pr_number`),
  ADD KEY `fk_dept_id` (`dept_id`);

--
-- Indexes for table `laptopreports`
--
ALTER TABLE `laptopreports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `printerreports`
--
ALTER TABLE `printerreports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reports_dept` (`dept_id`);

--
-- Indexes for table `users_regis`
--
ALTER TABLE `users_regis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_preference`
--
ALTER TABLE `admin_preference`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aetcomputers`
--
ALTER TABLE `aetcomputers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `aetlaptops`
--
ALTER TABLE `aetlaptops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `aetprinters`
--
ALTER TABLE `aetprinters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `biotechcomputers`
--
ALTER TABLE `biotechcomputers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `btlaptops`
--
ALTER TABLE `btlaptops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `btprinters`
--
ALTER TABLE `btprinters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `csecomputers`
--
ALTER TABLE `csecomputers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cselaptops`
--
ALTER TABLE `cselaptops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cseprinters`
--
ALTER TABLE `cseprinters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dynamic_fields`
--
ALTER TABLE `dynamic_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ececomputers`
--
ALTER TABLE `ececomputers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ecelaptops`
--
ALTER TABLE `ecelaptops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `eceprinters`
--
ALTER TABLE `eceprinters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `itcomputers`
--
ALTER TABLE `itcomputers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `itlaptops`
--
ALTER TABLE `itlaptops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `itprinters`
--
ALTER TABLE `itprinters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `laptopreports`
--
ALTER TABLE `laptopreports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `printerreports`
--
ALTER TABLE `printerreports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users_regis`
--
ALTER TABLE `users_regis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
