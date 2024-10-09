<?php
session_start();
require '../../controllers/AuthController.php';
require '../../includes/db.php';

$authController = new AuthController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $error = $authController->register($username, $email, $password);
}
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<div class="form-container">
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
            <div class="password-wrapper">
                <input type="password" id="password" name="password" required oninput="checkPasswordStrength()">
                <span class="toggle-password" onclick="togglePasswordVisibility()">
                    <img src="../../assets/icons/eye-icon.png" alt="Toggle Password">
                </span>
            </div>
            <div id="password-strength" class="password-strength"></div>
        </div>
        <button type="submit" class="btn">Registrar</button>
    </form>
    <div class="steam-login">
        <a href="steam_register.php" class="btn">Registrar com Steam</a>
    </div>
</div>
<?php include '../../includes/footer.php'; ?>
<script>
function checkPasswordStrength() {
    const password = document.getElementById('password').value;
    const strengthBar = document.getElementById('password-strength');
    let strength = 0;
    if (password.length >= 8) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;
    strengthBar.style.width = (strength * 25) + '%';
    strengthBar.style.backgroundColor = ['red', 'orange', 'yellow', 'green'][strength - 1];
}

function togglePasswordVisibility() {
    const passwordField = document.getElementById('password');
    const toggleIcon = document.querySelector('.toggle-password img');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.src = '../../assets/icons/eye-slash-icon.png';
    } else {
        passwordField.type = 'password';
        toggleIcon.src = '../../assets/icons/eye-icon.png';
    }
}
</script>
