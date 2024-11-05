<?php
function getSessionDate($user_id) {
    $db_path = realpath(__DIR__ . '/../sql/rpg.db'); // Ajuste o caminho para o banco de dados conforme necessário
    if ($db_path === false || !file_exists($db_path)) {
        error_log("Erro: Banco de dados não encontrado em $db_path");
        return null;
    }

    try {
        $pdo = new PDO('sqlite:' . $db_path); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("SELECT data_da_sessao FROM mesas WHERE user_id = :user_id LIMIT 1");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row['data_da_sessao'];
        }
    } catch (PDOException $e) {
        error_log("Erro ao conectar ao banco de dados: " . $e->getMessage());
    }
    return null; 
}

function isSessionApproaching($data_da_sessao) {
    $data_atual = new DateTime(); 
    $data_sessao = new DateTime($data_da_sessao); 
    $diferenca = $data_atual->diff($data_sessao);
    return $diferenca->days == 3 && $data_sessao > $data_atual;
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$data_da_sessao = getSessionDate($_SESSION['user_id']); 
$mensagem = ""; 
if ($data_da_sessao && isSessionApproaching($data_da_sessao)) {
    $mensagem = "A sua sessão está se aproximando em " . $data_da_sessao . "!";
} else {
    $mensagem = "Não há sessões próximas.";
}
?>