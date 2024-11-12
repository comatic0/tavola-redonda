<?php
use PHPUnit\Framework\TestCase;
use models\User;

class UserTest extends TestCase {
    private $pdo;
    private $user;

    protected function setUp(): void {
        $this->pdo = $this->createMock(PDO::class);
        $this->user = new User($this->pdo);
    }

    public function testGetUserByEmail() {
        $email = 'test@example.com';
        $expectedUser = ['id' => 1, 'username' => 'testuser', 'email' => $email, 'profile_picture' => 'user-icon.png'];

        $stmt = $this->createMock(PDOStatement::class);
        $stmt->expects($this->once())
             ->method('execute')
             ->with([$email]);
        $stmt->expects($this->once())
             ->method('fetch')
             ->willReturn($expectedUser);

        $this->pdo->expects($this->once())
                  ->method('prepare')
                  ->with("SELECT * FROM usuarios WHERE email = ?")
                  ->willReturn($stmt);

        $result = $this->user->getUserByEmail($email);
        $this->assertEquals($expectedUser, $result);
    }

    public function testGetUserByUsername() {
        $username = 'testuser';
        $expectedUser = ['id' => 1, 'username' => $username, 'email' => 'test@example.com', 'profile_picture' => 'user-icon.png'];

        $stmt = $this->createMock(PDOStatement::class);
        $stmt->expects($this->once())
             ->method('execute')
             ->with([$username]);
        $stmt->expects($this->once())
             ->method('fetch')
             ->willReturn($expectedUser);

        $this->pdo->expects($this->once())
                  ->method('prepare')
                  ->with("SELECT * FROM usuarios WHERE username = ?")
                  ->willReturn($stmt);

        $result = $this->user->getUserByUsername($username);
        $this->assertEquals($expectedUser, $result);
    }

    public function testGetUserById() {
        $userId = 1;
        $expectedUser = ['id' => $userId, 'username' => 'testuser', 'email' => 'test@example.com', 'profile_picture' => 'user-icon.png'];

        $stmt = $this->createMock(PDOStatement::class);
        $stmt->expects($this->once())
             ->method('execute')
             ->with(['id' => $userId]);
        $stmt->expects($this->once())
             ->method('fetch')
             ->willReturn($expectedUser);

        $this->pdo->expects($this->once())
                  ->method('prepare')
                  ->with("SELECT * FROM usuarios WHERE id = :id")
                  ->willReturn($stmt);

        $result = $this->user->getUserById($userId);
        $this->assertEquals($expectedUser, $result);
    }
}