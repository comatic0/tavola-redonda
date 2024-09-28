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
    $descricao = $_POST['descricao'];
    $nome_do_mestre = $_POST['nome_do_mestre'];
    $numero_max_jogadores = $_POST['numero_max_jogadores'];
    $categoria = $_POST['categoria'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO mesas (nome, descricao, nome_do_mestre, numero_max_jogadores, categoria, user_id) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$nome, $descricao, $nome_do_mestre, $numero_max_jogadores, $categoria, $user_id])) {
        header('Location: ../views/index.php');
        exit();
    } else {
        $error = "Erro ao criar mesa.";
    }
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>
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
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea>
        </div>
        <div class="form-group">
            <label for="nome_do_mestre">Nome do Mestre:</label>
            <input type="text" id="nome_do_mestre" name="nome_do_mestre" required>
        </div>
        <div class="form-group">
            <label for="numero_max_jogadores">Número Máximo de Jogadores:</label>
            <input type="number" id="numero_max_jogadores" name="numero_max_jogadores" required>
        </div>
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria" required>
        </div>
        <button type="submit" class="btn">Criar</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>