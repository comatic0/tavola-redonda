<?php
session_start();
require '../../includes/db.php';
require '../../controllers/AuthController.php';
$authController = new AuthController($pdo);

if (isset($_SESSION['steam_id'], $_SESSION['username'], $_SESSION['avatar_url'], $_SESSION['email'])) {
    $steam_id = $_SESSION['steam_id'];
    $username = $_SESSION['username'];
    $avatar_url = $_SESSION['avatar_url'];
    $email = $_SESSION['email'];

    $password = bin2hex(random_bytes(8)); 
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $profile_picture_filename = "{$username}.jpg";
    $profile_picture_path = __DIR__ . "/../../assets/profile_pictures/{$profile_picture_filename}";
    file_put_contents($profile_picture_path, file_get_contents($avatar_url));

    if ($authController->registerWithSteam($steam_id, $username, $email, $hashedPassword, $profile_picture_filename)) {
        $user = $authController->loginWithSteam($steam_id);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['profile_picture'] = $user['profile_picture'];
            header('Location: ../../index.php');
        } else {
            echo 'Failed to log in with Steam.';
        }
    } else {
        echo 'Failed to register with Steam.';
    }
} else {
    echo 'Missing session data.';
}
?>