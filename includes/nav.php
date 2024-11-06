<?php 
$base_path = '/tavola-redonda'; 
include 'notificacao.php'; // Corrigido o caminho do arquivo
$mensagem = $mensagem ?? ''; // Inicializa a variável $mensagem se não estiver definida
?>
<header class="header">
    <div class="logo">
        <a href="<?php echo $base_path; ?>/index.php">
            <img src="<?php echo $base_path; ?>/assets/icons/logo.png" alt="Logo Távula Redonda">
        </a>
        <a href="<?php echo $base_path; ?>/index.php" class="title-link">
            <h1>Távola Redonda</h1>
        </a>
    </div>
    <nav class="navbar">
        <a href="<?php echo $base_path; ?>/index.php">Página Principal</a>
        <a href="<?php echo $base_path; ?>/views/mesas/index.php" >Mesas</a>
        <a href="<?php echo $base_path; ?>/views/fichas/index.php" >Fichas</a>
        <a href="<?php echo $base_path; ?>/views/mapas/index.php" >Mapas</a>
    </nav>
    <div class="user">
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="dropdown">
                <button class="dropbtn"><?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?></button>
                <div class="dropdown-content">
                    <a href="<?php echo $base_path; ?>/views/auth/logout.php">Logout</a>
                </div>
            </div>
            <a href="<?php echo $base_path; ?>/views/profile.php">
                <img id="user-profile-picture" src="<?php echo $base_path; ?>/assets/profile_pictures/<?php echo $_SESSION['profile_picture'] ?? 'user-icon.png'; ?>" alt="User Icon">
            </a>
            <div class="dropdown">
               <button class="dropbtn">Notificações</button>
               <div class="dropdown-content">
                   <p><?php echo $mensagem; ?></p>
                </div>
        <?php else: ?>
            <div class="dropdown">
                <button class="dropbtn">Minha Conta</button>
                <div class="dropdown-content">
                    <a href="<?php echo $base_path; ?>/views/auth/register.php">Registrar</a>
                    <a href="<?php echo $base_path; ?>/views/auth/login.php">Logar</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</header>