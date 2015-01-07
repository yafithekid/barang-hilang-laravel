-- MySQL dump 10.13  Distrib 5.6.11, for Win32 (x86)
--
-- Host: localhost    Database: barang_hilang
-- ------------------------------------------------------
-- Server version	5.6.11

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Handphone dan Tablet'),(2,'Tas'),(4,'Dompet'),(5,'Kendaraan'),(6,'Laptop');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (2,16,16,'Jika ada yang menemukan harap segera lapor ke nomor di atas ya','2014-12-31 05:38:48'),(3,16,14,'Coba hubungi petugas GKU Barat, siapa tau ada','2015-01-07 14:05:56');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` enum('lost','found') NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `location` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `contact_name` varchar(500) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text,
  `finished` int(11) DEFAULT NULL,
  `hidden` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `image_1` varchar(200) NOT NULL,
  `image_2` varchar(200) DEFAULT NULL,
  `image_3` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`),
  FULLTEXT KEY `description` (`description`),
  CONSTRAINT `item_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (16,'Handphone asus Zenfone 5','lost','0813 1234 5678','ITB','2014-12-30 21:36:00','2015-01-03 04:48:45',-6.89417083087671,107.61392326616215,'Willy Soesanto',1,'Saya kehilangan ini di GKU Barat',NULL,0,16,'16_1.jpg','16_2.jpg','16_3.jpg'),(17,'Honda Revo Hitam','found','0857 2959 2442','Jalan Tubagus Ismail VIII No 17 Sekeloa Coblong Bandung 40134','2014-12-31 04:07:08','2015-01-03 10:46:05',-6.882859055859534,107.62252779268192,'Muhammad Yafi',5,'Ditemukan di sekitar komplek sekolah Salman Al Farisi. Sudah dititipkan di pos satpam. Plat nomor A1234AA warna hitam.',NULL,0,14,'17_1.jpg',NULL,NULL),(18,'Dompet Hitam Planet Ocean','found','0813 1234 5678','Tubagus Ismail','2014-12-31 05:46:21','2015-01-03 10:46:17',-6.886011894091789,107.62289257310795,'Muhammad Yafi',4,'Dompet a.n. Willy Soesanto tertinggal di meja kasir.',NULL,0,14,'18_1.JPG',NULL,NULL),(19,'Dompet Hello Kitty','found','022 123456','Balubur Town Square','2015-01-01 00:33:29','2015-01-03 10:46:28',-6.89870824669514,107.60873050950931,'Pak Joko (Satpam)',4,'Ditemukan sebuah dompet hello kitty di daerah balubur town square dengan ciri-ciri warna pink. bagi yang merasa kehilangan dapat menghubungi satpam sesuai nomor di atas.',0,0,15,'19_1.jpg',NULL,NULL),(21,'Macbook Pro','lost','0857 2959 2442','RS Borromeus','2015-01-03 05:19:49','2015-01-03 05:19:49',-6.89417083087671,107.61383743547367,'Muhammad Yafi',6,'Ditemukan sebuah laptop dengan ciri-ciri warna putih, macbook pro ditemukan di kursi taman rumah sakit.',NULL,0,14,'21_1.PNG','21_2.PNG',NULL),(22,'Toyota Avanza edit','lost','0813 1234 5678','Sasana Budaya Ganesha ITB','2015-01-07 06:53:48','2015-01-07 07:10:34',-6.886288831584299,107.60963173173832,'Koyek',5,'Telah hilang toyota avanza berwarna putih, plat B 2345 H di parkiran Sabuga ITB',1,0,14,'22_1.jpg',NULL,NULL);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(200) DEFAULT NULL,
  `image_filename` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (14,'yafi','f45c294b8d111866c9bbce773e709acb7e06e7f3','yafi@yafi.com','Muhammad Yafi','2015-01-03 15:55:17','2015-01-03 08:55:17','XJLW6CiaOPD8Fti6QBmDaD9LPqyq5tuyqWRwY6F4KNUY8Q4n8gzRLKNIkRhO','14.jpg'),(15,'gilang','e239aca6e941135937208eb840dc38108d86be3b','gilang@gilang.com','Gilang Julian','2015-01-01 10:14:57','2015-01-01 03:14:57','UkPGwwuz9VvkkPBWVGaSBTdGzrLd0pfVzJdAhotGhSsLwreaMb9y7gv9SayK','15.jpg'),(16,'willy','990c37a323daf1549bdd24197927625080ee16b8','willy@willy.com','Willy Soesanto','2015-01-03 11:50:06','2015-01-03 04:50:06','2wd2Om7K2vRoCtPCO123xyuzsX0j5kIdvvH36Kot2zKLICizJmKwsSdgyGD9','16.jpg'),(17,'sudib','9283a0df44da69d247606404c08e41bc255cc6f4','sudib@sudib.com','Jonathan Sudibya','2015-01-07 06:41:34','2015-01-07 06:41:34',NULL,NULL);
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

-- Dump completed on 2015-01-07 21:55:14
