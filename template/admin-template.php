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
                    <tr>
                        <td><?= htmlspecialchars($u['nome'] . ' ' . $u['cognome']) ?></td>
                        <td><?= htmlspecialchars($u['email']) ?></td>
                        <td><?= $u['stato'] ?></td>
                        <td>
                            <?php if ($u['stato'] === 'attivo'): ?>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="user_id" value="<?= $u['id_utente'] ?>">
                                    <button name="ban_user">Disattiva</button>
                                </form>
                            <?php else: ?>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="user_id" value="<?= $u['id_utente'] ?>">
                                    <button name="unban_user">Riattiva</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Messaggi gruppo</h2>
            <form method="GET">
                <label>Seleziona gruppo:</label>
                <select name="group_id">
                    <?php foreach ($adminParams['groups'] as $g): ?>
                        <option value="<?= $g['id_gruppo'] ?>"
                            <?= ($adminParams['selectedGroupId'] == $g['id_gruppo']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($g['titolo']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Visualizza</button>
            </form>
            <?php if (empty($adminParams['messages'])): ?>
                <p>Questo gruppo non ha messaggi.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($adminParams['messages'] as $m): ?>
                            <li>
                                <?= $m['data_invio'] ?> -
                                <?= htmlspecialchars($m['nome'] . ' ' . $m['cognome']) ?><br>
                                <?= htmlspecialchars($m['corpo_messaggio']) ?>
                            </li>
                        <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>