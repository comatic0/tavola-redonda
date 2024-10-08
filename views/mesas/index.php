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
                        <td>
                            <?php
                            $participantes = $mesaController->getMesaParticipants($mesa['id']);
                            foreach ($participantes as $participante):
                            ?>
                                <div class="participant">
                                    <img src="<?php echo $base_path; ?>/assets/profile_pictures/<?php echo htmlspecialchars($participante['profile_picture'] ?? 'user-icon.png'); ?>" alt="Profile Picture" class="profile-icon">
                                    <span><?php echo htmlspecialchars($participante['username']); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </td>
                        <td><?php echo htmlspecialchars($mesa['data_da_sessao']); ?></td>
                        <td>
                            <?php if ($user_id && $mesaController->isUserInMesa($mesa['id'], $user_id)): ?>
                                <?php if ($mesa['user_id'] != $user_id): ?>
                                    <a href="<?php echo $base_path; ?>/views/mesas/leave.php?id=<?php echo $mesa['id']; ?>" class="btn">Sair da Sessão</a>
                                <?php else: ?>
                                    <span>Você é o mestre</span>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="<?php echo $base_path; ?>/views/mesas/join.php?id=<?php echo $mesa['id']; ?>" class="btn">Ingressar</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>
<?php include '../../includes/footer.php'; ?>