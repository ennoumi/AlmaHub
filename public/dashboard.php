<?php 
require_once __DIR__ . '/../app/bootstrap.php';

$dashboardParams["allGroups"] = $dbh -> getAllGroups();
$dashboardParams["userGroups"] = $dbh -> getPersonalGroups($_SESSION['utente']['id_utente']);

require __DIR__ . '/../template/dashboard-template.php';
?>