<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}
require '../../controllers/MapaController.php';

$mapaController = new MapaController($pdo);
$mapas = $mapaController->listarMapas();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $imagem = $_FILES['imagem'];
    $tipo = $_POST['tipo'];
    $user_id = $_SESSION['user_id'];
    $error = $mapaController->upload($nome, $imagem, $tipo);
}

?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<div class="table-view animate-hero">
    <h1>Mapas Criados</h1>
    <div class="map-container">
        <?php foreach ($mapas as $mapa): ?>
            <div class="map-item">
                <div class="map-details">
                    <h3><?php echo htmlspecialchars($mapa['nome']); ?></h3>
                    Mapa de <?php echo htmlspecialchars($mapa['tipo']); ?>
                </div>
                <img src="<?php echo htmlspecialchars($mapa['caminho']); ?>" alt="<?php echo htmlspecialchars($mapa['nome']); ?>" class="map-image">
                <div class="map-details">
                    <a href="delete.php?id=<?php echo $mapa['id']; ?>">Deletar</a>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="form-group">
            <h3>Adicionar novo mapa</h3>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <label for="nome">Nome do Mapa:</label>
                <input type="text" id="nome" name="nome" required>
                <label for="tipo">Tipo de Mapa:</label>
                <select id="tipo" name="tipo">
                    <option value="Mundo">Mundo</option>
                    <option value="Cidade">Cidade</option>
                    <option value="Dungeon">Dungeon</option>
                    <option value="Terreno">Terreno</option>
                </select>
                <label for="imagem">Escolha a imagem:</label>
                <input type="file" id="imagem" name="imagem" accept="image/*" required>
                <button type="submit" class="map-btn">Enviar</button>
            </form>
        </div>
    </div>
</div>
<?php include '../../includes/footer.php'; ?>