<?php
require '../includes/db.php';
require '../includes/functions.php';

$id = $_GET['id'] ?? null;
if ($id) {
    deleteTable($pdo, $id);
}

header('Location: index.php');
exit();
?>
