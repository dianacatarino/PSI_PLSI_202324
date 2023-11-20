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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `name` varchar(25) COLLATE utf8mb3_unicode_ci NOT NULL,
  `mobile` varchar(9) COLLATE utf8mb3_unicode_ci NOT NULL,
  `street` varchar(30) COLLATE utf8mb3_unicode_ci NOT NULL,
  `locale` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  `postalCode` varchar(10) COLLATE utf8mb3_unicode_ci NOT NULL,
  `role` enum('admin','funcionario','fornecedor','cliente') COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'diana','KdN1on0b7oub3XVnPJkobFBttMJDy5rM','$2y$13$kseq4Us4OHodgflS/yKdv.o4SsSx4FDv0MK3uyOyZq4CP0q5OoJ6y',NULL,'diana@email.com',10,1699555248,1699555248,'40bVOA_wrNnH6cwJyi4RyNpRRVHXxwdB_1699555248','Diana','963921497','Rua dos Combatentes','Leiria','2491-012','cliente'),(2,'cliente','bWMGEOYpNMPHI-HsAYMtrT3QKjFkgPmi','$2y$13$krGMPl4bBalP8lmAYcft5eMdAPrNGX66PGnTX1P2OH4s9RhblzNqO',NULL,'cliente@email.com',10,1699557971,1699557971,'LfwD2l-3yPxUepn6y74F8VK9MsJwaf6K_1699557971','Cliente','987654321','Rua do Cliente','Leiria','2431-012','cliente'),(3,'cliente1','Mic3ntV_bzUvmGr3epH0VxOeX4o4d3iL','$2y$13$zIg1jG/cNqGfrcSDoIDReOJr98AcEnjVRxpfGvvoH.WEqUgdh.GEK',NULL,'cliente1@email.com',10,1699558324,1699558324,'UAHTj0yzd2vmsKlxfbyLH-E-6clJJ55C_1699558324','Cliente1','987654321','Rua do Cliente','Leiria','2431-012','cliente'),(4,'maria','28RIw1wpP2dJOwWY4XGQJRmbu8XdNfPH','$2y$13$zZOY4RjfUaP1usfio0AhlezdwZOSB2c6ztIhe3z9ypb701EqX6X6e',NULL,'maria@email.com',10,1699559501,1699559501,'-R_ugebyNxn1grUPL7ub3nrZYKhJVLN4_1699559501','Maria','912123123','Rua da Flor','Leiria','2431-012','cliente'),(5,'admin','eA6lBCVVVG6ozeMU-FDwOW9Auc26v_C7','$2y$13$gd8041oPnNYJy89zURMbW.eIRDpSi87MGLQHDI8MnE5cEYccqo56y',NULL,'admin@gmail.com',10,1699711168,1699711168,'jdkHu2Q44PnCiXQZAPxzFdaj2ogShriM_1699711168','Admin','987654321','Rua do Admin','Leiria','2431-012','admin'),(6,'funcionario','N36CMVIeEhr8W4ubrKFcUCOwm_EYaUvl','$2y$13$Sg3m9gHoo9cCWYpWWcoq.OkSw2XEMVFfwbKephYcrZqUKwxvyPfJy',NULL,'funcionario@gmail.com',10,1699711352,1699711352,'GJzLqAY063p3jUUxaPa1nhXjSxpmYG6P_1699711352','Funcionario','908765123','Rua do Funcionario','Leiria','2312-012','funcionario'),(19,'fornecedor','Im_upcn8ZZSgT-YLn8hwjVegfUVfR38Z','$2y$13$CnkmiYol4VsA96xTulTexei74YONIEvbbbvL59z8Bl1xYDKnrXIk6',NULL,'fornecedor@gmail.com',10,1699961050,1699971926,'qcTgILpUIawPuB_O8_Ro5cmWuFoY-0GT_1699961050','Fornecedor','987123456','Rua do Fornecedor','Leiria','2301-021','fornecedor'),(29,'fornecedor2','83lOWwarokQGtvS8HLs9S0774AO2wb3j','$2y$13$IxS9yomQfxoJxq6qKp2Xpur41Jo8vDZOQhCf1vKMtJ8Ekug.Ij9bK',NULL,'fornecedor2@gmail.com',9,1700327976,1700327976,'7459AWOzJPJLovyRAOgkYNsOAj_UetUN_1700327976','Fornecedor2','982123912','Rua do Fornecedor2','Leiria','2312-012','fornecedor');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-20 15:37:34
