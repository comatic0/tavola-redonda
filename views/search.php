<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require '../includes/db.php';
require '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search = $_POST['search'];
    $filter = $_POST['filter'];  
    $mesas = searchTables($pdo, $search, $filter);  
}


?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>

<div class="form-container">
    <h2>Buscar Mesas</h2>
    <form action="search.php" method="post">
        <div class="form-group" style="display: flex; align-items: center;">
            <label for="search">Procurar mesa:</label>
            <input type="text" id="search" name="search" required>
            <select id="filter" name="filter" class="form-select" style="margin-left: 10px;">
                <option value="nome_mesa">Nome da Mesa</option>
                <option value="nome_mestre">Nome do Mestre</option>
                <option value="categoria">Categoria</option>
            </select>
        </div>
        <button type="submit" class="btn">Buscar</button>
    </form>
</div>


<div class="mesas-list">
    <?php if (!empty($mesas)): ?>
        <h3>Resultados da busca:</h3>
        <div class="table_results">
            <?php foreach ($mesas as $mesa): ?>
                <div class="table_card">
                    <?php echo htmlspecialchars($mesa['nome']); ?> -----
                    <?php echo htmlspecialchars($mesa['nome_do_mestre']); ?>
                    <a href= "<?php echo $base_path; ?>/views/join.php" class="btn">Visualizar</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>
            <div class="table_card">
            Nenhuma mesa encontrada.
            </div>
        </p>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
