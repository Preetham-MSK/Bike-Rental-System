-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2019 at 09:23 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bikerental`
--



-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bike`
--

CREATE TABLE `bike` (
  `bike_id` int(5) NOT NULL,
  `bike_name` varchar(20) NOT NULL,
  `model` year(4) NOT NULL,
  `color` varchar(10) NOT NULL,
  `bike_type` varchar(10) NOT NULL,
  `price` int(4) NOT NULL,
  `term_id` int(5) NOT NULL,
  `avail` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bike`
--

INSERT INTO `bike` (`bike_id`, `bike_name`, `model`, `color`, `bike_type`, `price`, `term_id`, `avail`) VALUES
(101, 'Pulsar', 2017, 'Black', 'bike', 30, 1020, 1),
(102, 'RX100', 1999, 'Red', 'bike', 32, 1021, 1),
(103, 'Activa', 2018, 'Blue', 'scooter', 25, 1022, 1),
(104, 'Jupiter', 2016, 'Grey', 'scooter', 26, 1022, 1),
(105, 'ApacheRTR', 2019, 'white', 'bike', 30, 1020, 1),
(106, 'Vespa', 2017, 'Red', 'scooter', 23, 1021, 1),
(107, 'KTM', 2015, 'Orange', 'bike', 32, 1023, 1),
(108, 'Pleasure', 2012, 'white', 'scooter', 24, 1023, 1),
(109, 'YamahaRay', 2010, 'Red', 'scooter', 26, 1022, 1),
(110, 'Hero', 2019, 'Black', 'bike', 20, 1022, 1);

--
-- Triggers `bike`
--
DELIMITER $$
CREATE TRIGGER `bikeadd` AFTER INSERT ON `bike` FOR EACH ROW UPDATE terminal
set no_of_bikes = no_of_bikes + 1
WHERE term_id = new.term_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `bikerem` AFTER DELETE ON `bike` FOR EACH ROW UPDATE terminal
set no_of_bikes = no_of_bikes - 1
WHERE term_id = old.term_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `email` varchar(20) NOT NULL,
  `bike_id` int(5) NOT NULL,
  `cost` decimal(8,2) NOT NULL,
  `mode` varchar(10) NOT NULL,
  `receipt_no` int(10) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`email`, `bike_id`, `cost`, `mode`, `receipt_no`, `date`) VALUES
('vinay@gmail.com', 102, '512.00', 'card', 22, '2019-11-12 13:15:00'),
('pavan@gmail.com', 103, '640.00', 'paypal', 25, '2019-11-13 13:13:00'),
('vinay@gmail.com', 102, '1568.00', 'Card', 48, '2019-11-28 11:49:38'),
('vinay@gmail.com', 104, '1118.00', 'Card', 50, '2019-11-29 11:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `terminal`
--

CREATE TABLE `terminal` (
  `term_id` int(5) NOT NULL,
  `term_name` varchar(20) NOT NULL,
  `no_of_bikes` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terminal`
--

INSERT INTO `terminal` (`term_id`, `term_name`, `no_of_bikes`) VALUES
(1020, 'BSK', 2),
(1021, 'J P Nagar', 2),
(1022, 'Hebbal', 4),
(1023, 'Kormangala', 2);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `email` varchar(20) NOT NULL,
  `bike_id` int(5) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`email`, `bike_id`, `start_time`, `end_time`) VALUES
('vinay@gmail.com', 102, '2019-11-11 13:05:00', '2019-11-13 19:41:00'),
('slekha@gmail.com', 103, '2019-11-19 14:19:33', '2019-11-19 15:27:06'),
('praveen@gmail.com', 105, '2019-11-19 15:35:41', '2019-11-19 15:36:32'),
('praveen@gmail.com', 105, '2019-11-19 15:38:25', '2019-11-19 15:38:50'),
('vinay@gmail.com', 101, '2019-11-19 15:39:49', '2019-11-19 15:40:10'),
('vinay@gmail.com', 101, '2019-11-20 16:30:53', '2019-11-20 16:32:53'),
('vinay@gmail.com', 104, '2019-11-20 16:40:41', '2019-11-20 16:41:33'),
('vinay@gmail.com', 107, '2019-11-20 21:17:17', '2019-11-20 21:18:26'),
('vinay@gmail.com', 102, '2019-11-20 23:12:12', '2019-11-20 23:25:19'),
('pavan@gmail.com', 106, '2019-11-20 23:20:21', '2019-11-20 23:23:26'),
('slekha@gmail.com', 107, '2019-11-20 23:20:56', '2019-11-20 23:28:08'),
('pavan@gmail.com', 108, '2019-11-21 14:02:59', '2019-11-21 14:05:36'),
('pavan@gmail.com', 107, '2019-11-22 11:59:27', '2019-11-22 12:00:40'),
('vinay@gmail.com', 102, '2019-11-22 13:14:52', '2019-11-22 22:39:40'),
('pavan@gmail.com', 109, '2019-11-28 10:04:34', '2019-11-28 10:06:53'),
('pavan@gmail.com', 104, '2019-11-28 11:13:12', '2019-11-28 11:25:10'),
('vinay@gmail.com', 102, '2019-11-28 11:24:23', '2019-11-28 11:25:12'),
('slekha@gmail.com', 108, '2019-11-28 11:24:50', '2019-11-28 11:25:11'),
('vinay@gmail.com', 104, '2019-11-29 11:57:45', '2019-11-29 11:58:28');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` bigint(13) NOT NULL,
  `dlno` bigint(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`fname`, `lname`, `email`, `phone`, `dlno`, `password`) VALUES
('Harish', 'K', 'harish@gmail.com', 9521087224, 86883682, 'harish'),
('Mithun ', 'Kumar', 'mithun@gmail.com', 9986210223, 6589821, 'mithun'),
('Pavan', 'Kumar', 'pavan@gmail.com', 9752412672, 76768688, 'pavan'),
('Praveen', 'M', 'praveen@gmail.com', 9109762212, 7826889, 'praveen'),
('Shree', 'Lekha', 'slekha@gmail.com', 9743211, 573576572, 'shree'),
('Vinay', 'H', 'vinay@gmail.com', 9662143215, 546765456, 'vinay');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `bike`
--
ALTER TABLE `bike`
  ADD PRIMARY KEY (`bike_id`),
  ADD KEY `term_id` (`term_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`receipt_no`),
  ADD KEY `payment_ibfk_1` (`email`),
  ADD KEY `bike_id` (`bike_id`);

--
-- Indexes for table `terminal`
--
ALTER TABLE `terminal`
  ADD PRIMARY KEY (`term_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD KEY `bike_id` (`bike_id`),
  ADD KEY `transaction_ibfk_2` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `dlno` (`dlno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bike`
--
ALTER TABLE `bike`
  MODIFY `bike_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `receipt_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bike`
--
ALTER TABLE `bike`
  ADD CONSTRAINT `bike_ibfk_1` FOREIGN KEY (`term_id`) REFERENCES `terminal` (`term_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`bike_id`) REFERENCES `bike` (`bike_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`bike_id`) REFERENCES `bike` (`bike_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
