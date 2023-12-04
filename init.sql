DROP TABLE  IF EXISTS CreneauOccupe;
DROP TABLE  IF EXISTS Rdv;
DROP TABLE  IF EXISTS PieceFourni;
DROP TABLE  IF EXISTS Motif;
DROP TABLE  IF EXISTS NouveauClient;
DROP TABLE  IF EXISTS Compte;
DROP TABLE  IF EXISTS Contrat;
DROP TABLE  IF EXISTS Client;
DROP TABLE  IF EXISTS Employe;

/*------------------Initialisation des tables;

-- employe*/
CREATE TABLE Employe (
	idEmploye 	INT(5) 	NOT NULL		AUTO_INCREMENT,
	nom 		VARCHAR(15)	NOT NULL,
	prenom		VARCHAR(15)	NOT NULL,
	poste		VARCHAR(15)	NOT NULL,
	PRIMARY KEY (idEmploye)
		
		);
/*--client*/
CREATE TABLE Client (
	idClient	INT(7)		NOT NULL	AUTO_INCREMENT,
	nom		VARCHAR(15)	NOT NULL,
	prenom		VARCHAR(15)	NOT NULL,
	dateNaissance	DATE		NOT NULL,
	profession	VARCHAR(32)	NOT NULL,
	situationFamiliale VARCHAR(32)	NOT NULL,
	numTelephone 	INT(15)		NOT NULL,
	mail		VARCHAR(64)	NOT NULL,
	idEmploye 	INT(5),
	dateOuverture	DATE 		NOT NULL,
	dateFin		DATE		NOT NULL,
	PRIMARY KEY (idClient,numTelephone,mail),
	FOREIGN KEY (idEmploye) REFERENCES Employe(idEmploye)
	
	);
	
/*--contrat*/
CREATE TABLE Contrat (
	idContrat 	INT(7)		NOT NULL	AUTO_INCREMENT,
	idClient 	INT(7),
	nom		VARCHAR(15)	NOT NULL,
	tarifMensuel 	DECIMAL(8,2)	NOT NULL,
	dateOuverture 	DATE		NOT NULL,
	dateFin		DATE		NOT NULL,
	actif 		BOOLEAN		NOT NULL,
	PRIMARY KEY (idContrat),
	FOREIGN KEY (idClient) REFERENCES Client(idClient)
	
		);
		
/*--Compte*/
CREATE TABLE Compte (
	idCompte 	INT(7)		NOT NULL	AUTO_INCREMENT,
	idClient	INT(7)	,
	nom		VARCHAR(15)	NOT NULL,
	solde		DECIMAL(9,2)	NOT NULL,
	decouvert	DECIMAL(6,2)	NOT NULL,
	dateOuverture	DATE		NOT NULL,
	dateFin		DATE		NOT NULL,
	actif		BOOLEAN		NOT NULL,
	PRIMARY KEY (idCompte),
	FOREIGN KEY (idClient) REFERENCES Client(idClient)
	
		);
		
/*--NouveauClient*/
CREATE TABLE NouveauClient (
	idNouveauClient INT(7)		NOT NULL	AUTO_INCREMENT,
	nom		VARCHAR(15)	NOT NULL,
	prenom		VARCHAR(15)	NOT NULL,
	dateNaissance 	DATE		NOT NULL,
	PRIMARY KEY (idNouveauClient) 
	
		);
	
/*--Motif*/
CREATE TABLE Motif (
	idMotif 	INT(7)		NOT NULL	AUTO_INCREMENT,
	nomMotif	VARCHAR(32)	NOT NULL,
	PRIMARY KEY (idMotif)
		
		);
/*--Rdv*/
CREATE TABLE Rdv (
	idRdv 		INT(7)		NOT NULL 	AUTO_INCREMENT,
	idClient	INT(7),
	idMotif 	INT(7),
	idEmploye	INT(7),
	idNouveauClient INT(7),
	heureRdv	TIMESTAMP	NOT NULL,
	PRIMARY KEY (idRdv),
	FOREIGN KEY (idClient) REFERENCES Client(idClient),
	FOREIGN KEY (idMotif) REFERENCES Motif(idMotif),
	FOREIGN KEY (idEmploye) REFERENCES Employe(idEmploye),
	FOREIGN KEY (idNouveauClient) REFERENCES NouveauClient(idNouveauClient)
	
		);
		
/*--PieceFourni*/
CREATE TABLE PieceFourni (
	idPiece		INT(7)		NOT NULL	AUTO_INCREMENT,
	nomPiece	VARCHAR(32)	NOT NULL,
	idMotif		INT(7),
	PRIMARY KEY (idPiece),
	FOREIGN KEY (idMotif) REFERENCES Motif(idMotif)
	
		);
	
/*--CreneauOccupe*/
CREATE TABLE CreneauOccupe (
	idOccupe	INT(7)		NOT NULL AUTO_INCREMENT,
	idEmploye	INT(7),
	idRdv		INT(7),
	debut		TIMESTAMP	NOT NULL,
	fin		TIMESTAMP	NOT NULL,
	PRIMARY KEY (idOccupe),
	FOREIGN KEY (idEmploye) REFERENCES Employe(idEmploye),
	FOREIGN KEY (idRdv) REFERENCES Rdv(idRdv)
		
		);
	
//* ----Insertion 
--  Dans Employe*/
INSERT INTO	Employe (nom,prenom,poste)	VALUES	('Smith', 'John', 'Manager');
INSERT INTO	Employe (nom,prenom,poste)	VALUES	('Johnson', 'Emily', 'Développeur');

/*--Dans Client*/
INSERT INTO	Client 	(nom, prenom, dateNaissance, profession, situationFamiliale, numTelephone, mail, idEmploye, dateOuverture, dateFin) VALUES    ('Dupont', 'Alice', '1990-03-15', 'Ingénieur', 'Célibataire', '123456789', 'alice.dupont@example.com', 1, '2023-01-01', '2023-12-31');
INSERT INTO	Client 	(nom, prenom, dateNaissance, profession, situationFamiliale, numTelephone, mail, idEmploye, dateOuverture, dateFin) VALUES    ('Martin', 'Bob', '1985-07-20', 'Enseignant', 'Marié', '987654321', 'bob.martin@example.com', 2, '2022-12-01', '2023-11-30');
INSERT INTO	Client 	(nom, prenom, dateNaissance, profession, situationFamiliale, numTelephone, mail, idEmploye, dateOuverture, dateFin) VALUES    ('Smith', 'Emma', '1992-09-05', 'Docteur', 'Célibataire', '456789012', 'emma.smith@example.com', 1, '2023-02-15', '2023-10-31');
INSERT INTO	Client 	(nom, prenom, dateNaissance, profession, situationFamiliale, numTelephone, mail, idEmploye, dateOuverture, dateFin) VALUES    ('Johnson', 'Charlie', '1988-11-12', 'Avocat', 'Marié', '345678901', 'charlie.johnson@example.com', 2, '2023-03-01', '2023-09-30');
INSERT INTO	Client 	(nom, prenom, dateNaissance, profession, situationFamiliale, numTelephone, mail, idEmploye, dateOuverture, dateFin) VALUES    ('Williams', 'Sophie', '1995-04-08', 'Designer', 'Célibataire', '567890123', 'sophie.williams@example.com', 2, '2023-04-15', '2023-08-31');
INSERT INTO	Client 	(nom, prenom, dateNaissance, profession, situationFamiliale, numTelephone, mail, idEmploye, dateOuverture, dateFin) VALUES    ('Davis', 'Oliver', '1980-12-30', 'Chef de projet', 'Marié', '234567890', 'oliver.davis@example.com', 1, '2023-05-01', '2023-07-31');
INSERT INTO	Client 	(nom, prenom, dateNaissance, profession, situationFamiliale, numTelephone, mail, idEmploye, dateOuverture, dateFin) VALUES    ('Jones', 'Ava', '1998-06-25', 'Infirmière', 'Célibataire', '678901234', 'ava.jones@example.com', 1, '2023-06-15', '2023-06-30');
INSERT INTO	Client 	(nom, prenom, dateNaissance, profession, situationFamiliale, numTelephone, mail, idEmploye, dateOuverture, dateFin) VALUES    ('Brown', 'Mia', '1993-02-18', 'Architecte', 'Marié', '890123456', 'mia.brown@example.com', 2, '2023-07-01', '2023-06-30');
INSERT INTO	Client 	(nom, prenom, dateNaissance, profession, situationFamiliale, numTelephone, mail, idEmploye, dateOuverture, dateFin) VALUES    ('Garcia', 'Liam', '1984-08-03', 'Analyste financier', 'Célibataire', '012345678', 'liam.garcia@example.com', 1, '2023-08-15', '2023-06-30');
INSERT INTO	Client 	(nom, prenom, dateNaissance, profession, situationFamiliale, numTelephone, mail, idEmploye, dateOuverture, dateFin) VALUES    ('Rodriguez', 'Ella', '1991-10-28', 'Photographe', 'Marié', '123456789', 'ella.rodriguez@example.com', 1, '2023-09-01', '2023-06-30');



/*-- Dans NOuveauClient*/
INSERT INTO	NouveauClient 	(nom, prenom, dateNaissance) VALUES  ('Doe', 'Jane', '1995-05-10');
INSERT INTO	NouveauClient 	(nom, prenom, dateNaissance) VALUES  ('Williams', 'David', '1988-11-25');

