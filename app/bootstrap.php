<?php

session_start();
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/../db/database.php'; 

function redirect($path){
    header("Location: " . BASE_URL . $path);
    exit;
}

function isUserLoggedIn(){
    return isset($_SESSION['user']);
}

function isAdmin() {
    if (!isset($_SESSION['user'])) {
        return false;
    }
    if(!isset($_SESSION['user']['ruolo'])){
        return false;
    }
    return $_SESSION['user']['ruolo'] === 'admin';
}

$dbh = new DatabaseHelper(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
?>