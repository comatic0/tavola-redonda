<?php
session_start();
require '../includes/db.php';
require '../controllers/AuthController.php';
require '../models/User.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$authController = new AuthController($pdo);
$userModel = new User($pdo);
$user_id = $_SESSION['user_id'];
$user = $authController->getUserById($user_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_picture'])) {
    $file = $_FILES['profile_picture'];
    $maxFileSize = 128 * 1024; // 128 KB
    if ($file['type'] === 'image/png' && $file['size'] <= $maxFileSize) {
        $username = $user['username'];
        $target_dir = "../assets/profile_pictures/";
        $target_file = $target_dir . $username . ".png";
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            $userModel->updateUserProfilePicture($user_id, $username . ".png");
            $_SESSION['profile_picture'] = $username . ".png";
            header('Location: profile.php'); // Refresh the page
            exit();
        }
    }
}
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>
<main>
    <section class="profile-view">
        <h1>Perfil do Usuário</h1>
        <div class="user-profile">
            <img src="<?php echo $base_path; ?>/assets/profile_pictures/<?php echo htmlspecialchars($user['profile_picture'] ?? 'user-icon.png'); ?>" alt="Profile Picture">
            <div>
                <h2><?php echo htmlspecialchars($user['username']); ?></h2>
                <p><?php echo htmlspecialchars($user['email']); ?></p>
            </div>
        </div>
        <form action="profile.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="profile_picture">Alterar Foto de Perfil:</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/png">
            </div>
            <button type="submit" class="btn">Atualizar Perfil</button>
        </form>
    </section>
</main>
<?php include '../includes/footer.php'; ?>