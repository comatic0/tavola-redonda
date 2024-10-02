<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}
require '../../controllers/MesaController.php';

$mesaController = new MesaController($pdo);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $error = $mesaController->createMesa($nome, $categoria, $descricao);
}
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<div class="form-container">
    <h2>Criar Mesa</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="add.php" method="post">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <select id="categoria" name="categoria" onchange="toggleCustomCategory(this)">
                <option value="Fantasia">Fantasia</option>
                <option value="Sci-Fi">Sci-Fi</option>
                <option value="Terror">Terror</option>
                <option value="Outro">Outro</option>
            </select>
            <input type="text" id="categoria_custom" name="categoria_custom" style="display:none;" placeholder="Digite a categoria">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"></textarea>
        </div>
        <button type="submit" class="btn">Criar Mesa</button>
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
<?php include '../../includes/footer.php'; ?>