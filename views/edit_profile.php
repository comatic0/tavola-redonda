<?php
session_start();
require_once '../includes/db.php';
require_once '../models/User.php';

use models\User;


if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

$userModel = new User($pdo);
$user = $userModel->getUserById($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $bio = $_POST['bio'];
    $password = $_POST['password'];
    $profile_picture = $_FILES['profile_picture'];
    $header_image = $_FILES['header_image'];

    // Update user information
    $userModel->updateUser($user['id'], $username, $bio, $password, $profile_picture, $header_image);

    // Update session profile picture if changed
    if ($profile_picture['name']) {
        $_SESSION['profile_picture'] = $profile_picture['name'];
    }

    header('Location: profile.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <?php include '../includes/nav.php'; ?>
    <div class="form-container">
        <h2>Editar Perfil</h2>
        <form action="edit_profile.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Nome de Usuário:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio" maxlength="150"><?php echo htmlspecialchars($user['bio']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="password">Nova Senha:</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="profile_picture">Foto de Perfil:</label>
                <input type="file" id="profile_picture" name="profile_picture">
            </div>
            <div class="form-group">
                <label for="header_image">Foto de Cabeçalho:</label>
                <input type="file" id="header_image" name="header_image">
            </div>
            <button type="submit" class="btn">Salvar</button>
        </form>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script>
        document.getElementById('profile_picture').addEventListener('change', function(event) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('user-profile-picture').src = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>
</body>
</html>