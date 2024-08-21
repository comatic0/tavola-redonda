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

function addTable($pdo, $nome, $descricao, $nome_do_mestre, $numero_max_jogadores) {
    try {
        $stmt = $pdo->prepare("INSERT INTO mesas (nome, descricao, nome_do_mestre, numero_max_jogadores) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nome, $descricao, $nome_do_mestre, $numero_max_jogadores]);
    } catch (PDOException $e) {
        return false;
    }
}

function updateTable($pdo, $id, $nome, $descricao, $nome_do_mestre, $numero_max_jogadores) {
    try {
        $stmt = $pdo->prepare("UPDATE mesas SET nome = ?, descricao = ?, nome_do_mestre = ?, numero_max_jogadores = ? WHERE id = ?");
        return $stmt->execute([$nome, $descricao, $nome_do_mestre, $numero_max_jogadores, $id]);
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