<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}
require '../../controllers/FichaController.php';
require '../../includes/db.php';
use controllers\FichaController;

$fichaController = new FichaController($pdo);
$classes = $fichaController->fetchDndData('classes');
$races = $fichaController->fetchDndData('races');
$ficha_id = $_GET['id'] ?? null;

if (!$ficha_id) {
    echo "Invalid ID";
    exit();
}

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
    $magias = $_POST['magias'];
    $descricao = $_POST['descricao'];
    if (!empty($_FILES['imagem']['name'])) {
        $imagem = $_FILES['imagem']['name'];
        $imagem_tmp = $_FILES['imagem']['tmp_name'];
        $imagem_path = '../../assets/personagens_pictures/' . $imagem;
        // Verificar se a pasta de destino existe, se não, criar a pasta
        if (!is_dir('../../assets/personagens_pictures')) {
            mkdir('../../assets/personagens_pictures', 0777, true);
        }
        if (move_uploaded_file($imagem_tmp, $imagem_path)) {
            echo "Imagem enviada com sucesso.";
        } else {
            echo "Erro ao enviar a imagem.";
        }
    } else {
        $imagem_path = $ficha['imagem'] ?: '../../assets/personagens_pictures/user-icon.png';
    }
    $error = $fichaController->updateFicha($id, $nome, $classe, $nivel, $raca, $magias, $descricao, $imagem_path);

    $stmt = $pdo->prepare("UPDATE fichas SET nome = ?, classe = ?, nivel = ?, magias = ?, raca = ?, descricao = ? WHERE id = ? AND user_id = ?");
    if ($stmt->execute([$nome, $classe, $nivel, $raca, $magias, $descricao, $ficha_id, $user_id])) {
        header('Location: mesa.php?id=' . $ficha['mesa_id']);
        exit();
    } else {
        $error = "Erro ao atualizar ficha.";
    }
}
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<div class="form-container">
    <h2>Editar Ficha de Personagem</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="edit.php?id=<?php echo $ficha_id; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $ficha_id; ?>">
        <div class="form-group">
            <label for="nome">Nome do Personagem:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($ficha['nome']); ?>" required>
        </div>
        <div class="form-group">
            <label for="classe">Classe:</label>
            <select id="classe" name="classe" required>
                <?php foreach ($classes['results'] as $class): ?>
                    <option value="<?php echo $class['name']; ?>" <?php echo $class['name'] == $ficha['classe'] ? 'selected' : ''; ?>><?php echo $class['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nivel">Nível:</label>
            <input type="number" id="nivel" name="nivel" value="<?php echo htmlspecialchars($ficha['nivel']); ?>" required>
        </div>
        <div class="form-group">
            <label for="raca">Raça:</label>
            <select id="raca" name="raca" required>
                <?php foreach ($races['results'] as $race): ?>
                    <option value="<?php echo $race['name']; ?>" <?php echo $race['name'] == $ficha['raca'] ? 'selected' : ''; ?>><?php echo $race['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="magias">Magias:</label>
            <input type="text" id="magias" name="magias" value="<?php echo htmlspecialchars($ficha['magias']); ?>" required>
        </div>
        <div class="form-group">
            <label for="imagem">Imagem:</label>
            <input type="file" id="imagem" name="imagem">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required><?php echo htmlspecialchars($ficha['descricao']); ?></textarea>
        </div>
        <button type="submit" class="btn">Salvar Alterações</button>
    </form>
</div>
<?php include '../../includes/footer.php'; ?>