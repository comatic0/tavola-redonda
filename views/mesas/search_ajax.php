<?php
require '../../controllers/MesaController.php';
use controllers\MesaController;
$mesaController = new MesaController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $search = $_POST['search'];
    $mesas = $mesaController->searchTables($search);
    
    if (!empty($mesas)) {
        foreach ($mesas as $mesa) {
            echo '<div class="suggestion-item">';
            echo htmlspecialchars($mesa['nome']) . ' - ' . htmlspecialchars($mesa['nome_do_mestre']);
            echo '</div>';
        }
    } else {
        echo '<p class="no-results">-------</p>';
    }
}
?>

