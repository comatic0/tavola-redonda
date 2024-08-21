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

function updateTable($pdo, $id, $nome, $descricao, $nome_do_mestre, $numero_max_jogadores, $categoria) {
    try {
        $stmt = $pdo->prepare("UPDATE mesas SET nome = ?, descricao = ?, nome_do_mestre = ?, numero_max_jogadores = ?, categoria = ? WHERE id = ?");
        $result = $stmt->execute([$nome, $descricao, $nome_do_mestre, $numero_max_jogadores, $categoria, $id]);
        
        if ($result) {
            error_log("Table with ID $id updated successfully.");
        } else {
            error_log("Failed to update table with ID $id.");
        }
        
        return $result;
    } catch (PDOException $e) {
        error_log("PDOException: " . $e->getMessage());
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