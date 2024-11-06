<?php
require 'includes/db.php';
require 'controllers/MesaController.php';

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
        $nome = $data['nome'];
        $descricao = $data['descricao'];
        $categoria = $data['categoria'];
        $data_da_sessao = $data['data_da_sessao'];
        $max_capacity = $data['max_capacity'];
        $user_id = $data['user_id'];
        $mesaController->createMesa($nome, $descricao, $categoria, $data_da_sessao, $max_capacity, $user_id);
        echo json_encode(['message' => 'Mesa criada com sucesso']);
        break;
    case 'PUT':
        if (isset($_GET['id'])) {
            $data = json_decode(file_get_contents('php://input'), true);
            $id = $_GET['id'];
            $nome = $data['nome'];
            $descricao = $data['descricao'];
            $categoria = $data['categoria'];
            $data_da_sessao = $data['data_da_sessao'];
            $max_capacity = $data['max_capacity'];
            $mesaController->updateMesa($id, $nome, $descricao, $categoria, $data_da_sessao, $max_capacity);
            echo json_encode(['message' => 'Mesa atualizada com sucesso']);
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