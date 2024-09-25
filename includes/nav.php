<?php $base_path = '/tavola-redonda'; ?>
<header class="header">
        <div class="logo">
            <img src="<?php echo $base_path; ?>/assets\icons/logo.png" alt="Logo Távula Redonda">
            <h1>Távola Redonda</h1>
        </div>
        <nav class="navbar">
            <a href="#" class="active">Página Principal</a>
            <a href= "<?php echo $base_path; ?>/views/index.php">Mesas</a>
            <a href="#">Fichas</a>
        </nav>
        <div class="user">
            <a href="<?php echo $base_path; ?>/views/register.php">Crie sua conta</a>
            <img src="<?php echo $base_path; ?>/assets\icons/user-icon.png" alt="User Icon">
        </div>
</header>