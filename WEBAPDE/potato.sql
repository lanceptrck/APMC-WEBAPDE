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
INSERT INTO `account` VALUES (10001,'patrick_dp.jpg','patrick.esquillo','patrick!','Patrick Lance','Esquillo','ptrck.esquillo@gmail.com'),(10002,'aj_dp.jpg','aj.amadora','aj!','Angelo John','Amadora','angelo_amadora@dlsu.edu.ph'),(10003,'chino_dp.jpg','chino.tapales','chino!','Carlo Gabriel','Tapales','carlo_tapales@dlsu.edu.ph'),(10004,'miguel_dp.jpg','miguel.gomez','miguel!','Miguel Francisco','Gomez','miguel_gomez@dlsu.edu.ph'),(10005,'vince_dp.jpg','vince.lander','vince!','Vince Lander','Esquillo','vince.lander@gmail.com'),(10006,'default_pic.jpg','jd.guillarte','jd!','Joshua Daniel','Guillarte','jd@gmail.com'),(10007,'kanye_dp.jpg','kanye.greatest','kanye!','Kanye','West','mynigga@kanye.com'),(10008,'nicole_dp.jpg','nicole.felices','nicole!','Nicole Angeline','Felices','nicole.felices@gmail.com'),(10009,'default_pic.jpg','air_06','jed!','Jed','Pangilininan','jed.pangilinan@gmail.com'),(10010,'default_pic.jpg','arturo01','1234','Arturo','Caronongan','arturo.caronongan@dlsu.edu.ph');
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
INSERT INTO `comment` VALUES (30001,10001,'comments.txt',7,2,0,10005,0),(30002,10007,'comments.txt',5,3,0,0,10001),(30003,10001,'comments.txt',5,1,10001,0,0),(30004,10005,'comments.txt',1,2,0,10003,0),(30005,10001,'comments.txt',0,3,0,0,10002),(30006,10001,'comments.txt',1,3,0,0,10007),(30007,10001,'comments.txt',1,2,0,10008,0),(30008,10001,'comments.txt',1,2,0,10004,0),(30009,10001,'comments.txt',1,2,0,10012,0),(30010,10001,'comments.txt',0,2,0,10013,0),(30011,10001,'comments.txt',0,2,0,10009,0),(30012,10001,'comments.txt',0,2,0,10010,0);
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
INSERT INTO `favorite` VALUES (60001,10001,3,0,0,30003),(60002,10001,3,0,0,30002),(60003,10001,3,0,0,30004),(60004,10001,3,0,0,30006),(60005,10001,2,0,10004,0),(60006,10001,3,0,0,10001),(60007,10001,2,0,10001,0),(60008,10001,3,0,0,10003),(60009,10001,1,10003,0,0),(60010,10001,2,0,10003,0),(60011,10001,2,0,10002,0),(60012,10001,3,0,0,30008),(60013,10001,3,0,0,30009),(60014,10001,2,0,10009,0),(60015,10001,2,0,10010,0);
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
INSERT INTO `recipe` VALUES (10001,'Rock Lobster','10003','rec_10001.jpg','recipe.txt',12),(10002,'Ribeye Steak','10001','rec_10002.jpg','recipe.txt',6),(10003,'Chicken Sandwich','10007','rec_10003.jpg','recipe.txt',2),(10004,'California Maki','10005','rec_10004.jpg','recipe.txt',3),(10005,'Supreme Pizza','10004','rec_10005.jpg','recipe.txt',2),(10006,'Chicken Adobo','10001','rec_10006.jpg','recipe.txt',101),(10007,'Pork Sisig','10002','rec_10007.jpg','recipe.txt',6),(10008,'Sea Bass Curry','10004','rec_10008.jpg','recipe.txt',3),(10009,'Broiled Lobster Tails with Garlic-Chili Butter','10003','rec_10009.jpg','recipe.txt',54),(10010,'Salmon Nicoise Salad','10008','rec_10010.jpg','recipe.txt',22),(10011,'Bacon Burger','10001','rec_10011.jpg','recipe.txt',0),(10012,'Katsudon','10009','rec_10012.jpg','recipe.txt',0),(10013,'Authentic Ramen','10002','rec_10013.jpg','recipe.txt',0),(10014,'Chicken Curry','10001','rec_10014.jpg','recipe.txt',0),(10015,'Mozzarella Sticks','10010','rec_10015.jpg','recipe.txt',0),(10016,'Curried Shrimp Cocktail','10001','rec_10016.jpg','recipe.txt',3);
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
INSERT INTO `review` VALUES (10001,'Rock Lobster',10003,'rev_10001.jpg',9,1),(10002,'Pork Sisig',10001,'rev_10002.jpg',0,5),(10003,'Yum Burger',10001,'rev_10003.jpg',1,2);
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

-- Dump completed on 2015-04-04 17:53:48
