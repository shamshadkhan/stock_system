-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 18, 2014 at 02:55 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(300) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_title`) VALUES
(1, 'Category1'),
(2, 'Category2'),
(3, 'Category3');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `prod_title` varchar(300) NOT NULL,
  `price` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `sold` int(11) NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `cat_id`, `prod_title`, `price`, `description`, `sold`) VALUES
(1, 1, 'Product1', '213', 'Product Description1', 0),
(2, 2, 'Product1', '421', 'Product Description2', 0),
(3, 1, 'Product2', '213421', 'Product Description3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229');
