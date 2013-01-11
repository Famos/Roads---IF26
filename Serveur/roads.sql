-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 11 Janvier 2013 à 10:56
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
  `visibilite` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Contenu de la table `ami`
--

INSERT INTO `ami` (`id`, `id_utilisateur_1`, `id_utilisateur_2`, `visibilite`) VALUES
(1, 1, 2, 1),
(2, 2, 1, 1),
(3, 1, 3, 1),
(4, 3, 1, 1),
(7, 1, 4, 1),
(8, 4, 1, 1),
(9, 1, 5, 1),
(10, 5, 1, 1),
(11, 1, 6, 1),
(12, 6, 1, 1),
(13, 2, 5, 1),
(14, 5, 2, 1),
(15, 3, 5, 1),
(16, 5, 3, 1),
(17, 3, 6, 1),
(18, 6, 3, 1),
(19, 2, 7, 1),
(20, 7, 2, 1),
(21, 4, 7, 1),
(22, 7, 4, 1),
(35, 7, 6, 1),
(34, 6, 7, 1),
(43, 7, 1, 1),
(42, 1, 7, 1),
(39, 2, 6, 1),
(38, 6, 2, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `localisation`
--

INSERT INTO `localisation` (`id`, `id_utilisateur`, `latitude`, `longitude`, `date`) VALUES
(1, 1, '48.858991', '2.352790', '2013-01-11'),
(2, 2, '48.832456', '2.352790', '2012-12-19'),
(3, 3, '48.908900', '2.42279', '2012-12-10'),
(4, 4, '48.968900', '2.46279', '2012-12-20'),
(5, 5, '48.918900', '2.48279', '2012-12-20'),
(6, 6, '48.898900', '2.47279', '2012-12-20'),
(7, 7, '48.9589097', '2.55260', '2012-12-20');

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
  `echecAuthentification` int(11) NOT NULL DEFAULT '0',
  `dateProchainEssai` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `password`, `email`, `localisation`, `token`, `echecAuthentification`, `dateProchainEssai`) VALUES
(1, 'Antoine', '1a1dc91c907325c69271ddf0c944bc72ARFGI', '', 1, 'cg8n3y1jnn', 0, '2013-01-11 10:00:56'),
(2, 'Trung', '1a1dc91c907325c69271ddf0c944bc72QKFIR', '', 1, 'ry4nbaspqu', 0, NULL),
(3, 'test', 'test', 'fezfze', 1, NULL, 0, NULL),
(4, 'jean', '1a1dc91c907325c69271ddf0c944bc72ARFGI', 'djiefjezioj', 1, NULL, 0, NULL),
(5, 'pierre', '1a1dc91c907325c69271ddf0c944bc72ARFGI', 'defizufreio', 0, NULL, 0, NULL),
(6, 'paul', '1a1dc91c907325c69271ddf0c944bc72ARFGI', 'ijezfeozjfez', 1, 'm230fmm1tk', 0, NULL),
(7, 'romain', '1a1dc91c907325c69271ddf0c944bc72ARFGI', 'fjeizifohregu', 1, NULL, 0, NULL);
