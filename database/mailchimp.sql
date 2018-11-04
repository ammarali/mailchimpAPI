-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2018 at 11:44 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mailchimp`
--

-- --------------------------------------------------------

--
-- Table structure for table `mailchimp_lists`
--

CREATE TABLE IF NOT EXISTS `mailchimp_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_id` varchar(100) NOT NULL,
  `list_web_id` int(11) NOT NULL,
  `name` varchar(254) NOT NULL,
  `company_name` varchar(254) NOT NULL,
  `address_1` varchar(254) NOT NULL,
  `address_2` varchar(254) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `from_name` varchar(100) NOT NULL,
  `from_email` varchar(80) NOT NULL,
  `from_language` varchar(2) NOT NULL,
  `subject` varchar(254) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `list_id` (`list_id`,`list_web_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `mailchimp_lists`
--

INSERT INTO `mailchimp_lists` (`id`, `list_id`, `list_web_id`, `name`, `company_name`, `address_1`, `address_2`, `city`, `zip`, `state`, `country`, `phone`, `from_name`, `from_email`, `from_language`, `subject`, `date_created`, `date_updated`) VALUES
(8, '9ab768b09a', 79843, 'newtestDB', 'testme', '4 A VICTOR STREET', 'Wilcox Court', 'SUNSHINE NORTH', '3020', 'VIC', 'AU', '434744786', 'Madexpert', 'emmareli@gmail.com', 'EN', 'NO Subject', '2018-11-01 22:09:58', '2018-11-01 22:24:40');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
