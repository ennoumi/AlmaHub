<?php 
require_once __DIR__ . '/../app/bootstrap.php';

// Se l'utente non è loggato, lo rimando alla pagina di login
if(!isset($_SESSION['utente'])){
    header("Location: login.php");
    exit();
}

$dashboardParams["availableGroups"] = $dbh -> getAvailableGroups($_SESSION['utente']['id_utente']);
$dashboardParams["userGroups"] = $dbh -> getPersonalGroups($_SESSION['utente']['id_utente']);

require __DIR__ . '/../template/dashboard-template.php';
?>