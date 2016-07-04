
CREATE DATABASE IF NOT EXISTS utenti;
USE utenti;

CREATE TABLE IF NOT EXISTS ruoli (  
	RuoloID INT UNSIGNED AUTO_INCREMENT,
	Descrizione VARCHAR(50) NOT NULL,
	PRIMARY KEY(RuoloID)
);
ALTER TABLE ruoli ADD UNIQUE(Descrizione);

CREATE TABLE IF NOT EXISTS utenti (
	UtenteID INT UNSIGNED AUTO_INCREMENT,
	Creato DATETIME NOT NULL,
	Modificato DATETIME,
	RuoloID INT UNSIGNED NOT NULL,
	NomeUtente VARCHAR(255) NOT NULL,
	Nome VARCHAR(100),
	Cognome VARCHAR(100),
	Email VARCHAR(255),
	Abilitato TINYINT(1),
	PRIMARY KEY(UtenteID),
	UNIQUE(NomeUtente),
	INDEX(Nome),
	INDEX(Cognome),
	FOREIGN KEY(RuoloID) REFERENCES ruoli(RuoloID)
);

CREATE TABLE IF NOT EXISTS posts (
	PostID INT UNSIGNED AUTO_INCREMENT,
	Creato DATETIME NOT NULL,
	Modificato DATETIME,
	UtenteID INT UNSIGNED NOT NULL,
	Titolo VARCHAR(255) NOT NULL,
	Contenuto TEXT,
	PRIMARY KEY(PostID)
);
ALTER TABLE posts ADD FOREIGN KEY(UtenteID) REFERENCES utenti(UtenteID);