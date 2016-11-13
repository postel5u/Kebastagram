-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Dim 13 Novembre 2016 à 22:00
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
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `uniqid` varchar(23) NOT NULL,
  `id_user` varchar(23) NOT NULL,
  `comment` text NOT NULL,
  `id_picture` varchar(23) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`uniqid`, `id_user`, `comment`, `id_picture`, `date`) VALUES
('5828d43b30b7e5.30537816', '5828ce879abe7', 'Waw quel beau kébab !', '5828d3ed46a8a', '2016-11-13'),
('5828d862093e78.79067857', '5828cff759dfc', 'J\'avoue c\'était une sacré soirée', '5828d7665f5e7', '2016-11-13'),
('5828d8ae3c2298.58027919', '5828cf1026691', 'Merci ^^', '5828d3ed46a8a', '2016-11-13');

-- --------------------------------------------------------

--
-- Structure de la table `follows`
--

CREATE TABLE `follows` (
  `id_user` varchar(23) NOT NULL,
  `id_user_follow` varchar(23) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `follows`
--

INSERT INTO `follows` (`id_user`, `id_user_follow`) VALUES
('581af1b9c6525', '581dd30a8b779'),
('581af1b9c6525', '5827afde474b7'),
('581dd30a8b779', '581af1b9c6525'),
('581dd30a8b779', '5827afde474b7'),
('5828ce879abe7', '5828cf1026691'),
('5828ce879abe7', '5828cff759dfc'),
('5828cf1026691', '5828ce879abe7'),
('5828cf1026691', '5828cff759dfc'),
('5828cff759dfc', '5828ce879abe7');

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
  `date` datetime NOT NULL,
  `nbLike` int(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pictures`
--

INSERT INTO `pictures` (`id`, `link`, `user`, `description`, `tag`, `date`, `nbLike`) VALUES
('5828d4f2cf16a', 'pics/kebabfou.jpg', '5828ce879abe7', 'Un bon kébab, fait maison et bien garni ;) à bientôt pour de nouvelle photo ! Bisous bisous', 'KébabPics,KébabFolie,Fait maison,KébabLovers', '2016-11-13 21:02:42', 0),
('5828d3ed46a8a', 'pics/kebab.jpg', '5828cf1026691', 'Mon premier kébab à Nancy, superbe sauce blanc et la salade au top !!!', 'sauce blanche,Nancy,Frite,KébabMax', '2016-11-13 20:58:21', 2),
('5828d7665f5e7', 'pics/kebab_fille.jpg', '5828ce879abe7', 'Encore une suberbe soirée au Kébab du saulcy, que de fou rire avec mes amies ^^ ', 'Soirée,KébabSaulcy,Fille', '2016-11-13 21:13:10', 1),
('5828d9b700e66', 'pics/BGi_wBBCEAA7gNM.jpg', '5828cff759dfc', 'Un énorme kébab pour ce soir !!', 'Enorme,Grosse faim,Frite', '2016-11-13 21:23:03', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `uniqid` varchar(23) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `postal_code` text NOT NULL,
  `city` text NOT NULL,
  `profil_picture` varchar(255) NOT NULL DEFAULT 'image/profil.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`uniqid`, `username`, `password`, `firstname`, `lastname`, `date_of_birth`, `email`, `address`, `postal_code`, `city`, `profil_picture`) VALUES
('5827ab50edc97', 'azert', '$2y$12$t238ayww8P2Ib/pd6Xd4luqQ2x44Nyf9GyyzfMshbfxl4ovdvdQr.', 'aze', 'zae', '2016-11-25', 'zeqz@zqe.fr', 'aze', 'zae', 'aze', 'image/profil.png'),
('5828ce879abe7', 'Mimi', '$2y$12$8RTOUkobHPa/sv0CZDrHl.Tp55VFTZss.YTTaRh6DetqNlMqVXzA2', 'Myriam', 'Matmat', '1997-08-19', 'mimi@gmail.com', '35 rue pasteur ', '54000 ', 'Nancy ', 'pics/profil.jpg'),
('5828cf1026691', 'Naay', '$2y$12$Uchwb2vDtIOF/G8ybwdNROdbnxfWpfWLmZUVMuQ.p4L/suM4sKjjG', 'Guillaume', 'Launay', '2016-05-18', 'naay@gmail.com', '35 rue pasteur', '54000', 'Nancy', 'image/profil.png'),
('5828cff759dfc', 'Alex', '$2y$12$SMiEMT7fDS0mFDBscP2y5.ZiXdGaUDMX9M3KWV16yQ/NgdZN1GK9e', 'Peireira', 'Alexandre', '1995-11-03', 'alex@gmail.com', '28 rue aristide briand ', '54540 ', 'Laxou ', 'pics/badass.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users_pictures`
--

CREATE TABLE `users_pictures` (
  `id_users` varchar(23) NOT NULL,
  `id_pictures` varchar(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users_pictures`
--

INSERT INTO `users_pictures` (`id_users`, `id_pictures`) VALUES
('581af1b9c6525', '5827947b334a1'),
('581dd30a8b779', '5828883f50572'),
('5828ce879abe7', '5828d3ed46a8a'),
('5828cff759dfc', '5828d3ed46a8a'),
('5828cff759dfc', '5828d7665f5e7');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`uniqid`);

--
-- Index pour la table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id_user`,`id_user_follow`);

--
-- Index pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uniqid`);

--
-- Index pour la table `users_pictures`
--
ALTER TABLE `users_pictures`
  ADD PRIMARY KEY (`id_users`,`id_pictures`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
