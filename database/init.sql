-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 08 jan. 2024 à 21:02
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
(1, 5, 'Dupont', 'Jean', '75001 Paris, 123 Rue de la Paix', 'jean.dupont@email.com', 1, 123456789, 'Célibataire', 'Ingénieur', '1985-06-20', '2023-12-14'),
(2, 6, 'Martin', 'Sophie', '75008 Paris, 456 Avenue des Champs-Élysées', 'sophie.martin@email.com', 1, 234567890, 'Marié', 'Professeur', '1990-03-15', '2024-01-02'),
(3, 8, 'Lefevre', 'Pierre', '69001 Lyon, 789 Boulevard Saint-Michel', 'pierre.lefevre@email.com', 1, 345678901, 'Célibataire', 'Médecin', '1982-11-10', '2023-12-21'),
(4, 7, 'Bertrand', 'Isabelle', '13001 Marseille, 234 Rue du Faubourg Saint-Antoine', 'isabelle.bertrand@email.com', 1, 456789012, 'Marié', 'Avocat', '1975-09-25', '2024-01-01'),
(5, 5, 'Leclerc', 'Luc', '33000 Bordeaux, 567 Avenue de la Victoire', 'luc.leclerc@email.com', 1, 567890123, 'Célibataire', 'Architecte', '1995-02-18', '2023-12-28'),
(6, 6, 'Robert', 'Marie', '69002 Lyon, 890 Rue de la République', 'marie.robert@email.com', 1, 678901234, 'Marié', 'Enseignant', '1988-07-08', '2024-01-03'),
(7, 8, 'Simon', 'Claire', '75010 Paris, 123 Boulevard de la Villette', 'claire.simon@email.com', 1, 789012345, 'Célibataire', 'Journaliste', '1993-12-03', '2023-12-17'),
(8, 7, 'Lemoine', 'Thomas', '13008 Marseille, 456 Avenue du Prado', 'thomas.lemoine@email.com', 1, 890123456, 'Marié', 'Ingénieur', '1979-04-26', '2023-12-08'),
(9, 5, 'Durand', 'Julie', '31000 Toulouse, 789 Rue Saint-Sernin', 'julie.durand@email.com', 1, 901234567, 'Célibataire', 'Médecin', '1980-09-14', '2023-12-13'),
(10, 6, 'Fournier', 'Antoine', '59000 Lille, 234 Rue de la Clef', 'antoine.fournier@email.com', 1, 123456789, 'Marié', 'Avocat', '1998-01-30', '2024-01-01'),
(11, 8, 'Girard', 'Emma', '75018 Paris, 567 Rue des Abbesses', 'emma.girard@email.com', 1, 234567890, 'Célibataire', 'Scientifique', '1987-06-07', '2023-12-22'),
(12, 7, 'Moreau', 'Alex', '44000 Nantes, 890 Rue de la Paix', 'alex.moreau@email.com', 1, 345678901, 'Marié', 'Designer', '1992-03-22', '2024-01-05'),
(13, 5, 'Leroy', 'Marine', '69003 Lyon, 123 Avenue des Frères Lumière', 'marine.leroy@email.com', 1, 456789012, 'Célibataire', 'Ingénieur', '1989-11-17', '2023-12-15'),
(14, 6, 'Roux', 'Gabriel', '13006 Marseille, 456 Cours Pierre Puget', 'gabriel.roux@email.com', 1, 567890123, 'Marié', 'Artiste', '1976-08-04', '2023-12-23'),
(15, 8, 'Petit', 'Laura', '75012 Paris, 789 Avenue Daumesnil', 'laura.petit@email.com', 1, 678901234, 'Célibataire', 'Écrivain', '1997-04-29', '2023-12-30'),
(16, 7, 'Roy', 'Hugo', '33000 Bordeaux, 234 Cours de la Marne', 'hugo.roy@email.com', 1, 789012345, 'Marié', 'Consultant', '1974-01-12', '2023-12-10');

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

INSERT INTO `compte` (`NOMCOMPTE`, `AVOIRDECOUVERT`) VALUES
('LIVRET JEUNE', -1),
('COURANT', 0),
('LIVRET A', -1),
('LIVRET B', -1),
('PEL', -1);

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
(7, 'COURANT', '2024-01-08', NULL, 0.00, 300.00),
(8, 'PEL', '2024-01-08', NULL, 0.00, 0.00),
(4, 'COURANT', '2024-01-08', NULL, 60.00, 150.00),
(2, 'LIVRET A', '2024-01-08', NULL, 2000.00, 0.00),
(1, 'COURANT', '2024-01-05', NULL, 485.00, 300.00);

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
('ASSURANCE LOGEMENT'),
('ASSURANCE VOYAGE'),
('PRET BANCAIRE');

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
('ASSURANCE LOGEMENT', 3, '2025-10-03', '2024-01-08', 20.00),
('PRET BANCAIRE', 3, NULL, '2024-01-08', 15.00);

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
(1, 'Musk', 'Melon', 'melon.musk', 'password', 'director'),
(2, 'Dupont', 'Sophie', 'sophie.dupont', 'password', 'agent'),
(9, 'Moreau', 'Thomas', 'thomas.moreau', 'password', 'advisor'),
(8, 'Girard', 'Antoine', 'antoine.girard', 'password', 'advisor'),
(7, 'Lemoine', 'Marie', 'marie.lemoine', 'password', 'advisor'),
(6, 'Fournier', 'Luc', 'luc.fournier', 'password', 'advisor'),
(5, 'Bertrand', 'Isabelle', 'isabelle.bertrand', 'password', 'advisor'),
(4, 'Lefevre', 'Pierre', 'pierre.lefevre', 'password', 'agent'),
(3, 'Cochard', 'Jean', 'jean.martin', 'password', 'agent');

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
(24, 'LIVRET JEUNE', 'Carte d\'identité'),
(25, 'LIVRET A', 'Carte d\'identité'),
(26, 'LIVRET B', 'Carte d\'identité'),
(27, 'PEL', 'Carte d\'identité'),
(28, 'ASSURANCE VOYAGE', 'Carte d\'identité, Bulletins de salaire'),
(23, 'COURANT', 'Carte d\'identité, Bulletins de salaire'),
(29, 'ASSURANCE LOGEMENT', 'Carte d\'identité, Justificatif de domicile'),
(30, 'PRET BANCAIRE', 'Carte d\'identité, Bulletins de salaire');

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
(2, 1, 'COURANT', 230.00, 'credit', '2024-01-05'),
(3, 1, 'COURANT', 60.00, 'debit', '2024-01-07'),
(4, 2, 'LIVRET A', 2000.00, 'credit', '2024-01-08'),
(5, 4, 'COURANT', 60.00, 'credit', '2024-01-08'),
(6, 1, 'COURANT', 315.00, 'credit', '2024-01-08');

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
(41, 5, 5, 29, '2024-01-11 13:30:00', '2024-01-11 14:30:00'),
(40, 7, 4, 23, '2024-01-12 08:30:00', '2024-01-12 09:30:00'),
(45, 8, 7, 23, '2024-01-13 08:30:00', '2024-01-13 09:30:00'),
(43, 6, 6, 24, '2024-01-11 15:00:00', '2024-01-11 16:00:00'),
(46, 7, 8, 27, '2024-01-10 16:30:00', '2024-01-10 17:30:00'),
(39, 8, 3, 30, '2024-01-10 10:00:00', '2024-01-10 11:30:00'),
(38, 6, 2, 25, '2024-01-09 11:30:00', '2024-01-09 12:30:00'),
(37, 5, 1, 23, '2024-01-08 10:30:00', '2024-01-08 11:30:00'),
(47, 9, NULL, 0, '2024-01-12 15:00:00', '2024-01-12 18:00:00'),
(48, 9, NULL, 0, '2024-01-08 12:00:00', '2024-01-08 14:00:00'),
(49, 8, NULL, 0, '2024-01-13 12:30:00', '2024-01-13 18:00:00'),
(50, 8, NULL, 0, '2024-01-09 15:30:00', '2024-01-09 18:00:00');

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
  MODIFY `NUMCLIENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `NUMEMPLOYE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `motif`
--
ALTER TABLE `motif`
  MODIFY `IDMOTIF` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `operation`
--
ALTER TABLE `operation`
  MODIFY `NUMOP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `rdv`
--
ALTER TABLE `rdv`
  MODIFY `NUMRDV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
