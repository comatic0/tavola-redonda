<?php
session_start();
require '../../includes/db.php';
require '../../controllers/MesaController.php';

$mesaController = new MesaController($pdo);
$mesas = $mesaController->getAllMesas();
$user_id = $_SESSION['user_id'] ?? null;
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<main>
    <section class="table-view animate-hero">
        <h1 class="evil-aura">Mesas de RPG</h1>
        <p>Essas são as mesas cadastradas.</p>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Descrição</th>
                    <th>Participantes</th>
                    <th>Dia da sessão</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mesas as $mesa): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($mesa['nome']); ?></td>
                        <td><?php echo htmlspecialchars($mesa['categoria']); ?></td>
                        <td><?php echo htmlspecialchars($mesa['descricao']); ?></td>
                        <td><?php echo htmlspecialchars($mesa['max_capacity']); ?></td>
                        <td><?php echo htmlspecialchars($mesa['data_da_sessao']); ?></td>
                        <td>
                            <?php if ($user_id && $mesaController->isUserInMesa($mesa['id'], $user_id)): ?>
                                <?php if ($mesa['user_id'] != $user_id): ?>
                                    <a href="<?php echo $base_path; ?>/views/mesas/leave.php?id=<?php echo $mesa['id']; ?>" class="btn">Sair da Sessão</a>
                                <?php else: ?>
                                    <a href="<?php echo $base_path; ?>/views/mesas/edit.php?id=<?php echo $mesa['id']; ?>" class="btn">Editar</a>
                                    <a href="<?php echo $base_path; ?>/views/mesas/delete.php?id=<?php echo $mesa['id']; ?>" class="btn">Excluir</a>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="<?php echo $base_path; ?>/views/mesas/join.php?id=<?php echo $mesa['id']; ?>" class="btn">Ingressar</a>
                            <?php endif; ?>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
                    <div class="buttons">
                    <a href="<?php echo $base_path; ?>/views/mesas/add.php" class="btn-creat-mesa animate-button">Criar mesa</a>
                     </div>
        </table>
    </section>
</main>
<?php include '../../includes/footer.php'; ?>