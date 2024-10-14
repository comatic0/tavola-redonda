<?php
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createUser($username, $email, $password) {
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $password]);
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $username, $bio, $password, $profile_picture, $header_image) {
        $query = "UPDATE usuarios SET username = ?, bio = ?";
        $params = [$username, $bio];

        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query .= ", password = ?";
            $params[] = $hashedPassword;
        }

        if (!empty($profile_picture['name'])) {
            $profile_picture_filename = $profile_picture['name'];
            move_uploaded_file($profile_picture['tmp_name'], __DIR__ . "/../assets/profile_pictures/{$profile_picture_filename}");
            $query .= ", profile_picture = ?";
            $params[] = $profile_picture_filename;
        }

        if (!empty($header_image['name'])) {
            $header_image_filename = $header_image['name'];
            move_uploaded_file($header_image['tmp_name'], __DIR__ . "/../assets/profile_headers/{$header_image_filename}");
            $query .= ", header_image = ?";
            $params[] = $header_image_filename;
        }

        $query .= " WHERE id = ?";
        $params[] = $id;

        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($params);
    }
}
?>