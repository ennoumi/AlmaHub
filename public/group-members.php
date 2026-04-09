<?php
require_once __DIR__ . '/../app/bootstrap.php';

if (!isset($_SESSION['utente'])) {
    header('Location: login.php');
    exit();
}

$idGruppo = $_GET['id'] ?? null;

if ($idGruppo == null) {
    header("Location: dashboard.php");
    exit();
}

$gruppo = $dbh->getGroupDetails($idGruppo);
$templateParams["membri"] = $dbh->getGroupMembers($idGruppo);


require __DIR__ . '/../template/group-members-template.php';
?>