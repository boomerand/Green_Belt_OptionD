CREATE DATABASE  IF NOT EXISTS `green-belt` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `green-belt`;
-- MySQL dump 10.13  Distrib 5.5.24, for osx10.5 (i386)
--
-- Host: localhost    Database: green-belt
-- ------------------------------------------------------
-- Server version	5.5.34

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
-- Table structure for table `poll_options`
--

DROP TABLE IF EXISTS `poll_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poll_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `polls_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_poll_options_polls1_idx` (`polls_id`),
  CONSTRAINT `fk_poll_options_polls1` FOREIGN KEY (`polls_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poll_options`
--

LOCK TABLES `poll_options` WRITE;
/*!40000 ALTER TABLE `poll_options` DISABLE KEYS */;
INSERT INTO `poll_options` VALUES (6,10,'Red','2014-04-28 12:12:44','2014-04-28 12:12:44'),(7,10,'Blue','2014-04-28 12:12:44','2014-04-28 12:12:44'),(8,10,'Green','2014-04-28 12:12:44','2014-04-28 12:12:44'),(9,10,'I don\'t like any of these colors.','2014-04-28 12:12:44','2014-04-28 12:12:44'),(10,11,'Something furry','2014-04-28 12:16:31','2014-04-28 12:16:31'),(11,11,'Something slimy','2014-04-28 12:16:31','2014-04-28 12:16:31'),(12,11,'Something that flies','2014-04-28 12:16:31','2014-04-28 12:16:31'),(13,11,'I don\'t do the pet thing.','2014-04-28 12:16:31','2014-04-28 12:16:31');
/*!40000 ALTER TABLE `poll_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poll_results`
--

DROP TABLE IF EXISTS `poll_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poll_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `poll_options_id` int(11) NOT NULL,
  `polls_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_poll_results_poll_options_idx` (`poll_options_id`),
  KEY `fk_poll_results_polls1_idx` (`polls_id`),
  CONSTRAINT `fk_poll_results_poll_options` FOREIGN KEY (`poll_options_id`) REFERENCES `poll_options` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_poll_results_polls1` FOREIGN KEY (`polls_id`) REFERENCES `polls` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poll_results`
--

LOCK TABLES `poll_results` WRITE;
/*!40000 ALTER TABLE `poll_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `poll_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `polls`
--

DROP TABLE IF EXISTS `polls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polls`
--

LOCK TABLES `polls` WRITE;
/*!40000 ALTER TABLE `polls` DISABLE KEYS */;
INSERT INTO `polls` VALUES (10,'What is your favorite color?','Pick a color from the following options:','2014-04-28 12:12:44','2014-04-28 12:12:44'),(11,'What type of pet do you want?','Choose the type of pet that you would like the most:','2014-04-28 12:16:31','2014-04-28 12:16:31');
/*!40000 ALTER TABLE `polls` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-28 14:01:31
