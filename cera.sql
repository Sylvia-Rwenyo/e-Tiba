-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2023 at 11:58 AM
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
  `appointmentDate` date DEFAULT NULL,
  `appointmentTime` time DEFAULT NULL,
  `appointmentDuration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointmentID`, `patientID`, `doctorID`, `appointmentDate`, `appointmentTime`, `appointmentDuration`) VALUES
(1, 6, 1, '2023-07-26', '10:30:00', '0000-00-00 00:00:00'),
(2, 11, 2, '2023-07-28', '16:30:00', NULL),
(3, 2, 0, '0000-00-00', '00:00:11', NULL),
(4, 2, 0, '0000-00-00', '00:00:02', NULL),
(5, 2, 0, '0000-00-00', '00:00:11', NULL),
(6, 2, 0, '0000-00-00', '00:00:11', NULL),
(7, 2, 0, '0000-00-00', '00:00:11', NULL),
(8, 2, 0, '0000-00-00', '00:00:11', NULL),
(9, 11, 2, '2023-07-28', '16:00:00', NULL),
(10, 0, 4, '2023-07-29', '15:00:00', NULL),
(11, 0, 4, '2023-07-28', '15:00:00', NULL),
(12, 0, 4, '2023-07-28', '15:30:00', NULL),
(13, 0, 4, '2023-07-28', '16:00:00', NULL),
(14, 0, 4, '2023-07-29', '16:30:00', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `sender_class`, `chat_identity`, `sent_from_id`, `emailAddress`, `sent_to_id`, `sent_to`, `readStatus`, `message`) VALUES
(8, 'doctor', 'fredric.ngugi@yahoo.com_rtaer', 1, 'fredric.ngugi@yahoo.com', 11, 'rtaer', 'read', 'Hello rtaer, I would like to be your new doctor'),
(9, 'patient', 'fredric.ngugi@yahoo.com_rtaer', 11, 'rtaer', 1, 'fredric.ngugi@yahoo.com', 'read', 'Hello Fredrick, I would like to work with you as well'),
(11, 'doctor', 'fredric.ngugi@yahoo.com_rtaer', 1, 'fredric.ngugi@yahoo.com', 11, 'rtaer', 'read', 'Im a hematologist by profession, thats disease of the blood '),
(12, 'doctor', 'fredric.ngugi@yahoo.com_646', 1, 'fredric.ngugi@yahoo.com', 6, '646', 'read', 'Hello 646, I would like to be your new doctor'),
(13, 'patient', 'fredric.ngugi@yahoo.com_646', 6, '646', 1, 'fredric.ngugi@yahoo.com', 'read', 'Hello Fredrick, thank you for enrolling me'),
(14, 'patient', 'fredric.ngugi@yahoo.com_646', 6, '646', 1, 'fredric.ngugi@yahoo.com', 'read', 'I have this and this disease'),
(15, 'patient', 'morris@gmail.com_646', 6, '646', 2, 'morris@gmail.com', 'read', 'I would like to register for CERA'),
(16, 'patient', 'morris@gmail.com_646', 6, '646', 2, 'morris@gmail.com', 'read', 'how do I go about it?'),
(17, 'patient', 'morris@gmail.com_646', 6, '646', 2, 'morris@gmail.com', 'read', 'attempt message 1'),
(19, 'patient', 'fredric.ngugi@yahoo.com_rtaer', 11, 'rtaer', 1, 'fredric.ngugi@yahoo.com', 'read', 'By mistake'),
(20, 'doctor', 'fredric.ngugi@yahoo.com_rtaer', 1, 'fredric.ngugi@yahoo.com', 11, 'rtaer', 'read', 'okay, lets go on'),
(21, 'patient', 'fredric.ngugi@yahoo.com_rtaer', 11, 'rtaer', 1, 'fredric.ngugi@yahoo.com', 'read', 'where do we begin?'),
(23, 'doctor', 'fredric.ngugi@yahoo.com_rtaer', 1, 'fredric.ngugi@yahoo.com', 11, 'rtaer', 'read', 'hey'),
(25, 'patient', 'fredric.ngugi@yahoo.com_rtaer', 11, 'rtaer', 1, 'fredric.ngugi@yahoo.com', 'read', 'sorry for the late reply'),
(26, 'doctor', 'morris@gmail.com_646', 2, 'morris@gmail.com', 6, '646', 'unread', 'hello kjh'),
(27, 'doctor', 'morris@gmail.com_646', 2, 'morris@gmail.com', 6, '646', 'unread', 'attempt message 2');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patientsleeplog`
--

CREATE TABLE `patientsleeplog` (
  `userID` int(10) NOT NULL,
  `sleepTime` int(2) NOT NULL,
  `entryID` int(20) NOT NULL,
  `recordDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patientsleeplog`
--

INSERT INTO `patientsleeplog` (`userID`, `sleepTime`, `entryID`, `recordDate`) VALUES
(6, 7, 1, '2023-08-18 07:58:19'),
(6, 5, 2, '2023-08-18 07:58:29'),
(6, 8, 3, '2023-08-18 07:58:42'),
(6, 3, 4, '2023-08-18 07:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `patientsmeallog`
--

CREATE TABLE `patientsmeallog` (
  `userID` int(10) NOT NULL,
  `mealName` varchar(100) NOT NULL,
  `mealTime` time NOT NULL,
  `entryID` int(20) NOT NULL,
  `recordDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patientsmeallog`
--

INSERT INTO `patientsmeallog` (`userID`, `mealName`, `mealTime`, `entryID`, `recordDate`) VALUES
(6, 'food1', '07:50:00', 1, '2023-08-21'),
(6, 'food 2', '12:50:00', 2, '2023-08-21');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regdoctors`
--

INSERT INTO `regdoctors` (`id`, `firstName`, `lastName`, `emailAddress`, `institution`, `password`, `specialty`, `address`, `age`, `gender`, `profilePhoto`, `phoneNumber`) VALUES
(1, 'Fredrick', 'Kamau', 'fredric.ngugi@yahoo.com', 'none', 'er324', '', '', 23, 'Female', '', 0),
(2, 'Morris', 'Muema', 'morris@gmail.com', 'mediheal hospital', 'doctor123', '', '', 25, 'Male', '', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reginstitutions`
--

INSERT INTO `reginstitutions` (`id`, `institutionName`, `location`, `emailAddress`, `phoneNumber`, `password`, `illnesses`, `postalAddress`, `profilePhoto`) VALUES
(1, 'New Hospital', '234', '234234', '3242', 'qweqw', 'Condition B', '2342', ''),
(2, 'mediheal hospital', 'Eldoret', 'mediheal.hos@gmail.com', '0722222222', 'medi@123', 'Condition B', '22234-3345', '');

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
  `password` varchar(50) NOT NULL,
  `illness` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phoneNumber` int(14) NOT NULL,
  `profilePhoto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regpatients`
--

INSERT INTO `regpatients` (`id`, `firstName`, `lastName`, `emailAddress`, `institution`, `password`, `illness`, `address`, `age`, `gender`, `phoneNumber`, `profilePhoto`) VALUES
(6, 'khj', 'jh', '646', 'mediheal hospital', 'hgh', 'Array', '456', 56, 'Female', 0, ''),
(11, 'amsnfc', ' SDNF', 'rtaer', 'mediheal hospital', '234', 'Condition A', '1231', 34, 'Male', 2313, '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `sender_class`, `chat_identity`, `sent_from_id`, `emailAddress`, `sent_to_id`, `sent_to`, `readStatus`, `message`) VALUES
(1, 'patient', 'mediheal.hos@gmail.com_rtaer', 11, 'rtaer', 2, 'mediheal.hos@gmail.com', 'read', 'Hello , I would like to launch a complaint');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosage`
--
ALTER TABLE `dosage`
  ADD PRIMARY KEY (`dosageId`);

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
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
  MODIFY `entryID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patientsmeallog`
--
ALTER TABLE `patientsmeallog`
  MODIFY `entryID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `regdoctors`
--
ALTER TABLE `regdoctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reginstitutions`
--
ALTER TABLE `reginstitutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `regpatients`
--
ALTER TABLE `regpatients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
