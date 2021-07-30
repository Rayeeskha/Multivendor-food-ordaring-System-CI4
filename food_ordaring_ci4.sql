-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2021 at 05:37 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_ordaring_ci4`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `name`, `email`, `mobile`, `created_date`, `password`, `status`) VALUES
(1, 'SuperAdmin', 'admin@gmail.com', 9867458965, '2021-01-10 20:44:38', '123456', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `category_master`
--

CREATE TABLE `category_master` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `order_number` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_master`
--

INSERT INTO `category_master` (`id`, `category`, `order_number`, `status`, `created_date`) VALUES
(1, 'Protein', '1', 'Active', '2021-01-10 10:30:44'),
(2, 'Roasted', '12', 'Active', '2021-01-10 11:07:23'),
(3, 'Chicken ', '13', 'Active', '2021-01-10 11:07:42'),
(4, 'Mutton', '14', 'Active', '2021-01-10 11:08:00'),
(6, 'Kabab', '15', 'Active', '2021-01-10 11:08:46'),
(7, 'Coffee', '16', 'Active', '2021-01-10 11:09:06'),
(8, 'Shorma', '17', 'Active', '2021-01-10 11:09:44'),
(9, 'Rise', '18', 'Active', '2021-01-10 11:11:03'),
(10, 'Biryani', '19', 'Active', '2021-01-10 11:11:18');

-- --------------------------------------------------------

--
-- Table structure for table `chating_customer`
--

CREATE TABLE `chating_customer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `sent_by` enum('User','Admin') NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chating_customer`
--

INSERT INTO `chating_customer` (`id`, `user_id`, `ip_address`, `message`, `sent_by`, `time`) VALUES
(1, 0, '918216', 'How can help you ', 'Admin', '10:08:11'),
(2, 0, '918216', 'I am for u', 'Admin', '10:22:18'),
(3, 0, '918216', 'I am for u', 'Admin', '10:22:35'),
(4, 0, '918216', 'I will response comming soon', 'Admin', '10:23:39'),
(5, 0, '918216', 'I will response comming soon', 'Admin', '10:24:02'),
(6, 0, '918216', 'yes', 'Admin', '10:26:26'),
(7, 0, '918216', 'hey', 'Admin', '10:35:21'),
(8, 9, '918216', 'How can help you', 'Admin', '10:35:36'),
(9, 9, '918216', 'how can help you', 'Admin', '10:36:21'),
(10, 0, '918216', 'how can help you', 'Admin', '10:37:14'),
(11, 0, '918216', 'how can help you', 'Admin', '10:37:18'),
(12, 9, '918216', 'hey there', 'Admin', '10:37:49'),
(13, 0, '918216', 'hey there', 'Admin', '10:37:50'),
(14, 0, '918216', 'hey there', 'Admin', '10:37:51'),
(15, 0, '918216', 'hey there', 'Admin', '10:37:52'),
(16, 0, '918216', 'hey there', 'Admin', '10:38:02'),
(17, 0, '918216', 'hey there', 'Admin', '10:38:47'),
(18, 0, '918216', 'hey i will respnse', 'Admin', '10:39:55'),
(19, 0, '918216', 'okk', 'Admin', '10:47:49'),
(20, 0, '918216', 'okk', 'Admin', '10:47:51'),
(21, 0, '918216', 'okk', 'Admin', '10:48:05'),
(22, 0, '918216', 'okk', 'Admin', '10:48:13'),
(23, 0, '918216', 'okk', 'Admin', '10:48:19'),
(24, 0, '918216', 'okk', 'Admin', '10:48:19'),
(25, 0, '918216', 'okk', 'Admin', '10:48:37'),
(26, 0, '918216', 'okk', 'Admin', '10:48:59'),
(27, 0, '918216', 'okkkkk thang', 'Admin', '10:49:37'),
(28, 0, '918216', 'okkkkk thang', 'Admin', '10:49:49'),
(29, 0, '918216', 'thnks', 'Admin', '10:50:30'),
(30, 0, '918216', 'thnks hshss', 'Admin', '10:50:42'),
(31, 0, '918216', 'thanks', 'Admin', '10:50:52'),
(32, 0, '918216', 'hey', 'Admin', '10:51:56'),
(33, 0, '918216', 'How can help you', 'Admin', '10:52:09'),
(34, 9, '', 'hey', 'User', '01:26:31'),
(35, 9, '', 'hey', 'User', '01:27:03'),
(36, 9, '', 'hey', 'User', '01:27:33'),
(37, 9, '', 'how', 'User', '01:27:37'),
(38, 9, '', 'how can help you there I will fix that issue', 'Admin', '01:31:39'),
(39, 9, '', 'how can help you there I will fix that issue', 'Admin', '01:31:41'),
(40, 9, '', 'how can help you there I will fix that issue', 'Admin', '01:31:56'),
(41, 9, '', 'hey', 'Admin', '01:33:19'),
(42, 9, '', 'How can help you I will Fi that Issue Comming soon', 'Admin', '01:34:13'),
(43, 9, '', 'How can help you I will Fi that Issue Comming soon', 'Admin', '01:34:14'),
(44, 9, '', 'okk thanks', 'User', '01:34:49'),
(45, 9, '', 'okk', 'Admin', '01:44:21'),
(46, 9, '', 'hey', 'User', '02:49:05'),
(47, 9, '', 'iiifif', 'Admin', '02:49:39'),
(48, 9, '', 'theek hai', 'User', '02:49:59'),
(49, 9, '', 'hwy', 'Admin', '11:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `login_ip` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  `response` enum('Not-replay','Replay') NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `login_ip`, `user_id`, `name`, `email`, `mobile`, `subject`, `message`, `response`, `added_on`) VALUES
(1, '943', 0, 'Khan', 'krayees282@gmail.com', 987654321, 'Testing your website how it works', 'Testing your website how it works', 'Not-replay', '2021-01-24 05:08:22'),
(2, '918216', 0, 'Khan Rayees', 'khanrayees@gmail.com', 8765438965, 'Testing Purpose ', 'Testing Purpose  how its working for that site', 'Not-replay', '2021-01-30 09:09:22'),
(3, '913492', 9, 'Jon', 'jon@gmail.com', 8765438965, 'Testing Purpose ', 'How can working and whats a functionlity', 'Not-replay', '2021-01-31 01:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_master`
--

CREATE TABLE `coupon_master` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(100) NOT NULL,
  `coupon_type` varchar(50) NOT NULL,
  `coupon_value` varchar(50) NOT NULL,
  `cart_min_value` bigint(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `expiry_on` date NOT NULL,
  `added_on` datetime NOT NULL,
  `restaurent_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupon_master`
--

INSERT INTO `coupon_master` (`id`, `coupon_code`, `coupon_type`, `coupon_value`, `cart_min_value`, `status`, `expiry_on`, `added_on`, `restaurent_id`) VALUES
(1, 'First50', 'Percentage', '50', 250, 'Active', '2021-01-25', '2021-01-12 00:40:35', 1),
(3, 'Punjabidhaba First', 'Percentage', '40', 350, 'Active', '2021-01-31', '2021-01-28 09:33:52', 894),
(4, 'PunSecond', 'Rupee', '100', 500, 'Active', '2021-06-23', '2021-01-28 09:40:41', 894),
(5, 'Punjabidhaba First', 'Rupee', '70', 250, 'Active', '2021-06-28', '2021-01-28 09:41:27', 894),
(6, 'Zaika First', 'Percentage', '40', 500, 'Active', '2021-02-25', '2021-02-09 02:43:51', 88855340),
(7, 'First40', 'Percentage', '40', 300, 'Active', '2021-04-10', '2021-03-07 02:21:04', 88855340);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy_master`
--

CREATE TABLE `delivery_boy_master` (
  `id` int(11) NOT NULL,
  `uid` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `aadhar_number` varchar(100) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(255) NOT NULL,
  `image` varchar(155) NOT NULL,
  `status` varchar(50) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_boy_master`
--

INSERT INTO `delivery_boy_master` (`id`, `uid`, `name`, `email`, `password`, `mobile`, `aadhar_number`, `pincode`, `state`, `city`, `image`, `status`, `added_date`) VALUES
(6, 'cfe7440fdcbf7a56e1c95f2f5f33707d', 'pawan', 'pawan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 7865431287, '789437823541', '226026', 'Uttar Pradesh', 'Lucknow', '1611926590_c06f5836eceb9f17e46b.jpg', 'Active', '2021-01-29 06:53:10'),
(9, '7e751ae1b85084daf0a6a42bd7b6f3bb', 'Jabid', 'jabid@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 8765342198, '896754328765', '271208', 'Uttar Pradesh', 'Tulsipur', '1614016781_43f92fd6cf9a3f6e0e3f.jpg', 'Active', '2021-02-22 11:29:41'),
(10, 'aa23bef2fa6d24464fef9fb8537e64df', 'khan', 'codewithrayees@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 8967542389, '896745238967', '226026', 'Uttar Pradesh', 'Lucknow', '1616564976_27a169d7e8459addeb95.png', 'Active', '2021-03-24 11:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy_rating`
--

CREATE TABLE `delivery_boy_rating` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `delivery_boy_id` int(11) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `rating` varchar(100) NOT NULL,
  `review` varchar(255) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_boy_rating`
--

INSERT INTO `delivery_boy_rating` (`id`, `user_id`, `delivery_boy_id`, `order_id`, `rating`, `review`, `date`) VALUES
(2, 9, 6, 304389, '5', '', NULL),
(3, 8, 6, 853943, '5', 'Good', NULL),
(4, 10, 6, 648415, '5', '', '2021-02-23 12:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy_wallate`
--

CREATE TABLE `delivery_boy_wallate` (
  `id` int(11) NOT NULL,
  `delivery_boy_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `payment_id` varchar(255) NOT NULL,
  `type` enum('In','Out') NOT NULL,
  `added_on` datetime NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_boy_wallate`
--

INSERT INTO `delivery_boy_wallate` (`id`, `delivery_boy_id`, `amount`, `payment_id`, `type`, `added_on`, `message`) VALUES
(1, 6, 50, '', 'In', '2021-01-29 06:53:10', 'Register'),
(2, 8, 30, '', 'In', '2021-01-29 08:08:37', 'Delivered Order Amount'),
(3, 6, 30, '', 'In', '2021-01-31 08:15:58', 'Delivered Order Amount'),
(4, 6, 30, '', 'In', '2021-02-14 12:31:22', 'Delivered Order Amount'),
(5, 6, 30, '', 'In', '2021-02-14 12:32:24', 'Delivered Order Amount'),
(6, 6, 30, '', 'In', '2021-02-14 12:32:33', 'Delivered Order Amount'),
(7, 6, 30, '', 'In', '2021-02-14 12:32:44', 'Delivered Order Amount'),
(8, 6, 30, '', 'In', '2021-02-14 12:32:58', 'Delivered Order Amount'),
(9, 6, 30, '', 'In', '2021-02-14 12:39:51', 'Delivered Order Amount'),
(10, 6, 30, '', 'In', '2021-02-14 12:40:04', 'Delivered Order Amount'),
(11, 6, 30, '', 'In', '2021-02-14 12:40:13', 'Delivered Order Amount'),
(12, 6, 30, '', 'In', '2021-02-14 12:40:26', 'Delivered Order Amount'),
(13, 6, 30, '', 'In', '2021-02-14 12:40:34', 'Delivered Order Amount'),
(14, 6, 30, '', 'In', '2021-02-14 12:40:47', 'Delivered Order Amount'),
(15, 9, 50, '', 'In', '2021-02-22 11:29:41', 'Register'),
(16, 6, 50, '', 'In', '2021-02-23 12:15:13', 'Delivered Order Amount'),
(17, 10, 50, '', 'In', '2021-03-24 11:19:36', 'Register');

-- --------------------------------------------------------

--
-- Table structure for table `dish_carts`
--

CREATE TABLE `dish_carts` (
  `id` int(11) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `dish_title` varchar(100) NOT NULL,
  `dish_details_id` bigint(20) NOT NULL,
  `attribute` varchar(100) NOT NULL,
  `attr_id` bigint(20) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `rate` varchar(100) NOT NULL,
  `restaurent_id` bigint(20) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dish_carts`
--

INSERT INTO `dish_carts` (`id`, `session_id`, `user_id`, `dish_title`, `dish_details_id`, `attribute`, `attr_id`, `qty`, `rate`, `restaurent_id`, `added_on`) VALUES
(11, '6101718', 8, 'Hyderabadi Biryani', 6, 'Full', 16, '1', '450', 88855340, '2021-01-25 01:55:02'),
(12, '6101718', 8, 'Hyderabadi Biryani', 7, 'Full', 19, '1', '450', 88855340, '2021-01-25 01:55:06'),
(13, '3058238', 0, 'Hyderabadi Biryani', 7, 'Full', 19, '1', '450', 88855340, '2021-01-26 05:01:22'),
(14, '3058238', 0, 'Hyderabadi Biryani', 6, 'Full', 16, '1', '450', 88855340, '2021-01-26 05:01:25'),
(25, '2189341', 0, 'Dum Biryani', 5, 'Full', 13, '2', '450', 88855340, '2021-01-30 03:47:51'),
(26, '2189341', 0, 'Butter Chicken', 4, 'Full', 10, '2', '400', 88855340, '2021-01-30 03:47:54'),
(36, '1041548', 0, 'Butter Chicken', 4, 'Full', 10, '2', '400', 88855340, '2021-02-09 02:41:29'),
(37, '1041548', 0, 'Chiclen Masala', 3, 'Half', 8, '2', '280', 88855340, '2021-02-09 02:41:33'),
(44, '2023642', 0, 'Chicken Shorma', 8, 'Full', 22, '3', '450', 894, '2021-02-22 11:50:50'),
(45, '2023642', 0, 'Kabab Paratha', 11, '2 kabab', 29, '1', '30', 894, '2021-02-22 11:50:53'),
(46, '7254010', 0, 'Chicken Shorma', 8, 'Full', 22, '3', '450', 894, '2021-02-22 11:54:43'),
(47, '7254010', 0, 'Muradabai Biryani', 7, 'Full', 19, '1', '450', 894, '2021-02-22 11:54:45'),
(48, '7254010', 0, 'Chicken Karray', 2, 'Full', 4, '1', '350', 88855340, '2021-02-22 11:55:04'),
(52, '6628189', 0, 'Butter Chicken', 4, 'Full', 10, '2', '400', 88855340, '2021-03-07 02:18:16'),
(53, '6628189', 0, 'Chiclen Masala', 3, 'Half', 8, '2', '280', 88855340, '2021-03-07 02:18:30'),
(54, '4691197', 0, 'Butter Chicken', 4, 'Full', 10, '1', '400', 88855340, '2021-03-15 06:28:18'),
(55, '4691197', 0, 'Chiclen Masala', 3, 'Full', 7, '2', '380', 88855340, '2021-03-15 06:28:23'),
(56, '3802818', 0, 'Dum Biryani', 5, 'Half', 14, '2', '380', 88855340, '2021-03-16 01:43:33'),
(57, '4408380', 9, 'Dum Biryani', 5, 'Full', 13, '2', '450', 88855340, '2021-03-16 01:48:55'),
(58, '4408380', 9, 'Butter Chicken', 4, 'Full', 10, '1', '400', 88855340, '2021-03-16 01:48:57'),
(61, '5867346', 0, 'Kabab', 12, 'Quater', 32, '2', '50', 758051, '2021-03-24 11:33:35'),
(62, '7139919', 0, 'Chiclen Masala', 3, 'Full', 7, '2', '380', 88855340, '2021-05-26 02:20:31'),
(64, '1930646', 0, 'Butter Chicken', 4, 'Full', 10, '1', '400', 88855340, '2021-07-01 08:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `dish_details`
--

CREATE TABLE `dish_details` (
  `id` int(11) NOT NULL,
  `dish_id` bigint(20) NOT NULL,
  `attribute` varchar(255) NOT NULL,
  `price` bigint(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dish_details`
--

INSERT INTO `dish_details` (`id`, `dish_id`, `attribute`, `price`, `status`, `added_on`) VALUES
(1, 1, 'Full', 350, 'Active', '2021-01-13 09:44:34'),
(2, 1, 'Half', 250, 'Active', '2021-01-13 09:44:34'),
(3, 1, 'Quater', 150, 'Active', '2021-01-13 09:44:34'),
(4, 2, 'Full', 350, 'Active', '2021-01-13 09:48:21'),
(5, 2, 'Quater', 150, 'Active', '2021-01-13 09:48:21'),
(6, 2, 'Half', 250, 'Active', '2021-01-13 09:48:21'),
(7, 3, 'Full', 380, 'Active', '2021-01-13 09:51:36'),
(8, 3, 'Half', 280, 'Active', '2021-01-13 09:51:36'),
(9, 3, 'Quater', 180, 'Active', '2021-01-13 09:51:36'),
(10, 4, 'Full', 400, 'Active', '2021-01-13 09:57:09'),
(11, 4, 'Quater', 180, 'Active', '2021-01-13 09:57:09'),
(12, 4, 'Half', 250, 'Active', '2021-01-13 09:57:09'),
(13, 5, 'Full', 450, 'Active', '2021-01-13 10:00:05'),
(14, 5, 'Half', 380, 'Active', '2021-01-13 10:00:05'),
(15, 5, 'Quater', 190, 'Active', '2021-01-13 10:00:05'),
(16, 6, 'Full', 450, 'Active', '2021-01-28 12:37:27'),
(18, 6, 'Qauter', 200, 'Active', '2021-01-28 12:37:27'),
(19, 7, 'Full', 450, 'Active', '2021-01-13 10:04:27'),
(20, 7, 'Quater', 250, 'Active', '2021-01-13 10:04:27'),
(21, 7, 'Half', 190, 'Active', '2021-01-13 10:04:27'),
(22, 8, 'Full', 450, 'Active', '2021-01-19 08:40:08'),
(23, 8, 'Quater', 150, 'Active', '2021-01-19 08:40:08'),
(24, 8, 'Half', 350, 'Active', '2021-01-19 08:40:08'),
(25, 9, 'One Shorma', 80, 'Active', '2021-01-27 11:11:12'),
(26, 9, 'Two Shorma', 150, 'Active', '2021-01-27 11:11:12'),
(27, 10, 'One Shorma', 80, 'Active', '2021-01-27 11:15:57'),
(28, 10, '2 Shorma', 150, 'Active', '2021-01-27 11:15:57'),
(29, 11, '2 kabab', 30, 'Active', '2021-01-27 11:22:59'),
(30, 11, '4 kabab', 60, 'Active', '2021-01-27 11:22:59'),
(31, 6, 'Half', 150, 'Active', '2021-01-28 12:37:27'),
(32, 12, 'Quater', 50, 'Active', '2021-03-24 11:32:04'),
(33, 12, 'Half', 100, 'Active', '2021-03-24 11:32:04'),
(34, 12, 'Full', 150, 'Active', '2021-03-24 11:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `dish_master`
--

CREATE TABLE `dish_master` (
  `id` int(11) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `dish_title` varchar(100) NOT NULL,
  `dish_details` varchar(255) NOT NULL,
  `dish_type` enum('Veg','Non-Veg') CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_two` varchar(255) NOT NULL,
  `image_three` varchar(255) NOT NULL,
  `image_four` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `added_on` datetime NOT NULL,
  `count_sales` int(50) NOT NULL,
  `restaurent_id` bigint(20) NOT NULL DEFAULT 0,
  `count_res_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dish_master`
--

INSERT INTO `dish_master` (`id`, `category_id`, `dish_title`, `dish_details`, `dish_type`, `image`, `image_two`, `image_three`, `image_four`, `status`, `added_on`, `count_sales`, `restaurent_id`, `count_res_order`) VALUES
(1, 3, 'Kadhai chicken', 'Kadai Chicken Testy Item Lazeez', 'Non-Veg', '1610552674_57a9f1fedb4f9f1e1363.jpg', '1610552674_b4e7c293c58b3a66abe2.jpg', '1610552674_7b5dfa638375629bebf5.jpg', '1610552674_03b29689d7878358077e.jpg', 'Active', '2021-01-13 09:44:34', 0, 88855340, 0),
(2, 3, 'Chicken Karray', 'Chicken karry Chicken Testy Item Lazeez', 'Veg', '1610552901_f3d520dea0cb7ae5ea97.jpg', '1610552901_1bc49c6aa4f08eb4a61c.jpg', '1610552901_9ab7f30673376deecec4.jpg', '1610552901_df50d83ce95e036a1f05.jpg', 'Active', '2021-01-13 09:48:21', 0, 88855340, 0),
(3, 3, 'Chiclen Masala', 'Chicken Masala Testy Item Lazeez', 'Non-Veg', '1610553096_11537c7fe6f0c42b2091.jpg', '1610553096_f0505937c4e90ba082b2.jpg', '1610553096_9ef3bfa7fef5e96d1ee3.jpg', '1610553096_d323fd6eb73def182b26.jpg', 'Active', '2021-01-13 09:51:36', 0, 88855340, 0),
(4, 3, 'Butter Chicken', 'Butter  Chicken Testy Item Lazeez', 'Non-Veg', '1610553428_d571b0709952010c7bdc.jpg', '1610553428_53a43130eea106043eb3.jpg', '1610553428_4442f5bf8b31759aba27.jpg', '1610553428_4d20c6d342e2fd0e057a.jpg', 'Active', '2021-01-13 09:57:08', 0, 88855340, 0),
(5, 10, 'Dum Biryani', 'Hyderabadi Dum Biryani', 'Non-Veg', '1610553605_95ceb0a1739c991f267b.jpg', '1610553605_7db9eea4f7f760d5bfd9.jpg', '1610553605_92c75e66ae4520eefe3e.jpg', '1610553605_a36523dd27af74a7d4bb.jpg', 'Active', '2021-01-13 10:00:05', 0, 88855340, 0),
(6, 10, 'Hyderabadi Biryani', 'Hyderabda  Testy  Lazeez Zyaka Biryani\r\n', 'Non-Veg', '1610553867_475a2f40adfc27725271.jpg', '1610553867_5aed07162a854d7f7f15.jpg', '1610553867_275c4dc7fb498bdd3a5c.jpg', '1610553867_74115409fcad5e2cb0aa.jpg', 'Active', '2021-01-13 10:04:27', 0, 894, 0),
(7, 10, 'Muradabai Biryani', 'Muradabai  Testy  Lazeez Zyaka Biryani\r\n', 'Veg', '1611067208_54d215cd52d926ea91b6.jpg', '1610554025_a12a3809f3f9b693846a.jpg', '1610554025_18e0ca7bd8f35950ccc2.jpg', '1610554025_bbb11cb239c322c26342.jpg', 'Active', '2021-01-19 08:40:08', 0, 894, 0),
(8, 8, 'Chicken Shorma', 'Chicken Shorma ', 'Non-Veg', '1611769272_36e0c2d0f7e9e524ab8f.png', '1611769272_d74ea0290bcbae629280.png', '1611769272_27af6d7bd475d94f9923.jpg', '1611769272_3b7da1e653e451e40e1f.jpg', 'Active', '2021-01-27 11:11:12', 0, 894, 0),
(11, 6, 'Kabab Paratha', 'Kabab Pratha', 'Non-Veg', '1611769979_75fb9e059351aa85996a.jpg', '1611769979_1bc16ae6ef4db4a70246.jpg', '1611769979_49b69e442612f4421fa9.jpg', '1611769979_8a564a3aa98333085135.jpg', 'Active', '2021-01-27 11:22:59', 0, 894, 0),
(12, 6, 'Kabab', 'Good', 'Non-Veg', '1616565724_b6b534be4e2484c311ca.jpg', '1616565724_09d0b0a04dd7a0314f33.jpg', '1616565724_1616b8525cb617da327a.jpg', '1616565724_c3c4f1eac50de887bcaf.jpg', 'Active', '2021-03-24 11:32:04', 0, 758051, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dish_rating`
--

CREATE TABLE `dish_rating` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dish_detail_id` int(11) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dish_rating`
--

INSERT INTO `dish_rating` (`id`, `user_id`, `dish_detail_id`, `order_id`, `rating`) VALUES
(1, 6, 7, 162448, 2),
(2, 6, 4, 839336, 3),
(3, 6, 5, 839336, 3),
(4, 1, 7, 846721, 5),
(5, 1, 6, 846721, 5),
(6, 8, 7, 853943, 5),
(7, 8, 6, 853943, 4),
(8, 9, 7, 304389, 5),
(9, 9, 6, 304389, 5),
(10, 9, 6, 304389, 3),
(11, 9, 6, 304389, 4),
(12, 9, 6, 304389, 3),
(13, 9, 6, 304389, 4),
(14, 9, 6, 304389, 5),
(15, 9, 6, 304389, 3),
(16, 9, 6, 304389, 4),
(17, 9, 6, 304389, 2),
(18, 9, 6, 304389, 4),
(19, 10, 11, 648415, 5),
(20, 10, 7, 648415, 5),
(21, 10, 8, 648415, 5),
(22, 10, 3, 785091, 5),
(23, 10, 4, 785091, 5);

-- --------------------------------------------------------

--
-- Table structure for table `ordere_details`
--

CREATE TABLE `ordere_details` (
  `id` int(11) NOT NULL,
  `order_id` int(50) NOT NULL,
  `dish_detail_id` bigint(20) NOT NULL,
  `price` varchar(50) NOT NULL,
  `qty` varchar(50) NOT NULL,
  `attr_id` int(11) NOT NULL,
  `attribute` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordere_details`
--

INSERT INTO `ordere_details` (`id`, `order_id`, `dish_detail_id`, `price`, `qty`, `attr_id`, `attribute`) VALUES
(1, 360680, 5, '190', '1', 15, 'Quater'),
(2, 360680, 6, '200', '1', 18, 'Qauter'),
(3, 460602, 5, '190', '1', 15, 'Quater'),
(4, 846721, 7, '450', '1', 19, 'Full'),
(5, 846721, 6, '450', '1', 16, 'Full'),
(6, 357166, 5, '380', '1', 14, 'Half'),
(7, 357166, 7, '450', '1', 19, 'Full'),
(8, 357166, 6, '450', '2', 16, 'Full'),
(9, 490858, 7, '450', '1', 19, 'Full'),
(10, 490858, 6, '450', '1', 16, 'Full'),
(11, 853943, 7, '450', '1', 19, 'Full'),
(12, 853943, 6, '450', '1', 16, 'Full'),
(13, 818436, 6, '450', '1', 16, 'Full'),
(14, 818436, 7, '450', '1', 19, 'Full'),
(15, 254920, 8, '450', '1', 22, 'Full'),
(16, 254920, 11, '30', '1', 29, '2 kabab'),
(17, 826662, 7, '450', '1', 19, 'Full'),
(18, 826662, 8, '450', '2', 22, 'Full'),
(19, 773113, 4, '400', '1', 10, 'Full'),
(20, 981229, 5, '450', '1', 13, 'Full'),
(21, 981229, 4, '400', '1', 10, 'Full'),
(22, 371076, 3, '380', '1', 7, 'Full'),
(23, 954089, 4, '400', '1', 10, 'Full'),
(24, 954089, 3, '380', '1', 7, 'Full'),
(25, 671805, 4, '400', '1', 10, 'Full'),
(26, 671805, 5, '450', '1', 13, 'Full'),
(27, 304389, 7, '250', '1', 20, 'Quater'),
(28, 164094, 8, '450', '2', 22, 'Full'),
(29, 164094, 11, '30', '2', 29, '2 kabab'),
(30, 839287, 3, '380', '1', 7, 'Full'),
(31, 785091, 3, '280', '2', 8, 'Half'),
(32, 785091, 4, '400', '2', 10, 'Full'),
(33, 698012, 3, '280', '1', 8, 'Half'),
(34, 698012, 4, '180', '1', 11, 'Quater'),
(35, 417362, 8, '450', '1', 22, 'Full'),
(36, 417362, 11, '60', '2', 30, '4 kabab'),
(37, 177643, 8, '450', '1', 22, 'Full'),
(38, 177643, 11, '30', '1', 29, '2 kabab'),
(39, 648415, 11, '30', '1', 29, '2 kabab'),
(40, 648415, 7, '450', '1', 19, 'Full'),
(41, 648415, 8, '450', '1', 22, 'Full'),
(42, 118587, 3, '280', '1', 8, 'Half'),
(43, 118587, 4, '400', '2', 10, 'Full'),
(44, 297969, 4, '400', '1', 10, 'Full'),
(45, 297969, 5, '450', '1', 13, 'Full'),
(46, 754194, 4, '180', '1', 11, 'Quater'),
(47, 754194, 5, '190', '2', 15, 'Quater'),
(48, 959314, 12, '50', '2', 32, 'Quater');

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `pinCode` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `house_number` varchar(100) NOT NULL,
  `total_quantity` varchar(50) NOT NULL,
  `total_amount` varchar(50) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(100) NOT NULL,
  `final_price` float NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `restaurent_id` bigint(20) NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `cancel_by` enum('User','Admin') NOT NULL,
  `cancel_at` datetime DEFAULT NULL,
  `delivery_boy_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `ord_status_time` time DEFAULT NULL,
  `delivered_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`id`, `user_id`, `order_id`, `first_name`, `last_name`, `permanent_address`, `mobile`, `pinCode`, `state`, `city`, `house_number`, `total_quantity`, `total_amount`, `coupon_id`, `coupon_code`, `final_price`, `payment_mode`, `payment_id`, `payment_status`, `restaurent_id`, `order_status`, `cancel_by`, `cancel_at`, `delivery_boy_id`, `order_date`, `ord_status_time`, `delivered_on`) VALUES
(1, 1, '360680', 'Rayees', 'khan', 'Lucknow', 9876543209, '271205', 'Uttar Pradesh', 'Tulsipur', '22/9', '2', '390', 1, 'First50', 195, 'Wallet', '', 'SUCCESS', 894, 'Delivered', 'Admin', '2021-01-25 03:31:05', 6, '2021-01-24', '03:15:54', '2021-02-14 12:40:47'),
(2, 1, '460602', 'Rayees', 'khan', 'Lucknow', 9876543209, '271205', 'Uttar Pradesh', 'Tulsipur', '22/9', '1', '190', 0, '0', 190, 'Wallet', '', 'Pending', 894, 'Cancel', 'User', '2021-01-25 03:32:27', 6, '2021-01-24', '11:55:18', '2021-01-25 12:20:31'),
(3, 1, '846721', 'Rayees', 'khan', 'Lucknow', 9876543209, '271205', 'Uttar Pradesh', 'Tulsipur', '22/9', '2', '900', 1, 'First50', 450, 'Wallet', '', 'SUCCESS', 894, 'Delivered', '', '2021-01-28 03:22:05', 6, '2021-01-29', '12:32:35', '2021-01-25 12:40:41'),
(4, 4, '357166', 'Khan', 'Javed', 'Lucknow', 8765438956, '271205', 'Uttar Pradesh', 'Tulsipur', '550/90', '4', '1730', 0, '0', 1730, 'COD', '', 'SUCCESS', 894, 'Delivered', 'User', NULL, 6, '2021-01-26', '08:45:19', '2021-02-14 12:40:34'),
(5, 4, '490858', 'Khan', 'Javed', 'Lucknow', 8765438956, '271205', 'Uttar Pradesh', 'Tulsipur', '550/90', '2', '900', 0, '0', 900, 'COD', '', 'Pending', 88855340, 'Accept', 'User', NULL, 0, '2021-01-26', '12:31:34', NULL),
(6, 8, '853943', 'Khan', 'Zaheer', 'Lucknow', 8765438956, '271205', 'Uttar Pradesh', 'Tulsipur', '550/90', '2', '900', 0, '0', 900, 'Paytm', '20210126111212800110168760602296934', 'SUCCESS', 88855340, 'Delivered', 'User', NULL, 6, '2021-01-26', '01:31:57', NULL),
(7, 4, '818436', 'Aasif', 'khan', 'Lucknow', 7856439865, '226026', 'Uttar Pradesh', 'Lucknow', '22/89', '2', '900', 0, '0', 900, 'Paytm', '20210126111212800110168381602279714', 'SUCCESS', 88855340, 'Accept', 'User', NULL, 0, '2021-01-26', '05:05:22', NULL),
(8, 4, '254920', 'Khan', 'Rayees', '22/78', 876543987, '226026', 'Uttar Pradesh', 'Lucknow', '22/90', '2', '480', 0, '0', 480, 'Paytm', '20210128111212800110168563202326552', 'SUCCESS', 894, 'Delivered', 'User', NULL, 6, '2021-01-28', '08:14:21', '2021-02-14 12:40:25'),
(9, 4, '826662', 'Khan', 'Rayees', '22/78', 876543987, '226026', 'Uttar Pradesh', 'Lucknow', '22/90', '3', '1350', 0, '0', 1350, 'COD', '', 'SUCCESS', 894, 'Delivered', 'User', NULL, 6, '2021-01-28', '10:43:08', '2021-02-14 12:40:13'),
(15, 4, '954089', 'Javed', 'khan', 'Lucknow', 8765438965, '226026', 'Uttar Pradesh', 'Lucknow', '22/90', '2', '780', 0, '0', 780, 'COD', '', 'SUCCESS', 88855340, 'Delivered', 'User', NULL, 6, '2021-01-30', '03:43:05', '2021-02-14 12:39:51'),
(16, 4, '671805', 'Khan', 'Rayees', 'Lucknow', 8765438965, '226026', 'Uttar Pradesh', 'Lucknow', '22/90', '2', '850', 0, '0', 850, 'Paytm', '20210130111212800110168013602302860', 'SUCCESS', 88855340, 'Delivered', 'User', NULL, 6, '2021-01-30', NULL, '2021-02-14 12:32:44'),
(17, 9, '304389', 'Abdal', 'khan', 'Lucknow', 7865438989, '226026', 'Uttar Pradesh', 'Lucknow', '22/90', '1', '250', 5, 'Zaika third', 240, 'Wallet', '', 'SUCCESS', 894, 'Delivered', 'User', NULL, 6, '2021-01-31', '12:22:33', '2021-01-31 08:15:57'),
(18, 8, '164094', 'khan', 'khan', 'Lucknow', 7856432198, '226026', 'Uttar Pradesh', 'Lucknow', '3/9', '4', '960', 0, '0', 960, 'COD', '', 'Pending', 894, 'Accept', 'User', NULL, 0, '2021-02-02', '11:16:17', NULL),
(19, 9, '839287', 'khan', 'khan', 'Lucknow', 7856432198, '226026', 'Uttar Pradesh', 'Lucknow', '3/9', '1', '380', 0, '0', 380, 'Wallet', '', 'SUCCESS', 88855340, 'Accept', 'User', NULL, 0, '2021-02-02', '04:26:03', NULL),
(20, 10, '785091', 'Ezaz ', 'khan', 'Lucknow', 8989988998, '226026', 'Uttar Pradesh', 'Lucknow', '22/90', '4', '1360', 6, 'Zaika', 816, 'Paytm', '20210209111212800110168782202354691', 'SUCCESS', 88855340, 'Delivered', 'User', NULL, 6, '2021-02-09', '02:55:03', '2021-02-14 12:32:32'),
(21, 8, '698012', 'Ezaz', 'khan', 'Lucknow', 8989988998, '226026', 'Uttar Pradesh', 'Lucknow', '22/90', '2', '460', 0, '0', 460, 'COD', '', 'SUCCESS', 88855340, 'Delivered', 'User', NULL, 6, '2021-02-09', '02:54:27', '2021-02-14 12:40:04'),
(22, 9, '417362', 'khan ', 'rayees', 'Lucknow', 8967543209, '226026', 'Uttar Pradesh', 'Lucknow', '22/89', '3', '570', 4, 'Zaika Second', 470, 'Wallet', '', 'SUCCESS', 894, 'Delivered', 'User', NULL, 6, '2021-02-14', '12:25:32', '2021-02-14 12:31:22'),
(23, 9, '177643', 'khan', 'rayees', 'Lucknow', 8967543209, '226026', 'Uttar Pradesh', 'Lucknow', '22/89', '2', '480', 0, '0', 480, 'Wallet', '', 'SUCCESS', 894, 'Accept', 'User', NULL, 6, '2021-02-14', '12:44:05', NULL),
(24, 10, '648415', 'Khan', 'Rayees', 'Lucknow', 8765342198, '226026', 'Uttar Pradesh', 'Lucknow', '22/9', '3', '930', 4, 'PunSecond', 830, 'Paytm', '20210223111212800110168406402385538', 'SUCCESS', 894, 'Delivered', 'User', NULL, 6, '2021-02-23', '12:10:18', '2021-02-23 12:15:13'),
(25, 9, '118587', 'Umair ', 'khan', 'Lucknow', 9044042323, '226026', 'Up', 'Lucknow', '22/70', '3', '1080', 7, 'First40', 648, 'Paytm', '20210307111212800110168781502434405', 'SUCCESS', 88855340, 'Accept', 'User', NULL, 6, '2021-03-07', '02:27:35', NULL),
(26, 9, '297969', 'Khan', 'testing', 'Lucknow', 8765342982, '226026', 'up', 'Lucknow', '1/34', '2', '850', 7, 'First40', 510, 'Paytm', '20210316111212800110168666702447237', 'SUCCESS', 88855340, 'Accept', 'User', NULL, 6, '2021-03-16', '01:54:31', NULL),
(27, 9, '754194', 'deepak', 'kumar', 'Tedhipuliya', 7856438967, '226026', 'Uttar Pradesh', 'Lucknow', '22/90', '3', '560', 7, 'First40', 336, 'Wallet', '', 'SUCCESS', 88855340, 'Accept', 'User', NULL, 6, '2021-03-23', '06:11:10', NULL),
(28, 9, '959314', 'rayees', 'khan', 'Lucknow', 8967676764, '226026', 'Uttar Pradesh', 'Lucknow', '30/90', '2', '100', 0, '0', 100, 'Paytm', '20210324111212800110168378402481415', 'SUCCESS', 758051, 'Pending', 'User', NULL, 0, '2021-03-24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `order_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `order_status`) VALUES
(1, 'Accept'),
(2, 'Cooke'),
(3, 'Delivered'),
(5, 'On the Way'),
(6, 'Cancel');

-- --------------------------------------------------------

--
-- Table structure for table `order_tracking`
--

CREATE TABLE `order_tracking` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `locationLatitude` varchar(100) NOT NULL,
  `locationLongitude` varchar(100) NOT NULL,
  `delivery_boy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_tracking`
--

INSERT INTO `order_tracking` (`id`, `order_id`, `locationLatitude`, `locationLongitude`, `delivery_boy_id`) VALUES
(2, '671805', '26.8756', '80.9115', 0),
(3, '671805', '26.8756', '80.946167', 6),
(4, '304389', '26.8756', '80.9115', 0),
(5, '304389', '26.8756', '80.9115', 6),
(6, '164094', '26.8756', '80.9115', 0),
(7, '839287', '26.8756', '80.9115', 0),
(8, '785091', '26.8756', '80.9115', 0),
(9, '698012', '26.8756', '80.9115', 0),
(10, '698012', '26.8756', '80.9115', 6),
(11, '785091', '26.8756', '80.9115', 6),
(12, '417362', '26.8756', '80.9115', 0),
(13, '177643', '26.8756', '80.9115', 0),
(14, '177643', '26.8756', '80.9115', 6),
(15, '648415', '26.8756', '80.9115', 0),
(16, '648415', '26.8756', '80.9115', 6),
(17, '118587', '26.8756', '80.9115', 0),
(18, '118587', '26.8756', '80.9115', 6),
(19, '297969', '26.8756', '80.9115', 0),
(20, '297969', '26.8756', '80.9115', 6),
(21, '754194', '26.8756', '80.9115', 0),
(22, '754194', '26.8756', '80.9115', 6),
(23, '959314', '26.8756', '80.9115', 0);

-- --------------------------------------------------------

--
-- Table structure for table `restaurent`
--

CREATE TABLE `restaurent` (
  `id` int(11) NOT NULL,
  `restaurent_uid` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `aadhar_number` varchar(100) NOT NULL,
  `gst_number` varchar(255) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `exact_location` varchar(255) NOT NULL,
  `auth_uid` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurent`
--

INSERT INTO `restaurent` (`id`, `restaurent_uid`, `name`, `email`, `password`, `aadhar_number`, `gst_number`, `state`, `city`, `pincode`, `mobile`, `image`, `exact_location`, `auth_uid`, `status`, `added_on`) VALUES
(1, '88855340', 'Mumbai Jaika', 'mumbaizaika@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '214356789021', 'HJDKKJD849404', 'Up', 'Lucknow', '226026', 9876459865, '', 'Aminabad', '', 'Active', '2021-01-13 22:54:45'),
(2, '894', 'Punjabi Dhaba', 'babadhaba@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '785643985477', 'HDKSKJH79856GH2', 'Uttar Pradesh', 'Lucknow', '226026', 7865438765, '1611736021_ad7616a192811043d65f.jpg', 'Munsipuliya', '72fe4495bb007940fc4d71d9be868315', 'Active', '2021-01-27 01:57:01'),
(3, '754637', 'Kanika Hut', 'kanika@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '896754328765', '875643217865212', 'Uttar Pradesh', 'Lucknow', '226026', 8765342198, '1614016131_5906cd4fec6e07964432.jpg', 'Lucknow', '74caea3bbed02b0d1c87680eee818f58', 'Active', '2021-02-22 11:18:51'),
(9, '565008', 'Afreen Food Deilivery', 'rayeesinfotech@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '897865346790', '896745238709907', 'Uttar Pradesh', 'Lucknow', '226026', 8976453209, '1616771210_1cf1c782be5bb74d2510.jpg', 'Jankipuram', '442ea9a80e457a526a36e09713aaf59e', 'Active', '2021-03-26 08:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `restaurent_opening_status`
--

CREATE TABLE `restaurent_opening_status` (
  `id` int(11) NOT NULL,
  `restaurent_id` varchar(255) NOT NULL,
  `opening_status` varchar(255) NOT NULL,
  `login_ip` varchar(255) DEFAULT NULL,
  `browser` varchar(100) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  `login_date` datetime DEFAULT NULL,
  `logout_time` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurent_opening_status`
--

INSERT INTO `restaurent_opening_status` (`id`, `restaurent_id`, `opening_status`, `login_ip`, `browser`, `login_time`, `login_date`, `logout_time`) VALUES
(1, '88855340', 'Close', 'jlkfdsjlakfj', '', '2021-01-14 00:29:37', NULL, '2021-03-16'),
(2, '894', 'Close', 'uoifu', '', '0000-00-00 00:00:00', NULL, '2021-03-07'),
(3, '894', 'Close', '::1', 'Chrome', '2021-01-28 11:10:25', '2021-01-28 00:00:00', '2021-03-07'),
(4, '894', 'Close', '::1', 'Chrome', '2021-01-28 11:39:39', '2021-01-28 00:00:00', '2021-03-07'),
(5, '894', 'Close', '::1', 'Chrome', '2021-01-29 07:49:36', '2021-01-29 00:00:00', '2021-03-07'),
(6, '88855340', 'Close', '::1', 'Chrome', '2021-01-30 03:42:34', '2021-01-30 00:00:00', '2021-03-16'),
(7, '88855340', 'Close', '::1', 'Chrome', '2021-01-30 08:07:53', '2021-01-30 00:00:00', '2021-03-16'),
(8, '894', 'Close', '::1', 'Chrome', '2021-01-30 08:10:26', '2021-01-30 00:00:00', '2021-03-07'),
(9, '894', 'Close', '::1', 'Chrome', '2021-01-31 12:17:27', '2021-01-31 00:00:00', '2021-03-07'),
(10, '894', 'Close', '::1', 'Chrome', '2021-01-31 08:13:49', '2021-01-31 00:00:00', '2021-03-07'),
(11, '88855340', 'Close', '::1', 'Chrome', '2021-02-09 02:40:42', '2021-02-09 00:00:00', '2021-03-16'),
(12, '894', 'Close', '::1', 'Chrome', '2021-02-14 12:17:43', '2021-02-14 00:00:00', '2021-03-07'),
(13, '88855340', 'Close', '::1', 'Chrome', '2021-02-18 01:09:12', '2021-02-18 00:00:00', '2021-03-16'),
(14, '88855340', 'Close', '::1', 'Chrome', '2021-02-20 12:02:23', '2021-02-20 00:00:00', '2021-03-16'),
(15, '88855340', 'Close', '::1', 'Chrome', '2021-02-22 10:52:20', '2021-02-22 00:00:00', '2021-03-16'),
(16, '894', 'Close', '::1', 'Chrome', '2021-02-22 11:14:49', '2021-02-22 00:00:00', '2021-03-07'),
(17, '754637', 'Close', '22', '', '0000-00-00 00:00:00', NULL, '2021-03-07'),
(18, '754637', 'Close', '::1', 'Chrome', '2021-02-22 11:49:08', '2021-02-22 00:00:00', '2021-03-07'),
(19, '894', 'Close', '::1', 'Chrome', '2021-02-22 11:50:30', '2021-02-22 00:00:00', '2021-03-07'),
(20, '894', 'Close', '::1', 'Chrome', '2021-02-23 12:07:13', '2021-02-23 00:00:00', '2021-03-07'),
(21, '894', 'Close', '::1', 'Chrome', '2021-02-23 12:16:49', '2021-02-23 00:00:00', '2021-03-07'),
(22, '894', 'Close', '::1', 'Chrome', '2021-03-07 02:15:38', '2021-03-07 00:00:00', '2021-03-07'),
(23, '754637', 'Close', '::1', 'Chrome', '2021-03-07 02:16:32', '2021-03-07 00:00:00', '2021-03-07'),
(24, '88855340', 'Close', '::1', 'Chrome', '2021-03-07 02:17:03', '2021-03-07 00:00:00', '2021-03-16'),
(25, '88855340', 'Close', '::1', 'Chrome', '2021-03-07 02:26:49', '2021-03-07 00:00:00', '2021-03-16'),
(26, '88855340', 'Close', '::1', 'Chrome', '2021-03-16 01:54:11', '2021-03-16 00:00:00', '2021-03-16'),
(27, '88855340', 'Open', '::1', 'Chrome', '2021-03-23 05:57:02', '2021-03-23 00:00:00', '0000-00-00'),
(28, '758051', 'Open', '::1', 'Chrome', '2021-03-24 11:30:20', '2021-03-24 00:00:00', '0000-00-00'),
(30, '565008', 'Open', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `cart_min_price` int(11) NOT NULL,
  `cart_min_price_msg` varchar(100) NOT NULL,
  `website_close` varchar(255) NOT NULL,
  `website_close_msg` varchar(255) NOT NULL,
  `wallet_amt` int(11) NOT NULL DEFAULT 0,
  `referal_amount` bigint(20) NOT NULL,
  `deli_boy_reg_cahback` bigint(20) NOT NULL,
  `deliBoyPerOrderAmt` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `cart_min_price`, `cart_min_price_msg`, `website_close`, `website_close_msg`, `wallet_amt`, `referal_amount`, `deli_boy_reg_cahback`, `deliBoyPerOrderAmt`) VALUES
(1, 100, 'Cart min price will be 100', 'Open', 'website close for today', 50, 40, 50, 50);

-- --------------------------------------------------------

--
-- Table structure for table `slider_image`
--

CREATE TABLE `slider_image` (
  `id` int(11) NOT NULL,
  `heading` varchar(100) NOT NULL,
  `subtitle` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_two` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider_image`
--

INSERT INTO `slider_image` (`id`, `heading`, `subtitle`, `image`, `image_two`, `status`, `added_on`) VALUES
(1, 'Online Food Ordaring System', 'Multivendor Online Food Ordaring System', '1610636612_994626765630054f59db.jpg', '1610636612_fe8483b031c88cb8e4f9.jpg', 'Active', '2021-01-14 09:03:32'),
(2, 'Online Food Ordaring System', 'Multivendor Online Food Ordaring System', '1610636406_f7d3fe45421e113f8c1b.jpg', '1610636406_a3327110517fec9dc48c.jpg', 'Active', '2021-01-14 09:00:06');

-- --------------------------------------------------------

--
-- Table structure for table `users_master`
--

CREATE TABLE `users_master` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `referal_code` varchar(50) NOT NULL,
  `from_referal_code` varchar(50) NOT NULL,
  `added_date` date NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_master`
--

INSERT INTO `users_master` (`id`, `uid`, `name`, `gender`, `email`, `mobile`, `password`, `profile_pic`, `status`, `referal_code`, `from_referal_code`, `added_date`, `updated_at`) VALUES
(1, 'FIRSTUSER983733\r\n', 'Rayees khan', 'Male', 'khanrayees@gmail.com', 9876769872, 'e10adc3949ba59abbe56e057f20f883e', '', 'Active', 'RAY786', '', '2021-01-25', NULL),
(4, '56a9f8197e4ffebef7fb6888f3c15a77', 'Khan Rayees', 'Male', 'rayeesinfotech@gmail.com', 9876543298, 'e10adc3949ba59abbe56e057f20f883e', '', 'Active', '06e3d8', 'RAY786', '2021-01-25', NULL),
(8, 'df6afbb64ee83fb1861cf0a78eb778d5', 'Khan Zaheer', 'Male', 'krayees282@gmail.com', 8765438956, 'e10adc3949ba59abbe56e057f20f883e', '', 'Active', '88f44a', '06e3d8', '2021-01-26', NULL),
(9, '118042259033201699023', 'Rayees', 'Khan', 'rayeesinfotech@gmail.com', 0, '', 'https://lh3.googleusercontent.com/a-/AOh14GgmfeyREosRGUZJB-KwiKkQRX9S4owOzhSzsTee=s96-c', 'Active', '4627bf', '', '2021-03-24', NULL),
(10, '105154189651675361962', 'Rayees', 'Khan', 'codewithrayees@gmail.com', 0, '', 'https://lh3.googleusercontent.com/a-/AOh14Ghxq1uE0huh_HC8J2yctIhGdr5_b3jmE1JghK9_=s96-c', 'Active', '6a788e', '', '2021-02-23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `payment_id` varchar(255) NOT NULL,
  `type` enum('In','Out') NOT NULL,
  `added_on` datetime NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `user_id`, `amount`, `payment_id`, `type`, `added_on`, `message`) VALUES
(1, 1, 50, '', 'In', '2021-01-25 10:20:13', 'Register'),
(4, 4, 50, '', 'In', '2021-01-25 11:33:34', 'Register'),
(5, 4, 40, '', 'In', '2021-01-25 11:33:48', 'Referal Amount From :Rayees khan'),
(6, 1, 40, '', 'In', '2021-01-26 12:51:22', 'Referal First Order Cashback  Amount From :Khan'),
(13, 8, 50, '', 'In', '2021-01-26 01:23:41', 'Register'),
(14, 8, 40, '', 'In', '2021-01-26 01:23:53', 'Referal Amount From :Khan Rayees'),
(15, 4, 40, '', 'In', '2021-01-26 01:43:01', 'Referal First Order Cashback  Amount From :Khan'),
(16, 1, 40, '', 'In', '2021-01-26 08:40:28', 'Referal First Order Cashback  Amount From :Khan'),
(17, 9, 50, '', 'In', '2021-01-31 01:22:01', 'Register'),
(18, 9, 200, '20210131111212800110168725902335307', 'In', '2021-01-31 12:15:57', 'Added'),
(19, 9, 240, '', 'Out', '2021-01-31 12:21:28', '304389'),
(20, 9, 500, '20210202111212800110168016302310265', 'In', '2021-02-02 03:26:49', 'Added'),
(21, 9, 380, '', 'Out', '2021-02-02 03:28:08', '839287'),
(22, 10, 50, '', 'In', '2021-02-09 02:45:25', 'Register'),
(23, 9, 1500, '20210211111212800110168959402343614', 'In', '2021-02-11 08:33:36', 'Added'),
(24, 9, 470, '', 'Out', '2021-02-14 12:23:16', '417362'),
(25, 9, 480, '', 'Out', '2021-02-14 12:42:40', '177643'),
(26, 10, 500, '20210223111212800110168158502381972', 'In', '2021-02-23 12:02:11', 'Added'),
(27, 9, 336, '', 'Out', '2021-03-23 06:08:25', '754194');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_master`
--
ALTER TABLE `category_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chating_customer`
--
ALTER TABLE `chating_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_master`
--
ALTER TABLE `coupon_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_boy_master`
--
ALTER TABLE `delivery_boy_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- Indexes for table `delivery_boy_rating`
--
ALTER TABLE `delivery_boy_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_boy_wallate`
--
ALTER TABLE `delivery_boy_wallate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish_carts`
--
ALTER TABLE `dish_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish_details`
--
ALTER TABLE `dish_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish_master`
--
ALTER TABLE `dish_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish_rating`
--
ALTER TABLE `dish_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordere_details`
--
ALTER TABLE `ordere_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_tracking`
--
ALTER TABLE `order_tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurent`
--
ALTER TABLE `restaurent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `restaurent_uid` (`restaurent_uid`);

--
-- Indexes for table `restaurent_opening_status`
--
ALTER TABLE `restaurent_opening_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_image`
--
ALTER TABLE `slider_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_master`
--
ALTER TABLE `users_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category_master`
--
ALTER TABLE `category_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `chating_customer`
--
ALTER TABLE `chating_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupon_master`
--
ALTER TABLE `coupon_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `delivery_boy_master`
--
ALTER TABLE `delivery_boy_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `delivery_boy_rating`
--
ALTER TABLE `delivery_boy_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delivery_boy_wallate`
--
ALTER TABLE `delivery_boy_wallate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `dish_carts`
--
ALTER TABLE `dish_carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `dish_details`
--
ALTER TABLE `dish_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `dish_master`
--
ALTER TABLE `dish_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dish_rating`
--
ALTER TABLE `dish_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ordere_details`
--
ALTER TABLE `ordere_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_tracking`
--
ALTER TABLE `order_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `restaurent`
--
ALTER TABLE `restaurent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `restaurent_opening_status`
--
ALTER TABLE `restaurent_opening_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider_image`
--
ALTER TABLE `slider_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_master`
--
ALTER TABLE `users_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
