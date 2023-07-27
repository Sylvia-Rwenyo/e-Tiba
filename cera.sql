-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2023 at 09:37 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
  `appointmentDuration` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointmentID`, `patientID`, `doctorID`, `appointmentDate`, `appointmentTime`, `appointmentDuration`) VALUES
(1, 6, 1, '2023-07-26', '10:30', '60'),
(2, 11, 2, '2023-07-28', '16:30', NULL),
(3, 2, 0, '16:30', '11', NULL),
(4, 2, 0, '16:30', '2', NULL),
(5, 2, 0, '16:00', '11', NULL),
(6, 2, 0, '12:30', '11', NULL),
(7, 2, 0, '16:00', '11', NULL),
(8, 2, 0, '16:30', '11', NULL),
(9, 11, 2, '2023-07-28', '16:00', NULL),
(10, 0, 4, '2023-07-29', '15:00', NULL),
(11, 0, 4, '2023-07-28', '15:00', NULL),
(12, 0, 4, '2023-07-28', '15:30', NULL),
(13, 0, 4, '2023-07-28', '16:00', NULL),
(14, 0, 4, '2023-07-29', '16:30', NULL);

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
(8, 'doctor', 'fredric.ngugi@yahoo.com_rtaer', 1, 'fredric.ngugi@yahoo.com', 11, 'rtaer', 'read', 'Hello rtaer, I would like to be your new doctor'),
(9, 'patient', 'fredric.ngugi@yahoo.com_rtaer', 11, 'rtaer', 1, 'fredric.ngugi@yahoo.com', 'read', 'Hello Fredrick, I would like to work with you as well'),
(10, 'patient', 'fredric.ngugi@yahoo.com_rtaer', 11, 'rtaer', 1, 'fredric.ngugi@yahoo.com', 'read', 'What do you treat?'),
(11, 'doctor', 'fredric.ngugi@yahoo.com_rtaer', 1, 'fredric.ngugi@yahoo.com', 11, 'rtaer', 'read', 'Im a hematologist by profession, thats disease of the blood '),
(12, 'doctor', 'fredric.ngugi@yahoo.com_646', 1, 'fredric.ngugi@yahoo.com', 6, '646', 'read', 'Hello 646, I would like to be your new doctor'),
(13, 'patient', 'fredric.ngugi@yahoo.com_646', 6, '646', 1, 'fredric.ngugi@yahoo.com', 'read', 'Hello Fredrick, thank you for enrolling me'),
(14, 'patient', 'fredric.ngugi@yahoo.com_646', 6, '646', 1, 'fredric.ngugi@yahoo.com', 'read', 'I have this and this disease'),
(15, 'patient', 'morris@gmail.com_646', 6, '646', 2, 'morris@gmail.com', 'read', 'I would like to register for CERA'),
(16, 'patient', 'morris@gmail.com_646', 6, '646', 2, 'morris@gmail.com', 'read', 'how do I go about it?'),
(17, 'patient', 'morris@gmail.com_646', 6, '646', 2, 'morris@gmail.com', 'read', 'attempt message 1');

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
(12, 18, 7, '2023-07-05 15:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `patientsmeallog`
--

CREATE TABLE `patientsmeallog` (
  `userID` int(10) NOT NULL,
  `mealName` varchar(100) NOT NULL,
  `mealTime` datetime NOT NULL,
  `entryID` int(20) NOT NULL,
  `recordDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'doctor', 'doctor', 'doctor@newhospital.com', 'none', 'doctor123', '', '', 25, 'Male', '', 0),
(3, 'Fredrick', 'Kamau', 'fredric.ngugi@yahoo.com', 'New Hospital', '123', '', '', 34, 'Male', '', 0),
(4, 'adhfkj', 'jadfhds', '', 'Hospitali', '', 'Condition C', '34434', 0, 'Female', '', 2147483647),
(5, 'adhfkj', 'jadfhds', '', 'Hospitali', '', 'Condition C', '34434', 0, 'Female', '', 2147483647);

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
  `password` varchar(50) NOT NULL,
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

INSERT INTO `regpatients` (`id`, `firstName`, `lastName`, `emailAddress`, `institution`, `password`, `illness`, `address`, `age`, `gender`, `phoneNumber`, `profilePhoto`, `status`, `registrationDate`) VALUES
(6, 'khj', 'jh', '646', 'Hospitali', 'hgh', 'Condition A', '456', 56, 'Female', 0, '', 1, '2023-07-27 15:59:01'),
(11, 'amsnfc', ' SDNF', 'rtaer', 'Hospitali', '234', 'Condition A', '1231', 34, 'Male', 2313, '', 2, '2023-07-27 15:59:01'),
(12, 'Fredrick', 'Kamau', 'fredric.ngugi@yahoo.com', 'Hospitali', '123', 'Condition A*Condition C', '13051', 30, 'Male', 786543598, '', 0, '2023-07-27 15:59:01');

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
ALTER TABLE `appointments`
  MODIFY `appointmentID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `patientmedlog`
--
ALTER TABLE `patientmedlog`
  MODIFY `entryID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patientsleeplog`
--
ALTER TABLE `patientsleeplog`
  MODIFY `entryID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patientsmeallog`
--
ALTER TABLE `patientsmeallog`
  MODIFY `entryID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regdoctors`
--
ALTER TABLE `regdoctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
