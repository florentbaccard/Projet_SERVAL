-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 01 mars 2024 à 14:12
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fpview`
--

-- --------------------------------------------------------

--
-- Structure de la table `action`
--

DROP TABLE IF EXISTS `action`;
CREATE TABLE IF NOT EXISTS `action` (
  `id` int NOT NULL AUTO_INCREMENT,
  `map_id` int NOT NULL,
  `action` varchar(10) NOT NULL,
  `item_id` int NOT NULL,
  `requis` int NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `map_id` (`map_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `action`
--

INSERT INTO `action` (`id`, `map_id`, `action`, `item_id`, `requis`, `status`) VALUES
(1, 3, 'use', 1, 1, 1),
(2, 14, 'take', 1, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

DROP TABLE IF EXISTS `actions`;
CREATE TABLE IF NOT EXISTS `actions` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id	int	Clé primaire auto-incrémentée',
  `map_id` int NOT NULL COMMENT 'map_id	int	Clé secondaire liée à la table map',
  `action` varchar(50) NOT NULL COMMENT 'action	varchar(50)	Le type d’action ‘take’ ou ‘use’',
  `item_id` int NOT NULL COMMENT 'item_id	int	Clé secondaire liée à la table items',
  `requis` int NOT NULL COMMENT 'requis	int	L’identifiant de l’item requis (présent dans l’inventaire). 0 si rien est requis',
  `status` int NOT NULL COMMENT 'status	int	Le statut de l’action, 0 par défaut',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `map_id` int NOT NULL,
  `path` varchar(50) NOT NULL,
  `status_action` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `map_id` (`map_id`),
  KEY `status_action` (`status_action`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `map_id`, `path`, `status_action`) VALUES
(3, 1, '01-0.jpg', 0),
(4, 2, '01-90.jpg', 0),
(5, 3, '01-180.jpg', 0),
(6, 4, '01-270.jpg', 0),
(7, 5, '11-0.jpg', 0),
(8, 6, '11-90.jpg', 0),
(9, 7, '11-180.jpg', 0),
(10, 8, '11-270.jpg', 0),
(11, 9, '10-0.jpg', 0),
(12, 10, '10-90.jpg', 0),
(13, 11, '10-180.jpg', 0),
(14, 12, '10-270.jpg', 0),
(15, 13, '12-0.jpg', 0),
(16, 14, '12-90.jpg', 0),
(17, 15, '12-180.jpg', 0),
(18, 16, '12-270.jpg', 0),
(19, 14, '12-90-1.jpg', 1),
(20, 3, '01-180-1.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`id`, `description`) VALUES
(1, 'une clef doree');

-- --------------------------------------------------------

--
-- Structure de la table `map`
--

DROP TABLE IF EXISTS `map`;
CREATE TABLE IF NOT EXISTS `map` (
  `id` int NOT NULL AUTO_INCREMENT,
  `coordx` int NOT NULL,
  `coordy` int NOT NULL,
  `direction` int NOT NULL,
  `status_action` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status_action` (`status_action`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `map`
--

INSERT INTO `map` (`id`, `coordx`, `coordy`, `direction`, `status_action`) VALUES
(1, 0, 1, 0, 0),
(2, 0, 1, 90, 0),
(3, 0, 1, 180, 1),
(4, 0, 1, 270, 0),
(5, 1, 1, 0, 0),
(6, 1, 1, 90, 0),
(7, 1, 1, 180, 0),
(8, 1, 1, 270, 0),
(9, 1, 0, 0, 0),
(10, 1, 0, 90, 0),
(11, 1, 0, 180, 0),
(12, 1, 0, 270, 0),
(13, 1, 2, 0, 0),
(14, 1, 2, 90, 1),
(15, 1, 2, 180, 0),
(16, 1, 2, 270, 0);

-- --------------------------------------------------------

--
-- Structure de la table `text`
--

DROP TABLE IF EXISTS `text`;
CREATE TABLE IF NOT EXISTS `text` (
  `id` int NOT NULL AUTO_INCREMENT,
  `map_id` int NOT NULL,
  `text` varchar(100) NOT NULL,
  `status_action` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `map_id` (`map_id`),
  KEY `status_action` (`status_action`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `text`
--

INSERT INTO `text` (`id`, `map_id`, `text`, `status_action`) VALUES
(1, 1, 'Je dois trouver une cle pour quitter cet endroit et sauver Marie...', 0),
(2, 2, 'Un mur est present, je dois trouver un autre passage...', 0),
(3, 3, 'Je dois trouver une cle pour quitter cet endroit...', 0),
(7, 9, 'Ca sent la mort par ici...', 0),
(6, 4, 'Un mur est present, je dois trouver un autre passage...', 0),
(11, 14, 'Voici un bien joli vase, il denature avec le rester de la zone...', 0),
(8, 10, 'Ca sent la mort par ici...', 0),
(9, 11, 'Ca sent la mort par ici...', 0),
(10, 12, 'Ca sent la mort par ici...', 0),
(12, 14, 'Tu brises le vase et recuperes la cle doree qui se trouve a l\'interieur !\r\n', 1),
(13, 3, 'Victoire !', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
