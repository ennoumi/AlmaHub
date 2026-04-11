<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Admin</title>
</head>
<body>
    <main>
        <header>
            <h1>Gestione della piattaforma</h1>
            <p>
                <a href="../public/dashboard.php">Dashboard</a> | <a href="../public/logout.php">Logout</a>
            </p>
        </header>

        <section>
            <h2>Statistiche</h2>
            <ul>
                <li>Gruppi creati: <?= $adminParams['stats']['totale_gruppi'] ?></li>
                <li>Studenti registrati: <?= $adminParams['stats']['totale_studenti'] ?></li>
                <li>Studenti attivi: <?= $adminParams['stats']['studenti_attivi'] ?></li>
                <li>Studenti disattivati: <?= $adminParams['stats']['studenti_disattivati'] ?></li>
                <li>Messaggi totali: <?= $adminParams['stats']['totale_messaggi'] ?></li>
            </ul>
        </section>

        <section>
            <h2>Gruppi</h2>
            <ul>
                <?php foreach ($adminParams['groups'] as $g): ?>
                    <li>
                        <strong><?= htmlspecialchars($g['titolo']) ?></strong><br>
                        Tipo: <?= $g['tipo'] ?><br>
                        Corso: <?= htmlspecialchars($g['corso']) ?><br>
                        Creatore: <?= htmlspecialchars($g['creatore']) ?><br>
                        Partecipanti: <?= $g['partecipanti'] ?><br>
                        Messaggi inviati: <?= $g['messaggi'] ?><br>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section>
            <h2>Studenti</h2>
            <table>
                <thead>
                    <tr>
                        <th>Studente</th>
                        <th>Email</th>
                        <th>Stato</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($adminParams['users'] as $u): ?>
                    <tr id="user-<?= $u['id_utente'] ?>">
                        <td><?= htmlspecialchars($u['nome'] . ' ' . $u['cognome']) ?></td>
                        <td><?= htmlspecialchars($u['email']) ?></td>
                        <td class="stato"><?= $u['stato'] ?></td>
                        <td class="azioni">
                            <?php if ($u['stato'] === 'attivo'): ?>
                                <button type="button" onclick="banUser(<?= $u['id_utente'] ?>)">Disattiva</button>
                            <?php else: ?>
                                <button type="button" onclick="unbanUser(<?= $u['id_utente'] ?>)">Riattiva</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Messaggi gruppo</h2>
            <div>
                <label>Seleziona gruppo:</label>
                <select id="groupSelect">
                    <?php foreach ($adminParams['groups'] as $g): ?>
                        <option value="<?= $g['id_gruppo'] ?>">
                            <?= htmlspecialchars($g['titolo']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="button" onclick="loadMessages()">Visualizza</button>
            </div>

            <div id="messages-container">
                <p>Seleziona un gruppo per vedere i messaggi</p>
            </div>
        </section>
    </main>
    <script src="../js/admin/user-actions.js"></script>
</body>
</html>