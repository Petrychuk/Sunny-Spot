-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2023 at 04:13 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sunnyspot`
--

-- --------------------------------------------------------

--
-- Table structure for table `cabininclusion`
--

CREATE TABLE `cabininclusion` (
  `cabinIncID` bigint(20) NOT NULL,
  `cabinID` bigint(20) NOT NULL,
  `incID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cabininclusion`
--

INSERT INTO `cabininclusion` (`cabinIncID`, `cabinID`, `incID`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 3),
(5, 5, 3),
(6, 3, 4),
(7, 4, 4),
(8, 5, 4),
(9, 2, 5),
(10, 1, 6),
(11, 2, 6),
(12, 3, 7),
(13, 4, 7),
(14, 5, 7),
(15, 1, 8),
(16, 2, 8),
(17, 3, 8),
(19, 4, 8),
(20, 5, 8),
(21, 4, 9),
(22, 5, 9),
(23, 3, 10),
(24, 4, 10),
(25, 5, 10),
(26, 1, 11),
(27, 3, 11),
(28, 4, 11),
(29, 5, 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cabininclusion`
--
ALTER TABLE `cabininclusion`
  ADD PRIMARY KEY (`cabinIncID`),
  ADD KEY `inclusion_cabininclusion_fk` (`incID`),
  ADD KEY `cabin_cabininclusion_fk` (`cabinID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cabininclusion`
--
ALTER TABLE `cabininclusion`
  MODIFY `cabinIncID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cabininclusion`
--
ALTER TABLE `cabininclusion`
  ADD CONSTRAINT `cabin_cabininclusion_fk` FOREIGN KEY (`cabinID`) REFERENCES `cabin` (`cabinID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inclusion_cabininclusion_fk` FOREIGN KEY (`incID`) REFERENCES `inclusion` (`incID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
