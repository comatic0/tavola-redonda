<?php
session_start();
require '../../includes/db.php';
require '../../controllers/AuthController.php';
$authController = new AuthController($pdo);

if (isset($_SESSION['username'], $_SESSION['avatar_url'], $_SESSION['email'])) {
    $username = $_SESSION['username'];
    $avatar_url = $_SESSION['avatar_url'];
    $email = $_SESSION['email'];

    $password = bin2hex(random_bytes(8)); 
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $profile_picture_filename = "{$username}.jpg";
    $profile_picture_path = __DIR__ . "/../../assets/profile_pictures/{$profile_picture_filename}";
    file_put_contents($profile_picture_path, file_get_contents($avatar_url));

    if ($authController->register($username, $email, $hashedPassword, $profile_picture_filename)) {
        $user = $authController->login($username);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['profile_picture'] = $user['profile_picture'];
            header('Location: ../../index.php');
        } else {
            echo 'Failed to log in.';
        }
    } else {
        echo 'Failed to register.';
    }
} else {
    echo 'Missing session data.';
}
?>