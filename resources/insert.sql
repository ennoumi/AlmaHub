USE almahub;

INSERT INTO utenti (id_utente, nome, cognome, email, password, ruolo, stato) VALUES
(1, 'Marco', 'Rossi', 'admin@almahub.it', '$2y$10$abcdefghijklmnopqrstuvwxAdminHashExample12345', 'admin', 'attivo'),
(2, 'Sofia', 'Bianchi', 'sofia.bianchi@studio.unibo.it', '$2y$10$abcdefghijklmnopqrstuvwxUserHashExample12345', 'user', 'attivo'),
(3, 'Alessandro', 'Verdi', 'alessandro.verdi@studio.unibo.it', '$2y$10$abcdefghijklmnopqrstuvwxUserHashExample12345', 'user', 'attivo'),
(4, 'Giulia', 'Ferrari', 'giulia.ferrari@studio.unibo.it', '$2y$10$abcdefghijklmnopqrstuvwxUserHashExample12345', 'user', 'attivo'),
(5, 'Lorenzo', 'Russo', 'lorenzo.russo@studio.unibo.it', '$2y$10$abcdefghijklmnopqrstuvwxUserHashExample12345', 'user', 'attivo'),
(6, 'Emma', 'Gallo', 'emma.gallo@studio.unibo.it', '$2y$10$abcdefghijklmnopqrstuvwxUserHashExample12345', 'user', 'attivo'),
(7, 'Tommaso', 'Costa', 'tommaso.costa@studio.unibo.it', '$2y$10$abcdefghijklmnopqrstuvwxUserHashExample12345', 'user', 'attivo'),
(8, 'Sara', 'Fontana', 'sara.fontana@studio.unibo.it', '$2y$10$abcdefghijklmnopqrstuvwxUserHashExample12345', 'user', 'attivo');


INSERT INTO gruppi (id_gruppo, titolo, corso, descrizione, tipo, luogo_incontro, orario_incontro, membri_max, id_creatore, stato) VALUES
(1, 'Studio Analisi Matematica 1', 'Ingegneria', 'Gruppo dedicato alla preparazione dello scritto e dell\'orale di Analisi 1. Esercizi su limiti, derivate e integrali.', 'Studio', 'Biblioteca di Ingegneria', 'Lunedì e Mercoledì 14:00 - 17:00', 6, 2, 'attivo'),
(2, 'Progetto Web App AlmaHub', 'Informatica', 'Sviluppo dell\'elaborato per il corso di Tecnologie Web. Stack: PHP, MySQL e CSS vanilla.', 'Elaborato', 'Laboratorio Informatico Ranzani', 'Venerdì mattina dalle 09:30', 4, 3, 'attivo'),
(3, 'Ripasso Basi di Dati', 'Informatica', 'Ripasso generale della teoria relazionale, normalizzazione (3NF, BCNF) e scrittura di query SQL complesse.', 'Studio', 'Aula Studio Teatini', 'Martedì 16:00 - 19:00', 6, 4, 'attivo'),
(4, 'Gruppo Studio Fisica Generale', 'Fisica', 'Risoluzione di problemi di Meccanica e Termodinamica in preparazione del primo parziale.', 'Studio', 'Online (Teams)', 'Giovedì 15:00', 8, 5, 'attivo'),
(5, 'Elaborato di Intelligenza Artificiale', 'Data Science', 'Sviluppo del progetto finale incentrato su Machine Learning e Reti Neurali per classificazione immagini.', 'Elaborato', 'Plesso Navile', 'Sabato 10:00 - 13:00', 5, 6, 'attivo'),
(6, 'Preparazione Esame Economia Politica', 'Economia', 'Discussione di microeconomia e macroeconomia. Curve IS-LM e modelli di mercato.', 'Studio', 'Biblioteca di Economia', 'Lunedì 10:00', 6, 7, 'attivo');


INSERT INTO iscrizioni (id_utente, id_gruppo, stato, ruolo) VALUES
(2, 1, 'confermato', 'Fondatore'),
(3, 1, 'confermato', 'Membro'),
(4, 1, 'confermato', 'Membro'),
(5, 1, 'in_attesa', 'Membro'),
(3, 2, 'confermato', 'Fondatore'),
(5, 2, 'confermato', 'Membro'),
(6, 2, 'confermato', 'Membro'),
(4, 3, 'confermato', 'Fondatore'),
(2, 3, 'confermato', 'Membro'),
(7, 3, 'confermato', 'Membro'),
(8, 3, 'in_attesa', 'Membro'),
(5, 4, 'confermato', 'Fondatore'),
(8, 4, 'confermato', 'Membro'),
(3, 4, 'confermato', 'Membro'),
(6, 5, 'confermato', 'Fondatore'),
(4, 5, 'confermato', 'Membro'),
(8, 5, 'confermato', 'Membro'),
(7, 6, 'confermato', 'Fondatore'),
(2, 6, 'confermato', 'Membro'),
(5, 6, 'confermato', 'Membro');


INSERT INTO messaggi (id_utente, id_gruppo, corpo_messaggio) VALUES
(2, 1, 'Ciao a tutti! Grazie per aver accettato l\'iscrizione al gruppo di Analisi.'),
(3, 1, 'Ciao Sofia! Figurati, l\'esame si avvicina e c\'è un sacco da fare.'),
(4, 1, 'Voi a che punto siete con gli studi sugli integrali definiti?'),
(2, 1, 'Io sto trovando qualche difficoltà con le sostituzioni trigonometriche.'),
(3, 1, 'Se volete lunedì in biblioteca possiamo fare una sessione dedicata proprio a quello.'),
(4, 1, 'Ottima idea. Portiamo anche i temi d\'esame degli anni scorsi?'),
(2, 1, 'Sì per favore, il prof mette sempre strutture molto simili.'),
(3, 1, 'Qualcuno ha capito lo studio della convergenza degli integrali impropri?'),
(4, 1, 'Io ho degli schemi riassuntivi fatti bene, ve li giro lunedì di persona.'),
(2, 1, 'Fantastico Giulia! Ci vediamo direttamente in biblioteca allora.');


INSERT INTO messaggi (id_utente, id_gruppo, corpo_messaggio) VALUES
(3, 2, 'Team, ho appena caricato la struttura iniziale del database modificata su Git.'),
(5, 2, 'Grande Ale. Ho controllato le foreign key, mi sembrano collegate bene.'),
(6, 2, 'Io oggi inizio a lavorare sul layout CSS per renderlo totalmente responsive.'),
(3, 2, 'Perfetto Emma. Ricordati di usare Flexbox/Grid solo dove necessario per evitare bug.'),
(5, 2, 'Per le sessioni utente in PHP gestiamo tutto nativamente con session_start()?'),
(3, 2, 'Sì, meglio usare il superglobale $_SESSION accoppiato al controllo di login.'),
(6, 2, 'Ok, allora preparo anche lo stile per la barra di navigazione e il menu mobile.'),
(5, 2, 'Dobbiamo implementare anche la validazione dei dati lato server, giusto?'),
(3, 2, 'Sì, obbligatorio per evitare vulnerabilità SQL Injection. Useremo i prepared statements.'),
(6, 2, 'Ottimo, ci aggiorniamo venerdì mattina in laboratorio per unire i nostri pezzi.');


INSERT INTO messaggi (id_utente, id_gruppo, corpo_messaggio) VALUES
(4, 3, 'Benvenuti nel gruppo di ripasso! Partiamo dai concetti di teoria puri?'),
(2, 3, 'Ciao Giulia. Io farei prima un focus sulla terza forma normale (3NF).'),
(7, 3, 'Concordo, perdo sempre dei pezzi quando devo estrarre le dipendenze funzionali.'),
(4, 3, 'Va bene. Ricordate la regola: ogni attributo deve dipendere solo dalla chiave!'),
(2, 3, 'E per la forma normale di Boyce-Codd invece? Qual è la differenza strutturale?'),
(7, 3, 'In BCNF anche gli attributi primi devono dipendere necessariamente da una superchiave.'),
(4, 3, 'Esatto Tommaso. Facciamo qualche esercizio pratico martedì pomeriggio.'),
(2, 3, 'Perfetto. Qualcuno ha capito bene le Left Join nidificate? Ho dei dubbi.'),
(7, 3, 'Io ho scritto un paio di query di esempio sul PC, ve le mostro ai Teatini.'),
(4, 3, 'Benissimo, portate tutti i laptop carichi così proviamo direttamente.');


INSERT INTO messaggi (id_utente, id_gruppo, corpo_messaggio) VALUES
(5, 4, 'Ciao ragazzi, ci siete tutti per la chiamata Teams di questo giovedì?'),
(8, 4, 'Ciao Lorenzo, sì ci sono! Iniziamo dai problemi di termodinamica?'),
(3, 4, 'Presente. Io ho parecchi problemi con i cicli di Carnot e i calcoli sull\'entropia.'),
(5, 4, 'Va bene, ci concentriamo su quello. Il primo principio è chiaro a tutti?'),
(8, 4, 'Sì, Delta U = Q - W. Quella formula è abbastanza lineare da applicare.'),
(3, 4, 'Il problema sorge quando ci sono trasformazioni adiabatiche irreversibili.'),
(5, 4, 'Lì l\'entropia dell\'universo aumenta sempre, dobbiamo calcolare i singoli ambienti.'),
(8, 4, 'Ho trovato un video tutorial che lo spiega passo passo, dopo vi lascio il link.'),
(3, 4, 'Grazie mille Sara, mi salveresti letteralmente la vita.'),
(5, 4, 'A giovedì allora, studiate gli appunti prima della chiamata così andiamo veloci.');


INSERT INTO messaggi (id_utente, id_gruppo, corpo_messaggio) VALUES
(6, 5, 'Ragazzi per l\'elaborato di IA ho avviato l\'addestramento della prima CNN.'),
(4, 5, 'Che accuratezza hai ottenuto sul dataset di validazione al momento?'),
(8, 5, 'Ciao Emma, hai configurato l\'ottimizzatore Adam o lo Stochastic Gradient Descent?'),
(6, 5, 'Ho preferito usare Adam con learning rate a 0.001. L\'accuratezza è all\'82%.'),
(4, 5, 'Non male come baseline! Però c\'è il rischio latente di overfitting.'),
(8, 5, 'Potremmo implementare dei layer di Dropout a 0.3 per stabilizzare la rete.'),
(6, 5, 'Sì, bella idea. Provo a inserirli tra i layer densi e rilancio subito lo script.'),
(4, 5, 'Per l\'estrazione delle feature visive avete usato filtri 3x3 o 5x5?'),
(8, 5, 'Abbiamo optato per i 3x3 nidificati, richiedono meno parametri computazionali.'),
(6, 5, 'Esatto. Ci vediamo sabato mattina al Navile per scrivere la relazione finale.');


INSERT INTO messaggi (id_utente, id_gruppo, corpo_messaggio) VALUES
(7, 6, 'Aperto il gruppo per l\'esame di Economia. Chi sta capendo la macroeconomia?'),
(2, 6, 'Io sto faticando molto sul modello IS-LM e sulle politiche monetarie.'),
(5, 6, 'Ciao! Se non sbaglio una manovra monetaria espansiva sposta la LM verso destra.'),
(7, 6, 'Esatto Lorenzo, riduce i tassi di interesse reali e aumenta il PIL nel breve.'),
(2, 6, 'E cosa succede invece se ci troviamo in una situazione di trappola della liquidità?'),
(5, 6, 'In quel caso la LM diventa completamente orizzontale, rendendo la moneta inefficace.'),
(7, 6, 'Esatto Sofia, in quella situazione serve la politica fiscale per spostare la IS.'),
(2, 6, 'Ah perfetto, ora che lo visualizzo graficamente ha molto più senso.'),
(5, 6, 'Vogliamo vederci lunedì in biblioteca per fare i grafici dei mercati insieme?'),
(7, 6, 'Sì, ottima idea. Portiamo i fogli millimetrati. Ci vediamo alle 10:00.');