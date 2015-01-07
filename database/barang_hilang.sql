-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2015 at 02:23 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `barang_hilang`
--
CREATE DATABASE IF NOT EXISTS `barang_hilang` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `barang_hilang`;

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `latlng_distance`(f_lat double, f_lng double, s_lat double, s_lng double) RETURNS double
begin
	declare earthRadius double;
	declare lngDiff double;declare latDiff double;
	declare a double;
	declare c double;
	declare d double;

	set earthRadius = 6371;
	set latDiff = RADIANS(f_lat - s_lat);
	set lngDiff = RADIANS(f_lng - s_lng);
	set a = SIN(latDiff/2.0) * SIN(latDiff/2.0) + COS(RADIANS(f_lat)) * COS(RADIANS(s_lat)) * SIN(lngDiff / 2.0) * SIN(lngDiff / 2.0);
	set c = 2.0 * ATAN2(SQRT(a), SQRT(1.0 - a));

	set d = earthRadius * c;
	return d;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Handphone dan Tablet'),
(2, 'Tas'),
(4, 'Dompet'),
(5, 'Kendaraan'),
(6, 'Laptop');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `item_id`, `user_id`, `content`, `created_at`) VALUES
(2, 16, 16, 'Jika ada yang menemukan harap segera lapor ke nomor di atas ya', '2014-12-31 05:38:48');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
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
  FULLTEXT KEY `description` (`description`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `type`, `contact_no`, `location`, `created_at`, `updated_at`, `lat`, `lng`, `contact_name`, `category_id`, `description`, `finished`, `hidden`, `user_id`, `image_1`, `image_2`, `image_3`) VALUES
(16, 'Handphone asus Zenfone 5', 'lost', '0813 1234 5678', 'ITB', '2014-12-30 21:36:00', '2015-01-03 04:48:45', -6.89417083087671, 107.61392326616215, 'Willy Soesanto', 1, 'Saya kehilangan ini di GKU Barat', NULL, 0, 16, '16_1.jpg', '16_2.jpg', '16_3.jpg'),
(17, 'Honda Revo Hitam', 'found', '0857 2959 2442', 'Jalan Tubagus Ismail VIII No 17 Sekeloa Coblong Bandung 40134', '2014-12-31 04:07:08', '2015-01-03 10:46:05', -6.882859055859534, 107.62252779268192, 'Muhammad Yafi', 5, 'Ditemukan di sekitar komplek sekolah Salman Al Farisi. Sudah dititipkan di pos satpam. Plat nomor A1234AA warna hitam.', NULL, 0, 14, '17_1.jpg', NULL, NULL),
(18, 'Dompet Hitam Planet Ocean', 'found', '0813 1234 5678', 'Tubagus Ismail', '2014-12-31 05:46:21', '2015-01-03 10:46:17', -6.886011894091789, 107.62289257310795, 'Muhammad Yafi', 4, 'Dompet a.n. Willy Soesanto tertinggal di meja kasir.', NULL, 0, 14, '18_1.JPG', NULL, NULL),
(19, 'Dompet Hello Kitty', 'found', '022 123456', 'Balubur Town Square', '2015-01-01 00:33:29', '2015-01-03 10:46:28', -6.89870824669514, 107.60873050950931, 'Pak Joko (Satpam)', 4, 'Ditemukan sebuah dompet hello kitty di daerah balubur town square dengan ciri-ciri warna pink. bagi yang merasa kehilangan dapat menghubungi satpam sesuai nomor di atas.', 0, 0, 15, '19_1.jpg', NULL, NULL),
(21, 'Macbook Pro', 'lost', '0857 2959 2442', 'RS Borromeus', '2015-01-03 05:19:49', '2015-01-03 05:19:49', -6.89417083087671, 107.61383743547367, 'Muhammad Yafi', 6, 'Ditemukan sebuah laptop dengan ciri-ciri warna putih, macbook pro ditemukan di kursi taman rumah sakit.', NULL, 0, 14, '21_1.PNG', '21_2.PNG', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `fullname`, `created_at`, `updated_at`, `remember_token`, `image_filename`) VALUES
(14, 'yafi', 'f45c294b8d111866c9bbce773e709acb7e06e7f3', 'yafi@yafi.com', 'Muhammad Yafi', '2015-01-03 15:55:17', '2015-01-03 08:55:17', 'XJLW6CiaOPD8Fti6QBmDaD9LPqyq5tuyqWRwY6F4KNUY8Q4n8gzRLKNIkRhO', '14.jpg'),
(15, 'gilang', 'e239aca6e941135937208eb840dc38108d86be3b', 'gilang@gilang.com', 'Gilang Julian', '2015-01-01 10:14:57', '2015-01-01 03:14:57', 'UkPGwwuz9VvkkPBWVGaSBTdGzrLd0pfVzJdAhotGhSsLwreaMb9y7gv9SayK', '15.jpg'),
(16, 'willy', '990c37a323daf1549bdd24197927625080ee16b8', 'willy@willy.com', 'Willy Soesanto', '2015-01-03 11:50:06', '2015-01-03 04:50:06', '2wd2Om7K2vRoCtPCO123xyuzsX0j5kIdvvH36Kot2zKLICizJmKwsSdgyGD9', '16.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
