-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2022 at 08:05 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_management_system`
--
CREATE DATABASE IF NOT EXISTS `student_management_system` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `student_management_system`;

-- --------------------------------------------------------

--
-- Table structure for table `cohort`
--

DROP TABLE IF EXISTS `cohort`;
CREATE TABLE `cohort` (
  `CohortID` int(11) NOT NULL,
  `CohortName` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cohort`
--

INSERT INTO `cohort` (`CohortID`, `CohortName`) VALUES
(1, 'Cohort 1'),
(2, 'Cohort 2'),
(3, 'Cohort 3');

-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

DROP TABLE IF EXISTS `programme`;
CREATE TABLE `programme` (
  `ProgrammeID` int(11) NOT NULL,
  `ProgrammeName` varchar(100) NOT NULL,
  `ProgrammeDepartment` varchar(100) DEFAULT NULL,
  `ProgrammeDuration` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programme`
--

INSERT INTO `programme` (`ProgrammeID`, `ProgrammeName`, `ProgrammeDepartment`, `ProgrammeDuration`) VALUES
(1, 'Graphic Design and Multimedia', 'Information, Communication and Technology', '3 years'),
(2, 'Marketing', 'Management', '3 years'),
(3, 'Electrical Engineering', 'Engineering', '4 years');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `StudentID` int(11) NOT NULL,
  `SFullName` varchar(100) NOT NULL,
  `DOB` date DEFAULT NULL,
  `SGender` varchar(20) DEFAULT NULL,
  `SAddress` varchar(70) DEFAULT NULL,
  `SPhoneNumber` int(11) DEFAULT NULL,
  `SEmailAddress` varchar(100) DEFAULT NULL,
  `CohortId` int(11) DEFAULT NULL,
  `ProgrammeId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`StudentID`, `SFullName`, `DOB`, `SGender`, `SAddress`, `SPhoneNumber`, `SEmailAddress`, `CohortId`, `ProgrammeId`) VALUES
(1, 'Jack Breakers', '2001-01-10', 'male', 'Red Street', 57438653, 'jack@breakers.com', 1, 1),
(2, 'Jenny Palm', '2002-11-25', 'female', 'Coconut Street', 57369465, 'jenny@gmail.com', 2, 2),
(3, 'Tom Hanks 123', '1997-07-26', 'male', 'Party Cloudy, Phoenix', 59324023, 'tomh@gmail.com', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `EmailAddress` varchar(60) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `UserType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `EmailAddress`, `Password`, `UserType`) VALUES
(4, 'Tom', 'tom@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(5, 'Vacoas', 'vacoas@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'staff'),
(8, 'Phoenix', 'phoenix@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cohort`
--
ALTER TABLE `cohort`
  ADD PRIMARY KEY (`CohortID`);

--
-- Indexes for table `programme`
--
ALTER TABLE `programme`
  ADD PRIMARY KEY (`ProgrammeID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cohort`
--
ALTER TABLE `cohort`
  MODIFY `CohortID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `programme`
--
ALTER TABLE `programme`
  MODIFY `ProgrammeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
