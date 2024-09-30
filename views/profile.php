<?php
session_start();
require '../includes/db.php';
require '../includes/functions.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$user = getUserById($pdo, $user_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_picture'])) {
    $file = $_FILES['profile_picture'];
    $maxFileSize = 128 * 1024; // 128 KB

    if ($file['type'] === 'image/png' && $file['size'] <= $maxFileSize) {
        $username = $user['username'];
        $target_dir = "../assets/profile_pictures/";
        $target_file = $target_dir . $username . ".png";
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            updateUserProfilePicture($pdo, $user_id, $username . ".png");
            $_SESSION['profile_picture'] = $username . ".png";
            header('Location: profile.php'); // Refresh the page
            exit();
        } else {
            $error = "Erro ao fazer upload da imagem.";
        }
    } else {
        $error = "A imagem deve ser um PNG e ter no máximo 128 KB.";
    }
}

function getUserById($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateUserProfilePicture($pdo, $user_id, $filename) {
    $stmt = $pdo->prepare("UPDATE usuarios SET profile_picture = ? WHERE id = ?");
    $stmt->execute([$filename, $user_id]);
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>

<div class="form-container">
    <h2>Meu Perfil</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="profile.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="profile_picture">Foto de Perfil:</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/png" required>
        </div>
        <button type="submit" class="btn">Atualizar Foto</button>
    </form>
    <div class="user-profile">
        <img src="<?php echo $base_path; ?>/assets/profile_pictures/<?php echo $_SESSION['profile_picture'] ?? 'user-icon.png'; ?>" alt="User Icon">
        <p><?php echo htmlspecialchars($user['username']); ?></p>
    </div>
</div>

<?php include '../includes/footer.php'; ?>