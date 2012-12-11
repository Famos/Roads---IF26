-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 11 Décembre 2012 à 10:45
-- Version du serveur: 5.1.53
-- Version de PHP: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `roads`
--

-- --------------------------------------------------------

--
-- Structure de la table `ami`
--

CREATE TABLE IF NOT EXISTS `ami` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de la relation d''amitié',
  `id_utilisateur_1` int(11) NOT NULL,
  `id_utilisateur_2` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `ami`
--

INSERT INTO `ami` (`id`, `id_utilisateur_1`, `id_utilisateur_2`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 1, 3),
(4, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `localisation`
--

CREATE TABLE IF NOT EXISTS `localisation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `localisation`
--

INSERT INTO `localisation` (`id`, `id_utilisateur`, `latitude`, `longitude`, `date`) VALUES
(1, 1, '1.12345', '12.12345', '2012-12-11'),
(2, 2, '0.12345436', '15.12343563', '2012-12-10'),
(3, 3, '12345', '12345678', '2012-12-10');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `notification`
--


-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''utilisateur',
  `login` varchar(25) NOT NULL COMMENT 'Pseudonyme de l''utilisateur',
  `password` varchar(100) NOT NULL COMMENT 'Mot de passe crypté de l''utilisateur',
  `email` varchar(50) NOT NULL COMMENT 'Adresse email de l''utilisateur',
  `localisation` tinyint(1) NOT NULL COMMENT 'Localisation autorisée : Vrai / Localisation non-autorisée : Faux',
  `token` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `password`, `email`, `localisation`, `token`) VALUES
(1, 'Antoine', '1a1dc91c907325c69271ddf0c944bc72ARFGI', '', 1, '8ynfqsxe1p'),
(2, 'Trung', '1a1dc91c907325c69271ddf0c944bc72QKFIR', '', 1, NULL),
(3, 'test', 'test', 'fezfze', 1, NULL);
