-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: projekt_klon
-- ------------------------------------------------------
-- Server version	5.6.34-log

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `uid` int(11) NOT NULL,
  `username` varchar(45) CHARACTER SET utf8 NOT NULL,
  `password` varchar(45) CHARACTER SET utf8 NOT NULL,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modification_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `token` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`username`,`uid`),
  KEY `FK_account_user_id_idx` (`uid`),
  CONSTRAINT `FK_account_user_id` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (4,'Babiluskus','827ccb0eea8a706c4c34a16891f84e7b','2018-05-09 12:03:37','2018-06-13 12:54:11','1cad8a89b3a8a86b0f4f1b61de72c7a0'),(2,'gusli','827ccb0eea8a706c4c34a16891f84e7b','2018-03-27 14:39:08','2018-06-10 17:51:13','08011d71fda5c8481217c04599a090ea'),(11,'newuser','81dc9bdb52d04dc20036dbd8313ed055','2018-06-13 10:50:44',NULL,NULL),(12,'newuser','81dc9bdb52d04dc20036dbd8313ed055','2018-06-13 10:51:29',NULL,NULL),(13,'sara','5bd537fc3789b5482e4936968f0fde95','2018-06-13 12:51:27',NULL,NULL),(5,'serenePHP','5bd537fc3789b5482e4936968f0fde95','2018-06-11 10:32:44',NULL,NULL);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(45) CHARACTER SET latin1 NOT NULL,
  `name` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'smartphones är bla bla bla....','smartphone');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_adress`
--

DROP TABLE IF EXISTS `company_adress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_adress` (
  `org_nr` int(11) NOT NULL,
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `adress` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `post_nr` int(11) NOT NULL,
  `city` varchar(45) CHARACTER SET utf8 NOT NULL,
  `country` varchar(45) CHARACTER SET utf8 NOT NULL,
  `post_box` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`aid`,`org_nr`),
  KEY `FK_company_adress_org_nr_idx` (`org_nr`),
  CONSTRAINT `FK_company_adress_org_nr` FOREIGN KEY (`org_nr`) REFERENCES `company_info` (`org_nr`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_adress`
--

LOCK TABLES `company_adress` WRITE;
/*!40000 ALTER TABLE `company_adress` DISABLE KEYS */;
INSERT INTO `company_adress` VALUES (1234,1,'adressvägen 1',17171,'solna','sverige',NULL);
/*!40000 ALTER TABLE `company_adress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_customer`
--

DROP TABLE IF EXISTS `company_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_customer` (
  `uid` int(11) NOT NULL,
  `org_nr` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `FK_company_customer_level_id_idx` (`level_id`),
  KEY `FK_company_customer_org_nr_idx` (`org_nr`),
  CONSTRAINT `FK_company_customer_level_id` FOREIGN KEY (`level_id`) REFERENCES `user_levels` (`level_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_company_customer_org_nr` FOREIGN KEY (`org_nr`) REFERENCES `company_info` (`org_nr`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_company_customer_uid` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_customer`
--

LOCK TABLES `company_customer` WRITE;
/*!40000 ALTER TABLE `company_customer` DISABLE KEYS */;
INSERT INTO `company_customer` VALUES (2,1234,3);
/*!40000 ALTER TABLE `company_customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_info`
--

DROP TABLE IF EXISTS `company_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_info` (
  `org_nr` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`org_nr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_info`
--

LOCK TABLES `company_info` WRITE;
/*!40000 ALTER TABLE `company_info` DISABLE KEYS */;
INSERT INTO `company_info` VALUES (1234,'företagett AB','0443001008'),(4657,'företagtvå AB','54533478');
/*!40000 ALTER TABLE `company_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_order`
--

DROP TABLE IF EXISTS `company_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_order` (
  `order_id` int(11) NOT NULL,
  `org_nr` int(11) NOT NULL,
  `order_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_order`
--

LOCK TABLES `company_order` WRITE;
/*!40000 ALTER TABLE `company_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `option_type`
--

DROP TABLE IF EXISTS `option_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `option_type` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name_UNIQUE` (`option_name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `option_type`
--

LOCK TABLES `option_type` WRITE;
/*!40000 ALTER TABLE `option_type` DISABLE KEYS */;
INSERT INTO `option_type` VALUES (3,'camera'),(1,'color'),(8,'connectivity'),(7,'connector'),(5,'material'),(6,'screen'),(2,'storage'),(9,'test');
/*!40000 ALTER TABLE `option_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `option_values`
--

DROP TABLE IF EXISTS `option_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `option_values` (
  `value_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NOT NULL,
  `value_name` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`value_id`,`option_id`),
  KEY `FK_option_values_option_id_idx` (`option_id`),
  CONSTRAINT `FK_option_values_option_id` FOREIGN KEY (`option_id`) REFERENCES `option_type` (`option_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `option_values`
--

LOCK TABLES `option_values` WRITE;
/*!40000 ALTER TABLE `option_values` DISABLE KEYS */;
INSERT INTO `option_values` VALUES (1,1,'black'),(2,1,'gold'),(3,1,'silver'),(4,2,'64GB'),(5,2,'128GB'),(6,3,'10MP'),(7,3,'12MP'),(8,2,'256GB'),(9,3,'8MP'),(10,3,'6MP'),(11,8,'USB-C'),(12,7,'USB-C'),(13,7,'Lightning'),(14,5,'glass'),(15,6,'oled'),(16,3,'16mp');
/*!40000 ALTER TABLE `option_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `quantity` int(11) NOT NULL,
  `sku` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`item_id`,`sku`),
  KEY `FK_order_item_order_idx` (`order_id`),
  KEY `FK_order_items_sku_idx` (`sku`),
  CONSTRAINT `FK_order_items_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_order_items_sku` FOREIGN KEY (`sku`) REFERENCES `product_variants` (`sku`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (44,82,'2018-06-13 09:17:53',2,'APPIPX128BK'),(45,82,'2018-06-13 09:17:53',1,'SAMGLS964BK'),(46,83,'2018-06-13 09:58:32',5,'SAMGLS964BK'),(49,86,'2018-06-13 10:50:38',1,'APPIPX128BK');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `total_amount` int(11) DEFAULT NULL,
  `order_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_method` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `alternative_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fname` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `FK_user_id_orders_idx` (`user_id`),
  CONSTRAINT `FK_user_id_orders` FOREIGN KEY (`user_id`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (82,28500,'2018-06-13 09:17:53','unpaid','PayPal',NULL,4,'Hemma//6875/Sthlm','Lindholm','Gustaf','babiluskus@gmail.com'),(83,44500,'2018-06-13 09:58:32','unpaid','CreditCard',NULL,4,'stockholmn//1234/Sthlm','Lindholm','Gustaf','babiluskus@gmail.com'),(86,9800,'2018-06-13 10:50:38','unpaid','PayPal',NULL,NULL,'hemma//6879/Sthlm','Kund','Ny','ny@kund.se');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_content`
--

DROP TABLE IF EXISTS `page_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_content` (
  `content_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_content`
--

LOCK TABLES `page_content` WRITE;
/*!40000 ALTER TABLE `page_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `page_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `perm_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `perm_desc` varchar(50) NOT NULL,
  PRIMARY KEY (`perm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `private_adress`
--

DROP TABLE IF EXISTS `private_adress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `private_adress` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `adress` varchar(45) CHARACTER SET utf8 NOT NULL,
  `post_nr` varchar(45) CHARACTER SET utf8 NOT NULL,
  `stad` varchar(45) CHARACTER SET utf8 NOT NULL,
  `land` varchar(45) CHARACTER SET utf8 NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`aid`,`uid`),
  KEY `FK_private_adress_uid_idx` (`uid`),
  CONSTRAINT `FK_private_adress_uid` FOREIGN KEY (`uid`) REFERENCES `account` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `private_adress`
--

LOCK TABLES `private_adress` WRITE;
/*!40000 ALTER TABLE `private_adress` DISABLE KEYS */;
INSERT INTO `private_adress` VALUES (2,'bkorta','6686','Sfg','asdfas',4),(3,'bkorta','6686','Sfg','asdfas',4),(4,'<br />\r\n<b>Notice</b>:  Undefined index: stre','<br />\r\n<b>Notice</b>:  Undefined index: zip ','<br />\r\n<b>Notice</b>:  Undefined index: city','<br />\r\n<b>Notice</b>:  Undefined index: coun',4),(5,'address','4565','hjdasf','lhjsadf',4),(8,'Hemma','6875','Sthlm','Estland',4),(9,'stockholmn','1234','Sthlm','sverige',4),(12,'hemma','6879','Sthlm','Estland',11),(13,'hemma','6879','Sthlm','Estland',12),(14,'wqerty','13245','city','sweden',13);
/*!40000 ALTER TABLE `private_adress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `title` varchar(45) CHARACTER SET latin1 NOT NULL,
  `manufacturer` varchar(45) CHARACTER SET latin1 NOT NULL,
  `info` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`),
  KEY `FK_order_category_id_idx` (`cid`),
  CONSTRAINT `FK_order_category_id` FOREIGN KEY (`cid`) REFERENCES `category` (`cid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (2,1,'iPhone X','Apple','Apples senaste flaggskepp','2018-05-29 12:13:41'),(3,1,'Galaxy S9','Samsung','Samsungs senaste flaggskepp','2018-05-29 12:13:41'),(4,1,'iPhone 8','Apple','Den bästa iPhone hittills','2018-05-29 12:13:41'),(5,1,'Xperia','Sony Mobile','Describe the product','2018-05-29 12:13:41'),(6,1,'Xperia','Sony Mobile','Describe the product','2018-05-29 12:13:41'),(7,1,'test','test','vgghmgm','2018-05-29 12:13:41'),(8,1,'V30','LG','New LG','2018-06-13 11:05:01');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_options`
--

DROP TABLE IF EXISTS `product_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_options` (
  `product_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`option_id`),
  KEY `FK_product_options_option_id_idx` (`option_id`),
  CONSTRAINT `FK_product_options_option_id` FOREIGN KEY (`option_id`) REFERENCES `option_type` (`option_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_products_options_pid` FOREIGN KEY (`product_id`) REFERENCES `product` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_options`
--

LOCK TABLES `product_options` WRITE;
/*!40000 ALTER TABLE `product_options` DISABLE KEYS */;
INSERT INTO `product_options` VALUES (2,1),(3,1),(4,1),(6,1),(8,1),(2,2),(3,2),(4,2),(8,2),(2,3),(3,3),(4,3),(5,3),(6,3),(8,3),(2,6),(8,6),(2,7),(5,7),(3,8);
/*!40000 ALTER TABLE `product_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_variants`
--

DROP TABLE IF EXISTS `product_variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_variants` (
  `variant_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `sku` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(11) NOT NULL,
  `img_url` varchar(2083) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`variant_id`,`product_id`),
  UNIQUE KEY `sku_UNIQUE` (`sku`),
  KEY `FK_product_variants_product_id_idx` (`product_id`),
  CONSTRAINT `FK_product_variants_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_variants`
--

LOCK TABLES `product_variants` WRITE;
/*!40000 ALTER TABLE `product_variants` DISABLE KEYS */;
INSERT INTO `product_variants` VALUES (1,2,'APPIPX64BK',10200,'https://store.storeimages.cdn-apple.com/4662/as-images.apple.com/is/image/AppleInc/aos/published/images/i/ph/iphone/x/iphone-x-gray-select-2017?wid=470&hei=556&fmt=png-alpha&.v=1515602510330'),(1,3,'SAMGLS964BK',8900,'https://www.abenson.com/media/catalog/product/cache/75eed2686e01eb22cb4050b2f40ddf97/1/5/152959_2_2.jpg'),(2,2,'APPIPX128BK',9800,'https://store.storeimages.cdn-apple.com/4662/as-images.apple.com/is/image/AppleInc/aos/published/images/i/ph/iphone/x/iphone-x-gray-select-2017?wid=470&hei=556&fmt=png-alpha&.v=1515602510330'),(2,3,'SAMGLS964GO',9500,'https://images.pricerunner.com/product/400x400/1814566310/Samsung-Galaxy-S9-64GB.jpg'),(11,5,'SONXPL132BK',6000,'https://images.pricerunner.com/product/400x400/1790333689/Sony-Xperia-L1.jpg'),(12,8,'LGV3064GB',5000,''),(13,8,'LGV30128GB',7899,'');
/*!40000 ALTER TABLE `product_variants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_perm`
--

DROP TABLE IF EXISTS `role_perm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_perm` (
  `role_id` int(10) unsigned NOT NULL,
  `perm_id` int(10) unsigned NOT NULL,
  KEY `role_id` (`role_id`),
  KEY `perm_id` (`perm_id`),
  CONSTRAINT `role_perm_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  CONSTRAINT `role_perm_ibfk_2` FOREIGN KEY (`perm_id`) REFERENCES `permissions` (`perm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_perm`
--

LOCK TABLES `role_perm` WRITE;
/*!40000 ALTER TABLE `role_perm` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_perm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `role_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `level_id` int(11) NOT NULL,
  `fname` varchar(45) CHARACTER SET utf8 NOT NULL,
  `lname` varchar(45) CHARACTER SET utf8 NOT NULL,
  `phone` int(10) unsigned zerofill DEFAULT NULL,
  `email` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `FK_level_user_idx` (`level_id`),
  CONSTRAINT `FK_level_user` FOREIGN KEY (`level_id`) REFERENCES `user_levels` (`level_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,3,'Kalle','Von Anka',0987654321,'gustaf@backers.fi'),(4,4,'Gustaf','Lindholm',0500776156,'babiluskus@gmail.com'),(5,1,'Serene','serene',0760987578,'sarangua97@gmail.com'),(11,1,'Ny','Kund',0000000500,'ny@kund.se'),(12,1,'Ny','Kund',0000000500,'ny@kund.se'),(13,1,'sara','sara',0001234536,'sara@gmail.com');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_levels`
--

DROP TABLE IF EXISTS `user_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_levels` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level_type` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_levels`
--

LOCK TABLES `user_levels` WRITE;
/*!40000 ALTER TABLE `user_levels` DISABLE KEYS */;
INSERT INTO `user_levels` VALUES (1,'private'),(2,'employee'),(3,'power_user'),(4,'admin');
/*!40000 ALTER TABLE `user_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variant_values`
--

DROP TABLE IF EXISTS `variant_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variant_values` (
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `value_id` int(11) DEFAULT NULL,
  KEY `FK_variant_values_product_id_option_id_idx` (`product_id`,`option_id`),
  KEY `FK_variant_values_option_id_value_id_idx` (`option_id`,`value_id`),
  KEY `FK_variant_values_product_id_variant_id_idx` (`product_id`,`variant_id`),
  CONSTRAINT `FK_variant_values_option_id_value_id` FOREIGN KEY (`option_id`, `value_id`) REFERENCES `option_values` (`option_id`, `value_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_variant_values_product_id_option_id` FOREIGN KEY (`product_id`, `option_id`) REFERENCES `product_options` (`product_id`, `option_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_variant_values_product_id_variant_id` FOREIGN KEY (`product_id`, `variant_id`) REFERENCES `product_variants` (`product_id`, `variant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variant_values`
--

LOCK TABLES `variant_values` WRITE;
/*!40000 ALTER TABLE `variant_values` DISABLE KEYS */;
INSERT INTO `variant_values` VALUES (2,1,1,1),(2,1,2,4),(2,2,1,1),(2,2,2,4),(3,1,1,2),(3,1,2,4),(3,1,3,6),(3,2,1,2),(3,2,2,4),(3,2,3,6),(2,1,3,7),(5,11,3,6),(2,1,7,12),(2,1,6,15),(2,2,6,15);
/*!40000 ALTER TABLE `variant_values` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-15  9:45:16
