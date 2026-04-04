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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = ''; // Per sicurezza se non arriva l'action dal form, lo lascio vuoto
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
        }

        // Aggiornamento dell'email
        if ($action === 'update_email') {
            $email = '';
            if (isset($_POST['email'])) {
                $email = $_POST['email'];
            }

            if ($email === '') {
                $templateParams['errore'] = "L'email non può essere vuota.";
            } else {
                $res = $dbh->updateUserEmail((int)$utente['id_utente'], $email);

                if ($res === true) {
                    $_SESSION['utente']['email'] = $email;
                    $utente = $_SESSION['utente']; // Aggiorno anche la sessione cosi si vede la mail aggiornata
                    $templateParams['successo'] = "Email aggiornata con successo.";
                } elseif ($res === -1) {
                    $templateParams['errore'] = "Email già usata da un altro account.";
                } else {
                    $templateParams['errore'] = "Errore durante l’aggiornamento dell'email.";
                }
            }

        // Aggiornamento della password
        } elseif ($action === 'update_password') {
            $current_password = '';
            if (isset($_POST['current_password'])) {
                $current_password = $_POST['current_password'];
            }
            $new_password = '';
            if (isset($_POST['new_password'])) {
                $new_password = $_POST['new_password'];
            }
            $confirm_password = '';
            if (isset($_POST['confirm_password'])) {
                $confirm_password = $_POST['confirm_password'];
            }

            if ($current_password === '' || $new_password === '' || $confirm_password === '') {
                $templateParams['errore'] = "Tutti i campi sono obbligatori.";
            } elseif (strlen($new_password) <= 5) {
                $templateParams['errore'] = "La nuova password deve avere almeno 6 caratteri.";
            } elseif ($new_password !== $confirm_password) {
                $templateParams['errore'] = "La due nuove password non coincidono.";
            } else {
                $checkCurrentPass = $dbh->checkLogin($utente['email'], $current_password);
                if ($checkCurrentPass === null) {
                    $templateParams['errore'] = "Password attuale non corretta.";
                } else {
                    $res = $dbh->updatePassword((int)$utente['id_utente'], $new_password);

                    if ($res === true) {
                        $templateParams['successo'] = "Password cambiata con successo.";
                    } else {
                        $templateParams['errore'] = "Errore durante il cambio password.";
                    }
                }
            }
        }
    }

    require_once __DIR__ . '/../template/profile-template.php';
?>