<header>
<nav>
    <div>
        <a href="/AlmaHub/public/index.php"><strong>AlmaHub</strong></a>
    </div>
    <ul>
        <?php if (isset($_SESSION['utente'])): ?>
          <li>
              <a href="/AlmaHub/public/profile.php">
                  <?php echo $_SESSION['utente']['nome'] . ' ' . $_SESSION['utente']['cognome']; ?>
              </a>
          </li>

          <li><a href="/AlmaHub/public/dashboard.php">Dashboard</a></li>
          <li><a href="/AlmaHub/public/group-requests.php">Richieste di Partecipazione</a></li>
          <li><a href="/AlmaHub/public/logout.php">Logout</a></li>
        <?php else: ?>
          <li><a href="/AlmaHub/public/login.php">Accedi</a></li>
          <li><a href="/AlmaHub/public/register.php">Registrati</a></li>
        <?php endif; ?>
    </ul>
</nav>
</header>