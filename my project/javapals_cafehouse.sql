-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2015 at 05:09 PM
-- Server version: 5.5.42-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `javapals_cafehouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `ref_code` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `product` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `qty` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `date` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `phone_number`, `ref_code`, `product`, `qty`, `status`, `date`) VALUES
(1, ' 254723401197', '736105', 'Americano Coffee', '2', '0', '1430501122'),
(2, ' 254723401197', '491731', 'Black Tea', '2', '0', '1430501620'),
(3, ' 254702887293', '563645', 'Pizza Full + 2 liter Soda.', '2', '0', '1430510648'),
(4, ' 254723401197', '638604', 'Green Tea', '2', '0', '1430522849'),
(5, ' 254723401197', '799723', 'Black Tea', '2', '0', '1430555491'),
(6, '0723401197', '938348', 'Coffee Milk', '5', '0', '1430594480'),
(7, ' 254723401197', '654214', 'Pizza small + 1 liter Soda', '2', '0', '1430684317');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `national_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `phone_number`, `full_name`, `national_id`) VALUES
(25, '0723401197', 'steve gachie', '27816668');

-- --------------------------------------------------------

--
-- Table structure for table `user_points`
--

CREATE TABLE IF NOT EXISTS `user_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(50) NOT NULL,
  `national_id` varchar(20) NOT NULL,
  `points` varchar(50) NOT NULL,
  `mpesa_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_points`
--

INSERT INTO `user_points` (`id`, `phone_number`, `national_id`, `points`, `mpesa_code`) VALUES
(1, '0723401197', '27816668', '3', 'BDHDGH45'),
(2, '0723401197', '27816668', '3', '64GDH78A');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
