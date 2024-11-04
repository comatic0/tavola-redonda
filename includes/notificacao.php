<?php
function getSessionDate($user_id) {
    try {
        $pdo = new PDO('sqlite:rpg.db'); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("SELECT data_da_sessao FROM mesas WHERE user_id = :user_id LIMIT 1");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row['data_da_sessao'];
        }
    } catch (PDOException $e) {
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    }
    return null; 
}

function isSessionApproaching($data_da_sessao) {
    $data_atual = new DateTime(); 
    $data_sessao = new DateTime($data_da_sessao); 
    $diferenca = $data_atual->diff($data_sessao);
    return $diferenca->days == 3 && $data_sessao > $data_atual;
}

session_start();
$data_da_sessao = getSessionDate($_SESSION['user_id']); 
$mensagem = ""; 
if ($data_da_sessao && isSessionApproaching($data_da_sessao)) {
    $mensagem = "A sua sessão está se aproximando em " . $data_da_sessao . "!";
}
?>