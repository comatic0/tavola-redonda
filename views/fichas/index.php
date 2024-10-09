<?php
session_start();
require '../../controllers/FichaController.php';
$fichaController = new FichaController($pdo);
$fichas = $fichaController->getAllFichas();
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<main>
    <section class="table-view">
        <h1 class="evil-aura">Ficha de Personagem</h1>
        <p>Essas são as fichas de personagem cadastrados.</p>
        <a href="create.php" class="btn">Criar Nova Ficha</a>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Classe</th>
                    <th>nivel</th>
                    <th>Raça</th>
                    <th>Descrição</th>
                    <th>Id</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fichas as $ficha): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($ficha['nome']); ?></td>
                        <td><?php echo htmlspecialchars($ficha['classe']); ?></td>
                        <td><?php echo htmlspecialchars($ficha['nivel']); ?></td>
                        <td><?php echo htmlspecialchars($ficha['raca']); ?></td>
                        <td><?php echo htmlspecialchars($ficha['descricao']); ?></td>
                        <td><?php echo htmlspecialchars($ficha['user_id']); ?></td>
                        <td>
                            <a href="delete.php?id=<?php echo $ficha['id']; ?>" class="btn">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <footer>
        <p>&copy; 2024 Távola Redonda</p>
    </footer>
</main>
<?php include '../../includes/footer.php'; ?>