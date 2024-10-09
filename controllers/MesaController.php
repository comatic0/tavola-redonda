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
        header('Location: ../mesas/index.php');
        exit();
    }

    public function isAtMaxCapacity($mesa_id) {
        return $this->mesaModel->isAtMaxCapacity($mesa_id);
    }

    public function createMesa($nome, $descricao, $categoria, $data_da_sessao, $max_capacity, $user_id) {
        $nome_do_mestre = $this->mesaModel->getUserNameById($user_id);
        $mesa_id = $this->mesaModel->createMesa($nome, $descricao, $categoria, $data_da_sessao, $max_capacity, $user_id, $nome_do_mestre);
        if ($mesa_id) {
            $this->mesaModel->joinMesa($mesa_id, $user_id); // Adiciona o mestre à mesa
        }
        return $mesa_id;
    }

    public function updateMesa($id, $nome, $descricao, $nome_do_mestre, $numero_max_jogadores, $categoria) {
        $result = $this->mesaModel->updateTable($id, $nome, $descricao, $nome_do_mestre, $numero_max_jogadores, $categoria);
        if ($result) {
            error_log("Table with ID $id updated successfully.");
            header('Location: index.php');
            exit();
        } else {
            error_log("Failed to update table with ID $id.");
        }
    }

    public function getMesaById($mesa_id) {
        $table = $this->mesaModel->getTableById($mesa_id);
        if ($table) {
            return $table;
        } else {
            exit();
        }
    }

    public function delete($user_id, $mesa_id) {
        if ($this->mesaModel->deleteUser($user_id, $mesa_id)) {
            header('Location: edit.php?id=' . $mesa_id);
        } else {
            header('Location: edit.php?id=' . $mesa_id);
            exit();
        }
    }
}
?>