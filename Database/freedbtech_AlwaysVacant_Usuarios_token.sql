-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: freedb.tech    Database: freedbtech_AlwaysVacant
-- ------------------------------------------------------
-- Server version	5.7.33-0ubuntu0.18.04.1

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
-- Table structure for table `Usuarios_token`
--

DROP TABLE IF EXISTS `Usuarios_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Usuarios_token` (
  `ID_Token` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Usuario` varchar(45) DEFAULT NULL,
  `Token` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_Token`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuarios_token`
--

LOCK TABLES `Usuarios_token` WRITE;
/*!40000 ALTER TABLE `Usuarios_token` DISABLE KEYS */;
INSERT  IGNORE INTO `Usuarios_token` (`ID_Token`, `ID_Usuario`, `Token`, `Estado`, `Fecha`) VALUES (1,'1001','e34748f5f7cb104a37704a535397a95a','Activo','2021-02-20 00:00:00'),(2,'1001','edeb0632cb39385c51be86ecc505ad4c','Activo','2021-02-20 00:00:00'),(3,'1001','24fde1e29f6227de466f9e832d3883f6','Activo','2021-02-20 00:00:00'),(4,'1001','db76d0f9f7dd2aca292ede964445ccfd','Activo','2021-02-20 18:02:47'),(5,'1001','0907a1cdde154b0a65a131f94d568a03','Activo','2021-02-22 00:00:00'),(6,'1001','8bf49a607eaee186bb14596a6604c3de','Activo','2021-02-22 00:00:00'),(7,'1001','3dd428dd04a1644cff7c56f1fe244a3e','Activo','2021-02-22 00:00:00'),(8,'1001','4b67ab89fc081061b9fce1be66ba988b','Activo','2021-02-22 00:00:00'),(9,'1001','6d9488b9e4e38691c3a79cc4d62e47cc','Activo','2021-02-22 00:00:00'),(10,'1001','2b6b9144d39e55e9261b76698d62520b','Activo','2021-02-22 00:00:00'),(11,'1001','76503985027f0724db40f220b7f5dd87','Activo','2021-02-22 00:00:00'),(12,'1001','4785ccd88e935565269d62bcd1417e43','Activo','2021-02-22 00:00:00'),(13,'1001','19a6eabe1cd6d67e95d2ced9f0897b43','Activo','2021-02-22 00:00:00'),(14,'1001','1f810b8968e468d8c2b78ec8e0e104b1','Activo','2021-02-22 00:00:00'),(15,'1001','5d308abc72744d704b924bdee6c23955','Activo','2021-02-23 00:00:00'),(16,'1001','bdab9c861e26129ddf9f1263bb0baa2a','Activo','2021-02-23 00:00:00'),(17,'1001','baa470de7c21f9e2236ffefbf31ceba5','Activo','2021-02-23 00:00:00'),(18,'1008','100337712fefc0de324a7cf9da586417','Activo','2021-02-23 00:00:00'),(19,'1008','d2f394a54f489c5cbea196a79b71c5b3','Activo','2021-02-23 00:00:00');
/*!40000 ALTER TABLE `Usuarios_token` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-22 22:15:14
