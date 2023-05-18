-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 18 mai 2023 à 08:53
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `kgbnew`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(100) NOT NULL,
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `date_creation`) VALUES
(5, 'admin3', 'admin3', 'admin3@admin.com', '$2y$10$rSr4KwlVAjoY/jqaSNxlrOKhbW6PyHXRqgxBwDb5qW9m0gWuUfLNa', '2023-05-16 13:08:25');

-- --------------------------------------------------------

--
-- Structure de la table `agents`
--

DROP TABLE IF EXISTS `agents`;
CREATE TABLE IF NOT EXISTS `agents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `code_identification_hash` varchar(255) NOT NULL,
  `nationalite` varchar(255) NOT NULL,
  `specialites` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `agents`
--

INSERT INTO `agents` (`id`, `nom`, `prenom`, `date_naissance`, `code_identification_hash`, `nationalite`, `specialites`) VALUES
(9, 'agent3', 'agent3', '1999-12-02', '$2y$10$4C.yQWG8SwpmAhqE0TJ6XecGJeplkHdvSSOSWsgO9YH6lRM4paFrC', 'Allemagne', 'Interrogatoire, Interrogatoire, Interrogatoire'),
(8, 'agent2', 'agent2', '2012-01-01', '$2y$10$OAZWc1svkD.vU98bZSwis.UAY0PhNBv6OA/vGIrpEzcJPnl/dpI5y', 'France', 'Piratage informatique, Interrogatoire'),
(7, 'agent1', 'agent1', '2010-01-01', '$2y$10$Q6p0hls5kxKOqvY.7mJ04.lPXdk0p5etQ/QnaBnTjNRCv8SG3sWxy', 'Russie', 'Infiltration, Piratage informatique, Interrogatoire'),
(10, 'agent4', 'agent4', '1985-10-01', '$2y$10$yohaI3POENR/VLI2oVj7IuiFOJtszY0Hwt.7RpuuIJ/fej10ccT2G', 'Coree', 'Piratage informatique, Interrogatoire'),
(11, 'agent5', 'agent5', '1998-06-04', '$2y$10$N1A41QhP.ypPLesMyqBMUOdomYdn5Y49FvFeNB8hnoVxOmWQoVN1C', 'Chine', 'Infiltration, Interrogatoire, Interrogatoire'),
(17, 'agent8', 'agent8', '2005-10-01', '$2y$10$MegnXFMHyXaj.N.UlEtoMOtKO7vfwF1oH9wxkLK6CVWhZeZEC2TSO', 'Allemagne', 'Vol, Filature'),
(14, 'agent6', 'agent6', '1989-01-01', '$2y$10$O7lmc0CzSpS8E3OXViBQiOI0K1uokVh0AKomJHT/h04UwOEIFXrum', 'France', 'Vol'),
(16, 'agent7', 'agent7', '1987-12-10', '$2y$10$hK5WN.T/cO.lnMh/aocP/OIhmufwK4Tf1oYbl/5mirm/2pVLKQFpe', 'Russie', 'Piratage informatique');

-- --------------------------------------------------------

--
-- Structure de la table `cibles`
--

DROP TABLE IF EXISTS `cibles`;
CREATE TABLE IF NOT EXISTS `cibles` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `nom_code` varchar(50) NOT NULL,
  `nationalite` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cibles`
--

INSERT INTO `cibles` (`id`, `nom`, `prenom`, `date_naissance`, `nom_code`, `nationalite`) VALUES
(5, 'Cible1', 'Prenom1', '1990-01-01', 'CODE1', 'Russie'),
(6, 'Cible2', 'Prenom2', '1985-02-12', 'CODE2', 'France'),
(7, 'Cible3', 'Prenom3', '1978-07-23', 'CODE3', 'Allemagne'),
(8, 'Cible4', 'Prenom4', '1983-12-15', 'CODE4', 'Coree'),
(9, 'Cible5', 'Prenom5', '1995-09-09', 'CODE5', 'Chine'),
(10, 'cible6', 'Prenom6', '2000-12-12', 'CODE6', 'Chine'),
(11, 'cible7', 'Prenom7', '2002-01-01', 'CODE7', 'Angleterre');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `nom_code` varchar(50) NOT NULL,
  `nationalite` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `prenom`, `date_naissance`, `nom_code`, `nationalite`) VALUES
(7, 'tchin', 'heroku', '1989-12-15', 'le dragon', 'Chine'),
(2, 'Ivanov', 'Ivan', '1985-01-01', 'ivanov_i', 'Russie'),
(3, 'Dubois', 'Marie', '1990-03-15', 'dubois_m', 'France'),
(4, 'Schmidt', 'Hans', '1982-07-20', 'schmidt_h', 'Allemagne'),
(5, 'Kim', 'Soo-Jin', '1995-12-05', 'kim_sj', 'Coree'),
(6, 'Li', 'Ming', '1988-06-30', 'li_m', 'Chine'),
(8, 'test', 'test', '2020-01-01', 'test', 'Ukraine');

-- --------------------------------------------------------

--
-- Structure de la table `missions`
--

DROP TABLE IF EXISTS `missions`;
CREATE TABLE IF NOT EXISTS `missions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `nom_code` varchar(50) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `statut` varchar(50) NOT NULL,
  `specialite` varchar(250) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `agents_id` varchar(100) DEFAULT NULL,
  `contacts_id` varchar(100) DEFAULT NULL,
  `cibles_id` varchar(100) DEFAULT NULL,
  `planques_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_agents` (`agents_id`),
  KEY `fk_contact` (`contacts_id`),
  KEY `fk_cibles` (`cibles_id`),
  KEY `fk_planque` (`planques_id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `missions`
--

INSERT INTO `missions` (`id`, `titre`, `description`, `nom_code`, `pays`, `type`, `statut`, `specialite`, `date_debut`, `date_fin`, `agents_id`, `contacts_id`, `cibles_id`, `planques_id`) VALUES
(45, 'les joyaux de la couronne', 'voler les joyaux', 'rubis', 'France', 'Surveillance', 'En cours', 'Piratage informatique, Interrogatoire', '2023-05-18', '2023-05-26', '8, 14', '3', '7, 9, 8', '9'),
(47, 'mission test', 'test', 'test', 'Coree', 'Piratage', 'En cours', 'Infiltration, Filature', '2023-05-12', '2023-06-02', '10', '5', '9, 10, 5', '13'),
(48, 'test mission', 'test', 'test envoi', 'Allemagne', 'Infiltration', 'En préparation', 'Infiltration, Interrogatoire', '2023-05-26', '2023-06-09', '16', '4', '6, 8', '11');

-- --------------------------------------------------------

--
-- Structure de la table `planque`
--

DROP TABLE IF EXISTS `planque`;
CREATE TABLE IF NOT EXISTS `planque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `planque`
--

INSERT INTO `planque` (`id`, `code`, `adresse`, `pays`, `type`) VALUES
(13, 'PLQ7', '10 open Street', 'Coree', 'Hôtel'),
(10, 'PLQ4', '25 avenue Montaigne', 'France', 'Hôtel'),
(9, 'PLQ3', '2 avenue des Champs-Elysées', 'France', 'Maison'),
(14, 'PLQ8', 'big tower', 'Chine', 'Appartement'),
(15, 'PLQ7', 'test', 'France', 'Maison'),
(11, 'PLQ5', '6 Friedrichstrasse', 'Allemagne', 'Maison'),
(12, 'PLQ6', '10 Gorky Street', 'Russie', 'Hôtel'),
(16, 'PLQ8', 'test ', 'Coree', 'Camion');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
