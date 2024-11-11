<?php
session_start();
require '../../includes/db.php';
require '../../controllers/MesaController.php';

use controllers\MesaController;

$mesaController = new MesaController($pdo);
$mesas = $mesaController->getAllMesas();
$user_id = $_SESSION['user_id'] ?? null;
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<main>
    <script src="https://kit.fontawesome.com/e757553569.js" crossorigin="anonymous"></script>
    <section class="mesas-view animate-hero">
        <h1 class="evil-aura">Mesas de RPG</h1>
        <p>Essas são as mesas cadastradas.</p>
        <div class="mesas-list">
            <?php foreach ($mesas as $mesa): ?>
                <div class="mesa-item">
                    <span class="mesa-nome"><?php echo htmlspecialchars($mesa['nome']); ?></span>
                    <div class="mesa-botoes">
                        <button class="mesa-detalhes-btn" onclick="openPopup(<?php echo htmlspecialchars(json_encode($mesa)); ?>)">
                            <i class="fas fa-eye"></i> 
                        </button>
                    <a href="edit.php?id=<?php echo htmlspecialchars($mesa['id']); ?>" class="mesa-editar-btn">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    <a href="delete.php?id=<?php echo htmlspecialchars($mesa['id']); ?>" class="mesa-delete-btn">
                        <i class="fa-solid fa-trash"></i> 
                    </a>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>

        <!-- Pop-up para exibir detalhes -->
        <div id="mesa-popup" class="mesa-popup">
            <div class="popup-content">
                <span class="close-btn" onclick="closePopup()">&times;</span>
                <h2 id="popup-nome"></h2>
                <p id="popup-categoria"></p>
                <p id="popup-descricao"></p>
                <p id="popup-participantes"></p>
                <p id="popup-data"></p>
            </div>
        </div>
    </section>
</main>
<?php include '../../includes/footer.php'; ?>

<!-- JavaScript -->
<script>
    function openPopup(mesa) {
        // Exibir o pop-up
        const popup = document.getElementById('mesa-popup');
        popup.style.display = 'flex';

        // Preencher as informações no pop-up
        document.getElementById('popup-nome').textContent = "Nome: " + mesa.nome;
        document.getElementById('popup-categoria').textContent = "Categoria: " + mesa.categoria;
        document.getElementById('popup-descricao').textContent = "Descrição: " + mesa.descricao;
        document.getElementById('popup-participantes').textContent = "Participantes: " + mesa.max_capacity;
        document.getElementById('popup-data').textContent = "Data da Sessão: " + mesa.data_da_sessao;
    }

    function closePopup() {
        // Ocultar o pop-up
        const popup = document.getElementById('mesa-popup');
        popup.style.display = 'none';
    }
    
window.onclick = function(event) {
    const popup = document.getElementById('mesa-popup');
    if (event.target === popup) {
        popup.style.display = 'none';
    }
}

</script>

<?php include '../../includes/footer.php'; ?>