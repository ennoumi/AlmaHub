<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dettagli Gruppo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/group-details.css">
</head>
<body>

<?php include 'layout/header.php'; ?>
    <?php if(!empty($templateParams["gruppo"])): ?>

        <div class="group-details">
            <p class="tipo"><strong> <?php echo $templateParams["gruppo"]["tipo"]; ?> </strong></p>
            <h1 class="gradient-text"><?php echo $templateParams["gruppo"]["titolo"]; ?></h1>
            <p class="course"><b><?php echo $templateParams["gruppo"]["corso"]; ?></b></p>

            <ul>
                <li><a class="members" href="group-members.php?id=<?php echo $templateParams["gruppo"]["id_gruppo"]; ?>">Partecipanti: <?php echo $templateParams["gruppo"]["numPartecipanti"]; ?> / <?php echo $templateParams["gruppo"]["membri_max"]; ?></a></li>
                <li>Giorni e orario: <?php echo $templateParams["gruppo"]["orario_incontro"]; ?></li>
                <li>Luogo: <?php echo $templateParams["gruppo"]["luogo_incontro"]; ?></li>
            </ul>

            <hr>

            <h2>Descrizione</h2>
            <p><?php echo $templateParams["gruppo"]["descrizione"]; ?></p>
        </div>

        <?php 
            $isSubscribed = $dbh->isUserInGroup($_SESSION['utente']['id_utente'], $idGruppo);
        ?>

        <?php if (!$isSubscribed && !isAdmin()): ?>
            <form id="iscrizione">
                <input type="hidden" name="id_gruppo" value="<?php echo $idGruppo; ?>">
                <button type="submit" class="btn btn-primary join-group" onclick="joinGroup()">PARTECIPA AL GRUPPO</button>
            </form>
        <?php endif; ?>

    <?php else: ?>
        <p>Gruppo non trovato.</p>
    <?php endif; ?>

    <script src="../js/groups/join-group.js"></script>
    <script src="../js/groups/leave-group.js"></script>

    <?php if ($isSubscribed || isAdmin()): ?>
        <div class="chat-container">
            <h3>Chat di Gruppo</h3>
            <div id="chat-box" class="chat-box">
                <?php $messaggi = $dbh->getMessages($idGruppo); ?>
                <?php foreach ($messaggi as $m): ?>
                    <p>
                        <strong><?php echo htmlspecialchars($m['nome'] . " " . $m['cognome']); ?>:</strong> 
                        <?php echo htmlspecialchars($m['corpo_messaggio']); ?>
                    </p>
                <?php endforeach; ?>
            </div>

            <?php if (!isAdmin()): ?>
                <form id="chat-form" class="chat-form">
                    <input type="hidden" name="id_gruppo" value="<?php echo $idGruppo; ?>">
                    <div class="message">
                        <input type="text" name="messaggio" class="message-field" placeholder="Scrivi un messaggio..." required>
                        <button type="submit" class="btn btn-secondary send-message">Invia</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>

        <script src="../js/groups/chat-box.js"></script>

        <script>
            chatBox("<?php echo $_SESSION['utente']['nome'] . ' ' . $_SESSION['utente']['cognome']; ?>");
        </script>

        <?php if (!isAdmin()): ?>
            <form id="disiscrizione">
                <input type="hidden" name="id_gruppo" value="<?php echo $idGruppo; ?>">
                <button type="submit" class="btn btn-primary leave-group" onclick="leaveGroup()">ESCI DAL GRUPPO</button>
            </form>
        <?php endif; ?>
    <?php endif; ?>
        
    <?php include 'layout/footer.php'; ?>
</body>
</html>