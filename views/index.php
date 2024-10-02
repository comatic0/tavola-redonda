<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>
<?php require '../includes/functions.php'; ?>
<?php require '../includes/db.php'; ?>


<main>
    
    <section class="table-view">
        <h1 class="evil-aura">Mesas de RPG</h1>
        <p>Essa são as listas de mesas existentes no nosso banco de dados.</p>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>♛ ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Descrição</th>
                    <th>Mestre</th>
                    <th>Número Máximo de Jogadores</th>
                    <th>Usuários</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $mesas = getAllTables($pdo);
                foreach ($mesas as $mesa): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($mesa['id']); ?></td>
                        <td><?php echo htmlspecialchars($mesa['nome']); ?></td>
                        <td><?php echo htmlspecialchars($mesa['categoria']); ?></td>
                        <td><?php echo htmlspecialchars($mesa['descricao']); ?></td>
                        <td><?php echo htmlspecialchars($mesa['nome_do_mestre']); ?></td>
                        <td><?php echo htmlspecialchars($mesa['numero_max_jogadores']); ?></td>
                        <td>
                            <?php
                            $users = getUsersInTable($pdo, $mesa['id']);
                            foreach ($users as $user) {
                                echo htmlspecialchars($user['username']) . '<br>';
                            }
                            ?>
                        </td>
                        <td>
                            <div class="td_mesa">
                                <?php if (isset($_SESSION['user_id']) && $mesa['user_id'] == $_SESSION['user_id']): ?>
                                    <a href="edit.php?id=<?php echo $mesa['id']; ?>" class="btn-edit">Editar</a>
                                    <a href="delete.php?id=<?php echo $mesa['id']; ?>" class="btn-delete" onclick="return confirm('Tem certeza que deseja deletar?');">Deletar</a>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['user_id'])): ?>
                                <?php
                                    $user_id = $_SESSION['user_id'];
                                    $stmt = $pdo->prepare("SELECT * FROM mesa_usuarios WHERE mesa_id = ? AND user_id = ?");
                                    $stmt->execute([$mesa['id'], $user_id]);
                                    $isUserInTable = $stmt->fetch();
                                ?>
                                <?php if ($isUserInTable): ?>
                                    <a href="leave.php?id=<?php echo $mesa['id']; ?>" class="btn-leave">Sair</a>
                                <?php else: ?>
                                    <a href="join.php?id=<?php echo $mesa['id']; ?>" class="btn-join">Entrar</a>
                                <?php endif; ?>
                                <?php else: ?>
                                    <a href="login.php" class="btn-join">Entrar</a>
                                <?php endif; ?>
                            </div>
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
<?php include '../includes/footer.php'; ?>



