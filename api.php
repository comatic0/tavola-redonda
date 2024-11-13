<?php
require 'includes/db.php';
require 'controllers/MesaController.php';
use Controllers\MesaController;
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$mesaController = new MesaController($pdo);

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $mesa = $mesaController->getMesaById($_GET['id']);
            echo json_encode($mesa);
        } else {
            $mesas = $mesaController->getAllMesas();
            echo json_encode($mesas);
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        error_log("Received POST data: " . print_r($data, true)); // Log the received data
        if (json_last_error() === JSON_ERROR_NONE) {
            $nome = $data['nome'] ?? null;
            $descricao = $data['descricao'] ?? null;
            $categoria = $data['categoria'] ?? null;
            $data_da_sessao = $data['data_da_sessao'] ?? null;
            $max_capacity = $data['max_capacity'] ?? null;
            $user_id = $data['user_id'] ?? null;

            if ($nome && $descricao && $categoria && $data_da_sessao && $max_capacity && $user_id) {
                $mesaController->createMesa($nome, $descricao, $categoria, $data_da_sessao, $max_capacity, $user_id);
                echo json_encode(['message' => 'Mesa criada com sucesso']);
            } else {
                echo json_encode(['message' => 'Dados incompletos'], JSON_UNESCAPED_UNICODE);
            }
        } else {
            echo json_encode(['message' => 'Erro ao decodificar JSON'], JSON_UNESCAPED_UNICODE);
        }
        break;
    case 'PUT':
        if (isset($_GET['id'])) {
            $data = json_decode(file_get_contents('php://input'), true);
            error_log("Received PUT data: " . print_r($data, true)); // Log the received data
            if (json_last_error() === JSON_ERROR_NONE) {
                $id = $_GET['id'];
                $nome = $data['nome'] ?? null;
                $descricao = $data['descricao'] ?? null;
                $categoria = $data['categoria'] ?? null;
                $data_da_sessao = $data['data_da_sessao'] ?? null;
                $max_capacity = $data['max_capacity'] ?? null;

                if ($nome && $descricao && $categoria && $data_da_sessao && $max_capacity) {
                    $mesaController->updateMesa($id, $nome, $descricao, $categoria, $data_da_sessao, $max_capacity);
                    echo json_encode(['message' => 'Mesa atualizada com sucesso']);
                } else {
                    echo json_encode(['message' => 'Dados incompletos'], JSON_UNESCAPED_UNICODE);
                }
            } else {
                echo json_encode(['message' => 'Erro ao decodificar JSON'], JSON_UNESCAPED_UNICODE);
            }
        }
        break;
    case 'DELETE':
        if (isset($_GET['id'])) {
            $mesaController->deleteMesa($_GET['id']);
            echo json_encode(['message' => 'Mesa deletada com sucesso']);
        }
        break;
    default:
        echo json_encode(['message' => 'Método não suportado']);
        break;
}
?>