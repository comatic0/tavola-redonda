<?php
session_start();
require '../../controllers/AuthController.php';

$authController = new AuthController($pdo);
$authController->logout();
?>