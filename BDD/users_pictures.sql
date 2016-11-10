-- phpMyAdmin SQL Dump
-- version 4.6.4deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2016 at 01:36 PM
-- Server version: 5.6.30-1
-- PHP Version: 7.0.12-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kebabstagram`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_pictures`
--

CREATE TABLE `users_pictures` (
  `id_users` varchar(23) NOT NULL,
  `id_pictures` varchar(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_pictures`
--

INSERT INTO `users_pictures` (`id_users`, `id_pictures`) VALUES
('581dd30a8b779', '0'),
('581dd30a8b779', 'a'),
('581dd30a8b779', 'jgcvjln');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_pictures`
--
ALTER TABLE `users_pictures`
  ADD PRIMARY KEY (`id_users`,`id_pictures`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
