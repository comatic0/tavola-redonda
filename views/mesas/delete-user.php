<?php
session_start();
require '../../controllers/MesaController.php';

$mesa_id = $_GET['mesa_id'] ?? null;
$user_id = $_GET['user_id'] ?? null;

if ($mesa_id && $user_id) {
    $userController = new MesaController($pdo);
    $userController->delete($user_id, $mesa_id);
} else {
    header('Location: index.php');
    exit();
}
?>