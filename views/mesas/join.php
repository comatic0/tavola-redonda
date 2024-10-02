<?php
session_start();
require '../../controllers/MesaController.php';

$mesaController = new MesaController($pdo);
$mesa_id = $_GET['id'] ?? null;
$mesaController->joinMesa($mesa_id);
?>