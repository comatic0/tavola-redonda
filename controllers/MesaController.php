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
        header('Location: ../index.php');
        exit();
    }

    public function joinMesa($mesa_id) {
        $user_id = $_SESSION['user_id'] ?? null;
        if ($mesa_id && $user_id) {
            $this->mesaModel->joinMesa($mesa_id, $user_id);
        }
        header('Location: ../index.php');
        exit();
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
}
?>