<?php


require 'includes/db.php';
require 'controllers/MesaController.php';


header('Content-Type: application/json');


$query = "
    SELECT fichas.id, fichas.nome AS nome_personagem, fichas.classe, fichas.nivel, fichas.raca, 
           fichas.magias, fichas.descricao, fichas.imagem, usuarios.username AS nome_usuario
    FROM fichas
    JOIN usuarios ON fichas.user_id = usuarios.id
";
$stmt = $pdo->prepare($query);

try {
    $stmt->execute();
    $fichas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    echo json_encode($fichas);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro ao buscar fichas: ' . $e->getMessage()]);
}
?>
