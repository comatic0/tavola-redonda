<?php
class Ficha {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function createFicha($nome, $classe, $nivel, $raca, $descricao, $user_id) {
        $stmt = $this->pdo->prepare("INSERT INTO fichas (nome, classe, nivel, raca, descricao, user_id) VALUES (?, ?, ?, ?, ?, ?)");
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
}
?>