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

    public function getUserBySteamId($steam_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE steam_id = ?");
        $stmt->execute([$steam_id]);
        return $stmt->fetch();
    }

    public function getUserById($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->execute(['id' => $user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user['profile_picture']) {
            $user['profile_picture'] = 'user-icon.png';
        }
        return $user;
    }

    public function createUser($username, $email, $password, $steam_id = null) {
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (username, email, password, steam_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $email, $password, $steam_id]);
    }

    public function updateUserProfilePicture($user_id, $profile_picture) {
        $stmt = $this->pdo->prepare("UPDATE usuarios SET profile_picture = :profile_picture WHERE id = :id");
        $stmt->execute(['profile_picture' => $profile_picture, 'id' => $user_id]);
    }
}
?>