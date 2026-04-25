<?php
require_once __DIR__ . '/../app/bootstrap.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!isset($_SESSION['utente']) || !isAdmin()) {
    redirect('/dashboard.php');
}

$groupId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$groupDetails = $dbh->getGroupDetails($groupId);
if (!$groupDetails) {
    die("Gruppo non trovato.");
}

$groupMembers = $dbh->getGroupMembers($groupId);
$groupMessages = $dbh->getMessagesForAdmin($groupId);

$templateParams = [
    'group' => $groupDetails,
    'members' => $groupMembers,
    'messages' => $groupMessages
];

require __DIR__ . '/../template/group-details-admin-template.php';