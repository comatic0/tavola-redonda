<?php
namespace controllers;
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../includes/db.php';
use models\User;

class AuthController{
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
            $user = $this->userModel->getUserByEmail($email);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['profile_picture'] = $user['profile_picture'] ?? 'user-icon.png';
                header('Location: ../../index.php');
                exit();
            }
        } else {
            return "Erro ao registrar usuário.";
        }
    }

    public function login($email, $password, $rememberMe = false) {
        $user = $this->userModel->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['profile_picture'] = $user['profile_picture'] ?? 'user-icon.png';
    
            if ($rememberMe) {
                setcookie('user_id', $user['id'], time() + (86400 * 30), "/"); // 30 days
                setcookie('username', $user['username'], time() + (86400 * 30), "/");
                setcookie('profile_picture', $user['profile_picture'] ?? 'user-icon.png', time() + (86400 * 30), "/");
            }
    
            header('Location: ../../index.php');
            exit();
        } else {
            return "Email ou senha incorretos.";
        }
    }

    public function logout() {
        session_start();
        session_destroy();
    
        // Remove cookies
        setcookie('user_id', '', time() - 3600, "/");
        setcookie('username', '', time() - 3600, "/");
        setcookie('profile_picture', '', time() - 3600, "/");
    
        header('Location: ../auth/login.php');
        exit();
    }
}
?>