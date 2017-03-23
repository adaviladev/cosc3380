-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: cosc3380
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.1

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
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `street` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(10) unsigned DEFAULT NULL,
  `zipCode` int(9) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fkAddressToState` (`state`),
  CONSTRAINT `fkAddressToState` FOREIGN KEY (`state`) REFERENCES `states` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packageStatus`
--

DROP TABLE IF EXISTS `packageStatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packageStatus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modifiedBy` int(10) unsigned DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fkPackageStatusModifiedByUser` (`modifiedBy`),
  CONSTRAINT `fkPackageStatusModifiedByUser` FOREIGN KEY (`modifiedBy`) REFERENCES `postOffices` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packageStatus`
--

LOCK TABLES `packageStatus` WRITE;
/*!40000 ALTER TABLE `packageStatus` DISABLE KEYS */;
INSERT INTO `packageStatus` VALUES (1,'Processing',3,'2015-04-16 12:29:04','2016-04-09 15:08:05'),(2,'Out For Delivery',2,'2015-02-11 21:39:31','2016-02-24 16:10:48'),(3,'Delivered',2,'2016-03-26 23:38:40','2015-04-20 01:41:24'),(4,'Cancelled',1,'2016-09-18 08:09:39','2016-11-10 13:24:22');
/*!40000 ALTER TABLE `packageStatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packageTypes`
--

DROP TABLE IF EXISTS `packageTypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packageTypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packageTypes`
--

LOCK TABLES `packageTypes` WRITE;
/*!40000 ALTER TABLE `packageTypes` DISABLE KEYS */;
INSERT INTO `packageTypes` VALUES (1,'Normal','2015-11-06 23:49:17','2016-02-16 08:03:19'),(2,'Fragile','2015-05-28 11:08:10','2016-05-02 13:35:09');
/*!40000 ALTER TABLE `packageTypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned DEFAULT NULL,
  `postOfficeId` int(10) unsigned DEFAULT NULL,
  `typeId` int(10) unsigned DEFAULT NULL,
  `transactionId` int(10) unsigned DEFAULT NULL,
  `destination` int(10) unsigned DEFAULT NULL,
  `returnAddress` int(10) unsigned DEFAULT NULL,
  `contents` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `priority` tinyint(1) DEFAULT NULL,
  `packageStatus` int(10) unsigned DEFAULT NULL,
  `modifiedBy` int(10) unsigned DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fkPackagesToUserId` (`userId`),
  KEY `fkPackagesToPostOfficeId` (`postOfficeId`),
  KEY `fkPackagesToTypeId` (`typeId`),
  KEY `fkPackagesToTransactionId` (`transactionId`),
  KEY `fkPackagesToDestination` (`destination`),
  KEY `fkPackagesToReturnAddress` (`returnAddress`),
  KEY `fkModifiedBy` (`modifiedBy`),
  CONSTRAINT `fkModifiedBy` FOREIGN KEY (`modifiedBy`) REFERENCES `users` (`id`),
  CONSTRAINT `fkPackagesToDestination` FOREIGN KEY (`destination`) REFERENCES `addresses` (`id`),
  CONSTRAINT `fkPackagesToPostOfficeId` FOREIGN KEY (`postOfficeId`) REFERENCES `postOffices` (`id`),
  CONSTRAINT `fkPackagesToReturnAddress` FOREIGN KEY (`returnAddress`) REFERENCES `addresses` (`id`),
  CONSTRAINT `fkPackagesToTransactionId` FOREIGN KEY (`transactionId`) REFERENCES `transactions` (`id`),
  CONSTRAINT `fkPackagesToTypeId` FOREIGN KEY (`typeId`) REFERENCES `packageTypes` (`id`),
  CONSTRAINT `fkPackagesToUserId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages`
--

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postOffices`
--

DROP TABLE IF EXISTS `postOffices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postOffices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stateId` int(10) unsigned DEFAULT NULL,
  `zipCode` int(9) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fkPostOfficeStateIdToStatesId` (`stateId`),
  CONSTRAINT `fkPostOfficeStateIdToStatesId` FOREIGN KEY (`stateId`) REFERENCES `states` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postOffices`
--

LOCK TABLES `postOffices` WRITE;
/*!40000 ALTER TABLE `postOffices` DISABLE KEYS */;
/*!40000 ALTER TABLE `postOffices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','2016-01-01 00:00:00','2016-01-01 00:00:00'),(2,'employee','2016-01-01 00:00:00','2016-01-01 00:00:00'),(3,'customer','2016-01-01 00:00:00','2016-01-01 00:00:00');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `state` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (1,'AL'),(2,'AK'),(3,'AZ'),(4,'AR'),(5,'CA'),(6,'CO'),(7,'CT'),(8,'DE'),(9,'FL'),(10,'GA'),(11,'HI'),(12,'ID'),(13,'IL'),(14,'IN'),(15,'IA'),(16,'KS'),(17,'KY'),(18,'LA'),(19,'ME'),(20,'MD'),(21,'MA'),(22,'MI'),(23,'MN'),(24,'MS'),(25,'MO'),(26,'MT'),(27,'NE'),(28,'NV'),(29,'NH'),(30,'NJ'),(31,'NM'),(32,'NY'),(33,'NC'),(34,'ND'),(35,'OH'),(36,'OK'),(37,'OR'),(38,'PA'),(39,'RI'),(40,'SC'),(41,'SD'),(42,'TN'),(43,'TX'),(44,'UT'),(45,'VT'),(46,'VA'),(47,'WA'),(48,'WV'),(49,'WI'),(50,'WY');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customerId` int(10) unsigned DEFAULT NULL,
  `postOfficeId` int(10) unsigned DEFAULT NULL,
  `employeeId` int(10) unsigned DEFAULT NULL,
  `packageId` int(10) unsigned DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fkTransactionToCustomerId` (`customerId`),
  KEY `fkTransactionToPostOfficeId` (`postOfficeId`),
  KEY `fkTransactionToEmployeeId` (`employeeId`),
  KEY `fkTransactionToPackageId` (`packageId`),
  CONSTRAINT `fkTransactionToCustomerId` FOREIGN KEY (`customerId`) REFERENCES `users` (`id`),
  CONSTRAINT `fkTransactionToEmployeeId` FOREIGN KEY (`employeeId`) REFERENCES `users` (`id`),
  CONSTRAINT `fkTransactionToPackageId` FOREIGN KEY (`packageId`) REFERENCES `packages` (`id`),
  CONSTRAINT `fkTransactionToPostOfficeId` FOREIGN KEY (`postOfficeId`) REFERENCES `postOffices` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addressId` int(10) DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roleId` int(10) unsigned DEFAULT NULL,
  `postOfficeId` int(10) unsigned DEFAULT NULL,
  `modifiedBy` int(10) unsigned DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdBy` int(10) unsigned DEFAULT NULL,
  `modifiedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fkUserToPostOfficeId` (`postOfficeId`),
  KEY `fkUserToRoleId` (`roleId`),
  KEY `fkUserToCreatedUserId` (`createdBy`),
  KEY `fkUserToModifiedUserId` (`modifiedBy`),
  CONSTRAINT `fkUserToCreatedUserId` FOREIGN KEY (`createdBy`) REFERENCES `users` (`id`),
  CONSTRAINT `fkUserToModifiedUserId` FOREIGN KEY (`modifiedBy`) REFERENCES `users` (`id`),
  CONSTRAINT `fkUserToPostOfficeId` FOREIGN KEY (`postOfficeId`) REFERENCES `postOffices` (`id`),
  CONSTRAINT `fkUserToRoleId` FOREIGN KEY (`roleId`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Jesse','Myers',118,'jmyers0@macromedia.com',2,14,82,'2016-11-14 10:42:19',84,'2016-05-16 00:32:08'),(2,'Carl','Day',141,'cday1@auda.org.au',1,2,78,'2016-08-23 11:58:54',76,'2016-10-07 20:21:23'),(3,'Louise','Wright',162,'lwright2@msu.edu',2,3,62,'2017-01-20 15:49:41',99,'2016-11-26 05:36:01'),(4,'Lillian','Moore',105,'lmoore3@cbsnews.com',1,2,60,'2016-03-08 21:16:32',12,'2017-01-19 11:02:34'),(5,'Gregory','Mason',129,'gmason4@nymag.com',2,13,78,'2016-03-01 07:36:55',23,'2016-01-21 16:49:46'),(6,'Daniel','Ramos',4,'dramos5@vinaora.com',1,4,85,'2016-12-30 13:38:28',19,'2016-03-06 10:50:50'),(7,'Nicholas','Dixon',162,'ndixon6@ning.com',3,NULL,97,'2016-04-30 04:40:47',71,'2016-09-18 15:21:29'),(8,'Robert','Long',56,'rlong7@istockphoto.com',2,1,86,'2016-04-17 06:25:58',91,'2016-12-20 16:15:17'),(9,'Steve','Sanchez',36,'ssanchez8@flavors.me',2,15,33,'2016-03-13 13:24:49',60,'2016-03-11 17:20:48'),(10,'Linda','Evans',22,'levans9@auda.org.au',2,4,64,'2016-10-20 01:55:56',31,'2016-05-28 23:42:23'),(11,'Joseph','Tucker',158,'jtuckera@paginegialle.it',2,29,62,'2016-07-24 15:12:30',19,'2016-11-24 09:07:52'),(12,'Paul','Little',106,'plittleb@furl.net',2,23,10,'2017-02-22 22:25:18',55,'2016-12-04 22:19:47'),(13,'Aaron','Hernandez',143,'ahernandezc@xrea.com',2,26,1,'2016-07-03 08:06:38',46,'2016-01-15 11:20:02'),(14,'Kathleen','Fernandez',172,'kfernandezd@fastcompany.com',1,4,61,'2016-12-03 01:53:41',43,'2016-10-18 06:02:10'),(15,'Ronald','Daniels',134,'rdanielse@epa.gov',1,2,44,'2017-02-20 19:10:37',52,'2016-11-17 23:30:53'),(16,'Alice','Harris',158,'aharrisf@theglobeandmail.com',1,21,NULL,'2016-12-07 16:39:52',NULL,'2016-11-28 04:07:29'),(17,'Judy','Ross',104,'jrossg@dion.ne.jp',2,12,4,'2017-01-09 11:29:52',95,'2016-01-23 18:43:48'),(18,'Gary','Robertson',24,'grobertsonh@blogs.com',1,29,18,'2016-07-29 04:02:44',3,'2016-11-15 03:09:27'),(19,'Brenda','Burns',192,'bburnsi@yahoo.co.jp',2,5,15,'2016-06-14 05:29:35',49,'2016-01-15 19:48:29'),(20,'Donna','Snyder',147,'dsnyderj@usatoday.com',2,28,80,'2016-11-06 06:21:36',58,'2016-09-25 16:53:29'),(21,'Alan','Johnston',193,'ajohnstonk@zdnet.com',3,NULL,25,'2016-12-25 05:14:32',58,'2016-05-13 10:54:30'),(22,'Raymond','Kim',195,'rkiml@biblegateway.com',2,24,4,'2017-02-11 16:14:43',33,'2017-02-02 07:55:55'),(23,'Laura','Roberts',151,'lrobertsm@bloglines.com',2,1,100,'2016-03-04 21:51:51',56,'2016-06-29 01:46:28'),(24,'Ryan','Gomez',68,'rgomezn@sourceforge.net',2,1,34,'2016-12-19 19:20:57',16,'2016-01-29 17:44:06'),(25,'Carolyn','Parker',82,'cparkero@psu.edu',1,1,10,'2016-08-22 12:17:04',15,'2016-02-14 07:56:28'),(26,'Bobby','Perkins',41,'bperkinsp@ustream.tv',1,19,65,'2016-09-08 00:16:58',51,'2016-01-11 17:16:35'),(27,'Edward','Duncan',98,'eduncanq@indiatimes.com',1,2,54,'2016-05-07 16:44:57',66,'2016-04-28 02:43:09'),(28,'Mildred','Rogers',108,'mrogersr@ocn.ne.jp',2,20,56,'2016-01-04 05:54:21',30,'2016-04-06 00:20:10'),(29,'Christine','Patterson',173,'cpattersons@comsenz.com',3,NULL,21,'2017-01-29 00:03:37',55,'2017-02-20 15:43:40'),(30,'Marilyn','Baker',63,'mbakert@walmart.com',3,NULL,47,'2016-04-04 03:38:46',43,'2016-03-01 06:16:42'),(31,'David','Daniels',192,'ddanielsu@naver.com',3,NULL,89,'2016-04-29 12:14:29',56,'2017-02-20 19:19:51'),(32,'Antonio','Ferguson',180,'afergusonv@surveymonkey.com',3,NULL,90,'2016-04-03 15:39:31',52,'2017-01-06 15:23:03'),(33,'William','Clark',198,'wclarkw@issuu.com',3,NULL,83,'2016-03-09 13:32:54',21,'2016-04-05 13:51:08'),(34,'Karen','Cox',149,'kcoxx@earthlink.net',3,NULL,71,'2016-06-26 06:13:02',10,'2016-12-30 21:55:32'),(35,'Joyce','Wagner',32,'jwagnery@eepurl.com',1,6,99,'2016-02-28 12:47:25',79,'2016-05-24 14:32:53'),(36,'Julia','Gibson',146,'jgibsonz@creativecommons.org',2,3,4,'2016-02-09 13:12:02',33,'2016-12-17 05:23:37'),(37,'Marilyn','Holmes',186,'mholmes10@flavors.me',2,10,36,'2016-12-29 22:06:56',46,'2016-09-14 21:43:28'),(38,'Debra','White',91,'dwhite11@lulu.com',3,NULL,NULL,'2016-11-23 17:05:06',NULL,'2016-06-11 21:52:34'),(39,'Janet','Arnold',11,'jarnold12@networksolutions.com',2,7,88,'2016-08-11 07:26:12',100,'2016-10-29 14:50:03'),(40,'Carlos','Roberts',176,'croberts13@mashable.com',1,5,31,'2016-04-13 02:13:23',33,'2016-05-05 19:07:23'),(41,'Doris','Hanson',29,'dhanson14@slate.com',2,26,6,'2017-02-01 04:26:52',4,'2016-04-04 15:48:00'),(42,'Janice','Roberts',80,'jroberts15@aboutads.info',2,5,91,'2016-11-28 16:12:59',2,'2016-03-13 18:06:46'),(43,'Ronald','Porter',131,'rporter16@geocities.com',3,NULL,24,'2016-05-06 12:11:48',2,'2016-07-19 20:47:51'),(44,'Robert','Fields',71,'rfields17@clickbank.net',1,23,8,'2016-04-10 20:39:30',29,'2016-12-24 15:12:04'),(45,'Margaret','Berry',173,'mberry18@wired.com',1,30,53,'2016-06-23 06:26:48',3,'2017-01-30 23:49:59'),(46,'Irene','Wood',139,'iwood19@netlog.com',1,11,85,'2016-11-02 14:52:32',85,'2017-01-23 10:52:00'),(47,'Joyce','Day',99,'jday1a@gnu.org',2,1,9,'2017-01-15 07:58:49',87,'2016-01-10 15:44:04'),(48,'Todd','Marshall',64,'tmarshall1b@si.edu',1,13,82,'2016-03-09 12:54:54',76,'2016-03-03 19:16:19'),(49,'Ruby','Gutierrez',123,'rgutierrez1c@gnu.org',2,13,69,'2016-05-19 10:47:53',72,'2016-01-19 21:31:22'),(50,'Jane','Patterson',168,'jpatterson1d@time.com',3,NULL,37,'2016-05-11 23:57:10',46,'2017-02-15 08:24:51'),(51,'Scott','Fisher',80,'sfisher1e@epa.gov',1,9,35,'2016-07-13 18:56:58',51,'2016-08-11 06:26:34'),(52,'Melissa','Webb',148,'mwebb1f@ameblo.jp',2,14,13,'2016-06-05 11:16:30',84,'2016-03-25 15:34:05'),(53,'Maria','Carr',170,'mcarr1g@yellowbook.com',3,NULL,91,'2016-06-09 18:40:37',99,'2016-02-05 21:07:30'),(54,'Christina','Kennedy',119,'ckennedy1h@qq.com',3,NULL,52,'2016-01-09 19:09:13',63,'2016-10-04 20:38:55'),(55,'Phyllis','Kelley',106,'pkelley1i@infoseek.co.jp',1,11,33,'2016-10-12 22:02:47',17,'2016-11-13 11:38:16'),(56,'Maria','Ward',63,'mward1j@webeden.co.uk',3,NULL,52,'2016-06-27 13:52:05',58,'2016-07-11 11:00:32'),(57,'Jessica','Stevens',74,'jstevens1k@webmd.com',1,15,67,'2017-01-04 17:47:12',81,'2016-06-03 19:24:42'),(58,'Arthur','Scott',87,'ascott1l@ihg.com',1,26,7,'2016-09-16 21:36:15',15,'2017-02-19 15:00:47'),(59,'Ruby','Evans',68,'revans1m@technorati.com',1,24,65,'2016-05-25 20:44:02',92,'2016-02-04 05:49:35'),(60,'Jacqueline','Mitchell',150,'jmitchell1n@nhs.uk',2,5,86,'2016-07-06 08:40:02',5,'2016-12-18 23:26:39'),(61,'Jack','Washington',15,'jwashington1o@devhub.com',1,19,71,'2016-05-18 10:46:57',93,'2017-01-31 02:25:11'),(62,'Randy','Payne',128,'rpayne1p@mlb.com',3,NULL,52,'2016-06-18 08:14:47',40,'2016-04-14 01:18:29'),(63,'Larry','Perry',80,'lperry1q@livejournal.com',3,NULL,37,'2016-09-18 02:54:09',89,'2016-10-27 18:43:55'),(64,'Amy','Alvarez',142,'aalvarez1r@rakuten.co.jp',2,17,78,'2016-11-12 12:07:13',25,'2016-11-12 22:39:26'),(65,'Gerald','Jones',73,'gjones1s@rediff.com',2,10,77,'2016-12-05 23:21:54',9,'2016-10-11 02:34:24'),(66,'George','Daniels',139,'gdaniels1t@weather.com',3,NULL,31,'2016-12-13 13:10:56',64,'2016-08-18 19:38:58'),(67,'Amy','Wilson',137,'awilson1u@cdbaby.com',2,10,3,'2016-02-14 01:13:48',13,'2016-08-18 17:32:19'),(68,'Kevin','Pierce',145,'kpierce1v@census.gov',1,10,99,'2016-06-13 20:24:23',10,'2016-09-07 20:00:58'),(69,'Margaret','Bell',57,'mbell1w@prlog.org',1,10,20,'2016-05-04 05:51:53',92,'2016-06-16 03:01:49'),(70,'Frances','Barnes',184,'fbarnes1x@posterous.com',1,6,35,'2016-01-28 15:07:38',3,'2016-05-09 15:50:13'),(71,'Melissa','Robinson',56,'mrobinson1y@bloglines.com',1,24,26,'2016-12-23 01:28:26',48,'2017-01-01 06:16:13'),(72,'Bobby','Miller',16,'bmiller1z@ameblo.jp',3,NULL,83,'2016-06-12 09:56:48',32,'2017-02-20 23:08:30'),(73,'Mary','Medina',40,'mmedina20@weather.com',3,NULL,90,'2016-04-22 05:31:27',67,'2016-02-07 14:25:59'),(74,'Cynthia','Mendoza',159,'cmendoza21@desdev.cn',1,9,98,'2017-01-23 04:00:55',15,'2016-10-30 08:03:45'),(75,'Andrew','Hunter',107,'ahunter22@answers.com',2,6,70,'2016-03-12 00:00:07',97,'2017-01-10 10:18:43'),(76,'Donna','Meyer',85,'dmeyer23@jalbum.net',2,8,2,'2016-03-10 13:14:49',56,'2016-10-20 08:18:50'),(77,'Frank','Crawford',143,'fcrawford24@spotify.com',3,NULL,100,'2016-03-17 20:19:18',75,'2016-10-10 05:09:40'),(78,'Alice','Jacobs',162,'ajacobs25@spiegel.de',3,NULL,NULL,'2016-01-26 10:14:51',NULL,'2016-04-05 21:36:13'),(79,'Brian','Johnston',109,'bjohnston26@toplist.cz',2,2,88,'2016-10-24 19:41:38',94,'2016-12-28 03:35:21'),(80,'Jeffrey','Fisher',10,'jfisher27@wisc.edu',1,3,58,'2016-04-20 15:25:07',77,'2016-09-29 03:58:04'),(81,'Eugene','Lynch',110,'elynch28@xinhuanet.com',3,NULL,94,'2016-03-13 06:55:50',65,'2016-11-23 20:16:54'),(82,'Anne','Fuller',178,'afuller29@example.com',1,24,10,'2016-03-31 09:34:10',22,'2017-02-17 21:02:48'),(83,'Mark','Olson',106,'molson2a@bizjournals.com',2,28,92,'2016-04-07 02:46:21',27,'2016-12-31 13:50:43'),(84,'Irene','Gardner',39,'igardner2b@noaa.gov',1,4,27,'2016-03-04 20:24:09',84,'2017-02-20 15:28:10'),(85,'Elizabeth','Gordon',78,'egordon2c@github.io',3,NULL,28,'2016-06-24 22:30:02',16,'2017-01-10 15:13:16'),(86,'George','Hansen',118,'ghansen2d@webeden.co.uk',1,30,38,'2017-02-15 22:23:04',62,'2016-11-20 03:27:30'),(87,'Frank','Turner',51,'fturner2e@microsoft.com',3,NULL,80,'2017-01-31 05:43:17',67,'2016-06-13 01:39:15'),(88,'Keith','Grant',154,'kgrant2f@digg.com',2,25,90,'2017-02-08 01:22:59',19,'2016-01-18 22:16:08'),(89,'Stephanie','Reynolds',129,'sreynolds2g@dell.com',2,21,91,'2016-05-28 15:04:43',8,'2016-01-28 06:53:39'),(90,'Diana','Adams',148,'dadams2h@cafepress.com',3,NULL,67,'2016-07-28 07:01:03',4,'2016-07-11 00:32:45'),(91,'Cheryl','Perkins',117,'cperkins2i@dropbox.com',1,21,61,'2016-12-20 15:39:55',57,'2016-04-12 11:49:32'),(92,'Brenda','Dixon',17,'bdixon2j@diigo.com',2,14,NULL,'2016-06-01 12:08:13',NULL,'2016-02-12 23:07:47'),(93,'Louis','Johnston',57,'ljohnston2k@spotify.com',2,18,78,'2016-05-29 12:01:16',85,'2016-08-28 16:01:50'),(94,'Terry','Cunningham',93,'tcunningham2l@squarespace.com',2,28,83,'2016-09-22 11:50:52',31,'2016-03-14 21:40:31'),(95,'Christina','Hill',170,'chill2m@flavors.me',3,NULL,81,'2016-10-30 02:11:22',69,'2016-12-11 18:32:41'),(96,'Aaron','Rice',152,'arice2n@reference.com',2,14,4,'2016-05-04 10:37:08',63,'2016-04-22 00:04:48'),(97,'Barbara','Sanchez',105,'bsanchez2o@uiuc.edu',2,6,NULL,'2016-11-30 03:37:31',NULL,'2016-07-05 03:37:30'),(98,'Debra','Bradley',53,'dbradley2p@delicious.com',3,NULL,63,'2016-07-20 16:34:23',89,'2016-07-22 12:04:42'),(99,'Clarence','Little',7,'clittle2q@pen.io',3,NULL,81,'2016-09-10 19:34:41',66,'2016-03-03 23:50:57'),(100,'Raymond','Peters',183,'rpeters2r@cnet.com',1,7,14,'2017-01-09 14:46:10',53,'2016-09-01 02:43:51');
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

-- Dump completed on 2017-03-01  4:52:16
