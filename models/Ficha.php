<?php
class Ficha {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function createFicha($nome, $classe, $nivel, $raca, $magias, $descricao, $user_id) {
        $stmt = $this->pdo->prepare("INSERT INTO fichas (nome, classe, nivel, raca, magias, descricao, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$nome, $classe, $nivel, $raca, $descricao, $user_id]);
    }
    public function getAllFichas() {
        $stmt = $this->pdo->query("SELECT * FROM fichas");
        return $stmt->fetchAll();
    }
    public function deleteFicha($id) {
        $stmt = $this->pdo->prepare("DELETE FROM fichas WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public function getFichasByUserId($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM fichas WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getFichaById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM fichas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateFicha($id, $nome, $classe, $nivel, $raca, $descricao) {
        $stmt = $this->pdo->prepare("UPDATE fichas SET nome = ?, classe = ?, nivel = ?, magias = ?, raca = ?, descricao = ? WHERE id = ?");
        return $stmt->execute([$nome, $classe, $nivel, $raca, $magias, $descricao, $id]);
    }
}
?>