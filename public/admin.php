<?php
require_once __DIR__ . '/../app/bootstrap.php';

if (!isset($_SESSION['utente'])) {
    redirect('/login.php');
}
if(!isAdmin()){
    redirect('/dashboard.php');
}

$dbh->getAllUsers();
$dbh->banUser();
$dbh->unbanUser();
$dbh->getAdminStats();
$dbh->getGroupsForAdmin();
$dbh->getMessagesForAdmin();

require __DIR__ . '/../template/admin-template.php';