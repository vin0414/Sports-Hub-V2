-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: db_hub
-- ------------------------------------------------------
-- Server version	5.6.51-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `accountID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Fullname` varchar(45) DEFAULT NULL,
  `Role` varchar(45) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `Token` varchar(255) DEFAULT NULL,
  `DateCreated` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`accountID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'vinmogate@gmail.com','$2y$10$N0hJ6ststInC94JoYIwCB.dwoOO3drMSjm4ydVcC9psC6QUDpSL6O','Warvin B Mogate','Super-admin',1,'Jkee34222hgje33','2025-03-19'),(2,'john.doe@gmail.com','$2y$10$XVuSCr600rhkFESX0vPhi.Wyqbo.8Svx6FPHTS3bgafDl/5ObJG8q','John Doe','Media',1,'177d540f6867fd46b0f4793dc23c71b033e25863032884dc77d33922322cae3b','2025-03-21'),(3,'crisostomo.ibarra@gmail.com','$2y$10$PVUDpfjfpS5/boTsPBkjNuP3DIifvCWWiYhqGLnPIsWrtNGIHVd2q','Crisostomo I Ibarra','End-user',1,'3b63a4ce69dbad66da9b4eba00f10b8ff29410f15a10b33cbc3c6c256dfec943','2025-03-22');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `achievements`
--

DROP TABLE IF EXISTS `achievements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `achievements` (
  `achievement_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` longtext,
  `type` varchar(45) DEFAULT NULL,
  `criteria` longtext,
  `date_created` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`achievement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `achievements`
--

LOCK TABLES `achievements` WRITE;
/*!40000 ALTER TABLE `achievements` DISABLE KEYS */;
INSERT INTO `achievements` VALUES (1,'Sample of Title','Team Achievement','Team','Sample','2025-03-23'),(2,'Sample of Titles','Team Achievement','Team','Sample','2025-03-23');
/*!40000 ALTER TABLE `achievements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ads` (
  `ads_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `clicks` int(11) DEFAULT NULL,
  `start_date` varchar(45) DEFAULT NULL,
  `end_date` varchar(45) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `dateCreated` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ads_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ads`
--

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;
INSERT INTO `ads` VALUES (1,'Sample of Ads Title','20250410023944logo.jpg',0,0,'2025-04-10','2025-04-18','b3db387e74ac21e4fccb314d01b36e317550f5da3b93672a542e9e0ca6ba134f','2025-04-10'),(2,'The quick brown fox jumps over the lazy dog','20250410024332logo.jpg',0,0,'2024-04-11','2025-04-11','cdeb2d4059825b746a94d8b850aa2d09959c581dd6b7d6298ac7303f1a579ac8','2025-04-10');
/*!40000 ALTER TABLE `ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_messages`
--

DROP TABLE IF EXISTS `chat_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_messages`
--

LOCK TABLES `chat_messages` WRITE;
/*!40000 ALTER TABLE `chat_messages` DISABLE KEYS */;
INSERT INTO `chat_messages` VALUES (1,1,'Test only','2025-05-13 04:44:46','2025-05-13 04:44:46'),(2,1,'Would like to test the system','2025-05-13 04:44:58','2025-05-13 04:44:58');
/*!40000 ALTER TABLE `chat_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `codes`
--

DROP TABLE IF EXISTS `codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `codes` (
  `code_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`code_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codes`
--

LOCK TABLES `codes` WRITE;
/*!40000 ALTER TABLE `codes` DISABLE KEYS */;
INSERT INTO `codes` VALUES (1,'emLQzHRJeKjBJVmT','2025-05-15 12:05:32','2025-05-16 22:13:19');
/*!40000 ALTER TABLE `codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_registration`
--

DROP TABLE IF EXISTS `event_registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_registration` (
  `register_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `birth_date` varchar(45) DEFAULT NULL,
  `address` longtext,
  `status` int(11) DEFAULT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  `datecreated` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`register_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_registration`
--

LOCK TABLES `event_registration` WRITE;
/*!40000 ALTER TABLE `event_registration` DISABLE KEYS */;
INSERT INTO `event_registration` VALUES (1,1,'Juan Dela Cruz','juan.delacruz@gmail.com','09123456789','1990-04-14','Dasmarinas Cavite',1,'Passed','2025-04-07'),(2,1,'Juan Dela Cruz','juan.delacruz@gmail.com','09876543212','1990-04-14','Dasmarinas Cavite',0,'','2025-04-07');
/*!40000 ALTER TABLE `event_registration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) DEFAULT NULL,
  `event_title` varchar(255) DEFAULT NULL,
  `event_description` longtext,
  `event_location` varchar(255) DEFAULT NULL,
  `event_type` varchar(45) DEFAULT NULL,
  `sportsID` int(11) DEFAULT NULL,
  `start_date` varchar(45) DEFAULT NULL,
  `end_date` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `registration` int(11) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,1,'Super Bowl LVIII','Super Bowl LVIII will be the 58th annual championship game of the National Football League (NFL). The game will be held at Allegiant Stadium in Las Vegas, Nevada, marking the first time the city hosts the Super Bowl. The event will showcase the champions of the NFC and AFC conferences, where the two teams will compete for the title of NFL champion. In addition to the high-stakes game, the Super Bowl is known for its iconic halftime show, which in 2024 will feature a major musical performance, and its commercials, which are often as highly anticipated as the game itself. The Super Bowl attracts millions of viewers from around the world, making it one of the biggest sporting events globally.','Allegiant Stadium, Las Vegas, Nevada, USA','Competition',1,'2025-03-27','2025-03-27',1,1,'2025-03-25'),(2,1,'Spring Charity 5K Run','Join us for the annual Spring Charity 5K Run, where local runners and families come together to support our community\'s youth sports programs. Whether you\'re an experienced runner or just looking for a fun family activity, this event is for all ages and fitness levels.','Riverside Park, Downtown','Practice Game',2,'2025-04-10','2025-04-10',2,0,'2025-03-25'),(3,1,'sample event','description here','Savemore Salitran','Competition',1,'2025-04-27T10:00','2025-04-27T12:00',1,0,'2025-04-26');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(45) DEFAULT NULL,
  `accountID` int(11) DEFAULT NULL,
  `activities` longtext,
  `page` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'2025-03-21 21:24:33 pm',1,'Added new team : Team Ace','New Team'),(2,'2025-03-21 21:27:23 pm',1,'Update account for John Doe','Edit Account'),(3,'2025-03-21 22:25:00 pm',1,'Logged Out','logout page'),(4,'2025-03-21 22:25:11 pm',1,'Logged In','login page'),(5,'2025-03-21 22:33:02 pm',1,'Logged Out','logout page'),(6,'2025-03-22 09:35:25 am',1,'Logged In','login page'),(7,'2025-03-22 10:34:08 am',1,'Added new athlete','New Athlete'),(8,'2025-03-22 10:36:00 am',1,'Added new player role','Settings'),(9,'2025-03-22 10:50:15 am',1,'Added new athlete','New Athlete'),(10,'2025-03-22 11:04:26 am',1,'Added new athlete','New Athlete'),(11,'2025-03-22 11:18:49 am',1,'Logged Out','logout page'),(12,'2025-03-22 21:12:22 pm',1,'Logged In','login page'),(13,'2025-03-22 23:10:44 pm',1,'Logged Out','logout page'),(14,'2025-03-23 09:39:16 am',1,'Logged In','login page'),(15,'2025-03-23 15:09:52 pm',1,'Added new sports','Settings'),(16,'2025-03-23 15:10:02 pm',1,'Added new sports','Settings'),(17,'2025-03-23 15:25:16 pm',1,'Added new achievement','Settings'),(18,'2025-03-23 22:30:43 pm',1,'Logged Out','logout page'),(19,'2025-03-24 09:03:16 am',1,'Logged In','login page'),(20,'2025-03-24 11:10:28 am',1,'Update existing athlete','Edit Athlete'),(21,'2025-03-24 11:12:10 am',1,'Update existing athlete','Edit Athlete'),(22,'2025-03-24 11:20:29 am',1,'Update existing athlete','Edit Athlete'),(23,'2025-03-24 15:19:10 pm',1,'Update existing athlete','Edit Athlete'),(24,'2025-03-24 15:19:35 pm',1,'Added new player role','Settings'),(25,'2025-03-24 15:19:46 pm',1,'Added new player role','Settings'),(26,'2025-03-24 15:20:06 pm',1,'Added new player role','Settings'),(27,'2025-03-24 17:00:15 pm',1,'Edit shop : Olympic Village','Shops'),(28,'2025-03-24 17:03:23 pm',1,'Added new shop : Robinsons Place Dasmariñas','Shops'),(29,'2025-03-24 18:10:54 pm',1,'Logged Out','logout page'),(30,'2025-03-25 09:08:22 am',1,'Logged In','login page'),(31,'2025-03-25 09:31:12 am',1,'Edit shop : Walter Dasmarinas','Shops'),(32,'2025-03-25 11:09:03 am',1,'Added new event','New Event'),(33,'2025-03-25 11:18:42 am',1,'Added new shop : The District Imus','Shops'),(34,'2025-03-25 11:21:21 am',1,'Added new shop : Central Mall, Salitran Dasmarinas','Shops'),(35,'2025-03-25 11:31:59 am',1,'Added new shop : Vista Mall General Trias','Shops'),(36,'2025-03-25 13:28:39 pm',1,'Added new event','New Event'),(37,'2025-03-25 13:56:40 pm',1,'Cancelled the selected event','Manage Event'),(38,'2025-03-25 14:29:34 pm',1,'Logged Out','logout page'),(39,'2025-03-25 14:29:43 pm',2,'Logged In','login page'),(40,'2025-03-25 14:32:17 pm',2,'Logged Out','logout page'),(41,'2025-03-25 14:32:25 pm',1,'Logged In','login page'),(42,'2025-03-25 15:09:45 pm',1,'Rejected the selected event','Manage Event'),(43,'2025-03-25 18:01:47 pm',1,'Logged Out','logout page'),(44,'2025-03-26 09:07:43 am',1,'Logged In','login page'),(45,'2025-03-26 17:54:38 pm',1,'Logged In','login page'),(46,'2025-03-26 18:18:36 pm',1,'Logged Out','logout page'),(47,'2025-03-27 08:53:48 am',1,'Logged In','login page'),(48,'2025-03-27 18:00:26 pm',1,'Logged Out','logout page'),(49,'2025-03-28 09:10:37 am',1,'Logged In','login page'),(50,'2025-03-28 14:41:04 pm',1,'Logged Out','logout page'),(51,'2025-03-31 08:54:10 am',1,'Logged In','login page'),(52,'2025-03-31 08:57:47 am',1,'Uploaded new video','Upload'),(53,'2025-03-31 10:21:17 am',1,'Logged Out','logout page'),(54,'2025-04-02 08:59:49 am',1,'Logged In','login page'),(55,'2025-04-02 14:53:47 pm',1,'Edit the selected video','Upload'),(56,'2025-04-02 17:25:56 pm',1,'Logged Out','logout page'),(57,'2025-04-02 17:26:05 pm',1,'Logged In','login page'),(58,'2025-04-02 17:36:26 pm',1,'Logged Out','logout page'),(59,'2025-04-03 09:08:24 am',1,'Logged In','login page'),(60,'2025-04-03 10:01:33 am',1,'Logged Out','logout page'),(61,'2025-04-03 10:01:41 am',NULL,'Logged Out','logout page'),(62,'2025-04-03 10:01:47 am',NULL,'Logged Out','logout page'),(63,'2025-04-03 10:01:52 am',NULL,'Logged Out','logout page'),(64,'2025-04-03 12:49:29 pm',1,'Logged In','login page'),(65,'2025-04-03 12:49:34 pm',1,'Logged Out','logout page'),(66,'2025-04-03 12:50:42 pm',1,'Logged In','login page'),(67,'2025-04-03 13:08:28 pm',1,'Logged Out','logout page'),(68,'2025-04-03 16:00:58 pm',1,'Logged In','login page'),(69,'2025-04-03 16:09:51 pm',1,'Logged Out','logout page'),(70,'2025-04-07 13:37:00 pm',1,'Logged In','login page'),(71,'2025-04-07 16:39:27 pm',1,'Logged Out','logout page'),(72,'2025-04-08 09:33:34 am',1,'Logged In','login page'),(73,'2025-04-08 13:21:41 pm',1,'Logged Out','logout page'),(74,'2025-04-08 13:45:13 pm',1,'Logged In','login page'),(75,'2025-04-08 13:48:43 pm',1,'Logged Out','logout page'),(76,'2025-04-08 13:49:42 pm',1,'Logged In','login page'),(77,'2025-04-08 13:49:46 pm',1,'Logged Out','logout page'),(78,'2025-04-10 08:58:42 am',1,'Logged In','login page'),(79,'2025-04-10 10:39:44 am',1,'Added new ads : Sample of Ads Title','Sponsors'),(80,'2025-04-10 10:43:33 am',1,'Added new ads : hello World','Sponsors'),(81,'2025-04-10 11:35:41 am',1,'modify ads : The quick brown fox jumps over the lazy dog','Sponsors'),(82,'2025-04-10 11:38:29 am',1,'Logged Out','logout page'),(83,'2025-04-10 20:24:44 pm',1,'Logged In','login page'),(84,'2025-04-10 20:25:27 pm',1,'Logged Out','logout page'),(85,'2025-04-12 19:15:23 pm',1,'Logged In','login page'),(86,'2025-04-12 20:16:46 pm',1,'Logged Out','logout page'),(87,'2025-04-26 09:22:04 am',1,'Logged In','login page'),(88,'2025-04-26 09:33:43 am',1,'Added new event','New Event'),(89,'2025-04-26 10:02:32 am',1,'Logged Out','logout page'),(90,'2025-04-28 21:21:25 pm',1,'Logged In','login page'),(91,'2025-04-28 21:33:28 pm',1,'Logged Out','logout page'),(92,'2025-05-03 12:15:55 pm',1,'Logged In','login page'),(93,'2025-05-03 12:51:20 pm',1,'Logged Out','logout page'),(94,'2025-05-03 14:58:27 pm',1,'Logged In','login page'),(95,'2025-05-03 15:10:02 pm',1,'Logged Out','logout page'),(96,'2025-05-13 20:33:55 pm',1,'Logged In','login page'),(97,'2025-05-13 20:34:00 pm',1,'Logged In','login page'),(98,'2025-05-13 20:37:08 pm',1,'Logged Out','logout page'),(99,'2025-05-13 20:52:27 pm',1,'Logged In','login page'),(100,'2025-05-13 22:09:53 pm',1,'Logged Out','logout page'),(101,'2025-05-15 19:44:08 pm',1,'Logged In','login page'),(102,'2025-05-15 20:12:57 pm',1,'Logged Out','logout page'),(103,'2025-05-17 06:08:41 am',1,'Logged In','login page'),(104,'2025-05-17 06:30:21 am',1,'Logged Out','logout page'),(105,'2025-08-15 19:40:11 pm',1,'Logged In','login page'),(106,'2025-08-15 19:44:33 pm',1,'Logged Out','logout page'),(107,'2025-08-16 09:29:45 am',1,'Reset password','Accounts'),(108,'2025-08-16 09:29:50 am',1,'Reset password','Accounts'),(109,'2025-08-16 11:01:50 am',1,'Added new user permission','Settings'),(110,'2025-08-16 11:07:26 am',1,'Added new user permission','Settings'),(111,'2025-08-16 11:18:22 am',1,'Update account for John Doe','Edit Account'),(112,'2025-08-16 11:42:38 am',1,'Modify user permission','Settings'),(113,'2025-08-16 11:50:57 am',1,'Modify user permission','Settings'),(114,'2025-08-16 12:02:44 pm',1,'Modify user permission','Settings'),(115,'2025-08-16 14:43:03',1,'Logged In','Login Page'),(116,'2025-08-16 15:22:42 pm',1,'Modify user permission','Settings'),(117,'2025-08-16 15:25:21 pm',1,'Modify user permission','Settings'),(118,'2025-08-16 19:38:02',1,'Logged In','Login Page'),(119,'2025-08-16 19:53:52 pm',1,'Modify user permission','Settings'),(120,'2025-08-16 20:39:45 pm',1,'Modify user permission','Settings'),(121,'2025-08-17 11:18:34',1,'Logged In','Login Page'),(122,'2025-08-17 11:22:24',1,'Logged In','Login Page'),(123,'2025-08-22 15:51:00',1,'Logged In','Login Page');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `match_stats`
--

DROP TABLE IF EXISTS `match_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `match_stats` (
  `statsID` int(11) NOT NULL AUTO_INCREMENT,
  `match_id` int(11) DEFAULT NULL,
  `team1_score` int(11) DEFAULT NULL,
  `team2_score` int(11) DEFAULT NULL,
  `set_results` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`statsID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `match_stats`
--

LOCK TABLES `match_stats` WRITE;
/*!40000 ALTER TABLE `match_stats` DISABLE KEYS */;
/*!40000 ALTER TABLE `match_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matches`
--

DROP TABLE IF EXISTS `matches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matches` (
  `match_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(45) DEFAULT NULL,
  `time` varchar(45) DEFAULT NULL,
  `team1_id` int(11) DEFAULT NULL,
  `team1_score` int(11) DEFAULT NULL,
  `team2_id` int(11) DEFAULT NULL,
  `team2_score` int(11) DEFAULT NULL,
  `location` text,
  `result` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`match_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matches`
--

LOCK TABLES `matches` WRITE;
/*!40000 ALTER TABLE `matches` DISABLE KEYS */;
INSERT INTO `matches` VALUES (1,'2025-04-02','10:00',1,0,2,0,'Dasmarinas Cavite','-',0),(2,'2025-04-02','12:00',3,0,4,0,'Dasmarinas Cavite','-',0),(3,'2025-04-02','15:30',1,14,3,11,'Dasmarinas Cavite','Team One wins',0),(4,'2025-04-02','17:20',4,4,2,5,'Dasmarinas Cavite','Team Two wins',0),(5,'2025-04-03','09:30',1,18,2,22,'Dasmarinas Cavite','Team Two wins',0),(6,'2025-04-03','11:30',4,30,3,39,'Dasmarinas Cavite','Team Three wins',0),(7,'2025-04-03','17:00',4,0,2,0,'Dasmarinas Arena','-',1),(8,'2025-05-03','16:00',1,0,2,0,'Test only','-',1),(9,'2025-05-04','07:00',4,0,2,0,'Test again','-',1),(10,'2025-05-13','21:00',1,9,3,7,'Test match','Team One wins',0);
/*!40000 ALTER TABLE `matches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(45) DEFAULT NULL,
  `author` varchar(45) DEFAULT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `news_type` varchar(45) DEFAULT NULL,
  `details` longtext,
  `image` varchar(255) DEFAULT NULL,
  `headline` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `accountID` int(11) DEFAULT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'2025-03-27','Dyan Castillejo','Alex Eala dedicates historic Miami Open feat to Philippines','Badminton','<p><span style=\"color: rgb(0, 0, 0);\">MANILA — Alexandra Eala on Wednesday dedicated to the Philippines her huge upset at the Miami Open, where she defeated world number two Iga Swiatek to reach the semi-finals.</span></p><p><span style=\"color: rgb(0, 0, 0);\">Ranked 140th in the world, the 19-year-old Eala is the first woman from her country to reach the last eight of a WTA 1000 tournament.</span></p><p><span style=\"color: rgb(0, 0, 0);\">\"This is the dream. I have to enjoy,\" the Filipina wildcard said.</span></p><p><span style=\"color: rgb(0, 0, 0);\">\"It feels amazing because I know this is a historical achievement, which I dedicate to my country. It\'s also a huge personal achievement, and for that I\'d love to give myself and my team a pat on the back. It\'s not the end goal. Keep working,\" said Eala.</span></p><p><span style=\"color: rgb(0, 0, 0);\">Eala fired 10 winners in the opening set, catching Swiatek off-guard with her forehand down-the-line hits while also benefiting from a whopping 19 unforced errors from the Pole.</span></p><p><span style=\"color: rgb(0, 0, 0);\">Armed with momentum, Eala surged to a 2-0 lead in the second set before Swiatek found her rhythm, winning four straight games to take control. The Filipina teenager regrouped, however, and broke Swiatek for the eighth time at 6-5 to seal the win. </span></p><p><span style=\"color: rgb(0, 0, 0);\">\"Hindi ako makapaniwala. My mind was still on the match and was thinking the match was on, and I\'m super happy the ball went out,\" said Eala.</span></p><p><span style=\"color: rgb(0, 0, 0);\">\"Siyempre sa isip ko, kaya ko, bola na. The court is not the place to belittle yourself. For me, it\'s all about the mindset this week.\" she added. \"Now everything is coming out on court. I\'ve been training hard for a while… I\'m just so pleased to see the results.”</span></p><p><span style=\"color: rgb(0, 0, 0);\">Eala said she worked to stay composed after winning the first set and Swiatek taking the lead in the second.</span></p><p><span style=\"color: rgb(0, 0, 0);\">\"She bounced back, [with the] Iga fire that she has. It\'s something I\'ve been through many times with other opponents, but not Iga. I just had to treat it like it was another opponent that was trying to come back and still come back swinging,\" said the teenager from Quezon City.</span></p><p><span style=\"color: rgb(0, 0, 0);\">Eala has been in a professional setting since she was 13, when she left her homeland to join Rafael Nadal\'s academy in Mallorca.</span></p><p><span style=\"color: rgb(0, 0, 0);\">For the past six years, she has lived and breathed tennis alongside top coaches and a group of players all hoping to make the journey onto the tour.</span></p><p><span style=\"color: rgb(0, 0, 0);\">The twin influences on her career were evident in her box -- her parents had flown in from the Philippines for the game as had an uncle and cousin based in Seattle but sat with them was Toni Nadal, the Spanish great\'s uncle and former coach, representing the academy.</span></p><p><span style=\"color: rgb(0, 0, 0);\">\"These people have been the ones who have believed in me and supported me even when nothing was happening, so for them to be here when everything is happening, it just means the world,\" Eala said.</span></p><p><span style=\"color: rgb(0, 0, 0);\">\"I\'m so blessed to have my parents; I think I won the lottery with them.\"</span></p><p><span style=\"color: rgb(0, 0, 0);\">Eala will face the winner of Wednesday\'s quarter-final between Britain\'s Emma Raducanu and American Jessica Pegula. Semifinals will be played Thursday night(Friday morning in Manila).</span></p><p><span style=\"color: rgb(0, 0, 0);\">\"I know that they\'re both good, both fighters. Either one, a set of problems will be presented, and I have to deal with them.\" Eala said.</span></p><p><span style=\"color: rgb(0, 0, 0);\">“I\'m so excited. I\'m willing to die on the court tomorrow,\" she said.</span></p>','20250327035436download.jpg',1,1,1),(2,'2025-03-27','LLANESCA T. PANTI','Arroyo mourns death of Mendoza who defended her in plunder case','Basketball','<p>Former President and Pampanga Rep. Gloria Arroyo mourned the death of veteran lawyer Estelito Mendoza, who served as her counsel in the P366-million Philippine Charity Sweepstakes Office (PCSO) plunder case.</p><p>\"It was with profound sorrow that I learned of the passing of my lawyer, former Solicitor General, and former Governor of Pampanga, Estelito \"Titong\" Mendoza,\" Arroyo said in a statement.</p><p>\"Tatang Titong represented me in that [plunder] case in the Supreme Court and argued that the prosecution presented no evidence, testimonial or otherwise, showing even the remotest possibility that the confidential and intelligence funds of the PCSO (Philippine Charity Sweepstakes Office) had been diverted to me. I am eternally grateful to Tatang Titong,\" Arroyo added.</p><p>The Supreme Court decision that cleared Arroyo in the case was penned by then Supreme Court Associate Justice Lucas Bersamin, now the Executive Secretary of President Ferdinand Marcos, Jr.</p><p>Mendoza\'s death was announced by the Philippine National Bank (PNB) in a disclosure to the Philippine Stocks Exchange (PSE) on Wednesday, given that Mendoza was serving as a PNB Director prior to his death at 95 years old. --VAL, GMA Integrated News</p><p>Read more:</p><p>https://www.gmanetwork.com/news/topstories/nation/940719/arroyo-mourns-death-of-mendoza-who-defended-her-in-plunder-case/story/</p>','20250327051649Untitled_design_2025_03_27_12_29_02.jpg',1,1,1),(3,'2025-03-27','GMA Integrated News','NMIXX in Manila - Ticketing details fan benefits for fan concert in May','Basketball','<p>Prepare your wallets NSWERs, the ticketing details for the “NMIXX Change Up: Mixx Lab” concert in Manila have been released!</p><p>NMIXX will perform on May 2 at the SMX Convention Center in Pasay City.</p><p>According to event promoter Lunari Global via X (formerly Twitter), fans have five ticket tiers to choose from, ranging from P3,500 for Silver and P13,000 for VVIP Soundcheck and Hi Bye access.</p><p>Here are the ticket prices as follows:</p><p>Silver - P3,500</p><p>Gold - P6,000</p><p>Platinum - P8,000</p><p>VIP Soundcheck - P11,500</p><p>VVIP Soundcheck and Hi Bye - P13,000</p><p>Among the fan benefits given to VIP and VVIP ticket holders are a VIP lanyard and soundcheck access. Meanwhile, an exclusive photo card will be given to all fans regardless of ticket tier.</p><p>As for the signed poster, only 100 lucky fans from the VVIP, VIP, Platinum, and Gold sections will receive the benefit through a raffle draw.</p><p>Tickets will go on sale on March 31 via the Lunari Global website. No on-site ticket selling will be held.</p><p>NMIXX, which is currently composed of Lily, Haewon, Sullyoon, Jiwoo, Kyujin, and Bae, debuted under JYP Entertainment in 2022. Former member Jinni departed the group in the same year.</p><p>The girl group had a concert in Manila in June 2023 as part of its \"Nice to Mixx You\" tour and also attended the Asia Artist Awards at the Philippine Arena in Bulacan in December 2023.</p><p>Read more:</p><p>https://www.gmanetwork.com/news/lifestyle/hobbiesandactivities/940718/nmixx-in-manila-ticketing-details-fan-benefits-for-fan-concert-in-may/story/</p>','20250327052721ticket.jpg',1,1,1),(4,'2025-03-27','JP Rizal','The quick brown fox jumps','Basketball','<p>test</p>','20250327085240ticket.jpg',0,1,1);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `player_achievements`
--

DROP TABLE IF EXISTS `player_achievements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `player_achievements` (
  `player_achievement_id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) DEFAULT NULL,
  `achievement_id` int(11) DEFAULT NULL,
  `earned_at` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`player_achievement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player_achievements`
--

LOCK TABLES `player_achievements` WRITE;
/*!40000 ALTER TABLE `player_achievements` DISABLE KEYS */;
/*!40000 ALTER TABLE `player_achievements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `player_performance`
--

DROP TABLE IF EXISTS `player_performance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `player_performance` (
  `performance_id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) DEFAULT NULL,
  `match_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `sportsID` int(11) DEFAULT NULL,
  `stat_type` varchar(255) DEFAULT NULL,
  `stat_value` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `description` longtext,
  PRIMARY KEY (`performance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player_performance`
--

LOCK TABLES `player_performance` WRITE;
/*!40000 ALTER TABLE `player_performance` DISABLE KEYS */;
INSERT INTO `player_performance` VALUES (1,1,3,1,1,'PTS',3,'2025-04-02','-'),(2,1,3,1,1,'REB',2,'2025-04-02','-');
/*!40000 ALTER TABLE `player_performance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `player_role`
--

DROP TABLE IF EXISTS `player_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `player_role` (
  `roleID` int(11) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(255) DEFAULT NULL,
  `sportsName` varchar(255) DEFAULT NULL,
  `DateCreated` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`roleID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player_role`
--

LOCK TABLES `player_role` WRITE;
/*!40000 ALTER TABLE `player_role` DISABLE KEYS */;
INSERT INTO `player_role` VALUES (1,'Point Guard','Basketball','2025-03-20'),(2,'Center Guard','Basketball','2025-03-20'),(3,'Libero','Volleyball','2025-03-22'),(4,'Power Forward','Basketball','2025-03-24'),(5,'Small Forward','Basketball','2025-03-24'),(6,'Shooter Guard','Basketball','2025-03-24');
/*!40000 ALTER TABLE `player_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `players` (
  `player_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `mi` varchar(45) DEFAULT NULL,
  `date_of_birth` varchar(45) DEFAULT NULL,
  `sportsID` int(11) DEFAULT NULL,
  `roleID` int(11) DEFAULT NULL,
  `jersey_num` int(11) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `height` varchar(45) DEFAULT NULL,
  `weight` varchar(45) DEFAULT NULL,
  `address` longtext,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`player_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `players`
--

LOCK TABLES `players` WRITE;
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
INSERT INTO `players` VALUES (1,1,'Juan','Dela Cruz','D','1990-04-14',1,1,23,'female','juan.delacruz@gmail.com','166','65','Dasmarinas Cavite','20250324031210sample.jpg'),(2,1,'Crisostomo','Ibarra','I','1995-05-01',1,2,14,'male','crisostomo.ibarra@gmail.com','170','60','Sample Address here','20250322025014logo.png'),(3,1,'Lebron','James','S','1985-06-15',1,1,23,'male','lebron.james@gmail.com','178','68','Sample address here','20250322030426lebron.png'),(4,2,'Juan','Cruz','D','1990-04-14',2,1,0,'male','juan.delacruz@gmail.com','0','0','Dasmarinas Cavite',NULL);
/*!40000 ALTER TABLE `players` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shops` (
  `shop_id` int(11) NOT NULL AUTO_INCREMENT,
  `longitude` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `shop_name` varchar(255) DEFAULT NULL,
  `address` longtext,
  `website` varchar(255) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shops`
--

LOCK TABLES `shops` WRITE;
/*!40000 ALTER TABLE `shops` DISABLE KEYS */;
INSERT INTO `shops` VALUES (1,'120.94129700564284','14.325375018223006','Walter Dasmarinas','Dasmarinas City','https://www.waltermartdelivery.com.ph/stores/waltermart-dasmarinas','2025-03-25'),(2,'120.94014407882453','14.404572712255177','Proactive Sports Outlet Inc.','Unit D, Double Tree Building, 33 Aguinaldo Hwy, Imus, 4103 Cavite','N/A','2025-03-24'),(3,'120.94149978380307','14.413047004726616','Olympic Village','2/L, Robinsons Place Imus, Aguinaldo Highway corner Tanzang Luma Street, Imus, Cavite City, 4103','https://olympicvillageunited.com/','2025-03-24'),(4,'120.95040549074852','14.444363627261925','Toby\'s Sports SM Bacoor','SM Bacoor, Lowe Ground Floor, Aguinaldo Hwy, Bacoor, 4102 Cavite','https://www.tobys.com/','2025-03-24'),(5,'120.95664024353029','14.301760997122685','SM Dasmarinas','Governor\'s Drive corner Aguinaldo Highway, Brgy. Sampaloc 1, Dasmariñas City, Cavite, Philippines','https://www.smsupermalls.com/mall-directory/sm-city-dasmarinas/information#/','2025-03-24'),(6,'120.9537434577942','14.299900046443936','Robinsons Place Dasmariñas','Emilio Aguinaldo Highway, corner Governor\'s Dr, Sitio Palapala, Dasmariñas, 4114 Cavite','https://robinsonsmalls.com/mall-info/robinsons-place-dasmarinas','2025-03-24'),(7,'120.9394097328186','14.370605324500236','The District Imus','Daang Hari Road, cor Aguinaldo Hwy, Imus, Cavite','https://www.ayalamalls.com/main/malls/ayala-the-district-imus','2025-03-25'),(8,'120.93833684921266','14.349823281073464','Central Mall, Salitran Dasmarinas','Central Mall, Salitran Dasmarinas, Dasmariñas, Philippines','https://www.facebook.com/pages/Central-Mall-Salitran-Dasmarinas/1775853059410901','2025-03-25'),(9,'120.91208338737489','14.322864554619452','Vista Mall General Trias','8WF6+2XP, Arnaldo Hwy, General Trias, Cavite','https://www.vistamalls.com.ph/stores/general-trias/','2025-03-25');
/*!40000 ALTER TABLE `shops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sports`
--

DROP TABLE IF EXISTS `sports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sports` (
  `sportsID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
  `DateCreated` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`sportsID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sports`
--

LOCK TABLES `sports` WRITE;
/*!40000 ALTER TABLE `sports` DISABLE KEYS */;
INSERT INTO `sports` VALUES (1,'Basketball','2025-03-20'),(2,'Volleyball','2025-03-20'),(3,'Baseball','2025-03-20'),(4,'Soccer','2025-03-23'),(5,'Badminton','2025-03-23');
/*!40000 ALTER TABLE `sports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_achievements`
--

DROP TABLE IF EXISTS `team_achievements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `team_achievements` (
  `team_achievement_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) DEFAULT NULL,
  `achievement_id` int(11) DEFAULT NULL,
  `earned_at` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`team_achievement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_achievements`
--

LOCK TABLES `team_achievements` WRITE;
/*!40000 ALTER TABLE `team_achievements` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_achievements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_stats`
--

DROP TABLE IF EXISTS `team_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `team_stats` (
  `team_stats_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) DEFAULT NULL,
  `wins` int(11) DEFAULT NULL,
  `losses` int(11) DEFAULT NULL,
  `draws` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `match_id` int(11) DEFAULT NULL,
  `coachID` int(11) DEFAULT NULL,
  PRIMARY KEY (`team_stats_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_stats`
--

LOCK TABLES `team_stats` WRITE;
/*!40000 ALTER TABLE `team_stats` DISABLE KEYS */;
INSERT INTO `team_stats` VALUES (1,2,1,0,0,22,5,2),(2,1,0,1,0,18,5,2),(3,3,1,0,0,39,6,2),(4,4,0,1,0,30,6,2),(5,1,1,0,0,9,10,2),(6,3,0,1,0,7,10,2);
/*!40000 ALTER TABLE `team_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_name` varchar(255) DEFAULT NULL,
  `coach_name` varchar(255) DEFAULT NULL,
  `accountID` int(11) DEFAULT NULL,
  `sportsID` int(11) DEFAULT NULL,
  `school` longtext,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,'Team One','John Doe',2,1,'National College of Science and Technology','20250321084008logo.png'),(2,'Team Two','John Doe',2,2,'Emilio Aguinaldo College','20250321092026logo.png'),(3,'Team Three','John Doe',2,1,'De La Salle University Dasmarinas','20250321092459logo.png'),(4,'Team Four','Juan Dela Cruz',2,1,'National College of Science and Technology','20250321092543logo.png'),(5,'Team Five','John Doe',2,2,'Philippine Christian University','20250321092601logo.png'),(6,'Team Ace','John Doe',2,3,'Tagaytay City College','20250321132433logo.png');
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_permissions`
--

DROP TABLE IF EXISTS `user_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_permissions` (
  `up_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(45) DEFAULT NULL,
  `roster` int(11) DEFAULT NULL,
  `events` int(11) DEFAULT NULL,
  `matches` int(11) DEFAULT NULL,
  `videos` int(11) DEFAULT NULL,
  `news` int(11) DEFAULT NULL,
  `shops` int(11) DEFAULT NULL,
  `maintenance` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`up_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_permissions`
--

LOCK TABLES `user_permissions` WRITE;
/*!40000 ALTER TABLE `user_permissions` DISABLE KEYS */;
INSERT INTO `user_permissions` VALUES (1,'Super-admin',1,1,1,1,1,1,1,'2025-08-16 11:01:50','2025-08-16 20:39:45'),(2,'Media',0,1,0,1,1,1,0,'2025-08-16 11:07:26','2025-08-16 11:42:38');
/*!40000 ALTER TABLE `user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Fullname` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `Token` varchar(255) DEFAULT NULL,
  `DateCreated` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'vinmogate@gmail.com','$2y$10$g8Z1mb10P5gxdZ.S..NaD.bNOI0EBIOEqg.uknl6mPbE8/QoxoRHy','Warvin B Mogate',1,'e54e6b2e853c2ec5953a6f88a201fc6abff1b10082baac3f99cc5238b71de201','2025-04-04'),(2,'ccacademy2025@gmail.com','$2y$10$SIuZUIAidTZumOUqkcfMSe7MQT6rY13FKkY4En6ZnkBu1d6rvrrym','Juan Dela Cruz',1,'2a2b4071caeddc8acd90491a87a3fc09362973d27d9df16d2aaad28edfa68590','2025-05-10');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `videos` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) DEFAULT NULL,
  `description` longtext,
  `accountID` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `sportName` varchar(45) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `Token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` VALUES (1,'Sample Video here','hello world',1,'20250331005747sample video.mp4','Basketball','2025-03-31',1,'86c1403c584ff5d9'),(2,'Hello World','hello world',1,'20250331005747sample video.mp4','Basketball','2025-03-31',1,'86c1403c584Ft5d9');
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `views`
--

DROP TABLE IF EXISTS `views`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `views` (
  `view_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) DEFAULT NULL,
  `total_view` int(11) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  `watched_seconds` int(11) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`view_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `views`
--

LOCK TABLES `views` WRITE;
/*!40000 ALTER TABLE `views` DISABLE KEYS */;
INSERT INTO `views` VALUES (1,1,7,'2025-03-31',50,'127.0.0.1'),(2,1,5,'2025-03-30',30,'127.0.0.1'),(3,1,3,'2025-03-29',20,'127.0.0.1'),(4,2,8,'2025-03-29',10,'127.0.0.1'),(5,2,6,'2025-03-30',123,'127.0.0.1'),(6,2,10,'2025-03-31',102,'127.0.0.1'),(7,2,1,'2025-04-28',146,'::1'),(8,2,1,'2025-05-13',NULL,'::1');
/*!40000 ALTER TABLE `views` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-05 17:03:50
