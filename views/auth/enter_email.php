<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['email'] = $email;
        header('Location: complete_registration.php');
    } else {
        $error = 'Endereço e-mail inválido.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insira o seu E-mail</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <?php include '../../includes/header.php'; ?>
    <?php include '../../includes/nav.php'; ?>
    <div class="form-container">
        <h1>Insira o seu E-mail</h1>
        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        <form method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit" class="btn">Concluir</button>
        </form>
    </div>
    <?php include '../../includes/footer.php'; ?>
</body>
</html>