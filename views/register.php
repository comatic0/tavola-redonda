<?php
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificação de formato de e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Formato de e-mail inválido.";
        exit();
    }

    // Verificação de comprimento da senha
    if (strlen($password) < 6) {
        echo "A senha deve ter no mínimo 6 caracteres.";
        exit();
    }

    // Verificação de duplicação de nome de usuário e e-mail
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo "Nome de usuário ou e-mail já existe.";
        exit();
    }

    // Hash da senha
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Inserção do novo usuário
    $stmt = $pdo->prepare("INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $email, $passwordHash])) {
        echo "Usuário registrado com sucesso!";
    } else {
        echo "Erro ao registrar usuário.";
    }
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>

<div class="form-container">
    <h2>Registrar-se</h2>
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
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn">Registrar</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>