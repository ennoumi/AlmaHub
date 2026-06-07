<?php 
$isAdmin = ($_SESSION['utente']['ruolo'] === 'admin'); 
?>

<header class="main-header">
    <nav class="navbar">
        <div class="nav-left">
            <a href="/AlmaHub/public/index.php" class="logo"><strong>AlmaHub</strong></a>
            
            <?php if (!$isAdmin): ?>
                <div class="desktop-links">
                    <a class="dashboard-link" href="/AlmaHub/public/dashboard.php">Dashboard</a>
                    <a class="requests-link" href="/AlmaHub/public/group-requests.php">Richieste di Partecipazione</a>
                </div>
            <?php endif; ?>
        </div>

        <div class="nav-right">
            <div class="desktop-links">
                <a class="profile-link" href="/AlmaHub/public/profile.php" class="user-name">
                    <?php echo $_SESSION['utente']['nome'] . ' ' . $_SESSION['utente']['cognome']; ?>
                </a>
                
                <a href="/AlmaHub/public/logout.php" class="logout-btn">Logout</a>
            </div>

            <button class="menu-toggle" id="btn-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>
    </nav>

    <div class="mobile-menu" id="mobile-nav">
        <?php if ($isAdmin): ?>
            <a href="/AlmaHub/public/admin.php">Dashboard Admin</a>
        <?php else: ?>
            <a href="/AlmaHub/public/dashboard.php">Dashboard</a>
        <?php endif; ?>
        <?php if (!$isAdmin): ?>
            <a href="/AlmaHub/public/group-requests.php">Richieste di Partecipazione</a>
        <?php endif; ?>
        <a href="/AlmaHub/public/profile.php">Profilo</a>
        <hr>
        <a href="/AlmaHub/public/logout.php">Logout</a>
    </div>
</header>

<script>
    const btn = document.getElementById('btn-menu');
    const nav = document.getElementById('mobile-nav');

    if (btn && nav) {
        btn.onclick = function() {
            nav.classList.toggle('active');
        };
    };
</script>