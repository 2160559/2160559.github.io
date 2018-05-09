-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 09, 2018 at 05:12 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `initial`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `username`, `password`) VALUES
(1, 'admin', 'admin', 'admin', 'admin'),
(1, 'admin', 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

DROP TABLE IF EXISTS `bank_account`;
CREATE TABLE IF NOT EXISTS `bank_account` (
  `sv_id` int(11) NOT NULL,
  `account_no` int(11) NOT NULL,
  `bank` varchar(45) NOT NULL,
  `account_type` enum('checing','savings') NOT NULL,
  KEY `sv_id_idx` (`sv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

DROP TABLE IF EXISTS `house`;
CREATE TABLE IF NOT EXISTS `house` (
  `id` int(11) NOT NULL,
  KEY `id_idx` (`id`),
  KEY `house_id_idx` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house_images`
--

DROP TABLE IF EXISTS `house_images`;
CREATE TABLE IF NOT EXISTS `house_images` (
  `hose_id` int(11) NOT NULL,
  `image` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `customer` int(11) NOT NULL,
  `service_provider` int(11) NOT NULL,
  `time_sent` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`service_provider`,`customer`),
  KEY `customer_idx` (`customer`),
  KEY `service_provider_idx` (`service_provider`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `reservation_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reservation_id_idx` (`reservation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pay_reserve`
--

DROP TABLE IF EXISTS `pay_reserve`;
CREATE TABLE IF NOT EXISTS `pay_reserve` (
  `payment_id` int(11) NOT NULL,
  `ressrvation_id` int(11) NOT NULL,
  `status` enum('cancelled','pending','done') NOT NULL,
  `customer` int(11) DEFAULT NULL,
  PRIMARY KEY (`payment_id`,`ressrvation_id`),
  KEY `reserve_id_idx` (`ressrvation_id`),
  KEY `customer_id_idx` (`customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL,
  `date_reserved` date NOT NULL,
  `check-in_date` date NOT NULL,
  `check-out_date` date NOT NULL,
  `payment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_id_idx` (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `id` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `no_beds` int(11) NOT NULL,
  `bed_size` int(11) NOT NULL,
  `house` int(11) NOT NULL,
  KEY `room_id_idx` (`id`),
  KEY `hose-id_idx` (`house`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saves`
--

DROP TABLE IF EXISTS `saves`;
CREATE TABLE IF NOT EXISTS `saves` (
  `customer` int(11) NOT NULL,
  `transient` int(11) NOT NULL,
  PRIMARY KEY (`customer`,`transient`),
  KEY `transient_idx` (`transient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_provider`
--

DROP TABLE IF EXISTS `service_provider`;
CREATE TABLE IF NOT EXISTS `service_provider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(45) NOT NULL,
  `permit` blob NOT NULL,
  `gov_id` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

DROP TABLE IF EXISTS `superadmin`;
CREATE TABLE IF NOT EXISTS `superadmin` (
  `id` int(11) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`id`, `fname`, `lname`, `username`, `password`) VALUES
(1, 'karen', 'titiwa', 'superadmin', 'superadmin'),
(1, 'karen', 'titiwa', 'superadmin', 'superadmin');

-- --------------------------------------------------------

--
-- Table structure for table `transient`
--

DROP TABLE IF EXISTS `transient`;
CREATE TABLE IF NOT EXISTS `transient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(45) NOT NULL,
  `type` enum('room','house') NOT NULL,
  `status` enum('reserved','occupied','available') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `f_name` varchar(45) NOT NULL,
  `l_name` varchar(45) NOT NULL,
  `acc_type` enum('superadmin','admin','provider','customer') NOT NULL,
  `email_add` varchar(45) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `profile_img` blob,
  `phone_number` varchar(13) DEFAULT NULL,
  `status` enum('approved','pending') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `f_name`, `l_name`, `acc_type`, `email_add`, `pass`, `birthdate`, `profile_img`, `phone_number`, `status`) VALUES
(1, 'princess', 'Princess', 'Dacapias', 'provider', 'ces@gmail.com', 'princess', '1998-05-09', NULL, '+639192544271', 'approved'),
(2, 'dominic', 'Dominic', 'Gonzaga', 'provider', 'nic@gmail.com', 'nic', '1998-03-22', NULL, '+639192544275', 'approved'),
(3, 'gaspar', 'Gaspar', 'Monoten', 'customer', 'gaspar@gmail.com', 'gaspar', '1997-05-10', NULL, '+639192544278', 'approved'),
(4, 'rafa', 'Rapha', 'Meija', 'customer', 'rafa@gmail.com', 'rafa', '1997-05-23', NULL, '+639192544279', 'approved'),
(5, 'karen', 'Karen', 'Titiwa', 'superadmin', 'karen@gmail.com', 'karen', '1999-09-08', NULL, '+639123544270', 'approved'),
(7, 'ic', 'Lawrence Christian', 'Pagalanan', 'provider', 'ic@gmail.com', 'ic', '1997-02-15', NULL, '+639192544274', 'approved'),
(8, 'abi', 'Abigail', 'Rubrico', 'provider', 'abi@gmail.com', 'abi', '1998-03-09', NULL, '+639192464277', 'approved'),
(10, 'admin', 'Admin', 'Admin', 'admin', 'admin@gmail.com', 'admin', '1987-05-12', NULL, '+639192454270', 'approved'),
(11, 'superadmin', 'Super', 'Admin', 'superadmin', 'superadmin@gmail.com', 'superadmin', '1987-05-12', NULL, '+639192664274', 'approved'),
(12, 'provider', 'Mr', 'Provider', 'provider', 'provider@gmail.com', 'provider', '1987-05-12', NULL, '+639192452276', 'approved'),
(14, 'ella', 'Ella', 'Magdalena', 'provider', 'ella@gmail.com', 'ella', '1987-05-12', NULL, '+639192544273', 'pending'),
(15, 'coco', 'Coco', 'Martin', 'provider', 'coco@gmail.com', 'coco', '1978-12-13', NULL, '+639192544273', 'pending'),
(16, 'maria', 'Maria', 'Concepcion', 'customer', 'maria@hotmail.com', 'maria', '1982-05-07', NULL, '+639192544273', 'pending'),
(17, 'maribel', 'Maan', 'Uake', 'customer', 'maribel@yahoo.com', 'maribel', '1990-12-09', NULL, '+639192544273', 'approved'),
(18, 'antonia', 'Antonia', 'Laone', 'customer', 'nina@yahoo.com', 'antonia', '1982-05-07', NULL, '+639192534273', 'approved'),
(20, 'zac', 'Ana', 'Tilo', 'customer', 'zac@hotmail.com', 'zac', '1982-05-07', NULL, '+639192567273', 'approved'),
(21, 'cecil', 'Camil', 'Merceded', 'provider', 'cecil@hotmail.com', 'cecil', '1998-03-09', NULL, '+639192544273', 'pending'),
(23, 'ryan', 'Ryan', 'Bang', 'customer', 'ryan@gmail.com', 'ryan', '1990-12-09', NULL, '+639192544273', 'pending'),
(25, 'dan', 'Dan', 'Sebastian', 'provider', 'dan@dslu.edu.ph', 'dan', '1990-12-09', NULL, '+639192544273', 'pending'),
(39, 'jim', 'Jim', 'Boy', 'admin', 'boy@yahoo.com', 'jim', NULL, NULL, '09232544273', 'approved'),
(40, 'jim', 'Jim', 'Boy', 'admin', 'boy@yahoo.com', 'jim', NULL, NULL, '09232544273', 'approved'),
(41, 'jim', 'Jim', 'Boy', 'admin', 'boy@yahoo.com', 'jim', NULL, NULL, '09232544273', 'approved');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD CONSTRAINT `sv_id` FOREIGN KEY (`sv_id`) REFERENCES `service_provider` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `id` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `house`
--
ALTER TABLE `house`
  ADD CONSTRAINT `house_id` FOREIGN KEY (`id`) REFERENCES `transient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `customer` FOREIGN KEY (`customer`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_provider` FOREIGN KEY (`service_provider`) REFERENCES `service_provider` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`);

--
-- Constraints for table `pay_reserve`
--
ALTER TABLE `pay_reserve`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customer`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pay_id` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`),
  ADD CONSTRAINT `reserve_id` FOREIGN KEY (`ressrvation_id`) REFERENCES `reservations` (`id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `payment_id` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `hose-id` FOREIGN KEY (`house`) REFERENCES `house` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `room-id` FOREIGN KEY (`id`) REFERENCES `transient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `saves`
--
ALTER TABLE `saves`
  ADD CONSTRAINT `custome_id` FOREIGN KEY (`customer`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transient_id` FOREIGN KEY (`transient`) REFERENCES `transient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
