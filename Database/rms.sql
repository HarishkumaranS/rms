-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2025 at 05:34 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(2) NOT NULL,
  `name` varchar(20) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `ph_no` bigint(10) NOT NULL,
  `password` varchar(30) NOT NULL,
  `login` varchar(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `name`, `user_name`, `ph_no`, `password`, `login`, `status`) VALUES
(1, 'Harishkumaran', 'Harishkumaran', 9865139150, 'Harishkumaran@2004', 'admin', 1),
(2, 'Thaiyanban', 'Thaiyanban', 6380476613, 'Thaiyanban@2005', 'admin', 1),
(3, 'Tharun PB', 'Tharun', 7339286428, 'Tharun@2005', 'biller', 1),
(4, 'Senthil', 'Senthil', 9865139150, 'Senthil@29', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(20) DEFAULT NULL,
  `status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `status`) VALUES
(1, 'Veg', 1),
(2, 'Non Veg', 1),
(3, 'Dessert', 1),
(4, 'Starter', 1),
(5, 'Fresh Juice', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(255) DEFAULT NULL,
  `cust_num` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_num`) VALUES
(1, 'Harishkumaran S', '9865139150'),
(2, 'Kumaran R', '7894561236'),
(3, 'Mohan V', '9874563210'),
(4, 'Chetan Kumar', '9874566321'),
(5, 'Nirmala S', '9498861061'),
(6, 'Tharun B', '7894561230'),
(7, 'Pooja R', '9876543201'),
(8, 'Ravi Shankar', '8765432109'),
(9, 'Divya Nair', '7654321098'),
(10, 'Vikram Singh', '6543210987'),
(11, 'Meera S', '5432109876'),
(12, 'Rohit Kumar', '4321098765'),
(13, 'Ananya Roy', '3210987654'),
(14, 'Suraj Patel', '2109876543'),
(15, 'Ishita Bansal', '1098765432'),
(16, 'Yash Thakur', '9988776655'),
(17, 'Amit Joshi', '8877665544'),
(18, 'Sneha Reddy', '7766554433'),
(19, 'Rahul Mehta', '6655443322'),
(20, 'Karthik R', '5544332211'),
(21, 'Neha Kapoor', '4433221100'),
(22, 'Sanjay Iyer', '3322110099'),
(23, 'Deepika Arora', '2211009988'),
(24, 'Varun Chawla', '1100998877'),
(25, 'Priya Saxena', '9900887766'),
(26, 'harishkumaran s', '8838263645');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `e_id` int(3) NOT NULL,
  `e_name` varchar(20) DEFAULT NULL,
  `e_cost` int(6) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`e_id`, `e_name`, `e_cost`, `status`) VALUES
(1, 'Birthday Party', 17000, 1),
(2, 'DJ Party', 20000, 1),
(3, 'Ear Piercing', 23000, 1),
(4, 'Business Meeting', 15000, 1),
(5, 'Wedding Reception', 50000, 1),
(6, 'Corporate Seminar', 35000, 1),
(7, 'Baby Shower', 18000, 1),
(8, 'Retirement Party', 22000, 1),
(9, 'Engagement Ceremony', 40000, 1),
(10, 'College Reunion', 25000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_booking`
--

CREATE TABLE `event_booking` (
  `b_id` int(2) NOT NULL,
  `date` date NOT NULL,
  `b_date` date NOT NULL,
  `e_id` int(2) NOT NULL,
  `cust_id` int(2) NOT NULL,
  `time` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_booking`
--

INSERT INTO `event_booking` (`b_id`, `date`, `b_date`, `e_id`, `cust_id`, `time`) VALUES
(1, '2024-12-25', '2025-01-18', 1, 6, 'evening'),
(2, '2024-12-30', '2025-01-22', 2, 21, 'morning'),
(3, '2025-01-01', '2025-01-15', 4, 21, 'morning'),
(4, '2025-01-03', '2025-01-12', 2, 2, 'evening'),
(5, '2025-01-03', '2025-01-27', 5, 4, 'evening'),
(6, '2025-01-07', '2025-02-05', 6, 23, 'evening'),
(7, '2025-01-10', '2025-01-29', 7, 5, 'evening'),
(8, '2025-01-10', '2025-01-31', 2, 10, 'evening'),
(9, '2025-01-10', '2025-02-15', 4, 2, 'evening'),
(10, '2025-01-12', '2025-01-30', 7, 14, 'evening'),
(11, '2025-01-12', '2025-02-08', 10, 2, 'morning'),
(12, '2025-01-15', '2025-01-30', 8, 6, 'morning'),
(13, '2025-01-15', '2025-02-22', 3, 13, 'evening'),
(14, '2025-01-15', '2025-03-06', 5, 16, 'morning'),
(15, '2025-01-15', '2025-02-28', 9, 25, 'evening'),
(16, '2025-01-18', '2025-01-29', 9, 5, 'evening'),
(17, '2025-01-18', '2025-02-07', 7, 18, 'morning'),
(18, '2025-01-20', '2025-02-14', 3, 17, 'evening'),
(19, '2025-01-22', '2025-02-06', 2, 4, 'morning'),
(20, '2025-01-22', '2025-02-20', 5, 9, 'morning'),
(21, '2025-01-23', '2025-02-11', 10, 14, 'evening'),
(22, '2025-01-25', '2025-03-10', 10, 8, 'morning'),
(23, '2025-01-25', '2025-02-28', 9, 25, 'evening'),
(24, '2025-01-28', '2025-02-10', 9, 12, 'evening'),
(25, '2025-01-28', '2025-02-18', 8, 25, 'evening'),
(26, '2025-01-28', '2025-03-02', 3, 2, 'morning'),
(27, '2025-01-29', '2025-02-24', 4, 1, 'evening'),
(28, '2025-01-30', '2025-02-20', 9, 12, 'morning'),
(29, '2025-01-30', '2025-02-25', 7, 9, 'morning'),
(30, '2025-01-30', '2025-03-05', 5, 16, 'evening'),
(31, '2025-01-30', '2025-03-10', 4, 19, 'evening'),
(32, '2025-01-31', '2025-03-08', 6, 22, 'evening'),
(33, '2025-02-05', '2025-02-22', 7, 15, 'morning'),
(34, '2025-02-07', '2025-03-02', 4, 9, 'morning'),
(35, '2025-02-07', '2025-03-10', 2, 20, 'evening'),
(36, '2025-02-10', '2025-03-03', 8, 19, 'morning'),
(37, '2025-02-10', '2025-03-11', 4, 11, 'morning'),
(38, '2025-02-12', '2025-03-20', 1, 14, 'evening'),
(39, '2025-02-15', '2025-03-15', 8, 6, 'morning'),
(40, '2025-02-18', '2025-03-05', 8, 20, 'morning'),
(41, '2025-02-18', '2025-03-15', 9, 21, 'morning'),
(42, '2025-02-18', '2025-03-28', 8, 18, 'evening'),
(43, '2025-02-20', '2025-03-01', 2, 20, 'evening'),
(44, '2025-02-20', '2025-03-20', 5, 3, 'morning'),
(45, '2025-02-20', '2025-03-25', 3, 25, 'evening'),
(46, '2025-02-22', '2025-03-06', 5, 16, 'morning'),
(47, '2025-02-22', '2025-03-09', 2, 9, 'evening'),
(48, '2025-02-22', '2025-03-18', 6, 7, 'evening'),
(49, '2025-02-28', '2025-03-15', 9, 21, 'morning'),
(50, '2025-03-01', '2025-03-20', 4, 12, 'evening'),
(51, '2025-03-03', '2025-03-25', 5, 18, 'morning'),
(52, '2025-03-05', '2025-03-28', 3, 6, 'evening'),
(53, '2025-03-06', '2025-03-30', 2, 15, 'morning'),
(54, '2025-03-08', '2025-04-02', 9, 22, 'evening'),
(55, '2025-03-10', '2025-04-05', 7, 20, 'morning'),
(56, '2025-03-12', '2025-04-08', 8, 25, 'evening'),
(57, '2025-03-15', '2025-04-10', 10, 14, 'morning'),
(58, '2025-03-18', '2025-04-15', 6, 9, 'evening'),
(59, '2025-03-20', '2025-04-18', 3, 11, 'morning'),
(60, '2025-03-22', '2025-04-20', 5, 17, 'evening'),
(61, '2025-03-25', '2025-04-22', 7, 8, 'morning'),
(62, '2025-03-27', '2025-04-25', 4, 13, 'evening'),
(63, '2025-03-28', '2025-04-27', 6, 21, 'morning'),
(64, '2025-03-30', '2025-04-28', 2, 19, 'evening'),
(65, '2025-04-01', '2025-04-30', 9, 23, 'morning'),
(66, '2025-04-03', '2025-05-02', 10, 14, 'evening'),
(67, '2025-04-05', '2025-05-05', 8, 7, 'morning'),
(68, '2025-04-07', '2025-05-07', 3, 12, 'evening'),
(69, '2025-04-10', '2025-05-10', 1, 6, 'morning');

-- --------------------------------------------------------

--
-- Table structure for table `fav`
--

CREATE TABLE `fav` (
  `fav_id` int(5) NOT NULL,
  `product_id` int(3) NOT NULL,
  `user_id` int(5) NOT NULL,
  `qty` int(3) DEFAULT 1,
  `c_price` decimal(10,2) DEFAULT NULL,
  `fav_c_price` decimal(10,2) DEFAULT NULL,
  `p_price` decimal(10,2) DEFAULT NULL,
  `fav_p_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fav`
--

INSERT INTO `fav` (`fav_id`, `product_id`, `user_id`, `qty`, `c_price`, `fav_c_price`, `p_price`, `fav_p_price`) VALUES
(7, 20, 3, 3, 91.00, 273.00, 100.00, 300.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_off`
--

CREATE TABLE `order_off` (
  `o_id` int(11) NOT NULL,
  `order_date` date DEFAULT NULL,
  `order_time` time DEFAULT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total_price` int(6) DEFAULT NULL,
  `service` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_off`
--

INSERT INTO `order_off` (`o_id`, `order_date`, `order_time`, `cust_id`, `product_id`, `qty`, `total_price`, `service`) VALUES
(1, '2024-12-02', '06:21:27', 16, 13, 5, 1920, 'Dining'),
(2, '2024-12-04', '11:53:26', 4, 15, 5, 1350, 'Takeaway'),
(3, '2024-12-06', '03:04:37', 1, 9, 1, 359, 'Dining'),
(4, '2024-12-06', '16:42:26', 25, 9, 5, 1795, 'Takeaway'),
(5, '2024-12-11', '16:24:35', 20, 20, 3, 273, 'Dining'),
(6, '2024-12-16', '00:48:59', 18, 15, 4, 1080, 'Takeaway'),
(7, '2024-12-16', '13:40:35', 9, 20, 5, 455, 'Dining'),
(8, '2024-12-18', '01:42:23', 11, 7, 3, 501, 'Dining'),
(9, '2024-12-19', '07:39:50', 4, 14, 3, 141, 'Takeaway'),
(10, '2024-12-23', '09:02:29', 9, 15, 4, 1080, 'Takeaway'),
(11, '2024-12-28', '08:45:56', 10, 19, 1, 162, 'Dining'),
(12, '2025-01-03', '18:00:12', 5, 20, 3, 273, 'Takeaway'),
(13, '2025-01-04', '13:04:25', 1, 8, 2, 128, 'Dining'),
(14, '2025-01-05', '21:58:45', 14, 19, 1, 162, 'Dining'),
(15, '2025-01-06', '17:23:11', 7, 9, 1, 359, 'Takeaway'),
(16, '2025-01-07', '21:09:26', 9, 13, 1, 384, 'Dining'),
(17, '2025-01-10', '22:42:31', 13, 13, 2, 768, 'Takeaway'),
(18, '2025-01-11', '00:48:30', 21, 3, 1, 214, 'Takeaway'),
(19, '2025-01-12', '21:43:18', 5, 2, 2, 188, 'Dining'),
(20, '2025-01-13', '06:53:52', 13, 22, 1, 180, 'Dining'),
(21, '2025-01-14', '11:23:56', 11, 10, 1, 188, 'Dining'),
(22, '2025-01-14', '15:17:31', 7, 8, 2, 128, 'Takeaway'),
(23, '2025-01-15', '18:09:50', 25, 6, 1, 319, 'Takeaway'),
(24, '2025-01-16', '07:00:14', 2, 7, 4, 668, 'Dining'),
(25, '2025-01-19', '15:30:55', 14, 11, 1, 57, 'Dining'),
(26, '2025-01-21', '03:15:23', 17, 10, 1, 188, 'Takeaway'),
(27, '2025-01-24', '16:33:32', 20, 3, 2, 428, 'Takeaway'),
(28, '2025-01-26', '07:53:13', 20, 19, 2, 324, 'Takeaway'),
(29, '2025-01-26', '18:53:17', 8, 5, 1, 233, 'Dining'),
(30, '2025-01-27', '04:33:19', 13, 12, 4, 376, 'Takeaway'),
(31, '2025-01-27', '15:46:46', 7, 3, 2, 428, 'Dining'),
(32, '2025-01-27', '16:52:11', 9, 6, 2, 638, 'Takeaway'),
(33, '2025-01-28', '03:19:02', 6, 16, 5, 290, 'Dining'),
(34, '2025-01-29', '10:57:49', 6, 20, 5, 455, 'Dining'),
(35, '2025-01-29', '23:24:59', 6, 11, 4, 228, 'Dining'),
(36, '2025-01-30', '06:13:48', 21, 10, 2, 376, 'Takeaway'),
(37, '2025-01-30', '13:11:29', 9, 21, 1, 90, 'Dining'),
(38, '2025-02-01', '19:57:28', 25, 1, 3, 669, 'Takeaway'),
(39, '2025-02-03', '03:01:06', 11, 14, 3, 141, 'Dining'),
(40, '2025-02-03', '06:31:24', 4, 19, 1, 162, 'Dining'),
(41, '2025-02-05', '01:05:57', 18, 21, 1, 90, 'Dining'),
(42, '2025-02-05', '16:12:18', 10, 16, 2, 116, 'Dining'),
(43, '2025-02-06', '23:12:48', 5, 15, 3, 810, 'Dining'),
(44, '2025-02-09', '01:30:09', 3, 18, 3, 282, 'Dining'),
(45, '2025-02-09', '14:34:02', 5, 1, 3, 669, 'Dining'),
(46, '2025-02-10', '20:45:51', 12, 12, 2, 188, 'Dining'),
(47, '2025-02-12', '05:04:37', 1, 22, 2, 360, 'Dining'),
(48, '2025-02-18', '00:35:29', 1, 2, 1, 94, 'Dining'),
(49, '2025-02-18', '00:35:29', 1, 19, 1, 162, 'Dining'),
(50, '2025-02-18', '00:35:29', 1, 13, 2, 768, 'Dining'),
(51, '2025-02-18', '02:08:34', 26, 2, 2, 188, 'Dining'),
(52, '2025-02-18', '02:08:34', 26, 2, 2, 188, 'Dining'),
(53, '2025-02-18', '02:10:13', 6, 1, 7, 1631, 'Dining'),
(54, '2025-02-18', '02:10:13', 6, 3, 5, 1070, 'Dining'),
(55, '2025-02-18', '13:44:46', 1, 2, 1, 94, 'Dining'),
(56, '2025-02-18', '13:44:46', 1, 3, 1, 214, 'Dining'),
(57, '2025-02-18', '13:44:46', 1, 4, 2, 194, 'Dining'),
(58, '2025-02-18', '13:44:46', 1, 15, 1, 270, 'Dining'),
(59, '2025-02-18', '15:09:39', 1, 2, 1, 94, 'Dining'),
(60, '2025-02-19', '08:20:10', 15, 8, 2, 128, 'Takeaway'),
(61, '2025-02-19', '12:45:37', 8, 5, 1, 233, 'Dining'),
(62, '2025-02-20', '14:10:22', 11, 9, 3, 1077, 'Takeaway'),
(63, '2025-02-21', '18:30:45', 22, 7, 4, 668, 'Dining'),
(64, '2025-02-22', '09:55:33', 19, 12, 2, 188, 'Dining'),
(65, '2025-02-23', '21:15:58', 7, 3, 2, 428, 'Takeaway'),
(66, '2025-02-24', '16:28:40', 10, 19, 1, 162, 'Dining'),
(67, '2025-02-25', '06:50:12', 3, 15, 4, 1080, 'Dining'),
(68, '2025-02-26', '13:33:27', 16, 6, 3, 957, 'Takeaway'),
(69, '2025-02-27', '22:05:44', 5, 11, 2, 114, 'Dining'),
(70, '2025-02-28', '10:14:32', 9, 4, 2, 194, 'Takeaway'),
(71, '2025-03-01', '17:30:19', 14, 7, 1, 167, 'Dining'),
(72, '2025-03-02', '09:45:50', 6, 10, 2, 376, 'Dining'),
(73, '2025-03-03', '20:25:40', 11, 22, 1, 180, 'Takeaway'),
(74, '2025-03-04', '12:10:05', 18, 6, 2, 638, 'Dining'),
(75, '2025-03-05', '22:58:13', 7, 20, 4, 364, 'Dining'),
(76, '2025-03-06', '06:33:47', 10, 14, 2, 94, 'Takeaway'),
(77, '2025-03-07', '14:20:59', 3, 8, 3, 192, 'Dining'),
(78, '2025-03-08', '19:42:15', 21, 5, 2, 466, 'Takeaway'),
(79, '2025-03-09', '08:18:31', 12, 19, 3, 486, 'Dining'),
(80, '2025-03-10', '17:55:22', 25, 3, 1, 214, 'Takeaway'),
(81, '2025-03-11', '10:37:14', 15, 12, 1, 94, 'Dining'),
(82, '2025-03-12', '20:48:37', 4, 1, 2, 446, 'Takeaway'),
(83, '2025-03-13', '05:29:08', 20, 11, 1, 57, 'Dining'),
(84, '2025-03-14', '13:11:43', 8, 21, 2, 180, 'Dining'),
(85, '2025-03-15', '23:30:16', 17, 15, 3, 810, 'Takeaway'),
(86, '2025-03-16', '07:40:25', 6, 17, 1, 102, 'Dining'),
(87, '2025-03-17', '16:20:59', 9, 2, 3, 282, 'Dining'),
(88, '2025-03-18', '14:05:32', 13, 4, 1, 97, 'Takeaway'),
(89, '2025-03-19', '22:55:41', 24, 16, 4, 232, 'Dining'),
(90, '2025-03-28', '01:58:56', 26, 2, 2, 188, ' Takeaway');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(3) NOT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_scale` varchar(100) DEFAULT NULL,
  `product_des` varchar(500) DEFAULT NULL,
  `product_keyword` varchar(500) DEFAULT NULL,
  `product_cat` varchar(20) DEFAULT NULL,
  `product_img` varchar(100) DEFAULT NULL,
  `product_img2` varchar(100) DEFAULT NULL,
  `product_img3` varchar(100) DEFAULT NULL,
  `product_stock` int(3) DEFAULT NULL,
  `product_price` int(5) DEFAULT NULL,
  `product_off` int(2) DEFAULT NULL,
  `product_c_price` int(5) DEFAULT NULL,
  `status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_scale`, `product_des`, `product_keyword`, `product_cat`, `product_img`, `product_img2`, `product_img3`, `product_stock`, `product_price`, `product_off`, `product_c_price`, `status`) VALUES
(1, 'Chicken Biryani', '300 grams of chicken biryani with With Raita and brinjal gravy', 'Chicken biryani is a fragrant and flavorful dish made with marinated chicken, basmati rice, and a blend of aromatic spices. The chicken is cooked with onions and tomatoes, then layered with rice and often infused with saffron for added richness. Garnished with fried onions and fresh herbs, it is typically served with raita and salad. Each region offers its own unique twist, making it a beloved staple in South Indian cuisine.', 'Chicken biryani recipe Best chicken biryani near me Chicken biryani delivery Authentic chicken biryani Spicy chicken biryani Chicken biryani restaurant Chicken biryani takeout Chicken biryani ingredients Hyderabadi chicken biryani Chicken biryani for parties', 'Non Veg', '240_F_777352221_cmXXFIIY9CNhIhqlcQQzdt4zVN8f7wQr.jpg', '240_F_608842413_hdYadp6uSC7c7pq6LJew9s8gPnRSgjln.jpg', '240_F_791208815_1JlhjKFNrb2P31kdGVenNk0TFI2zahGg.jpg', 31, 250, 7, 233, 1),
(2, 'Tomato Rice', '300 grams of tomato rice with raita', 'Tomato rice is a flavorful and comforting dish made primarily with rice and ripe tomatoes. The dish typically begins with sautÃ©ing onions, garlic, and spices like mustard seeds, cumin, and turmeric. Fresh tomatoes are then added and cooked down to create a rich, tangy base. The rice is mixed in and cooked until fluffy, allowing it to absorb the vibrant flavors. Often garnished with fresh coriander and served with side dishes like raita or papadam, tomato rice is a popular choice in South Indian', 'Tomato rice recipe Best tomato rice near me Tomato rice delivery Easy tomato rice Spicy tomato rice Tomato rice restaurant Tomato rice takeout Tomato rice ingredients South Indian tomato rice Tomato rice for lunch veg', 'Veg', 'Screenshot 2024-10-12 095320.png', 'Screenshot 2024-10-12 095300.png', 'Screenshot 2024-10-12 095241.png', 46, 100, 6, 94, 1),
(3, 'Gulab Jamun', '250 grams of gulab jamun', 'Gulab jamun is a popular Indian dessert made from khoya (milk solids) or paneer, shaped into small balls and deep-fried until golden brown. These soft, spongy balls are then soaked in a fragrant sugar syrup infused with rose water and cardamom, giving them their signature sweetness and aromatic flavor. Often served warm or at room temperature, gulab jamun is a beloved treat during festivals and celebrations, known for its rich taste and melt-in-your-mouth texture.', 'Gulab jamun recipe Best gulab jamun near me Gulab jamun delivery Homemade gulab jamun Soft gulab jamun Gulab jamun shop Gulab jamun sweets Gulab jamun price Traditional gulab jamun Gulab jamun for festivals', 'Dessert', 'IMG_20241012_131140.jpg', 'IMG_20241012_131125.jpg', 'IMG_20241012_131107.jpg', 49, 225, 5, 214, 1),
(4, 'Chapathi', '5 pieces of chapathi', 'Chapathi is a popular Indian unleavened flatbread made from whole wheat flour. The dough is kneaded, rolled out into thin discs, and cooked on a hot griddle until it puffs up and develops a light golden color. Chapathi is known for its soft texture and is often served with a variety of curries, vegetables, or lentil dishes. It is a staple in South Indian cuisine, enjoyed for its simplicity and versatility, making it a favorite accompaniment to many meals', 'Chapathi recipe Best chapathi near me Chapathi delivery Soft chapathi Whole wheat chapathi Chapathi restaurant Chapathi takeout Chapathi with curry Homemade chapathi Chapathi for lunch', 'Starter', 'IMG_20241012_110357.jpg', 'IMG_20241012_110306.jpg', 'IMG_20241012_110451.jpg', 48, 100, 3, 97, 1),
(5, 'Paneer Butter Masala', '300 grams of paneer butter masala', 'Paneer butter masala is a rich and creamy North Indian dish made with paneer (Indian cottage cheese) cooked in a luscious tomato-based gravy. The dish is prepared by sautÃ©ing onions, ginger, and garlic, then blending in tomatoes and spices such as garam masala, cumin, and coriander. Cream and butter are added to create a smooth and velvety sauce, giving the dish its signature flavor. Often garnished with fresh coriander and served with naan, roti, or rice, paneer butter masala is a favorite for', 'Paneer butter masala recipe Best paneer butter masala near me Paneer butter masala delivery Authentic paneer butter masala Creamy paneer butter masala Paneer butter masala restaurant Paneer butter masala takeout Paneer butter masala ingredients Paneer butter masala with naan Paneer butter masala for parties', 'Veg', 'Screenshot 2024-10-12 084302.png', 'Screenshot 2024-10-12 084113.png', 'Screenshot 2024-10-12 084210.png', 49, 250, 7, 233, 1),
(6, 'Mutton Gravy', '300 grams of mutton gravy', 'Mutton gravy is a hearty and flavorful dish made from tender pieces of mutton cooked in a rich and aromatic sauce. The dish typically features a base of sautÃ©ed onions, tomatoes, and a blend of spices such as ginger, garlic, cumin, coriander, and garam masala. Slow-cooking the mutton allows it to absorb the flavors of the spices, resulting in a savory and satisfying dish. Often garnished with fresh coriander and served alongside rice or bread, mutton gravy is cherished for its depth of flavor a', 'Mutton gravy recipe Best mutton gravy near me Mutton gravy delivery Authentic mutton gravy Spicy mutton gravy Mutton gravy restaurant Mutton curry takeout Mutton gravy ingredients Mutton gravy with rice Mutton gravy for special occasions', 'Non Veg', 'IMG_20241012_130920.jpg', 'IMG_20241012_130936.jpg', 'IMG_20241012_130953.jpg', 50, 350, 9, 319, 1),
(7, 'Laddu', '200 grams of laddu', 'Laddu is a popular Indian sweet made from various ingredients, most commonly chickpea flour (besan), wheat flour, or semolina, combined with sugar and ghee (clarified butter). The mixture is cooked, shaped into round balls, and often garnished with nuts or dried fruits. Each region in India has its own variations, such as motichoor laddu or boondi laddu, each offering unique textures and flavors. Laddu is often enjoyed during festivals and celebrations, known for its rich taste and delightful sw', 'Laddu recipe Best laddu near me Laddu delivery Traditional laddu Besan laddu Laddu shop Laddu for festivals Homemade laddu Laddu ingredients Sweet laddu takeout', 'Dessert', 'IMG_20241012_105955.jpg', 'IMG_20241012_105937.jpg', 'IMG_20241012_110013.jpg', 46, 190, 12, 167, 1),
(8, 'Idly', '5 pieces of idly', 'Idly is a traditional South Indian steamed rice cake made from fermented batter of rice and urad dal (black gram). The batter is poured into special molds and steamed until soft and fluffy. Idly is known for its light texture and mild flavor, making it a popular breakfast dish. It is typically served with coconut chutney, sambar (a lentil-based vegetable stew), and sometimes spicy chutneys. Idly is not only nutritious but also a staple in South Indian cuisine, enjoyed for its simplicity and vers', 'Idly recipe Best idly near me Idly delivery Soft idly Idly batter Idly restaurant Idly with chutney Homemade idly Idly ingredients Idly for breakfast', 'Starter', 'Screenshot 2024-10-12 101108.png', 'Screenshot 2024-10-12 101056.png', 'Screenshot 2024-10-12 101125.png', 50, 75, 15, 64, 1),
(9, 'Prawn Gravy', '250 grams of prawn gravy', 'Prawn gravy is a flavorful dish made with succulent prawns cooked in a rich and spicy sauce. The base typically includes sautÃ©ed onions, tomatoes, and a blend of spices such as ginger, garlic, turmeric, and garam masala. Coconut milk is often added to create a creamy texture and enhance the flavor, especially in South Indian coastal regions. Garnished with fresh coriander, prawn gravy is usually served with steamed rice, chapathi, or dosa, making it a delightful seafood option loved for its rob', 'Prawn gravy recipe Best prawn gravy near me Prawn curry delivery Authentic prawn gravy Spicy prawn gravy Prawn gravy restaurant Prawn gravy takeout Prawn gravy ingredients Prawn gravy with rice Prawn gravy for seafood lovers', 'Non Veg', 'IMG_20241012_180720.jpg', 'IMG_20241012_180703.jpg', 'IMG_20241012_180735.jpg', 50, 390, 8, 359, 1),
(10, 'Paal Payasam', ' 250 grams of paal payasam', 'Paal payasam is a traditional South Indian rice pudding made with rice, milk, and sugar, often flavored with cardamom and garnished with cashews and raisins. The dish is cooked slowly, allowing the rice to absorb the creamy milk, resulting in a rich and luscious texture. It is typically served warm or chilled and is a popular dessert during festivals and special occasions, celebrated for its sweet, comforting flavor and delightful aroma.', 'Paal payasam recipe Best paal payasam near me Paal payasam delivery Traditional paal payasam Creamy paal payasam Paal payasam restaurant Paal payasam takeout Paal payasam ingredients Paal payasam for festivals Homemade paal payasam', 'Dessert', 'Screenshot 2024-10-12 102201.png', 'Screenshot 2024-10-12 102143.png', 'Screenshot 2024-10-12 102215.png', 41, 200, 6, 188, 1),
(11, 'White Rice', '200 grams of white rice', 'White rice is a staple food in South Indian cuisine, known for its soft texture and mild flavor. It is typically made from polished rice grains, which are cooked until fluffy and tender. White rice serves as a versatile base for various dishes, often paired with curries, sambar, or lentils. It is commonly enjoyed as part of daily meals and festive feasts alike, appreciated for its ability to complement a wide range of flavors.', 'White rice recipe Best white rice near me White rice delivery Cooked white rice Steamed white rice White rice restaurant White rice takeout White rice with curry Healthy white rice White rice for meals', 'Starter', 'IMG_20241012_131155.jpg', 'IMG_20241012_131212.jpg', 'IMG_20241012_131230.jpg', 50, 60, 5, 57, 1),
(12, 'Tomato and Onion Gravy', '300 grams of tomato and onion gravy', 'Tomato and onion gravy is a versatile and flavorful dish made primarily with fresh tomatoes and onions cooked together with a blend of spices. The onions are sautÃ©ed until golden brown, and then tomatoes are added, simmered, and blended into a rich, tangy sauce. Common spices include cumin, coriander, turmeric, and garam masala, which enhance the flavor profile. This gravy serves as a base for various dishes and can be enjoyed with rice, chapathi, or naan, making it a staple in many South India', 'Tomato and onion gravy recipe Best tomato and onion gravy near me Tomato and onion gravy delivery Easy tomato and onion gravy Vegetarian tomato gravy Tomato and onion gravy restaurant Tomato and onion gravy takeout Tomato onion gravy ingredients Tomato onion gravy with rice Tomato and onion curry', 'Veg', 'IMG_20241012_131414.jpg', 'IMG_20241012_131357.jpg', 'IMG_20241012_131435.jpg', 50, 100, 6, 94, 1),
(13, 'Mutton Biryani', '350 grams of mutton biryani with raita and brinjal gravy', 'Mutton biryani is a rich and aromatic dish made with marinated mutton, fragrant basmati rice, and a blend of spices. The mutton is typically cooked with onions, tomatoes, and spices such as cumin, cardamom, and cloves, allowing it to absorb the flavors. The rice is layered with the cooked mutton and often infused with saffron or turmeric for added flavor and color. Garnished with fried onions, fresh herbs, and served with raita or a side salad, mutton biryani is a beloved dish in South Indian cu', 'Mutton biryani recipe Best mutton biryani near me Mutton biryani delivery Authentic mutton biryani Spicy mutton biryani Mutton biryani restaurant Mutton biryani takeout Mutton biryani ingredients Hyderabadi mutton biryani Mutton biryani for special occasions', 'Non Veg', 'IMG_20241012_131335.jpg', 'IMG_20241012_131248.jpg', 'IMG_20241012_131319.jpg', 36, 400, 4, 384, 1),
(14, 'Paratha', '2 pieces of paratha ', 'Paratha is a popular Indian flatbread made from whole wheat flour, often layered or stuffed with various fillings such as potatoes, paneer, or vegetables. The dough is rolled out, cooked on a griddle, and typically brushed with ghee or butter for added flavor and richness. Parathas can be served plain or stuffed and are commonly accompanied by pickles, yogurt, or curries. They are a favorite for breakfast, lunch, or dinner, known for their flaky texture and delicious taste.', 'Paratha is a popular Indian flatbread made from whole wheat flour, often layered or stuffed with various fillings such as potatoes, paneer, or vegetables. The dough is rolled out, cooked on a griddle, and typically brushed with ghee or butter for added flavor and richness. Parathas can be served plain or stuffed and are commonly accompanied by pickles, yogurt, or curries. They are a favorite for breakfast, lunch, or dinner, known for their flaky texture and delicious taste.', 'Starter', 'Screenshot 2024-10-12 090606.png', 'Screenshot 2024-10-12 092757.png', 'Screenshot 2024-10-12 092946.png', 44, 50, 6, 47, 1),
(15, 'Cauliflower Gravy', '300 grams of cauliflower gravy', 'Cauliflower gravy is a flavorful vegetarian dish made with tender cauliflower florets cooked in a rich, spiced tomato and onion sauce. The dish often includes ingredients such as garlic, ginger, and a blend of spices like cumin, coriander, and garam masala to enhance its flavor. The gravy is thick and creamy, making it a delicious complement to rice, roti, or naan. Cauliflower gravy is not only nutritious but also a popular choice in Indian cuisine, appreciated for its taste and versatility.', 'Cauliflower gravy recipe Best cauliflower gravy near me Cauliflower curry delivery Spicy cauliflower gravy Vegetarian cauliflower gravy Cauliflower gravy restaurant Cauliflower gravy takeout Cauliflower gravy ingredients Cauliflower gravy with rice Cauliflower curry for meals', 'Veg', 'IMG_20241012_181142.jpg', 'IMG_20241012_181157.jpg', 'IMG_20241012_181212.jpg', 46, 300, 10, 270, 1),
(16, 'Dosa', '3 pieces of dosa', 'Dosa is a traditional South Indian fermented crepe made from a batter of rice and urad dal (black gram). The batter is spread thin on a hot griddle, resulting in a crispy, golden-brown crepe. Dosas are often served with a variety of chutneys (like coconut or tomato) and sambar (a lentil-based vegetable stew). They can be enjoyed plain or stuffed with fillings like spiced potatoes, making them a versatile dish for breakfast, lunch, or dinner. Dosa is celebrated for its light texture and delightfu', 'Dosa recipe Best dosa near me Dosa delivery Masala dosa Crispy dosa Dosa restaurant Dosa with chutney Homemade dosa Dosa ingredients Dosa for breakfast', 'Starter', 'IMG_20241012_144930.jpg', 'IMG_20241012_144912.jpg', 'IMG_20241012_144948.jpg', 45, 60, 3, 58, 1),
(17, 'Curd Rice', '250 grams of curd rice with lemon pickle', 'Curd rice is a refreshing and comforting South Indian dish made with cooked rice mixed with plain yogurt (curd) and often seasoned with spices. The dish typically includes ingredients like mustard seeds, curry leaves, green chilies, and sometimes chopped vegetables or fruits like cucumber and pomegranate. Curd rice is not only nutritious but also serves as a cooling side dish, particularly enjoyed during hot weather. It is often served with pickles or a side of papadam, making it a staple in man', 'Curd rice recipe Best curd rice near me Curd rice delivery Traditional curd rice Healthy curd rice Curd rice restaurant Curd rice takeout Curd rice with pickle Curd rice ingredients Curd rice for lunch', 'Veg', 'IMG_20241012_105110.jpg', 'IMG_20241012_105130.jpg', 'IMG_20241012_105151.jpg', 48, 60, 7, 56, 1),
(18, 'Veg Noodles', '300 grams of veg noodles', 'Veg noodles are a popular dish made with boiled and stir-fried noodles, mixed with a variety of vegetables such as carrots, bell peppers, and cabbage. The noodles are tossed in sauces like soy sauce, chili sauce, and vinegar, creating a flavorful and satisfying meal. Often garnished with spring onions and served hot, veg noodles are a quick and nutritious option enjoyed by people of all ages. They are commonly found in street food stalls and restaurants, making them a favorite comfort food.', 'Veg noodles recipe Best veg noodles near me Veg noodles delivery Chinese veg noodles Spicy veg noodles Veg noodles restaurant Veg noodles takeout Veg noodles ingredients Veg noodles for lunch Instant veg noodles', 'Veg', 'IMG_20241012_181120.jpg', 'IMG_20241012_181106.jpg', 'IMG_20241012_181051.jpg', 0, 100, 6, 94, 1),
(19, 'Chicken Noodles', '300 grams of chicken noodles', 'Chicken noodles are a delicious and filling dish made with tender pieces of chicken stir-fried with noodles and a medley of vegetables like bell peppers, carrots, and cabbage. The dish is typically seasoned with sauces such as soy sauce, oyster sauce, and chili sauce, giving it a rich and savory flavor. Often garnished with spring onions and served hot, chicken noodles are a popular choice for a quick meal, loved for their balance of protein and carbs. They are commonly found in street food stal', 'Chicken noodles recipe Best chicken noodles near me Chicken noodles delivery Spicy chicken noodles Chicken chow mein Chicken noodles restaurant Chicken noodles takeout Chicken noodles ingredients Chicken noodles for lunch Instant chicken noodles', 'Non Veg', 'IMG_20241012_181004.jpg', 'IMG_20241012_181022.jpg', 'IMG_20241012_181035.jpg', 50, 180, 10, 162, 1),
(20, 'Brinjal Gravy', '300 grams of brinjal gravy', 'Brinjal gravy, also known as eggplant curry, is a flavorful vegetarian dish made with tender brinjal (eggplant) cooked in a spiced tomato and onion sauce. The brinjal is typically sautÃ©ed with a blend of spices, including cumin, coriander, and garam masala, which enhances its natural flavor. The gravy is often creamy and rich, making it a perfect accompaniment to rice, chapathi, or naan. This dish is popular in South Indian cuisine and is loved for its savory taste and hearty texture.', 'Brinjal gravy, also known as eggplant curry, is a flavorful vegetarian dish made with tender brinjal (eggplant) cooked in a spiced tomato and onion sauce. The brinjal is typically sautÃ©ed with a blend of spices, including cumin, coriander, and garam masala, which enhances its natural flavor. The gravy is often creamy and rich, making it a perfect accompaniment to rice, chapathi, or naan. This dish is popular in South Indian cuisine and is loved for its savory taste and hearty texture.', 'Veg', 'IMG_20241012_180748.jpg', 'IMG_20241012_180800.jpg', 'IMG_20241012_180815.jpg', 50, 100, 9, 91, 1),
(21, 'Veg Soup', '250 ml of Veg Soup', 'Veg soup is a comforting and nutritious dish made from a variety of vegetables simmered in vegetable broth or water. The soup is often blended to a smooth consistency or left chunky, depending on preference. Common ingredients include carrots, peas, beans, and tomatoes, seasoned with herbs and spices like garlic, ginger, and pepper. Veg soup is not only a warm and hearty option but also a great way to incorporate a range of vegetables into your diet, making it a popular starter or light meal.', 'Veg soup recipe Best veg soup near me Veg soup delivery Healthy vegetable soup Spicy veg soup Veg soup restaurant Veg soup takeout Veg soup ingredients Creamy veg soup Homemade veg soup', 'Starter', 'IMG_20241012_180628.jpg', 'IMG_20241012_180608.jpg', 'IMG_20241012_180645.jpg', 50, 100, 10, 90, 1),
(22, 'Chicken 65', '200 grams of chicken 65', 'Chicken 65 is a popular South Indian appetizer made from marinated and deep-fried chicken pieces, known for their spicy and tangy flavor. The chicken is typically coated with a mixture of yogurt, spices, and red chili powder, then fried until crispy. Often garnished with curry leaves and served with a side of mint chutney or lemon wedges, Chicken 65 is a favorite for its bold taste and crunchy texture. Itâ€™s commonly enjoyed as a starter in restaurants and at parties, making it a beloved dish i', 'Chicken 65 recipe Best Chicken 65 near me Chicken 65 delivery Spicy Chicken 65 Chicken 65 restaurant Chicken 65 takeout Chicken 65 ingredients Authentic Chicken 65 Chicken 65 appetizer Crispy Chicken 65', 'Non Veg', 'IMG_20241012_181258.jpg', 'IMG_20241012_181245.jpg', 'IMG_20241012_181230.jpg', 50, 200, 10, 180, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `user_email` varchar(30) DEFAULT NULL,
  `user_pass` varchar(20) DEFAULT NULL,
  `mob_num1` bigint(10) DEFAULT NULL,
  `mob_num2` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_pass`, `mob_num1`, `mob_num2`) VALUES
(1, 'Harishkumaran S', 'harishkumaran654@gmail.com', 'Harishkumaran@29', 9865139150, 9865139150),
(2, 'Senthil', 'csenthil3051969@gmail.com', 'Senthil@29', 8838263645, 8838263645),
(3, 'tharun', 'tharun.baskart@gmail.com', 'Tharun@2005', 7339286428, 7339286428),
(4, 'Arjun Kumar', 'arjunkumar123@gmail.com', 'Arjun@123', 9876543210, 9876543210),
(5, 'Meera S', 'meerasharma789@gmail.com', 'Meera@456', 8765432109, 8765432109),
(6, 'Rahul Verma', 'rahul.verma567@gmail.com', 'Rahul@789', 7654321098, 7654321098),
(7, 'Sneha Reddy', 'sneha.reddy432@gmail.com', 'Sneha@234', 6543210987, 6543210987),
(8, 'Vikram Singh', 'vikram.singh876@gmail.com', 'Vikram@567', 5432109876, 5432109876),
(9, 'Pooja Sharma', 'pooja.sharma111@gmail.com', 'Pooja@111', 9321456789, 9321456789),
(10, 'Amit Joshi', 'amit.joshi222@gmail.com', 'Amit@222', 9212345678, 9212345678),
(11, 'Divya Nair', 'divya.nair333@gmail.com', 'Divya@333', 9112345678, 9112345678),
(12, 'Rohan Mehta', 'rohan.mehta444@gmail.com', 'Rohan@444', 9012345678, 9012345678),
(13, 'Ananya Roy', 'ananya.roy555@gmail.com', 'Ananya@555', 8912345678, 8912345678),
(14, 'Karthik R', 'karthik.r666@gmail.com', 'Karthik@666', 8812345678, 8812345678),
(15, 'Neha Kapoor', 'neha.kapoor777@gmail.com', 'Neha@777', 8712345678, 8712345678),
(16, 'Suraj Patel', 'suraj.patel888@gmail.com', 'Suraj@888', 8612345678, 8612345678),
(17, 'Ishita Bansal', 'ishita.bansal999@gmail.com', 'Ishita@999', 8512345678, 8512345678),
(18, 'Yash Thakur', 'yash.thakur000@gmail.com', 'Yash@000', 8412345678, 8412345678),
(19, 'Sabari', 'sabari654@gmail.com', 'Sabari@2025', 9942891247, 9942891247);

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE `user_order` (
  `o_id` int(5) NOT NULL,
  `product_id` int(3) DEFAULT NULL,
  `user_id` int(5) DEFAULT NULL,
  `qty` int(3) DEFAULT NULL,
  `total_price` int(5) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `o_date` datetime DEFAULT NULL,
  `d_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`o_id`, `product_id`, `user_id`, `qty`, `total_price`, `status`, `o_date`, `d_date`) VALUES
(1, 5, 1, 2, 466, 1, '2024-12-02 10:15:30', '2024-12-02 11:15:30'),
(2, 4, 11, 2, 194, 1, '2024-12-02 12:30:00', '2024-12-02 13:30:00'),
(3, 8, 2, 1, 64, 1, '2024-12-05 14:45:22', '2024-12-05 15:45:22'),
(4, 15, 12, 1, 270, 1, '2024-12-06 09:10:45', '2024-12-06 10:10:45'),
(5, 12, 3, 3, 282, 1, '2024-12-08 18:10:45', '2024-12-08 19:10:45'),
(6, 2, 13, 3, 282, 1, '2024-12-09 14:55:30', '2024-12-09 15:55:30'),
(7, 6, 4, 2, 638, 1, '2024-12-10 08:30:12', '2024-12-10 09:30:12'),
(8, 9, 5, 4, 1436, 1, '2024-12-13 20:05:38', '2024-12-13 21:05:38'),
(9, 13, 14, 2, 768, 1, '2024-12-14 17:40:25', '2024-12-14 18:40:25'),
(10, 3, 6, 1, 214, 1, '2024-12-15 09:55:27', '2024-12-15 10:55:27'),
(11, 10, 7, 5, 940, 1, '2024-12-18 16:40:55', '2024-12-18 18:40:55'),
(12, 1, 15, 5, 1115, 1, '2024-12-19 19:30:15', '2024-12-19 20:30:15'),
(13, 14, 8, 3, 141, 1, '2024-12-22 12:20:10', '2024-12-22 13:20:10'),
(14, 16, 16, 3, 174, 1, '2024-12-23 08:20:50', '2024-12-23 09:20:50'),
(15, 7, 9, 2, 334, 1, '2024-12-26 17:15:00', '2024-12-26 18:15:00'),
(16, 17, 17, 2, 112, 1, '2024-12-27 11:15:35', '2024-12-27 12:15:35'),
(17, 11, 10, 1, 57, 1, '2024-12-30 21:50:40', '2024-12-30 22:50:40'),
(18, 18, 18, 1, 94, 1, '2024-12-31 23:55:59', '2025-01-01 00:55:59'),
(19, 5, 1, 2, 466, 1, '2025-01-01 08:10:30', '2025-01-01 09:10:30'),
(20, 4, 2, 2, 194, 1, '2025-01-03 12:30:00', '2025-01-03 13:30:00'),
(21, 8, 3, 1, 64, 1, '2025-01-05 14:45:22', '2025-01-05 15:45:22'),
(22, 15, 4, 1, 270, 1, '2025-01-06 09:10:45', '2025-01-06 10:10:45'),
(23, 12, 5, 3, 282, 1, '2025-01-08 18:10:45', '2025-01-08 19:10:45'),
(24, 2, 6, 3, 282, 1, '2025-01-09 14:55:30', '2025-01-09 15:55:30'),
(25, 6, 7, 2, 638, 1, '2025-01-10 08:30:12', '2025-01-10 09:30:12'),
(26, 9, 8, 4, 1436, 1, '2025-01-13 20:05:38', '2025-01-13 21:05:38'),
(27, 13, 9, 2, 768, 1, '2025-01-14 17:40:25', '2025-01-14 18:40:25'),
(28, 3, 10, 1, 214, 1, '2025-01-15 09:55:27', '2025-01-15 10:55:27'),
(29, 10, 11, 5, 940, 1, '2025-01-18 16:40:55', '2025-01-18 18:40:55'),
(30, 1, 12, 5, 1115, 1, '2025-01-19 19:30:15', '2025-01-19 20:30:15'),
(31, 14, 13, 3, 141, 1, '2025-01-22 12:20:10', '2025-01-22 13:20:10'),
(32, 16, 14, 3, 174, 1, '2025-01-23 08:20:50', '2025-01-23 09:20:50'),
(33, 7, 15, 2, 334, 1, '2025-01-26 17:15:00', '2025-01-26 18:15:00'),
(34, 17, 16, 2, 112, 1, '2025-01-27 11:15:35', '2025-01-27 12:15:35'),
(35, 11, 17, 1, 57, 1, '2025-01-30 21:50:40', '2025-01-30 22:50:40'),
(36, 18, 18, 1, 94, 1, '2025-01-31 23:55:59', '2025-02-01 00:55:59'),
(37, 5, 1, 2, 466, 1, '2025-02-02 10:00:00', '2025-02-02 11:00:00'),
(38, 9, 2, 3, 1077, 1, '2025-02-03 14:15:30', '2025-02-03 15:15:30'),
(39, 8, 3, 1, 64, 1, '2025-02-05 18:30:45', '2025-02-05 19:30:45'),
(40, 15, 4, 2, 540, 1, '2025-02-06 07:45:10', '2025-02-06 08:45:10'),
(41, 12, 5, 4, 376, 1, '2025-02-07 22:10:20', '2025-02-07 23:10:20'),
(42, 2, 6, 2, 188, 1, '2025-02-09 16:25:55', '2025-02-09 17:25:55'),
(43, 7, 7, 3, 501, 1, '2025-02-10 12:40:30', '2025-02-10 13:40:30'),
(44, 6, 8, 1, 319, 1, '2025-02-12 20:05:00', '2025-02-12 21:05:00'),
(45, 3, 9, 2, 428, 1, '2025-02-13 15:30:25', '2025-02-13 16:30:25'),
(46, 11, 10, 1, 57, 1, '2025-02-14 11:55:10', '2025-02-14 12:55:10'),
(47, 18, 11, 2, 188, 1, '2025-02-15 23:59:59', '2025-02-16 00:59:59'),
(48, 2, 3, 1, 94, 1, '2025-02-18 18:47:24', '2025-02-18 18:58:42'),
(49, 17, 3, 1, 56, 1, '2025-02-18 18:47:35', '2025-02-18 18:58:46'),
(50, 8, 3, 1, 64, 1, '2025-02-18 18:59:45', '2025-02-18 19:03:45'),
(51, 21, 3, 1, 90, 1, '2025-02-18 18:59:55', '2025-02-18 19:03:45'),
(52, 6, 3, 1, 319, 1, '2025-02-18 19:05:10', '2025-02-18 19:06:19'),
(53, 6, 3, 1, 319, 1, '2025-02-18 19:05:16', '2025-02-18 19:06:23'),
(54, 22, 3, 1, 180, 1, '2025-02-18 19:08:57', '2025-02-18 19:10:33'),
(55, 9, 3, 1, 359, 1, '2025-02-18 19:09:07', '2025-02-18 19:10:33'),
(56, 8, 3, 2, 128, 1, '2025-02-20 20:25:12', '2025-03-27 18:11:08'),
(57, 10, 4, 2, 376, 1, '2025-02-21 14:45:30', '2025-02-21 15:45:30'),
(58, 13, 7, 1, 384, 1, '2025-02-22 10:30:15', '2025-02-22 11:30:15'),
(59, 15, 9, 3, 810, 1, '2025-02-23 19:20:50', '2025-02-23 20:20:50'),
(60, 17, 6, 2, 112, 1, '2025-02-24 08:10:30', '2025-02-24 09:10:30'),
(61, 18, 2, 1, 94, 1, '2025-02-25 17:50:45', '2025-02-25 18:50:45'),
(62, 22, 11, 4, 720, 1, '2025-02-26 22:10:15', '2025-02-26 23:10:15'),
(63, 9, 12, 2, 718, 1, '2025-02-27 15:30:40', '2025-02-27 16:30:40'),
(64, 7, 5, 3, 501, 1, '2025-02-28 12:20:10', '2025-02-28 13:20:10'),
(65, 5, 8, 1, 233, 1, '2025-03-01 18:45:55', '2025-03-01 19:45:55'),
(66, 3, 10, 1, 214, 1, '2025-03-02 09:10:30', '2025-03-02 10:10:30'),
(67, 12, 15, 5, 470, 1, '2025-03-03 19:30:15', '2025-03-03 20:30:15'),
(68, 16, 3, 2, 174, 1, '2025-03-04 10:15:50', '2025-03-04 11:15:50'),
(69, 8, 14, 4, 256, 1, '2025-03-05 20:40:25', '2025-03-05 21:40:25'),
(70, 2, 7, 2, 188, 1, '2025-03-06 15:55:10', '2025-03-06 16:55:10'),
(71, 10, 6, 1, 188, 1, '2025-03-07 23:59:59', '2025-03-08 00:59:59'),
(72, 11, 8, 2, 114, 1, '2025-03-08 14:25:00', '2025-03-08 15:25:00'),
(73, 14, 9, 1, 47, 1, '2025-03-09 17:40:15', '2025-03-09 18:40:15'),
(74, 6, 10, 3, 957, 1, '2025-03-10 20:10:30', '2025-03-10 21:10:30'),
(75, 9, 11, 4, 1436, 1, '2025-03-11 12:50:45', '2025-03-11 13:50:45'),
(76, 22, 13, 1, 180, 1, '2025-03-12 08:30:15', '2025-03-12 09:30:15'),
(77, 1, 14, 5, 1115, 1, '2025-03-13 19:45:30', '2025-03-13 20:45:30'),
(78, 4, 15, 2, 194, 1, '2025-03-14 11:55:20', '2025-03-14 12:55:20'),
(79, 13, 16, 3, 576, 1, '2025-03-15 21:05:30', '2025-03-15 22:05:30'),
(80, 17, 17, 2, 112, 1, '2025-03-16 14:20:00', '2025-03-16 15:20:00'),
(81, 5, 18, 1, 233, 1, '2025-03-17 18:35:10', '2025-03-17 19:35:10'),
(82, 3, 2, 1, 214, 1, '2025-03-18 09:10:30', '2025-03-18 10:10:30'),
(83, 12, 6, 5, 470, 1, '2025-03-19 22:30:15', '2025-03-19 23:30:15'),
(84, 16, 9, 3, 261, 1, '2025-03-20 10:50:40', '2025-03-20 11:50:40'),
(85, 8, 13, 2, 128, 1, '2025-03-21 18:10:00', '2025-03-21 19:10:00'),
(86, 2, 15, 1, 94, 1, '2025-03-22 23:59:59', '2025-03-23 00:59:59'),
(87, 15, 3, 3, 810, 1, '2025-03-27 18:10:29', '2025-03-27 18:11:08'),
(88, 16, 3, 4, 232, 0, '2025-03-29 07:16:25', '2025-03-29 08:16:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `event_booking`
--
ALTER TABLE `event_booking`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `fav`
--
ALTER TABLE `fav`
  ADD PRIMARY KEY (`fav_id`);

--
-- Indexes for table `order_off`
--
ALTER TABLE `order_off`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`o_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `e_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `event_booking`
--
ALTER TABLE `event_booking`
  MODIFY `b_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `fav`
--
ALTER TABLE `fav`
  MODIFY `fav_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_off`
--
ALTER TABLE `order_off`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_order`
--
ALTER TABLE `user_order`
  MODIFY `o_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
