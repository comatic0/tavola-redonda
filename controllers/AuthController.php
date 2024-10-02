<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../includes/db.php';

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
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