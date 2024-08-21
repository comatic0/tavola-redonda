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
    
    updateTable($pdo, $id, $nome, $descricao);
    
    header('Location: index.php');
    exit();
}
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>

<h1 class="evil-aura">Editar Mesa de RPG</h1>
<p>Página de edição de mesa. Formulários marcados com * são obrigatórios.</p>
<div class="form-container">
    <form method="post">
        <label for="nome">*Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($mesa['nome']); ?>" required>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao"><?php echo htmlspecialchars($mesa['descricao']); ?></textarea>
        <button type="submit">Salvar</button>
    </form>
</div>

<a href="../index.php">Voltar</a>

<?php include '../includes/footer.php'; ?>
