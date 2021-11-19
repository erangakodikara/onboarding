-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 15, 2021 at 03:42 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onboard_test_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

DROP TABLE IF EXISTS `onboard_data`;
CREATE TABLE IF NOT EXISTS `onboard_data` (
  `user_id` int(20) NOT NULL AUTO_INCREMENT,
  `created_at` varchar(20) NOT NULL,
  `onboarding_perentage` varchar(20) NOT NULL,
  `count_applications` int(20) NOT NULL,
  `count_accepted_applications` int(20) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

DROP TABLE IF EXISTS `register`;
CREATE TABLE IF NOT EXISTS `register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

INSERT INTO `onboard_data` (`user_id`, `created_at`, `onboarding_perentage`, `count_applications`, `count_accepted_applications`) VALUES
(3121, '2016-07-19', '40', 0, 0),
(3122, '2016-07-19', '40', 0, 0),
(3123, '2016-07-19', '50', 0, 0),
(3124, '2016-07-19', '50', 0, 0),
(3125, '2016-07-19', '70', 0, 0),
(3126, '2016-07-19', '70', 0, 0),
(3127, '2016-07-19', '70', 0, 0),
(3128, '2016-07-19', '90', 0, 0),
(3129, '2016-07-19', '90', 0, 0);