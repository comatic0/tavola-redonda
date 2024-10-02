<?php
require_once __DIR__ . '/../models/Ficha.php';
require_once __DIR__ . '/../includes/db.php';
class FichaController {
    private $fichaModel;
    public function __construct($pdo) {
        $this->fichaModel = new Ficha($pdo);
    }
    public function createFicha($nome, $classe, $nivel, $raca, $descricao) {
        $user_id = $_SESSION['user_id'] ?? null;
        if ($user_id) {
            if ($this->fichaModel->createFicha($nome, $classe, $nivel, $raca, $descricao, $user_id)) {
                header('Location: ../views/fichas/index.php');
                exit();
            } else {
                return "Erro ao criar personagem.";
            }
        }
    }
    public function getAllFichas() {
        return $this->fichaModel->getAllFichas();
    }
}
?>