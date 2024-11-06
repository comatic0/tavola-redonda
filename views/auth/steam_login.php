<?php
session_start();
require '../../includes/db.php';
require '../../controllers/AuthController.php';
require '../../vendor/autoload.php';
$authController = new AuthController($pdo);
$openid = new LightOpenID('localhost');
if (!$openid->mode) {
    $openid->identity = 'https://steamcommunity.com/openid';
    header('Location: ' . $openid->authUrl());
} elseif ($openid->mode == 'cancel') {
    echo 'User has canceled authentication!';
} else {
    if ($openid->validate()) {
        $id = $openid->identity;
        $steam_id = str_replace('https://steamcommunity.com/openid/id/', '', $id);
        $user = $authController->loginWithSteam($steam_id);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['profile_picture'] = $user['profile_picture'] ?? 'user-icon.png';
            header('Location: ../../index.php');
        } else {
            echo 'Failed to log in with Steam.';
        }
    } else {
        echo 'User is not logged in.';
    }
}
?>