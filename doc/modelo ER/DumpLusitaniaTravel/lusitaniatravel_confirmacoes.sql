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
-- Table structure for table `confirmacoes`
--

DROP TABLE IF EXISTS `confirmacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `confirmacoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estado` enum('Pendente','Confirmado','Cancelado') DEFAULT NULL,
  `dataconfirmacao` date DEFAULT NULL,
  `reserva_id` int NOT NULL,
  `fornecedor_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_confirmacoes_reservas` (`reserva_id`),
  KEY `fk_confirmacoes_fornecedor` (`fornecedor_id`),
  CONSTRAINT `fk_confirmacoes_fornecedor` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedores` (`id`),
  CONSTRAINT `fk_confirmacoes_reservas` FOREIGN KEY (`reserva_id`) REFERENCES `reservas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `confirmacoes`
--

LOCK TABLES `confirmacoes` WRITE;
/*!40000 ALTER TABLE `confirmacoes` DISABLE KEYS */;
INSERT INTO `confirmacoes` VALUES (1,'Confirmado','2023-12-03',1,1),(2,'Pendente','0000-00-00',5,2),(3,'Confirmado','2023-12-20',6,8),(4,'Confirmado','2023-12-20',7,9),(5,'Confirmado','2023-12-20',8,9),(23,'Confirmado','2023-12-29',30,1),(26,'Confirmado','2023-12-29',33,2),(28,'Confirmado','2023-12-29',35,2),(32,'Confirmado','2023-12-29',39,2),(37,'Confirmado','2024-02-07',44,1),(40,'Confirmado','2024-02-07',47,2),(41,'Confirmado','2024-02-07',48,1),(42,'Confirmado','2024-02-08',49,3),(43,'Confirmado','2024-02-09',50,4),(46,'Confirmado','2024-02-09',53,2);
/*!40000 ALTER TABLE `confirmacoes` ENABLE KEYS */;
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
