-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: base
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.10-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_permissions_fk` (`role_id`),
  CONSTRAINT `roles_permissions_fk` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,1,'acceso/denegado'),(7,2,'acceso/denegado'),(8,2,'agendamiento/index'),(9,2,'agendamiento/daily'),(10,2,'agendamiento/weekly'),(11,2,'agendamiento/changespecialist'),(12,2,'agendamiento/changecalendar'),(13,2,'agendamiento/changeweekspecialist'),(14,2,'agendamiento/schedulepersist'),(15,2,'atencion/index'),(16,2,'index/index'),(17,2,'informe/index'),(18,2,'paciente/index'),(19,2,'paciente/hc'),(20,2,'paciente/edit'),(21,2,'paciente/store'),(22,2,'paciente/list'),(23,2,'paciente/searchpatient'),(24,2,'permisos/index'),(25,2,'permisos/getpermisos'),(26,2,'permisos/updatepermisos'),(27,2,'prueba/valida'),(28,2,'prueba/createuser'),(29,2,'prueba/login'),(30,2,'prueba/showsessionvar'),(31,2,'session/login'),(32,2,'session/loginuser'),(33,2,'session/logout'),(34,2,'test/index'),(35,2,'test/userlist'),(36,2,'test/getuser'),(37,2,'test/getturnsdaily'),(38,2,'test/getturnsweekly'),(39,2,'test/turnschedule'),(40,2,'test/paymentmethods'),(41,2,'test/getspecialistsusb'),(42,2,'test/getturn'),(43,2,'test/getturnsalternative');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remember_tokens`
--

DROP TABLE IF EXISTS `remember_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remember_tokens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usersId` int(10) unsigned NOT NULL,
  `token` char(32) NOT NULL,
  `userAgent` varchar(120) NOT NULL,
  `createdAt` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remember_tokens`
--

LOCK TABLES `remember_tokens` WRITE;
/*!40000 ALTER TABLE `remember_tokens` DISABLE KEYS */;
INSERT INTO `remember_tokens` VALUES (216,1,'07426656e040b58023dc011e755a6e81','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.89 Safari/537.36',1473772233),(217,1,'07426656e040b58023dc011e755a6e81','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.89 Safari/537.36',1473772281),(218,4,'78f37206171284dfd196a1f1209d95da','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36',1474569523),(219,1,'c712d2a05e0ac25409d24b576b1978fb','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.59 Safari/537.36',1477326934);
/*!40000 ALTER TABLE `remember_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'SuperAdmin'),(2,'Administrador'),(3,'Normal');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `rut` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `phone_fixed` varchar(255) DEFAULT NULL,
  `phone_mobile` varchar(255) DEFAULT NULL,
  `comments` text,
  `sexo` varchar(1) DEFAULT NULL,
  `birthdate` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  UNIQUE KEY `user_id_fk` (`user_id`),
  UNIQUE KEY `rut_UNIQUE` (`rut`),
  CONSTRAINT `users_user_details_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_details`
--

LOCK TABLES `user_details` WRITE;
/*!40000 ALTER TABLE `user_details` DISABLE KEYS */;
INSERT INTO `user_details` VALUES (1,'Sebastián','Silva','17086743-2','$2y$08$TXlnWngzNVZGOW9xZ3pjTel4PFZEu/ZWBTwmvo75fhdTPxM19L0K.','0','N','Y',NULL,NULL),(2,'Orlando','San Martín','18649740-6','$2y$08$TXlnWngzNVZGOW9xZ3pjTel4PFZEu/ZWBTwmvo75fhdTPxM19L0K.','0','N','Y',NULL,NULL),(3,'Jorge','Cociña','21969752-k','$2y$08$TXlnWngzNVZGOW9xZ3pjTel4PFZEu/ZWBTwmvo75fhdTPxM19L0K.','0','N','Y',NULL,NULL),(4,'Jorge','Silva','18474048-6','$2y$08$TXlnWngzNVZGOW9xZ3pjTel4PFZEu/ZWBTwmvo75fhdTPxM19L0K.','0','N','Y',NULL,NULL),(5,'Miguel','Jara','10680390-0','$2y$08$TXlnWngzNVZGOW9xZ3pjTel4PFZEu/ZWBTwmvo75fhdTPxM19L0K.','0','N','Y',NULL,NULL);
/*!40000 ALTER TABLE `user_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'pic/avatars/default.png',
  `password` char(60) DEFAULT NULL,
  `must_change_password` tinyint(3) DEFAULT '0',
  `banned` char(1) NOT NULL DEFAULT 'N',
  `suspended` char(1) NOT NULL DEFAULT 'N',
  `active` char(1) DEFAULT 'Y',
  `role_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `roles_users_fk` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ssilvac','sebasilvac88@gmail.com','pic/avatars/default.png','$2y$08$TXlnWngzNVZGOW9xZ3pjTel4PFZEu/ZWBTwmvo75fhdTPxM19L0K.',0,'N','N','Y',1,'2016-09-12 22:00:54'),(2,'osanmartin','osanmartin@base.cl','pic/avatars/default.png','$2y$08$N0F5RmdDL2F1U0ZGTHN3Ne8mFcwFU72fyntGaXtWECH9KH.BRFbXW',0,'N','N','Y',1,'2016-09-12 22:00:54'),(3,'jcocina','jcocina@base.cl','pic/avatars/default.png','$2y$08$A1OAnV3k2BylxFEg63S4QuQ/uwX34IChIe/DHOlxe3vxY5J2oV9iy',0,'N','N','Y',1,'2016-09-12 22:00:54'),(4,'jsilva','jsilva@base.cl','pic/avatars/default.png','$2y$08$TXlnWngzNVZGOW9xZ3pjTel4PFZEu/ZWBTwmvo75fhdTPxM19L0K.',0,'N','N','Y',1,'2016-09-12 22:00:54'),(5,'mjara','mjara@base.cl','pic/avatars/default.png','$2y$08$TXlnWngzNVZGOW9xZ3pjTel4PFZEu/ZWBTwmvo75fhdTPxM19L0K.',0,'N','N','Y',1,'2016-09-12 22:00:54');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-21 16:11:43
