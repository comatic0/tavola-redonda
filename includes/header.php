<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$base_path = '/tavola-redonda';
if (!isset($_SESSION['user_id']) && isset($_COOKIE['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['profile_picture'] = $_COOKIE['profile_picture'];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Távola Redonda</title>
    <link rel="stylesheet" href="<?php echo $base_path; ?>/css/styles.css">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $base_path; ?>/assets/icons/image1.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $base_path; ?>/assets/icons/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $base_path; ?>/assets/icons/user-icon.png">
</head>
<body>