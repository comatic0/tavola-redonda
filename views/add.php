<?php
require '../includes/db.php';
require '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $nome_do_mestre = $_POST['nome_do_mestre'];
    $numero_max_jogadores = $_POST['numero_max_jogadores'];
    $categoria = $_POST['categoria'] === 'Outro' ? $_POST['categoria_custom'] : $_POST['categoria'];

    addTable($pdo, $nome, $descricao, $nome_do_mestre, $numero_max_jogadores, $categoria);
    
    header('Location: index.php');
    exit();
}
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>

<h1 class="evil-aura">Adicionar Mesa de RPG</h1>
<p>Página de criação de mesa. Formulários marcados com * são obrigatórios.</p>
<div class="form-container">
    <form method="post">
        <label for="nome">*Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao"></textarea>
        <label for="nome_do_mestre">Mestre:</label>
        <input type="text" id="nome_do_mestre" name="nome_do_mestre">
        <label for="numero_max_jogadores">Número Máximo de Jogadores:</label>
        <input type="number" id="numero_max_jogadores" name="numero_max_jogadores" required>
        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria" onchange="toggleCustomCategory(this)">
            <option value="Fantasia">Fantasia</option>
            <option value="Sci-Fi">Sci-Fi</option>
            <option value="Terror">Terror</option>
            <option value="Outro">Outro / Não listado</option>
        </select>
        <input type="text" id="categoria_custom" name="categoria_custom" style="display:none;" placeholder="Digite a categoria">
        <button type="submit">Salvar</button>
        <button class="back-button" onclick="window.location.href='../index.php'">Voltar</button>
        </form>
    </div>

<?php include '../includes/footer.php'; ?>