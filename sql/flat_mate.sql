-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 21, 2025 at 01:16 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flat_mate`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acc_id` int NOT NULL,
  `acc_name` varchar(100) NOT NULL,
  `acc_email` varchar(100) NOT NULL,
  `acc_password` varchar(255) NOT NULL,
  `acc_phone` varchar(20) DEFAULT NULL,
  `acc_gender` varchar(10) DEFAULT NULL,
  `acc_age` int DEFAULT NULL,
  `acc_smoking` tinyint(1) DEFAULT NULL,
  `acc_status` varchar(255) DEFAULT NULL,
  `acc_address` varchar(200) DEFAULT NULL,
  `acc_type` enum('admin','house_owner','roommate') NOT NULL,
  `acc_point` int DEFAULT '0',
  `acc_total_count` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_id`, `acc_name`, `acc_email`, `acc_password`, `acc_phone`, `acc_gender`, `acc_age`, `acc_smoking`, `acc_status`, `acc_address`, `acc_type`, `acc_point`, `acc_total_count`) VALUES
(1, 'Davis House', 'vabil@mailinator.com', '$2y$10$Xuzv843K8RH4TVCClSlzQOtUIq1TkbPRLTCVWh92G0I4LopTvKWgO', '0512147844', 'Female', NULL, NULL, NULL, 'Voluptatum quidem ut', 'house_owner', 0, 0),
(2, 'Hilel Schneider', 'cigugopy@mailinator.com', '$2y$10$ejITiwyuIZHcZuLhrCfI6.ewDm/.gfmnlA2ILvrrGW7X3yOAl0e1a', '0514525474', 'Female', NULL, NULL, NULL, 'Et reprehenderit ni', 'roommate', 0, 0),
(3, 'ayram', 'owner@owner.com', '$2y$10$DvPh3gg6pzeM7J.djTQqaO1jI418aauZDWTZHyzUJBmzCwO9vTuOS', '0512548457', 'Female', NULL, NULL, NULL, 'Jubail', 'house_owner', 0, 0),
(4, 'yasmeen t', 'yas@rom.com', '$2y$10$H3wniKIV6Iu.4HHbZnd3fe.A72xjlxUT3LVPP0OqUwNMgdHSZ41P2', '0542454144', 'Female', NULL, NULL, NULL, 'الرياض شارع 23', 'roommate', 0, 0),
(5, 'Hajer Ahmed', 'hajer@rom.com', '$2y$10$KpFuRXmaqkDuRB.EkILcouIotGX9sWdfDEwblDL81ItrFgPHnXZN2', '0512145414', 'Female', NULL, NULL, NULL, 'Jubail', 'roommate', 0, 0),
(6, 'Manar Ali', 'manar@rom.com', '$2y$10$KpFuRXmaqkDuRB.EkILcouIotGX9sWdfDEwblDL81ItrFgPHnXZN2', '0524525555', 'Female', 23, 0, 'Officia porro sit h', 'Et fugiat non except', 'roommate', 0, 0),
(7, 'admind', 'admin@admin.com', '$2y$10$KpFuRXmaqkDuRB.EkILcouIotGX9sWdfDEwblDL81ItrFgPHnXZN2', '0512548450', 'Male', NULL, NULL, NULL, 'Jubail', 'admin', 0, 0),
(8, 'Taylor Huff', 'xudora@mailinator.com', '$2y$10$t70Uuz2CP0w02AJ9HhIjhuK0vDKlk7uYWEroBjLdPUvzNFgryid/G', '0512141111', 'Female', 29, 0, 'engineer', 'Consequat Inventore', 'roommate', 0, 0),
(9, 'test', 'test@owner.com', '$2y$10$DvPh3gg6pzeM7J.djTQqaO1jI418aauZDWTZHyzUJBmzCwO9vTuOS', '0512548457', 'Female', NULL, NULL, NULL, 'Jubail', 'house_owner', 0, 0),
(10, 'Ohoud', 'ohoud@woner.com', '$2y$10$P/fwSAOf1wh4Oftquc.iiuWKzDwRHv989vEaHPX2MMCkVzstc7oo6', '0521414111', 'Male', NULL, NULL, NULL, 'الرياض شارع 23', 'house_owner', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `app_id` int NOT NULL,
  `acc_id` int NOT NULL,
  `roommate_req_id` int DEFAULT NULL,
  `app_status` enum('pending','accepted','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`app_id`, `acc_id`, `roommate_req_id`, `app_status`) VALUES
(6, 6, 10, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `fac_id` int NOT NULL,
  `fac_title` varchar(100) DEFAULT NULL,
  `fac_description` varchar(255) DEFAULT NULL,
  `ua_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`fac_id`, `fac_title`, `fac_description`, `ua_id`) VALUES
(1, 'Ut sint esse non des', 'sdfsdff', 1),
(2, 'Swimming Pool', 'Private pool available in the backyard.', 2),
(3, 'Parking', 'Covered parking for two cars.', 2),
(4, 'Gym', 'On-site gym with modern equipment.', 2),
(5, 'Wi-Fi', 'High-speed internet included.', 2),
(6, 'Security', '24/7 security with CCTV surveillance.', 2),
(7, 'Swimming Pool', 'Private pool available in the backyard.', 3),
(8, 'Parking', 'Covered parking for two cars.', 3),
(9, 'Gym', 'On-site gym with modern equipment.', 3),
(10, 'Wi-Fi', 'High-speed internet included.', 3),
(11, 'Security', '24/7 security with CCTV surveillance.', 3),
(12, 'Swimming Pool', 'Private pool available in the backyard.', 4),
(13, 'Parking', 'Covered parking for two cars.', 4),
(14, 'Gym', 'On-site gym with modern equipment.', 4),
(15, 'Wi-Fi', 'High-speed internet included.', 4),
(16, 'Security', '24/7 security with CCTV surveillance.', 4),
(17, 'Swimming Pool', 'Private pool available in the backyard.', 5),
(18, 'Parking', 'Covered parking for two cars.', 5),
(19, 'Gym', 'On-site gym with modern equipment.', 5),
(20, 'Wi-Fi', 'High-speed internet included.', 5),
(21, 'Security', '24/7 security with CCTV surveillance.', 5),
(22, 'Swimming Pool', 'Private pool available in the backyard.', 6),
(23, 'Parking', 'Covered parking for two cars.', 6),
(24, 'Gym', 'On-site gym with modern equipment.', 6),
(25, 'Wi-Fi', 'High-speed internet included.', 6),
(26, 'Security', '24/7 security with CCTV surveillance.', 6),
(27, 'Swimming Pool', 'Private pool available in the backyard.', 7),
(28, 'Parking', 'Covered parking for two cars.', 7),
(29, 'Gym', 'On-site gym with modern equipment.', 7),
(30, 'Wi-Fi', 'High-speed internet included.', 7),
(31, 'Security', '24/7 security with CCTV surveillance.', 7),
(32, 'Swimming Pool', 'Private pool available in the backyard.', 8),
(33, 'Parking', 'Covered parking for two cars.', 8),
(34, 'Gym', 'On-site gym with modern equipment.', 8),
(35, 'Wi-Fi', 'High-speed internet included.', 8),
(36, 'Security', '24/7 security with CCTV surveillance.', 8),
(37, 'Swimming Pool', 'Private pool available in the backyard.', 9),
(38, 'Parking', 'Covered parking for two cars.', 9),
(39, 'Gym', 'On-site gym with modern equipment.', 9),
(40, 'Wi-Fi', 'High-speed internet included.', 9),
(41, 'Security', '24/7 security with CCTV surveillance.', 9),
(42, 'Swimming Pool', 'Private pool available in the backyard.', 10),
(43, 'Parking', 'Covered parking for two cars.', 10),
(44, 'Gym', 'On-site gym with modern equipment.', 10),
(45, 'Wi-Fi', 'High-speed internet included.', 10),
(46, 'Security', '24/7 security with CCTV surveillance.', 10),
(47, 'Swimming Pool', 'Private pool available in the backyard.', 11),
(48, 'Parking', 'Covered parking for two cars.', 11),
(49, 'Gym', 'On-site gym with modern equipment.', 11),
(50, 'Wi-Fi', 'High-speed internet included.', 11),
(51, 'Security', '24/7 security with CCTV surveillance.', 11),
(57, 'WiFi', '', 13),
(58, 'Internet', '', 13),
(59, 'Air Conditioning', '', 13),
(60, 'Washing Machine', '', 13),
(61, 'Refrigerator', '', 13);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `ua_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image_url`, `ua_id`) VALUES
(1, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 1),
(2, '/uploads/dummy-slug-2025-03-10-67cf72651f62d.jpg', 1),
(3, '/uploads/dummy-slug-2025-03-10-67cf7265218ea.jpg', 1),
(4, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 2),
(5, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 2),
(6, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 2),
(7, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 3),
(8, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 3),
(9, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 3),
(10, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 4),
(11, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 4),
(12, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 4),
(13, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 5),
(14, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 5),
(15, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 5),
(16, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 6),
(17, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 6),
(18, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 6),
(19, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 7),
(20, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 7),
(21, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 7),
(22, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 8),
(23, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 8),
(24, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 8),
(25, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 9),
(26, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 9),
(27, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 9),
(28, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 10),
(29, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 10),
(30, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 10),
(31, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 11),
(32, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 11),
(33, '/uploads/dummy-slug-2025-03-10-67cf726518782.jpg', 11);

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

CREATE TABLE `like` (
  `like_id` int NOT NULL,
  `ua_id` int NOT NULL,
  `acc_id` int NOT NULL,
  `like_dateTime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `like`
--

INSERT INTO `like` (`like_id`, `ua_id`, `acc_id`, `like_dateTime`) VALUES
(2, 8, 6, '2025-04-20 15:22:50'),
(3, 1, 6, '2025-04-20 15:28:12'),
(4, 3, 6, '2025-04-20 15:28:15'),
(5, 1, 5, '2025-04-20 23:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ma_id` int NOT NULL,
  `ma_title` varchar(255) DEFAULT NULL,
  `ma_type` varchar(50) DEFAULT NULL,
  `ma_content` text NOT NULL,
  `ma_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `sender_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`ma_id`, `ma_title`, `ma_type`, `ma_content`, `ma_date_time`, `sender_id`, `receiver_id`, `is_read`) VALUES
(12, 'Chat about Unit Ad #', 'unit_ad_chat', 'dfvdfv', '2025-03-11 22:58:48', 5, 4, 0),
(13, 'Chat about Unit Ad #', 'unit_ad_chat', 'hi araym', '2025-03-12 08:39:43', 6, 3, 1),
(14, 'Chat about Unit Ad #', 'unit_ad_chat', 'hi manar', '2025-03-12 08:47:22', 4, 6, 1),
(15, NULL, NULL, 'cdsd', '2025-03-12 09:57:04', 6, 4, 1),
(16, NULL, NULL, 'dscsdc', '2025-03-12 09:57:10', 6, 4, 1),
(17, NULL, NULL, 'egrg', '2025-03-12 09:59:37', 6, 3, 1),
(18, NULL, NULL, 'thhhhhhhhhhh', '2025-03-12 09:59:55', 4, 6, 1),
(19, NULL, NULL, 'fvdfv', '2025-03-12 12:48:13', 3, 6, 0),
(20, NULL, NULL, 'hi', '2025-04-20 23:15:14', 6, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `pack_id` int NOT NULL,
  `pack_name` varchar(100) NOT NULL,
  `pack_fee` decimal(10,2) NOT NULL,
  `pack_privillages` text,
  `pack_duration` int DEFAULT NULL,
  `pack_status` varchar(50) DEFAULT NULL,
  `acc_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`pack_id`, `pack_name`, `pack_fee`, `pack_privillages`, `pack_duration`, `pack_status`, `acc_id`) VALUES
(1, 'Premium Plant', '100.00', 'Unlimited Ads, Priority Listing, Analytics Access', 12, 'active', NULL),
(3, 'Starter Package', '99.00', 'Post up to 5 unit ads, Basic Support, Standard Visibility', 1, 'active', NULL),
(4, 'Premium Package', '249.00', 'Unlimited unit ads, Priority Support, Highlighted Listings, Analytics Access', 3, 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int NOT NULL,
  `review_subject` varchar(150) DEFAULT NULL,
  `review_comment` text,
  `review_rate` int DEFAULT NULL,
  `review_dateTime` datetime DEFAULT NULL,
  `review_type` varchar(50) DEFAULT NULL,
  `ua_id` int DEFAULT NULL,
  `acc_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `review_subject`, `review_comment`, `review_rate`, `review_dateTime`, `review_type`, `ua_id`, `acc_id`) VALUES
(1, NULL, 'good unit and it is very clean', 2, '2025-03-11 21:40:23', NULL, 1, 4),
(2, NULL, 'not bad', 1, '2025-03-11 21:40:23', NULL, 1, 4),
(5, NULL, 'not bad', 1, '2025-03-11 21:40:23', NULL, 2, 4),
(6, NULL, 'not bad', 1, '2025-03-11 21:40:23', NULL, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `roommaterequest`
--

CREATE TABLE `roommaterequest` (
  `roommate_req_id` int NOT NULL,
  `ua_id` int NOT NULL,
  `acc_id` int NOT NULL,
  `roommate_req_des` text,
  `roommate_req_gender` varchar(10) DEFAULT NULL,
  `roommate_req_age` int DEFAULT NULL,
  `roommate_req_emp_status` varchar(50) DEFAULT NULL,
  `roommate_req_smoking` tinyint(1) DEFAULT '0',
  `roommate_req_child` tinyint(1) DEFAULT '0',
  `roommate_req_pets_ref` tinyint(1) DEFAULT '0',
  `roommate_req_num_of_roommate` int DEFAULT NULL,
  `req_status` enum('Open','Completed') DEFAULT 'Open',
  `owner_action` enum('pending','accepted','rejected','invited') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roommaterequest`
--

INSERT INTO `roommaterequest` (`roommate_req_id`, `ua_id`, `acc_id`, `roommate_req_des`, `roommate_req_gender`, `roommate_req_age`, `roommate_req_emp_status`, `roommate_req_smoking`, `roommate_req_child`, `roommate_req_pets_ref`, `roommate_req_num_of_roommate`, `req_status`, `owner_action`) VALUES
(10, 1, 5, 'looking for good rommatte', 'Male', 34, 'Unemployed', 0, 0, 0, 4, 'Open', 'pending'),
(11, 4, 5, 'i need good rommatte please', 'Male', 34, 'Employed', 1, 1, 0, 1, 'Open', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `subscribtion`
--

CREATE TABLE `subscribtion` (
  `sub_id` int NOT NULL,
  `sub_amount` decimal(10,2) NOT NULL,
  `sub_start_date` date NOT NULL,
  `sub_end_date` date DEFAULT NULL,
  `sub_number_of_ads` int DEFAULT NULL,
  `sub_payment_method` varchar(50) DEFAULT NULL,
  `sub_card_number` varchar(50) DEFAULT NULL,
  `acc_id` int NOT NULL,
  `pack_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subscribtion`
--

INSERT INTO `subscribtion` (`sub_id`, `sub_amount`, `sub_start_date`, `sub_end_date`, `sub_number_of_ads`, `sub_payment_method`, `sub_card_number`, `acc_id`, `pack_id`) VALUES
(2, '100.00', '2025-03-11', '2026-03-11', 99, 'Credit Card', '4444', 3, 1),
(3, '100.00', '2025-03-11', '2026-03-11', 99, 'Credit Card', '4444', 9, 3),
(4, '100.00', '2025-03-11', '2026-03-11', 99, 'Credit Card', '4444', 9, 4);

-- --------------------------------------------------------

--
-- Table structure for table `unit_ads`
--

CREATE TABLE `unit_ads` (
  `ua_id` int NOT NULL,
  `ua_size` varchar(50) DEFAULT NULL,
  `ua_rent_duration` varchar(100) DEFAULT NULL,
  `ua_description` text,
  `ua_rent_fees` decimal(10,2) DEFAULT NULL,
  `ua_availability_start_date` date DEFAULT NULL,
  `ua_type` varchar(100) DEFAULT NULL,
  `ua_address` varchar(200) DEFAULT NULL,
  `ua_pets_allowed` tinyint(1) DEFAULT '0',
  `ua_smoking_allowed` tinyint(1) DEFAULT '0',
  `ua_num_of_roommates` int DEFAULT NULL,
  `ua_num_of_bedrooms` int DEFAULT NULL,
  `ua_lease_term` varchar(100) DEFAULT NULL,
  `ua_deed_number` varchar(255) DEFAULT NULL,
  `ua_age` int DEFAULT NULL,
  `acc_id` int NOT NULL,
  `ua_status` enum('Available','Booked','Closed') DEFAULT 'Available',
  `ua_added_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `unit_ads`
--

INSERT INTO `unit_ads` (`ua_id`, `ua_size`, `ua_rent_duration`, `ua_description`, `ua_rent_fees`, `ua_availability_start_date`, `ua_type`, `ua_address`, `ua_pets_allowed`, `ua_smoking_allowed`, `ua_num_of_roommates`, `ua_num_of_bedrooms`, `ua_lease_term`, `ua_deed_number`, `ua_age`, `acc_id`, `ua_status`, `ua_added_at`) VALUES
(1, '27', 'Non sit cupidatat in', 'Eius eaque cupiditat', '20.00', '1998-10-19', 'Villa', 'Quibusdam nemo dolor', 0, 1, 74, 22, 'Voluptate laboriosam', '345553', 92, 3, 'Available', '2025-02-10 00:15:10'),
(2, '120.5', 'Monthly', 'Spacious apartment with modern amenities.', '3500.00', '2024-11-01', 'Apartment', '123 King Fahd Road, Riyadh', 1, 0, 2, 3, '12 months', '35553', 5, 3, 'Booked', '2025-03-23 00:15:10'),
(3, '250', 'Yearly', 'Luxurious villa with a private pool.', '60000.00', '2024-12-01', 'Villa', '45 Al Rajhi Street, Jeddah', 0, 1, 4, 5, '24 months', '2344', 3, 3, 'Available', '2025-03-23 00:15:10'),
(4, '45', 'Monthly', 'Cozy studio perfect for singles.', '1800.00', '2024-10-15', 'Studio', '78 Prince Sultan Ave, Dammam', 1, 0, 1, 1, '6 months', '234442', 2, 3, 'Available', '2025-03-23 00:15:10'),
(5, '90', 'Monthly', 'Modern apartment near city center.', '2800.00', '2024-11-10', 'Apartment', '12 Olaya Street, Riyadh', 0, 0, 2, 2, '12 months', '234234', 4, 3, 'Available', '2023-12-01 00:15:10'),
(6, '300', 'Yearly', 'Beachfront villa with stunning views.', '75000.00', '2025-01-01', 'Villa', '33 Corniche Road, Jeddah', 1, 1, 5, 6, '36 months', '42344', 6, 3, 'Available', '2025-03-23 00:15:10'),
(7, '50', 'Monthly', 'Newly built studio with modern design.', '2000.00', '2024-10-20', 'Studio', '19 Al Mather Street, Riyadh', 0, 1, 1, 1, '6 months', '234211', 1, 3, 'Available', '2025-03-23 00:15:10'),
(8, '110', 'Monthly', 'Family-friendly apartment with balcony.', '3200.00', '2024-11-15', 'Apartment', '56 Al Khobar Road, Dammam', 1, 0, 3, 3, '12 months', '13123', 3, 3, 'Available', '2025-03-23 00:15:10'),
(9, '280', 'Yearly', 'Elegant villa with large garden.', '68000.00', '2024-12-15', 'Villa', '88 Tahlia Street, Jeddah', 0, 1, 4, 5, '24 months', '12323', 5, 3, 'Available', '2025-03-23 00:15:10'),
(10, '100', 'Monthly', 'Bright apartment with great location.', '3000.00', '2024-10-25', 'Apartment', '27 Al Rawdah, Riyadh', 1, 0, 2, 2, '12 months', '234', 2, 3, 'Available', '2025-03-23 00:15:10'),
(11, '40', 'Monthly', 'Compact studio with mountain views.', '1500.00', '2024-11-05', 'Studio', '99 Al Hada Road, Taif', 0, 0, 1, 1, '6 months', '343434', 1, 1, 'Available', '2025-03-23 00:15:10'),
(12, '40', 'Monthly', 'Compact studio with mountain views.', '1500.00', '2024-11-05', 'Studio', '99 Al Hada Road, Taif', 0, 0, 1, 1, '6 months', '23423', 1, 3, 'Available', '2025-03-23 00:15:10'),
(13, '93', 'Voluptatem aspernat', 'Voluptatem vel in a', '21.00', '1984-09-19', 'Villa', 'Doloribus aut et sol', 0, 1, 2, 50, 'Officia et non conse', '872', 95, 3, 'Available', '2025-04-20 23:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `view`
--

CREATE TABLE `view` (
  `view_id` int NOT NULL,
  `acc_id` int DEFAULT NULL,
  `ua_id` int NOT NULL,
  `view_ip_address` varchar(45) DEFAULT NULL,
  `view_dateTime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `view`
--

INSERT INTO `view` (`view_id`, `acc_id`, `ua_id`, `view_ip_address`, `view_dateTime`) VALUES
(1, 6, 8, '127.0.0.1', '2025-04-20 15:40:14'),
(2, 6, 3, '127.0.0.1', '2025-04-20 22:56:59'),
(3, 5, 1, '127.0.0.1', '2025-04-20 23:03:10'),
(4, 5, 4, '127.0.0.1', '2025-04-20 23:05:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_id`),
  ADD UNIQUE KEY `acc_email` (`acc_email`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`app_id`),
  ADD KEY `fk_app_account` (`acc_id`),
  ADD KEY `fk_app_roommate_req` (`roommate_req_id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`fac_id`),
  ADD KEY `fk_facilities_unit` (`ua_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `fk_images_unit` (`ua_id`);

--
-- Indexes for table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`like_id`),
  ADD UNIQUE KEY `ua_id` (`ua_id`,`acc_id`),
  ADD KEY `acc_id` (`acc_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ma_id`),
  ADD KEY `fk_msg_sender` (`sender_id`),
  ADD KEY `fk_msg_receiver` (`receiver_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`pack_id`),
  ADD KEY `fk_package_account` (`acc_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_review_unit` (`ua_id`),
  ADD KEY `fk_review_account` (`acc_id`);

--
-- Indexes for table `roommaterequest`
--
ALTER TABLE `roommaterequest`
  ADD PRIMARY KEY (`roommate_req_id`),
  ADD KEY `ua_idFKKK` (`ua_id`),
  ADD KEY `acc_idFKK` (`acc_id`);

--
-- Indexes for table `subscribtion`
--
ALTER TABLE `subscribtion`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `fk_subscribtion_acc` (`acc_id`),
  ADD KEY `fk_subscribtion_pack` (`pack_id`);

--
-- Indexes for table `unit_ads`
--
ALTER TABLE `unit_ads`
  ADD PRIMARY KEY (`ua_id`),
  ADD KEY `fk_unitads_account` (`acc_id`);

--
-- Indexes for table `view`
--
ALTER TABLE `view`
  ADD PRIMARY KEY (`view_id`),
  ADD KEY `acc_id` (`acc_id`),
  ADD KEY `ua_id` (`ua_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `app_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `fac_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `like`
--
ALTER TABLE `like`
  MODIFY `like_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ma_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `pack_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roommaterequest`
--
ALTER TABLE `roommaterequest`
  MODIFY `roommate_req_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subscribtion`
--
ALTER TABLE `subscribtion`
  MODIFY `sub_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `unit_ads`
--
ALTER TABLE `unit_ads`
  MODIFY `ua_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `view`
--
ALTER TABLE `view`
  MODIFY `view_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `fk_app_account` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_roommate_req` FOREIGN KEY (`roommate_req_id`) REFERENCES `roommaterequest` (`roommate_req_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `facilities`
--
ALTER TABLE `facilities`
  ADD CONSTRAINT `fk_facilities_unit` FOREIGN KEY (`ua_id`) REFERENCES `unit_ads` (`ua_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_images_unit` FOREIGN KEY (`ua_id`) REFERENCES `unit_ads` (`ua_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `like_ibfk_1` FOREIGN KEY (`ua_id`) REFERENCES `unit_ads` (`ua_id`),
  ADD CONSTRAINT `like_ibfk_2` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_msg_receiver` FOREIGN KEY (`receiver_id`) REFERENCES `account` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_msg_sender` FOREIGN KEY (`sender_id`) REFERENCES `account` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package`
--
ALTER TABLE `package`
  ADD CONSTRAINT `fk_package_account` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review_account` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_review_unit` FOREIGN KEY (`ua_id`) REFERENCES `unit_ads` (`ua_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `roommaterequest`
--
ALTER TABLE `roommaterequest`
  ADD CONSTRAINT `acc_idFKK` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `ua_idFKKK` FOREIGN KEY (`ua_id`) REFERENCES `unit_ads` (`ua_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `subscribtion`
--
ALTER TABLE `subscribtion`
  ADD CONSTRAINT `fk_subscribtion_acc` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_subscribtion_pack` FOREIGN KEY (`pack_id`) REFERENCES `package` (`pack_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `unit_ads`
--
ALTER TABLE `unit_ads`
  ADD CONSTRAINT `fk_unitads_account` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `view`
--
ALTER TABLE `view`
  ADD CONSTRAINT `view_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`),
  ADD CONSTRAINT `view_ibfk_2` FOREIGN KEY (`ua_id`) REFERENCES `unit_ads` (`ua_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
