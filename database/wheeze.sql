-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2014 at 12:59 PM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wheeze`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `status`) VALUES
(1, 'Admin', 'admin', '202cb962ac59075b964b07152d234b70', '1');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `taxi_id` varchar(20) NOT NULL,
  `lattitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `time` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `location` varchar(255) NOT NULL,
  `active` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `taxi_id`, `lattitude`, `longitude`, `time`, `status`, `location`, `active`) VALUES
(1, 'taxi1', '28.5291844', '77.2081707', '2014-07-15 18:19:58', 'Vacant', 'F8/12, Gitanjali Malviya Nagar Road, Block F, Malviya Nagar, New Delhi, Delhi 110017, India', '1'),
(2, 'taxi1', '28.5341912', '77.2523714', '2014-07-15 19:25:31', 'Occupied', 'G1324, Block G, Chittaranjan Park, New Delhi, Delhi 110019, India', '1'),
(3, 'taxi2', '28.5348305', '77.2097741', '2014-07-15 18:12:31', 'Vacant', 'Malviya Nagar, Block D, Malviya Nagar, New Delhi, Delhi 110017', '1'),
(4, 'taxi3', '28.5262812', '77.2153316', '2014-07-16 04:16:26', 'Vacant', 'Saket Sports Complex Road, Saket, New Delhi, Delhi 110017, India', '1'),
(5, 'taxi4', '28.5303344', '77.200204', '2014-07-17 07:08:17', 'Offline', 'A-2, Block A, Geetanjali Enclave, Malviya Nagar, New Delhi, Delhi 110017, India', '1'),
(6, 'taxi4', '28.5236512', '77.2306095', '2014-07-18 06:21:26', 'On Duty', '33, Raja Ram Marg, Dr. Ambedkar Nagar, Madangir, New Delhi, Delhi 110044, India', '1'),
(7, 'taxi11', '28.5318044', '77.2090065', '2014-07-18 08:17:24', 'Offline', 'H17/9, Block H 6, Malviya Nagar, New Delhi, Delhi 110017, India', '1'),
(8, 'taxi11', '28.5304447', '77.2071397', '2014-07-18 08:27:24', 'Offline', 'A-91, Block A, Shivalik, Malviya Nagar, New Delhi, Delhi 110017, India', '1'),
(9, 'taxi5', '28.5304447', '77.2071397', '2014-07-18 08:27:24', 'Offline', 'A-92, Block A, Shivalik, Malviya Nagar, New Delhi, Delhi 110017, India', '1');

-- --------------------------------------------------------

--
-- Table structure for table `taxi_detail`
--

CREATE TABLE IF NOT EXISTS `taxi_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `taxi_id` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `taxi_number` varchar(50) NOT NULL,
  `driver_name` varchar(255) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `taxi_detail`
--

INSERT INTO `taxi_detail` (`id`, `taxi_id`, `password`, `taxi_number`, `driver_name`, `mobile`, `address`, `created_date`, `modify_date`, `status`) VALUES
(1, 'taxi1', '123', 'UP 23-3032', 'Sohan Mishra', '9865645789', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2014-07-15 04:11:16', '0000-00-00 00:00:00', '1'),
(2, 'taxi2', '123', 'DL 45-5556', 'Raju Gupta', '9865784598', 'desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2014-07-15 04:40:13', '0000-00-00 00:00:00', '1'),
(3, 'taxi3', '123', 'DL 45-5556', 'Raju Gupta', '9865784598', 'desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2014-07-15 04:41:17', '2014-07-17 23:59:59', '1'),
(4, 'taxi4', '123', 'DL 45-5533', 'Manoj Gupta', '7744556628', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2014-07-15 04:50:26', '0000-00-00 00:00:00', '1'),
(5, 'taxi5', '123', 'DL 45-5522', 'Manoj Goel', '7744556885', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2014-07-15 04:55:13', '2014-07-18 00:04:26', '1'),
(6, 'taxi6', '123', 'UP 89-5869', 'Sushant Mishra', '9878457812', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is', '2014-07-15 18:11:07', '2014-07-17 23:51:35', '1'),
(7, 'taxi7', '123', 'DL 48-89569', 'Mohan Goyal', '8978451256', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', '2014-07-15 18:12:31', '0000-00-00 00:00:00', '1'),
(8, 'taxi8', '123', 'UP 78-9648', 'Pankaj M', '9878457812', 'Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2014-07-15 18:19:58', '2014-07-18 00:10:18', '1'),
(9, 'taxi9', '123', 'RJ 58-2525', 'Pankaj Sukla', '9944556628', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2014-07-15 18:31:43', '2014-07-17 23:55:46', '1'),
(10, 'taxi10', '123', 'RJ 80-9874', 'Rishabh A', '8745788956', 'Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker ', '2014-07-15 18:42:30', '2014-07-18 00:10:05', '1'),
(11, 'taxi11', '123', 'DL 25-9874', 'HariOm Mishra', '9878451265', 'Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2014-07-17 23:49:49', '2014-07-18 00:05:58', '1'),
(12, 'taxi12', '123', 'RJ 58-8888', 'Upendra Sukla', '9874589636', 'It is a long established fact that a reader will be distracted by the readable', '2014-07-18 00:10:58', '0000-00-00 00:00:00', '1'),
(13, 'taxi13', '123', 'DL 85-9875', 'Gagan Garg', '7845894589', 'It is a long established fact that a reader will be distracted by the readable', '2014-07-18 00:11:24', '2014-07-18 02:56:23', '1'),
(14, 'taxi14', '123', 'PN 56-9874', 'Gaurav Gupta', '7848921365', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', '2014-07-18 00:12:25', '2014-07-18 00:12:51', '1'),
(15, 'taxi15', '123', 'RJ 58-8555', 'Moolaram Mishra', '7845894573', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2014-07-18 02:55:10', '0000-00-00 00:00:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `taxi_status`
--

CREATE TABLE IF NOT EXISTS `taxi_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `taxi_id` varchar(100) NOT NULL,
  `lattitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `display` char(1) NOT NULL DEFAULT '1',
  `active` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `taxi_status`
--

INSERT INTO `taxi_status` (`id`, `taxi_id`, `lattitude`, `longitude`, `status`, `display`, `active`) VALUES
(1, 'taxi1', '28.5291844', '77.2081707', 'Occupied', '0', '1'),
(2, 'taxi2', '28.5341912', '77.2523714', 'Occupied', '0', '1'),
(3, 'taxi3', '28.529474', '77.208999', 'On Duty', '0', '1'),
(4, 'taxi4', '28.5318682', '77.2101411', 'Vacant', '0', '1'),
(5, 'taxi5', '28.5348305', '77.2097741', 'On Duty', '0', '1'),
(6, 'taxi6', '28.5303344', '77.200204', 'Offline', '0', '1'),
(7, 'taxi7', '28.5276762', '77.2059546', 'Offline', '0', '1'),
(8, 'taxi8', '28.5262812', '77.2153316', 'Offline', '0', '1'),
(9, 'taxi9', '28.5236512', '77.2306095', 'Vacant', '0', '1'),
(10, 'taxi10', '28.5394489', '77.2447286', 'Vacant', '0', '1'),
(11, 'taxi11', '28.529474', '77.208999', 'Vacant', '0', '1'),
(12, 'taxi12', '28.5276762', '77.2306099', 'Vacant', '0', '1'),
(13, 'taxi13', '28.663391', '77.3196818', 'Occupied', '0', '1'),
(14, 'taxi14', '28.635968', '77.269558', 'Offline', '0', '1'),
(15, 'taxi15', '28.6521147', '77.2347039', 'On Duty', '0', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
