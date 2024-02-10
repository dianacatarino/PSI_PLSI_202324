-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: lusitaniatravel
-- ------------------------------------------------------
-- Server version	8.2.0

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
-- Table structure for table `linhasreservas`
--

DROP TABLE IF EXISTS `linhasreservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `linhasreservas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipoquarto` varchar(20) NOT NULL,
  `numeronoites` int NOT NULL,
  `numerocamas` int NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `reservas_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_linhasreservas_reservas` (`reservas_id`),
  CONSTRAINT `fk_linhasreservas_reservas` FOREIGN KEY (`reservas_id`) REFERENCES `reservas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linhasreservas`
--

LOCK TABLES `linhasreservas` WRITE;
/*!40000 ALTER TABLE `linhasreservas` DISABLE KEYS */;
INSERT INTO `linhasreservas` VALUES (1,'Quarto Duplo',3,2,89.00,1),(2,'Quarto Duplo',6,2,58.33,5),(3,'Quarto Duplo',6,2,58.33,5),(4,'Quarto Familiar',3,4,46.67,6),(6,'Quarto Duplo',7,2,100.00,7),(7,'Quarto Triplo',7,3,100.00,7),(8,'Quarto Individual',7,1,100.00,7),(10,'Quarto Duplo',4,2,25.00,8),(11,'Quarto Duplo',4,2,25.00,8),(12,'Quarto Individual',4,1,25.00,8),(28,'Quarto Duplo',8,1,222.50,30),(29,'Quarto Triplo',5,2,100.00,33),(30,'Quarto Triplo',5,2,100.00,33),(33,'Quarto Duplo',3,1,100.00,35),(37,'Quarto Familiar',4,4,675.00,39),(38,'Quarto Duplo',4,2,111.25,48),(39,'Quarto Triplo',3,2,463.33,47),(40,'Quarto Duplo',3,2,118.67,44),(41,'Quarto Individual',2,1,312.50,49),(42,'Quarto Duplo',2,2,412.50,50),(43,'Quarto Duplo',3,3,333.33,53);
/*!40000 ALTER TABLE `linhasreservas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-10  9:21:40
