<?php
require_once __DIR__ . '/../app/bootstrap.php';

if(!isset($_SESSION['utente'])){
    redirect('/login.php');
}

$idGruppo = $_GET['id'] ?? null;

if ($idGruppo == null) {
    header("Location: dashboard.php");
    exit();
}

$gruppo = $dbh->getGroupDetails($idGruppo);

if (!empty($gruppo)) {
    $gruppo["numPartecipanti"] = $dbh->countGroupParticipants($idGruppo);
    $templateParams["gruppo"] = $gruppo;
} else {
    $templateParams["gruppo"] = []; 
    $templateParams["errore"] = "Gruppo non trovato!";
}

require __DIR__ . '/../template/group-details-template.php';
?>