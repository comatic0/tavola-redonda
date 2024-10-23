<?php
session_start();
require '../../controllers/FichaController.php';
$fichaController = new FichaController($pdo);
$fichas = $fichaController->getAllFichas();
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<main>
    <section class="table-view animate-hero">
        <h1 class="evil-aura">Ficha de Personagem</h1>
        <p>Essas são as fichas de personagem cadastrados.</p>
        <a href="create.php" class="btn">Criar Nova Ficha</a>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Classe</th>
                    <th>Nível</th>
                    <th>Raça</th>
                    <th>Magias</th>
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
                        <td><?php echo htmlspecialchars($ficha['magias']); ?></td>
                        <td><?php echo htmlspecialchars($ficha['descricao']); ?></td>
                        <td>
                            <a href="../profile.php?id=<?php echo $ficha['user_id']; ?>"><?php echo htmlspecialchars($ficha['user_id']); ?></a>
                        </td>
                        <td>
                            <?php if ($ficha['user_id'] == $_SESSION['user_id']): ?>
                                <a href="delete.php?id=<?php echo $ficha['id']; ?>" class="btn">Deletar</a>
                                <a href="edit.php?id=<?php echo $ficha['id']; ?>" class="btn btn-primary">Editar</a>
                            <?php endif; ?>
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