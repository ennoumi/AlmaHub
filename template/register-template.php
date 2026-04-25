
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlmaHub - Registrazione</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <main class="login-container">
    <form action="register.php" method="POST" class="login-box">
        <h1 class="gradient-text">Crea un account</h1>
        <p>
            Unisciti alla community di AlmaHub per collaborare con altri studenti.
        </p>
        <?php if (!empty($templateParams['errore'])): ?>
            <p class="error"><?php echo $templateParams['errore']; ?></p>
        <?php endif; ?>
        <?php if (!empty($templateParams['successo'])): ?>
            <p class="success">
                <?php echo $templateParams['successo']; ?>
                Ora <a href="login.php">accedi</a>
            </p>
        <?php endif; ?>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="cognome">Cognome:</label>
        <input type="text" id="cognome" name="cognome" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" class="btn btn-primary">Registrati</button>

        <p class="register-link">
            Hai già un account? <a href="login.php">Accedi</a>
        </p>
    </form>
    </main>
    <?php include '../template/layout/footer.php'; ?>
</body>
</html>