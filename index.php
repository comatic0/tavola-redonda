<?php include 'includes/header.php'; ?>
<?php include 'includes/nav.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Távola Redonda</title>
</head>
<body>
    <main>
        <section class="hero">
            <img src="<?php echo $base_path; ?>/assets/icons/image1.png" alt="Dados de RPG">
            <div class="hero-content">
                <h2>Bem-vindo à Tavola Redonda</h2>
                <p>
                    Aqui você pode gerenciar diferentes mesas de RPG.<br>
                    O projeto Tavola Redonda é uma aplicação web desenvolvida para facilitar o gerenciamento de mesas de RPG.
                </p>
                <div class="buttons">
                    <a href="<?php echo $base_path; ?>/views/add.php" class="btn">Criar nova mesa</a>
                    <a href="<?php echo $base_path; ?>/views/search.php" class="btn">Ingressar em uma nova mesa</a>
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