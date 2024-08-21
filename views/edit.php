<?php
require '../includes/db.php';
require '../includes/functions.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit();
}

$mesa = getTableById($pdo, $id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $nome_do_mestre = $_POST['nome_do_mestre'];
    $numero_max_jogadores = $_POST['numero_max_jogadores'];
    
    updateTable($pdo, $id, $nome, $descricao, $nome_do_mestre, $numero_max_jogadores);
    
    header('Location: index.php');
    exit();
}
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>

<h1>Editar Mesa de RPG</h1>
<form method="post">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($mesa['nome']); ?>" required>
    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="descricao"><?php echo htmlspecialchars($mesa['descricao']); ?></textarea>
    <label for="nome_do_mestre">Mestre:</label>
    <input type="text" id="nome_do_mestre" name="nome_do_mestre" value="<?php echo htmlspecialchars($mesa['nome_do_mestre']); ?>" required>
    <label for="numero_max_jogadores">Número Máximo de Jogadores:</label>
    <input type="number" id="numero_max_jogadores" name="numero_max_jogadores" value="<?php echo htmlspecialchars($mesa['numero_max_jogadores']); ?>" required>
    <button type="submit">Salvar</button>
</form>

<a href="../index.php">Voltar</a>

<?php include '../includes/footer.php'; ?>