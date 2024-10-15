<?php
session_start();
require_once '../includes/db.php';
require_once '../models/User.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

$userModel = new User($pdo);
$bio = $_POST['bio'] ?? '';

if (strlen($bio) <= 150) {
    $userModel->updateUserBio($_SESSION['user_id'], $bio);
}

header('Location: profile.php');
exit();
?>