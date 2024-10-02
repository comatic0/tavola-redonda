<?php
class Mesa {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function leaveMesa($mesa_id, $user_id) {
        $stmt = $this->pdo->prepare("DELETE FROM mesa_usuarios WHERE mesa_id = ? AND user_id = ?");
        $stmt->execute([$mesa_id, $user_id]);
    }

    public function joinMesa($mesa_id, $user_id) {
        $stmt = $this->pdo->prepare("INSERT INTO mesa_usuarios (mesa_id, user_id) VALUES (?, ?)");
        $stmt->execute([$mesa_id, $user_id]);
    }

    public function searchTables($search) {
        $stmt = $this->pdo->prepare("SELECT * FROM mesas WHERE nome LIKE ?");
        $stmt->execute(['%' . $search . '%']);
        return $stmt->fetchAll();
    }

    public function getAllMesas() {
        $stmt = $this->pdo->query("SELECT * FROM mesas");
        return $stmt->fetchAll();
    }

    public function deleteMesa($mesa_id) {
        $stmt = $this->pdo->prepare("DELETE FROM mesas WHERE id = ?");
        $stmt->execute([$mesa_id]);
    }

    public function isAtMaxCapacity($mesa_id) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as user_count, m.max_capacity FROM mesa_usuarios mu JOIN mesas m ON mu.mesa_id = m.id WHERE mu.mesa_id = ?");
        $stmt->execute([$mesa_id]);
        $result = $stmt->fetch();
        return $result['user_count'] >= $result['max_capacity'];
    }
}
?>