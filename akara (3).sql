-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2024 at 09:30 PM
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
(2, 'admin', '$2y$10$rSF8cgQWviYNsj60CWlvHeHL7RIgOjkq8ZYcgAjBuaVeXwuLrVIMm'),
(7, 'admin', '$2y$10$HUjHMxfsqtXD6iWKmdK5yeBajfvp50ZizFqewG3vofNjoJG3nMJZO'),
(8, 'admin', '$2y$10$UBMzE/YFM8ReOXWkmOAlh.Ut0cBpcyUFmiW.QMMkWjYxBzFrjWRa.'),
(13, 'admin', '$2y$10$7w72TFeh9VUJ4T7sCM7EDOtkzluuHt.LiadxHOUM0DG5LjJ/n0Jhu');

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
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `image`, `name`, `time_s`, `time_e`, `date`, `description`) VALUES
(1, 'IMG18227.png', 'After party', '17:30:00', '22:30:00', '2024-08-31', 'ddddddddddddddddddddddddddddd'),
(4, 'IMG46293.png', 'After party', '12:00:00', '13:00:00', '2024-08-30', 'dddd'),
(5, 'IMG42731.png', 'After party', '12:00:00', '14:00:00', '2024-08-31', 'daaaaaaaaaaaaaa');

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
(2, 'IMG74879.jpg', 'fitness', '12:00:00', '18:00:00', 'ddddddddddddddddddddddd'),
(3, 'IMG19070.jpg', 'fitness', '09:00:00', '16:00:00', 'ddddddddddaaaaaaaaaaaaaaa');

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
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`) VALUES
(1, 'dddddd', 2, 222, 222, 2, 2, 'dddddddddd', 1);

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
(13, 1, 13),
(14, 1, 15),
(15, 1, 16),
(16, 1, 17);

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
(9, 1, 7),
(10, 1, 8),
(11, 1, 9);

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
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`sr_no`, `name`, `email`, `subject`, `message`, `date`, `seen`) VALUES
(19, 'dada', 'adad@thaiakara.com', 'daddaddddddddddddddd', 'da', '2024-08-17', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

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
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hotel_facilities`
--
ALTER TABLE `hotel_facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
