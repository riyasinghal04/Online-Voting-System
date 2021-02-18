-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2020 at 07:32 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinevoting`
--

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE `voter` (
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `age` int(11) NOT NULL,
  `uname` varchar(15) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `password` varchar(8) NOT NULL,
  `flag` tinyint(1) NOT NULL,
  `count_vote` int(11) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`name`, `email`, `age`, `uname`, `voter_id`, `password`, `flag`, `count_vote`, `hash`, `active`) VALUES
('Yamini Kabra', 'yaminikabra2001@gmail.com', 50, 'nanchiii', 1234564, '24412441', 0, 0, 'c3e878e27f52e2a57ace4d9a76fd9acf', 0),
('Yamini Kabra', 'yaminikabra2001@gmail.com', 34, 'yamini', 1234567, '20012001', 0, 0, '', 0),
('Ragini Kabra', 'yaminikabra2001@gmail.com', 50, 'ragini', 1234569, '29912991', 0, 0, 'f9028faec74be6ec9b852b0a542e2f39', 1),
('Yamini Kabra', 'yaminikabra2001@gmail.com', 50, 'ragu', 2345678, '23312331', 0, 0, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `voter`
--
ALTER TABLE `voter`
  ADD UNIQUE KEY `voter_id` (`voter_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
