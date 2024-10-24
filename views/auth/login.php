<?php
session_start();
require '../../includes/db.php';
require '../../controllers/AuthController.php';

$authController = new AuthController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;
    $rememberMe = isset($_POST['remember_me']);

    if ($username && $password) {
        $loginSuccess = $authController->login($username, $password, $rememberMe);
        if ($loginSuccess) {
            header('Location: ../../index.php');
            exit();
        } else {
            $error = 'Nome de usuário ou senha incorretos.';
        }
    } else {
        $error = 'Por favor, preencha todos os campos.';
    }
}

$steamApiKeyValid = !empty($config['steam_api_key']);
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<div class="form-container animate-hero">
    <h2>Login</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="login.php" method="post">
        <div class="form-group">
            <label for="username">Email:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group remember-me">
            <label for="remember_me">Lembrar-me</label>
            <input type="checkbox" align="left" id="remember_me" name="remember_me">
    </div>
        <button type="submit" class="btn">Logar</button>
    </form>
    <div class="steam-login <?php echo !$steamApiKeyValid ? 'btn-disabled' : ''; ?>">
        <a href="steam_login.php" class="btn btn-steam" <?php echo !$steamApiKeyValid ? 'onclick="return false;"' : ''; ?>>
            <img src="../../assets/icons/steam-logo.png" alt="Steam Logo">
            Logar com Steam
        </a>
    </div>
</div>
<?php include '../../includes/footer.php'; ?>