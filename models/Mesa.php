<?php
namespace models; 

use PDO;

use controllers\MesaController;

class Mesa {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function joinMesa($mesa_id, $user_id) {
        // Verifica se o usuário já está na mesa
        if ($this->isUserInMesa($mesa_id, $user_id)) {
            return false; // Usuário já está na mesa
        }
        $stmt = $this->pdo->prepare("INSERT INTO mesa_usuarios (mesa_id, user_id) VALUES (:mesa_id, :user_id)");
        $stmt->execute([
            ':mesa_id' => $mesa_id,
            ':user_id' => $user_id
        ]);
        return true;
    }

    public function leaveMesa($mesa_id, $user_id) {
        $stmt = $this->pdo->prepare("DELETE FROM mesa_usuarios WHERE mesa_id = :mesa_id AND user_id = :user_id");
        $stmt->execute([
            ':mesa_id' => $mesa_id,
            ':user_id' => $user_id
        ]);
    }

    public function isUserInMesa($mesa_id, $user_id) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM mesa_usuarios WHERE mesa_id = :mesa_id AND user_id = :user_id");
        $stmt->execute([
            ':mesa_id' => $mesa_id,
            ':user_id' => $user_id
        ]);
        return $stmt->fetchColumn() > 0;
    }

    public function getMesaParticipants($mesa_id) {
        $stmt = $this->pdo->prepare("
            SELECT u.id, u.username 
            FROM mesa_usuarios mu 
            JOIN usuarios u ON mu.user_id = u.id 
            WHERE mu.mesa_id = ?
        ");
        $stmt->execute([$mesa_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllMesas() {
        $stmt = $this->pdo->query("SELECT * FROM mesas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteMesa($mesa_id) {
        $stmt = $this->pdo->prepare("DELETE FROM mesas WHERE id = :id");
        $stmt->execute([':id' => $mesa_id]);
    }

    public function searchTables($search) {
        $stmt = $this->pdo->prepare("SELECT * FROM mesas WHERE nome LIKE :search OR descricao LIKE :search");
        $stmt->execute([':search' => '%' . $search . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isAtMaxCapacity($mesa_id) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM mesa_usuarios WHERE mesa_id = :mesa_id");
        $stmt->execute([':mesa_id' => $mesa_id]);
        $count = $stmt->fetchColumn();

        $stmt = $this->pdo->prepare("SELECT max_capacity FROM mesas WHERE id = :mesa_id");
        $stmt->execute([':mesa_id' => $mesa_id]);
        $max_capacity = $stmt->fetchColumn();

        return $count >= $max_capacity;
    }

    public function createMesa($nome, $descricao, $categoria, $data_da_sessao, $max_capacity, $user_id, $nome_do_mestre) {
        $stmt = $this->pdo->prepare("INSERT INTO mesas (nome, descricao, categoria, data_da_sessao, max_capacity, user_id, nome_do_mestre) VALUES (:nome, :descricao, :categoria, :data_da_sessao, :max_capacity, :user_id, :nome_do_mestre)");
        $stmt->execute([
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':categoria' => $categoria,
            ':data_da_sessao' => $data_da_sessao,
            ':max_capacity' => $max_capacity,
            ':user_id' => $user_id,
            ':nome_do_mestre' => $nome_do_mestre
        ]);
        return $this->pdo->lastInsertId();
    }

    public function updateTable($id, $nome, $descricao, $nome_do_mestre, $numero_max_jogadores, $categoria) {
        $stmt = $this->pdo->prepare("UPDATE mesas SET nome = ?, descricao = ?, nome_do_mestre = ?, max_capacity = ?, categoria = ? WHERE id = ?");
        $result = $stmt->execute([$nome, $descricao, $nome_do_mestre, $numero_max_jogadores, $categoria, $id]);
        return $result;
    }

    public function getUserNameById($user_id) {
        $stmt = $this->pdo->prepare("SELECT username FROM usuarios WHERE id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchColumn();
    }

    public function getTableById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM mesas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteUser($user_id, $mesa_id) {
        $stmt = $this->pdo->prepare("DELETE FROM mesa_usuarios WHERE user_id = ? AND mesa_id = ?");
        $stmt->execute([$user_id, $mesa_id]);
    }

    public function getTablesByUserId($user_id) {
        $stmt = $this->pdo->prepare("SELECT mesas.* FROM mesas JOIN mesa_usuarios ON mesas.id = mesa_usuarios.mesa_id WHERE mesa_usuarios.user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>