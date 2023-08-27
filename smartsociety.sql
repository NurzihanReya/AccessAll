-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2023 at 10:41 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartsociety`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `extra` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `user_id`, `service_id`, `phone_number`, `appointment_date`, `appointment_time`, `created_at`, `extra`) VALUES
(1, 1, 4, '01789456612', '2023-08-24', '10:05:00', '2023-08-22 23:11:41', ''),
(2, 1, 4, '01789456612', '2023-08-24', '10:05:00', '2023-08-22 23:16:00', ''),
(3, 1, 4, '01789456612', '2023-08-24', '10:05:00', '2023-08-22 23:16:07', ''),
(4, 1, 2, '01789456123', '2023-08-25', '15:08:00', '2023-08-22 23:16:25', ''),
(5, 1, 2, '01789456123', '2023-08-24', '05:04:00', '2023-08-22 23:20:17', ''),
(6, 1, 2, '01789456123', '2023-08-24', '04:08:00', '2023-08-22 23:28:05', ''),
(7, 1, 4, '018796541233', '2023-08-29', '01:04:00', '2023-08-22 23:30:51', ''),
(8, 1, 3, '01789654321', '2023-09-02', '06:04:00', '2023-08-22 23:33:08', ''),
(9, 1, 4, '01789456123', '2023-08-15', '04:05:00', '2023-08-23 02:32:17', ''),
(10, 1, 2, '01789456123', '2023-08-15', '04:00:00', '2023-08-23 02:50:29', ''),
(11, 1, 1, '01748002160', '2023-08-23', '10:32:00', '2023-08-23 04:32:57', ''),
(12, 1, 1, '01748002160', '2023-08-23', '11:10:00', '2023-08-23 05:10:23', ''),
(13, 1, 1, '01748002160', '2023-08-23', '11:10:00', '2023-08-23 05:13:50', ''),
(14, 1, 4, '01748002160', '2023-08-23', '11:56:00', '2023-08-23 05:56:33', ''),
(15, 1, 1, '01748002160', '2023-08-23', '12:01:00', '2023-08-23 06:01:49', ''),
(16, 5, 1, '01748002160', '2023-08-23', '22:26:00', '2023-08-23 16:26:25', ''),
(17, 5, 1, '01748002160', '2023-08-23', '22:42:00', '2023-08-23 16:42:59', ''),
(18, 5, 1, '011201286', '2001-12-12', '00:11:00', '2023-08-24 11:06:01', 'Abdullah'),
(19, 5, 4, '011202247', '2000-01-31', '12:12:00', '2023-08-24 11:12:36', 'Abdullah Al Mamun'),
(20, 5, 2, '11223344', '2011-11-11', '11:11:00', '2023-08-24 14:20:49', 'The thief stole my phone away'),
(21, 5, 2, '000111222', '2023-08-23', '12:12:00', '2023-08-26 17:09:44', 'Burglary');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `forum_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `media_type` enum('none','image','video') NOT NULL DEFAULT 'none',
  `media_url` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `forum_id`, `user_name`, `comment`, `media_type`, `media_url`, `timestamp`) VALUES
(12, 4, 'humayen', 'Yes I also saw this problem ', 'none', '', '2023-08-25 06:06:46');

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `forum_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `media_type` enum('none','image','video') NOT NULL,
  `media_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`forum_id`, `user_id`, `title`, `description`, `media_type`, `media_url`, `created_at`) VALUES
(4, 6, 'Road broken', 'The road in front of my home is broken ', 'image', 'uploads/1.png', '2023-08-25 06:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `o_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `bin` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `service_type` varchar(50) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `transaction_number` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`o_id`, `name`, `bin`, `address`, `city`, `phone_number`, `service_type`, `payment_method`, `transaction_number`, `user_id`, `status`, `description`, `image_url`) VALUES
(1, 'LabAid', '123456', 'planners tower (15th floor), 13/a, sonargaon road, 1205', 'Dhaka', '01713333337', 'hospital', 'bkash', 'dsaf7390', 2, 1, 'Labaid Specialized Hospital, a concern of Labaid Group is the only multi-disciplinary super-specialty tertiary care hospital in Bangladesh, confidently providing comprehensive health care with the latest medical, surgical and diagnostic facilities. These services are provided by expert medical professionals, skilled nurses and technologists using state-of-the-art technology. Labaid Specialized Hospitalhas all the characteristics of a world-class hospital with wide range of services and specialis', 'uploads/22_big.jpg'),
(2, 'United Group', '432709', 'House No. 44, Road No. 3/a, Dhanmondi, 1210', 'Dhaka', '01766663221', 'hospital', 'nagad', 'daskjfh98ewrrrr', 2, 1, 'United Hospital Gulshan Provides High-Quality Private Medical Service in 24 Hours in Dhaka. The Hospital Managing Director and CEO is Mohammad Faizur Rahman. This Hospital was founded in 1980s. ', 'uploads/United Hospital Gulshan.png'),
(10, 'Vatara Police Station', '729345', 'road # 1, sector - 5, uttara model town, 1229', 'Dhaka', '01824737291', 'police station', 'nagad', 'adsfjkh2387', 3, 1, 'Vatara Thana is an upscale thana of Dhaka city, the capital of Bangladesh. Pragoti Sarani falls under Vatara Thana. Its areas include Sayeed Nagar, Basundhara Residential Area, Vatara, Solmaid, Nurerchala, Khilbarirtek, Kalachandpur, and Kuril.', 'uploads/istockphoto-1263126159-612x612.jpg'),
(11, 'Dhanmondi Fire Station', '039284', 'house #10, road #15 (new), dhanmondi, 1209', 'Dhaka', '01717128923', 'fire service', 'nagad', 'w87kjads1', 4, 1, 'At the Fire Service, we are dedicated to safeguarding lives, property, and the environment from the devastating effects of fires and emergencies. With a strong commitment to public safety, we are your trusted partner in times of crisis.', 'uploads/4c7575631e9259f1e1ce4e666a1cd640.png'),
(17, 'IMS', 'ims101', '221BBakerStreet', 'London', '666', 'police', 'rocket', '3000b', 2, 1, 'IMS (International Media Support) pushes for quality journalism, challenges repressive laws and keeps media workers of all genders safe, so that they can do their jobs. Through alliances and innovation, we help free, independent media contribute to positive change and better societies.', 'uploads/imsuc.jpg'),
(26, 'a', 'a', 'aa', 'a', '4', 'hospital', 'bkash', 'a', 4, -1, 'a', 'uploads/1.png');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `r_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `r_time` datetime NOT NULL,
  `flag` int(11) NOT NULL,
  `u_id` varchar(100) NOT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`r_id`, `type`, `r_time`, `flag`, `u_id`, `s_id`) VALUES
(1, 'fire', '2023-08-26 23:08:09', 0, 'Reya', 1),
(2, 'fire', '2023-08-27 02:23:09', 0, 'Reya', 2),
(3, 'crime', '2023-08-27 02:26:30', 0, 'Reya', 2),
(4, 'crime', '2023-08-27 02:29:52', 0, 'Reya', 2),
(5, 'crime', '0000-00-00 00:00:00', 0, 'Reya', 2),
(6, 'crime', '2023-08-27 02:32:30', 0, 'Reya', 2),
(7, 'accident', '2023-08-27 02:37:41', 0, 'Reya', 2),
(8, 'fire', '2023-08-27 02:37:45', 0, 'Reya', 2),
(9, 'crime', '2023-08-27 02:37:48', 0, 'Reya', 2);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `s_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`s_id`, `o_id`, `service_name`, `description`, `image_url`) VALUES
(1, 1, 'Hospital', 'Labaid Specialized Hospital, a concern of Labaid Group is the only multi-disciplinary super-specialty tertiary care hospital in Bangladesh, confidently providing comprehensive health care with the latest medical, surgical and diagnostic facilities. These services are provided by expert medical professionals, skilled nurses and technologists using state-of-the-art technology.\n\nLabaid Specialized Hospitalhas all the characteristics of a world-class hospital with wide range of services and specialists, equipments and technology, ambience and service quality. The hospital is a showcase of synergy of medical technology and advances in IT through paperless medical records. The skilled nurses, technologists and administrators of Labaid Specialized Hospital, aided by state-of-the-art equipments, provide a congenial infrastructure for the medical professionals in providing healthcare of international standards.', 'https://plus.unsplash.com/premium_photo-1681995326134-cdc947934015?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80'),
(2, 10, 'Police Station', 'Vatara Thana is an upscale thana of Dhaka city, the capital of Bangladesh. Pragoti Sarani falls under Vatara Thana. Its areas include Sayeed Nagar, Basundhara Residential Area, Vatara, Solmaid, Nurerchala, Khilbarirtek, Kalachandpur, and Kuril.', 'https://www.gilbertaz.gov/home/showpublishedimage/20881/637659340028900000'),
(3, 11, 'Fire Service', 'At the Fire Service, we are dedicated to safeguarding lives, property, and the environment from the devastating effects of fires and emergencies. With a strong commitment to public safety, we are your trusted partner in times of crisis.', 'https://upload.wikimedia.org/wikipedia/commons/1/17/Bangladesh_Fire_Service_and_Civil_Defence_SPV-SinoTruk_320_water_tender._%2831624338466%29.jpg'),
(4, 2, 'Hospital', 'United Hospital Gulshan Provides High-Quality Private Medical Service in 24 Hours in Dhaka. The Hospital Managing Director and CEO is Mohammad Faizur Rahman. This Hospital was founded in 1980s. ', 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiGH8H7q52AXc7cPb9diDr8PeyzDkfNZLNDSuhjAwvHT7bPNoQA0cqF_XlDRhcuXlXiry9OLuSlJGxQJ-RyaHhMXsxvtSAXkGNO9XRdhHMzcoHTPEF5yUKc5jYSZb2mXpj2cUQcenhXvfIJ4oSfrrDT_i3KwT3jQYnfwU_-rvcYoc6vfhs6T49V3t-6/s926/Unit');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `password` int(11) NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `location` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `useremail`, `name`, `user_type_id`, `password`, `dt`, `location`) VALUES
(1, 'nurzihanfatema.reya@gmail.com', 'Nurzihan Reya', 0, 1234, '2023-08-23 11:07:33', ''),
(2, 'unitedgroup@gmail.com', 'United Group', 1, 1234, '2023-08-22 21:33:09', ''),
(3, 'vatarapolice@gmail.com', 'Vatara Police Station', 1, 1234, '2023-08-22 21:35:26', ''),
(4, 'dhanmondifireservice@gmail.com', 'Dhanmondi Fire Service', 1, 1234, '2023-08-22 21:36:11', ''),
(5, 'reya@gmail.com', 'Reya', 2, 1234, '2023-08-24 20:41:43', 'banani'),
(6, 'humayen@gmail.com', 'humayen', 2, 1234, '2023-08-24 20:41:31', 'banani');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `forum_id` (`forum_id`);

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`forum_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `FK_organizations` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `fk_services` (`o_id`);
ALTER TABLE `services` ADD FULLTEXT KEY `service_name` (`service_name`,`description`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_useremail` (`useremail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `forum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`s_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forums` (`forum_id`);

--
-- Constraints for table `forums`
--
ALTER TABLE `forums`
  ADD CONSTRAINT `forums_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `organizations`
--
ALTER TABLE `organizations`
  ADD CONSTRAINT `FK_organizations` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `fk_services` FOREIGN KEY (`o_id`) REFERENCES `organizations` (`o_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
