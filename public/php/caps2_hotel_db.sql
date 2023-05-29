-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2023 at 05:07 PM
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
-- Database: `caps2_hotel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `amenities_id` int(11) NOT NULL,
  `amenities_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`amenities_id`, `amenities_name`) VALUES
(1, 'Free WIFI'),
(2, 'HD TV'),
(3, 'Pool Access'),
(4, 'Fully Air-conditioned');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_id` int(10) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `check_in` varchar(100) DEFAULT NULL,
  `check_out` varchar(100) NOT NULL,
  `total_price` int(10) NOT NULL,
  `remaining_price` int(10) NOT NULL,
  `payment_status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `customer_id`, `room_type_id`, `room_id`, `booking_date`, `check_in`, `check_out`, `total_price`, `remaining_price`, `payment_status`) VALUES
(1, 1, 9, 0, '2023-05-29 08:27:03', '2023-05-29', '2023-05-30', 21000, 0, '0'),
(2, 2, 2, 0, '2023-05-29 14:51:20', '2023-06-01', '2023-06-03', 3000, 0, '0'),
(3, 3, 7, 0, '2023-05-29 14:53:14', '2023-06-03', '2023-06-04', 3600, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `id` int(11) NOT NULL,
  `complainant_name` varchar(100) NOT NULL,
  `complaint_type` varchar(100) NOT NULL,
  `complaint` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `resolve_status` tinyint(1) NOT NULL,
  `resolve_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `budget` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`id`, `complainant_name`, `complaint_type`, `complaint`, `created_at`, `resolve_status`, `resolve_date`, `budget`) VALUES
(1, 'Janice Alexander\n', 'Room Windows', 'Doesnot operate properly', '2020-07-16 06:51:24', 1, '2020-07-17 06:51:58', 3600),
(2, 'Robert Peter\n', 'Air Conditioner', 'Sensor Problems', '2020-10-01 06:51:44', 1, '2020-10-03 07:06:02', 7950),
(3, 'Jason J Pirkle\n', 'Bad Smells', 'Some odd smells around room areas', '2018-04-01 07:01:17', 1, '2018-04-01 07:01:52', 500),
(5, 'Will Williams', 'Faulty Electronics', 'Due to some weird reasons, the electronics are not working as it should; some voltage problems too - M-135', '2021-04-09 08:38:19', 1, '2021-04-09 08:38:39', 2500);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `contact_no` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_card_type_id` int(10) NOT NULL,
  `id_card_no` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `contact_no`, `email`, `id_card_type_id`, `id_card_no`, `address`) VALUES
(2, 'John Doe', 1234567890, 'johndoe@example.com', 0, '0', '123 Main St, City, Country'),
(3, 'Jane Smith', 9876543210, 'janesmith@example.com', 0, '0', '456 Oak Ave, Town, Country');

-- --------------------------------------------------------

--
-- Table structure for table `emp_history`
--

CREATE TABLE `emp_history` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `from_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `to_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `emp_history`
--

INSERT INTO `emp_history` (`id`, `emp_id`, `shift_id`, `from_date`, `to_date`, `created_at`) VALUES
(1, 1, 1, '2017-11-13 05:39:06', '2017-11-15 02:22:26', '2017-11-13 05:39:06'),
(2, 2, 3, '2017-11-13 05:39:39', '2017-11-15 02:22:43', '2017-11-13 05:39:39'),
(3, 3, 1, '2017-11-13 05:40:18', '2017-11-15 02:22:49', '2017-11-13 05:40:18'),
(4, 4, 1, '2017-11-13 05:40:56', '2017-11-15 02:22:35', '2017-11-13 05:40:56'),
(5, 5, 1, '2017-11-13 05:41:31', NULL, '2017-11-13 05:41:31'),
(6, 6, 3, '2017-11-13 05:42:03', NULL, '2017-11-13 05:42:03'),
(7, 7, 4, '2017-11-13 05:42:35', '2017-11-18 02:35:02', '2017-11-13 05:42:35'),
(8, 8, 3, '2017-11-13 05:43:13', '2017-11-18 02:32:26', '2017-11-13 05:43:13'),
(9, 9, 2, '2017-11-13 05:43:49', NULL, '2017-11-13 05:43:49'),
(10, 10, 1, '2017-11-13 06:30:45', '2017-11-18 02:34:28', '2017-11-13 06:30:45'),
(11, 1, 2, '2017-11-15 06:52:26', '2017-11-17 02:23:05', '2017-11-15 06:52:26'),
(12, 4, 3, '2017-11-15 06:52:35', NULL, '2017-11-15 06:52:35'),
(13, 2, 3, '2017-11-15 06:52:43', NULL, '2017-11-15 06:52:43'),
(14, 3, 3, '2017-11-15 06:52:49', NULL, '2017-11-15 06:52:49'),
(15, 1, 3, '2017-11-17 06:53:05', NULL, '2017-11-17 06:53:05'),
(16, 8, 1, '2017-11-18 07:02:26', NULL, '2017-11-18 07:02:26'),
(17, 11, 2, '2017-11-18 07:04:03', NULL, '2017-11-18 07:04:03'),
(18, 10, 2, '2017-11-18 07:04:28', NULL, '2017-11-18 07:04:28'),
(19, 7, 2, '2017-11-18 07:05:02', NULL, '2017-11-18 07:05:02'),
(20, 12, 1, '2021-04-08 17:54:22', NULL, '2021-04-08 17:54:22'),
(21, 13, 2, '2021-04-09 08:35:27', NULL, '2021-04-09 08:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `id_card_type`
--

CREATE TABLE `id_card_type` (
  `id_card_type_id` int(10) NOT NULL,
  `id_card_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `id_card_type`
--

INSERT INTO `id_card_type` (`id_card_type_id`, `id_card_type`) VALUES
(1, 'National Identity Card'),
(2, 'Voter Id Card'),
(3, 'Pan Card'),
(4, 'Driving License');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(10) NOT NULL,
  `room_type_id` int(10) NOT NULL,
  `room_no` varchar(10) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `check_in_status` tinyint(1) NOT NULL,
  `check_out_status` tinyint(1) NOT NULL,
  `deleteStatus` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_type_id`, `room_no`, `status`, `check_in_status`, `check_out_status`, `deleteStatus`) VALUES
(1, 2, 'A-101', NULL, 0, 0, 1),
(2, 2, 'A-102', 1, 1, 1, 0),
(3, 3, 'A-103', NULL, 0, 0, 0),
(4, 4, 'A-104', NULL, 0, 0, 0),
(5, 1, 'B-101', 1, 0, 0, 0),
(6, 2, 'B-102', NULL, 0, 0, 1),
(7, 3, 'B-103', 1, 0, 0, 0),
(8, 4, 'B-104', NULL, 0, 0, 1),
(9, 1, 'C-101', 1, 0, 0, 0),
(10, 2, 'C-102', NULL, 0, 0, 0),
(11, 3, 'C-103', NULL, 0, 0, 1),
(12, 4, 'C-104', NULL, 0, 0, 0),
(13, 4, 'D-101', NULL, 0, 1, 1),
(14, 5, 'K-699', 1, 1, 0, 0),
(15, 5, 'K-799', NULL, 0, 0, 0),
(16, 5, 'K-899', NULL, 0, 0, 0),
(17, 6, 'M-333', NULL, 0, 0, 0),
(18, 6, 'M-444', NULL, 0, 0, 0),
(19, 6, 'M-555', NULL, 0, 0, 0),
(20, 9, 'P-696', NULL, 0, 0, 0),
(21, 10, 'M-966', NULL, 0, 0, 0),
(22, 10, 'M-869', NULL, 0, 1, 0),
(23, 8, 'Z-666', NULL, 0, 0, 0),
(24, 7, 'X-969', NULL, 0, 0, 0),
(25, 8, 'Z-111', NULL, 0, 0, 0),
(26, 6, 'M-135', NULL, 0, 0, 1),
(27, 1, 'S-101', NULL, 0, 0, 1),
(28, 11, 'E-102', 1, 0, 0, 1),
(29, 11, 'S-101', 1, 0, 0, 1),
(30, 11, '2', 1, 0, 0, 1),
(31, 11, '2', 1, 0, 0, 1),
(32, 11, 'E-101', 1, 0, 0, 1),
(33, 11, 'E-101', 1, 0, 0, 1),
(34, 1, '1', 1, 0, 0, 1),
(35, 2, '1', 1, 0, 0, 1),
(36, 1, 'S-102', 0, 0, 0, 1),
(37, 1, 'S-103', 0, 0, 0, 1),
(38, 1, 'S-104', 0, 0, 0, 1),
(39, 1, 'S-105', 0, 0, 0, 1),
(40, 1, 'S-106', 0, 0, 0, 1),
(41, 1, 'S-107', 0, 0, 0, 1),
(42, 1, 'S-108', 0, 0, 0, 1),
(43, 1, 'S-109', 0, 0, 0, 1),
(44, 1, 'S-110', 0, 0, 0, 1),
(45, 1, 'S-111', NULL, 0, 0, 1),
(46, 1, 'E-112', 0, 0, 0, 1),
(47, 1, '', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `room_type_id` int(10) NOT NULL,
  `room_type` varchar(100) NOT NULL,
  `room_type_desc` varchar(250) NOT NULL,
  `price` int(10) NOT NULL,
  `max_person` int(10) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`room_type_id`, `room_type`, `room_type_desc`, `price`, `max_person`, `image`) VALUES
(1, 'Single', 'Good for single travelers', 1000, 1, 'single.jpg'),
(2, 'Double', 'Ideal for couples or two travelers', 1500, 2, 'double.jpg'),
(3, 'Triple', 'Perfect for a group of three travelers', 2000, 3, 'triple.jpg'),
(4, 'Family', 'Spacious room suitable for a family', 3000, 2, 'family.jpg'),
(5, 'King Sized', 'King Sized', 5500, 4, 'king.jpg'),
(6, 'Master Suite', 'Exquisite suite with multiple rooms and amenities', 6500, 6, 'Master Suite.jpg'),
(7, 'Mini-Suite', 'Compact suite with comfortable accommodations', 3600, 3, 'mini-suite.jpg'),
(8, 'Connecting Rooms', 'Two rooms with a connecting door, suitable for larger groups or families', 8000, 6, 'connectingroom.jpg'),
(9, 'Presidential Suite', 'The ultimate luxurious suite with exclusive amenities', 21000, 4, 'presidential.jfif'),
(10, 'Murphy Room', 'Room with a pull-down Murphy bed, perfect for smaller groups', 6900, 3, 'murphy-bed.jpg'),
(11, 'Economy', 'Basic and affordable room option', 700, 2, 'ac3.jpg'),
(14, 'Premium', 'High-quality room with added amenities', 800, 2, 'nonac3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `room_type_amenities`
--

CREATE TABLE `room_type_amenities` (
  `ra_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `amenities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_type_amenities`
--

INSERT INTO `room_type_amenities` (`ra_id`, `room_type_id`, `amenities_id`) VALUES
(4, 2, 1),
(5, 2, 2),
(6, 2, 3),
(7, 2, 4),
(8, 3, 1),
(9, 3, 2),
(10, 3, 3),
(11, 3, 4),
(12, 1, 1),
(13, 1, 2),
(14, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `shift_id` int(10) NOT NULL,
  `shift` varchar(100) NOT NULL,
  `shift_timing` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`shift_id`, `shift`, `shift_timing`) VALUES
(1, 'Morning', '5:00 AM - 10:00 AM'),
(2, 'Day', '10:00 AM - 4:00PM'),
(3, 'Evening', '4:00 PM - 10:00 PM'),
(4, 'Night', '10:00PM - 5:00AM');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `staff_type_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `id_card_type` int(11) NOT NULL,
  `id_card_no` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_no` bigint(20) NOT NULL,
  `salary` bigint(20) NOT NULL,
  `joining_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`emp_id`, `emp_name`, `staff_type_id`, `shift_id`, `id_card_type`, `id_card_no`, `address`, `contact_no`, `salary`, `joining_date`, `updated_at`) VALUES
(1, 'Joseph Bow', 1, 3, 1, '422510099122', '4516 Spruce Drive\n', 3479454777, 21000, '2020-11-13 05:39:06', '2021-04-08 17:36:16'),
(2, 'Cleta Landon', 3, 3, 1, '422510099122', '2555 Hillside Drive', 1479994500, 12500, '2021-04-07 20:21:00', '2021-04-08 17:36:23'),
(3, 'Gerald White', 2, 3, 1, '422510099122', 'Ap #897-1459 Quam Avenue', 976543111, 25000, '2019-11-13 05:40:18', '2021-04-08 17:36:27'),
(4, 'Frank J. Welch', 2, 3, 2, '0', '2272 Sun Valley Road\n', 7451112450, 31000, '2017-11-13 05:40:55', '2021-04-08 17:36:33'),
(5, 'Gary Johnson', 4, 1, 1, '12345341212', '458 Chandler Drive\n', 4578884500, 28000, '2018-11-13 05:41:31', '2021-04-08 17:36:42'),
(6, 'Miguel M. Miller', 3, 3, 3, '0', 'Ap #897-1459 Quam Avenue', 8520000000, 40000, '2017-11-13 05:42:03', '2021-04-08 17:36:47'),
(7, 'Clement L. Brainerd\n', 2, 2, 1, '422510099122', '4381 Gateway Road\n', 4547778450, 40000, '2017-11-13 05:42:35', '2021-04-08 17:36:51'),
(8, 'Randall Leclair', 1, 1, 4, '0', '1724 Round Table Drive\n', 1457845554, 15000, '2020-11-13 05:43:13', '2021-04-08 17:36:56'),
(9, 'Fredrick A. Wile', 3, 2, 4, '0', '3431 Joyce Street\n', 7145554500, 20000, '2020-11-13 05:43:49', '2021-04-08 17:36:59'),
(10, 'Brent Tatro', 5, 2, 1, '422510099122', '1616 Coventry Court\n', 3475468569, 24000, '2019-11-13 06:30:45', '2021-04-08 17:37:07'),
(11, 'Charles Miller', 3, 2, 1, '0', '382 Byers Lane\n', 7869696969, 20000, '2019-11-18 07:04:03', '2021-04-08 17:37:10'),
(12, 'John Doe', 2, 1, 4, 'AD69 14579500002', '3714  Duffy Street', 1475550036, 13500, '2021-04-08 17:54:22', '2021-04-08 17:54:22'),
(13, 'Brent Dixon', 9, 2, 1, '457854555012', '1821 Harry Place', 7457778560, 65500, '2021-04-09 08:35:27', '2021-04-09 08:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `staff_type`
--

CREATE TABLE `staff_type` (
  `staff_type_id` int(10) NOT NULL,
  `staff_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staff_type`
--

INSERT INTO `staff_type` (`staff_type_id`, `staff_type`) VALUES
(1, 'Manager'),
(2, 'Housekeeping Manager'),
(3, 'Front Desk Receptionist'),
(4, 'Cheif'),
(5, 'Waiter'),
(6, 'Room Attendant'),
(7, 'Concierge'),
(8, 'Hotel Maintenance Engineer'),
(9, 'Hotel Sales Manager');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'user1', 'user1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`amenities_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `customer_id_type` (`id_card_type_id`);

--
-- Indexes for table `emp_history`
--
ALTER TABLE `emp_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `shift_id` (`shift_id`);

--
-- Indexes for table `id_card_type`
--
ALTER TABLE `id_card_type`
  ADD PRIMARY KEY (`id_card_type_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`room_type_id`);

--
-- Indexes for table `room_type_amenities`
--
ALTER TABLE `room_type_amenities`
  ADD PRIMARY KEY (`ra_id`),
  ADD KEY `amenities_id` (`amenities_id`),
  ADD KEY `room_type_id` (`room_type_id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`shift_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `id_card_type` (`id_card_type`),
  ADD KEY `shift_id` (`shift_id`),
  ADD KEY `staff_type_id` (`staff_type_id`);

--
-- Indexes for table `staff_type`
--
ALTER TABLE `staff_type`
  ADD PRIMARY KEY (`staff_type_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `amenities_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_history`
--
ALTER TABLE `emp_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `id_card_type`
--
ALTER TABLE `id_card_type`
  MODIFY `id_card_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `room_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `room_type_amenities`
--
ALTER TABLE `room_type_amenities`
  MODIFY `ra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `shift_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `staff_type`
--
ALTER TABLE `staff_type`
  MODIFY `staff_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emp_history`
--
ALTER TABLE `emp_history`
  ADD CONSTRAINT `emp_history_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `staff` (`emp_id`),
  ADD CONSTRAINT `emp_history_ibfk_2` FOREIGN KEY (`shift_id`) REFERENCES `shift` (`shift_id`);

--
-- Constraints for table `room_type_amenities`
--
ALTER TABLE `room_type_amenities`
  ADD CONSTRAINT `room_type_amenities_ibfk_1` FOREIGN KEY (`amenities_id`) REFERENCES `amenities` (`amenities_id`),
  ADD CONSTRAINT `room_type_amenities_ibfk_2` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`room_type_id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`id_card_type`) REFERENCES `id_card_type` (`id_card_type_id`),
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`shift_id`) REFERENCES `shift` (`shift_id`),
  ADD CONSTRAINT `staff_ibfk_3` FOREIGN KEY (`staff_type_id`) REFERENCES `staff_type` (`staff_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
