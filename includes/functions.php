<?php
function getAllTables($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM mesas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return false;
    }
}

function getTableById($pdo, $id) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM mesas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return false;
    }
}

function addTable($pdo, $nome, $descricao, $nome_do_mestre, $numero_max_jogadores, $categoria) {
    try {
        $stmt = $pdo->prepare("INSERT INTO mesas (nome, descricao, nome_do_mestre, numero_max_jogadores, categoria) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nome, $descricao, $nome_do_mestre, $numero_max_jogadores, $categoria]);
    } catch (PDOException $e) {
        return false;
    }
}

function addTableForm($pdo) {
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
}

addTableForm($pdo);

function updateTable($pdo, $id, $nome, $descricao, $nome_do_mestre, $numero_max_jogadores, $categoria) {
    try {
        $stmt = $pdo->prepare("UPDATE mesas SET nome = ?, descricao = ?, nome_do_mestre = ?, numero_max_jogadores = ?, categoria = ? WHERE id = ?");
        return $stmt->execute([$nome, $descricao, $nome_do_mestre, $numero_max_jogadores, $categoria, $id]);
    } catch (PDOException $e) {
        return false;
    }
}

function deleteTable($pdo, $id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM mesas WHERE id = ?");
        return $stmt->execute([$id]);
    } catch (PDOException $e) {
        return false;
    }
}
?>