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
    public function updateUserBio($user_id, $bio) {
        $stmt = $this->pdo->prepare("UPDATE usuarios SET bio = :bio WHERE id = :id");
        $stmt->execute(['bio' => $bio, 'id' => $user_id]);
    }
    public function updateUsername($user_id, $username) {
        $stmt = $this->pdo->prepare("UPDATE usuarios SET username = :username WHERE id = :id");
        $stmt->execute(['username' => $username, 'id' => $user_id]);
    }
    public function updateUserPassword($user_id, $password) {
        $stmt = $this->pdo->prepare("UPDATE usuarios SET password = :password WHERE id = :id");
        $stmt->execute(['password' => $password, 'id' => $user_id]);
    }
    public function updateUserHeaderImage($user_id, $header_image) {
        $stmt = $this->pdo->prepare("UPDATE usuarios SET header_image = :header_image WHERE id = :id");
        $stmt->execute(['header_image' => $header_image, 'id' => $user_id]);
    }

    public function getUserCreationDate($user_id) {
        $stmt = $this->pdo->prepare("SELECT created_at FROM usuarios WHERE id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchColumn();
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