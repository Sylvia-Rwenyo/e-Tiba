-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2023 at 07:51 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

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
-- Table structure for table `dosage`
--

CREATE TABLE `dosage` (
  `dosageId` int(11) NOT NULL,
  `dosageName` varchar(100) NOT NULL,
  `tablets` int(11) NOT NULL,
  `times_a_day` int(11) NOT NULL,
  `number_of_days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `illness`
--

CREATE TABLE `illness` (
  `illnessId` int(11) NOT NULL,
  `illnessName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

CREATE TABLE `institution` (
  `institutionId` int(11) NOT NULL,
  `institution_name` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `firstName` varchar(15) NOT NULL,
  `lastName` varchar(15) NOT NULL,
  `emailAddress` varchar(15) NOT NULL,
  `institution` int(11) NOT NULL,
  `password` varchar(20) NOT NULL,
  `id` int(11) NOT NULL,
<<<<<<< HEAD
  `illness` int(11) NOT NULL
=======
  `age` int(3) NOT NULL,
  `address` varchar(30) NOT NULL,
  `gender` varchar(15) NOT NULL
>>>>>>> f6e886d0d95242bb68846dc7bc5c9d799458da54
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

<<<<<<< HEAD
CREATE TABLE `symptoms` (
  `symptomId` int(11) NOT NULL,
  `symptomDescription` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
=======
INSERT INTO `registration` (`firstName`, `lastName`, `emailAddress`, `institution`, `illness`, `password`, `id`, `age`, `address`, `gender`) VALUES
('person', '123', 'person@123.com', 'Institution A', '', '', 1, 0, '', ''),
('person', 'person@mail.com', '', 'Select your Hospital', '', '', 2, 0, '', ''),
('o', 'o', 'o', 'Select your Hospital', '', '', 3, 0, '', ''),
('', '', '', 'Select your Hospital', '', 'p', 4, 0, '', ''),
('', '', '', 'Institution A', 'Condition B', '', 5, 0, '', ''),
('', '', '', '', '', '', 6, 0, '', ''),
('Person', '2', 'person@2.com', 'Institution B', 'Condition B', '123', 7, 30, 'Nairobi', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `regpartners`
--

CREATE TABLE `regpartners` (
  `institutionName` varchar(60) NOT NULL,
  `location` varchar(30) NOT NULL,
  `phoneNumber` int(14) NOT NULL,
  `emailAddress` varchar(20) NOT NULL,
  `postalAddress` varchar(30) NOT NULL,
  `illnesses` varchar(200) NOT NULL,
  `password` varchar(20) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regpartners`
--

INSERT INTO `regpartners` (`institutionName`, `location`, `phoneNumber`, `emailAddress`, `postalAddress`, `illnesses`, `password`, `id`) VALUES
('New Hospital', 'Nairobi, Kenya', 2147483647, 'new@hospital.com', '13051', 'Array', '20', 1),
('New Hospital', 'Nairobi, Kenya', 2147483647, 'new@hospital.com', '13051', 'Condition A', '20', 2),
('New Hospital', 'Nairobi, Kenya', 2147483647, 'new@hospital.com', '13051', 'Condition A', '20', 3),
('New Hospital', 'Nairobi, Kenya', 2147483647, 'new@hospital.com', '13051', 'Condition A', '20', 4),
('New Hospital', 'Nairobi, Kenya', 2147483647, 'new@hospital.com', '13051', 'Condition A', '78', 5);

-- --------------------------------------------------------

--
-- Table structure for table `regpartners2`
--

CREATE TABLE `regpartners2` (
  `firstName` varchar(15) NOT NULL,
  `lastName` varchar(15) NOT NULL,
  `emailAddress` varchar(20) NOT NULL,
  `institution` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `specialty` varchar(20) NOT NULL,
  `address` varchar(20) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regpartners2`
--

INSERT INTO `regpartners2` (`firstName`, `lastName`, `emailAddress`, `institution`, `password`, `specialty`, `address`, `age`, `gender`, `id`) VALUES
('person', '2', 'person@2.com', '<br />\r\n<b>Warning</b>:  Undef', '123', '', '', 45, 'Male', 1);
>>>>>>> f6e886d0d95242bb68846dc7bc5c9d799458da54

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosage`
--
ALTER TABLE `dosage`
  ADD PRIMARY KEY (`dosageId`);

--
-- Indexes for table `illness`
--
ALTER TABLE `illness`
  ADD PRIMARY KEY (`illnessId`);

--
-- Indexes for table `institution`
--
ALTER TABLE `institution`
  ADD PRIMARY KEY (`institutionId`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `institution` (`institution`),
  ADD KEY `illness` (`illness`);

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD PRIMARY KEY (`symptomId`);

--
-- Indexes for table `regpartners`
--
ALTER TABLE `regpartners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regpartners2`
--
ALTER TABLE `regpartners2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosage`
--
ALTER TABLE `dosage`
  MODIFY `dosageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `illness`
--
ALTER TABLE `illness`
  MODIFY `illnessId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institution`
--
ALTER TABLE `institution`
  MODIFY `institutionId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `symptomId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`illness`) REFERENCES `illness` (`illnessId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`institution`) REFERENCES `institution` (`institutionId`) ON DELETE CASCADE ON UPDATE CASCADE;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `regpartners`
--
ALTER TABLE `regpartners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `regpartners2`
--
ALTER TABLE `regpartners2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
>>>>>>> f6e886d0d95242bb68846dc7bc5c9d799458da54
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
