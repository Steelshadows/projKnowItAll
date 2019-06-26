-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2019 at 12:57 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knowitall`
--

-- --------------------------------------------------------

--
-- Table structure for table `knowitall_account`
--

CREATE TABLE `knowitall_account` (
  `account_id` int(100) NOT NULL,
  `bio` varchar(200) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `USERID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `knowitall_account`
--

INSERT INTO `knowitall_account` (`account_id`, `bio`, `avatar`, `USERID`) VALUES
(1, 'hallo', 'img/userpics/Heroes_of_the_Smite_Legends_paint.png', 42),
(2, 'U kunt hier iets over uwzelf typen', 'img/userpics/default-avatar.png', 43);

-- --------------------------------------------------------

--
-- Table structure for table `knowitall_adminsettings`
--

CREATE TABLE `knowitall_adminsettings` (
  `type` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `knowitall_adminsettings`
--

INSERT INTO `knowitall_adminsettings` (`type`, `value`) VALUES
('allowAnonymousPosting', 'False');

-- --------------------------------------------------------

--
-- Table structure for table `knowitall_gebruikers`
--

CREATE TABLE `knowitall_gebruikers` (
  `USERID` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `knowitall_gebruikers`
--

INSERT INTO `knowitall_gebruikers` (`USERID`, `username`, `email`, `password`, `admin`) VALUES
(42, 'henk', 'henk@hoi.nl', '$2y$10$WHdvYSUmrwqCMCX7sVANheJEm8stxoGC19vtpmQzLGbaGcJaEYNOi', 1),
(43, 'piet', 'Piet@gmail.nl', '$2y$10$U7AdaCCZcqH3lxu5CrT6x.DZb.lCizIgL2PbPoK9Iec2RtGyufX5W', 0);

-- --------------------------------------------------------

--
-- Table structure for table `knowitall_posts`
--

CREATE TABLE `knowitall_posts` (
  `ID` int(5) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Post` varchar(1000) NOT NULL,
  `Date` date NOT NULL,
  `Status` varchar(255) NOT NULL,
  `USERID` int(11) NOT NULL,
  `Post_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Approval_Date` date DEFAULT NULL,
  `Image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `knowitall_account`
--
ALTER TABLE `knowitall_account`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `USERID` (`USERID`);

--
-- Indexes for table `knowitall_adminsettings`
--
ALTER TABLE `knowitall_adminsettings`
  ADD PRIMARY KEY (`type`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `knowitall_gebruikers`
--
ALTER TABLE `knowitall_gebruikers`
  ADD PRIMARY KEY (`USERID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `knowitall_posts`
--
ALTER TABLE `knowitall_posts`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `knowitall_account`
--
ALTER TABLE `knowitall_account`
  MODIFY `account_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `knowitall_gebruikers`
--
ALTER TABLE `knowitall_gebruikers`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `knowitall_posts`
--
ALTER TABLE `knowitall_posts`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
