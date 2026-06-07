<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Admin</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/admin-dashboard.css">
</head>
<body>
    <?php include 'layout/header.php'; ?>
    <main>
        <h1>Gestione piattaforma</h1>
        <section class="statistiche">
            <h2 class="gradient-text">Statistiche</h2>
            <ul>
                <li>Gruppi creati: <span id="totale-gruppi"><?php echo $adminParams['stats']['totale_gruppi'] ?></span></li>
                <li>Studenti registrati: <span id="totale-studenti"><?php echo $adminParams['stats']['totale_studenti'] ?></span></li>
                <li>Studenti attivi: <span id="studenti-attivi"><?php echo $adminParams['stats']['studenti_attivi'] ?></span></li>
                <li>Studenti disattivati: <span id="studenti-disattivati"><?php echo $adminParams['stats']['studenti_disattivati'] ?></span></li>
                <li>Messaggi totali: <span id="totale-messaggi"><?php echo $adminParams['stats']['totale_messaggi'] ?></span></li>
            </ul>
        </section>

        <section class="gruppi">
            <h2 class="gradient-text">Gruppi</h2>
            <ul>
                <?php foreach ($adminParams['groups'] as $g): ?>
                    <li>
                        <strong><?= htmlspecialchars($g['titolo']) ?></strong><br>
                        Tipo: <?= $g['tipo'] ?><br>
                        Corso: <?= htmlspecialchars($g['corso']) ?><br>
                        Creatore: <?= htmlspecialchars($g['creatore']) ?><br>
                        Partecipanti: <?= $g['partecipanti'] ?><br>
                        Messaggi inviati: <?= $g['messaggi'] ?><br>
                        <a href="group-details.php?id=<?= $g['id_gruppo'] ?>">Visualizza dettagli</a>             
                   </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <div class="sezione-web">
            <section class="studenti">
                <h2 class="gradient-text">Studenti</h2>
                <ul>
                    <?php foreach ($adminParams['users'] as $u): ?>
                    <li id="user-<?= $u['id_utente'] ?>">
                        <div>
                            <p><?= htmlspecialchars($u['nome'] . ' ' . $u['cognome']) ?></p>
                            <p><?= htmlspecialchars($u['email']) ?></p>
                            <p class="stato <?= htmlspecialchars($u['stato']) ?>"><?= $u['stato'] ?></p>
                        </div>
                        
                        <?php if ($u['stato'] === 'attivo'): ?>
                            <div class="azioni">
                                <button class="ban btn btn-primary" type="button" onclick="banUser(<?= $u['id_utente'] ?>)">Disattiva</button>
                            </div>
                        <?php else: ?>
                            <div class="azioni">
                                <button class="unban btn btn-primary" type="button" onclick="unbanUser(<?= $u['id_utente'] ?>)">Riattiva</button>
                            </div>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </section>

            <section class="messaggi">
                <h2 class="gradient-text">Messaggi gruppo</h2>
                <div class="selezione-gruppo">
                    <label>Seleziona gruppo:</label>
                    <select id="groupSelect">
                        <?php foreach ($adminParams['groups'] as $g): ?>
                            <option value="<?= $g['id_gruppo'] ?>">
                                <?= htmlspecialchars($g['titolo']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button class=" visualizza-messaggi btn btn-primary" type="button" onclick="loadMessages()">Visualizza</button>
                </div>

                <div id="messages-container">
                    <p>Seleziona un gruppo per vedere i messaggi</p>
                </div>
            </section>
        </div>
    </main>
    <?php include 'layout/footer.php'; ?>
    <script src="../js/admin/user-actions.js"></script>
    <script src="../js/admin/group-messages.js"></script>
    <script src="../js/admin/stats.js"></script>
</body>
</html>