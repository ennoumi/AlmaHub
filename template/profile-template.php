<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/profile.css">
    <title>Profilo utente</title>

</head>
<body>
    <?php include 'layout/header.php'; ?>
    <main>
        <h1 class="gradient-text"><?php echo $templateParams['isOwner'] ? "Il mio profilo" : "Profilo di " . htmlspecialchars($user['nome'] . ' ' . $user['cognome']) ; ?></h1>

        <?php if (!empty($templateParams['errore'])): ?>
            <p style="color: red;"><?php echo htmlspecialchars($templateParams['errore']); ?></p>
        <?php endif; ?>
        <?php if (!empty($templateParams['successo'])): ?>
            <p style="color: green;"><?php echo htmlspecialchars($templateParams['successo']); ?></p>
        <?php endif; ?>

        <?php if ($templateParams['isOwner']): ?>
            <section>
                <div class="profile-info">
                    <h2>Dati</h2>
                    <p><span class="info-desc">Nome: </span><?php echo htmlspecialchars($utente['nome']); ?></p>
                    <p><span class="info-desc">Cognome: </span><?php echo htmlspecialchars($utente['cognome']); ?></p>
                    <p><span class="info-desc">E-mail: </span><?php echo htmlspecialchars($utente['email']); ?></p>
                </div>
            </section>

            <section>
                <div class="credentials-change">
                    <h2>Modifica credenziali</h2>

                    <form action="profile.php" method="post">
                        <fieldset>
                            <legend><h3>Email</h3></legend>
                            <input type="hidden" name="action" value="update_email">

                            <label for="email">Nuova e-mail</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($utente['email']); ?>" required>

                            <button class="btn btn-secondary" type="submit">Aggiorna e-mail</button>
                        </fieldset>
                    </form>

                    <form action="profile.php" method="post">
                        <fieldset>
                            <legend><h3 class="password-title">Password</h3></legend>
                            <input type="hidden" name="action" value="update_password">

                            <label for="current_password">Password attuale:</label>
                            <input type="password" id="current_password" name="current_password" required>

                            <label for="new_password">Nuova password:</label>
                            <input type="password" id="new_password" name="new_password" required minlength="6" placeholder="Minimo 6 caratteri">

                            <label for="confirm_password">Conferma password:</label>
                            <input type="password" id="confirm_password" name="confirm_password" required minlength="6">

                            <button class="btn btn-secondary" type="submit">Aggiorna password</button>
                        </fieldset>
                    </form>
                </div>
            </section>
        <?php else: ?>
            <h2>Dati profilo</h2>
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($user['nome']); ?></p>
            <p><strong>Cognome:</strong> <?php echo htmlspecialchars($user['cognome']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <?php endif; ?>
    </main>
    <?php include 'layout/footer.php'; ?>
</body>
</html>