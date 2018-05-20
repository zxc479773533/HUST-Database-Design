-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: dblab01
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.32-MariaDB

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
-- Table structure for table `ACTIN`
--

DROP TABLE IF EXISTS `ACTIN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ACTIN` (
  `ACTID` int(11) DEFAULT NULL,
  `FID` int(11) DEFAULT NULL,
  `ISLEADING` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GRADE` int(11) DEFAULT NULL,
  KEY `FID` (`FID`),
  KEY `ACTID` (`ACTID`),
  CONSTRAINT `ACTIN_ibfk_1` FOREIGN KEY (`FID`) REFERENCES `FILM` (`FID`),
  CONSTRAINT `ACTIN_ibfk_2` FOREIGN KEY (`FID`) REFERENCES `FILM` (`FID`),
  CONSTRAINT `ACTIN_ibfk_3` FOREIGN KEY (`ACTID`) REFERENCES `ACTOR` (`ACTID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ACTIN`
--

LOCK TABLES `ACTIN` WRITE;
/*!40000 ALTER TABLE `ACTIN` DISABLE KEYS */;
INSERT INTO `ACTIN` VALUES (1,1,'Y',95),(3,1,'N',85),(5,1,'N',72),(1,2,'Y',92),(2,2,'N',86),(7,2,'N',87),(1,3,'Y',92),(4,3,'N',75),(6,3,'N',85),(1,4,'Y',90),(4,4,'N',88),(8,4,'N',85),(5,5,'Y',88),(6,5,'N',85),(7,5,'N',82);
/*!40000 ALTER TABLE `ACTIN` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ACTOR`
--

DROP TABLE IF EXISTS `ACTOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ACTOR` (
  `ACTID` int(11) NOT NULL,
  `ANAME` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SEX` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BYEAR` int(11) DEFAULT NULL,
  PRIMARY KEY (`ACTID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ACTOR`
--

LOCK TABLES `ACTOR` WRITE;
/*!40000 ALTER TABLE `ACTOR` DISABLE KEYS */;
INSERT INTO `ACTOR` VALUES (1,'付内东','男',1998),(2,'胡晋源','男',1999),(3,'包靖远','男',1989),(4,'何涌硕','男',1978),(5,'徐光磊','男',1987),(6,'文柱锟','男',1998),(7,'田雨欣','女',1997),(8,'陈诗维','女',1998),(9,'测试老哥','男',1998);
/*!40000 ALTER TABLE `ACTOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FILM`
--

DROP TABLE IF EXISTS `FILM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FILM` (
  `FID` int(11) NOT NULL,
  `FNAME` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `FTYPE` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DNAME` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `IS3D` enum('Y','N') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GRADE` int(11) DEFAULT NULL,
  PRIMARY KEY (`FID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FILM`
--

LOCK TABLES `FILM` WRITE;
/*!40000 ALTER TABLE `FILM` DISABLE KEYS */;
INSERT INTO `FILM` VALUES (1,'战狼一','枪战','吴京',120,'Y',90),(2,'战狼二','动作','吴京',115,'Y',88),(3,'战狼三','警匪','吴京',110,'N',92),(4,'战狼四','枪战','吴京',110,'N',75),(5,'追捕','动作','吴宇森',117,'Y',90),(6,'大话西游','喜剧','周星驰',120,'N',92),(7,'测试电影一','动作','导演一',115,'N',90),(8,'测试电影二','动作','导演二',112,'N',95),(9,'测试电影三','枪战','导演三',118,'N',75),(10,'测试电影四','动作','导演四',120,'N',NULL),(11,'测试电影五','喜剧','周星驰',120,'N',90),(12,'测试约束','喜剧','周星驰',115,'Y',100),(13,'测试空值','动作','吴京',115,'',NULL);
/*!40000 ALTER TABLE `FILM` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `LEADING_80_ACTIN`
--

DROP TABLE IF EXISTS `LEADING_80_ACTIN`;
/*!50001 DROP VIEW IF EXISTS `LEADING_80_ACTIN`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `LEADING_80_ACTIN` AS SELECT 
 1 AS `ACTID`,
 1 AS `ANAME`,
 1 AS `BYEAR`,
 1 AS `LEADINGNUM`,
 1 AS `MAXGRADE`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `ONSHOW`
--

DROP TABLE IF EXISTS `ONSHOW`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ONSHOW` (
  `FID` int(11) DEFAULT NULL,
  `TID` int(11) DEFAULT NULL,
  `PRICE` int(11) DEFAULT NULL,
  `YEAR` int(11) DEFAULT NULL,
  `MONTH` int(11) DEFAULT NULL,
  KEY `FID` (`FID`),
  KEY `TID` (`TID`),
  CONSTRAINT `ONSHOW_ibfk_1` FOREIGN KEY (`FID`) REFERENCES `FILM` (`FID`),
  CONSTRAINT `ONSHOW_ibfk_2` FOREIGN KEY (`TID`) REFERENCES `THEATER` (`TID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ONSHOW`
--

LOCK TABLES `ONSHOW` WRITE;
/*!40000 ALTER TABLE `ONSHOW` DISABLE KEYS */;
INSERT INTO `ONSHOW` VALUES (1,1,40,2017,5),(1,2,40,2017,11),(1,4,40,2018,2),(2,1,50,2017,9),(2,3,50,2018,1),(3,2,35,2017,10),(3,3,35,2017,5),(3,4,35,2017,9),(4,1,60,2017,2),(4,2,60,2017,11),(4,4,60,2018,3),(5,2,50,2017,4),(5,3,50,2017,8),(1,3,40,2017,9),(10,1,60,2017,1),(10,2,60,2017,2),(10,3,60,2017,3);
/*!40000 ALTER TABLE `ONSHOW` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `THEATER`
--

DROP TABLE IF EXISTS `THEATER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `THEATER` (
  `TID` int(11) NOT NULL,
  `TNAME` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TAREA` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ADDRESS` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`TID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `THEATER`
--

LOCK TABLES `THEATER` WRITE;
/*!40000 ALTER TABLE `THEATER` DISABLE KEYS */;
INSERT INTO `THEATER` VALUES (1,'影院一','洪山区','地址一'),(2,'影院二','洪山区','地址二'),(3,'影院三','武昌区','地址三'),(4,'影院四','武昌区','地址四');
/*!40000 ALTER TABLE `THEATER` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `YOUNG_ACTOR`
--

DROP TABLE IF EXISTS `YOUNG_ACTOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `YOUNG_ACTOR` (
  `ACTID` int(11) DEFAULT NULL,
  `ANAME` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SEX` enum('男','女') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BYEAR` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `YOUNG_ACTOR`
--

LOCK TABLES `YOUNG_ACTOR` WRITE;
/*!40000 ALTER TABLE `YOUNG_ACTOR` DISABLE KEYS */;
INSERT INTO `YOUNG_ACTOR` VALUES (1,'付内东','男',1998),(2,'胡晋源','男',1999),(6,'文柱锟','男',1998),(7,'田雨欣','女',1997),(8,'陈诗维','女',1998),(9,'测试老哥','男',1998);
/*!40000 ALTER TABLE `YOUNG_ACTOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `LEADING_80_ACTIN`
--

/*!50001 DROP VIEW IF EXISTS `LEADING_80_ACTIN`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `LEADING_80_ACTIN` AS select `ACTOR`.`ACTID` AS `ACTID`,`ACTOR`.`ANAME` AS `ANAME`,`ACTOR`.`BYEAR` AS `BYEAR`,count(`ACTOR`.`ACTID`) AS `LEADINGNUM`,max(`ACTIN`.`GRADE`) AS `MAXGRADE` from (`ACTOR` join `ACTIN`) where ((`ACTOR`.`ACTID` = `ACTIN`.`ACTID`) and (`ACTIN`.`ISLEADING` = 'Y')) group by `ACTOR`.`ACTID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-20 12:18:28
