-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2024 at 12:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `the_updated_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `addproperty`
--

CREATE TABLE `addproperty` (
  `PropertyID` int(11) NOT NULL,
  `roomNumber` int(50) NOT NULL,
  `room_price` decimal(10,2) NOT NULL,
  `capacity` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addproperty`
--

INSERT INTO `addproperty` (`PropertyID`, `roomNumber`, `room_price`, `capacity`, `description`) VALUES
(11, 1, 3000.00, 2, 'Good for Two Persons'),
(12, 0, 12.00, 12, '212121'),
(13, 0, 12.00, 12, '212121'),
(14, 0, 12.00, 12, '212121');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addproperty`
--
ALTER TABLE `addproperty`
  ADD PRIMARY KEY (`PropertyID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addproperty`
--
ALTER TABLE `addproperty`
  MODIFY `PropertyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
