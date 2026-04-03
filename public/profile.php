<?php
    require_once __DIR__ . '/../app/bootstrap.php';
    if(!isset($_SESSION['utente'])){
        redirect('/login.php');
    }
    $utente = $_SESSION['utente'];

    $templateParams = [ 
        'errore' => '',
        'successo' => ''
    ];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $res = $dbh->

        if($res == true){
            $templateParams['successo'] = 'Passwod aggiornata con successo.';
        }
    }
    echo "ciao"
?>