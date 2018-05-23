-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 17, 2018 at 09:31 PM
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
-- Database: `transient`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer-id` int(11) NOT NULL,
  `room-id` int(11) NOT NULL,
  `date-booked` date NOT NULL,
  `check-in` date NOT NULL,
  `check-out` date NOT NULL,
  `payment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `payment-id_idx` (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `customer-id`, `room-id`, `date-booked`, `check-in`, `check-out`, `payment_id`) VALUES
(1, 3, 10, '2018-12-12', '2018-12-12', '2018-12-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

DROP TABLE IF EXISTS `house`;
CREATE TABLE IF NOT EXISTS `house` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service-provider` int(11) NOT NULL,
  `address` varchar(45) CHARACTER SET utf8 NOT NULL,
  `no_CR` int(11) NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float UNSIGNED NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 NOT NULL,
  `description` longtext CHARACTER SET utf8 NOT NULL,
  `rules` longtext CHARACTER SET utf8 NOT NULL,
  `amenities` longtext CHARACTER SET utf8 NOT NULL,
  `cancellations` longtext CHARACTER SET utf8 NOT NULL,
  `price` float NOT NULL,
  `no_room` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `service_provider_idx` (`service-provider`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`id`, `service-provider`, `address`, `no_CR`, `longitude`, `latitude`, `name`, `description`, `rules`, `amenities`, `cancellations`, `price`, `no_room`) VALUES
(1, 1, 'address', 1, 23.8518, 129.663, 'Mountain Views', 'Modern 1BR apt perched hilltop offering stunning views of the nearby golf course and surrounding mountains in a quiet neighborhood close to Bencab Museum creates a perfect relaxing vibe. Perfect for a couple, specially golfers and adventurists.', 'No smoking, Not suitable for pets, No parties or events, Check-in is anytime after 2PM, Check out by 10AM', 'Iron, Central heating, Towels, bed sheets, soap, and toilet paper, Free parking, Breakfast, Kitchen, Private entrance, Hair dryer, Shampoo, Hangers', 'Strict – free cancellation within 48 hours of booking', 1259, 1),
(2, 2, 'bahay', 1, 17.9918, 120.593, 'AJ Home and Garden', 'AJ Home and Garden is located in a gated family compound. The interior is a combination of concrete and mostly wood paneling including pinewood. At night, the paper moon lantern makes a beautiful reflection on the picture windows in the dining, and in the lounge area. Guests may enjoy viewing a part of the city and sunrise, from the garden. We are within walking distance to Petron Gasoline Station at Marcos Highway Junction, satellite markets, sari sari stores and canteen.', 'No smoking, Not suitable for pets, No parties or events, Check-in is anytime after 2PM, Check out by 10AM', 'Wifi, Free parking on premises, Kitchen, Essentials, Hangers, TV', 'Cancel up to 24 hours before check in and get a full refund (minus service fees). Cancel within 24 hours of your trip and the first night is non-refundable. Service fees are refunded when cancellation happens before check in and within 48 hours of booking.', 2991, 2),
(3, 2, 'bahay2', 1, 15.8518, 122.663, 'Balakabac', 'Safe and quiet location, approximately 10-15 minutes drive to downtown - Burham Park, Kennon Road/Marcos Highway and easy way to come to Balacbac National Road.', 'No smoking, Not suitable for pets, No parties or events, Check-in time is 9AM - 12PM (noon), Check out by 2PM', 'Iron, Central heating, Towels, bed sheets, soap, and toilet paper, Free parking, Breakfast, Kitchen, Private entrance, Hair dryer, Shampoo, Hangers', 'Cancel up to 24 hours before check in and get a full refund (minus service fees). Cancel within 24 hours of your trip and the first night is non-refundable. Service fees are refunded when cancellation happens before check in and within 48 hours of booking.', 525, 1),
(4, 7, 'bahay ni nic', 1, 23.8518, 129.663, 'Le Coq Bleu', 'Welcome to our cottage,it is NOT a B&B, NOT a transient house. We live here without maids or helpers. We enjoy sharing it with people looking for a home stay experience. This is our home so we expect our guests to be considerate!', 'No smoking, Not suitable for pets, No parties or events, Check-in time is 9AM - 12PM (noon), Check out by 2PM', 'Wifi, Indoor fireplace, Towels, bed sheets, soap, and toilet paper, Breakfast, Hair dryer, Hangers, First aid kit', 'Cancel up to 5 days before check in and get a full refund (minus service fees). Cancel within 5 days of your trip and the first night is non-refundable, but 50% of the cost for the remaining nights will be refunded. Service fees are refunded when cancellation happens before check in and within 48 hours of booking.', 2204, 1),
(5, 3, 'bay', 1, 129.663, 23.8518, 'Princeton', 'Cozy Studio type condo with the basic needs for a traveler. Worry free and feel at home. Update your social media life thru wifi connection.', 'No smoking, Not suitable for pets, No parties or events, Check-in time is 2PM - 6PM, Check out by 11AM', 'Iron, Central heating, Towels, bed sheets, soap, and toilet paper, Free parking, Breakfast, Kitchen, Private entrance, Hair dryer, Shampoo, Hangers', 'Cancel up to 5 days before check in and get a full refund (minus service fees). Cancel within 5 days of your trip and the first night is non-refundable, but 50% of the cost for the remaining nights will be refunded. Service fees are refunded when cancellation happens before check in and within 48 hours of booking.', 944, 2),
(6, 6, 'hay', 1, 129.663, 23.8518, 'The Red Willow', 'The Red Willow is a beautiful villa made of mahogany and pine. It is nestled in a bamboo and pine grove. It\'s the perfect place for relaxing with your family and friends.', 'No smoking, Not suitable for pets, No parties or events, Check-in is anytime after 2PM, Check out by 12PM (noon)', 'Iron, Central heating, Towels, bed sheets, soap, and toilet paper, Free parking, Breakfast, Kitchen, Private entrance, Hair dryer, Shampoo, Hangers', 'Strict – free cancellation within 48 hours of booking', 5981, 2);

-- --------------------------------------------------------

--
-- Table structure for table `house-images`
--

DROP TABLE IF EXISTS `house-images`;
CREATE TABLE IF NOT EXISTS `house-images` (
  `house-id` int(11) NOT NULL,
  `image` blob NOT NULL,
  PRIMARY KEY (`house-id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment-date` date NOT NULL,
  `amount` float NOT NULL,
  `customer-id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer-id_idx` (`customer-id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `payment-date`, `amount`, `customer-id`) VALUES
(1, '2011-05-05', 2000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer-id` int(11) NOT NULL,
  `room-id` int(11) NOT NULL,
  `date-reserved` date NOT NULL,
  `check-in` date NOT NULL,
  `check-out` date NOT NULL,
  `status` enum('reserved','booked') CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `customer_id_idx` (`customer-id`),
  KEY `room_id_idx` (`room-id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `customer-id`, `room-id`, `date-reserved`, `check-in`, `check-out`, `status`) VALUES
(1, 3, 10, '2018-12-12', '2018-12-12', '2018-12-13', 'booked');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL,
  `customer-id` int(11) NOT NULL,
  `house-id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `message` mediumtext CHARACTER SET utf8 NOT NULL,
  `date-reviewed` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `house_id_idx` (`house-id`),
  KEY `customer-id_idx` (`customer-id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` int(11) NOT NULL,
  `no_beds` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `house_id_idx` (`house_id`),
  KEY `houseid_idx` (`house_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `area`, `no_beds`, `house_id`) VALUES
(5, 250, 1, 2),
(6, 250, 1, 2),
(7, 250, 1, 2),
(8, 20, 1, 3),
(9, 80, 1, 3),
(10, 80, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `service-provider`
--

DROP TABLE IF EXISTS `service-provider`;
CREATE TABLE IF NOT EXISTS `service-provider` (
  `id` int(11) NOT NULL,
  `address` varchar(199) CHARACTER SET utf8 NOT NULL,
  `business-permit` blob NOT NULL,
  `bank-acc-no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `bank-acc-no_UNIQUE` (`bank-acc-no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service-provider`
--

INSERT INTO `service-provider` (`id`, `address`, `business-permit`, `bank-acc-no`) VALUES
(1, 'CAR Benguet Baguio Bakakeng Central Diwata Street 47', 0x3f, 182439718),
(2, 'testing', 0x6e756c6c, 127318273),
(3, 'CAR Benguet Baguio Bakakeng Central Diwata Street 47', 0x3f, 1231200),
(5, 'CAR Benguet Baguio Bakakeng Central Diwata Street 47', 0x3f, 172381273),
(6, 'CAR Benguet Baguio Bakakeng Central Diwata Street 47', 0x6e756c6c, 123812300),
(7, 'CAR Benguet Baguio Bakakeng Central Diwata Street 47', 0x6e756c6c, 123456789);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `service_provider_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `amount` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `customer_id_idx` (`customer_id`),
  KEY `service_provider_id_idx` (`service_provider_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `f_name` varchar(45) NOT NULL,
  `l_name` varchar(45) NOT NULL,
  `email_add` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `acc_type` enum('superadmin','admin','customer','provider') NOT NULL,
  `profile_img` blob,
  `birthday` date NOT NULL,
  `status` enum('pending','active','deactivated','approved','disabled','rejected','enabled') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_add_UNIQUE` (`email_add`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `f_name`, `l_name`, `email_add`, `password`, `phone`, `acc_type`, `profile_img`, `birthday`, `status`) VALUES
(1, 'testing', 'nic', 'gon', 'testing@gmail.com', '12345678', '639359250701', 'admin', NULL, '1964-09-18', NULL),
(2, 'user2', 'test', 'last', 'test@ya.com', '12345678', '639359250700', 'provider', NULL, '2011-05-05', NULL),
(3, 'user3', 'testa', 'wlast', 'testa@ya.com', '12345678', '639359250700', 'customer', NULL, '2011-05-05', NULL),
(5, 'user4', 'testa', 'wlasta', 'tesaata@ya.com', '12345678', '637559250700', 'customer', NULL, '2011-05-05', NULL),
(6, 'fish@ocean.com', 'fish ', ' tadpole', 'fish@ocean.com', '12345678', '637559250700', 'provider', NULL, '2017-05-05', NULL),
(7, 'dominic@abang.com', 'nic ', ' tadpole', 'dominic@abang.com', '12345678', '637559250700', 'provider', NULL, '2017-05-05', NULL),
(8, 'superadmin', 'Superadmin', 'Superadmin', 'superadmin@gmail.com', '17c4520f6cfd1ab53d8745e84681eb49', '09302854814', 'superadmin', NULL, '1999-09-08', 'approved'),
(9, 'admin', 'Admin', 'Admin', 'admin@gmail.com', '17c4520f6cfd1ab53d8745e84681eb49', '09187466375', 'admin', NULL, '2000-05-25', 'enabled'),
(10, 'dominic', 'Dominic', 'Gonzaga', 'nicgon@gmail.com', 'dominic', '09359820701', 'customer', NULL, '1998-11-22', 'enabled'),
(11, 'ledor', 'Jannledor', 'Pingalo', 'ledor@yahoo.com', 'ledor', '09876533895', 'admin', NULL, '1995-05-07', 'deactivated'),
(12, 'jana', 'Jan Paula', 'San Juan', 'jana@gmaill.com', 'jana', '09756822748', 'admin', NULL, '1998-05-08', 'enabled'),
(13, 'graham', 'Graham', 'Flora', 'graham@gmail.com', 'graham', '0987902885', 'admin', NULL, '1999-05-18', 'disabled'),
(14, 'ces', 'Princess Lyka', 'Dacapias', 'lyca@gmail.com', 'ces', '09789366578', 'customer', NULL, '2000-05-07', 'rejected'),
(15, 'ic', 'Lawrence', 'Pagalanan', 'ic@hotmail.com', 'scknajwdnefbcoiqw', '09398766574', 'customer', NULL, '1998-03-23', 'approved'),
(16, 'rafa', 'Rapha Lynne', 'Meija', 'rafa@yahoo.com', '$asdkcnas193nasdknva8', '09187633657', 'provider', NULL, '1997-05-01', 'disabled'),
(17, 'junjun', 'Gaspar', 'Monoten', 'junjun@hotmail.com', 'junjun', '09198739820', 'provider', NULL, '1998-05-11', 'pending'),
(18, 'justine', 'Justine', 'Dongayao', 'justine@yahoo.com', 'dongayao', '09890977654', 'provider', NULL, '1990-05-10', 'pending'),
(19, 'steph', 'Stephanie', 'Bulasao', 'steph@hotmail.com', 'steph', '09890167823', 'admin', NULL, '1997-05-09', 'enabled');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `payment-id` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `house`
--
ALTER TABLE `house`
  ADD CONSTRAINT `service_provider` FOREIGN KEY (`service-provider`) REFERENCES `service-provider` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `house-images`
--
ALTER TABLE `house-images`
  ADD CONSTRAINT `house_id` FOREIGN KEY (`house-id`) REFERENCES `house` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `customer-id` FOREIGN KEY (`customer-id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customer-id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `room_id` FOREIGN KEY (`room-id`) REFERENCES `room` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `cust_id` FOREIGN KEY (`customer-id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `house-id` FOREIGN KEY (`house-id`) REFERENCES `house` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `houseid` FOREIGN KEY (`house_id`) REFERENCES `house` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service-provider`
--
ALTER TABLE `service-provider`
  ADD CONSTRAINT `sp_id` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
