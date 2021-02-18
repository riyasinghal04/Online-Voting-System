-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2020 at 07:27 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL,
  `aname` varchar(30) NOT NULL,
  `apwd` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `aname`, `apwd`) VALUES
(123, 'admin@riya', 'riya2000'),
(456, 'admin@yamini', 'yamini01'),
(789, 'admin@shruti', 'shruti24');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `cid` int(11) NOT NULL,
  `cname` varchar(30) NOT NULL,
  `cphoto` varchar(200) NOT NULL,
  `party` varchar(30) NOT NULL,
  `const` varchar(30) NOT NULL,
  `body` varchar(500) NOT NULL,
  `count_vote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`cid`, `cname`, `cphoto`, `party`, `const`, `body`, `count_vote`) VALUES
(532, 'Rahul Gandhi', 'rahul.jpeg', 'Congress', 'Wayanad, Kerala', 'A member of the Indian National Congress, he served as the President of the Indian National Congress from 16 December 2017 to 3 July 2019.', 17),
(765, 'Arvind Kejriwal', 'kejriwal.jpg', 'AAM', 'New Delhi', 'Arvind Kejriwal is an Indian politician and a former bureaucrat who is the current and 7th Chief Minister of Delhi since February 2015.', 6),
(876, 'Narendra Modi', 'modi.jpeg', 'BJP', 'Varanasi', 'Narendra Damodardas Modi is an Indian politician serving as the 14th and current Prime Minister of India since 2014. He was the Chief Minister of Gujarat from 2001 to 2014', 25);

-- --------------------------------------------------------

--
-- Table structure for table `govt_db`
--

CREATE TABLE `govt_db` (
  `sr_no` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `govt_db`
--

INSERT INTO `govt_db` (`sr_no`, `voter_id`, `email`) VALUES
(1, 1234567, 'yaminikabra2001@gmail.com'),
(2, 1234561, 'riyapsinghal@gmail.com'),
(3, 1234562, 'singhalaries@gmail.com'),
(4, 1234563, 'u18co016@coed.svnit.ac.in'),
(5, 1234564, 'shruti2406m@gmail.com'),
(6, 1234565, 'u18co011@coed.svnit.ac.in'),
(7, 1234566, 'u18co045@coed.svnit.ac.in'),
(8, 1234568, 'voter_abc@gmail.com'),
(9, 1234569, 'voter_123@gmail.com'),
(10, 1234560, 'voter_xyz@gmail.com');

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
  `hash` varchar(32) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`name`, `email`, `age`, `uname`, `voter_id`, `password`, `flag`, `hash`, `active`) VALUES
('Riya Pravin Singhal', 'riyapsinghal@gmail.com', 20, 'riyasinghal', 1234561, 'riya2000', 1, 'dc912a253d1e9ba40e2c597ed2376640', 1),
('Yamini Kabra', 'yaminikabra2001@gmail.com', 34, 'yamini', 1234567, '20012001', 0, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `govt_db`
--
ALTER TABLE `govt_db`
  ADD PRIMARY KEY (`sr_no`),
  ADD UNIQUE KEY `voter_id` (`voter_id`);

--
-- Indexes for table `voter`
--
ALTER TABLE `voter`
  ADD UNIQUE KEY `voter_id` (`voter_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
