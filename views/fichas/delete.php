<?php
session_start();
require '../../controllers/FichaController.php';
use controllers\FichaController;
$fichaController = new FichaController($pdo);
$ficha_id = $_GET['id'] ?? null;
if ($ficha_id) {
    $fichaController->deleteFicha($ficha_id);
    header('Location: index.php');
    exit();
}
?>