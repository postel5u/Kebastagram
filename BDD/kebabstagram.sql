-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 04 Novembre 2016 à 14:15
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

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
-- Structure de la table `followers`
--

CREATE TABLE `followers` (
  `id_user` varchar(23) NOT NULL,
  `id_followers` varchar(23) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `follows`
--

CREATE TABLE `follows` (
  `id_user` varchar(23) NOT NULL,
  `id_user_follow` varchar(23) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

CREATE TABLE `pictures` (
  `id` varchar(23) NOT NULL,
  `link` varchar(255) NOT NULL,
  `user` varchar(35) NOT NULL,
  `description` varchar(255) NOT NULL,
  `tag` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pictures`
--

INSERT INTO `pictures` (`id`, `link`, `user`, `description`, `tag`, `date`) VALUES
('a', '', 'aze', 'tryuiolmù', 'ok,dacc', '2016-11-03 00:00:00'),
('aqsd', '', 'aze', 'tryuiolmù', 'ok,dacc', '2016-11-03 00:00:00'),
('aqsdsdfqs', '', 'aze', 'tryuiolmù', 'ok,dacc', '2016-11-03 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` varchar(23) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `postal_code` text NOT NULL,
  `city` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `date_of_birth`, `email`, `address`, `postal_code`, `city`) VALUES
('1', 'Naay', '', 'Guillaume', 'Launay', '2016-11-01', '', '', '54000', 'Nancy'),
('2', 'NickMyName', '', 'Alexendre', 'Pereira', '2016-11-01', '', '', '54000', 'Nancy'),
('581af1b9c6525', 'guillaumelaunay', '$2y$12$v8Q5jsqLbIVU0YTjfKrq8usoPQ6fF8X4dcFBssW8FUcJj.S9P4WE6', 'Guillaume', 'Launay', '1996-05-18', 'gl55@hotmail.fr', '35 rue pasteur', '54000', 'Nancy');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
