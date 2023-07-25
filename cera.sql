-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2023 at 05:36 PM
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
(1, 'omeprazol', 'khj', '646', 6, 'Morris', 2, 'morris@gmail.com', 3, 5, 2);

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
(6, 3600, 1, '2023-06-23 14:31:39'),
(6, 3600, 2, '2023-06-23 14:31:56'),
(6, 1, 3, '2023-06-23 14:32:12'),
(6, 1, 4, '2023-06-23 14:35:14');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 'Morris', 'Muema', 'morris@gmail.com', 'none', 'doctor123', '', '', 25, 'Male', '', 0);

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
(1, 'New Hospital', '234', '234234', '3242', 'qweqw', 'Condition B', '2342', '');

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
(6, 'khj', 'jh', '646', 'Institution A', 'hgh', 'Array', '456', 56, 'Female', 0, ''),
(11, 'amsnfc', ' SDNF', 'rtaer', 'Institution B', '234', 'Condition A', '1231', 34, 'Male', 2313, ''),
(12, 'Fredrick', 'Kamau', 'fredric.ngugi@yahoo.com', 'Institution B', '123', 'Condition A*Condition C', '13051', 30, 'Male', 786543598, '');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `dosage`
--
ALTER TABLE `dosage`
  MODIFY `dosageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `entryID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regdoctors`
--
ALTER TABLE `regdoctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reginstitutions`
--
ALTER TABLE `reginstitutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `regpatients`
--
ALTER TABLE `regpatients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
