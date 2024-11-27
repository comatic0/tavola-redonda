<?php

use PHPUnit\Framework\TestCase;

class NotificacaoTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        // Configurar um banco de dados em memória para testes
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Criar a tabela de mesas
        $this->pdo->exec("CREATE TABLE mesas (
            id INTEGER PRIMARY KEY,
            user_id INTEGER,
            data_da_sessao TEXT
        )");

        // Inserir dados de teste
        $this->pdo->exec("INSERT INTO mesas (user_id, data_da_sessao) VALUES (1, '2023-12-01')");
    }

    public function testGetSessionDate()
    {
        // Substituir a função getSessionDate para usar o PDO de teste
        $user_id = 1;
        $data_da_sessao = $this->getSessionDate($user_id);
        $this->assertEquals('2023-12-01', $data_da_sessao);
    }

    public function testIsSessionApproaching()
    {
        $data_da_sessao = '2023-12-01';
        $result = $this->isSessionApproaching($data_da_sessao);
        $this->assertFalse($result);

        // Testar com uma data que está a 3 dias de distância
        $data_da_sessao = (new DateTime())->modify('+3 days')->format('Y-m-d');
        $result = $this->isSessionApproaching($data_da_sessao);
        $this->assertTrue($result);
    }

    private function getSessionDate($user_id)
    {
        $stmt = $this->pdo->prepare("SELECT data_da_sessao FROM mesas WHERE user_id = :user_id LIMIT 1");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row['data_da_sessao'];
        }
        return null;
    }

    private function isSessionApproaching($data_da_sessao)
    {
        $data_atual = new DateTime(); 
        $data_sessao = new DateTime($data_da_sessao); 
        $diferenca = $data_atual->diff($data_sessao);
        return $diferenca->days == 3 && $data_sessao > $data_atual;
    }
}