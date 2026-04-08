<?php 
require_once __DIR__ . '/../app/bootstrap.php';

if (!isset($_SESSION['utente'])) {
    header("Location: login.php");
    exit();
}

$dashboardParams["pending"] = $dbh -> getPendingRequests($_SESSION['utente']['id_utente']);
$dashboardParams["sent"] = $dbh -> getSentRequests($_SESSION['utente']['id_utente']);

require __DIR__ . '/../template/group-requests-template.php';
?>