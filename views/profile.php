<?php
session_start();
require_once '../includes/db.php';
require_once '../models/User.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

$userModel = new User($pdo);
$user = $userModel->getUserById($_SESSION['user_id']);
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
        </div>
        <div class="profile-info">
            <p><?php echo htmlspecialchars($user['bio'] ?? ''); ?></p>
        </div>
        <div class="profile-actions">
            <a href="edit_profile.php" class="btn">Editar Perfil</a>
            <a href="#" class="btn">Seguir</a>
            <a href="#" class="btn">Mensagem</a>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>