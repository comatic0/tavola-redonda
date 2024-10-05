<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}
require '../../controllers/MesaController.php';
$mesaController = new MesaController($pdo);
$mesa_id = $_GET['id'] ?? null;
if ($mesa_id) {
    $mesaController->leaveMesa($mesa_id);
}
header('Location: index.php');
exit();
?>