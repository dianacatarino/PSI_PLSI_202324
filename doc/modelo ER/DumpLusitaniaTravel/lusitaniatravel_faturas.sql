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
-- Table structure for table `faturas`
--

DROP TABLE IF EXISTS `faturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faturas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `totalf` decimal(10,2) NOT NULL,
  `totalsi` decimal(10,2) NOT NULL,
  `iva` decimal(4,2) NOT NULL,
  `empresa_id` int NOT NULL,
  `reserva_id` int NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_faturas_empresas` (`empresa_id`),
  KEY `fk_faturas_reservas` (`reserva_id`),
  CONSTRAINT `fk_faturas_empresas` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `fk_faturas_reservas` FOREIGN KEY (`reserva_id`) REFERENCES `reservas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faturas`
--

LOCK TABLES `faturas` WRITE;
/*!40000 ALTER TABLE `faturas` DISABLE KEYS */;
INSERT INTO `faturas` VALUES (3,267.00,266.77,0.23,1,1,'2024-01-08'),(8,140.00,139.77,0.23,1,6,'2024-01-20'),(9,700.00,699.77,0.23,1,7,'2024-01-20'),(10,100.00,99.77,0.23,1,8,'2024-01-20'),(11,2700.00,2699.77,0.23,1,39,'2024-01-31'),(12,445.00,444.77,0.23,1,48,'2024-02-07'),(13,356.00,355.77,0.23,1,44,'2024-02-08'),(15,625.00,624.77,0.23,1,49,'2024-02-08'),(16,300.00,299.77,0.23,1,35,'2024-02-08'),(17,1780.00,1779.77,0.23,1,30,'2024-02-08'),(18,500.00,499.77,0.23,1,33,'2024-02-08'),(19,1390.00,1389.77,0.23,1,47,'2024-02-08'),(20,825.00,824.77,0.23,1,50,'2024-02-09'),(21,1000.00,999.77,0.23,1,53,'2024-02-09');
/*!40000 ALTER TABLE `faturas` ENABLE KEYS */;
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
