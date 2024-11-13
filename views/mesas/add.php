<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}
require '../../controllers/MesaController.php';
require '../../includes/db.php';

$mesaController = new MesaController($pdo);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $data_da_sessao = $_POST['data_da_sessao'];
    $max_capacity = $_POST['max_capacity'];
    $mapas = $_POST['mapa_selecionado'];
    $user_id = $_SESSION['user_id'];
    $mesaController->createMesa($nome, $descricao, $categoria, $data_da_sessao, $max_capacity, $user_id);
    header('Location: index.php');
    exit();
}
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<div class="form-container animate-hero">
    <h2>Criar Nova Mesa</h2>
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
            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria" required>
        </div>
        <div class="form-group">
            <label for="data_da_sessao">Data Da Sessão:</label>
            <input type="date" id="data_da_sessao" name="data_da_sessao" required>
        </div>
        <div class="form-group">
            <label for="max_capacity">Capacidade Máxima de Jogadores:</label>
            <input type="number" id="max_capacity" name="max_capacity" min="1" max="20" required>
        </div>
        <div class="form-group">
            <label for="mapa">Selecionar Mapa:</label>
            <button type="button" id="openModalBtn" class="btn">Selecionar Mapa</button>
            <input type="hidden" id="mapa_selecionado" name="mapa_selecionado">
        </div>
        <button type="submit" class="btn">Criar Mesa</button>
    </form>
</div>

<div id="mapModal" class="mesa-popup">
    <div class="popup-content">
        <span class="close-btn" onclick="closePopup()">&times;</span>
        <h2>Escolha um Mapa</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Imagem</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="mapList"></tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('openModalBtn').onclick = function() {
        document.getElementById('mapModal').style.display = 'block';
        carregarMapas();
    };

    document.getElementsByClassName('close')[0].onclick = function() {
        document.getElementById('mapModal').style.display = 'none';
    };

    window.onclick = function(event) {
        if (event.target === document.getElementById('mapModal')) {
            document.getElementById('mapModal').style.display = 'none';
        }
    };

    function carregarMapas() {
    fetch('http://localhost/tavola-redonda/api_mapas.php')  
        .then(response => response.json())
        .then(data => {
            if (data && Array.isArray(data)) {
                const mapList = document.getElementById('mapList');
                mapList.innerHTML = '';
                data.forEach(mapa => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${mapa.id}</td>
                        <td>${mapa.nome}</td>
                        <td><img src="${mapa.caminho}" width="100"></td>
                        <td>${mapa.tipo}</td>
                        <td><button onclick="selecionarMapa(${mapa.id}, '${mapa.nome}')">Selecionar</button></td>
                    `;
                    mapList.appendChild(row);
                });
            } else {
                console.error('Formato de dados inesperado:', data);
            }
        })
        .catch(error => console.error('Erro ao carregar mapas:', error));
    };

    function selecionarMapa(id, nome) {
    document.getElementById('mapa_selecionado').value = id;  // Preenche o campo oculto com o ID do mapa
    document.getElementById('openModalBtn').innerText = `Mapa Selecionado: ${nome}`; // Atualiza o texto do botão
    document.getElementById('mapModal').style.display = 'none';  // Fecha o modal
    };
</script>

<?php include '../../includes/footer.php'; ?>