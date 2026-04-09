
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione</title>
</head>
<body>
    <?php include 'layout/header.php'; ?>
    <main>
        <h1>Crea un account</h1>
        <p>
            Unisciti alla community di AlmaHub per collaborare con altri studenti nel tuo percorso accademico.
        </p>

        <?php if (!empty($templateParams['errore'])): ?>
            <p style="color: red;"><?php echo $templateParams['errore']; ?></p>
        <?php endif; ?>
        <?php if (!empty($templateParams['successo'])): ?>
            <p style="color: green;"><?php echo $templateParams['successo']; ?> Ora <a href = "login.php">accedi</a>
        </p>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="cognome">Cognome:</label>
            <input type="text" id="cognome" name="cognome" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Registrati</button>
        </form>

        <p>Hai già un account? <a href="login.php">Accedi</a></p>
    </main>
    <?php include 'layout/footer.php'; ?>
</body>
</html>