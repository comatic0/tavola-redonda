<?php
session_start();
require '../../controllers/AuthController.php';

use controllers\AuthController;

$authController = new AuthController($pdo);
$authController->logout();
?>