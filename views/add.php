<?php
require '../includes/db.php';
require '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $nome_do_mestre = $_POST['nome_do_mestre'];
    $numero_max_jogadores = $_POST['numero_max_jogadores'];

    addTable($pdo, $nome, $descricao, $nome_do_mestre, $numero_max_jogadores);
    
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
    <label for="nome_do_mestre">Mestre:</label>
    <input type="text" id="nome_do_mestre" name="nome_do_mestre">
    <label for="numero_max_jogadores">Número Máximo de Jogadores:</label>
    <input type="number" id="numero_max_jogadores" name="numero_max_jogadores" required>
    <button type="submit">Salvar</button>
</form>

<a href="../index.php">Voltar</a>

<?php include '../includes/footer.php'; ?>