-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 20 Décembre 2012 à 16:42
-- Version du serveur: 5.5.25
-- Version de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `roads`
--

-- --------------------------------------------------------

--
-- Structure de la table `ami`
--

CREATE TABLE `ami` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de la relation d''amitié',
  `id_utilisateur_1` int(11) NOT NULL,
  `id_utilisateur_2` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 DATA DIRECTORY='./Roads/' INDEX DIRECTORY='./Roads/' AUTO_INCREMENT=44 ;

--
-- Contenu de la table `ami`
--

INSERT INTO `ami` (`id`, `id_utilisateur_1`, `id_utilisateur_2`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 1, 3),
(4, 3, 1),
(7, 1, 4),
(8, 4, 1),
(9, 1, 5),
(10, 5, 1),
(11, 1, 6),
(12, 6, 1),
(13, 2, 5),
(14, 5, 2),
(15, 3, 5),
(16, 5, 3),
(17, 3, 6),
(18, 6, 3),
(19, 2, 7),
(20, 7, 2),
(21, 4, 7),
(22, 7, 4),
(35, 7, 6),
(34, 6, 7),
(43, 7, 1),
(42, 1, 7),
(39, 2, 6),
(38, 6, 2);

-- --------------------------------------------------------

--
-- Structure de la table `localisation`
--

CREATE TABLE `localisation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 DATA DIRECTORY='./Roads/' INDEX DIRECTORY='./Roads/' AUTO_INCREMENT=8 ;

--
-- Contenu de la table `localisation`
--

INSERT INTO `localisation` (`id`, `id_utilisateur`, `latitude`, `longitude`, `date`) VALUES
(1, 1, '0.000000', '0.000000', '2012-12-20'),
(2, 2, '12345', '78910', '2012-12-19'),
(3, 3, '12345', '12345678', '2012-12-10'),
(4, 4, '48.958900', '2.55279', '2012-12-20'),
(5, 5, '47.958900', '2.55279', '2012-12-20'),
(6, 6, '0.000000', '0.000000', '2012-12-20'),
(7, 7, '45.958900', '2.55279', '2012-12-20');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''utilisateur',
  `login` varchar(25) NOT NULL COMMENT 'Pseudonyme de l''utilisateur',
  `password` varchar(100) NOT NULL COMMENT 'Mot de passe crypté de l''utilisateur',
  `email` varchar(50) NOT NULL COMMENT 'Adresse email de l''utilisateur',
  `localisation` tinyint(1) NOT NULL COMMENT 'Localisation autorisée : Vrai / Localisation non-autorisée : Faux',
  `token` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 DATA DIRECTORY='./Roads/' INDEX DIRECTORY='./Roads/' AUTO_INCREMENT=8 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `password`, `email`, `localisation`, `token`) VALUES
(1, 'Antoine', '1a1dc91c907325c69271ddf0c944bc72ARFGI', '', 1, 'sqkadged0i'),
(2, 'Trung', '1a1dc91c907325c69271ddf0c944bc72QKFIR', '', 1, 'ry4nbaspqu'),
(3, 'test', 'test', 'fezfze', 1, NULL),
(4, 'jean', '1a1dc91c907325c69271ddf0c944bc72ARFGI', 'djiefjezioj', 1, NULL),
(5, 'pierre', '1a1dc91c907325c69271ddf0c944bc72ARFGI', 'defizufreio', 0, NULL),
(6, 'paul', '1a1dc91c907325c69271ddf0c944bc72ARFGI', 'ijezfeozjfez', 1, 'm230fmm1tk'),
(7, 'romain', '1a1dc91c907325c69271ddf0c944bc72ARFGI', 'fjeizifohregu', 1, NULL);
