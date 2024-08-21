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
    $categoria = $_POST['categoria'] === 'Outro' ? $_POST['categoria_custom'] : $_POST['categoria'];
    
    updateTable($pdo, $id, $nome, $descricao, $nome_do_mestre, $numero_max_jogadores, $categoria);
    
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
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($mesa['nome']); ?>" required>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao"><?php echo htmlspecialchars($mesa['descricao']); ?></textarea>
        <label for="nome_do_mestre">Mestre:</label>
        <input type="text" id="nome_do_mestre" name="nome_do_mestre" value="<?php echo htmlspecialchars($mesa['nome_do_mestre']); ?>" required>
        <label for="numero_max_jogadores">Número Máximo de Jogadores:</label>
        <input type="number" id="numero_max_jogadores" name="numero_max_jogadores" value="<?php echo htmlspecialchars($mesa['numero_max_jogadores']); ?>" required>
        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria" onchange="toggleCustomCategory(this)">
            <option value="Fantasia" <?php echo $mesa['categoria'] === 'Fantasia' ? 'selected' : ''; ?>>Fantasia</option>
            <option value="Sci-Fi" <?php echo $mesa['categoria'] === 'Sci-Fi' ? 'selected' : ''; ?>>Sci-Fi</option>
            <option value="Terror" <?php echo $mesa['categoria'] === 'Terror' ? 'selected' : ''; ?>>Terror</option>
            <option value="Outro" <?php echo !in_array($mesa['categoria'], ['Fantasia', 'Sci-Fi', 'Terror']) ? 'selected' : ''; ?>>Outro / Não listado</option>
        </select>
        <input type="text" id="categoria_custom" name="categoria_custom" style="display:<?php echo !in_array($mesa['categoria'], ['Fantasia', 'Sci-Fi', 'Terror']) ? 'block' : 'none'; ?>;" placeholder="Digite a categoria" value="<?php echo !in_array($mesa['categoria'], ['Fantasia', 'Sci-Fi', 'Terror']) ? htmlspecialchars($mesa['categoria']) : ''; ?>">
        <button type="submit">Salvar</button>
        <button class="back-button" onclick="window.location.href='../index.php'">Voltar</button>
    </form>
</div>

<script>
function toggleCustomCategory(select) {
    var customCategoryInput = document.getElementById('categoria_custom');
    if (select.value === 'Outro') {
        customCategoryInput.style.display = 'block';
    } else {
        customCategoryInput.style.display = 'none';
    }
}
</script>

<?php include '../includes/footer.php'; ?>