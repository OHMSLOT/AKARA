-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 02:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akara`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_pass`) VALUES
(1, 'admin', '12345'),
(14, 'admin1', '$2y$10$daM9/Fht4OOUd/iAVkyoy.4xWgrb7QVb1.czxJJDWwpKBioqm54l.');

-- --------------------------------------------------------

--
-- Table structure for table `booking_detail`
--

CREATE TABLE `booking_detail` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `nights` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `slip_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_detail`
--

INSERT INTO `booking_detail` (`detail_id`, `order_id`, `firstname`, `lastname`, `email`, `phone`, `room_id`, `room_name`, `checkin`, `checkout`, `nights`, `total_price`, `slip_image`, `created_at`) VALUES
(1, 1, 'สุชาพงศ์', 'กระถินทอง', 'ohmmho@gmail.com', '0923800013', 1, 'Superior Room', '2024-10-01', '2024-10-02', 1, 2500.00, NULL, '2024-09-30 06:39:48'),
(3, 7, 'eqda', 'qeq', 'ohmmho47@gmail.com', '0923800013', 3, 'Deluxe Room', '2024-10-10', '2024-10-11', 1, 3500.00, '6705740cd583c-37902.jpg', '2024-10-08 18:00:10'),
(4, 9, 't', 't', 't@gmail.com', '2323', 4, 'Triple Room', '2024-10-12', '2024-10-13', 1, 3000.00, '6705744a29763-37902.jpg', '2024-10-08 18:04:58'),
(5, 10, 'e', 'e', 'e@gmail.com', 'e', 1, 'Superior Room', '2024-10-10', '2024-10-11', 1, 2500.00, '670580c0becc6-37902.jpg', '2024-10-08 18:58:08'),
(6, 11, 'g', 'g', 'g@gmail.com', '2326', 4, 'Triple Room', '2024-10-09', '2024-10-10', 1, 3000.00, '6705928313de8-37902.jpg', '2024-10-08 20:13:55'),
(7, 12, 'f', 'f', 'f@gmail.com', '0456789', 1, 'Superior Room', '2024-10-10', '2024-10-11', 1, 2500.00, '6705b05ab0e25-37902.jpg', '2024-10-08 22:21:14'),
(8, 13, 'h', 'h', 'h@gmail.com', '23456789', 3, 'Deluxe Room', '2024-10-10', '2024-10-11', 1, 3500.00, '6705b09b41971-37902.jpg', '2024-10-08 22:22:19'),
(9, 14, 'j', 'j', 'j@gmail.com', '123456', 4, 'Triple Room', '2024-10-10', '2024-10-11', 1, 3000.00, '6705b0cf8d475-1.jpg', '2024-10-08 22:23:11'),
(10, 15, 'watcharaporn', 'singhopol', 'pang@gmail.com', '088888888', 3, 'Deluxe Room', '2024-10-10', '2024-10-11', 1, 3500.00, '6707ffb735940-37902.jpg', '2024-10-10 16:24:23'),
(11, 16, 'สุชาพงศ์', 'กระถินทอง', 'ohmmho@gmail.com', '0923800013', 4, 'Triple Room', '2024-10-11', '2024-10-12', 1, 3000.00, '670811cd4bc7a-37902.jpg', '2024-10-10 17:41:33'),
(12, 17, 'สุชาพงศ์', 'กระถินทอง', 'ohmmho47@gmail.com', '0923800013', 1, 'Superior Room', '2024-10-11', '2024-10-13', 2, 5000.00, '6708138668d30-37902.jpg', '2024-10-10 17:48:54'),
(13, 18, 't', 'tt', 'dd@gmail.com', '0923800013', 1, 'Superior Room', '2024-10-24', '2024-10-26', 2, 5000.00, '671a040844b24-image.png', '2024-10-24 08:23:36');

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `order_id` int(11) NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`order_id`, `order_number`, `user_id`, `order_date`, `status`, `total_amount`) VALUES
(1, 'ORDER_66fa47b416c21', 1, '2024-09-30 06:39:48', 'cancelled', 2500.00),
(3, 'ORDER_67056de0f2339', 1, '2024-10-08 17:37:36', 'cancelled', 3500.00),
(7, 'ORDER_6705732a37dea', 1, '2024-10-08 18:00:10', 'cancelled', 3500.00),
(9, 'ORDER_6705744a292bf', 1, '2024-10-08 18:04:58', 'cancelled', 3000.00),
(10, 'ORDER_670580c0be928', 1, '2024-10-08 18:58:08', 'confirmed', 2500.00),
(11, 'ORDER_67059283139f8', 1, '2024-10-08 20:13:55', 'cancelled', 3000.00),
(12, 'ORDER_6705b05ab0bb1', 1, '2024-10-08 22:21:14', 'cancelled', 2500.00),
(13, 'ORDER_6705b09b41616', 1, '2024-10-08 22:22:19', 'confirmed', 3500.00),
(14, 'ORDER_6705b0cf8d077', 1, '2024-10-08 22:23:11', 'cancelled', 3000.00),
(15, 'ORDER_6707ffb735682', 2, '2024-10-10 16:24:23', 'confirmed', 3500.00),
(16, 'ORDER_670811cd4b978', 2, '2024-10-10 17:41:33', 'confirmed', 3000.00),
(17, 'ORDER_67081386689de', 2, '2024-10-10 17:48:54', 'confirmed', 5000.00),
(18, 'ORDER_671a04084489a', 2, '2024-10-24 08:23:36', 'confirmed', 5000.00);

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(9, 'IMG55034.jpg'),
(10, 'IMG37559.jpg'),
(11, 'IMG79593.jpg'),
(12, 'IMG74802.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `gmap` varchar(150) NOT NULL,
  `pn1` bigint(20) NOT NULL,
  `pn2` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `ig` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`, `fb`, `ig`, `iframe`) VALUES
(1, '133 ถนน ราชภาคินัย ตำบลศรีภูมิ เมือง เชียงใหม่ 50200', 'https://maps.app.goo.gl/aaSXNsBuJxeqq6u16', 923800013, 923800013, 'reservation@thaiakara.com', 'https://www.facebook.com/thaiakarahotel/', 'https://www.instagram.com/thaiakara_hotel/', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7554.357305985881!2d98.989751!3d18.79019!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da3a98667fe3d5:0xfe635098d07b53d6!2sThai Akara - Lanna Boutique Hotel!5e0!3m2!1sth!2sth!4v1723475090613!5m2!1sth!2sth');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `name` varchar(50) NOT NULL,
  `time_s` time NOT NULL,
  `time_e` time NOT NULL,
  `date` date NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `image`, `name`, `time_s`, `time_e`, `date`, `description`, `status`) VALUES
(1, 'IMG18227.png', 'After party', '17:30:00', '22:30:00', '2024-08-31', '', 1),
(4, 'IMG46293.png', 'After party', '12:00:00', '13:00:00', '2024-08-30', 'dddd', 1),
(5, 'IMG86872.png', 'Title name', '12:00:00', '14:00:00', '2024-08-31', 'daaaaaaaaaaaaaa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(13, 'IMG51826.svg', 'LCD TV', ''),
(14, 'IMG64525.svg', 'Wifi', ''),
(15, 'IMG67029.svg', 'Security-door-lock', ''),
(16, 'IMG47422.svg', 'Air-conditioning', ''),
(17, 'IMG63178.svg', 'Refrigerator', '');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(7, 'bedroom'),
(8, 'balcony'),
(9, 'kitchen');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `name`) VALUES
(1, 'ROOM'),
(5, 'LOBBY');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `sr_no` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`sr_no`, `gallery_id`, `image`, `thumb`) VALUES
(9, 1, 'IMG77958.jpg', 1),
(11, 5, 'IMG59651.jpg', 1),
(17, 1, 'IMG73802.jpg', 0),
(18, 1, 'IMG60344.jpg', 0),
(19, 1, 'IMG87305.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_facilities`
--

CREATE TABLE `hotel_facilities` (
  `id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `time_s` time NOT NULL,
  `time_e` time NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel_facilities`
--

INSERT INTO `hotel_facilities` (`id`, `image`, `name`, `time_s`, `time_e`, `description`) VALUES
(6, 'IMG66193.jpg', 'FITNESS', '07:00:00', '20:00:00', 'Take time for exercise with a good atmosphere'),
(7, 'IMG44793.jpg', 'POOL BAR', '10:00:00', '19:00:00', 'The poolside bar serves snacks and light snacks so you can enjoy a more relaxing and relaxing atmosphere.'),
(8, 'IMG75633.jpg', 'RESTAURANT', '07:00:00', '14:00:00', 'Breakfast is served from 07.00 am. - 10.30 am. and Lunch open from 11.30 am. - 14.00 hrs. The restaurant serves buffet and A la carte.'),
(9, 'IMG94799.png', 'SWIMMING POOL', '09:00:00', '19:00:00', 'Swimming pool is a heated saltwater pool that is gentle for the skin Available for all ages.');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image_name`) VALUES
(61, '66bce9dd41da0.png'),
(62, '66bce9ec68a20.png'),
(63, '66bcea67e1f55.png'),
(64, '66bcea6c64a7f.png'),
(65, '66bcea72be64b.png');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(300) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`, `removed`) VALUES
(1, 'Superior Room', 30, 2500, 10, 2, 1, 'Relax in your Superior room that consists of teak plaster walls of ancient Lanna style, facilities and free wifi.', 1, 0),
(2, 'd', 22, 2222, 2, 2, 2, 'ddd', 1, 1),
(3, 'Deluxe Room', 30, 3500, 10, 3, 1, 'Relax in your Deluxe room with a large space and bed to reach a comfortable stay. The room  consists of teak plaster walls of ancient Lanna style, facilities and free wifi', 1, 0),
(4, 'Triple Room', 30, 3000, 10, 2, 1, 'Book your Triple room with three single beds that is suitable for relaxing with your family and friends.', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(115, 1, 13),
(116, 1, 14),
(117, 1, 15),
(118, 1, 16),
(119, 1, 17),
(120, 3, 13),
(121, 3, 14),
(122, 3, 15),
(123, 3, 16),
(124, 4, 13),
(125, 4, 14),
(126, 4, 15),
(127, 4, 16),
(128, 4, 17);

-- --------------------------------------------------------

--
-- Table structure for table `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(66, 1, 7),
(67, 1, 8),
(68, 3, 7),
(69, 3, 8),
(70, 4, 7),
(71, 4, 8),
(72, 4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
(12, 1, 'IMG41417.jpg', 0),
(13, 1, 'IMG17989.jpg', 0),
(14, 1, 'IMG88900.jpg', 1),
(15, 3, 'IMG68750.jpg', 1),
(16, 3, 'IMG12875.jpg', 0),
(17, 3, 'IMG91968.jpg', 0),
(18, 4, 'IMG83866.jpg', 1),
(19, 4, 'IMG20128.jpg', 0),
(20, 4, 'IMG71462.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(300) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'THAI AKARA LANNA', 'Address info', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expire` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `picture`, `address`, `pincode`, `date_of_birth`, `password`, `reset_token`, `token_expire`, `created_at`) VALUES
(1, 'slot', 'ohmmho47@gmail.com', '0923800013', '66fa8b3da0932.jpg', '2223', '223', '2222-02-02', '$2y$10$H/EUyxcqorBBRO.yVSypCOi.UNZ8pTafUNGFR01RfHvxckMewOUjS', 'bb6d832aa2a73b8ad90005fb79a5a7b4', '2024-09-30', '2024-09-24 03:14:35'),
(2, 'slottery', 'ohmmi3693@gmail.com', '2', 'IMG89899.jpeg', '2', '2', '2222-02-02', '$2y$10$5kKmIAKg1FvQTXnHLxEOMOdlAvaB9jqgPeBIOBg7U4vFQjobXhGOK', NULL, NULL, '2024-09-25 15:24:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `gallery_id` (`gallery_id`);

--
-- Indexes for table `hotel_facilities`
--
ALTER TABLE `hotel_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `facilities id` (`facilities_id`),
  ADD KEY `room id` (`room_id`);

--
-- Indexes for table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `features id` (`features_id`),
  ADD KEY `rm id` (`room_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `booking_detail`
--
ALTER TABLE `booking_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `hotel_facilities`
--
ALTER TABLE `hotel_facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD CONSTRAINT `booking_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `booking_order` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD CONSTRAINT `gallery_images_ibfk_1` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`);

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `rm id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
