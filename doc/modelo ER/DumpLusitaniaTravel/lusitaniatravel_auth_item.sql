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
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('adicionarcarrinhoCompras',2,NULL,NULL,NULL,1699557407,1699557407),('adicionarFavoritos',2,NULL,NULL,NULL,1699557407,1699557407),('administrador',1,NULL,NULL,NULL,1699557407,1699557407),('calcularValoresIva',2,NULL,NULL,NULL,1699557407,1699557407),('classificarecomentarAlojamentos',2,NULL,NULL,NULL,1699557407,1699557407),('cliente',1,NULL,NULL,NULL,1699557407,1699557407),('confirmarReserva',2,NULL,NULL,NULL,1699557407,1699557407),('consultarFaturas',2,NULL,NULL,NULL,1699557407,1699557407),('criarAlojamentos',2,NULL,NULL,NULL,1699557407,1699557407),('criarClientes',2,NULL,NULL,NULL,1699557407,1699557407),('criarReservas',2,NULL,NULL,NULL,1699557407,1699557407),('editarAlojamentos',2,NULL,NULL,NULL,1699557407,1699557407),('editarClientes',2,NULL,NULL,NULL,1699557407,1699557407),('editarReservas',2,NULL,NULL,NULL,1699557407,1699557407),('eliminarAlojamentos',2,NULL,NULL,NULL,1699557407,1699557407),('eliminarClientes',2,NULL,NULL,NULL,1699557407,1699557407),('eliminarReservas',2,NULL,NULL,NULL,1699557407,1699557407),('emitirFaturas',2,NULL,NULL,NULL,1699557407,1699557407),('fornecedor',1,NULL,NULL,NULL,1699557407,1699557407),('funcionario',1,NULL,NULL,NULL,1699557407,1699557407),('gerarRelatorios',2,NULL,NULL,NULL,1699557407,1699557407),('pagarReserva',2,NULL,NULL,NULL,1699557407,1699557407),('reservarOnline',2,NULL,NULL,NULL,1699557407,1699557407),('reservarPresencial',2,NULL,NULL,NULL,1699557407,1699557407),('verAlojamentos',2,NULL,NULL,NULL,1699557407,1699557407),('verClientes',2,NULL,NULL,NULL,1699557407,1699557407),('verReservas',2,NULL,NULL,NULL,1699557407,1699557407),('visualizarRelatorios',2,NULL,NULL,NULL,1699557407,1699557407);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-20 15:37:35
