<?php
require 'includes/db.php';
require 'controllers/MapaController.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$mapaController = new MapaController($pdo);

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $mapa = $mapaController->getMapaById($_GET['id']);
            echo json_encode($mapa);
        } else {
            $mesas = $mapaController->listarMapas();
            echo json_encode($mapa);
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        error_log("Received POST data: " . print_r($data, true)); // Log the received data
        if (json_last_error() === JSON_ERROR_NONE) {
            $nome = $data['nome'] ?? null;
            $imagem = $data['imagem'] ?? null;
            $tipo = $data['tipo'] ?? null;
            $user_id = $data['user_id'] ?? null;

            if ($nome && $imagem && $tipo && $user_id) {
                $mapaController->upload($nome, $imagem, $tipo);
                echo json_encode(['message' => 'Mapa criada com sucesso']);
            } else {
                echo json_encode(['message' => 'Dados incompletos'], JSON_UNESCAPED_UNICODE);
            }
        } else {
            echo json_encode(['message' => 'Erro ao decodificar JSON'], JSON_UNESCAPED_UNICODE);
        }
        break;
}
?>