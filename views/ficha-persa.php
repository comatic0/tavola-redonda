<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require '../includes/db.php';
require '../includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $classe = $_POST['classe'];
    $nivel = $_POST['nivel'];
    $raca = $_POST['raca'];
    $descricao = $_POST['descricao'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO fichas (nome, classe, nivel, raca, descricao, user_id) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$nome, $classe, $nivel, $raca, $descricao, $user_id])) {
        header('Location: ../views/index-ficha.php');
        exit();
    } else {
        $error = "Erro ao criar personagem.";
    }
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>
<div class="form-container">
    <h2>Criar Personagem</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="ficha-persa.php" method="post">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="classe">Classe:</label>
            <input type="text" id="classe" name="classe" required>
        </div>
        <div class="form-group">
            <label for="nivel">Nível:</label>
            <input type="number" id="nivel" name="nivel" required>
        </div>
        <div class="form-group">
            <label for="raca">Raça:</label>
            <input type="text" id="raca" name="raca" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"></textarea>
        </div>
        <button type="submit" class="btn">Criar Personagem</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>
