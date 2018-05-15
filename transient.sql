CREATE DATABASE  IF NOT EXISTS `transient` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `transient`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: transient
-- ------------------------------------------------------
-- Server version	5.7.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer-id` int(11) NOT NULL,
  `room-id` int(11) NOT NULL,
  `date-booked` date NOT NULL,
  `check-in` date NOT NULL,
  `check-out` date NOT NULL,
  `payment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `payment-id_idx` (`payment_id`),
  CONSTRAINT `payment-id` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,3,10,'2018-12-12','2018-12-12','2018-12-13',1);
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `house`
--

DROP TABLE IF EXISTS `house`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `house` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service-provider` int(11) NOT NULL,
  `address` varchar(45) NOT NULL,
  `no_CR` int(11) NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` longtext NOT NULL,
  `rules` longtext NOT NULL,
  `amenities` longtext NOT NULL,
  `cancellations` longtext NOT NULL,
  `price` float NOT NULL,
  `no_room` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `service_provider_idx` (`service-provider`),
  CONSTRAINT `service_provider` FOREIGN KEY (`service-provider`) REFERENCES `service-provider` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `house`
--

LOCK TABLES `house` WRITE;
/*!40000 ALTER TABLE `house` DISABLE KEYS */;
INSERT INTO `house` VALUES (1,1,'address',1,23.8518,129.663,'Mountain Views','Modern 1BR apt perched hilltop offering stunning views of the nearby golf course and surrounding mountains in a quiet neighborhood close to Bencab Museum creates a perfect relaxing vibe. Perfect for a couple, specially golfers and adventurists.','No smoking, Not suitable for pets, No parties or events, Check-in is anytime after 2PM, Check out by 10AM','Iron, Central heating, Towels, bed sheets, soap, and toilet paper, Free parking, Breakfast, Kitchen, Private entrance, Hair dryer, Shampoo, Hangers','Strict – free cancellation within 48 hours of booking',1259,1),(2,2,'bahay',1,17.9918,120.593,'AJ Home and Garden','AJ Home and Garden is located in a gated family compound. The interior is a combination of concrete and mostly wood paneling including pinewood. At night, the paper moon lantern makes a beautiful reflection on the picture windows in the dining, and in the lounge area. Guests may enjoy viewing a part of the city and sunrise, from the garden. We are within walking distance to Petron Gasoline Station at Marcos Highway Junction, satellite markets, sari sari stores and canteen.','No smoking, Not suitable for pets, No parties or events, Check-in is anytime after 2PM, Check out by 10AM','Wifi, Free parking on premises, Kitchen, Essentials, Hangers, TV','Cancel up to 24 hours before check in and get a full refund (minus service fees). Cancel within 24 hours of your trip and the first night is non-refundable. Service fees are refunded when cancellation happens before check in and within 48 hours of booking.',2991,2),(3,2,'bahay2',1,15.8518,122.663,'Balakabac','Safe and quiet location, approximately 10-15 minutes drive to downtown - Burham Park, Kennon Road/Marcos Highway and easy way to come to Balacbac National Road.','No smoking, Not suitable for pets, No parties or events, Check-in time is 9AM - 12PM (noon), Check out by 2PM','Iron, Central heating, Towels, bed sheets, soap, and toilet paper, Free parking, Breakfast, Kitchen, Private entrance, Hair dryer, Shampoo, Hangers','Cancel up to 24 hours before check in and get a full refund (minus service fees). Cancel within 24 hours of your trip and the first night is non-refundable. Service fees are refunded when cancellation happens before check in and within 48 hours of booking.',525,1),(4,7,'bahay ni nic',1,23.8518,129.663,'Le Coq Bleu','Welcome to our cottage,it is NOT a B&B, NOT a transient house. We live here without maids or helpers. We enjoy sharing it with people looking for a home stay experience. This is our home so we expect our guests to be considerate!','No smoking, Not suitable for pets, No parties or events, Check-in time is 9AM - 12PM (noon), Check out by 2PM','Wifi, Indoor fireplace, Towels, bed sheets, soap, and toilet paper, Breakfast, Hair dryer, Hangers, First aid kit','Cancel up to 5 days before check in and get a full refund (minus service fees). Cancel within 5 days of your trip and the first night is non-refundable, but 50% of the cost for the remaining nights will be refunded. Service fees are refunded when cancellation happens before check in and within 48 hours of booking.',2204,1),(5,3,'bay',1,129.663,23.8518,'Princeton','Cozy Studio type condo with the basic needs for a traveler. Worry free and feel at home. Update your social media life thru wifi connection.','No smoking, Not suitable for pets, No parties or events, Check-in time is 2PM - 6PM, Check out by 11AM','Iron, Central heating, Towels, bed sheets, soap, and toilet paper, Free parking, Breakfast, Kitchen, Private entrance, Hair dryer, Shampoo, Hangers','Cancel up to 5 days before check in and get a full refund (minus service fees). Cancel within 5 days of your trip and the first night is non-refundable, but 50% of the cost for the remaining nights will be refunded. Service fees are refunded when cancellation happens before check in and within 48 hours of booking.',944,2),(6,6,'hay',1,129.663,23.8518,'The Red Willow','The Red Willow is a beautiful villa made of mahogany and pine. It is nestled in a bamboo and pine grove. It\'s the perfect place for relaxing with your family and friends.','No smoking, Not suitable for pets, No parties or events, Check-in is anytime after 2PM, Check out by 12PM (noon)','Iron, Central heating, Towels, bed sheets, soap, and toilet paper, Free parking, Breakfast, Kitchen, Private entrance, Hair dryer, Shampoo, Hangers','Strict – free cancellation within 48 hours of booking',5981,2);
/*!40000 ALTER TABLE `house` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `house-images`
--

DROP TABLE IF EXISTS `house-images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `house-images` (
  `house-id` int(11) NOT NULL,
  `image` blob NOT NULL,
  PRIMARY KEY (`house-id`),
  CONSTRAINT `house_id` FOREIGN KEY (`house-id`) REFERENCES `house` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `house-images`
--

LOCK TABLES `house-images` WRITE;
/*!40000 ALTER TABLE `house-images` DISABLE KEYS */;
/*!40000 ALTER TABLE `house-images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment-date` date NOT NULL,
  `amount` float NOT NULL,
  `customer-id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer-id_idx` (`customer-id`),
  CONSTRAINT `customer-id` FOREIGN KEY (`customer-id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,'2011-05-05',2000,3);
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer-id` int(11) NOT NULL,
  `room-id` int(11) NOT NULL,
  `date-reserved` date NOT NULL,
  `check-in` date NOT NULL,
  `check-out` date NOT NULL,
  `status` enum('reserved','booked') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `customer_id_idx` (`customer-id`),
  KEY `room_id_idx` (`room-id`),
  CONSTRAINT `customer_id` FOREIGN KEY (`customer-id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `room_id` FOREIGN KEY (`room-id`) REFERENCES `room` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (1,3,10,'2018-12-12','2018-12-12','2018-12-13','booked');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `customer-id` int(11) NOT NULL,
  `house-id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `message` mediumtext NOT NULL,
  `date-reviewed` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `house_id_idx` (`house-id`),
  KEY `customer-id_idx` (`customer-id`),
  CONSTRAINT `cust_id` FOREIGN KEY (`customer-id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `house-id` FOREIGN KEY (`house-id`) REFERENCES `house` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` int(11) NOT NULL,
  `no_beds` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `house_id_idx` (`house_id`),
  KEY `houseid_idx` (`house_id`),
  CONSTRAINT `houseid` FOREIGN KEY (`house_id`) REFERENCES `house` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (5,250,1,2),(6,250,1,2),(7,250,1,2),(8,20,1,3),(9,80,1,3),(10,80,1,4);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service-provider`
--

DROP TABLE IF EXISTS `service-provider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service-provider` (
  `id` int(11) NOT NULL,
  `address` varchar(199) NOT NULL,
  `business-permit` blob NOT NULL,
  `bank-acc-no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `bank-acc-no_UNIQUE` (`bank-acc-no`),
  CONSTRAINT `sp_id` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service-provider`
--

LOCK TABLES `service-provider` WRITE;
/*!40000 ALTER TABLE `service-provider` DISABLE KEYS */;
INSERT INTO `service-provider` VALUES (1,'CAR Benguet Baguio Bakakeng Central Diwata Street 47','?',182439718),(2,'testing','null',127318273),(3,'CAR Benguet Baguio Bakakeng Central Diwata Street 47','?',1231200),(5,'CAR Benguet Baguio Bakakeng Central Diwata Street 47','?',172381273),(6,'CAR Benguet Baguio Bakakeng Central Diwata Street 47','null',123812300),(7,'CAR Benguet Baguio Bakakeng Central Diwata Street 47','null',123456789);
/*!40000 ALTER TABLE `service-provider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
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
  `status` enum('pending','active','deactivated') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_add_UNIQUE` (`email_add`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'testing','nic','gon','testing@gmail.com','12345678','639359250701','admin',NULL,'1964-09-18',NULL),(2,'user2','test','last','test@ya.com','12345678','639359250700','provider',NULL,'2011-05-05',NULL),(3,'user3','testa','wlast','testa@ya.com','12345678','639359250700','customer',NULL,'2011-05-05',NULL),(5,'user4','testa','wlasta','tesaata@ya.com','12345678','637559250700','customer',NULL,'2011-05-05',NULL),(6,'fish@ocean.com','fish ',' tadpole','fish@ocean.com','12345678','637559250700','provider',NULL,'2017-05-05',NULL),(7,'dominic@abang.com','nic ',' tadpole','dominic@abang.com','12345678','637559250700','provider',NULL,'2017-05-05',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-15 23:52:44
