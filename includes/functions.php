<?php
/**
 * Summary of getAllTables
 * @param mixed $pdo
 * @return mixed
 */
function getAllTables($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM mesas");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
        }
}


function getUserByEmail($pdo, $email) {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function getUsersInTable($pdo, $mesa_id) {
    try {
        $stmt = $pdo->prepare("SELECT u.username FROM mesa_usuarios mu JOIN usuarios u ON mu.user_id = u.id WHERE mu.mesa_id = ?");
        $stmt->execute([$mesa_id]);
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

function addTable($pdo, $nome, $descricao, $nome_do_mestre, $numero_max_jogadores, $data_da_sessao, $categoria) {
    try {
        $stmt = $pdo->prepare("INSERT INTO mesas (nome, descricao, nome_do_mestre, numero_max_jogadores, data_da_sessao, categoria) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$nome, $descricao, $nome_do_mestre, $numero_max_jogadores, $data_da_sessao, $categoria]);
    } catch (PDOException $e) {
        return false;
    }
}

function updateTable($pdo, $id, $nome, $descricao, $nome_do_mestre, $numero_max_jogadores,$data_da_sessao, $categoria) {
    try {
        $stmt = $pdo->prepare("UPDATE mesas SET nome = ?, descricao = ?, nome_do_mestre = ?, numero_max_jogadores = ?, data_da_sessao = ?, categoria = ? WHERE id = ?");
        $result = $stmt->execute([$nome, $descricao, $nome_do_mestre, $numero_max_jogadores, $data_da_sessao, $categoria, $id]);
        
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
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        return false;
    }
}

function searchTables($pdo, $search) {
    $stmt = $pdo->prepare("SELECT * FROM mesas WHERE nome LIKE ? OR descricao LIKE ?");
    $stmt->execute(['%' . $search . '%', '%' . $search . '%']);
    return $stmt->fetchAll();
}

function getAllFichas($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM fichas");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
        }
}