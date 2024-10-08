<?php
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function getUserByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function createUser($username, $email, $password) {
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $password]);
    }
}
?>