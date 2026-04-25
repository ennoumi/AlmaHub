<!DOCTYPE html>
<html lang="it">
<head>
    <title>AlmaHub - Login</title>
</head>
<body>
    <main>
        <form action="login.php" method="POST">
            <h1>Accedi ad AlmaHub</h1>

            <?php if (!empty($templateParams["errore"])): ?>
                <p style="color: red;"><?php echo $templateParams["errore"]; ?></p>
            <?php endif; ?>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Accedi</button>
        </form>
        <p>Non hai un account? <a href="register.php">Registrati</a></p>
    </main>
    <?php include 'layout/footer.php'; ?>
</body>
</html>