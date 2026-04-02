<?php
require_once __DIR__ . '/../app/bootstrap.php';

$templateParams['errore'] = "";
$templateParams['conferma'] = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST['tipo'];
    $titolo = $_POST['titolo'];
    $corso = $_POST['corso'];
    $descrizione = $_POST['descrizione'];
    $luogo = $_POST['luogo'];
    $orario = $_POST['orario'];
    $maxMembri = $_POST['maxMembri'];

    $groupCreated = $dbh->createGroup($tipo, $titolo, $corso, $descrizione, $luogo, $orario, $maxMembri, $_SESSION['utente']['id_utente']);

    if($groupCreated){
        // Cambia il metodo da POST a GET e al ricaricamento della pagina
        // non vengono rigestiti i dati del gruppo da creare
        header("Location: create-group.php?msg=successo");
        exit();
    } else{
        $templateParams['errore'] = "Errore nella creazione del gruppo!";
    }
}

if (isset($_GET['msg']) && $_GET['msg'] == "successo") {
    $templateParams['conferma'] = "Gruppo creato con successo!";
}

require_once __DIR__ . '/../template/create-group-template.php';

?>