-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 09, 2020 at 02:14 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goodbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `feeds`
--

DROP TABLE IF EXISTS `feeds`;
CREATE TABLE IF NOT EXISTS `feeds` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `text` text,
  `images` varchar(255) DEFAULT NULL,
  `additionDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feeds`
--

INSERT INTO `feeds` (`sno`, `user`, `text`, `images`, `additionDate`) VALUES
(7, 'nishants4401@gmail.com', 'Heello!', NULL, '2020-03-11 14:48:40'),
(8, 'nishants4401@gmail.com', '', 'IMG_20170816_141724075_HDR.jpg', '2020-03-17 14:18:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `name` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `profile` varchar(255) NOT NULL DEFAULT 'elyse.png',
  PRIMARY KEY (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `email`, `password`, `username`, `phone`, `profile`) VALUES
('Nishant Singh', 'nishants4401@gmail.com', 'nis123@#', 'nishants440', '7903916493', 'DSC00979-01.jpeg'),
('Abhishek Kumar', 'uttam2abhishek@gmail.com', '9122808699', 'uttam2abhishek', '', ''),
('Nishant Kumar', 'nishants550123@gmail.com', 'nis123@#', 'nishants550123', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
