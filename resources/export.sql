-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2016 at 01:32 PM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` text,
  `parent` int(11) DEFAULT NULL,
  `category_order` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_created` int(11) NOT NULL,
  `date_accessed` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_accessed` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `details`, `parent`, `category_order`, `date_created`, `user_created`, `date_accessed`, `user_accessed`, `deleted`) VALUES
(1, 'Speakers', '', NULL, 1, '2012-11-24 13:55:28', 1, '2016-03-09 12:32:25', NULL, 0),
(2, 'Amplifiers', '', NULL, 2, '2014-09-25 15:23:35', 1, '2016-03-09 12:32:25', NULL, 0),
(3, 'CD-players', '', NULL, 3, '2013-07-19 11:36:44', 1, '2016-03-09 12:32:25', NULL, 0),
(4, 'Audio epilog', '', 1, 1, '2012-11-24 13:55:28', 1, '2016-03-09 12:32:25', NULL, 0),
(5, 'ATC', '', 1, 2, '2014-09-25 15:23:35', 1, '2016-03-09 12:32:25', NULL, 0),
(6, 'Dali', '', 1, 3, '2013-07-19 11:36:44', 1, '2016-03-09 12:32:25', NULL, 0),
(7, 'Rega', '', 1, 4, '2013-07-19 11:36:44', 1, '2016-03-09 12:32:25', NULL, 0),
(8, 'Cambridge', '', 2, 1, '2014-09-25 15:23:35', 1, '2016-03-09 12:32:25', NULL, 0),
(9, 'Onkyo', '', 2, 2, '2013-07-19 11:36:44', 1, '2016-03-09 12:32:25', NULL, 0),
(10, 'Rega', '', 2, 3, '2013-07-19 11:36:44', 1, '2016-03-09 12:32:25', NULL, 0),
(11, 'Audiolab', '', 3, 1, '2013-07-19 11:36:44', 1, '2016-03-09 12:32:25', NULL, 0),
(12, 'Cambridge', '', 3, 2, '2014-09-25 15:23:35', 1, '2016-03-09 12:32:25', NULL, 0),
(13, 'Onkyo', '', 3, 3, '2013-07-19 11:36:44', 1, '2016-03-09 12:32:25', NULL, 0),
(14, 'Rega', '', 3, 4, '2013-07-19 11:36:44', 1, '2016-03-09 12:32:25', NULL, 0),
(15, 'Pimienta', '', 4, 1, '2013-07-19 11:36:44', 1, '2016-03-09 12:32:25', NULL, 0),
(16, 'Others', '', 4, 2, '2013-07-19 11:36:44', 1, '2016-03-09 12:32:25', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories_products`
--

CREATE TABLE IF NOT EXISTS `categories_products` (
  `category_product_id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `price` decimal(18,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories_products`
--

INSERT INTO `categories_products` (`category_product_id`, `product`, `category`, `price`) VALUES
(1, 1, 4, '500.00'),
(2, 2, 4, '800.00'),
(3, 3, 4, '860.00'),
(4, 4, 4, '2000.00'),
(5, 5, 4, '799.99'),
(6, 6, 6, '587.00'),
(7, 7, 6, '541.00'),
(8, 8, 6, '245.00'),
(9, 9, 6, '587.00'),
(10, 10, 6, '574.00'),
(11, 11, 6, '547.00'),
(12, 12, 6, '544.00'),
(13, 13, 5, '775.00'),
(14, 14, 5, '555.00'),
(15, 15, 5, '754.00'),
(16, 16, 5, '545.00'),
(17, 17, 5, '785.00'),
(18, 18, 5, '457.00'),
(19, 19, 5, '575.00'),
(20, 20, 7, '547.00'),
(21, 21, 7, '545.00'),
(22, 22, 7, '745.00'),
(23, 23, 7, '478.00'),
(24, 24, 10, '547.00'),
(25, 25, 10, '471.00'),
(26, 26, 10, '417.00'),
(27, 27, 10, '471.00'),
(28, 28, 10, '741.00'),
(29, 29, 9, '857.00'),
(30, 30, 9, '457.00'),
(31, 31, 9, '784.00'),
(32, 32, 9, '784.00'),
(33, 33, 9, '748.00'),
(34, 34, 9, '444.00'),
(35, 35, 9, '578.00'),
(36, 36, 9, '254.00'),
(37, 37, 8, '478.00'),
(38, 38, 8, '458.00'),
(39, 39, 8, '845.00'),
(40, 40, 8, '458.00'),
(41, 41, 8, '478.00'),
(42, 42, 8, '478.00'),
(43, 43, 8, '547.00'),
(44, 44, 14, '478.00'),
(45, 45, 14, '478.00'),
(46, 46, 14, '247.00'),
(47, 47, 14, '478.00'),
(48, 48, 14, '578.00'),
(49, 49, 12, '458.00'),
(50, 50, 12, '789.00'),
(51, 51, 12, '742.00'),
(52, 52, 12, '748.00'),
(53, 53, 12, '478.00'),
(54, 54, 11, '415.00'),
(55, 55, 11, '748.00'),
(56, 56, 11, '484.00'),
(57, 57, 11, '478.00'),
(58, 58, 11, '458.00'),
(59, 59, 11, '478.00'),
(60, 60, 11, '485.00'),
(61, 61, 13, '418.00'),
(62, 62, 13, '477.00'),
(63, 63, 13, '487.00'),
(64, 64, 13, '478.00'),
(65, 65, 13, '458.00'),
(66, 66, 13, '158.00'),
(67, 1, 1, '500.00'),
(68, 2, 1, '800.00'),
(69, 3, 1, '860.00'),
(70, 4, 1, '2000.00'),
(71, 5, 1, '799.99'),
(72, 6, 1, '587.00'),
(73, 7, 1, '541.00'),
(74, 8, 1, '245.00'),
(75, 9, 1, '587.00'),
(76, 10, 1, '574.00'),
(77, 11, 1, '547.00'),
(78, 12, 1, '544.00'),
(79, 13, 1, '775.00'),
(80, 14, 1, '555.00'),
(81, 15, 1, '754.00'),
(82, 16, 1, '545.00'),
(83, 17, 1, '785.00'),
(84, 18, 1, '457.00'),
(85, 19, 1, '575.00'),
(86, 20, 1, '547.00'),
(87, 21, 1, '545.00'),
(88, 22, 1, '745.00'),
(89, 23, 1, '478.00'),
(90, 24, 2, '547.00'),
(91, 25, 2, '471.00'),
(92, 26, 2, '417.00'),
(93, 27, 2, '471.00'),
(94, 28, 2, '741.00'),
(95, 29, 2, '857.00'),
(96, 30, 2, '457.00'),
(97, 31, 2, '784.00'),
(98, 32, 2, '784.00'),
(99, 33, 2, '748.00'),
(100, 34, 2, '444.00'),
(101, 35, 2, '578.00'),
(102, 36, 2, '254.00'),
(103, 37, 2, '478.00'),
(104, 38, 2, '458.00'),
(105, 39, 2, '845.00'),
(106, 40, 2, '458.00'),
(107, 41, 2, '478.00'),
(108, 42, 2, '478.00'),
(109, 43, 2, '547.00'),
(110, 44, 3, '478.00'),
(111, 45, 3, '478.00'),
(112, 46, 3, '247.00'),
(113, 47, 3, '478.00'),
(114, 48, 3, '578.00'),
(115, 49, 3, '458.00'),
(116, 50, 3, '789.00'),
(117, 51, 3, '742.00'),
(118, 52, 3, '748.00'),
(119, 53, 3, '478.00'),
(120, 54, 3, '415.00'),
(121, 55, 3, '748.00'),
(122, 56, 3, '484.00'),
(123, 57, 3, '478.00'),
(124, 58, 3, '458.00'),
(125, 59, 3, '478.00'),
(126, 60, 3, '485.00'),
(127, 61, 3, '418.00'),
(128, 62, 3, '477.00'),
(129, 63, 3, '487.00'),
(130, 64, 3, '478.00'),
(131, 65, 3, '458.00'),
(132, 66, 3, '158.00'),
(133, 2, 15, '800.00'),
(134, 3, 15, '860.00'),
(135, 1, 16, '500.00'),
(136, 4, 16, '2000.00'),
(137, 5, 16, '799.99');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `path` text NOT NULL,
  `featured` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `product`, `path`, `featured`) VALUES
(1, 1, 'img/products/SP-AU-0001.jpg', 0),
(2, 1, 'img/products/SP-AU-0001-02.jpg', 1),
(3, 2, 'img/products/SP-AU-0002.jpg', 1),
(4, 3, 'img/products/SP-AU-0003.jpg', 1),
(5, 4, 'img/products/SP-AU-0004.jpg', 1),
(6, 5, 'img/products/SP-AU-0005.jpg', 1),
(7, 6, 'img/products/SP-AT-0006.jpg', 1),
(8, 7, 'img/products/SP-AT-0007.jpg', 1),
(9, 8, 'img/products/SP-AT-0008.jpg', 1),
(10, 9, 'img/products/SP-AT-0009.jpg', 1),
(11, 10, 'img/products/SP-AT-0010.jpg', 1),
(12, 11, 'img/products/SP-AT-0011.jpg', 1),
(13, 12, 'img/products/SP-AT-0012.jpg', 1),
(14, 13, 'img/products/SP-DA-0013.jpg', 1),
(15, 14, 'img/products/SP-DA-0014.jpg', 1),
(16, 15, 'img/products/SP-DA-0015.jpg', 1),
(17, 16, 'img/products/SP-DA-0016.jpg', 1),
(18, 17, 'img/products/SP-DA-0017.jpg', 1),
(19, 18, 'img/products/SP-DA-0018.jpg', 1),
(20, 19, 'img/products/SP-DA-0019.jpg', 1),
(21, 20, 'img/products/SP-RE-0020.jpg', 1),
(22, 21, 'img/products/SP-RE-0021.jpg', 1),
(23, 22, 'img/products/SP-RE-0022.jpg', 1),
(24, 23, 'img/products/SP-RE-0023.jpg', 1),
(25, 24, 'img/products/AM-RE-0024.jpg', 1),
(26, 25, 'img/products/AM-RE-0025.jpg', 1),
(27, 26, 'img/products/AM-RE-0026.jpg', 1),
(28, 27, 'img/products/AM-RE-0027.jpg', 1),
(29, 28, 'img/products/AM-RE-0028.jpg', 1),
(30, 29, 'img/products/AM-ON-0029.jpg', 1),
(31, 30, 'img/products/AM-ON-0030.jpg', 1),
(32, 31, 'img/products/AM-ON-0031.jpg', 1),
(33, 32, 'img/products/AM-ON-0032.jpg', 1),
(34, 33, 'img/products/AM-ON-0033.jpg', 1),
(35, 34, 'img/products/AM-ON-0034.jpg', 1),
(36, 35, 'img/products/AM-ON-0035.jpg', 1),
(37, 36, 'img/products/AM-ON-0036.jpg', 1),
(38, 37, 'img/products/AM-CA-0037.jpg', 1),
(39, 38, 'img/products/AM-CA-0038.jpg', 1),
(40, 39, 'img/products/AM-CA-0039.jpg', 1),
(41, 40, 'img/products/AM-CA-0040.jpg', 1),
(42, 41, 'img/products/AM-CA-0041.jpg', 1),
(43, 42, 'img/products/AM-CA-0042.jpg', 1),
(44, 43, 'img/products/AM-CA-0043.jpg', 1),
(45, 44, 'img/products/CD-RE-0044.jpg', 1),
(46, 45, 'img/products/CD-RE-0045.jpg', 1),
(47, 46, 'img/products/CD-RE-0046.jpg', 1),
(48, 47, 'img/products/CD-RE-0047.jpg', 1),
(49, 48, 'img/products/CD-RE-0048.jpg', 1),
(50, 49, 'img/products/CD-CA-0049.jpg', 1),
(51, 50, 'img/products/CD-CA-0050.jpg', 1),
(52, 51, 'img/products/CD-CA-0051.jpg', 1),
(53, 52, 'img/products/CD-CA-0052.jpg', 1),
(54, 53, 'img/products/CD-CA-0053.jpg', 1),
(55, 54, 'img/products/CD-AU-0054.jpg', 1),
(56, 55, 'img/products/CD-AU-0055.jpg', 1),
(57, 56, 'img/products/CD-AU-0056.jpg', 1),
(58, 57, 'img/products/CD-AU-0057.jpg', 1),
(59, 58, 'img/products/CD-AU-0058.jpg', 1),
(60, 59, 'img/products/CD-AU-0059.jpg', 1),
(61, 60, 'img/products/CD-AU-0060.jpg', 1),
(62, 61, 'img/products/CD-ON-0061.jpg', 1),
(63, 62, 'img/products/CD-ON-0062.jpg', 1),
(64, 63, 'img/products/CD-ON-0063.jpg', 1),
(65, 64, 'img/products/CD-ON-0064.jpg', 1),
(66, 65, 'img/products/CD-ON-0065.jpg', 1),
(67, 66, 'img/products/CD-ON-0066.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `invoices_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `payment` int(11) NOT NULL,
  `shipping_address` varchar(100) DEFAULT NULL,
  `shipping_postoffice` varchar(100) DEFAULT NULL,
  `shipping_city` varchar(100) DEFAULT NULL,
  `shipping_state` varchar(100) DEFAULT NULL,
  `shipping_country` varchar(100) DEFAULT NULL,
  `billing_address` varchar(100) DEFAULT NULL,
  `billing_postoffice` varchar(100) DEFAULT NULL,
  `billing_city` varchar(100) DEFAULT NULL,
  `billing_state` varchar(100) DEFAULT NULL,
  `billing_country` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoices_items`
--

CREATE TABLE IF NOT EXISTS `invoices_items` (
  `invoice` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `name`) VALUES
(1, 'PayPal'),
(2, 'Credit Cart');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL,
  `model` varchar(50) NOT NULL,
  `quantity_in_stock` int(11) NOT NULL,
  `price` decimal(18,2) NOT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `unit` int(11) NOT NULL,
  `details` text,
  `more_information` text,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_created` int(11) NOT NULL,
  `data_accessed` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_accessed` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `model`, `quantity_in_stock`, `price`, `sku`, `unit`, `details`, `more_information`, `datecreated`, `user_created`, `data_accessed`, `user_accessed`, `deleted`) VALUES
(1, 'Jana', 23, '500.00', 'SP-AU-0001', 2, NULL, NULL, '2006-04-10 09:29:12', 1, '2016-03-09 12:32:26', NULL, 0),
(2, 'Pimienta', 25, '800.00', 'SP-AU-0002', 2, NULL, NULL, '2010-02-15 12:29:51', 1, '2016-03-09 12:32:26', NULL, 0),
(3, 'Pimienta2', 26, '860.00', 'SP-AU-0003', 2, NULL, NULL, '2007-10-16 20:50:10', 1, '2016-03-09 12:32:26', NULL, 0),
(4, 'Prime', 21, '2000.00', 'SP-AU-0004', 2, NULL, NULL, '2001-02-17 04:47:50', 1, '2016-03-09 12:32:26', NULL, 0),
(5, 'Ice', 24, '799.99', 'SP-AU-0005', 2, NULL, NULL, '2002-12-25 22:32:06', 1, '2016-03-09 12:32:26', NULL, 0),
(6, 'Epicon 8', 26, '587.00', 'SP-AT-0006', 2, NULL, NULL, '2000-09-07 14:34:05', 1, '2016-03-09 12:32:26', NULL, 0),
(7, 'Epicon 6', 24, '541.00', 'SP-AT-0007', 2, NULL, NULL, '2002-04-04 06:46:01', 1, '2016-03-09 12:32:26', NULL, 0),
(8, 'Rubicon 8', 23, '245.00', 'SP-AT-0008', 2, NULL, NULL, '2015-05-03 10:46:25', 1, '2016-03-09 12:32:26', NULL, 0),
(9, 'Rubicon 6', 27, '587.00', 'SP-AT-0009', 2, NULL, NULL, '2009-10-22 08:09:27', 1, '2016-03-09 12:32:26', NULL, 0),
(10, 'Opticon 5', 24, '574.00', 'SP-AT-0010', 2, NULL, NULL, '2011-09-10 14:46:06', 1, '2016-03-09 12:32:26', NULL, 0),
(11, 'Helicon Stand MKL', 24, '547.00', 'SP-AT-0011', 2, NULL, NULL, '0000-00-00 00:00:00', 1, '2016-03-09 12:32:26', NULL, 0),
(12, 'Helicon 800 MK2', 43, '544.00', 'SP-AT-0012', 2, NULL, NULL, '2011-02-19 17:29:55', 1, '2016-03-09 12:32:26', NULL, 0),
(13, 'SCM7', 33, '775.00', 'SP-DA-0013', 2, NULL, NULL, '2014-11-09 04:34:31', 1, '2016-03-09 12:32:26', NULL, 0),
(14, 'SCM11', 34, '555.00', 'SP-DA-0014', 2, NULL, NULL, '2013-05-05 16:20:08', 1, '2016-03-09 12:32:26', NULL, 0),
(15, 'SCM40', 54, '754.00', 'SP-DA-0015', 2, NULL, NULL, '0000-00-00 00:00:00', 1, '2016-03-09 12:32:26', NULL, 0),
(16, 'SCM20ASLT', 54, '545.00', 'SP-DA-0016', 2, NULL, NULL, '2008-08-15 02:12:33', 1, '2016-03-09 12:32:26', NULL, 0),
(17, 'SCM50ASLT', 77, '785.00', 'SP-DA-0017', 2, NULL, NULL, '2006-08-20 10:03:33', 1, '2016-03-09 12:32:26', NULL, 0),
(18, 'SCM50 Anniversary', 13, '457.00', 'SP-DA-0018', 2, NULL, NULL, '2011-11-26 02:31:27', 1, '2016-03-09 12:32:26', NULL, 0),
(19, 'ELI 50', 11, '575.00', 'SP-DA-0019', 2, NULL, NULL, '2015-12-23 14:38:04', 1, '2016-03-09 12:32:26', NULL, 0),
(20, 'RX1', 34, '547.00', 'SP-RE-0020', 2, NULL, NULL, '2012-03-27 00:10:35', 1, '2016-03-09 12:32:26', NULL, 0),
(21, 'RX3', 54, '545.00', 'SP-RE-0021', 2, NULL, NULL, '2005-02-06 13:50:47', 1, '2016-03-09 12:32:26', NULL, 0),
(22, 'RX5', 32, '745.00', 'SP-RE-0022', 2, NULL, NULL, '2009-07-24 01:34:16', 1, '2016-03-09 12:32:26', NULL, 0),
(23, 'RS10', 11, '478.00', 'SP-RE-0023', 2, NULL, NULL, '2005-10-24 02:47:45', 1, '2016-03-09 12:32:26', NULL, 0),
(24, 'EAR', 32, '547.00', 'AM-RE-0024', 1, NULL, NULL, '2008-11-08 21:21:43', 1, '2016-03-09 12:32:26', NULL, 0),
(25, 'BRIO-R', 32, '471.00', 'AM-RE-0025', 1, NULL, NULL, '2006-10-09 05:49:05', 1, '2016-03-09 12:32:26', NULL, 0),
(26, 'ELEX-R', 54, '417.00', 'AM-RE-0026', 1, NULL, NULL, '2008-05-14 09:52:24', 1, '2016-03-09 12:32:26', NULL, 0),
(27, 'ELICIT-R', 24, '471.00', 'AM-RE-0027', 1, NULL, NULL, '2014-12-13 02:56:09', 1, '2016-03-09 12:32:26', NULL, 0),
(28, 'OSIRIS-R', 27, '741.00', 'AM-RE-0028', 1, NULL, NULL, '2000-12-05 03:45:44', 1, '2016-03-09 12:32:26', NULL, 0),
(29, 'A-9070', 28, '857.00', 'AM-ON-0029', 1, NULL, NULL, '2008-08-13 17:27:35', 1, '2016-03-09 12:32:26', NULL, 0),
(30, 'TX-8020', 25, '457.00', 'AM-ON-0030', 1, NULL, NULL, '2004-11-27 14:55:30', 1, '2016-03-09 12:32:26', NULL, 0),
(31, 'P-3000R', 23, '784.00', 'AM-ON-0031', 1, NULL, NULL, '2007-11-20 09:01:54', 1, '2016-03-09 12:32:26', NULL, 0),
(32, 'P-3000RA', 26, '784.00', 'AM-ON-0032', 1, NULL, NULL, '2003-12-01 19:47:00', 1, '2016-03-09 12:32:26', NULL, 0),
(33, 'PA-MC5501', 23, '748.00', 'AM-ON-0033', 1, NULL, NULL, '2007-03-03 21:46:09', 1, '2016-03-09 12:32:26', NULL, 0),
(34, 'PHA-1045', 25, '444.00', 'AM-ON-0034', 1, NULL, NULL, '2005-06-28 04:14:00', 1, '2016-03-09 12:32:26', NULL, 0),
(35, 'PHA-1045DAB', 23, '578.00', 'AM-ON-0035', 1, NULL, NULL, '2008-08-02 09:23:51', 1, '2016-03-09 12:32:26', NULL, 0),
(36, 'PHA-1045DAB-E', 26, '254.00', 'AM-ON-0036', 1, NULL, NULL, '2007-01-31 23:40:48', 1, '2016-03-09 12:32:26', NULL, 0),
(37, '340A', 27, '478.00', 'AM-CA-0037', 1, NULL, NULL, '2006-09-13 20:01:03', 1, '2016-03-09 12:32:26', NULL, 0),
(38, '340A SE', 23, '458.00', 'AM-CA-0038', 1, NULL, NULL, '2000-03-23 14:01:10', 1, '2016-03-09 12:32:26', NULL, 0),
(39, '540A v2', 26, '845.00', 'AM-CA-0039', 1, NULL, NULL, '2004-06-22 11:19:16', 1, '2016-03-09 12:32:26', NULL, 0),
(40, '640A v2', 22, '458.00', 'AM-CA-0040', 1, NULL, NULL, '2014-08-13 23:41:22', 1, '2016-03-09 12:32:26', NULL, 0),
(41, '740A', 26, '478.00', 'AM-CA-0041', 1, NULL, NULL, '2011-06-23 23:26:33', 1, '2016-03-09 12:32:26', NULL, 0),
(42, '840A', 27, '478.00', 'AM-CA-0042', 1, NULL, NULL, '2008-07-20 21:34:13', 1, '2016-03-09 12:32:26', NULL, 0),
(43, '840A', 25, '547.00', 'AM-CA-0043', 1, NULL, NULL, '2014-09-03 19:02:24', 1, '2016-03-09 12:32:26', NULL, 0),
(44, 'APOLLO-R', 24, '478.00', 'CD-RE-0044', 1, NULL, NULL, '2013-10-17 03:04:58', 1, '2016-03-09 12:32:26', NULL, 0),
(45, 'SATURN-R', 25, '478.00', 'CD-RE-0045', 1, NULL, NULL, '2008-09-13 14:17:52', 1, '2016-03-09 12:32:26', NULL, 0),
(46, 'ISIS', 27, '247.00', 'CD-RE-0046', 1, NULL, NULL, '2003-09-25 09:06:25', 1, '2016-03-09 12:32:26', NULL, 0),
(47, 'VALVE ISIS', 28, '478.00', 'CD-RE-0047', 1, NULL, NULL, '2011-06-09 16:50:30', 1, '2016-03-09 12:32:26', NULL, 0),
(48, 'DAC-R', 32, '578.00', 'CD-RE-0048', 1, NULL, NULL, '2008-11-19 15:03:50', 1, '2016-03-09 12:32:26', NULL, 0),
(49, '340C', 32, '458.00', 'CD-CA-0049', 1, NULL, NULL, '2002-07-16 19:49:17', 1, '2016-03-09 12:32:26', NULL, 0),
(50, '540C v2', 26, '789.00', 'CD-CA-0050', 1, NULL, NULL, '2004-10-18 08:52:01', 1, '2016-03-09 12:32:26', NULL, 0),
(51, '640 v2', 76, '742.00', 'CD-CA-0051', 1, NULL, NULL, '2015-01-18 07:55:48', 1, '2016-03-09 12:32:26', NULL, 0),
(52, '740C v2', 45, '748.00', 'CD-CA-0052', 1, NULL, NULL, '2003-02-25 17:55:14', 1, '2016-03-09 12:32:26', NULL, 0),
(53, '840C v2', 34, '478.00', 'CD-CA-0053', 1, NULL, NULL, '0000-00-00 00:00:00', 1, '2016-03-09 12:32:26', NULL, 0),
(54, '8200A', 22, '415.00', 'CD-AU-0054', 1, NULL, NULL, '2014-03-05 01:08:16', 1, '2016-03-09 12:32:26', NULL, 0),
(55, '8200CD', 21, '748.00', 'CD-AU-0055', 1, NULL, NULL, '2014-10-08 22:34:33', 1, '2016-03-09 12:32:26', NULL, 0),
(56, '8200CDQ', 24, '484.00', 'CD-AU-0056', 1, NULL, NULL, '2002-10-16 13:54:24', 1, '2016-03-09 12:32:26', NULL, 0),
(57, '8200AP', 12, '478.00', 'CD-AU-0057', 1, NULL, NULL, '2013-07-08 04:55:22', 1, '2016-03-09 12:32:26', NULL, 0),
(58, '8200M', 15, '458.00', 'CD-AU-0058', 1, NULL, NULL, '2006-02-22 18:08:25', 1, '2016-03-09 12:32:26', NULL, 0),
(59, '8200MB', 17, '478.00', 'CD-AU-0059', 1, NULL, NULL, '2012-10-18 21:01:02', 1, '2016-03-09 12:32:26', NULL, 0),
(60, '8200P', 18, '485.00', 'CD-AU-0060', 1, NULL, NULL, '2009-01-26 13:15:35', 1, '2016-03-09 12:32:26', NULL, 0),
(61, 'C-5VL', 19, '418.00', 'CD-ON-0061', 1, NULL, NULL, '2006-01-10 21:00:33', 1, '2016-03-09 12:32:26', NULL, 0),
(62, 'C-7000R', 20, '477.00', 'CD-ON-0062', 1, NULL, NULL, '2001-10-19 13:08:42', 1, '2016-03-09 12:32:26', NULL, 0),
(63, 'C-7030', 19, '487.00', 'CD-ON-0063', 1, NULL, NULL, '2013-05-23 08:31:28', 1, '2016-03-09 12:32:26', NULL, 0),
(64, 'C-7070', 23, '478.00', 'CD-ON-0064', 1, NULL, NULL, '2012-03-05 21:13:03', 1, '2016-03-09 12:32:26', NULL, 0),
(65, 'C-733', 29, '458.00', 'CD-ON-0065', 1, NULL, NULL, '2012-04-26 03:45:48', 1, '2016-03-09 12:32:26', NULL, 0),
(66, 'C-55VL', 30, '158.00', 'CD-ON-0066', 1, NULL, NULL, '2001-07-04 21:23:24', 1, '2016-03-09 12:32:26', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `review` text
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user`, `product`, `grade`, `review`) VALUES
(1, 1, 1, 1, 'poor'),
(2, 1, 2, 2, 'not so good'),
(3, 1, 3, 4, 'good'),
(4, 2, 1, 3, 'average'),
(5, 2, 2, 4, 'good'),
(6, 3, 1, 4, 'good'),
(7, 3, 2, 2, 'not so good'),
(8, 3, 3, 5, 'excellent');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `unit_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `name`) VALUES
(1, 'One'),
(2, 'Pair');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` char(32) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postoffice` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'Customer',
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateaccessed` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `firstname`, `lastname`, `address`, `postoffice`, `city`, `state`, `country`, `role`, `datecreated`, `dateaccessed`, `active`, `deleted`) VALUES
(1, 'luketic.damir@gmail.com', 'a722c63db8ec8625af6cf71cb8c2d939', 'Damir', 'Luketić', 'Stonska 4', '31000', 'Osijek', NULL, 'Croatia', 'admin', '2015-12-12 13:35:28', '2016-03-09 12:32:25', 1, 0),
(2, 'luketic.darko@gmail.com', 'c1572d05424d0ecb2a65ec6a82aeacbf', 'Darko', 'Luketić', 'V.P. Gore 4', '31000', 'Osijek', NULL, 'Croatia', 'customer', '2015-12-26 03:35:45', '2016-03-09 12:32:25', 1, 0),
(3, 'zrasic@gmail.com', '3afc79b597f88a72528e864cf81856d2', 'Zdravko', 'Rašić', 'Radićeva 15', '31000', 'Osijek', NULL, 'Croatia', 'customer', '2016-02-01 05:31:34', '2016-03-09 12:32:25', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE IF NOT EXISTS `wishlists` (
  `wishlist_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `user_created` (`user_created`),
  ADD KEY `user_accessed` (`user_accessed`),
  ADD KEY `parent` (`parent`);

--
-- Indexes for table `categories_products`
--
ALTER TABLE `categories_products`
  ADD PRIMARY KEY (`category_product_id`),
  ADD KEY `product` (`product`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoices_id`),
  ADD KEY `payment` (`payment`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `invoices_items`
--
ALTER TABLE `invoices_items`
  ADD KEY `product` (`product`),
  ADD KEY `invoice` (`invoice`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `ui2` (`sku`),
  ADD KEY `unit` (`unit`),
  ADD KEY `user_created` (`user_created`),
  ADD KEY `user_accessed` (`user_accessed`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `ui1` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `user` (`user`),
  ADD KEY `product` (`product`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `categories_products`
--
ALTER TABLE `categories_products`
  MODIFY `category_product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=138;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoices_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`user_created`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `categories_ibfk_2` FOREIGN KEY (`user_accessed`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `categories_ibfk_3` FOREIGN KEY (`parent`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `categories_products`
--
ALTER TABLE `categories_products`
  ADD CONSTRAINT `categories_products_ibfk_1` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `categories_products_ibfk_2` FOREIGN KEY (`category`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`payment`) REFERENCES `payments` (`payment_id`),
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `invoices_items`
--
ALTER TABLE `invoices_items`
  ADD CONSTRAINT `invoices_items_ibfk_1` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `invoices_items_ibfk_2` FOREIGN KEY (`invoice`) REFERENCES `invoices` (`invoices_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`unit`) REFERENCES `units` (`unit_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`user_created`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`user_accessed`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `wishlists_ibfk_2` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
