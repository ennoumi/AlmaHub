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

<?php include 'layout/header.php'; ?>

    <p><a href="dashboard.php">← Torna indietro</a></p>

    <?php if(!empty($templateParams["gruppo"])): ?>
        
        <p><strong>[ <?php echo $templateParams["gruppo"]["tipo"]; ?> ]</strong></p>
        <h1><?php echo $templateParams["gruppo"]["titolo"]; ?></h1>
        <p><i>Corso: <?php echo $templateParams["gruppo"]["corso"]; ?></i></p>

        <ul>
            <li><a href="group-members.php?id=<?php echo $templateParams["gruppo"]["id_gruppo"]; ?>">Partecipanti: <?php echo $templateParams["gruppo"]["numPartecipanti"]; ?> / <?php echo $templateParams["gruppo"]["membri_max"]; ?></a></li>
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
                <button type="submit" onclick="joinGroup()">PARTECIPA AL GRUPPO</button>
            </form>
        <?php else: ?>
            <p>Sei membro di questo gruppo</p>
            <form id="disiscrizione">
                <input type="hidden" name="id_gruppo" value="<?php echo $idGruppo; ?>">
                <button type="submit" onclick="leaveGroup()">ESCI DAL GRUPPO</button>
            </form>
        <?php endif; ?>

    <?php else: ?>
        <p>Gruppo non trovato.</p>
    <?php endif; ?>

    <script src="../js/groups/join-group.js"></script>
    <script src="../js/groups/leave-group.js"></script>

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

        <script src="../js/groups/chat-box.js"></script>

        // Attivazione manuale dello script senza onclick
        // per permettere l'invio del messaggio tramite pressione del tasto invio
        <script>
            chatBox("<?php echo $_SESSION['utente']['nome'] . ' ' . $_SESSION['utente']['cognome']; ?>");
        </script>

        <?php else: ?>
        <p>Solo i membri di questo gruppo possono visualizzare la chat e inviare messaggi.</p>
    <?php endif; ?>
        
    <?php include 'layout/footer.php'; ?>
</body>
</html>