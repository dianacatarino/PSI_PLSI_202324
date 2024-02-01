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
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `rule_name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
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
INSERT INTO `auth_item` VALUES ('adicionarcarrinhoCompras',2,'Adicionar ao Carrinho de Compras',NULL,NULL,1700914132,1700914132),('adicionarFavoritos',2,'Adicionar aos Favoritos',NULL,NULL,1700914132,1700914132),('administrador',1,NULL,NULL,NULL,1700914132,1700914132),('calcularValoresIva',2,'Calcular Valores do IVA',NULL,NULL,1700914132,1700914132),('classificarecomentarAlojamentos',2,'Classificar e Comentar Alojamentos',NULL,NULL,1700914132,1700914132),('cliente',1,NULL,NULL,NULL,1700914132,1700914132),('confirmarReserva',2,'Confirmar Reserva',NULL,NULL,1700914132,1700914132),('consultarFaturas',2,'Consultar Faturas',NULL,NULL,1700914132,1700914132),('criarAlojamentos',2,'Criar Alojamentos',NULL,NULL,1700914132,1700914132),('criarClientes',2,'Criar Clientes',NULL,NULL,1700914132,1700914132),('criarReservas',2,'Criar Reservas',NULL,NULL,1700914132,1700914132),('editarAlojamentos',2,'Editar Alojamentos',NULL,NULL,1700914132,1700914132),('editarClientes',2,'Editar Clientes',NULL,NULL,1700914132,1700914132),('editarReservas',2,'Editar Reservas',NULL,NULL,1700914132,1700914132),('eliminarAlojamentos',2,'Eliminar Alojamentos',NULL,NULL,1700914132,1700914132),('eliminarClientes',2,'Eliminar Clientes',NULL,NULL,1700914132,1700914132),('eliminarReservas',2,'Eliminar Reservas',NULL,NULL,1700914132,1700914132),('emitirFaturas',2,'Emitir Faturas',NULL,NULL,1700914132,1700914132),('fornecedor',1,NULL,NULL,NULL,1700914132,1700914132),('funcionario',1,NULL,NULL,NULL,1700914132,1700914132),('gerarRelatorios',2,'Gerar Relatórios',NULL,NULL,1700914132,1700914132),('pagarReserva',2,'Pagar Reserva',NULL,NULL,1700914132,1700914132),('reservarOnline',2,'Reservar Online',NULL,NULL,1700914132,1700914132),('reservarPresencial',2,'Reservar Presencialmente',NULL,NULL,1700914132,1700914132),('verAlojamentos',2,'Ver Alojamentos',NULL,NULL,1700914132,1700914132),('verClientes',2,'Ver Clientes',NULL,NULL,1700914132,1700914132),('verReservas',2,'Ver Reservas',NULL,NULL,1700914132,1700914132),('visualizarRelatorios',2,'Visualizar Relatórios',NULL,NULL,1700914132,1700914132);
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

-- Dump completed on 2024-02-01 19:12:31
