-- DEMO  

INSERT INTO utenti (nome, cognome, email, password, ruolo) VALUES
('Amministratore', 'Sistema', 'admin@campushub.it',
'$2y$10$8W9S/K/9oD.W6p3m.S4qOeI2FjC3h3W2zF3f2L2r2zF3f2L2r2zF3', 'admin');

INSERT INTO utenti (nome, cognome, email, password, ruolo) VALUES
('Marco', 'Rossi', 'marco.rossi@studio.unibo.it',
'$2y$10$8W9S/K/9oD.W6p3m.S4qOeI2FjC3h3W2zF3f2L2r2zF3f2L2r2zF3', 'user');

INSERT INTO gruppi (titolo, corso, descrizione, tipo, luogo_incontro, orario_incontro, membri_max, id_creatore) VALUES
('Analisi Matematica I', 'Ingegneria', 'Prepariamo il parziale di Dicembre',
 'Studio', 'Aula Studio 4', 'Ogni Martedì 14:00', 6, 2);

INSERT INTO iscrizioni (id_utente, id_gruppo) VALUES
(2, 1);