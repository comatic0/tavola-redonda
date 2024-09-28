<?php $base_path = '/tavola-redonda'; ?>
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
        <a href="<?php echo $base_path; ?>/index.php" class="active">Página Principal</a>
        <a href="<?php echo $base_path; ?>/views/index.php">Mesas</a>
        <a href="#">Fichas</a>
    </nav>
    <div class="user">
        <div class="dropdown">
            <button class="dropbtn">Minha Conta</button>
            <div class="dropdown-content">
                <a href="<?php echo $base_path; ?>/views/register.php">Registrar</a>
                <a href="<?php echo $base_path; ?>/views/login.php">Logar</a>
            </div>
        </div>
        <img src="<?php echo $base_path; ?>/assets/icons/user-icon.png" alt="User Icon">
    </div>
</header>