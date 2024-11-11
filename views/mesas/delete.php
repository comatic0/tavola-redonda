<?php
session_start();
require '../../controllers/MesaController.php';

use controllers\MesaController;

$mesa_id = $_GET['id'] ?? null;

if ($mesa_id) {
    $mesaController = new MesaController($pdo);
    $mesaController->deleteMesa($mesa_id);
}
?>