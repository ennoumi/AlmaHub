<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlmaHub - Login</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <main class="login-container">
        <form action="login.php" method="POST" class="login-box">
            <h1 class="gradient-text">Accedi ad AlmaHub</h1>

            <?php if (!empty($templateParams["errore"])): ?>
                <p class="error"><?php echo $templateParams["errore"]; ?></p>
            <?php endif; ?>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="btn btn-primary">Accedi</button>
                    <p class="register-link">Non hai un account? <a href="register.php">Registrati</a></p>

        </form>
    </main>
    <?php include '../template/layout/footer.php'; ?>
</body>
</html>