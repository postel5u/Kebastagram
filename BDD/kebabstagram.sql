-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Dim 13 Novembre 2016 à 21:24
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
('5821ff8a840149.07684968', '581dd30a8b779', 'bonjour', '581af1b9c6525', '0000-00-00'),
('58234a946a7fe5.88252162', '581dd30a8b779', 'bonjour?', '581af1b9c6525', '0000-00-00'),
('58234aedb3a291.28709660', '581dd30a8b779', 'rebonjour', '581af1b9c6525', '0000-00-00'),
('58234b39342ae6.47485510', '581dd30a8b779', 'test', '581af1b9c6525', '0000-00-00'),
('58234b76c36f95.30655172', '581dd30a8b779', 'jbsdll,', '581af1b9c6525', '0000-00-00'),
('58239c774db3d7.93102530', '581dd30a8b779', 'bonjour blblblbl', '581af1b9c6525', '0000-00-00'),
('58239d066325c4.75430410', '581dd30a8b779', 'bonjours blblblblblblblblblblbl', 'aqsdsdfqs', '0000-00-00'),
('58239d36c44231.02517746', '581dd30a8b779', 'test', 'aqsdsdfqs', '0000-00-00'),
('58239d3a191f28.47129683', '581dd30a8b779', 'test2', 'aqsdsdfqs', '0000-00-00'),
('58239d3e65fd05.18629603', '581dd30a8b779', 'test3', 'aqsdsdfqs', '0000-00-00'),
('5823a470102f82.98271761', '581dd30a8b779', 'test toast', 'aqsdsdfqs', '0000-00-00'),
('5823a4bebc6fa8.63924784', '581dd30a8b779', '', 'aqsdsdfqs', '0000-00-00'),
('5823a4c41c6005.67374616', '581dd30a8b779', 'test2', 'aqsdsdfqs', '0000-00-00'),
('5823a4df0b4f14.32186010', '581dd30a8b779', '', 'aqsdsdfqs', '0000-00-00'),
('5823a548ab68a9.25404902', '581dd30a8b779', 'd', 'aqsdsdfqs', '0000-00-00'),
('58243baed7df17.99972237', '581dd30a8b779', 'bonjour', 'aqsdsdfqs', '0000-00-00'),
('5824ab2b7806f5.85851074', '581dd30a8b779', 'ok bg\n', 'jgcvjlnvdc', '0000-00-00'),
('5825091ca29185.20197100', '581dd30a8b779', 'test', 'jgcvjlnvdc', '0000-00-00'),
('582509c00b6ef0.67811568', '581dd30a8b779', 'DQSD', 'jgcvjlnvdc', '0000-00-00'),
('5825d9e26e6fa7.02968763', '581dd30a8b779', 'azertyuioud', 'jgcvjlnvdc', '0000-00-00'),
('5825dd4f4d8c52.70290946', '581dd30a8b779', 'test', 'jgcvjlnvdc', '0000-00-00'),
('5825def527d5f9.86468882', '581dd30a8b779', 'okeokeoekeoke', 'jgcvjlnvdc', '0000-00-00'),
('5826350a83d520.41398829', '581dd30a8b779', 'popop', 'jgcvjlnvdc', '0000-00-00'),
('58263d37ee7d62.20763670', '581dd30a8b779', 'qsdq', 'jgcvjlnvdc', '0000-00-00'),
('58264460597fd6.01439307', '581dd30a8b779', 'test date\n', 'jgcvjlnvdc', '2016-11-11'),
('5828d43b30b7e5.30537816', '5828ce879abe7', 'Waw quel beau kébab !', '5828d3ed46a8a', '2016-11-13'),
('5828d862093e78.79067857', '5828cff759dfc', 'J\'avoue c\'était une sacré soirée', '5828d7665f5e7', '2016-11-13'),
('5828d8ae3c2298.58027919', '5828cf1026691', 'Merci ^^', '5828d3ed46a8a', '2016-11-13');

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
('582887d39c34c', 'pics/kebab.jpg', '581af1b9c6525', 'test', 'm', '2016-11-13 15:33:39', 0),
('5828d4f2cf16a', 'pics/kebabfou.jpg', '5828ce879abe7', 'Un bon kébab, fait maison et bien garni ;) à bientôt pour de nouvelle photo ! Bisous bisous', 'KébabPics,KébabFolie,Fait maison,KébabLovers', '2016-11-13 21:02:42', 0),
('582792fe6e112', 'pics/Commit_2.png', '581dd30a8b779', 'aze', 'aze', '2016-11-12 22:09:02', 0),
('582793358d1c8', 'pics/Commit_2.png', '581dd30a8b779', 'aze', 'aze', '2016-11-12 22:09:57', 0),
('5828cdbddf72b', 'pics/kebab.jpg', '581af1b9c6525', 'ok', 'test,ezr', '2016-11-13 20:31:57', 0),
('5828d3ed46a8a', 'pics/kebab.jpg', '5828cf1026691', 'Mon premier kébab à Nancy, superbe sauce blanc et la salade au top !!!', 'sauce blanche,Nancy,Frite,KébabMax', '2016-11-13 20:58:21', 2),
('5828883f50572', 'pics/kebabfou.jpg', '581af1b9c6525', 'bla bla', 'ok', '2016-11-13 15:35:27', 1),
('5828aa59bb2e3', 'pics/kebab.jpg', '581af1b9c6525', 'test', 'ok', '2016-11-13 18:00:57', 0),
('5828b44a8e94f', 'pics/kebab.jpg', '581af1b9c6525', 'test', 'etx', '2016-11-13 18:43:22', 0),
('582793414e148', 'pics/Commit_2.png', '581dd30a8b779', 'aze', 'aze', '2016-11-12 22:10:09', 0),
('582793df7a634', 'pics/Commit_2.png', '581dd30a8b779', 'aze', 'ze', '2016-11-12 22:12:47', 0),
('582794019cace', 'pics/Commit_2.png', '581dd30a8b779', 'aze', 'aze', '2016-11-12 22:13:21', 0),
('5827947b334a1', 'pics/Commit_2.png', '581dd30a8b779', 'ze', 'aze', '2016-11-12 22:15:23', 1),
('5828a277415ae', 'pics/Capture.PNG', '581dd30a8b779', 'sqd', 's', '2016-11-13 17:27:19', 0),
('5827960063e64', 'pics/Commit_2.png', '581dd30a8b779', 'qsdqsd', 'qsd', '2016-11-12 22:21:52', 0),
('5827961c60c4b', 'pics/Commit_2.png', '581dd30a8b779', 'aze', 'zae', '2016-11-12 22:22:20', 0),
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
