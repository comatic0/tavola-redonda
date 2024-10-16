<?php
require 'includes/init_db.php';
include 'includes/header.php';
include 'includes/nav.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Távola Redonda</title>
</head>
<body>
    <main>
        <section class="hero animate-hero">
            <div class="carousel">
                <div class="carousel-images">
                    <img src="<?php echo $base_path; ?>/assets/icons/image1.png" alt="Dados de RPG" class="carousel-image">
                    <img src="<?php echo $base_path; ?>/assets/icons/image2.png" alt="Dados de RPG" class="carousel-image">
                    <img src="<?php echo $base_path; ?>/assets/icons/image3.png" alt="Dados de RPG" class="carousel-image">
                </div>
            </div>
            <div class="hero-content">
                <h2 class="animate-text">Bem-vindo à Tavola Redonda</h2>
                <p class="animate-text">
                    Aqui você pode gerenciar diferentes mesas de RPG.<br>
                    O projeto Tavola Redonda é uma aplicação web desenvolvida para facilitar o gerenciamento de mesas de RPG.
                </p>
                <div class="buttons">
                    <a href="<?php echo $base_path; ?>/views/mesas/add.php" class="btn animate-button">Criar nova mesa</a>
                    <a href="<?php echo $base_path; ?>/views/mesas/search.php" class="btn animate-button">Ingressar em uma nova mesa</a>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carouselImages = document.querySelector('.carousel-images');
    const images = document.querySelectorAll('.carousel-image');
    let currentIndex = 0;

    function showNextImage() {
        currentIndex = (currentIndex + 1) % images.length;
        const offset = -currentIndex * 100;
        carouselImages.style.transform = `translateX(${offset}%)`;
    }

    setInterval(showNextImage, 10000);
});
</script>