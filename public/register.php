<?php
require_once __DIR__ . '/../app/bootstrap.php';

// Se l'utente è già loggato, reindirizzo direttamente alla dashboard.
if (isset($_SESSION['utente'])) {
    header('Location: dashboard.php');
    exit();
}

$templateParams = [
    'errore' => '',
    'successo' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = $dbh->createUser($nome, $cognome, $email, $password);

    if ($res == -1) {
        $templateParams['errore'] = 'Email già registrata. Prova ad accedere.';
    } elseif ($res == false) {
        $templateParams['errore'] = 'Errore durante la registrazione. Riprova.';
    } else {
        $templateParams['successo'] = 'Registrazione avvenuta con successo.';
    }
}

require_once __DIR__ . '/../template/register-template.php';