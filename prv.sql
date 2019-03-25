-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2019 at 06:26 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prv`
--

-- --------------------------------------------------------

--
-- Table structure for table `current`
--

CREATE TABLE `current` (
  `id` varchar(16) NOT NULL,
  `reqKey` varchar(16) NOT NULL,
  `driKey1` varchar(16) NOT NULL,
  `driKey2` varchar(16) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` varchar(10) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `uiKey` varchar(16) NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `onDrive` varchar(16) NOT NULL,
  `noDrive` varchar(20) NOT NULL,
  `lastDrive` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `carNo` varchar(10) NOT NULL,
  `Medical Assistance` varchar(20) NOT NULL,
  `Appetite Request` varchar(20) NOT NULL,
  `Sanitary Request` varchar(20) NOT NULL,
  `Destress Request` varchar(20) NOT NULL,
  `Reinforcement Request` varchar(20) NOT NULL,
  `Technical Assistance` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uikeys`
--

CREATE TABLE `uikeys` (
  `uiKey` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(10) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `uiKey` varchar(16) NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `imei` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
