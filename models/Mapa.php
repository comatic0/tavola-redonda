<?php
class Mapa {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function uploadMapa($nome, $caminho, $tipo, $user_id) {
        $stmt = $this->pdo->prepare("INSERT INTO mapas (nome, caminho, tipo, user_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nome, $caminho, $tipo, $user_id]);
    }

    public function deleteMapa($mapa_id) {
        $stmt = $this->pdo->prepare("DELETE FROM mapas WHERE id = :id");
        $stmt->execute([':id' => $mapa_id]);
    }

    public function getTableById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM mapas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllMapas() {
        $stmt = $this->pdo->prepare("SELECT * FROM mapas");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>