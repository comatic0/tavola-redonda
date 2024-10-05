<?php
require_once __DIR__ . '/../models/Mesa.php';
require_once __DIR__ . '/../includes/db.php';

class MesaController {
    private $mesaModel;

    public function __construct($pdo) {
        $this->mesaModel = new Mesa($pdo);
    }

    public function leaveMesa($mesa_id) {
        $user_id = $_SESSION['user_id'] ?? null;
        if ($mesa_id && $user_id) {
            $this->mesaModel->leaveMesa($mesa_id, $user_id);
        }
        header('Location: ../mesas/index.php');
        exit();
    }
    
    public function joinMesa($mesa_id) {
        $user_id = $_SESSION['user_id'] ?? null;
        if ($mesa_id && $user_id) {
            $this->mesaModel->joinMesa($mesa_id, $user_id);
        }
        header('Location: ../mesas/index.php');
        exit();
    }

    public function isUserInMesa($mesa_id, $user_id) {
        return $this->mesaModel->isUserInMesa($mesa_id, $user_id);
    }

    public function getMesaParticipants($mesa_id) {
        return $this->mesaModel->getMesaParticipants($mesa_id);
    }

    public function searchTables($search) {
        return $this->mesaModel->searchTables($search);
    }

    public function getAllMesas() {
        return $this->mesaModel->getAllMesas();
    }

    public function deleteMesa($mesa_id) {
        $this->mesaModel->deleteMesa($mesa_id);
        header('Location: ../views/mesas/index.php');
        exit();
    }

    public function isAtMaxCapacity($mesa_id) {
        return $this->mesaModel->isAtMaxCapacity($mesa_id);
    }

    public function createMesa($nome, $descricao, $categoria, $max_capacity, $user_id) {
        $nome_do_mestre = $this->mesaModel->getUserNameById($user_id);
        $mesa_id = $this->mesaModel->createMesa($nome, $descricao, $categoria, $max_capacity, $user_id, $nome_do_mestre);
        if ($mesa_id) {
            $this->mesaModel->joinMesa($mesa_id, $user_id); // Adiciona o mestre à mesa
        }
        return $mesa_id;
    }
}
?>