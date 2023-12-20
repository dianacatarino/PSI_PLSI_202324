-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: lusitaniatravel
-- ------------------------------------------------------
-- Server version	8.0.31

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
-- Table structure for table `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fornecedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `responsavel` varchar(30) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `nome_alojamento` varchar(30) NOT NULL,
  `localizacao_alojamento` varchar(50) NOT NULL,
  `acomodacoes_alojamento` varchar(100) NOT NULL,
  `tipoquartos` varchar(150) NOT NULL,
  `numeroquartos` int NOT NULL,
  `precopornoite` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedores`
--

LOCK TABLES `fornecedores` WRITE;
/*!40000 ALTER TABLE `fornecedores` DISABLE KEYS */;
INSERT INTO `fornecedores` VALUES (1,'Fornecedor','Alojamento','Casa Mar','Algarve','Cama de Solteiro;WC Privativa;Pequeno Almoço','Individual;Duplo',25,89.00),(2,'Fornecedor1','Hotel','Hotel Arizona','Lisboa','Cama de Casal;Cama de Solteiro;Wi-Fi;TV;Piscina','Individual;Duplo;Triplo;Familiares',10,100.00),(3,'Fornecedor1','Alojamento','Casa Rosa','Lisboa','Cama de Casal;Cama de Solteiro;TV;Estacionamento','Individual;Duplo;Triplo;Familiares',5,125.00),(4,'Fornecedor','Alojamento','Casa Rosa','Lisboa','Cama de Casal;TV;AC;Estacionamento','Individual;Duplo;Triplo;Familiares',5,165.00),(8,'Fornecedor1','Hotel','Selene Hotel','Porto','Cama de Casal;Cama de Solteiro;Wi-Fi;TV;AC;WC Privativa;Piscina','Individual;Duplo;Triplo;Familiares',15,55.00),(9,'Fornecedor1','Resort','Hotel Arizona','Porto','Cama de Solteiro;Wi-Fi;TV;WC Privativa','Individual;Duplo;Triplo;Familiares',5,100.00),(11,'Fornecedor','Hotel','Hotel Algarve','Algarve','Cama de Casal;Cama de Solteiro;Wi-Fi','Individual;Duplo;Triplo;Familiares',5,200.00),(12,'Fornecedor1','Resort','Hotel Arizona','Porto','Cama de Solteiro;AC;WC Privativa','Individual;Duplo;Triplo;Familiares',5,100.00);
/*!40000 ALTER TABLE `fornecedores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-20 20:30:25
