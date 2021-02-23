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
-- Table structure for table `Vacante`
--

DROP TABLE IF EXISTS `Vacante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Vacante` (
  `ID_Vacante` int(200) NOT NULL AUTO_INCREMENT,
  `Compania` varchar(150) DEFAULT NULL,
  `Logo` varchar(400) DEFAULT NULL,
  `URL` varchar(9000) DEFAULT NULL,
  `Posicion` varchar(50) DEFAULT NULL,
  `Descripcion` varchar(10000) DEFAULT NULL,
  `ID_Ciudad` int(11) DEFAULT NULL,
  `Ubicacion` varchar(5000) DEFAULT NULL,
  `ID_Categoria` int(11) DEFAULT NULL,
  `ID_Tipo_Vacante` int(11) DEFAULT NULL,
  `Email` varchar(98) DEFAULT NULL,
  PRIMARY KEY (`ID_Vacante`),
  KEY `ID_Categoria` (`ID_Categoria`),
  KEY `ID_Tipo_Vacante` (`ID_Tipo_Vacante`),
  CONSTRAINT `Vacante_ibfk_1` FOREIGN KEY (`ID_Categoria`) REFERENCES `Categoria` (`ID_Categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Vacante_ibfk_2` FOREIGN KEY (`ID_Tipo_Vacante`) REFERENCES `Tipo_Vacante` (`ID_Tipo_Vacante`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Vacante`
--

LOCK TABLES `Vacante` WRITE;
/*!40000 ALTER TABLE `Vacante` DISABLE KEYS */;
INSERT  IGNORE INTO `Vacante` (`ID_Vacante`, `Compania`, `Logo`, `URL`, `Posicion`, `Descripcion`, `ID_Ciudad`, `Ubicacion`, `ID_Categoria`, `ID_Tipo_Vacante`, `Email`) VALUES (1,'Google Inc','wmproductor.com/AlwaysVacant/BackEnd/Images/60309904c5846.png','Google.com','Mobile Developer','',2,'2',1,1,'davidinojosa5@gmail.com'),(2,'Google Inc','wmproductor.com/AlwaysVacant/BackEnd/Images/6030a1158e222.png','Google.com','Mobile Developer','',2,'2',1,1,'davidinojosa5@gmail.com'),(3,'Twittter Inc','','Facebook.com','backend Developer','',10,'NY CITY',2,2,'davidinojosa5@gmail.com');
/*!40000 ALTER TABLE `Vacante` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-22 22:15:25
