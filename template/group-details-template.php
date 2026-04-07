<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <style>
        .chat-box {
            height: 300px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 20px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }

        .chat-box p {
            margin: 5px 0;
            padding: 5px;
            border-bottom: 1px solid #eee;
        }

        .chat-box strong {
            color: #007bff;
        }
    </style>
    <title>Dettagli Gruppo</title>
</head>
<body>

    <p><a href="dashboard.php">← Torna indietro</a></p>

    <?php if(!empty($templateParams["gruppo"])): ?>
        
        <p><strong>[ <?php echo $templateParams["gruppo"]["tipo"]; ?> ]</strong></p>
        <h1><?php echo $templateParams["gruppo"]["titolo"]; ?></h1>
        <p><i>Corso: <?php echo $templateParams["gruppo"]["corso"]; ?></i></p>

        <ul>
            <li>Partecipanti: <?php echo $templateParams["gruppo"]["numPartecipanti"]; ?> / <?php echo $templateParams["gruppo"]["membri_max"]; ?></li>
            <li>Data: <?php echo $templateParams["gruppo"]["data_creazione"]; ?></li>
            <li>Luogo: <?php echo $templateParams["gruppo"]["luogo_incontro"]; ?></li>
        </ul>

        <hr>

        <h2>Descrizione</h2>
        <p><?php echo $templateParams["gruppo"]["descrizione"]; ?></p>

        <?php 
            $isSubscribed = $dbh->isUserInGroup($_SESSION['utente']['id_utente'], $idGruppo);
        ?>

        <?php if (!$isSubscribed): ?>
            <form id="iscrizione">
                <input type="hidden" name="id_gruppo" value="<?php echo $idGruppo; ?>">
                <button type="submit">PARTECIPA AL GRUPPO</button>
            </form>
        <?php endif; ?>

    <?php else: ?>
        <p>Gruppo non trovato.</p>
    <?php endif; ?>

    <script>
    document.getElementById('iscrizione').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('process-join.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.risultato === 0) {
                alert("Iscrizione avvenuta con successo!");
                location.reload(); // Ricarica per aggiornare il numero di iscritti
            } else if (data.risultato === 1) {
                alert("Il gruppo è pieno.");
            } else if (data.risultato === 2) {
                alert("Sei già iscritto a questo gruppo.");
            } else {
                alert("Errore durante l'iscrizione.");
            }
        })
        .catch(error => alert("Errore di connessione."));
    });
    </script>

    <h3>Chat di Gruppo</h3>
    <?php if ($isSubscribed): ?>
        <div>
            <div id="chat-box" class="chat-box">
                <?php $messaggi = $dbh->getMessages($idGruppo); ?>
                <?php foreach ($messaggi as $m): ?>
                    <p>
                        <strong><?php echo htmlspecialchars($m['nome'] . " " . $m['cognome']); ?>:</strong> 
                        <?php echo htmlspecialchars($m['corpo_messaggio']); ?>
                    </p>
                <?php endforeach; ?>
            </div>

            <form id="chat-form">
                <input type="hidden" name="id_gruppo" value="<?php echo $idGruppo; ?>">
                <input type="text" name="messaggio" placeholder="Scrivi un messaggio..." required>
                <button type="submit">Invia</button>
            </form>
        </div>

        <script>
            const nomeUtenteLoggato = "<?php echo $_SESSION['utente']['nome'] . ' ' . $_SESSION['utente']['cognome']; ?>";
            const chatBox = document.getElementById('chat-box');
            const chatForm = document.getElementById('chat-form');

            chatBox.scrollTop = chatBox.scrollHeight; // Scorre in basso la chat

            chatForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                fetch('process-chat.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const p = document.createElement('p');
                        p.innerHTML = `<strong>${nomeUtenteLoggato}:</strong> ${formData.get('messaggio')}`;
                        chatBox.appendChild(p); // Aggiunge il messaggio alla chat
                        this.reset(); // Svuota il form del messaggio
                        chatBox.scrollTop = chatBox.scrollHeight; // Scorre in basso la chat
                    }
                });
            });
        </script>

        <?php else: ?>
        <p>Solo i membri di questo gruppo possono visualizzare la chat e inviare messaggi.</p>
    <?php endif; ?>

</body>
</html>