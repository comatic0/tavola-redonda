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
    $id = $_POST['id'];
    if (!is_numeric($id)) {
        die('Invalid ID');
    }
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $nome_do_mestre = $_POST['nome_do_mestre'];
    $numero_max_jogadores = $_POST['max_capacity'];
    $error = $mesaController->updateMesa($id, $nome, $descricao, $nome_do_mestre, $numero_max_jogadores, $categoria);
}
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<div class="form-container">
    <h2><?php echo $mesa['nome']?></h2>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($mesa['id']); ?>">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($mesa['nome']); ?>" required>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"><?php echo htmlspecialchars($mesa['descricao']); ?></textarea>
        <div class="form-group">
            <label for="nome_do_mestre">Mestre:</label>
            <input type="text" id="nome_do_mestre" name="nome_do_mestre" value="<?php echo htmlspecialchars($mesa['nome_do_mestre']); ?>" required>
        <div class="form-group">
            <label for="max_capacity">Número Máximo de Jogadores:</label>
            <input type="number" id="max_capacity" name="max_capacity" value="<?php echo htmlspecialchars($mesa['max_capacity']); ?>" required>
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria" value="<?php echo htmlspecialchars($mesa['categoria']); ?>" required>
        </div>
        <div class="form-group">
            <label for="categoria">Jogadores:</label>
            <?php
                $users = $mesaController->getMesaParticipants($mesa_id);
                foreach ($users as $user) {
                    echo htmlspecialchars($user['username']); 
                    ?>
                    <a class="btn-leave" href="delete-user.php?mesa_id=<?php echo htmlspecialchars($mesa['id']); ?>&user_id=<?php echo htmlspecialchars($user['id']); ?>">Tirar jogador</a>
                    <br>
                    <br>
                    <?php
                }   
            ?>     
        </div>
        <button type="submit" class="btn">Salvar</button>
        <br>
        <button class="btn" onclick="window.location.href='../index.php'">Voltar</button>
    </form>
</div>
<?php include '../../includes/footer.php'; ?>