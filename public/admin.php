<?php
require_once __DIR__ . '/../app/bootstrap.php';

if (!isset($_SESSION['utente'])) {
    redirect('/login.php');
}
if(!isAdmin()){
    redirect('/dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ban_user'])) {
        $dbh->banUser((int)$_POST['user_id']);
    }
    if (isset($_POST['unban_user'])) {
        $dbh->unbanUser((int)$_POST['user_id']);
    }
}

$adminParams = [
    'stats' => $dbh->getAdminStats(),
    'users' => $dbh->getAllUsers(),
    'groups' => $dbh->getGroupsForAdmin(),
    'messages' => [],
    'selectedGroupId' => null
];

if (isset($_GET['group_id'])) {
    $adminParams['selectedGroupId'] = (int)$_GET['group_id'];
    $adminParams['messages'] = $dbh->getMessagesForAdmin($adminParams['selectedGroupId']);
}

require __DIR__ . '/../template/admin-template.php';