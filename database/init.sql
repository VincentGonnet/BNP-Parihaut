-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 23 déc. 2023 à 00:13
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

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

CREATE TABLE `client` (
  `NUMCLIENT` int(11) NOT NULL,
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
  `DATEENREGISTREMENT` date NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`NUMCLIENT`, `NUMEMPLOYE`, `NOM`, `PRENOM`, `ADRESSE`, `MAIL`, `ENREGISTRE`, `NUMTEL`, `SITUATION`, `PROFESSION`, `DATENAISSANCE`, `DATEENREGISTREMENT`) VALUES
(1, 2, 'Musk', 'Melon', '123 Main Street', 'melon.musk@space.x', 1, 123456789, 'Married', 'Business man', '1971-06-28', '2023-12-22'),
(2, 3, 'Johnson', 'Jane', '456 Oak Avenue', 'jane.johnson@example.com', 1, 234567890, 'Married', 'Teacher', '1990-05-15', '2023-12-22'),
(3, 4, 'Williams', 'Emma', '789 Birch Lane', 'emma.williams@example.com', 1, 345678901, 'Divorced', 'Engineer', '1985-08-22', '2023-12-22'),
(4, 5, 'Davis', 'Michael', '987 Pine Avenue', 'michael.davis@example.com', 1, 456789012, 'Single', 'Doctor', '1988-12-10', '2023-12-22'),
(5, 6, 'Miller', 'Olivia', '654 Cedar Street', 'olivia.miller@example.com', 1, 567890123, 'Married', 'Architect', '1982-06-18', '2023-12-22'),
(6, 8, 'Moore', 'Mason', '876 Oak Avenue', 'mason.moore@example.com', 1, 789012345, 'Divorced', 'Lawyer', '1980-11-05', '2023-12-22'),
(7, 12, 'Clark', 'Noah', '654 Birch Lane', 'noah.clark@example.com', 1, 123456789, 'Married', 'Lawyer', '1985-01-05', '2023-12-22'),
(8, 13, 'Davis', 'Sophia', '321 Elm Street', 'sophia.davis@example.com', 1, 234567890, 'Single', 'IT Consultant', '1980-08-28', '2023-12-22'),
(9, 14, 'Evans', 'Ethan', '876 Oak Avenue', 'ethan.evans@example.com', 1, 345678901, 'Divorced', 'IT Consultant', '2000-07-30', '2023-12-22'),
(10, 5, 'Fisher', 'Ava', '543 Pine Avenue', 'ava.fisher@example.com', 1, 456789012, 'Single', 'IT Consultant', '1975-11-02', '2023-12-22'),
(11, 12, 'Clark', 'Noah', '654 Birch Lane', 'noah.clark@example.com', 1, 123456789, 'Married', 'Civil Engineer', '1984-02-28', '2023-12-22'),
(12, 13, 'Davis', 'Sophia', '321 Elm Street', 'sophia.davis@example.com', 1, 234567890, 'Single', 'Data Scientist', '1991-10-20', '2023-12-22'),
(13, 14, 'Evans', 'Ethan', '876 Oak Avenue', 'ethan.evans@example.com', 1, 345678901, 'Divorced', 'Sales Manager', '1986-06-15', '2023-12-22'),
(14, 12, 'Ward', 'Lucas', '321 Elm Street', 'lucas.ward@example.com', 1, 12345678, 'Single', 'Data Analyst', '1992-07-05', '2023-12-22'),
(15, 11, 'Xu', 'Isabella', '876 Oak Avenue', 'isabella.xu@example.com', 1, 123456789, 'Married', 'Data Analyst', '1985-05-25', '2023-12-22'),
(16, 10, 'Yates', 'Liam', '543 Pine Avenue', 'liam.yates@example.com', 1, 234567890, 'Single', 'Civil Engineer', '1994-02-28', '2023-12-22'),
(17, 10, 'Zhang', 'Sophie', '210 Cedar Street', 'sophie.zhang@example.com', 1, 345678901, 'Single', 'Teacher', '1999-09-28', '2023-12-22'),
(18, 5, 'Jackson', 'Avery', '876 Oak Avenue', 'avery.jackson@example.com', 1, 345678901, 'Married', 'HR Specialist', '1994-10-22', '2023-12-22'),
(19, 9, 'Owens', 'Mason', '321 Elm Street', 'mason.owens@example.com', 1, 890123456, 'Single', 'HR Specialist', '1994-12-02', '2023-12-22'),
(20, 3, 'Perez', 'Liam', '876 Oak Avenue', 'liam.perez@example.com', 1, 901234567, 'Divorced', 'Teacher', '1983-09-18', '2023-12-22');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `NOMCOMPTE` char(32) NOT NULL,
  `AVOIRDECOUVERT` int(11) DEFAULT NULL

) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`NOMCOMPTE`) VALUES
('CEL'),
('Courant'),
('PEL'),
('Pro');

-- --------------------------------------------------------

--
-- Structure de la table `compteclient`
--

CREATE TABLE `compteclient` (
  `NUMCLIENT` int(11) NOT NULL,
  `NOMCOMPTE` char(32) NOT NULL,
  `DATEOUVERTURE` date NOT NULL,
  `DATEFERMETURE` date DEFAULT NULL,
  `SOLDE` decimal(10,2) NOT NULL,
  `MONTANTDECOUVERT` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `compteclient`
--

INSERT INTO `compteclient` (`NUMCLIENT`, `NOMCOMPTE`, `DATEOUVERTURE`, `DATEFERMETURE`, `SOLDE`, `MONTANTDECOUVERT`) VALUES
(1, 'Courant', '2004-01-01', NULL, 9999.99, 500.00),
(2, 'Pro', '2018-11-18', NULL, 99.72, 100.00),
(1, 'CEL', '2006-08-10', NULL, 9999.99, 1000.00),
(3, 'PEL', '1998-05-16', NULL, 680.00, 200.00),
(4, 'CEL', '2014-03-25', '2023-11-10', 3570.99, 450.00),
(12, 'Pro', '2018-01-18', NULL, 5499.72, 600.00),
(5, 'Courant', '2015-08-01', NULL, 5861.58, 400.00),
(6, 'Courant', '2018-09-10', NULL, 6321.30, 500.00),
(7, 'CEL', '2017-04-05', NULL, 11200.25, 950.00),
(8, 'Courant', '2019-01-22', NULL, 7512.60, 600.00),
(9, 'PEL', '2016-08-15', NULL, 12800.50, 1100.00),
(10, 'Courant', '2017-11-28', NULL, 6913.40, 550.00),
(11, 'Pro', '2020-04-12', NULL, 14600.20, 1200.00),
(12, 'Courant', '2016-05-20', NULL, 5623.70, 500.00),
(13, 'PEL', '2019-08-02', NULL, 10200.75, 900.00),
(14, 'Courant', '2018-03-15', NULL, 6832.80, 600.00),
(5, 'Pro', '2017-10-28', NULL, 11900.25, 1000.00),
(14, 'PEL', '2017-04-22', NULL, 8200.75, 850.00),
(15, 'Courant', '2018-11-12', NULL, 6723.30, 500.00),
(16, 'PEL', '2019-06-05', NULL, 14200.20, 1150.00),
(17, 'Courant', '2017-09-30', NULL, 5810.40, 400.00),
(18, 'Pro', '2016-03-18', NULL, 9800.15, 750.00),
(19, 'Courant', '2019-01-25', NULL, 7132.60, 550.00),
(20, 'PEL', '2020-05-08', NULL, 12800.50, 1050.00),
(7, 'PEL', '2017-01-28', NULL, 9150.25, 800.00),
(4, 'Courant', '2016-04-03', NULL, 5423.70, 350.00),
(18, 'PEL', '2018-11-19', NULL, 11000.40, 950.00),
(6, 'PEL', '2017-06-15', NULL, 12300.15, 1000.00);

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `NOMCONTRAT` char(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `contrat`
--

INSERT INTO `contrat` (`NOMCONTRAT`) VALUES
('Assurance auto'),
('Assurance sante'),
('Pret');

-- --------------------------------------------------------

--
-- Structure de la table `contratclient`
--

CREATE TABLE `contratclient` (
  `NOMCONTRAT` char(32) NOT NULL,
  `NUMCLIENT` int(11) NOT NULL,
  `DATEFERMETURE` date DEFAULT NULL,
  `DATEOUVERTURECONTRAT` date NOT NULL,
  `TARIFMENSUEL` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `contratclient`
--

INSERT INTO `contratclient` (`NOMCONTRAT`, `NUMCLIENT`, `DATEFERMETURE`, `DATEOUVERTURECONTRAT`, `TARIFMENSUEL`) VALUES
('Assurance auto', 6, NULL, '2020-05-10', 50.00),
('Assurance sante', 10, NULL, '2022-07-20', 30.00),
('Pret', 4, NULL, '2021-09-10', 150.00),
('Pret', 1, NULL, '2023-12-21', 10.00);

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `NUMEMPLOYE` int(11) NOT NULL,
  `NOM` char(15) NOT NULL,
  `PRENOM` char(15) NOT NULL,
  `LOGIN` char(32) NOT NULL,
  `MDP` char(60) NOT NULL,
  `CATEGORIE` char(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`NUMEMPLOYE`, `NOM`, `PRENOM`, `LOGIN`, `MDP`, `CATEGORIE`) VALUES
(1, 'Doe', 'John', 'directeur', 'directeur', 'director'),
(2, 'Smith', 'Alice', 'conseiller1', 'conseiller1', 'advisor'),
(3, 'Johnson', 'Bob', 'conseiller2', 'conseiller2', 'advisor'),
(4, 'Williams', 'Emma', 'conseiller3', 'conseiller3', 'advisor'),
(5, 'Brown', 'Charlie', 'conseiller4', 'conseiller4', 'advisor'),
(6, 'Davis', 'Olivia', 'conseiller5', 'conseiller5', 'advisor'),
(7, 'Miller', 'Ethan', 'conseiller6', 'conseiller6', 'advisor'),
(8, 'Wilson', 'Sophia', 'conseiller7', 'conseiller7', 'advisor'),
(9, 'Moore', 'Mason', 'conseiller8', 'conseiller8', 'advisor'),
(10, 'Jones', 'Ava', 'conseiller9', 'conseiller9', 'advisor'),
(11, 'Anderson', 'Sophia', 'conseiller10', 'conseiller10', 'advisor'),
(12, 'Brown', 'Liam', 'conseiller11', 'conseiller11', 'advisor'),
(13, 'Clark', 'Isabella', 'conseiller12', 'conseiller12', 'advisor'),
(14, 'Davis', 'Noah', 'conseiller13', 'conseiller13', 'advisor'),
(15, 'Evans', 'Emma', 'conseiller14', 'conseiller14', 'advisor'),
(16, 'Fisher', 'Logan', 'agent1', 'agent1', 'agent'),
(17, 'Gomez', 'Ella', 'agent2', 'agent2', 'agent'),
(18, 'Hart', 'Lily', 'agent3', 'agent3', 'agent'),
(19, 'Ingram', 'Noah', 'agent4', 'agent4', 'agent'),
(20, 'Jackson', 'Avery', 'agent5', 'agent5', 'agent'),
(21, 'Keller', 'Mia', 'agent6', 'agent6', 'agent'),
(22, 'Lopez', 'Lucas', 'agent7', 'agent7', 'agent'),
(23, 'Morgan', 'Isaac', 'agent8', 'agent8', 'agent'),
(24, 'Nelson', 'Sophia', 'agent9', 'agent9', 'agent'),
(25, 'Owens', 'Mason', 'agent10', 'agent10', 'agent'),
(26, 'Perez', 'Liam', 'agent11', 'agent11', 'agent'),
(27, 'Quinn', 'Olivia', 'agent12', 'agent12', 'agent'),
(28, 'Reyes', 'Noah', 'agent13', 'agent13', 'agent'),
(29, 'Simmons', 'Ava', 'agent14', 'agent14', 'agent'),
(30, 'Taylor', 'Ethan', 'agent15', 'agent15', 'agent'),
(31, 'Vargas', 'Mia', 'agent16', 'agent16', 'agent'),
(32, 'Ward', 'Lucas', 'agent17', 'agent17', 'agent'),
(33, 'Xu', 'Isabella', 'agent18', 'agent18', 'agent'),
(34, 'Yates', 'Liam', 'agent19', 'agent19', 'agent'),
(35, 'Zhang', 'Sophia', 'agent20', 'agent20', 'agent'),
(36, 'Adams', 'Ella', 'agent21', 'agent21', 'agent'),
(37, 'Barnes', 'Logan', 'agent22', 'agent22', 'agent'),
(38, 'Choi', 'Mason', 'agent23', 'agent23', 'agent'),
(39, 'Diaz', 'Olivia', 'agent24', 'agent24', 'agent'),
(40, 'Ellis', 'Noah', 'agent25', 'agent25', 'agent'),
(41, 'Fisher', 'Ava', 'agent26', 'agent26', 'agent'),
(42, 'Gomez', 'Isaac', 'agent27', 'agent27', 'agent'),
(43, 'Hart', 'Sophie', 'agent28', 'agent28', 'agent'),
(44, 'Ingram', 'Mason', 'agent29', 'agent29', 'agent'),
(45, 'Jackson', 'Ella', 'agent30', 'agent30', 'agent'),
(46, 'Valjean', 'Jean', 'agent0', 'agent0', 'advisor');

-- --------------------------------------------------------

--
-- Structure de la table `motif`
--

CREATE TABLE `motif` (
  `IDMOTIF` int(11) NOT NULL,
  `LIBELLEMOTIF` char(50) NOT NULL,
  `LISTEPIECES` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `motif`
--

INSERT INTO `motif` (`IDMOTIF`, `LIBELLEMOTIF`, `LISTEPIECES`) VALUES
(1, 'Ouverture compte courant', 'Carte d\'identité'),
(2, 'PEL', 'JUSTIFICATIF DE DOMICILE, CARTE D\'IDENTITÉ');

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

CREATE TABLE `operation` (
  `NUMOP` int(11) NOT NULL,
  `NUMCLIENT` int(11) NOT NULL,
  `NOMCOMPTE` char(32) NOT NULL,
  `MONTANT` decimal(10,2) NOT NULL,
  `TYPEOP` char(15) NOT NULL,
  `DATEOP` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `operation`
--

INSERT INTO `operation` (`NUMOP`, `NUMCLIENT`, `NOMCOMPTE`, `MONTANT`, `TYPEOP`, `DATEOP`) VALUES
(1, 1, 'Courant', 500.00, 'ajout', '2023-12-22');

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

CREATE TABLE `rdv` (
  `NUMRDV` int(11) NOT NULL,
  `NUMEMPLOYE` int(11) NOT NULL,
  `NUMCLIENT` int(11) DEFAULT NULL,
  `IDMOTIF` int(11) NOT NULL,
  `DATERDV` datetime NOT NULL,
  `DATEFINRDV` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `rdv`
--

INSERT INTO `rdv` (`NUMRDV`, `NUMEMPLOYE`, `NUMCLIENT`, `IDMOTIF`, `DATERDV`, `DATEFINRDV`) VALUES
(23, 2, 1, 1, '2023-12-21 09:30:00', '2023-12-21 12:00:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`NUMCLIENT`),
  ADD KEY `I_FK_CLIENT_EMPLOYE` (`NUMEMPLOYE`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`NOMCOMPTE`);

--
-- Index pour la table `compteclient`
--
ALTER TABLE `compteclient`
  ADD PRIMARY KEY (`NUMCLIENT`,`NOMCOMPTE`),
  ADD KEY `I_FK_COMPTECLIENT_CLIENT` (`NUMCLIENT`),
  ADD KEY `I_FK_COMPTECLIENT_COMPTE` (`NOMCOMPTE`);

--
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`NOMCONTRAT`);

--
-- Index pour la table `contratclient`
--
ALTER TABLE `contratclient`
  ADD PRIMARY KEY (`NOMCONTRAT`,`NUMCLIENT`),
  ADD KEY `I_FK_CONTRATCLIENT_CONTRAT` (`NOMCONTRAT`),
  ADD KEY `I_FK_CONTRATCLIENT_CLIENT` (`NUMCLIENT`);

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`NUMEMPLOYE`);

--
-- Index pour la table `motif`
--
ALTER TABLE `motif`
  ADD PRIMARY KEY (`IDMOTIF`);

--
-- Index pour la table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`NUMOP`),
  ADD KEY `I_FK_OPERATION_CLIENT` (`NUMCLIENT`),
  ADD KEY `I_FK_OPERATION_COMPTE` (`NOMCOMPTE`);

--
-- Index pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD PRIMARY KEY (`NUMRDV`),
  ADD KEY `I_FK_RDV_EMPLOYE` (`NUMEMPLOYE`),
  ADD KEY `I_FK_RDV_CLIENT` (`NUMCLIENT`),
  ADD KEY `I_FK_RDV_MOTIF` (`IDMOTIF`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `NUMCLIENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `NUMEMPLOYE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `motif`
--
ALTER TABLE `motif`
  MODIFY `IDMOTIF` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `operation`
--
ALTER TABLE `operation`
  MODIFY `NUMOP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `rdv`
--
ALTER TABLE `rdv`
  MODIFY `NUMRDV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
