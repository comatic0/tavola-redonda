<?php
session_start();
require '../includes/db.php';
require '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = getUserByEmail($pdo, $email);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['profile_picture'] = $user['profile_picture'] ?? 'user-icon.png';
        header('Location: ../index.php');
        exit();
    } else {
        $error = "Email ou senha incorretos.";
    }
}
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>
<div class="form-container">
    <h2>Logar</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="login.php" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn">Logar</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>