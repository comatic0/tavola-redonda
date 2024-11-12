<?php
use PHPUnit\Framework\TestCase;
use models\Mesa;

class MesaTest extends TestCase {
    private $pdo;
    private $mesa;

    protected function setUp(): void {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->exec("CREATE TABLE mesas (id INTEGER PRIMARY KEY, nome TEXT, descricao TEXT, categoria TEXT, data_da_sessao TEXT, max_capacity INTEGER, user_id INTEGER, nome_do_mestre TEXT)");
        $this->mesa = new Mesa($this->pdo);
    }

    public function testCreateMesa() {
        $result = $this->mesa->createMesa('Mesa Teste', 'Descrição da Mesa', 'Categoria', '2024-12-31', 5, 1, 'Mestre Teste');
        $this->assertIsString($result);
    }

    public function testGetAllMesas() {
        $this->mesa->createMesa('Mesa Teste', 'Descrição da Mesa', 'Categoria', '2024-12-31', 5, 1, 'Mestre Teste');
        $mesas = $this->mesa->getAllMesas();
        $this->assertCount(1, $mesas);
    }
}
?>