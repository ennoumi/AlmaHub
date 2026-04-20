<?php
require_once __DIR__ . '/../app/bootstrap.php';

$query = $_GET['q'] ?? '';

$gruppi = $dbh->findGroups($query);

if (empty($gruppi)) {
    echo '<li class="no-results">Nessun gruppo trovato per "' . $query . '"</li>';
} else {
    foreach ($gruppi as $gruppo) {
        ?>
        <li>
            <p><?php echo $gruppo["tipo"]; ?></p>
            <p><?php echo $gruppo["titolo"]; ?></p>
            <p><a href="group-details.php?id=<?php echo $gruppo['id_gruppo']; ?>">Visualizza dettagli</a></p>
        </li>
        <?php
    }
}
?>