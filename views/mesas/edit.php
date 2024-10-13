<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}
require '../../controllers/MesaController.php';

$mesaController = new MesaController($pdo);
$mesa_id = $_GET['id'] ?? null;
$mesa = $mesaController->getMesaById($mesa_id);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $error = $mesaController->updateMesa($mesa_id, $nome, $categoria, $descricao);
}
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<div class="form-container">
    <h2>Editar Mesa</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="edit.php?id=<?php echo $mesa_id; ?>" method="post">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($mesa['nome']); ?>" required>
        </div>
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <select id="categoria" name="categoria" onchange="toggleCustomCategory(this)">
                <option value="Fantasia" <?php echo $mesa['categoria'] === 'Fantasia' ? 'selected' : ''; ?>>Fantasia</option>
                <option value="Sci-Fi" <?php echo $mesa['categoria'] === 'Sci-Fi' ? 'selected' : ''; ?>>Sci-Fi</option>
                <option value="Terror" <?php echo $mesa['categoria'] === 'Terror' ? 'selected' : ''; ?>>Terror</option>
                <option value="Outro" <?php echo !in_array($mesa['categoria'], ['Fantasia', 'Sci-Fi', 'Terror']) ? 'selected' : ''; ?>>Outro</option>
            </select>
            <input type="text" id="categoria_custom" name="categoria_custom" style="display:<?php echo !in_array($mesa['categoria'], ['Fantasia', 'Sci-Fi', 'Terror']) ? 'block' : 'none'; ?>;" placeholder="Digite a categoria" value="<?php echo !in_array($mesa['categoria'], ['Fantasia', 'Sci-Fi', 'Terror']) ? htmlspecialchars($mesa['categoria']) : ''; ?>">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"><?php echo htmlspecialchars($mesa['descricao']); ?></textarea>
        </div>
        <button type="submit" class="btn">Salvar</button>
        <button class="back-button" onclick="window.location.href='../index.php'">Voltar</button>
    </form>
</div>
<div class="form-group">
            <label for="data_da_sessao">Data Da Sessão:</label>
            <input type="date" id="data_da_sessao" name="data_da_sessao" required>
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
<?php include '../../includes/footer.php'; ?>