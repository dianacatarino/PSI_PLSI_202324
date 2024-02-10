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
-- Table structure for table `linhasfaturas`
--

DROP TABLE IF EXISTS `linhasfaturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `linhasfaturas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quantidade` int NOT NULL,
  `precounitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `iva` decimal(4,2) NOT NULL,
  `fatura_id` int NOT NULL,
  `linhasreservas_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_linhasfaturas_faturas` (`fatura_id`),
  KEY `fk_linhasfaturas_linhasreservas` (`linhasreservas_id`),
  CONSTRAINT `fk_linhasfaturas_faturas` FOREIGN KEY (`fatura_id`) REFERENCES `faturas` (`id`),
  CONSTRAINT `fk_linhasfaturas_linhasreservas` FOREIGN KEY (`linhasreservas_id`) REFERENCES `linhasreservas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linhasfaturas`
--

LOCK TABLES `linhasfaturas` WRITE;
/*!40000 ALTER TABLE `linhasfaturas` DISABLE KEYS */;
INSERT INTO `linhasfaturas` VALUES (1,1,89.00,267.00,0.23,3,1),(2,1,46.67,140.00,0.23,8,4),(3,1,100.00,700.00,0.23,9,6),(4,1,100.00,700.00,0.23,9,7),(5,1,100.00,700.00,0.23,9,8),(6,1,25.00,100.00,0.23,10,10),(7,1,25.00,100.00,0.23,10,11),(8,1,25.00,100.00,0.23,10,12),(9,1,675.00,2700.00,0.23,11,37),(10,1,89.00,445.00,0.23,12,38),(11,1,89.00,356.00,0.23,13,40),(12,1,125.00,625.00,0.23,15,41),(13,1,100.00,300.00,0.23,16,33),(14,1,222.50,1780.00,0.23,17,28),(15,1,100.00,500.00,0.23,18,29),(16,1,100.00,500.00,0.23,18,30),(17,1,463.33,1390.00,0.23,19,39),(18,1,165.00,825.00,0.23,20,42),(19,1,100.00,1000.00,0.23,21,43);
/*!40000 ALTER TABLE `linhasfaturas` ENABLE KEYS */;
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
