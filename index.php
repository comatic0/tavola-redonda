<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Távola Redonda</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="<?php echo $base_path; ?>/assets\icons/logo.png" alt="Logo Távula Redonda">
            <h1>Távula Redonda</h1>
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
    
    <main>
        <section class="hero">
            <img src="<?php echo $base_path; ?>/assets\icons/image1.png" alt="Dados de RPG">
            <div class="hero-content">
                <h2>Bem-vindo à Tavola Redonda</h2>
                <p>
                    Aqui você pode gerenciar diferentes mesas de RPG.<br>
                    O projeto Tavola Redonda é uma aplicação web desenvolvida para facilitar o gerenciamento de mesas de RPG.
                </p>
                <div class="buttons">
                    <a href="<?php echo $base_path; ?>/views/add.php" class="btn">Criar nova mesa</a>
                    <a href="#" class="btn">Ingressar em uma nova mesa</a>
                </div>
            </div>
        </section>
        
        <section class="about">
            <h2>O que nós somos?</h2>
        </section>
        <footer>
            <p>&copy; 2024 Távola Redonda</p>
        </footer>
    </main>

<?php include 'includes/footer.php'; ?>
