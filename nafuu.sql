-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2024 at 01:34 PM
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
-- Database: `nafuu`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medId` int(11) NOT NULL,
  `medName` varchar(200) NOT NULL,
  `medAdmin` varchar(100) NOT NULL,
  `medManufacturer` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `hospId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medId`, `medName`, `medAdmin`, `medManufacturer`, `price`, `hospId`) VALUES
(1, 'cetrizine', 'Oral tablet', 'glaxosmithkline', 20, 4);

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
-- Table structure for table `patientsexerciselog`
--

CREATE TABLE `patientsexerciselog` (
  `recordID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `recordDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `exerciseType` varchar(40) NOT NULL,
  `exerciseDuration` int(4) NOT NULL,
  `exerciseTime` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patientsexerciselog`
--

INSERT INTO `patientsexerciselog` (`recordID`, `userID`, `recordDate`, `exerciseType`, `exerciseDuration`, `exerciseTime`) VALUES
(1, 28, '2023-08-29 09:31:35', 'Aerobics', 10, '10:30'),
(2, 28, '2023-08-29 09:31:44', 'Aerobics', 10, '10:30'),
(3, 15, '2023-10-28 19:25:13', 'Dancing', 20, '10:25'),
(4, 15, '2023-10-28 19:29:47', 'Weight Training', 20, '18:29'),
(5, 15, '2023-10-28 20:01:30', 'Body Weight Exercises', 30, '15:01'),
(6, 19, '2023-11-30 14:34:17', 'Weight Training', 30, '15:34'),
(8, 19, '2023-11-29 14:34:17', 'Weight Training', 30, '15:34'),
(9, 19, '2023-11-30 14:34:17', 'Weight Training', 30, '15:28');

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
(6, 3, 4, '2023-08-18 07:59:07'),
(29, 11, 8, '2023-08-28 05:32:43'),
(29, 7, 9, '2023-08-28 05:34:34'),
(29, 7, 10, '2023-08-28 05:34:54'),
(28, 15, 11, '2023-08-29 09:05:49'),
(14, -14, 12, '2023-10-27 09:27:33'),
(15, 3, 13, '2023-10-28 19:24:40'),
(15, 9, 14, '2023-10-28 19:28:15'),
(19, 8, 15, '2023-11-30 14:33:31'),
(19, 8, 16, '2023-11-29 14:33:31'),
(19, 8, 17, '2023-11-28 14:33:31'),
(15, -19, 18, '2023-12-19 18:03:40'),
(15, 13, 19, '2023-12-19 18:04:35');

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
(6, 'food 2', '12:50:00', 2, '2023-08-21'),
(6, 'food 1', '08:00:00', 3, '2023-08-22'),
(6, 'food 2', '12:00:00', 4, '2023-08-22'),
(6, 'food 3', '22:00:00', 5, '2023-08-22'),
(29, 'Githeri', '00:00:00', 6, '2023-08-27'),
(29, 'Githeri', '00:00:00', 7, '2023-08-27'),
(28, '', '00:00:00', 8, '0000-00-00'),
(28, '', '00:00:00', 9, '0000-00-00'),
(28, 'Mutura', '13:41:00', 10, '2023-08-28'),
(28, 'Chakula tu', '20:02:00', 11, '2023-08-29'),
(15, 'uji', '19:24:00', 12, '2023-10-28'),
(15, 'Chai', '10:28:00', 13, '2023-10-28'),
(15, 'Rice', '12:29:00', 14, '2023-10-28'),
(19, 'Githeri', '13:33:00', 15, '2023-11-30'),
(19, 'Githeri', '13:33:00', 16, '2023-11-29'),
(19, 'Githeri', '13:33:00', 17, '2023-11-28'),
(19, 'Githeri', '08:33:00', 18, '2023-11-29'),
(19, 'Githeri', '08:33:00', 19, '2023-11-28'),
(19, 'Githeri', '11:33:00', 20, '2023-11-29'),
(19, 'Githeri', '11:33:00', 21, '2023-11-28'),
(19, 'Githeri', '13:33:00', 22, '2023-11-27'),
(19, 'Githeri', '06:33:00', 23, '2023-11-27');

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
  `phoneNumber` int(14) NOT NULL,
  `date_registered` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regdoctors`
--

INSERT INTO `regdoctors` (`id`, `firstName`, `lastName`, `emailAddress`, `institution`, `password`, `specialty`, `address`, `age`, `gender`, `profilePhoto`, `phoneNumber`, `date_registered`, `date_updated`) VALUES
(1, 'Fredrick', 'Kamau', 'fredric.ngugi@yahoo.com', 'none', 'ULBCXckbvOWLrae3HBB99g==', '', '', 23, 'Female', '', 0, '2024-01-03 07:36:37', '2024-01-03 07:36:37'),
(2, 'Morris', 'Muema', 'morris@gmail.com', 'mediheal hospital', 'ntj5NGsbJiWn94OnHNlc8w==', '', '', 25, 'Male', '', 0, '2024-01-03 07:36:37', '2024-01-03 07:36:37'),
(4, 'Kevo', 'Kimotho', 'kk@gmail.com', 'none', 'xBy97cakb7/r2gbdah/aNA==', 'Condition A', '', 0, 'Male', '', 722123456, '2024-01-03 07:36:37', '2024-01-03 07:36:37');

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
  `profilePhoto` blob NOT NULL,
  `date_registered` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reginstitutions`
--

INSERT INTO `reginstitutions` (`id`, `institutionName`, `location`, `emailAddress`, `phoneNumber`, `password`, `illnesses`, `postalAddress`, `profilePhoto`, `date_registered`, `date_updated`) VALUES
(1, 'New Hospital', '234', '234234', '3242', 'TB8MvNoRYKrdyScdWwubgw==', 'Condition B', '2342', '', '2024-01-03 07:37:23', '2024-01-03 07:37:23'),
(2, 'mediheal hospital', 'Eldoret', 'mediheal.hos@gmail.com', '0722222222', 'm97SyqgW1aPhLBeUlcmNhQ==', 'Condition B', '22234-3345', '', '2024-01-03 07:37:23', '2024-01-03 07:37:23'),
(3, 'Hospitali', 'Nairobi', 'hospitali@hospitali.com', '254111111111', 'xHf2LRAW6NbUqZs/3fLc0A==', 'Condition A*Condition C', '13051', '', '2024-01-03 07:37:23', '2024-01-03 07:37:23'),
(4, 'lidari health', 'Nairobi', 'lidar.hos@gmail.com', '0711222333', 'KvWZbyA/TIOKQVqr9e7c0g==', 'Condition B', '22234-3345', '', '2024-01-03 07:37:23', '2024-01-03 07:37:23');

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
  `phoneNumber` varchar(12) NOT NULL,
  `status` int(11) NOT NULL,
  `profilePhoto` blob NOT NULL,
  `date_registered` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regpatients`
--

INSERT INTO `regpatients` (`id`, `firstName`, `lastName`, `emailAddress`, `institution`, `password`, `illness`, `address`, `age`, `gender`, `phoneNumber`, `status`, `profilePhoto`, `date_registered`, `date_updated`) VALUES
(6, 'khj', 'jh', '646', 'mediheal hospital', 'BIw6HeLqdkTIjmBI8zeHqg==', 'Array', '456', 56, 'Female', '0', 0, '', '2024-04-03 11:26:22', '2024-04-03 11:26:22'),
(11, 'amsnfc', ' SDNF', 'rtaer', 'mediheal hospital', 'xbytrGCr+Gk6Bd4IHkKU8A==', 'Condition A', '1231', 34, 'Male', '2313', 0, '', '2024-04-03 11:26:22', '2024-04-03 11:26:22'),
(13, 'berclay', 'Sprouts', 'berclaym@gmail.com', 'mediheal hospital', '4XnLuIpnX7JL5i3plnywyg==', 'Condition B', 'Nairobi', 25, 'Male', '722222222', 0, '', '2024-04-03 11:26:22', '2024-04-03 11:26:22'),
(14, 'Patient', 'User', 'patient@user.com', 'mediheal hospital', 'UUE5/sK9A04FfiwN4V9gGw==', '', '12333', 23, 'Male', '765666444', 0, '', '2024-04-03 11:26:22', '2024-04-03 11:26:22'),
(15, 'First', 'Patient', 'first@patient.com', 'Hospital', 'Z/ZDFdapcU6fnzEozLWvQ093VRvhzlEt68LqEYR9clI=', '', '12312', 30, 'Male', '2147483647', 0, '', '2024-04-03 11:26:22', '2024-04-03 11:26:22'),
(19, 'patientuser', 'userpatient', 'patientuser@userpatient.com', 'Hospital', 'w5+sMmyw0J8THP0Bs53mEA==', '', '34272', 20, 'Male', '782873262', 0, '', '2024-04-03 11:26:22', '2024-04-03 11:26:22'),
(20, 'Lady', 'Lady', 'lady@lady1.com', 'Nafuu Hospital', NULL, 'Condition B', '12313', 23, 'Female', '989888887', 0, '', '2024-04-03 11:26:22', '2024-04-03 11:26:22'),
(21, 'Lady', 'Lady', 'lady@lady2.com', 'Nafuu Hospital', NULL, 'Condition B', '12313', 23, 'Female', '989888087', 0, '', '2024-04-03 11:26:22', '2024-04-03 11:26:22'),
(22, 'Lady', 'Lady', 'lady@lady3.com', 'Nafuu Hospital', NULL, 'Condition B', '12313', 23, 'Female', '989878087', 0, '', '2024-04-03 11:26:22', '2024-04-03 11:26:22'),
(23, 'Lady', 'Lady', 'lady@lady4.com', 'Nafuu Hospital', NULL, 'Condition B', '12313', 23, 'Female', '987878087', 0, '', '2024-04-03 11:26:22', '2024-04-03 11:26:22'),
(24, 'Person', 'Person', 'person@person2.com', 'Hospital', NULL, 'Condition B', '12313', 30, 'Male', '676767888', 0, '', '2024-04-03 11:26:22', '2024-04-03 11:26:22'),
(25, 'Person', 'Person', 'person@person1.com', 'Hospital', NULL, 'Condition B', '12313', 30, 'Male', '676769888', 0, '', '2024-04-03 11:26:22', '2024-04-03 11:26:22'),
(27, 'Marie', 'Curie', 'marie@curie.com', 'New Hospital', 'ioNmNr3RoHqrmOlPkW7ABA==', '', '12345', 24, 'Female', '254667889009', 0, '', '2024-04-03 14:33:50', '2024-04-03 14:33:50');

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
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medId`);

--
-- Indexes for table `patientmedlog`
--
ALTER TABLE `patientmedlog`
  ADD PRIMARY KEY (`entryID`);

--
-- Indexes for table `patientsexerciselog`
--
ALTER TABLE `patientsexerciselog`
  ADD PRIMARY KEY (`recordID`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `dosage`
--
ALTER TABLE `dosage`
  MODIFY `dosageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patientmedlog`
--
ALTER TABLE `patientmedlog`
  MODIFY `entryID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patientsexerciselog`
--
ALTER TABLE `patientsexerciselog`
  MODIFY `recordID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `patientsleeplog`
--
ALTER TABLE `patientsleeplog`
  MODIFY `entryID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `patientsmeallog`
--
ALTER TABLE `patientsmeallog`
  MODIFY `entryID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `regdoctors`
--
ALTER TABLE `regdoctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reginstitutions`
--
ALTER TABLE `reginstitutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `regpatients`
--
ALTER TABLE `regpatients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
