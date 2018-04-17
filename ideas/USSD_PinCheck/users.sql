-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 02, 2013 at 10:55 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `students`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `pin` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(80) NOT NULL,
  `gender` text NOT NULL,
  `course` text NOT NULL,
  `balance` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`pin`, `username`, `password`, `gender`, `course`, `balance`) VALUES
('1450', 'ken', 'kamau', 'Male', 'BBA', 1800),
('1400', 'eric', 'andrew', 'Male', 'BBA', 1500),
('1500', 'henry', 'safcom', 'Male', 'BBIT', 3000);
