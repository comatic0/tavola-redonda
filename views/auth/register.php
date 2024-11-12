<?php
session_start();
require '../../includes/db.php';
require '../../controllers/AuthController.php';

use controllers\AuthController;

$authController = new AuthController($pdo);
$steamApiKey = $config['STEAM_API_KEY'];
$steamApiKeyValid = !empty($steamApiKey) && strlen($steamApiKey) === 32;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $error = $authController->register($username, $email, $password);
}
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<div class="form-container animate-hero">
    <h2>Registrar</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="register.php" method="post">
        <div class="form-group">
            <label for="username">Nome de Usuário:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Senha:</label>
            <div class="password-container">
                <input type="password" id="password" name="password" required>
                <img src="../../assets/icons/eye-icon.png" class="toggle-password" onclick="togglePasswordVisibility('password')" alt="Mostrar Senha">
            </div>
        </div>
        <button type="submit" class="btn">Registrar</button>
    </form>
</div>
<?php include '../../includes/footer.php'; ?>
<script>
function togglePasswordVisibility(id) {
    const passwordField = document.getElementById(id);
    const toggleIcon = passwordField.nextElementSibling;
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.src = '../../assets/icons/eye-slash-icon.png';
    } else {
        passwordField.type = 'password';
        toggleIcon.src = '../../assets/icons/eye-icon.png';
    }
}
</script>