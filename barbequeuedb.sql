-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2019 at 01:41 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `barbequeuedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `password`, `name`) VALUES
('admin', 'admin', 'chika');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_name` varchar(30) NOT NULL,
  `party_size` tinyint(4) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `seating_choice` enum('W','D','B','') NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `customer_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_name`, `party_size`, `phone_number`, `seating_choice`, `date`, `time`, `customer_id`) VALUES
('frank', 1, '1236547890', 'D', '2019-11-06', '13:15:43', 1),
('Jennifer', 1, '08012345698', 'B', '2019-11-06', '12:31:20', 2);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `first name` varchar(30) NOT NULL,
  `last name` varchar(30) NOT NULL,
  `staff id` int(11) NOT NULL,
  `job id` int(11) NOT NULL,
  `on shift` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`first name`, `last name`, `staff id`, `job id`, `on shift`) VALUES
('Eddy', 'marks', 1288, 99, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE IF NOT EXISTS `tables` (
  `table num` int(80) NOT NULL,
  `table size` varchar(11) NOT NULL,
  `available` varchar(11) NOT NULL,
  `assigned server` varchar(11) NOT NULL,
  `reserved` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table num`, `table size`, `available`, `assigned server`, `reserved`) VALUES
(1, '2', 'Y', 'Y', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`), ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table num`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
