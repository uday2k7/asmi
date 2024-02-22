-- MariaDB dump 10.19  Distrib 10.5.18-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: vava_nt_insurin
-- ------------------------------------------------------
-- Server version	10.5.18-MariaDB-0+deb11u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `about_us`
--

DROP TABLE IF EXISTS `about_us`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `about_us` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `heading` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `deleted` tinyint(2) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about_us`
--

LOCK TABLES `about_us` WRITE;
/*!40000 ALTER TABLE `about_us` DISABLE KEYS */;
INSERT INTO `about_us` VALUES (1,'dddd','<p><strong>hg jhg ed</strong></p><p><strong>vbcc</strong></p>',1,0,'2022-09-12 19:44:00','2022-10-31 14:53:07');
/*!40000 ALTER TABLE `about_us` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `icon_path` varchar(255) NOT NULL,
  `display` tinyint(2) NOT NULL DEFAULT 1,
  `deleted` tinyint(2) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,'Exercise','https://insurin-backend.nettrackers.in/icons/1676457333.png',1,0,'2023-02-15 10:35:33','2023-02-15 10:35:33'),(2,'Walking','https://insurin-backend.nettrackers.in/icons/1676457350.png',1,0,'2023-02-15 10:35:50','2023-02-15 10:35:50'),(3,'Chores','https://insurin-backend.nettrackers.in/icons/1676457375.png',1,0,'2023-02-15 10:36:15','2023-02-15 10:36:15'),(4,'Tennis','https://insurin-backend.nettrackers.in/icons/1676457400.png',1,0,'2023-02-15 10:36:40','2023-02-15 10:36:40'),(5,'Yoga','https://insurin-backend.nettrackers.in/icons/1676457410.png',1,0,'2023-02-15 10:36:50','2023-02-15 10:36:50'),(6,'Pilates','https://insurin-backend.nettrackers.in/icons/1676457432.png',1,0,'2023-02-15 10:37:12','2023-02-15 10:37:12');
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emotions`
--

DROP TABLE IF EXISTS `emotions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emotions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `icon_path` varchar(255) NOT NULL,
  `display` tinyint(2) NOT NULL DEFAULT 1,
  `deleted` tinyint(2) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emotions`
--

LOCK TABLES `emotions` WRITE;
/*!40000 ALTER TABLE `emotions` DISABLE KEYS */;
INSERT INTO `emotions` VALUES (1,'Happy','https://insurin-backend.nettrackers.in/icons/1676456795.png',1,0,'2023-02-15 10:26:35','2023-02-15 10:26:35'),(2,'Angry','https://insurin-backend.nettrackers.in/icons/1676456817.png',1,0,'2023-02-15 10:26:57','2023-02-15 10:26:57'),(3,'Sad','https://insurin-backend.nettrackers.in/icons/1676456831.png',1,0,'2023-02-15 10:27:11','2023-02-15 10:27:11'),(4,'Anxious','https://insurin-backend.nettrackers.in/icons/1676456847.png',1,0,'2023-02-15 10:27:27','2023-02-15 10:27:27'),(5,'Worried','https://insurin-backend.nettrackers.in/icons/1676456873.png',1,0,'2023-02-15 10:27:53','2023-02-15 10:27:53');
/*!40000 ALTER TABLE `emotions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `icon_path` varchar(255) NOT NULL,
  `display` tinyint(2) NOT NULL DEFAULT 1,
  `deleted` tinyint(2) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Food','https://insurin-backend.nettrackers.in/icons/1676456904.png',1,0,'2023-02-15 10:28:24','2023-02-15 10:28:24'),(2,'Alcohol','https://insurin-backend.nettrackers.in/icons/1676456923.png',1,0,'2023-02-15 10:28:43','2023-02-15 10:28:43'),(3,'Nap','https://insurin-backend.nettrackers.in/icons/1676456935.png',1,0,'2023-02-15 10:28:55','2023-02-15 10:28:55'),(4,'Travelling','https://insurin-backend.nettrackers.in/icons/1676456960.png',1,0,'2023-02-15 10:29:20','2023-02-15 10:29:20'),(5,'Sunny','https://insurin-backend.nettrackers.in/icons/1676457007.png',1,0,'2023-02-15 10:30:07','2023-02-15 10:30:07'),(6,'Cold','https://insurin-backend.nettrackers.in/icons/1676457022.png',1,0,'2023-02-15 10:30:22','2023-02-15 10:30:22'),(7,'Party','https://insurin-backend.nettrackers.in/icons/1676457031.png',1,0,'2023-02-15 10:30:31','2023-02-15 10:30:31');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_book`
--

DROP TABLE IF EXISTS `log_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `blood_glucose` decimal(2,1) NOT NULL,
  `emotion_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `log_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'user controlled date time',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_book`
--

LOCK TABLES `log_book` WRITE;
/*!40000 ALTER TABLE `log_book` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_table_users',1),(2,'2019_12_14_000001_create_personal_access_tokens_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `send_by` int(10) NOT NULL,
  `message` varchar(255) NOT NULL,
  `read_status` tinyint(2) NOT NULL DEFAULT 0,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `deleted` tinyint(2) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (1,147,'Koushik New Inf has accepted campaign invitation',1,1,0,'2022-10-27 05:20:46','2022-10-27 05:22:43'),(2,144,'U Chatterjee has accepted your organization invitation',1,1,0,'2022-10-31 06:23:17','2022-10-31 06:28:31'),(3,147,'Koushik New Inf has accepted your organization invitation',1,1,0,'2022-10-31 06:44:28','2022-10-31 06:44:51'),(4,147,'Koushik New Inf has accepted your organization invitation',1,1,0,'2022-10-31 06:57:39','2022-10-31 07:00:31'),(5,147,'Koushik New Inf has accepted your organization invitation',1,1,0,'2022-10-31 06:58:54','2022-10-31 07:00:29'),(6,147,'Koushik New Inf has accepted your campaign invitation',1,1,0,'2022-10-31 07:06:41','2022-10-31 07:08:05'),(7,106,'Bibek Kotal sent you a message!',1,1,0,'2022-10-31 17:06:09','2022-11-08 11:19:19'),(8,106,'Bibek Kotal sent you a message!',1,1,0,'2022-11-01 05:27:12','2022-11-08 11:19:17'),(9,106,'Bibek Kotal sent you a message!',1,1,0,'2022-11-01 05:39:15','2022-11-08 11:19:16'),(10,147,'Koushik New Inf sent you a message!',1,1,0,'2022-11-01 05:42:12','2022-11-08 11:19:14'),(11,147,'Koushik New Inf sent you a message!',1,1,0,'2022-11-01 05:43:48','2022-11-08 11:19:12'),(12,147,'Koushik New Inf sent you a message!',1,1,0,'2022-11-01 14:19:22','2022-11-08 11:19:10'),(13,147,'Koushik New Inf sent you a message!',1,1,0,'2022-11-01 14:19:36','2022-11-08 11:19:08'),(14,147,'Koushik New Inf sent you a message!',1,1,0,'2022-11-01 14:19:36','2022-11-08 11:19:05'),(15,147,'Koushik New Inf sent you a message!',1,1,0,'2022-11-01 14:19:36','2022-11-08 11:19:02'),(16,147,'Koushik New Inf sent you a message!',1,1,0,'2022-11-01 14:19:36','2022-11-08 11:19:03'),(17,147,'Koushik New Inf sent you a message!',1,1,0,'2022-11-01 14:19:36','2022-11-08 11:19:00'),(18,147,'Koushik New Inf sent you a message!',1,1,0,'2022-11-01 14:20:02','2022-11-08 11:18:58'),(19,147,'Koushik New Inf sent you a message!',1,1,0,'2022-11-01 14:20:03','2022-11-08 11:18:57'),(20,147,'Koushik New Inf sent you a message!',1,1,0,'2022-11-01 14:20:03','2022-11-08 11:18:54'),(21,147,'Koushik New Inf sent you a message!',1,1,0,'2022-11-03 06:07:20','2022-11-08 11:18:52'),(22,147,'Koushik New Inf sent you a message!',1,1,0,'2022-11-03 06:07:56','2022-11-08 11:18:51'),(23,147,'Koushik New Inf sent you a message!',1,1,0,'2022-11-03 06:07:56','2022-11-08 11:18:49'),(24,147,'Koushik New Inf sent you a message!',1,1,0,'2022-11-03 06:07:56','2022-11-08 11:18:47'),(25,147,'Koushik New Inf sent you a message!',1,1,0,'2022-11-03 06:07:56','2022-11-08 11:18:45'),(26,147,'Koushik New Inf sent you a message!',1,1,0,'2022-11-03 07:18:00','2022-11-08 11:18:41'),(27,144,'U Chatterjee has accepted your campaign invitation',1,1,0,'2022-11-05 15:56:48','2022-11-08 11:18:43'),(28,144,'U Chatterjee has accepted your campaign invitation',1,1,0,'2022-11-05 15:57:44','2022-11-08 11:18:39'),(29,144,'U Chatterjee sent you a message!',1,1,0,'2022-11-05 15:59:32','2022-11-08 11:18:36'),(30,144,'U Chatterjee sent you a message!',1,1,0,'2022-11-05 15:59:44','2022-11-08 11:18:34'),(31,151,'Uday1 has accepted your organization invitation',1,1,0,'2022-11-08 09:00:45','2022-11-08 11:18:32'),(32,151,'Uday1 has accepted your campaign invitation',1,1,0,'2022-11-08 11:18:18','2022-11-08 11:18:30'),(33,151,'Uday1 sent you a message!',1,1,0,'2022-11-08 11:20:29','2022-11-08 12:10:41'),(34,106,'Bibek Kotal sent you a message!',0,1,0,'2022-11-30 10:39:06','2022-11-30 10:39:06'),(35,106,'Test Influencer has accepted your organization invitation',0,1,0,'2022-12-20 05:08:53','2022-12-20 05:08:53'),(36,106,'Test Influencer has accepted your organization invitation',0,1,0,'2022-12-20 05:09:24','2022-12-20 05:09:24'),(37,158,'Urvish Chatterjee has accepted your organization invitation',0,1,0,'2022-12-20 12:22:27','2022-12-20 12:22:27'),(38,158,'Urvish Chatterjee has accepted your organization invitation',0,1,0,'2022-12-21 13:46:55','2022-12-21 13:46:55');
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification_push`
--

DROP TABLE IF EXISTS `notification_push`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification_push` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `influencer_id` int(11) NOT NULL COMMENT 'users.id',
  `title` varchar(255) NOT NULL COMMENT 'title',
  `body` mediumtext NOT NULL COMMENT 'message',
  `message_category` varchar(50) NOT NULL COMMENT 'See pushMsgLib at helper directory',
  `message_id` int(11) NOT NULL DEFAULT 0 COMMENT 'ex: campaign id',
  `message_details` text DEFAULT NULL COMMENT 'any details about message',
  `is_read` varchar(5) NOT NULL DEFAULT 'NO' COMMENT 'YES or NO',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification_push`
--

LOCK TABLES `notification_push` WRITE;
/*!40000 ALTER TABLE `notification_push` DISABLE KEYS */;
INSERT INTO `notification_push` VALUES (1,107,'Campaign Invitation for You','You have been invited to the Campaign Dummy Campaign Subway 1','CAMPAIGN',23,'','NO','2022-10-12 16:18:04','2022-10-12 16:18:04'),(2,107,'Campaign Invitation for You','You have been invited to the Campaign Dummy Campaign Subway 1','CAMPAIGN',23,'','NO','2022-10-12 16:18:04','2022-10-12 16:18:04'),(3,107,'Campaign Invitation for You','You have been invited to the Campaign Dummy Campaign Subway 1','CAMPAIGN',23,'','NO','2022-10-12 16:18:04','2022-10-12 16:18:04'),(4,107,'Campaign Invitation for You','You have been invited to the Campaign Dummy Campaign Subway 1','CAMPAIGN',23,'','NO','2022-10-12 16:18:04','2022-10-12 16:18:04'),(5,107,'Campaign Invitation for You','You have been invited to the Campaign Dummy Campaign Subway 1','CAMPAIGN',23,'','NO','2022-10-12 16:18:04','2022-10-12 16:18:04'),(6,107,'Campaign Invitation for You','You have been invited to the Campaign Dummy Campaign Subway 1','CAMPAIGN',23,'','NO','2022-10-12 16:18:04','2022-10-12 16:18:04'),(7,1,'Campaign Invitation for You','You have been invited to the Campaign Dummy Campaign Subway 1','CAMPAIGN',23,'','NO','2022-10-12 16:18:04','2022-10-12 16:18:04'),(8,1,'Campaign Invitation for You','You have been invited to the Campaign Dummy Campaign Subway 1','CAMPAIGN',23,'','NO','2022-10-12 16:18:04','2022-10-12 16:18:04'),(9,1,'Campaign Invitation for You','You have been invited to the Campaign Dummy Campaign Subway 1','CAMPAIGN',23,'','NO','2022-10-12 16:18:04','2022-10-12 16:18:04'),(10,1,'Campaign Invitation for You','You have been invited to the Campaign Dummy Campaign Subway 1','CAMPAIGN',23,'','NO','2022-10-12 16:18:04','2022-10-12 16:18:04'),(11,1,'Campaign Invitation for You','You have been invited to the Campaign Dummy Campaign Subway 1','CAMPAIGN',23,'','NO','2022-10-12 16:18:04','2022-10-12 16:18:04'),(12,106,'Campaign Invitation for You','You have been invited to the Campaign NTC Campaign','CAMPAIGN',24,'','YES','2022-10-13 11:58:56','2022-10-13 13:38:46'),(13,107,'Campaign Invitation for You','You have been invited to the Campaign NTC Campaign','CAMPAIGN',24,'','NO','2022-10-13 11:58:56','2022-10-13 11:58:56'),(14,107,'Campaign Invitation for You','You have been invited to the Campaign NTC Campaign','CAMPAIGN',24,'','NO','2022-10-13 11:58:56','2022-10-13 11:58:56'),(15,107,'Campaign Invitation for You','You have been invited to the Campaign NTC Campaign','CAMPAIGN',24,'','NO','2022-10-13 11:58:56','2022-10-13 11:58:56'),(16,1,'Campaign Invitation for You','You have been invited to the Campaign Hello Campaign','CAMPAIGN',25,'','NO','2022-10-17 02:56:13','2022-10-17 02:56:13'),(17,144,'Campaign Invitation for You','You have been invited to the Campaign Hello Campaign','CAMPAIGN',25,'','YES','2022-10-17 02:56:13','2022-10-20 06:18:01'),(18,135,'Campaign Invitation for You','You have been invited to the Campaign New Model Samsung','CAMPAIGN',27,'','YES','2022-10-21 13:59:41','2022-10-21 13:59:59'),(19,135,'Campaign Invitation for You','You have been invited to the Campaign Bhaiphota Campaign','CAMPAIGN',29,'','YES','2022-10-27 05:20:40','2022-11-01 11:21:46'),(20,1,'You have been invited by Bhai Phota','You have been invited by Bhai Phota','GENERAL',13,'','NO','2022-10-27 13:25:18','2022-10-27 13:25:18'),(21,1,'You have been invited by Bhai Phota','You have been invited by Bhai Phota','GENERAL',13,'','NO','2022-10-27 13:25:54','2022-10-27 13:25:54'),(22,1,'You have been invited by Bhai Phota','You have been invited by Bhai Phota','GENERAL',13,'','NO','2022-10-27 13:40:16','2022-10-27 13:40:16'),(23,1,'You have been invited by BATA','You have been invited by BATA','GENERAL',14,'','NO','2022-10-31 06:00:20','2022-10-31 06:00:20'),(24,1,'You have been invited by BATA','You have been invited by BATA','GENERAL',14,'','NO','2022-10-31 06:03:10','2022-10-31 06:03:10'),(25,1,'You have been invited by BATA','You have been invited by BATA','GENERAL',14,'','NO','2022-10-31 06:04:05','2022-10-31 06:04:05'),(26,1,'You have been invited by BATA','You have been invited by BATA','GENERAL',14,'','NO','2022-10-31 06:04:58','2022-10-31 06:04:58'),(27,144,'You have been invited by BATA','You have been invited by BATA','GENERAL',14,'','YES','2022-10-31 06:15:19','2022-10-31 06:16:11'),(28,144,'You have been invited by BATA','You have been invited by BATA','GENERAL',14,'','YES','2022-10-31 06:16:36','2022-10-31 06:16:42'),(29,144,'Campaign Invitation for You','You have been invited to the Campaign Puja Sale','CAMPAIGN',30,'','YES','2022-10-31 06:22:21','2022-10-31 06:22:29'),(30,144,'You have been invited by ICC','You have been invited by ICC','GENERAL',15,'','YES','2022-10-31 06:35:09','2022-10-31 06:37:25'),(31,106,'You have been invited by ICC','You have been invited by ICC','GENERAL',15,'','YES','2022-10-31 06:35:17','2022-10-31 12:53:27'),(32,106,'You have been invited by ICC','You have been invited by ICC','GENERAL',15,'','YES','2022-10-31 06:35:17','2022-10-31 12:53:27'),(33,144,'You have been invited by ICC','You have been invited by ICC','GENERAL',15,'','YES','2022-10-31 06:35:17','2022-10-31 06:37:25'),(34,135,'You have been invited by ICC','You have been invited by ICC','GENERAL',15,'','YES','2022-10-31 06:41:46','2022-11-01 11:21:46'),(35,135,'You have been invited by ICC','You have been invited by ICC','GENERAL',15,'','YES','2022-10-31 06:41:47','2022-11-01 11:21:46'),(36,144,'You have been invited by ICC','You have been invited by ICC','GENERAL',15,'','YES','2022-10-31 06:41:47','2022-10-31 06:42:11'),(37,135,'You have been invited by ICC','You have been invited by ICC','GENERAL',15,'','YES','2022-10-31 06:41:59','2022-11-01 11:21:46'),(38,135,'You have been invited by ICC','You have been invited by ICC','GENERAL',15,'','YES','2022-10-31 06:41:59','2022-11-01 11:21:46'),(39,144,'You have been invited by ICC','You have been invited by ICC','GENERAL',15,'','YES','2022-10-31 06:41:59','2022-10-31 06:42:11'),(40,135,'You have been invited by ICC','You have been invited by ICC','GENERAL',15,'','YES','2022-10-31 06:54:11','2022-11-01 11:21:46'),(41,135,'You have been invited by ICC','You have been invited by ICC','GENERAL',15,'','YES','2022-10-31 06:57:12','2022-11-01 11:21:46'),(42,135,'You have been invited by Bhai Phota','You have been invited by Bhai Phota','GENERAL',13,'','YES','2022-10-31 06:58:36','2022-11-01 11:21:46'),(43,135,'You have been invited by Bhai Phota','You have been invited by Bhai Phota','GENERAL',13,'','YES','2022-10-31 06:58:36','2022-11-01 11:21:46'),(44,144,'You have been invited by Bhai Phota','You have been invited by Bhai Phota','GENERAL',13,'','YES','2022-10-31 06:58:36','2022-11-05 15:55:52'),(45,135,'You have been invited by Bhai Phota','You have been invited by Bhai Phota','GENERAL',13,'','YES','2022-10-31 06:58:37','2022-11-01 11:21:46'),(46,144,'You have been invited by Bhai Phota','You have been invited by Bhai Phota','GENERAL',13,'','YES','2022-10-31 06:58:37','2022-11-05 15:55:52'),(47,1,'You have been invited by Bhai Phota','You have been invited by Bhai Phota','GENERAL',13,'','NO','2022-10-31 06:58:37','2022-10-31 06:58:37'),(48,135,'You have been invited by Bhai Phota','You have been invited by Bhai Phota','GENERAL',13,'','YES','2022-10-31 06:58:37','2022-11-01 11:21:46'),(49,144,'You have been invited by Bhai Phota','You have been invited by Bhai Phota','GENERAL',13,'','YES','2022-10-31 06:58:37','2022-11-05 15:55:52'),(50,1,'You have been invited by Bhai Phota','You have been invited by Bhai Phota','GENERAL',13,'','NO','2022-10-31 06:58:37','2022-10-31 06:58:37'),(51,1,'You have been invited by Bhai Phota','You have been invited by Bhai Phota','GENERAL',13,'','NO','2022-10-31 06:58:37','2022-10-31 06:58:37'),(52,135,'Campaign Invitation for You','You have been invited to the Campaign Men\'s T20 WC','CAMPAIGN',31,'','YES','2022-10-31 07:00:11','2022-11-01 11:21:46'),(53,135,'Campaign Invitation for You','You have been invited to the Campaign WC','CAMPAIGN',32,'','YES','2022-10-31 07:11:12','2022-11-01 11:21:46'),(54,1,'Campaign Invitation for You','You have been invited to the Campaign demo','CAMPAIGN',33,'','NO','2022-10-31 08:22:59','2022-10-31 08:22:59'),(55,144,'Campaign Invitation for You','You have been invited to the Campaign demo','CAMPAIGN',33,'','YES','2022-10-31 08:22:59','2022-11-05 15:55:52'),(56,137,'Test notification: 2022-11-15 10:36:47','This is a notification details with plain text','CAMPAIGN',10,'Hello World','NO','2022-11-15 10:36:47','2022-11-15 10:36:47');
/*!40000 ALTER TABLE `notification_push` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `privacy`
--

DROP TABLE IF EXISTS `privacy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `privacy` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `heading` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `deleted` tinyint(2) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privacy`
--

LOCK TABLES `privacy` WRITE;
/*!40000 ALTER TABLE `privacy` DISABLE KEYS */;
INSERT INTO `privacy` VALUES (1,'ddd','<p>hg jhg nc</p><p>vbcc</p>',1,0,'2022-09-12 19:44:00','2022-09-29 11:52:08');
/*!40000 ALTER TABLE `privacy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terms`
--

DROP TABLE IF EXISTS `terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `terms` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `heading` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `deleted` tinyint(2) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terms`
--

LOCK TABLES `terms` WRITE;
/*!40000 ALTER TABLE `terms` DISABLE KEYS */;
INSERT INTO `terms` VALUES (1,'ddd','<p>hg jhg &nbsp;ls</p><p>vbcc</p>',1,0,'2022-09-12 19:44:00','2022-09-29 11:51:45');
/*!40000 ALTER TABLE `terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'site user id',
  `first_name` varchar(255) NOT NULL COMMENT 'user first name',
  `last_name` varchar(255) NOT NULL COMMENT 'user last name',
  `email` varchar(255) DEFAULT NULL COMMENT 'user email address',
  `mobile` varchar(50) DEFAULT NULL COMMENT 'mobile number with isd; ex: +919999999999',
  `profile_pic` varchar(255) DEFAULT NULL COMMENT 'https://domain.com/user-content/example.png',
  `is_locked` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:not locked; 1: locked',
  `is_email_verified` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:not verified;1:verified',
  `is_mobile_verified` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:not verified;1:verified',
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0 COMMENT '1:deleted\r\n0:not deleted',
  `user_type` tinyint(2) NOT NULL DEFAULT 3 COMMENT '1:superadmin;\r\n2:Admin\r\n3:Influencer',
  `gender` varchar(10) DEFAULT NULL COMMENT 'use constant',
  `password` varchar(255) NOT NULL DEFAULT '0000-00-00' COMMENT 'user password',
  `date_of_birth` date DEFAULT NULL COMMENT 'date of birth',
  `address` text DEFAULT NULL COMMENT 'user address',
  `otp` varchar(6) DEFAULT NULL COMMENT 'otp to verify user information',
  `otp_expires` int(11) NOT NULL DEFAULT 0 COMMENT 'unix timestamp when otp expired',
  `terms_accepted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:no;1:yes',
  `registered_on` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'row entry timestamp',
  `fcm_token` varchar(255) NOT NULL DEFAULT 'NONE' COMMENT 'Google firebase fcm token to send notification',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'row update date time; $model->save()',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mr','SuperAdmin','uday@nettrackers.net',NULL,'0',0,0,0,0,1,'Male','$2y$10$yv2mar9ZZSLzOg.LBOJcGucf2URlHtespDC7ui3OSjF6qIEfmEtaa','2022-06-01','This is a address',NULL,0,1,'2022-06-14 07:13:11','NONE','0000-00-00 00:00:00','2022-06-14 07:13:11'),(159,'Bibek','kotal',NULL,'9812122323',NULL,0,0,1,0,4,NULL,'0000-00-00',NULL,NULL,'1234',1676573044,0,'2023-02-15 06:03:50','NONE','2023-02-15 06:03:50','2023-02-16 18:38:04'),(160,'Bibek','kotal',NULL,'7001216451',NULL,0,0,1,0,4,NULL,'0000-00-00',NULL,NULL,'1234',1676580954,0,'2023-02-15 18:00:34','NONE','2023-02-15 18:00:34','2023-02-16 20:49:54'),(161,'Bibek','kotal',NULL,'7001216545',NULL,0,0,0,0,4,NULL,'0000-00-00',NULL,NULL,NULL,0,0,'2023-02-16 20:24:22','NONE','2023-02-16 20:24:22','2023-02-16 20:24:22');
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

-- Dump completed on 2023-02-19 14:34:17
