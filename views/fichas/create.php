<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}
require '../../controllers/FichaController.php';
require '../../includes/db.php'; // Adicionar a inclusão do arquivo de conexão com o banco de dados
use controllers\FichaController;

$fichaController = new FichaController($pdo);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $classe = $_POST['classe'];
    $nivel = $_POST['nivel'];
    $raca = $_POST['raca'];
    $magias = $_POST['magias'];
    $descricao = $_POST['descricao'];
    $user_id = $_SESSION['user_id']; // Adicionar o user_id
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
        $imagem_path = '../../assets/personagens_pictures/user-icon.png';
    }
    $error = $fichaController->createFicha($nome, $classe, $nivel, $raca, $magias, $descricao, $imagem_path, $user_id); // Passar o user_id
}
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<div class="form-container animate-hero">
    <h2>Criar Personagem</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="create.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="classe">Classe:</label>
            <input type="text" id="classe" name="classe" required>
        </div>
        <div class="form-group">
            <label for="nivel">Nível:</label>
            <input type="number" id="nivel" name="nivel" required>
        </div>
        <div class="form-group">
            <label for="raca">Raça:</label>
            <input type="text" id="raca" name="raca" required>
        </div>
        <div class="form-group">
            <label for="magias">Magias:</label>
            <input type="text" id="magias" name="magias" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"></textarea>
        </div>
        <div class="form-group">
            <label for="imagem">Imagem:</label>
            <input type="file" id="imagem" name="imagem">
        </div>
        <button type="submit" class="btn">Criar Personagem</button>
    </form>
    <p>Criado por: <a href="../profile.php?id=<?php echo $_SESSION['user_id']; ?>"><?php echo htmlspecialchars($_SESSION['user_id']); ?></a></p>
</div>
<?php include '../../includes/footer.php'; ?>