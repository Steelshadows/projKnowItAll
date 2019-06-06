-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2019 at 01:25 PM
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
  `gebruiker_ID` int(11) NOT NULL,
  `gebruikersnaam` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `wachtwoord` varchar(100) NOT NULL,
  `admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `knowitall_gebruikers`
--

INSERT INTO `knowitall_gebruikers` (`gebruiker_ID`, `gebruikersnaam`, `email`, `wachtwoord`, `admin`) VALUES
(33, 'admin', 'its.a.me.brand@gmail.com', '$2y$10$TaS3mF2qBLNWqrQsYwLYYuWpTBeILO1z4.JI5939fAe', 0),
(35, 'hoi', 'hoi@gmail.com', '$2y$10$TaS3mF2qBLNWqrQsYwLYYuWpTBeILO1z4.JI5939fAeyzC/mEEeEC', 0);

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
  `Gebruiker_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `knowitall_posts`
--

INSERT INTO `knowitall_posts` (`ID`, `Title`, `Post`, `Date`, `Status`, `Gebruiker_ID`) VALUES
(1, 'hoi', 'hoi', '2019-06-17', 'Pending', 35),
(2, 'hoi', 'hoi', '2019-06-17', 'Pending', 35),
(3, 'dieman', 'jaa die man is dooi', '2019-06-26', 'Pending', 33);

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
  ADD PRIMARY KEY (`gebruiker_ID`),
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
  MODIFY `gebruiker_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `knowitall_posts`
--
ALTER TABLE `knowitall_posts`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
