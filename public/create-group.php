<?php
require_once __DIR__ . '/../app/bootstrap.php';

templateParams['errore'] = "";
templateParams['conferma'] = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST['tipo'];
    $titolo = $_POST['titolo'];
    $corso = $_POST['corso'];
    $descrizione = $_POST['descrizione'];
    $luogo = $_POST['luogo'];
    $orario = $_POST['orario'];

    $groupCreated = $dbh->createGroup($tipo, $titolo, $corso, $descrizione, $luogo, $orario, $maxMembri);

    if($groupCreated){
        templateParams['conferma'] = "Gruppo creato con successo!"
    }
    else{
        templateParams['errore'] = "Errore nella creazione del gruppo!";
    }
}

require_once __DIR__ . '/../template/create-group-template.php';

?>