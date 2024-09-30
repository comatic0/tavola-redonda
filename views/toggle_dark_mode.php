<?php
session_start();
require '../includes/db.php';
require '../includes/functions.php';
$user_id = $_SESSION['user_id'] ?? null;
if ($user_id) {
    $current_mode = getUserDarkMode($pdo, $user_id);
    $new_mode = $current_mode ? 0 : 1;
    setUserDarkMode($pdo, $user_id, $new_mode);
    $_SESSION['dark_mode'] = $new_mode;
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>