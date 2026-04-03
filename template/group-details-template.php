<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
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

        <form id="iscrizione">
            <input type="hidden" name="id_gruppo" value="<?php echo $idGruppo; ?>">
            <button type="submit">PARTECIPA AL GRUPPO</button>
        </form>

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

</body>
</html>