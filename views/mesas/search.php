<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}
require '../../controllers/MesaController.php';
$mesaController = new MesaController($pdo);
$mesas = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search = $_POST['search'];
    $mesas = $mesaController->searchTables($search);
}
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<div class="form-container animate-hero">
    <h2>Buscar Mesas</h2>
    <form action="search.php" method="post" id="search-form">
        <div class="form-group">
            <label for="search">Procurar mesa:</label>
            <input type="text" id="search" name="search" required autocomplete="off">
        </div>

        <!-- Menu suspenso para selecionar o filtro 
        <div class="form-group">
            <label for="filter">Filtrar por:</label>
            <select id="filter" name="filter">
                <option value="name" selected>Nome</option>
                <option value="descricao">Descrição</option>
            </select>
        </div> -->
        
        <!-- Botão de submit -->
        <button type="submit" class="btn">Buscar</button>
    </form>
</div>
<div class="mesas-list animate-hero">
    <?php if (!empty($mesas)): ?>
        <h3>Resultados da busca:</h3>
        <div class="table_results">
            <?php foreach ($mesas as $mesa): ?>
                <div class="table_card">
                    <?php echo htmlspecialchars($mesa['nome']); ?> -----
                    <?php echo htmlspecialchars($mesa['nome_do_mestre']); ?>
                    <a href="<?php echo $base_path; ?>/views/mesas/join.php" class="btn">Visualizar</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>Nenhuma mesa encontrada.</p>
    <?php endif; ?>
</div>

<script>
    document.getElementById('search').addEventListener('input', function() {
        var searchQuery = this.value;
        
        if (searchQuery.length > 2) { // Busca após 3 caracteres
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'search_ajax.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById('suggestions').innerHTML = this.responseText;
                }
            };

            xhr.send('search=' + encodeURIComponent(searchQuery));
        } else {
            document.getElementById('suggestions').innerHTML = ''; // Limpa as sugestões se menos de 3 caracteres
        }
    });
</script>

<div id="suggestions"></div>

<?php include '../../includes/footer.php'; ?>