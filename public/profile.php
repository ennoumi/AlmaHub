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
        $email = $_POST['email'];
        $password = $_POST['password'];

        $res = $dbh->updateUserEmail((int)$utente['id_utente'], $email);

        if($res === true){ 
            $_SESSION['utente']['email'] = $email;
            $utente = $_SESSION['utente'];
            $templateParams['successo'] = "Email aggiornata con successo.";
        } elseif ($res === -1) {
            $templateParams['errore'] = "Email già usata da un altro account.";
        } else {
            $templateParams['errore'] = "Errore durante l’aggiornamento dell'email.";
        }
    }

    require_once __DIR__ . '/../template/profile-template.php';
?>