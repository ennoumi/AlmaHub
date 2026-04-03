<?php
require_once __DIR__ . '/../app/bootstrap.php';

header('Content-Type: application/json');

if (!isset($_SESSION['utente'])) {
    echo json_encode(['status' => 'error', 'message' => 'Login richiesto']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["id_gruppo"])) {
    $idGruppo = (int)$_POST["id_gruppo"];
    $idUtente = $_SESSION['utente']['id_utente'];

    $res = $dbh->joinGroup($idUtente, $idGruppo);

    echo json_encode([ 'risultato' => $res ]);
    exit();
}