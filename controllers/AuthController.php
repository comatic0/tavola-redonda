<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../includes/db.php';

class AuthController {
    private $pdo;
    private $userModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
    }

    
    public function getUserByEmail($pdo, $email) {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registerWithSteam($steam_id, $username, $email, $hashedPassword, $profile_picture_filename) {
        if ($this->userModel->createUser($username, $email, $hashedPassword, $steam_id)) {
            $user = $this->userModel->getUserBySteamId($steam_id);
            $this->userModel->updateUserProfilePicture($user['id'], $profile_picture_filename);
            return $user;
        } else {
            return null;
        }
    }

    public function fetchSteamData($steam_id) {
        $config = json_decode(file_get_contents(__DIR__ . '/../config.json'), true);
        $apiKey = $config['STEAM_API_KEY'];
        $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key={$apiKey}&steamids={$steam_id}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (isset($data['response']['players'][0])) {
            $player = $data['response']['players'][0];
            return [
                'personaname' => $player['personaname'],
                'avatarfull' => $player['avatarfull']
            ];
        } else {
            return null;
        }
    }

    public function loginWithSteam($steam_id) {
        return $this->userModel->getUserBySteamId($steam_id);
    }

    private function resizeImage($url, $width, $height) {
        $image = imagecreatefromjpeg($url);
        if (!$image) {
            $image = imagecreatefrompng($url);
        }
        if (!$image) {
            $image = imagecreatefromgif($url);
        }
        if (!$image) {
            throw new Exception('Unsupported image format.');
        }
        $resized_image = imagescale($image, $width, $height);
        ob_start();
        imagejpeg($resized_image);
        $image_data = ob_get_contents();
        ob_end_clean();
        return 'data:image/jpeg;base64,' . base64_encode($image_data);
    }

    public function getUserById($user_id) {
        $stmt = $this->userModel->getUserById($user_id);
        return $stmt;
    }

    public function register($username, $email, $password) {
        if ($this->userModel->getUserByEmail($email)) {
            return "Email já está em uso.";
        }
        if ($this->userModel->getUserByUsername($username)) {
            return "Nome de usuário já está em uso.";
        }
        if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
            return "A senha deve ter pelo menos 8 caracteres, incluindo uma letra maiúscula e um número.";
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if ($this->userModel->createUser($username, $email, $hashedPassword)) {
            header('Location: ../auth/login.php');
            exit();
        } else {
            return "Erro ao registrar usuário.";
        }
    }

    public function login($email, $password) {
        $user = $this->userModel->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['profile_picture'] = $user['profile_picture'] ?? 'user-icon.png';
            header('Location: ../../index.php');
            exit();
        } else {
            return "Email ou senha incorretos.";
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: ../auth/login.php');
        exit();
    }
}
?>