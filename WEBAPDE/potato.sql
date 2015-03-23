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
INSERT INTO `account` VALUES (10001,'patrick_dp.jpg','patrick.esquillo','patrick!','Patrick Lance','Esquillo','ptrck.esquillo@gmail.com'),(10002,'default_pic.jpg','aj.amadora','aj!','Angelo John','Amadora','angelo_amadora@dlsu.edu.ph'),(10003,'chino_dp.jpg','chino.tapales','chino!','Carlo Gabriel','Tapales','carlo_tapales@dlsu.edu.ph'),(10004,'default_pic.jpg','miguel.gomez','miguel!','Miguel Francisco','Gomez','miguel_gomez@dlsu.edu.ph'),(10005,'default_pic.jpg','vince.lander','vince!','Vince Lander','Esquillo','vince.lander@gmail.com'),(10006,'default_pic.jpg','jd.guillarte','jd!','Joshua Daniel','Guillarte','jd@gmail.com'),(10007,'default_pic.jpg','kanye.greatest','kanye!','Kanye','West','mynigga@kanye.com');
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
  `recipe_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `file_comment` varchar(45) NOT NULL,
  `favorite_count` int(11) NOT NULL,
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
  `review_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe`
--

LOCK TABLES `recipe` WRITE;
/*!40000 ALTER TABLE `recipe` DISABLE KEYS */;
INSERT INTO `recipe` VALUES (10001,'Rock Lobster','10003','images/lobster.jpg','recipe.txt',10,5),(10002,'Ribeye Steak','10001','images/steak.jpg','recipe.txt',5,3),(10003,'Chicken Sandwich','10007','images/sandwich.jpg','recipe.txt',1,2),(10004,'California Maki','10005','images/sushi.jpg','recipe.txt',1,2),(10005,'Supreme Pizza','10004','images/pizza.jpg','recipe.txt',0,0),(10006,'Chicken Adobo','10001','images/adobo.jpg','recipe.txt',100,5),(10007,'Pork Sisig','10002','images/sisig.jpg','recipe.txt',6,3),(10008,'Sea Bass Curry','10004','images/seabasscurry.jpg','recipe.txt',2,4),(10009,'Broiled Lobster Tails with Garlic-Chili Butter','10003','images/lobstertail.jpg','recipe.txt',53,5);
/*!40000 ALTER TABLE `recipe` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-23 20:05:09
