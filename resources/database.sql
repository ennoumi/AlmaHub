DROP DATABASE IF EXISTS almahub;
CREATE DATABASE almahub;
USE almahub;


-- TABELLA UTENTI
CREATE TABLE utenti (
  id_utente INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  cognome VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  ruolo ENUM('user', 'admin') DEFAULT 'user',
  stato ENUM('attivo', 'disattivato') DEFAULT 'attivo',
  data_iscrizione TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- TABELLA GRUPPI
CREATE TABLE gruppi (
  id_gruppo INT AUTO_INCREMENT PRIMARY KEY,
  titolo VARCHAR(150) NOT NULL,
  corso VARCHAR(100) NOT NULL,
  descrizione TEXT,
  tipo ENUM('Studio', 'Elaborato') NOT NULL,
  luogo_incontro VARCHAR(255),
  orario_incontro VARCHAR(100),
  membri_max INT DEFAULT 6,
  id_creatore INT NOT NULL,
  stato ENUM('attivo', 'eliminato') DEFAULT 'attivo',
  data_creazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_creatore) REFERENCES utenti(id_utente) ON DELETE CASCADE
);


-- TABELLA ISCRIZIONI
CREATE TABLE iscrizioni (
  id_iscrizione INT AUTO_INCREMENT PRIMARY KEY,
  id_utente INT NOT NULL,
  id_gruppo INT NOT NULL,
  data_adesione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  stato ENUM('confermato', 'in_attesa') NOT NULL DEFAULT 'in_attesa',
  ruolo ENUM('Fondatore', 'Membro') NOT NULL DEFAULT 'Membro',
  UNIQUE KEY uk_iscrizione (id_utente, id_gruppo),
  FOREIGN KEY (id_utente) REFERENCES utenti(id_utente) ON DELETE CASCADE,
  FOREIGN KEY (id_gruppo) REFERENCES gruppi(id_gruppo) ON DELETE CASCADE
);

-- TABELLA MESSAGGI (CHAT)
CREATE TABLE messaggi (
  id_messaggio INT AUTO_INCREMENT PRIMARY KEY,
  id_utente INT NOT NULL,
  id_gruppo INT NOT NULL,
  corpo_messaggio TEXT NOT NULL,
  data_invio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_utente) REFERENCES utenti(id_utente) ON DELETE CASCADE,
  FOREIGN KEY (id_gruppo) REFERENCES gruppi(id_gruppo) ON DELETE CASCADE
);