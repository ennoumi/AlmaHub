<?php
require_once __DIR__ . '/../app/bootstrap.php';

header('Content-Type: application/json');

if (!isset($_SESSION['utente'])) {
    echo json_encode(['risultato' => 100]); 
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["id_gruppo"])) {
    $idGruppo = (int)$_POST["id_gruppo"];
    $idUtente = $_SESSION['utente']['id_utente'];
    $accept = (bool)$_POST['azione'];

    $res = $dbh->manageRequest($idUtente, $idGruppo, $accept);

    echo json_encode([ 'risultato' =>($res ? 0 : -1) ]);
    exit();
}
?>