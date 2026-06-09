# AlmaHub

AlmaHub è una web app progettata per studenti universitari che facilita la creazione e la gestione di gruppi di studio e gruppi di progetto.

Gli studenti possono cercare gruppi esistenti, richiedere di partecipare ai gruppi dedicati ai progetti universitari oppure unirsi direttamente ai gruppi di studio aperti. 

## Requisiti
- XAMPP (Apache + MySQL + PHP)
- Browser web (Google Chrome, Firefox, Safari, ...)

## Installazione ed Esecuzione

1. Individuare la cartella `htdocs` di XAMPP, e spostarsi al suo interno.
2. Clonare il repository: 
```
git clone https://github.com/ennoumi/AlmaHub.git
cd AlmaHub
````
3. Avviare XAMPP (controllando che siano attivi Apache e MySQL)
4. Aprire phpMyAdmin 
```
http://localhost/phpmyadmin/
```
5. Inserire il contenuto dei seguenti file SQL per creare il database e popolarlo:
```
resources/database.sql 
resources/insert.sql
```
6. Aprire il browser e accedere a:
```
http://localhost/AlmaHub/public/index.php
```
7. Accedere con le credenziali *admin* mediante:
```
Email: admin@almahub.it
Password: password
````
8. Per accedere da utente utilizzare:
```
Email: mario.rossi@almahub.it
Password: password
```
Oppure registrarsi come nuovo utente e accedere con le proprie credenziali.
---