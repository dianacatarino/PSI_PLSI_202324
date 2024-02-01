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
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` enum('Online','Presencial') DEFAULT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `numeroquartos` int NOT NULL,
  `numeroclientes` int NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `cliente_id` int NOT NULL,
  `funcionario_id` int NOT NULL,
  `fornecedor_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reservas_cliente` (`cliente_id`),
  KEY `fk_reservas_funcionario` (`funcionario_id`),
  KEY `fk_reservas_fornecedor` (`fornecedor_id`),
  CONSTRAINT `fk_reservas_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_reservas_fornecedor` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedores` (`id`),
  CONSTRAINT `fk_reservas_funcionario` FOREIGN KEY (`funcionario_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
INSERT INTO `reservas` VALUES (1,'Presencial','2023-12-05','2023-12-08',1,2,267.00,44,48,1),(5,'Presencial','2023-12-06','2023-12-12',2,4,350.00,46,54,2),(6,'Presencial','2023-12-25','2023-12-28',1,4,140.00,47,49,8),(7,'Presencial','2023-12-21','2023-12-28',3,6,700.00,56,49,9),(8,'Presencial','2023-12-14','2023-12-18',3,5,100.00,46,49,4),(30,'Online','2024-01-01','2024-01-09',1,2,1780.00,46,45,1),(33,'Online','2023-12-29','2024-01-03',2,5,500.00,47,45,2),(35,'Online','2024-01-02','2024-01-05',1,2,300.00,55,45,2),(38,'Online','0000-00-00','0000-00-00',0,0,0.00,56,45,12),(39,'Online','2023-12-31','2024-01-04',1,4,2700.00,44,45,2),(40,'Online','2024-02-01','2024-02-04',2,2,600.00,44,45,2);
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-01 19:12:31
