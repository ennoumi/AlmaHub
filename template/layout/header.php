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
                <?php if (!$isAdmin): ?>
                    <a class="profile-link" href="/AlmaHub/public/profile.php" class="user-name">
                        <?php echo $_SESSION['utente']['nome'] . ' ' . $_SESSION['utente']['cognome']; ?>
                    </a>
                <?php endif; ?>
                
                <a href="/AlmaHub/public/logout.php" class="logout-btn">Logout</a>
            </div>

            <?php if (!$isAdmin): ?>
                <button class="menu-toggle" id="btn-menu">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            <?php endif; ?>
        </div>
    </nav>

    <?php if (!$isAdmin): ?>
    <div class="mobile-menu" id="mobile-nav">
        <a href="/AlmaHub/public/dashboard.php">Dashboard</a>
        <a href="/AlmaHub/public/group-requests.php">Richieste di Partecipazione</a>
        <a href="/AlmaHub/public/profile.php">Profilo</a>
        <hr>
        <a href="/AlmaHub/public/logout.php">Logout</a>
    </div>
    <?php endif; ?>
</header>

<script>
    const btn = document.getElementById('btn-menu');
    const nav = document.getElementById('mobile-nav');

    if (btn && nav) {
        btn.onclick = () => {
            nav.classList.toggle('active');
        };
    };
</script>