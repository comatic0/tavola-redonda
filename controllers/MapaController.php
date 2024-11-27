<?php
require_once __DIR__ . '/../models/Mapa.php';
require_once __DIR__ . '/../includes/db.php';

use models\Mapa;

class MapaController {
    private $mapaModel;
    public function __construct($pdo) {
        $this->mapaModel = new Mapa($pdo);
    }
    public function upload($nome, $imagem, $tipo) {
        $user_id = $_SESSION['user_id'] ?? null;
        if ($user_id) {
            $imageName = null;
            if (isset($imagem) && $imagem['error'] == UPLOAD_ERR_OK) {
                $imageTmpName = $imagem['tmp_name'];
                $imageName = uniqid() . '-' . basename($imagem['name']); // Gera um nome único
                $uploadDir = __DIR__ . '/../assets/mapas/';

                // Move o arquivo para o diretório de uploads
                if (move_uploaded_file($imageTmpName, $uploadDir . $imageName)) {
                    // A imagem foi enviada com sucesso
                } else {
                    echo "Erro ao enviar a imagem.";
                    return;
                }
            }
            $caminho = "http://localhost/tavola-redonda/assets/mapas/" . $imageName;
            if ($this->mapaModel->uploadMapa($nome, $caminho, $tipo, $user_id)) {
                header('Location: ../mapas/index.php');
                exit();
            } else {
                return "Erro ao adicionar o mapa.";
            }
        }
    }

    public function getMapaById($mapa_id) {
        $table = $this->mapaModel->getTableById($mapa_id);
        if ($table) {
            return $table;
        } else {
            exit();
        }
    }

    public function deleteMapa($mapa_id) {
        $this->mapaModel->deleteMapa($mapa_id);
        header('Location: ../mapas/index.php');
        exit();
    }

    public function listarMapas() {
        return $this->mapaModel->getAllMapas();
    }
} 
?>