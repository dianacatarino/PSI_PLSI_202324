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
  `profile_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `fk_user_profile_id` (`profile_id`),
  CONSTRAINT `fk_user_profile_id` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (44,'diana','kTRSNq4btLX--mJAUwY4cobS2zz5-ws4','$2y$13$x6xXmJJoaFkJTksrZDa0Vut1hRWrkdFTFpiHVyyWcxqiZZgRn9oy2',NULL,'diana@email.com',10,1700844249,1700844249,'aJV4_YiSwqy1euXQW6Zk0OzD5t-4JaNx_1700844249',1),(45,'admin','j8th_N_UlbaTSb2sCmagTNTP-lD28syt','$2y$13$Zt7D0j.6ICKw.y7RVma.keG76lY81LlZHoylPbPi3E3saF7IFLKnW',NULL,'admin@gmail.com',10,1700844756,1700844756,'wgK_mozZMjlFv5yVdT8HMgSIsl9OUogh_1700844756',2),(46,'maria','zcMk0Wvq4hmFnHvyhz7X3uO4M4qlcpcK','$2y$13$udifYaxHJRVMBQBwtcEUXO/k2B4oXRPTVhb0fQBFy2mRh1pHHVNsK',NULL,'maria@email.com',10,1700845149,1700845149,'__cHy5CbrUFKXs677bahNFCLNfdSuR8n_1700845149',3),(47,'user','ZGsbGTXuN9XUd2osoyxpJ-JGEAvhuha6','$2y$13$vFIlglQ0ceeiCke4GTwZ/uIEBUVvLmUJQ6AcZ6ZS5zLTlSa/Jfk.K',NULL,'user@email.com',10,1700845212,1700845212,'C20sUi268gPpjuKZ4Dtwi1dW8dl7Dok-_1700845212',4),(48,'funcionario','eJySesDKGMHwveb5d9gZhG8_vwe11cYP','$2y$13$l1djLGT0FfPjOlIvUcnVxuylBs88Wlb65hSoWiy2n7BDSTL.KIWdG',NULL,'funcionario@gmail.com',10,1700845412,1701171626,'MvMq44ws3EIvRVMtMmZdJMaTdr_jUO2d_1700845412',5),(49,'funcionario1','6ZhsrBLlYKJKMJatCVBHOAffYOaOvVwC','$2y$13$8nx4EjK/S3L6Ytll4JxK5.l4P5jC0uztfW6fzXOQru.lD9T9a5Tiq',NULL,'funcionario1@gmail.com',10,1700845627,1701171633,'LjaR8p68SUG5H5HnfJvSvrdD58ueWNU3_1700845627',6),(52,'fornecedor','H3JhQvKMvRmG8zCjtEUJlSe-swxVxsa2','$2y$13$UYmBy6lmkpF3qJbPgbTw3.DYDFNJoXUkRebBWmvJpLnn6Ed4W7atG',NULL,'fornecedor@gmail.com',10,1700846214,1701171616,'DzEfxC6YfSb31y6_k7joyOtyU4lUHx9h_1700846214',9),(54,'funcionario2','RihxTQWdjp9R9GysqCKAkcLgXshYoiZ7','$2y$13$78Z43XRjZ3HMiv7wCUgo1.Jug5Ji9PqrNON298uGDMPhPTO0LuMN.',NULL,'funcionario2@email.com',10,1700909043,1700912297,'8sLrcjA2XB6jF5FVtT0-Y7AluS9B3yrs_1700909043',10),(55,'user1','OW7THDof2QcAYS1Y_BPEMsJAqk9f0U6C','$2y$13$F6AyNsg/21AJzgjqjAa5QeEC7lbgaH03C8wsdkR6s0bM8XBu1juUu',NULL,'user1@email.com',10,1700913488,1700913488,'JYOaY5FKSE1zSIv3qqIZ5VbHEskbA55A_1700913488',NULL);
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

-- Dump completed on 2023-11-30  9:40:33
