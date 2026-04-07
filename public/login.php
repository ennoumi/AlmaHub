<?php
require_once __DIR__ . '/../app/bootstrap.php';

// se l'utente è già loggato reindirizza alla dashboard
if (isset($_SESSION['utente'])) {
    header("Location: dashboard.php");
    exit();
}

$templateParams["errore"] = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["email"]) && isset($_POST["password"])){
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if($email != "" && $password != ""){ 
            $user = $dbh->checkLogin($email, $password);

            if ($user) {
                $_SESSION['utente'] = $user;
                header("Location: dashboard.php");
                exit();
            } else {
                $templateParams["errore"] = "Credenziali non valide o account disattivato.";
            }
        } else {
            $templateParams["errore"] = "Compila email e password.";
        }
    }
}

require_once __DIR__ . '/../template/login-template.php';