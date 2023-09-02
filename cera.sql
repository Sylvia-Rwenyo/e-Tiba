-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2023 at 10:36 PM
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
(29, 'Githeri', '0000-00-00 00:00:00', 1, '2023-08-27 21:00:00'),
(29, 'Githeri', '0000-00-00 00:00:00', 2, '2023-08-27 21:00:00'),
(28, '', '', 3, '0000-00-00 00:00:00'),
(28, '', '', 4, '0000-00-00 00:00:00'),
(28, 'Mutura', '13:41', 5, '2023-08-28 21:00:00'),
(28, 'Chakula tu', '20:02', 6, '2023-08-29 21:00:00');

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
(11, 'amsnfc', ' SDNF', 'rtaer', 'Hospitali', '234', 'Condition A', '1231', 34, 'Male', 2313, '', 2, '2023-07-27 15:59:01'),
(13, 'kjk', 'hj', 'ghi@yahoo.com', 'New Hospital', 'jhhj', 'Condition A*Condition B*Condition C', '13051', 89, 'Female', 9890809, '', 0, '2023-08-08 09:46:45'),
(14, 'hj', 'ojk', 'sdfjsd@dsfhsjdf.kfksd', 'New Hospital', '', '', '1982', 89, 'Female', 789898989, '', 0, '2023-08-08 17:33:19'),
(17, 'hj', 'ojk', 'sjsd@dsfhsjdf.kfksd', 'New Hospital', '', '', '1982', 89, 'Female', 789898978, '', 0, '2023-08-08 17:34:42'),
(18, 'hj', 'ojk', 'sd@dsfhsjdf.kfksd', 'Hospitali', '', '', '1982', 89, 'Female', 789898909, '', 0, '2023-08-08 17:35:57'),
(19, 'hj', 'ojk', 's@dsfhsjdf.kfksd', 'Hospitali', '', '', '1982', 89, 'Female', 789898919, '', 0, '2023-08-08 17:36:22'),
(21, 'hj', 'ojk', 's@koo.kfksd', 'Hospitali', '', '', '1982', 89, 'Female', 789890019, '', 0, '2023-08-08 17:38:12'),
(22, 'jrhwe', 'fjjnew', 'dhfjkshd@jsdhjas.com', 'New Hospital', '', '', '21321', 89, 'Prefer not', 789897654, '', 0, '2023-08-08 17:41:01'),
(24, 'sfjdhsd', 'dfjnsd', 'sdksjd@gsvgd.djaskd', 'New Hospital', 'dsasdas', '', 'dsa', 60, 'Male', 832212956, '', 0, '2023-08-08 17:43:55'),
(28, 'Patient', 'Patient', 'patient2@patient.com', 'New Hospital', 'pw123@pw', '', '12345', 23, 'Male', 789898980, '', 0, '2023-08-28 07:46:32'),
(29, 'lady', 'lady', 'lady@lady.com', 'New Hospital', 'Lady1239*', '', '13051', 34, 'Female', 768686868, '', 0, '2023-08-28 07:53:00'),
(30, 'asdjfh', 'asdjfh', 'adfja@jfk.com', 'New Hospital', '', 'Condition A*Condition B*Condition C', '45464', 40, 'Female', 789646558, '', 0, '2023-08-28 09:08:47'),
(31, 'dsfd', 'sdsd', 'asdas@ad.ad', 'New Hospital', 'Sdfhdf$23', '', '1231', 23, 'Female', 123812328, '', 0, '2023-08-30 17:23:17'),
(32, 'user', 'using', 'emailaddress@mail.com', 'New Hospital', 'sdqweqewweqweW123!', '', '12321', 10, 'Male', 734923823, '', 0, '2023-08-30 17:25:45'),
(33, 'Fredrick', 'Kamau', 'fredric.ngugi@yahoo.com', 'New Hospital', 'hghsdgf%D12', '', '13051', 56, 'Male', 78989898, '', 0, '2023-08-30 18:00:50'),
(35, 'Regina', 'Regina', 'regina@regina.com', 'New Hospital', 'reginaPw123#', '', '12323', 50, 'Female', 732645334, '', 0, '2023-08-29 18:05:05'),
(41, 'Fredrick', 'Kamau', 'fredric.gi@yahoo.com', 'New Hospital', 'FRED234!s', '', '13051', 45, 'Male', 2147483647, '', 0, '2023-08-29 18:42:44');

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
ALTER TABLE `appointments`
  MODIFY `appointmentID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
  MODIFY `entryID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
