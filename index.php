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
        
        <section class="about animate-hero">
            <h2>O que nós somos?</h2>
        </section>
        <section class="hero animate-hero">
            <div class="hero-content">
            <p class="animate-text">
                Somos uma comunidade dedicada a reunir jogadores de RPG de mesa. Nossa missão é proporcionar um espaço onde mestres e jogadores possam se encontrar, criar e participar de aventuras épicas. Oferecemos ferramentas para gerenciar suas mesas, fichas de personagens e muito mais. Junte-se a nós e faça parte dessa jornada fantástica!
            </p>
            <p class="animate-text">
                Nosso sistema permite que você busque por mesas existentes, cadastre personagens detalhados, gerencie sessões de jogo e muito mais. Com uma interface intuitiva e acessível, você pode facilmente criar e participar de aventuras épicas. Além disso, oferecemos suporte para agendamento de sessões, cadastro de mestres e login de usuários, garantindo uma experiência completa e integrada.
            </p>
            <p class="animate-text">
                Funcionalidades principais:
                <ul class="animate-text">
                    <li>Busca por mesas existentes no banco de dados</li>
                    <li>Agendamento de horários e dias de sessões</li>
                    <li>Gestão de fichas de personagens</li>
                    <li>Exibição, alteração e exclusão de perfis</li>
                    <li>Interface acessível, atraente e intuitiva</li>
                </ul>
            </p>
            </div>
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

    setInterval(showNextImage, 6000);
});
</script>