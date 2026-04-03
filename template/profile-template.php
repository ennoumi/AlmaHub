<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo utente</title>
</head>
<body>
    <main>
        <h1>Il mio profilo</h1>

        <?php if (!empty($templateParams['errore'])): ?>
            <p style="color: red;"><?php echo htmlspecialchars($templateParams['errore']); ?></p>
        <?php endif; ?>
        <?php if (!empty($templateParams['successo'])): ?>
            <p style="color: green;"><?php echo htmlspecialchars($templateParams['successo']); ?></p>
        <?php endif; ?>

        <section>
            <h2>Dati profilo</h2>
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($utente['nome']); ?></p>
            <p><strong>Cognome:</strong> <?php echo htmlspecialchars($utente['cognome']); ?></p>
            <p><strong>Email attuale:</strong> <?php echo htmlspecialchars($utente['email']); ?></p>
            <p><strong>Ruolo:</strong> <?php echo htmlspecialchars($utente['ruolo']); ?></p>

            <p><a href="dashboard.php">Torna alla dashboard</a></p>
            <p><a href="logout.php">Logout</a></p>
        </section>

        <section>
            <h2>Modifica credenziali</h2>

            <form action="profile.php" method="post">
                <fieldset>
                    <legend>Email</legend>
                    <input type="hidden" name="action" value="update_profile">

                    <label for="email">Nuova email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($utente['email']); ?>" required>

                    <button type="submit">Aggiorna email</button>
                </fieldset>
            </form>
        </section>
    </main>
</body>
</html>