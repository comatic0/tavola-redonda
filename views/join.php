<?php
session_start();
require '../includes/db.php';
require '../includes/functions.php';

$mesa_id = $_GET['id'] ?? null;
$user_id = $_SESSION['user_id'] ?? null;

if ($mesa_id && $user_id) {
    $stmt = $pdo->prepare("INSERT INTO mesa_usuarios (mesa_id, user_id) VALUES (?, ?)");
    $stmt->execute([$mesa_id, $user_id]);
}

header('Location: index.php');
exit();
?>