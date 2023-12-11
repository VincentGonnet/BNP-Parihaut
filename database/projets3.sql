-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 11 déc. 2023 à 15:39
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projets3`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `NUMCLIENT` int NOT NULL AUTO_INCREMENT,
  `NUMEMPLOYE` int NOT NULL,
  `NOM` char(15) NOT NULL,
  `PRENOM` char(15) NOT NULL,
  `ADRESSE` char(32) NOT NULL,
  `MAIL` char(32) DEFAULT NULL,
  `ENREGISTRE` tinyint(1) NOT NULL,
  `NUMTEL` int DEFAULT NULL,
  `SITUATION` char(15) DEFAULT NULL,
  PRIMARY KEY (`NUMCLIENT`),
  KEY `I_FK_CLIENT_EMPLOYE` (`NUMEMPLOYE`)
) ENGINE=MyISAM CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `NOMCOMPTE` char(32) NOT NULL,
  PRIMARY KEY (`NOMCOMPTE`)
) ENGINE=MyISAM CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `compteclient`
--

DROP TABLE IF EXISTS `compteclient`;
CREATE TABLE IF NOT EXISTS `compteclient` (
  `NUMCLIENT` int NOT NULL,
  `NOMCOMPTE` char(32) NOT NULL,
  `DATEOUVERTURE` date NOT NULL,
  `DATEFERMETURE` date DEFAULT NULL,
  `SOLDE` decimal(10,2) NOT NULL,
  `MONTANTDECOUVERT` decimal(10,2) NOT NULL,
  PRIMARY KEY (`NUMCLIENT`,`NOMCOMPTE`),
  KEY `I_FK_COMPTECLIENT_CLIENT` (`NUMCLIENT`),
  KEY `I_FK_COMPTECLIENT_COMPTE` (`NOMCOMPTE`)
) ENGINE=MyISAM CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

DROP TABLE IF EXISTS `contrat`;
CREATE TABLE IF NOT EXISTS `contrat` (
  `NOMCONTRAT` char(32) NOT NULL,
  PRIMARY KEY (`NOMCONTRAT`)
) ENGINE=MyISAM CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contratclient`
--

DROP TABLE IF EXISTS `contratclient`;
CREATE TABLE IF NOT EXISTS `contratclient` (
  `NOMCONTRAT` char(32) NOT NULL,
  `NUMCLIENT` int NOT NULL,
  `DATEFERMETURE` date DEFAULT NULL,
  `DATEOUVERTURECONTRAT` date NOT NULL,
  `TARIFMENSUEL` decimal(10,2) NOT NULL,
  PRIMARY KEY (`NOMCONTRAT`,`NUMCLIENT`),
  KEY `I_FK_CONTRATCLIENT_CONTRAT` (`NOMCONTRAT`),
  KEY `I_FK_CONTRATCLIENT_CLIENT` (`NUMCLIENT`)
) ENGINE=MyISAM CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

DROP TABLE IF EXISTS `employe`;
CREATE TABLE IF NOT EXISTS `employe` (
  `NUMEMPLOYE` int NOT NULL AUTO_INCREMENT,
  `NOM` char(15) NOT NULL,
  `PRENOM` char(15) NOT NULL,
  `LOGIN` char(32) NOT NULL,
  `MDP` char(60) NOT NULL,
  `CATEGORIE` char(32) NOT NULL,
  PRIMARY KEY (`NUMEMPLOYE`)
) ENGINE=MyISAM CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `motif`
--

DROP TABLE IF EXISTS `motif`;
CREATE TABLE IF NOT EXISTS `motif` (
  `IDMOTIF` int NOT NULL AUTO_INCREMENT,
  `LIBELLEMOTIF` char(32) NOT NULL,
  `LISTEPIECES` char(32) NOT NULL,
  PRIMARY KEY (`IDMOTIF`)
) ENGINE=MyISAM CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

DROP TABLE IF EXISTS `operation`;
CREATE TABLE IF NOT EXISTS `operation` (
  `NUMOP` int NOT NULL AUTO_INCREMENT,
  `NUMCLIENT` int NOT NULL,
  `NOMCOMPTE` char(32) NOT NULL,
  `MONTANT` decimal(10,2) NOT NULL,
  `TYPEOP` char(15) NOT NULL,
  `DATEOP` date NOT NULL,
  PRIMARY KEY (`NUMOP`),
  KEY `I_FK_OPERATION_CLIENT` (`NUMCLIENT`),
  KEY `I_FK_OPERATION_COMPTE` (`NOMCOMPTE`)
) ENGINE=MyISAM CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `NUMRDV` int NOT NULL AUTO_INCREMENT,
  `NUMEMPLOYE` int NOT NULL,
  `NUMCLIENT` int DEFAULT NULL,
  `IDMOTIF` int NOT NULL,
  `DATERDV` date NOT NULL,
  PRIMARY KEY (`NUMRDV`),
  KEY `I_FK_RDV_EMPLOYE` (`NUMEMPLOYE`),
  KEY `I_FK_RDV_CLIENT` (`NUMCLIENT`),
  KEY `I_FK_RDV_MOTIF` (`IDMOTIF`)
) ENGINE=MyISAM CHARSET=utf8 COLLATE=utf8_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
