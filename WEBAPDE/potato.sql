-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: potato
-- ------------------------------------------------------
-- Server version	5.6.23-log

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `accimgname` varchar(45) NOT NULL DEFAULT 'default_pic.jpg',
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (10001,'profpic_10001.jpg','patrick.esquillo','1234','Patrick Lance','Esquillo','ptrck.esquillo@gmail.com'),(10002,'aj_dp.jpg','aj.amadora','aj!','Angelo John','Amadora','angelo_amadora@dlsu.edu.ph'),(10003,'chino_dp.jpg','chino.tapales','chino!','Carlo Gabriel','Tapales','carlo_tapales@dlsu.edu.ph'),(10004,'miguel_dp.jpg','miguel.gomez','miguel!','Miguel Francisco','Gomez','miguel_gomez@dlsu.edu.ph'),(10005,'vince_dp.jpg','vince.lander','vince!','Vince Lander','Esquillo','vince.lander@gmail.com'),(10006,'default_pic.jpg','jd.guillarte','jd!','Joshua Daniel','Guillarte','jd@gmail.com'),(10007,'kanye_dp.jpg','kanye.greatest','kanye!','Kanye','West','mynigga@kanye.com'),(10008,'nicole_dp.jpg','nicole.felices','nicole!','Nicole Angeline','Felices','nicole.felices@gmail.com'),(10009,'default_pic.jpg','air_06','jed!','Jed','Pangilininan','jed.pangilinan@gmail.com'),(10010,'default_pic.jpg','arturo01','1234','Arturo','Caronongan','arturo.caronongan@dlsu.edu.ph'),(10011,'profpic_10011.jpg','richard.ng','richard','Richard','Ng','richard.ng@gmail.com'),(10012,'default_pic.jpg','sbeaver13','choy','Seaver','Choy','seaver.choy@gmail.com');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `file_comment` varchar(45) NOT NULL,
  `favorite_count` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `review_id` int(11) NOT NULL DEFAULT '0',
  `recipe_id` int(11) NOT NULL DEFAULT '0',
  `acc_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorite`
--

DROP TABLE IF EXISTS `favorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorite` (
  `favorite_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `review_id` int(11) NOT NULL DEFAULT '0',
  `recipe_id` int(11) NOT NULL DEFAULT '0',
  `comment_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`favorite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite`
--

LOCK TABLES `favorite` WRITE;
/*!40000 ALTER TABLE `favorite` DISABLE KEYS */;
INSERT INTO `favorite` VALUES (1,10003,2,0,10002,0),(2,10003,2,0,10003,0),(3,10001,2,0,10001,0);
/*!40000 ALTER TABLE `favorite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipe` (
  `recipe_id` int(11) NOT NULL,
  `recipename` varchar(100) NOT NULL,
  `account_id` varchar(16) NOT NULL,
  `recipeimgname` varchar(45) NOT NULL,
  `file` varchar(45) NOT NULL,
  `favorite_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe`
--

LOCK TABLES `recipe` WRITE;
/*!40000 ALTER TABLE `recipe` DISABLE KEYS */;
INSERT INTO `recipe` VALUES (10001,'Slow-Roasted Salmon with Fennel Citrus and Chiles','10001','rec_10001.jpg','recipe.txt',1),(10002,'Salmon with Snap Peas, Yellow Peppers, and Dill Pistachio Pistou','10005','rec_10002.jpg','recipe.txt',1),(10003,'Roast Beef','10005','rec_10003.jpg','recipe.txt',1);
/*!40000 ALTER TABLE `recipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `reviewname` varchar(45) NOT NULL,
  `account_id` int(11) NOT NULL,
  `reviewimgname` varchar(45) NOT NULL,
  `favorite_count` int(11) DEFAULT NULL,
  `review_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` VALUES (10001,'Mozzarella Sticks',10003,'rev_1.jpg',0,4);
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-16 10:47:17
