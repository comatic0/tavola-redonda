<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}
require '../../controllers/FichaController.php';

$fichaController = new FichaController($pdo);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $classe = $_POST['classe'];
    $nivel = $_POST['nivel'];
    $raca = $_POST['raca'];
    $magias = $_POST ['magias'];
    $descricao = $_POST['descricao'];
    $error = $fichaController->createFicha($nome, $classe, $nivel, $raca, $magias, $descricao);
}
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<div class="form-container">
    <h2>Criar Personagem</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="create.php" method="post">
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
            <label for="magias">Magias:</label>
            <input type="text" id="magias" name="magias" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"></textarea>
        </div>
        <button type="submit" class="btn">Criar Personagem</button>
    </form>
</div>
<?php include '../../includes/footer.php'; ?>