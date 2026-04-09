<header>
    <nav class="navbar">
        <div class="logo">
            <a href="index.php"><strong>AlmaHub</strong></a>
        </div>
        <ul class="nav-links">
            <?php if (isset($_SESSION['utente'])): ?>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="group-requests.php">Richieste</a></li>
                <li><a href="profile.php"><?php echo $_SESSION['utente']['nome'] . ' ' . $_SESSION['utente']['cognome']; ?></a></li>
                <li><a href="logout.php" class="btn-logout">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Accedi</a></li>
                <li><a href="register.php">Registrati</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>