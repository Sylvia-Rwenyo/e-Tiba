-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2023 at 02:03 PM
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
-- Database: `cera`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointmentID` int(8) NOT NULL,
  `patientID` int(8) NOT NULL,
  `doctorID` int(8) NOT NULL,
  `appointmentDate` varchar(10) DEFAULT NULL,
  `appointmentTime` varchar(8) DEFAULT NULL,
  `pConfirmed` tinyint(1) NOT NULL,
  `cancelled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointmentID`, `patientID`, `doctorID`, `appointmentDate`, `appointmentTime`, `pConfirmed`, `cancelled`) VALUES
(1, 6, 1, '2023-08-11', '10:30', 0, 0),
(2, 11, 2, '2023-07-28', '16:30', 0, 0),
(3, 2, 0, '16:30', '11', 0, 0),
(4, 2, 0, '16:30', '2', 0, 0),
(5, 2, 0, '16:00', '11', 0, 0),
(6, 2, 0, '12:30', '11', 0, 0),
(7, 2, 0, '16:00', '11', 0, 0),
(8, 2, 0, '16:30', '11', 0, 0),
(9, 11, 2, '2023-07-28', '16:00', 0, 0),
(16, 4, 4, '2023-07-29', '11:00', 0, 0),
(17, 4, 4, '2023-07-30', '16:00', 0, 0),
(18, 4, 4, '2023-07-29', '11:30', 0, 0),
(19, 0, 4, '2023-08-04', '16:30', 0, 0),
(20, 0, 4, '2023-08-04', '16:30', 0, 0),
(21, 4, 4, '2023-08-03', '16:00', 0, 0),
(22, 4, 4, '2023-08-03', '16:30', 0, 0),
(23, 12, 4, '2023-08-04', '16:00', 0, 0),
(24, 12, 12, '2023-08-03', '15:00', 0, 0),
(25, 12, 12, '2023-08-04', '14:00', 0, 0),
(26, 12, 12, '2023-08-04', '14:00', 0, 0),
(27, 12, 12, '2023-08-03', '13:30', 0, 0),
(28, 12, 12, '2023-08-04', '13:00', 0, 0),
(29, 12, 12, '2023-08-05', '11:30', 0, 0),
(30, 13, 4, '2023-08-10', '15:30', 1, 0),
(32, 17, 3, '2023-08-10', '15:30', 0, 0),
(33, 17, 3, '2023-09-02', '14:30', 1, 0),
(34, 22, 3, '2023-09-01', '14:00', 1, 1),
(35, 17, 3, '2023-09-02', '15:00', 1, 0),
(36, 13, 3, '2023-09-01', '14:30', 1, 0),
(37, 14, 6, '2023-09-01', '15:00', 1, 1),
(38, 22, 6, '2023-09-02', '14:30', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `sender_class` varchar(20) NOT NULL,
  `chat_identity` varchar(200) NOT NULL,
  `sent_from_id` int(11) NOT NULL,
  `emailAddress` varchar(40) NOT NULL,
  `sent_to_id` int(11) NOT NULL,
  `sent_to` varchar(40) NOT NULL,
  `readStatus` varchar(10) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `sender_class`, `chat_identity`, `sent_from_id`, `emailAddress`, `sent_to_id`, `sent_to`, `readStatus`, `message`) VALUES
(29, 'patient', 'fredric.ngugi@yahoo.com_646', 6, '646', 1, 'fredric.ngugi@yahoo.com', 'unread', '+zjPeS04/RcQJKdEnB9mHW594izow8tW1z9dx6Aa82h3Dvmv8OCqaiF3Fw9gN4y7');

-- --------------------------------------------------------

--
-- Table structure for table `chat_backup`
--

CREATE TABLE `chat_backup` (
  `id` int(11) NOT NULL,
  `sender_class` varchar(20) NOT NULL,
  `chat_identity` varchar(200) NOT NULL,
  `sent_from_id` int(11) NOT NULL,
  `emailAddress` varchar(40) NOT NULL,
  `sent_to_id` int(11) NOT NULL,
  `sent_to` varchar(40) NOT NULL,
  `readStatus` varchar(10) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dosage`
--

CREATE TABLE `dosage` (
  `dosageId` int(11) NOT NULL,
  `dosageName` varchar(400) NOT NULL,
  `patientName` varchar(40) NOT NULL,
  `patientEmail` varchar(100) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `attending_doctor_name` varchar(40) NOT NULL,
  `attending_doctor_id` int(11) NOT NULL,
  `attending_doctor_email` varchar(100) NOT NULL,
  `tablets` int(11) NOT NULL,
  `number_of_days` int(11) NOT NULL,
  `times_a_day` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosage`
--

INSERT INTO `dosage` (`dosageId`, `dosageName`, `patientName`, `patientEmail`, `patient_id`, `attending_doctor_name`, `attending_doctor_id`, `attending_doctor_email`, `tablets`, `number_of_days`, `times_a_day`) VALUES
(2, 'omeprazol', 'khj', '646', 6, 'Morris', 2, 'morris@gmail.com', 3, 5, 1),
(3, 'omeprazine', 'khj', '646', 6, 'Morris', 2, 'morris@gmail.com', 3, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `patientmedlog`
--

CREATE TABLE `patientmedlog` (
  `userID` int(10) NOT NULL,
  `medName` varchar(100) NOT NULL,
  `medTime` datetime NOT NULL,
  `entryID` int(20) NOT NULL,
  `recordDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patientsexerciselog`
--

CREATE TABLE `patientsexerciselog` (
  `recordID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `recordDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `exerciseType` varchar(40) NOT NULL,
  `exerciseDuration` int(4) NOT NULL,
  `exerciseTime` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patientsexerciselog`
--

INSERT INTO `patientsexerciselog` (`recordID`, `userID`, `recordDate`, `exerciseType`, `exerciseDuration`, `exerciseTime`) VALUES
(0, 28, '2023-08-29 12:31:35', 'Aerobics', 10, '10:30'),
(0, 28, '2023-08-29 12:31:44', 'Aerobics', 10, '10:30');

-- --------------------------------------------------------

--
-- Table structure for table `patientsleeplog`
--

CREATE TABLE `patientsleeplog` (
  `userID` int(10) NOT NULL,
  `sleepTime` int(2) NOT NULL,
  `entryID` int(20) NOT NULL,
  `recordDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patientsleeplog`
--

INSERT INTO `patientsleeplog` (`userID`, `sleepTime`, `entryID`, `recordDate`) VALUES
(6, 3600, 1, '2023-06-23 14:31:39'),
(6, 3600, 2, '2023-06-23 14:31:56'),
(6, 1, 3, '2023-06-23 14:32:12'),
(6, 1, 4, '2023-06-23 14:35:14'),
(12, 3, 5, '2023-07-04 15:54:33'),
(12, 18, 7, '2023-07-05 15:29:57'),
(29, 11, 8, '2023-08-28 08:32:43'),
(29, 7, 9, '2023-08-28 08:34:34'),
(29, 7, 10, '2023-08-28 08:34:54'),
(28, 15, 11, '2023-08-29 12:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `patientsmeallog`
--

CREATE TABLE `patientsmeallog` (
  `userID` int(10) NOT NULL,
  `mealName` varchar(100) NOT NULL,
  `mealTime` varchar(20) NOT NULL,
  `entryID` int(20) NOT NULL,
  `recordDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patientsmeallog`
--

INSERT INTO `patientsmeallog` (`userID`, `mealName`, `mealTime`, `entryID`, `recordDate`) VALUES
(6, 'food1', '07:50:00', 1, '2023-08-21'),
(6, 'food 2', '12:50:00', 2, '2023-08-21'),
(6, 'food 1', '08:00:00', 3, '2023-08-22'),
(6, 'food 2', '12:00:00', 4, '2023-08-22'),
(6, 'food 3', '22:00:00', 5, '2023-08-22');

-- --------------------------------------------------------

--
-- Table structure for table `regdoctors`
--

CREATE TABLE `regdoctors` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `emailAddress` varchar(100) NOT NULL,
  `institution` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `specialty` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `profilePhoto` blob NOT NULL,
  `phoneNumber` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regdoctors`
--

INSERT INTO `regdoctors` (`id`, `firstName`, `lastName`, `emailAddress`, `institution`, `password`, `specialty`, `address`, `age`, `gender`, `profilePhoto`, `phoneNumber`) VALUES
(1, 'Fredrick', 'Kamau', 'fredric.ngugi@yahoo.com', 'none', 'er324', '', '', 23, 'Female', '', 0),
(3, 'Fredrick', 'Kamau', 'fredric.ngu@yahoo.com', 'New Hospital', '123', '', '', 34, 'Male', '', 787689899),
(4, 'adhfkj', 'jadfhds', '', 'Hospitali', '', 'Condition C', '34434', 0, 'Female', '', 2147483647),
(5, 'adhfkj', 'jadfhds', '', 'Hospitali', '', 'Condition C', '34434', 0, 'Female', '', 2147483647),
(6, 'Daktary', 'Daktary', 'Daktary@Daktary.com', 'New Hospital', 'Daktary', 'Condition B', '34534', 0, 'Female', '', 732645334);

-- --------------------------------------------------------

--
-- Table structure for table `reginstitutions`
--

CREATE TABLE `reginstitutions` (
  `id` int(11) NOT NULL,
  `institutionName` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `emailAddress` varchar(100) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `illnesses` varchar(200) NOT NULL,
  `postalAddress` varchar(200) NOT NULL,
  `profilePhoto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reginstitutions`
--

INSERT INTO `reginstitutions` (`id`, `institutionName`, `location`, `emailAddress`, `phoneNumber`, `password`, `illnesses`, `postalAddress`, `profilePhoto`) VALUES
(1, 'New Hospital', '234', '234234', '3242', 'qweqw', 'Condition B', '2342', ''),
(2, 'Hospitali', 'Nairobi', 'hospitali@hospitali.com', '254111111111', 'Hospitali123', 'Condition A*Condition C', '13051', '');

-- --------------------------------------------------------

--
-- Table structure for table `regpatients`
--

CREATE TABLE `regpatients` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `institution` varchar(100) NOT NULL,
  `password` text DEFAULT NULL,
  `illness` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phoneNumber` int(14) NOT NULL,
  `profilePhoto` blob NOT NULL,
  `status` int(1) NOT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regpatients`
--

INSERT INTO `regpatients` (`id`, `firstName`, `lastName`, `emailAddress`, `institution`, `password`, `illness`, `address`, `age`, `gender`, `phoneNumber`, `profilePhoto`) VALUES
(6, 'khj', 'jh', '646', 'mediheal hospital', 'BIw6HeLqdkTIjmBI8zeHqg==', 'Array', '456', 56, 'Female', 0, ''),
(11, 'amsnfc', ' SDNF', 'rtaer', 'mediheal hospital', 'xbytrGCr+Gk6Bd4IHkKU8A==', 'Condition A', '1231', 34, 'Male', 2313, ''),
(13, 'berclay', 'Sprouts', 'berclaym@gmail.com', 'mediheal hospital', '4XnLuIpnX7JL5i3plnywyg==', 'Condition B', 'Nairobi', 25, 'Male', 722222222, '');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `sender_class` varchar(20) NOT NULL,
  `chat_identity` varchar(200) NOT NULL,
  `sent_from_id` int(11) NOT NULL,
  `emailAddress` varchar(40) NOT NULL,
  `sent_to_id` int(11) NOT NULL,
  `sent_to` varchar(40) NOT NULL,
  `readStatus` varchar(10) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointmentID`);

--
-- Indexes for table `patientmedlog`
--
ALTER TABLE `patientmedlog`
  ADD PRIMARY KEY (`entryID`);

--
-- Indexes for table `patientsleeplog`
--
ALTER TABLE `patientsleeplog`
  ADD PRIMARY KEY (`entryID`);

--
-- Indexes for table `patientsmeallog`
--
ALTER TABLE `patientsmeallog`
  ADD PRIMARY KEY (`entryID`);

--
-- Indexes for table `regdoctors`
--
ALTER TABLE `regdoctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reginstitutions`
--
ALTER TABLE `reginstitutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regpatients`
--
ALTER TABLE `regpatients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phoneNumber` (`phoneNumber`),
  ADD UNIQUE KEY `emailAddress` (`emailAddress`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `dosage`
--
ALTER TABLE `dosage`
  MODIFY `dosageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patientmedlog`
--
ALTER TABLE `patientmedlog`
  MODIFY `entryID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patientsleeplog`
--
ALTER TABLE `patientsleeplog`
  MODIFY `entryID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `patientsmeallog`
--
ALTER TABLE `patientsmeallog`
  MODIFY `entryID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `regdoctors`
--
ALTER TABLE `regdoctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reginstitutions`
--
ALTER TABLE `reginstitutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `regpatients`
--
ALTER TABLE `regpatients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
