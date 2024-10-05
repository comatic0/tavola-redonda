<?php
session_start();
require '../../controllers/MesaController.php';
$mesaController = new MesaController($pdo);
$mesas = $mesaController->getAllMesas();
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<main>
    <section class="table-view">
        <h1 class="evil-aura">Mesas de RPG</h1>
        <p>Essas são as mesas cadastradas.</p>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Descrição</th>
                    <th>Participantes</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mesas as $mesa): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($mesa['nome']); ?></td>
                        <td><?php echo htmlspecialchars($mesa['categoria']); ?></td>
                        <td><?php echo htmlspecialchars($mesa['descricao']); ?></td>
                        <td>
                            <?php
                            $participantes = $mesaController->getMesaParticipants($mesa['id']);
                            foreach ($participantes as $participante) {
                                echo htmlspecialchars($participante['username']) . '<br>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <?php if ($_SESSION['user_id'] === $mesa['user_id']): ?>
                                    <a href="edit.php?id=<?php echo $mesa['id']; ?>" class="btn">Editar</a>
                                    <a href="delete.php?id=<?php echo $mesa['id']; ?>" class="btn">Excluir</a>
                                <?php else: ?>
                                    <?php if ($mesaController->isUserInMesa($mesa['id'], $_SESSION['user_id'])): ?>
                                        <a href="leave.php?id=<?php echo $mesa['id']; ?>" class="btn">Sair</a>
                                    <?php else: ?>
                                        <?php if (!$mesaController->isAtMaxCapacity($mesa['id'])): ?>
                                            <a href="join.php?id=<?php echo $mesa['id']; ?>" class="btn">Ingressar</a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="../auth/login.php" class="btn btn-disabled">Ingressar</a>
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