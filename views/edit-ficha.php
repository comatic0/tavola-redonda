<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header('Location: ../auth/login.php');
    exit();
}
require '../../controllers/FichaController.php';
require '../includes/db.php';

$fichaController = new FichaController($pdo);
$ficha_id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$ficha = $fichaController->getFichaById($ficha_id);

$stmt = $pdo->prepare("SELECT * FROM fichas WHERE id = ? AND user_id = ?");
$stmt->execute([$ficha_id, $user_id]);
$ficha = $stmt->fetch();

if (!$ficha) {
    echo "Ficha não encontrada ou você não tem permissão para editá-la.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    if (!is_numeric($id)) {
        die('Invalid ID');
    }
    $nome = $_POST['nome'];
    $classe = $_POST['classe'];
    $nivel = $_POST['nivel'];
    $raca = $_POST['raca'];
    $descricao = $_POST['descricao'];
    $error = $fichaController->updateFicha($nome, $classe, $nivel, $raca, $descricao, $atributos);

    $stmt = $pdo->prepare("UPDATE fichas SET nome = ?, classe = ?, nivel = ?, atributos = ? WHERE id = ? AND user_id = ?");
    if ($stmt->execute([$nome, $classe, $nivel, $atributos, $ficha_id, $user_id])) {
        header('Location: mesa.php?id=' . $ficha['mesa_id']);
        exit();
    } else {
        $error = "Erro ao atualizar ficha.";
    }
}
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>
<div class="form-container">
    <h2>Editar Ficha de Personagem</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="edit-ficha.php?id=<?php echo $ficha_id; ?>" method="post">
        <div class="form-group">
            <label for="nome">Nome do Personagem:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($ficha['nome']); ?>" required>
        </div>
        <div class="form-group">
            <label for="classe">Classe:</label>
            <input type="text" id="classe" name="classe" value="<?php echo htmlspecialchars($ficha['classe']); ?>" required>
        </div>
        <div class="form-group">
            <label for="nivel">Nível:</label>
            <input type="number" id="nivel" name="nivel" value="<?php echo htmlspecialchars($ficha['nivel']); ?>" required>
        </div>
        <div class="form-group">
            <label for="atributos">Atributos:</label>
            <textarea id="atributos" name="atributos" required><?php echo htmlspecialchars($ficha['atributos']); ?></textarea>
        </div>
        <button type="submit" class="btn">Salvar Alterações</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>