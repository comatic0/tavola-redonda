<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}
require '../../controllers/MesaController.php';
require '../../includes/db.php';

$mesaController = new MesaController($pdo);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $data_da_sessao = $_POST['data_da_sessao'];
    $max_capacity = $_POST['max_capacity'];
    $user_id = $_SESSION['user_id'];
    $mesaController->createMesa($nome, $descricao, $categoria, $data_da_sessao, $max_capacity, $user_id);
    header('Location: index.php');
    exit();
}
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<div class="form-container">
    <h2>Criar Nova Mesa</h2>
    <form action="add.php" method="post">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea>
        </div>
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria" required>
        </div>
        <div class="form-group">
            <label for="data_da_sessao">Data Da Sessão:</label>
            <input type="date" id="data_da_sessao" name="data_da_sessao" required>
        </div>
        <div class="form-group">
            <label for="max_capacity">Capacidade Máxima de Jogadores:</label>
            <input type="number" id="max_capacity" name="max_capacity" min="1" max="20" required>
        </div>
        <button type="submit" class="btn">Criar Mesa</button>
    </form>
</div>
<?php include '../../includes/footer.php'; ?>