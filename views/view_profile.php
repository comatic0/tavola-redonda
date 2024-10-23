<?php
session_start();
require_once '../includes/db.php';
require_once '../models/User.php';
require_once '../models/Mesa.php';
require_once '../models/Ficha.php';

if (!isset($_GET['id'])) {
    header('Location: ../index.php');
    exit();
}

$user_id = $_GET['id'];

$userModel = new User($pdo);
$mesaModel = new Mesa($pdo);
$fichaModel = new Ficha($pdo);

$user = $userModel->getUserById($user_id);
$creationDate = $userModel->getUserCreationDate($user_id);
$tables = $mesaModel->getTablesByUserId($user_id);
$fichas = $fichaModel->getFichasByUserId($user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <?php include '../includes/nav.php'; ?>
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-header-image">
                <img src="../assets/profile_headers/<?php echo htmlspecialchars($user['header_image'] ?? 'default-header.jpg'); ?>" alt="Imagem de Cabeçalho">
            </div>
            <div class="profile-picture">
                <img src="../assets/profile_pictures/<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture">
            </div>
            <h1><?php echo htmlspecialchars($user['username']); ?></h1>
            <p>Data de criação do perfil: <?php echo htmlspecialchars($creationDate); ?></p>
        </div>
        <div class="profile-info">
            <p><?php echo htmlspecialchars($user['bio'] ?? ''); ?></p>
        </div>
        <div class="profile-tables">
            <h2>Mesas</h2>
            <?php if (!empty($tables)): ?>
                <ul>
                    <?php foreach ($tables as $table): ?>
                        <li><?php echo htmlspecialchars($table['nome']); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Este usuário não está em nenhuma mesa.</p>
            <?php endif; ?>
        </div>
        <div class="profile-fichas">
            <h2>Fichas</h2>
            <?php if (!empty($fichas)): ?>
                <ul>
                    <?php foreach ($fichas as $ficha): ?>
                        <li><?php echo htmlspecialchars($ficha['nome']); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Este usuário não possui nenhuma ficha.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>