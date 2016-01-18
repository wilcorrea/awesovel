CREATE DATABASE  IF NOT EXISTS `delivery` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `delivery`;
-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: delivery
-- ------------------------------------------------------
-- Server version	5.5.46-0ubuntu0.14.04.2

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'soluta','2016-01-18 15:06:11','2016-01-18 15:06:11'),(2,'sed','2016-01-18 15:06:11','2016-01-18 15:06:11'),(3,'ipsum','2016-01-18 15:06:11','2016-01-18 15:06:11'),(4,'nostrum','2016-01-18 15:06:11','2016-01-18 15:06:11'),(5,'in','2016-01-18 15:06:11','2016-01-18 15:06:11'),(6,'quia','2016-01-18 15:06:11','2016-01-18 15:06:11'),(7,'et','2016-01-18 15:06:11','2016-01-18 15:06:11'),(8,'quam','2016-01-18 15:06:11','2016-01-18 15:06:11'),(9,'quo','2016-01-18 15:06:11','2016-01-18 15:06:11'),(10,'necessitatibus','2016-01-18 15:06:12','2016-01-18 15:06:12');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `clients_user_id_foreign` (`user_id`),
  CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,3,'reiciendis','Neque quia quibusdam aut sunt quam.','quae','alias','32968','2016-01-18 15:06:10','2016-01-18 15:06:10'),(2,4,'et','Sint facere error cupiditate voluptatem aut non provident.','impedit','quia','31663','2016-01-18 15:06:10','2016-01-18 15:06:10'),(3,5,'dolor','Repudiandae est id deleniti iste iure ut.','et','provident','89251-7192','2016-01-18 15:06:10','2016-01-18 15:06:10'),(4,6,'itaque','Dolore delectus aspernatur consequatur sit odio.','veniam','qui','74695-1694','2016-01-18 15:06:11','2016-01-18 15:06:11'),(5,7,'facilis','Et consequatur rem ullam velit qui.','est','ipsum','12763','2016-01-18 15:06:11','2016-01-18 15:06:11'),(6,8,'qui','Veniam qui est laudantium in.','quisquam','voluptatem','60209-2337','2016-01-18 15:06:11','2016-01-18 15:06:11'),(7,9,'blanditiis','Doloremque excepturi alias soluta ducimus.','sed','ut','16377-3893','2016-01-18 15:06:11','2016-01-18 15:06:11'),(8,10,'omnis','Unde molestias facere provident omnis omnis et.','facilis','nesciunt','88732','2016-01-18 15:06:11','2016-01-18 15:06:11'),(9,11,'iste','Vero dignissimos possimus recusandae quia.','accusantium','amet','08768','2016-01-18 15:06:11','2016-01-18 15:06:11'),(10,12,'architecto','Voluptas corporis dicta quae in.','quod','doloremque','44657','2016-01-18 15:06:11','2016-01-18 15:06:11');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_01_08_135343_create_categories_table',1),('2016_01_12_131007_create_products_table',1),('2016_01_13_115417_create_clients_table',1),('2016_01_13_124140_create_orders_table',1),('2016_01_13_124233_create_order_items_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `user_deliveryman_id` int(10) unsigned NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `orders_client_id_foreign` (`client_id`),
  KEY `orders_user_deliveryman_id_foreign` (`user_deliveryman_id`),
  CONSTRAINT `orders_user_deliveryman_id_foreign` FOREIGN KEY (`user_deliveryman_id`) REFERENCES `users` (`id`),
  CONSTRAINT `orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'qui','Ducimus molestiae sunt nulla sunt placeat repellat architecto.',6.00,'2016-01-18 15:06:12','2016-01-18 15:06:12'),(2,1,'sapiente','Possimus nulla similique qui quod praesentium ut.',51.00,'2016-01-18 15:06:12','2016-01-18 15:06:12'),(3,1,'dicta','Non quia aliquid fugiat voluptatem.',64.00,'2016-01-18 15:06:12','2016-01-18 15:06:12'),(4,1,'distinctio','Voluptates aut qui earum quis nesciunt amet sunt.',88.00,'2016-01-18 15:06:12','2016-01-18 15:06:12'),(5,1,'repellat','Deleniti est omnis itaque aut.',10.00,'2016-01-18 15:06:12','2016-01-18 15:06:12'),(6,2,'dolorum','Sapiente natus distinctio enim vel qui.',2.00,'2016-01-18 15:06:12','2016-01-18 15:06:12'),(7,2,'voluptas','Nihil omnis non et fugiat impedit quia velit.',31.00,'2016-01-18 15:06:12','2016-01-18 15:06:12'),(8,2,'deleniti','Sint reprehenderit accusantium sunt similique accusamus necessitatibus quibusdam voluptatem.',88.00,'2016-01-18 15:06:12','2016-01-18 15:06:12'),(9,2,'voluptas','Aut voluptates eum in et corporis sit.',15.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(10,2,'labore','Illo accusantium sed repudiandae voluptatum libero ipsum sit.',94.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(11,3,'sit','Iure natus esse illo ut in.',82.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(12,3,'expedita','Non accusamus laboriosam temporibus ut aut porro.',31.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(13,3,'exercitationem','Nobis minima rem asperiores atque.',7.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(14,3,'impedit','Minus quidem est velit ea.',21.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(15,3,'ut','Sed in beatae quaerat ab ea quaerat.',15.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(16,4,'aut','Quaerat quia velit earum quis architecto doloremque perspiciatis.',8.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(17,4,'voluptas','A animi consequatur facilis neque vero minus aut soluta.',81.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(18,4,'qui','Qui similique explicabo et corporis aut corporis.',100.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(19,4,'ducimus','Molestiae recusandae dolorum est voluptatem voluptatem excepturi.',58.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(20,4,'veniam','Ut atque est consequatur tenetur ipsa ipsam sit.',56.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(21,5,'aliquam','Consequatur suscipit iste ipsam amet.',86.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(22,5,'ut','Molestiae neque labore blanditiis culpa.',25.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(23,5,'harum','Blanditiis amet temporibus dolorem quo.',45.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(24,5,'consequatur','Nisi soluta tempora distinctio corporis dolor debitis.',27.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(25,5,'debitis','Ut quidem recusandae aut illo aut.',47.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(26,6,'quia','Similique amet officiis rem delectus.',67.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(27,6,'nisi','Ut reprehenderit quam rerum sit odit eveniet aspernatur.',20.00,'2016-01-18 15:06:13','2016-01-18 15:06:13'),(28,6,'enim','Nesciunt facilis ea eveniet laudantium delectus itaque.',19.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(29,6,'nam','Et in pariatur quisquam quos aspernatur rerum quae.',90.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(30,6,'aut','Ipsa aut a sint aut.',25.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(31,7,'assumenda','Enim fugit eos optio accusamus recusandae libero.',28.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(32,7,'eos','Quia dolore quae quae qui.',59.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(33,7,'voluptatem','Et quasi perspiciatis fugit.',47.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(34,7,'quia','Distinctio molestiae perspiciatis nihil maxime qui provident fuga.',95.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(35,7,'nisi','Perferendis quia delectus ipsum enim.',63.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(36,8,'ipsum','Ea aut assumenda id.',53.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(37,8,'architecto','Nemo qui beatae esse ut libero ut delectus.',41.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(38,8,'voluptatem','Voluptatem non iste beatae reprehenderit dolor.',63.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(39,8,'nulla','Autem architecto rerum libero.',15.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(40,8,'et','Velit quia fugiat voluptates omnis dolores architecto.',42.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(41,9,'repellat','Qui necessitatibus in rerum deleniti dolorem.',90.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(42,9,'fugiat','Facilis ipsum iste quos quia reiciendis sunt recusandae.',34.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(43,9,'consequatur','In qui aspernatur possimus rerum voluptatem non.',93.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(44,9,'nam','Dolorum nam consequuntur excepturi praesentium.',86.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(45,9,'ab','Ex in suscipit velit sit.',11.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(46,10,'exercitationem','Dicta et consequatur id eum.',10.00,'2016-01-18 15:06:14','2016-01-18 15:06:14'),(47,10,'eos','Unde id autem at veniam in officiis.',39.00,'2016-01-18 15:06:15','2016-01-18 15:06:15'),(48,10,'sit','Et tempora officiis qui unde nisi quas.',85.00,'2016-01-18 15:06:15','2016-01-18 15:06:15'),(49,10,'quisquam','Sed voluptatum pariatur nihil quibusdam magnam omnis qui quia.',73.00,'2016-01-18 15:06:15','2016-01-18 15:06:15'),(50,10,'doloremque','Consequuntur rerum fugiat et sit alias.',1.00,'2016-01-18 15:06:15','2016-01-18 15:06:15');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrador','admin@delivery.com','$2y$10$AHPZMXuLN1RSXZMWcQvVKOo64iSmwfZ1WogD51HpRAKLyLTH96A32','admin','TB8HHS5jV7RaLnPZptTDO7UGt0BZSiHHKEMt98T2ItC4nzXql1blH9QEJBDz','2016-01-18 15:06:08','2016-01-18 15:08:43'),(2,'Usuário','user@delivery.com','$2y$10$cfDXjrFz7cMGZtCZvfpOE.MR65XnM3/5cCRlBBDLV.gHbXhCDEcqG','user','Jt0ACGNlS27SqiaSQOZtBr39dOd7VHlzOShFhIzClspQbrHtj5KgVZAL5hEM','2016-01-18 15:06:08','2016-01-18 15:18:58'),(3,'Telly Johnson','Jesus.Altenwerth@Towne.com','$2y$10$bbxAi5xNIcyhvAHZkK0SsuWyVJxfcsean5UOXgRl81Rwri5ghKfj6','user','Sb4TvscaMg','2016-01-18 15:06:09','2016-01-18 15:06:09'),(4,'Augustine Ruecker','Will.Logan@yahoo.com','$2y$10$6B9BX3kuWahNfovY/Vx8ROLtuH.Euub7pmpjC2EMVsjc9.p0aWmVu','user','wUFvrCzCOd','2016-01-18 15:06:09','2016-01-18 15:06:09'),(5,'Ms. Kaelyn Carroll DDS','Shakira.Balistreri@Thompson.com','$2y$10$8k4yJmNvFAIgya.ucQP0HOQIVDUtTFqZpFXzC8GltuJtLvVnorHSy','user','HU2AlrAYz5','2016-01-18 15:06:09','2016-01-18 15:06:09'),(6,'Verona Walter','dRippin@gmail.com','$2y$10$K/ZhyF7Qf9EuquNH2v3sUebWoZgXSuqEx9.V0FMCx.o8wlidoXGdm','user','3Drntcg5zV','2016-01-18 15:06:09','2016-01-18 15:06:09'),(7,'Alexanne Witting','Vena73@Parker.com','$2y$10$pLdINyIxHpY/xkdmDisyeO3IjH6Nvi5TInnwMyNvwdAJJnJZbVfkq','user','1Xlk4PjNGc','2016-01-18 15:06:09','2016-01-18 15:06:09'),(8,'Prof. Ibrahim Breitenberg III','Rae32@hotmail.com','$2y$10$DKLqRmGXrosDsm/etrlG4ePai3HzyVJ9Ez061fwuuYKOf96ZXIp0m','user','AcIOhvwoaM','2016-01-18 15:06:09','2016-01-18 15:06:09'),(9,'Mr. Roy Hammes','Polly.Stamm@OConnell.com','$2y$10$DSs8Rg.5vvyJLFmvTUf6weIMpWLrggUdp6W09es//ehYrdSb7sGMC','user','vqIWhWBO3K','2016-01-18 15:06:10','2016-01-18 15:06:10'),(10,'Peter Haley','Wolf.Ahmad@hotmail.com','$2y$10$kYhAAo/Y8567bCXMmuTCpOFMSWRs9dnmr.x/EoJBVZf5Pj0IHp9vS','user','ash4o32Pqs','2016-01-18 15:06:10','2016-01-18 15:06:10'),(11,'Mrs. Charlotte Beer','kFadel@gmail.com','$2y$10$v.wuTFudigdk9D8wNumFteubwUoEhIofpetiW3EFTEsqf/kGqP47K','user','S7ee3pw9v5','2016-01-18 15:06:10','2016-01-18 15:06:10'),(12,'Tavares Gutmann Sr.','tMills@Casper.org','$2y$10$Mqvdu4pHDAVg8wE/8bqqRuqupbZbmp4JWE9dxP9DQtgvK8uDjdD7O','user','fgyki4rZs9','2016-01-18 15:06:10','2016-01-18 15:06:10');
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

-- Dump completed on 2016-01-18 14:04:15
