
<?php
use PHPUnit\Framework\TestCase;
use models\Ficha;

class FichaTest extends TestCase {
    private $pdo;
    private $ficha;

    protected function setUp(): void {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->exec("CREATE TABLE fichas (
            id INTEGER PRIMARY KEY,
            nome TEXT,
            classe TEXT,
            nivel INTEGER,
            raca TEXT,
            magias TEXT,
            descricao TEXT,
            imagem TEXT,
            user_id INTEGER
        )");
        $this->ficha = new Ficha($this->pdo);
    }

    public function testCreateFicha() {
        $result = $this->ficha->createFicha('Teste', 'Guerreiro', 1, 'Humano', 'Nenhuma', 'Descrição de teste', 'imagem.png', 1);
        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT * FROM fichas WHERE nome = 'Teste'");
        $ficha = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertNotEmpty($ficha);
        $this->assertEquals('Teste', $ficha['nome']);
    }

    public function testGetAllFichas() {
        $this->ficha->createFicha('Teste1', 'Guerreiro', 1, 'Humano', 'Nenhuma', 'Descrição de teste 1', 'imagem1.png', 1);
        $this->ficha->createFicha('Teste2', 'Mago', 2, 'Elfo', 'Magia', 'Descrição de teste 2', 'imagem2.png', 2);

        $fichas = $this->ficha->getAllFichas();
        $this->assertCount(2, $fichas);
    }

    public function testDeleteFicha() {
        $this->ficha->createFicha('Teste', 'Guerreiro', 1, 'Humano', 'Nenhuma', 'Descrição de teste', 'imagem.png', 1);
        $stmt = $this->pdo->query("SELECT id FROM fichas WHERE nome = 'Teste'");
        $ficha = $stmt->fetch(PDO::FETCH_ASSOC);

        $result = $this->ficha->deleteFicha($ficha['id']);
        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT * FROM fichas WHERE id = {$ficha['id']}");
        $ficha = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertFalse($ficha);
    }

    public function testUpdateFicha() {
        $this->ficha->createFicha('Teste', 'Guerreiro', 1, 'Humano', 'Nenhuma', 'Descrição de teste', 'imagem.png', 1);
        $stmt = $this->pdo->query("SELECT id FROM fichas WHERE nome = 'Teste'");
        $ficha = $stmt->fetch(PDO::FETCH_ASSOC);

        $result = $this->ficha->updateFicha($ficha['id'], 'Teste Atualizado', 'Mago', 2, 'Elfo', 'Magia', 'Descrição atualizada', 'imagem2.png');
        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT * FROM fichas WHERE id = {$ficha['id']}");
        $ficha = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals('Teste Atualizado', $ficha['nome']);
    }
}
?>