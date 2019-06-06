-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2019 at 09:35 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

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
(33, 'admin', 'its.a.me.brand@gmail.com', '$2y$10$TaS3mF2qBLNWqrQsYwLYYuWpTBeILO1z4.JI5939fAe', 0),
(35, 'hoi', 'hoi@gmail.com', '$2y$10$TaS3mF2qBLNWqrQsYwLYYuWpTBeILO1z4.JI5939fAeyzC/mEEeEC', 0),
(36, 'admin', 'its.a.me.brand@gmal.com', '$2y$10$2AF8sjSOJ56a8RxMAT1zX.ImD/z4P5xg3x4fzb03iZyNuhIq2dWri', 0);

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
  `Approval_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `knowitall_posts`
--

INSERT INTO `knowitall_posts` (`ID`, `Title`, `Post`, `Date`, `Status`, `USERID`, `Post_Date`, `Approval_Date`) VALUES
(1, 'hoi', 'hyr', '2019-06-11', 'Pending', 36, '2019-06-06 09:31:09', NULL);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `knowitall_gebruikers`
--
ALTER TABLE `knowitall_gebruikers`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `knowitall_posts`
--
ALTER TABLE `knowitall_posts`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
