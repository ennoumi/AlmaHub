<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettagli Gruppo - Admin</title>
</head>
<body>
<main>
    <header>
        <h1><?php echo $templateParams['group']['titolo']; ?></h1>
        <p><a href="admin.php">&larr; Torna alla Dashboard Admin</a></p>
        <p>Corso: <?php echo $templateParams['group']['corso']; ?></p>
        <p>Tipo: <?php echo $templateParams['group']['tipo']; ?></p>
        <p>Creatore: <?php echo isset($templateParams['group']['creatore']) ? $templateParams['group']['creatore'] : 'N/A'; ?></p>
        <p>Partecipanti: <?php echo count($templateParams['members']); ?> / <?php echo $templateParams['group']['membri_max']; ?></p>
        <p>Data creazione: <?php echo isset($templateParams['group']['data_creazione']) ? $templateParams['group']['data_creazione'] : 'N/A'; ?></p>
    </header>

    <section>
        <h2>Descrizione</h2>
        <p><?php echo isset($templateParams['group']['descrizione']) ? $templateParams['group']['descrizione'] : 'Nessuna descrizione'; ?></p>
        <p>Luogo: <?php echo isset($templateParams['group']['luogo_incontro']) ? $templateParams['group']['luogo_incontro'] : 'N/A'; ?></p>
        <p>Orario: <?php echo isset($templateParams['group']['orario_incontro']) ? $templateParams['group']['orario_incontro'] : 'N/A'; ?></p>
    </section>

    <section>
        <h2>Membri del Gruppo</h2>
        <?php if (!empty($templateParams['members'])): ?>
            <ul>
                <?php foreach ($templateParams['members'] as $m): ?>
                    <li><?php echo $m['nome'] . ' ' . $m['cognome']; ?> (<?php echo $m['email']; ?>) - Ruolo: <?php echo $m['ruolo']; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nessun membro iscritto.</p>
        <?php endif; ?>
    </section>

    <section>
        <h2>Messaggi del Gruppo</h2>
        <?php if (!empty($templateParams['messages'])): ?>
            <ul>
                <?php foreach ($templateParams['messages'] as $msg): ?>
                    <li><strong><?php echo $msg['nome'] . ' ' . $msg['cognome']; ?>:</strong> <?php echo $msg['corpo_messaggio']; ?> (<?php echo $msg['data_invio']; ?>)</li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nessun messaggio inviato.</p>
        <?php endif; ?>
    </section>
</main>
</body>
</html>