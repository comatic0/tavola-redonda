<?php
require '../includes/db.php';
require '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    addTable($pdo, $nome, $descricao);
    
    header('Location: index.php');
    exit();
}
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>

<h1>Adicionar Mesa de RPG</h1>
<form method="post">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required>
    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="descricao"></textarea>
    <button type="submit">Salvar</button>
</form>

<a href="../index.php">Voltar</a>

<?php include '../includes/footer.php'; ?>
