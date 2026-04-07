<?php
require_once __DIR__ . '/../app/bootstrap.php';

header('Content-Type: application/json');

$idUtente = $_SESSION['utente']['id_utente'];
$idGruppo = (int)$_POST['id_gruppo'];
$testo = $_POST['messaggio'];

$risultato = $dbh->sendMessage($idUtente, $idGruppo, $testo);

echo json_encode(['status' => $risultato ? 'success' : 'error']);
?>