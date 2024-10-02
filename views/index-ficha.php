<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>
<?php require '../includes/functions.php'; ?>
<?php require '../includes/db.php'; ?>


<main>
    
    <section class="table-view">
        <h1 class="evil-aura">Ficha de Personagem</h1>
        <p>Essas são as fichas de personagem cadastrados.</p>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Classe</th>
                    <th>nivel</th>
                    <th>Raça</th>
                    <th>Descrição</th>
                    <th>Id</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $fichas = getAllFichas($pdo);
                foreach ($fichas as $fichas): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fichas['nome']); ?></td>
                        <td><?php echo htmlspecialchars($fichas['classe']); ?></td>
                        <td><?php echo htmlspecialchars($fichas['nivel']); ?></td>
                        <td><?php echo htmlspecialchars($fichas['raca']); ?></td>
                        <td><?php echo htmlspecialchars($fichas['descricao']); ?></td>
                        <td><?php echo htmlspecialchars($fichas['user_id']); ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <footer>
        <p>&copy; 2024 Távola Redonda</p>
    </footer>
</main>
<?php include '../includes/footer.php'; ?>


