<?php
if (!function_exists('loadConfig')) {
    function loadConfig($path) {
        if (!file_exists($path)) {
            throw new Exception('config.json file not found');
        }
        $config = json_decode(file_get_contents($path), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Error parsing config.json');
        }
        return $config;
    }
}
$config = loadConfig(__DIR__ . '/../config.json');
$host = $config['DB_HOST'];
$db = $config['DB_NAME'];
$user = $config['DB_USER'];
$pass = $config['DB_PASS'];
$steamApiKey = $config['STEAM_API_KEY'];
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro na conexão: ' . $e->getMessage());
}
?>