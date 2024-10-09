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
        $steamData = $authController->fetchSteamData($steam_id);
        if ($steamData) {
            $_SESSION['steam_id'] = $steam_id;
            $_SESSION['username'] = $steamData['personaname'];
            $_SESSION['avatar_url'] = $steamData['avatarfull'];
            header('Location: enter_email.php');
        } else {
            echo 'Failed to fetch Steam data.';
        }
    } else {
        echo 'User is not logged in.';
    }
}
?>