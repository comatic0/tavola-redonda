<?php
session_start();
require '../../controllers/MapaController.php';

$mapa_id = $_GET['id'] ?? null;

if ($mapa_id) {
    $mapaController = new MapaController($pdo);
    $mapaController->deleteMapa($mapa_id);
}
?>