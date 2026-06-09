<?php
require_once __DIR__ . '/../app/bootstrap.php';
header('Content-Type: application/json');

if(!isset($_SESSION['utente'])){
        redirect('/login.php');
    }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["id_gruppo"])) {
    $idGruppo = (int)$_POST['id_gruppo'];
    $ruolo = $_SESSION['utente']['ruolo'];

    if ($ruolo === 'admin') {
        $res = $dbh->deleteGroup($idGruppo);
        
        echo json_encode(['risultato' => $res]);
    }
} else {
    echo json_encode(['risultato' => false, 'errore' => 'Richiesta non valida.']);
}
?>