<?php
use PHPUnit\Framework\TestCase;
use models\Mapa;

class MapaTest extends TestCase {
    private $pdo;
    private $mapa;

    protected function setUp(): void {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->exec("CREATE TABLE mapas (id INTEGER PRIMARY KEY, nome TEXT, caminho TEXT, tipo TEXT, user_id INTEGER)");
        $this->mapa = new Mapa($this->pdo);
    }

    public function testUploadMapa() {
        $result = $this->mapa->uploadMapa('Mapa1', '/path/to/mapa1', 'tipo1', 1);
        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT * FROM mapas WHERE nome = 'Mapa1'");
        $mapa = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($mapa);
        $this->assertEquals('Mapa1', $mapa['nome']);
        $this->assertEquals('/path/to/mapa1', $mapa['caminho']);
        $this->assertEquals('tipo1', $mapa['tipo']);
        $this->assertEquals(1, $mapa['user_id']);
    }

    public function testDeleteMapa() {
        $this->pdo->exec("INSERT INTO mapas (nome, caminho, tipo, user_id) VALUES ('Mapa2', '/path/to/mapa2', 'tipo2', 2)");
        $stmt = $this->pdo->query("SELECT id FROM mapas WHERE nome = 'Mapa2'");
        $mapa = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->mapa->deleteMapa($mapa['id']);

        $stmt = $this->pdo->query("SELECT * FROM mapas WHERE id = " . $mapa['id']);
        $mapa = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertFalse($mapa);
    }

    public function testGetAllMapas() {
        $this->pdo->exec("INSERT INTO mapas (nome, caminho, tipo, user_id) VALUES ('Mapa3', '/path/to/mapa3', 'tipo3', 3)");
        $this->pdo->exec("INSERT INTO mapas (nome, caminho, tipo, user_id) VALUES ('Mapa4', '/path/to/mapa4', 'tipo4', 4)");

        $mapas = $this->mapa->getAllMapas();

        $this->assertCount(2, $mapas);
        $this->assertEquals('Mapa3', $mapas[0]['nome']);
        $this->assertEquals('Mapa4', $mapas[1]['nome']);
    }
}
?>