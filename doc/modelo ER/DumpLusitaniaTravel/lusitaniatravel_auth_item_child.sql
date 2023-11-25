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
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('cliente','adicionarcarrinhoCompras'),('administrador','calcularValoresIva'),('funcionario','calcularValoresIva'),('cliente','classificarecomentarAlojamentos'),('fornecedor','confirmarReserva'),('cliente','consultarFaturas'),('administrador','criarAlojamentos'),('fornecedor','criarAlojamentos'),('funcionario','criarClientes'),('administrador','criarReservas'),('funcionario','criarReservas'),('administrador','editarAlojamentos'),('fornecedor','editarAlojamentos'),('funcionario','editarClientes'),('administrador','editarReservas'),('funcionario','editarReservas'),('administrador','eliminarAlojamentos'),('fornecedor','eliminarAlojamentos'),('funcionario','eliminarClientes'),('administrador','eliminarReservas'),('funcionario','eliminarReservas'),('administrador','emitirFaturas'),('administrador','gerarRelatorios'),('cliente','pagarReserva'),('cliente','reservarOnline'),('funcionario','reservarPresencial'),('administrador','verAlojamentos'),('fornecedor','verAlojamentos'),('funcionario','verClientes'),('administrador','verReservas'),('funcionario','verReservas'),('funcionario','visualizarRelatorios');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-25 12:27:25
