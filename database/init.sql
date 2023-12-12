-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 12 déc. 2023 à 15:54
-- Version du serveur : 5.7.40
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `parihaut`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `NUMCLIENT` int(11) NOT NULL AUTO_INCREMENT,
  `NUMEMPLOYE` int(11) NOT NULL,
  `NOM` char(15) NOT NULL,
  `PRENOM` char(15) NOT NULL,
  `ADRESSE` char(100) NOT NULL,
  `MAIL` char(32) DEFAULT NULL,
  `ENREGISTRE` tinyint(1) NOT NULL,
  `NUMTEL` int(11) DEFAULT NULL,
  `SITUATION` char(15) DEFAULT NULL,
  `PROFESSION` char(15) NOT NULL,
  `DATENAISSANCE` date NOT NULL,
  PRIMARY KEY (`NUMCLIENT`),
  KEY `I_FK_CLIENT_EMPLOYE` (`NUMEMPLOYE`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`NUMCLIENT`, `NUMEMPLOYE`, `NOM`, `PRENOM`, `ADRESSE`, `MAIL`, `ENREGISTRE`, `NUMTEL`, `SITUATION`, `PROFESSION`, `DATENAISSANCE`) VALUES
(1, 2, 'Musk', 'Melon', '123 Main Street', 'melon.musk@space.x', 1, 123456789, 'Married', 'Business', '1971-06-28'),
(2, 3, 'Johnson', 'Jane', '456 Oak Avenue', 'jane.johnson@example.com', 1, 234567890, 'Married', 'Teacher', '1990-05-15'),
(3, 4, 'Williams', 'Emma', '789 Birch Lane', 'emma.williams@example.com', 1, 345678901, 'Divorced', 'Engineer', '1985-08-22'),
(4, 5, 'Davis', 'Michael', '987 Pine Avenue', 'michael.davis@example.com', 1, 456789012, 'Single', 'Doctor', '1988-12-10'),
(5, 6, 'Miller', 'Olivia', '654 Cedar Street', 'olivia.miller@example.com', 1, 567890123, 'Married', 'Architect', '1982-06-18'),
(6, 8, 'Moore', 'Mason', '876 Oak Avenue', 'mason.moore@example.com', 1, 789012345, 'Divorced', 'Lawyer', '1980-11-05'),
(7, 12, 'Clark', 'Noah', '654 Birch Lane', 'noah.clark@example.com', 1, 123456789, 'Married', 'Lawyer', '1985-01-05'),
(8, 13, 'Davis', 'Sophia', '321 Elm Street', 'sophia.davis@example.com', 1, 234567890, 'Single', 'IT Consultant', '1980-08-28'),
(9, 14, 'Evans', 'Ethan', '876 Oak Avenue', 'ethan.evans@example.com', 1, 345678901, 'Divorced', 'IT Consultant', '2000-07-30'),
(10, 5, 'Fisher', 'Ava', '543 Pine Avenue', 'ava.fisher@example.com', 1, 456789012, 'Single', 'IT Consultant', '1975-11-02'),
(11, 12, 'Clark', 'Noah', '654 Birch Lane', 'noah.clark@example.com', 1, 123456789, 'Married', 'Civil Engineer', '1984-02-28'),
(12, 13, 'Davis', 'Sophia', '321 Elm Street', 'sophia.davis@example.com', 1, 234567890, 'Single', 'Data Scientist', '1991-10-20'),
(13, 14, 'Evans', 'Ethan', '876 Oak Avenue', 'ethan.evans@example.com', 1, 345678901, 'Divorced', 'Sales Manager', '1986-06-15'),
(14, 12, 'Ward', 'Lucas', '321 Elm Street', 'lucas.ward@example.com', 1, 12345678, 'Single', 'Data Analyst', '1992-07-05'),
(15, 11, 'Xu', 'Isabella', '876 Oak Avenue', 'isabella.xu@example.com', 1, 123456789, 'Married', 'Data Analyst', '1985-05-25'),
(16, 10, 'Yates', 'Liam', '543 Pine Avenue', 'liam.yates@example.com', 1, 234567890, 'Single', 'Civil Engineer', '1994-02-28'),
(17, 10, 'Zhang', 'Sophie', '210 Cedar Street', 'sophie.zhang@example.com', 1, 345678901, 'Single', 'Teacher', '1999-09-28'),
(18, 5, 'Jackson', 'Avery', '876 Oak Avenue', 'avery.jackson@example.com', 1, 345678901, 'Married', 'HR Specialist', '1994-10-22'),
(19, 9, 'Owens', 'Mason', '321 Elm Street', 'mason.owens@example.com', 1, 890123456, 'Single', 'HR Specialist', '1994-12-02'),
(20, 3, 'Perez', 'Liam', '876 Oak Avenue', 'liam.perez@example.com', 1, 901234567, 'Divorced', 'Teacher', '1983-09-18');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
