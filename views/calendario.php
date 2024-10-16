<?php
session_start();
require '../includes/db.php'; 
require '../controllers/CalendarioController.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}
$calendarioController = new CalendarioController();
$calendario = $calendarioController->gerarCalendario(date('n'), date('Y'));
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>
<div class="calendario-container animate-hero">
    <h2>Calendário</h2>
    <?php echo $calendario; ?>
</div>
<?php include '../includes/footer.php'; ?>