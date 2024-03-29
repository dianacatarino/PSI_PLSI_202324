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
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `mobile` varchar(9) NOT NULL,
  `street` varchar(30) NOT NULL,
  `locale` varchar(20) NOT NULL,
  `postalCode` varchar(10) NOT NULL,
  `role` enum('admin','funcionario','fornecedor','cliente') DEFAULT NULL,
  `user_id` int NOT NULL,
  `favorites` text,
  PRIMARY KEY (`id`),
  KEY `pk_profile_user_id` (`user_id`),
  CONSTRAINT `pk_profile_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,'Diana','912123012','Rua da Flor','Leiria','2101-021','cliente',44,'{\"2\":\"12\",\"4\":\"3\",\"5\":\"1\",\"6\":\"8\"}'),(2,'Lusitania Travel','912123123','Rua','Leiria','2132-012','admin',45,NULL),(3,'Maria','912301123','Rua','Leiria','2301-021','cliente',46,'[\"8\"]'),(4,'User','912301123','Rua','Leiria','2301-021','cliente',47,'[\"3\"]'),(5,'Funcionario','912301123','Rua','Leiria','2312-012','funcionario',48,NULL),(6,'Funcionario1','912301123','Rua','Leiria','2312-012','funcionario',49,NULL),(9,'Fornecedor','912301123','Rua do Fornecedor','Leiria','2101-012','fornecedor',52,NULL),(10,'Funcionario2','912342123','Rua do Funcionario','Leiria','2123-012','funcionario',54,NULL),(11,'User1','912301123','Rua do User1','Leiria','2101-021','cliente',55,'[\"2\"]'),(12,'User2','912342123','Rua ','Leiria','2312-012','cliente',56,NULL),(13,'Fornecedor1','912123123','Rua do Fornecedor 1','Leiria','2312-034','fornecedor',57,NULL),(14,'User6','987654320','Rua Azul','Leiria','2312-012','cliente',58,NULL),(15,'User3','961202491','Rua do User','Leiria','2312-013','cliente',59,'[\"3\"]');
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-10  9:21:41
