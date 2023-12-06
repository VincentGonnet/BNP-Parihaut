-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 06 déc. 2023 à 14:53
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
  `IDCLIENT` int NOT NULL AUTO_INCREMENT,
  `IDEMPLOYE` int NOT NULL,
  `NOM` char(15) NOT NULL,
  `PRENOM` char(15) NOT NULL,
  `DATENAISSANCE` date NOT NULL,
  `PROFESSION` char(32) NOT NULL,
  `SITUATIONFAMILIALE` char(32) NOT NULL,
  `NUMTELEPHONE` char(10) NOT NULL,
  `MAIL` char(32) NOT NULL,
  `DATEOUVERTURE` date NOT NULL,
  `DATEFIN` date DEFAULT NULL,
  PRIMARY KEY (`IDCLIENT`),
  KEY `I_FK_CLIENT_EMPLOYE` (`IDEMPLOYE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `IDCOMPTE` int NOT NULL AUTO_INCREMENT,
  `IDCLIENT` int NOT NULL,
  `NOM` char(15) NOT NULL,
  `DATEOUVERTURE` date NOT NULL,
  `SOLDE` decimal(10,2) NOT NULL,
  `DECOUVERT` decimal(10,2) NOT NULL,
  `DATEFIN` date DEFAULT NULL,
  `ACTIF` tinyint(1) NOT NULL,
  PRIMARY KEY (`IDCOMPTE`),
  KEY `I_FK_COMPTE_CLIENT` (`IDCLIENT`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

DROP TABLE IF EXISTS `contrat`;
CREATE TABLE IF NOT EXISTS `contrat` (
  `IDCONTRAT` int NOT NULL AUTO_INCREMENT,
  `IDCLIENT` int NOT NULL,
  `NOM` char(15) NOT NULL,
  `TARIFMENSUEL` decimal(10,2) NOT NULL,
  `DATEOUVERTURE` date NOT NULL,
  `DATEFIN` date DEFAULT NULL,
  `ACTIF` tinyint(1) NOT NULL,
  PRIMARY KEY (`IDCONTRAT`),
  KEY `I_FK_CONTRAT_CLIENT` (`IDCLIENT`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `creneauoccupe`
--

DROP TABLE IF EXISTS `creneauoccupe`;
CREATE TABLE IF NOT EXISTS `creneauoccupe` (
  `IDOCCUPE` int NOT NULL AUTO_INCREMENT,
  `IDMOTIF` int NOT NULL,
  `IDRDV` int DEFAULT NULL,
  `IDEMPLOYE` int NOT NULL,
  `TIMESTAMP_DEBUT` datetime NOT NULL,
  `TIMESTAMP_FIN` datetime NOT NULL,
  PRIMARY KEY (`IDOCCUPE`),
  KEY `I_FK_CRENEAUOCCUPE_MOTIF` (`IDMOTIF`),
  KEY `I_FK_CRENEAUOCCUPE_RDV` (`IDRDV`),
  KEY `I_FK_CRENEAUOCCUPE_EMPLOYE` (`IDEMPLOYE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

DROP TABLE IF EXISTS `employe`;
CREATE TABLE IF NOT EXISTS `employe` (
  `IDEMPLOYE` int NOT NULL AUTO_INCREMENT,
  `NOM` char(15) NOT NULL,
  `PRENOM` char(15) NOT NULL,
  `POSTE` char(20) NOT NULL,
  `USERNAME` text NOT NULL,
  `PASSWORD` varchar(60) NOT NULL,
  PRIMARY KEY (`IDEMPLOYE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `motif`
--

DROP TABLE IF EXISTS `motif`;
CREATE TABLE IF NOT EXISTS `motif` (
  `IDMOTIF` int NOT NULL AUTO_INCREMENT,
  `NOMMOTIF` char(15) NOT NULL,
  PRIMARY KEY (`IDMOTIF`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `nvclient`
--

DROP TABLE IF EXISTS `nvclient`;
CREATE TABLE IF NOT EXISTS `nvclient` (
  `IDNVCLIENT` int NOT NULL AUTO_INCREMENT,
  `NOM` char(15) NOT NULL,
  `PRENOM` char(15) NOT NULL,
  `DATENAISSANCE` date NOT NULL,
  PRIMARY KEY (`IDNVCLIENT`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pieceafournir`
--

DROP TABLE IF EXISTS `pieceafournir`;
CREATE TABLE IF NOT EXISTS `pieceafournir` (
  `IDPIECE` int NOT NULL AUTO_INCREMENT,
  `NOMPIECE` char(15) NOT NULL,
  PRIMARY KEY (`IDPIECE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `piecemotif`
--

DROP TABLE IF EXISTS `piecemotif`;
CREATE TABLE IF NOT EXISTS `piecemotif` (
  `IDPIECE` int NOT NULL,
  `IDMOTIF` int NOT NULL,
  PRIMARY KEY (`IDPIECE`,`IDMOTIF`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `IDRDV` int NOT NULL AUTO_INCREMENT,
  `IDEMPLOYE` int NOT NULL,
  `IDCLIENT` int DEFAULT NULL,
  `IDNVCLIENT` int DEFAULT NULL,
  `TIMESTAMP_PRISE_RDV` datetime NOT NULL,
  PRIMARY KEY (`IDRDV`),
  KEY `I_FK_RDV_EMPLOYE` (`IDEMPLOYE`),
  KEY `I_FK_RDV_CLIENT` (`IDCLIENT`),
  KEY `I_FK_RDV_NVCLIENT` (`IDNVCLIENT`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
