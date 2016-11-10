-- phpMyAdmin SQL Dump
-- version 4.6.4deb1
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Jeu 10 Novembre 2016 à 10:34
-- Version du serveur :  5.6.30-1
-- Version de PHP :  7.0.12-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `kebabstagram`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `uniqid` varchar(23) NOT NULL,
  `id_user` varchar(23) NOT NULL,
  `comment` text NOT NULL,
  `id_picture` varchar(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`uniqid`, `id_user`, `comment`, `id_picture`) VALUES
('5821ff8a840149.07684968', '581dd30a8b779', 'bonjour', '581af1b9c6525'),
('58234a946a7fe5.88252162', '581dd30a8b779', 'bonjour?', '581af1b9c6525'),
('58234aedb3a291.28709660', '581dd30a8b779', 'rebonjour', '581af1b9c6525'),
('58234b39342ae6.47485510', '581dd30a8b779', 'test', '581af1b9c6525'),
('58234b76c36f95.30655172', '581dd30a8b779', 'jbsdll,', '581af1b9c6525'),
('58239c774db3d7.93102530', '581dd30a8b779', 'bonjour blblblbl', '581af1b9c6525'),
('58239d066325c4.75430410', '581dd30a8b779', 'bonjours blblblblblblblblblblbl', 'aqsdsdfqs'),
('58239d36c44231.02517746', '581dd30a8b779', 'test', 'aqsdsdfqs'),
('58239d3a191f28.47129683', '581dd30a8b779', 'test2', 'aqsdsdfqs'),
('58239d3e65fd05.18629603', '581dd30a8b779', 'test3', 'aqsdsdfqs'),
('5823a470102f82.98271761', '581dd30a8b779', 'test toast', 'aqsdsdfqs'),
('5823a4bebc6fa8.63924784', '581dd30a8b779', '', 'aqsdsdfqs'),
('5823a4c41c6005.67374616', '581dd30a8b779', 'test2', 'aqsdsdfqs'),
('5823a4df0b4f14.32186010', '581dd30a8b779', '', 'aqsdsdfqs'),
('5823a548ab68a9.25404902', '581dd30a8b779', 'd', 'aqsdsdfqs'),
('58243baed7df17.99972237', '581dd30a8b779', 'bonjour', 'aqsdsdfqs');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
