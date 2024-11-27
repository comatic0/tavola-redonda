<?php

use PHPUnit\Framework\TestCase;
use controllers\MapaController;

class MapaControllerTest extends TestCase
{
    private $pdo;
    private $mapaController;

    protected function setUp(): void
    {
        // Configurar um banco de dados em memória para testes
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Criar a tabela de mapas
        $this->pdo->exec("CREATE TABLE mapas (
            id INTEGER PRIMARY KEY,
            nome TEXT,
            caminho TEXT,
            tipo TEXT,
            user_id INTEGER
        )");

        $this->mapaController = new MapaController($this->pdo);
    }

    public function testListarMapas()
    {
        // Inserir dados de teste
        $this->pdo->exec("INSERT INTO mapas (nome, caminho, tipo, user_id) VALUES ('Mapa Teste', 'caminho/teste.png', 'Tipo Teste', 1)");

        // Chamar o método listarMapas
        $mapas = $this->mapaController->listarMapas();

        // Verificar se o resultado está correto
        $this->assertCount(1, $mapas);
        $this->assertEquals('Mapa Teste', $mapas[0]['nome']);
        $this->assertEquals('caminho/teste.png', $mapas[0]['caminho']);
        $this->assertEquals('Tipo Teste', $mapas[0]['tipo']);
    }

    public function testUpload()
    {
        // Simular um arquivo de upload
        $imagem = [
            'name' => 'teste.png',
            'tmp_name' => '/tmp/phpYzdqkD',
            'type' => 'image/png',
            'size' => 123,
            'error' => 0
        ];

        // Chamar o método upload
        $result = $this->mapaController->upload('Mapa Teste', $imagem, 'Tipo Teste');

        // Verificar se o upload foi bem-sucedido
        $this->assertTrue($result);

        // Verificar se o mapa foi inserido no banco de dados
        $mapas = $this->mapaController->listarMapas();
        $this->assertCount(1, $mapas);
        $this->assertEquals('Mapa Teste', $mapas[0]['nome']);
    }
}