<?php
namespace controllers;

require_once __DIR__ . '/../models/Ficha.php';
require_once __DIR__ . '/../includes/db.php';

use models\Ficha;

class FichaController {
    private $fichaModel;
    public function __construct($pdo) {
        $this->fichaModel = new Ficha($pdo);
    }
    public function createFicha($nome, $classe, $nivel, $raca, $magias, $descricao, $imagem, $user_id) {
        if ($user_id) {
            if ($this->fichaModel->createFicha($nome, $classe, $nivel, $raca, $magias, $descricao, $imagem, $user_id)) {
                header('Location: ../fichas/index.php');
                exit();
            } else {
                return "Erro ao criar personagem.";
            }
        }
    }
    public function getAllFichas() {
        return $this->fichaModel->getAllFichas();
    }
    public function deleteFicha($id) {
        return $this->fichaModel->deleteFicha($id);
    }
    public function getFichaById($id) {
        return $this->fichaModel->getFichaById($id);
    }
    public function updateFicha($id, $nome, $classe, $nivel, $raca, $magias, $descricao, $imagem) {
        $result = $this->fichaModel->updateFicha($id, $nome, $classe, $nivel, $raca, $magias, $descricao, $imagem);
        if ($result) {
            error_log("Character with ID $id updated successfully.");
            header('Location: ../fichas/index.php');
            exit();
        } else {
            error_log("Failed to update character with ID $id.");
        }
    }
    public function fetchDndData($endpoint) {
        $url = "https://www.dnd5eapi.co/api/$endpoint";
        $response = file_get_contents($url);
        return json_decode($response, true);
    }
} 
?>