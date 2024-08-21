<?php
require '../includes/db.php';
require '../includes/functions.php';
$mesas = getAllTables($pdo);
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>

<h1>Mesas de RPG</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Descrição</th>
            <th>Mestre</th>
            <th>Número Máximo de Jogadores</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($mesas as $mesa): ?>
            <tr>
                <td><?php echo htmlspecialchars($mesa['id']); ?></td>
                <td><?php echo htmlspecialchars($mesa['nome']); ?></td>
                <td><?php echo htmlspecialchars($mesa['categoria']); ?></td>
                <td><?php echo htmlspecialchars($mesa['descricao']); ?></td>
                <td><?php echo htmlspecialchars($mesa['nome_do_mestre']); ?></td>
                <td><?php echo htmlspecialchars($mesa['numero_max_jogadores']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $mesa['id']; ?>">Editar</a>
                    <a href="delete.php?id=<?php echo $mesa['id']; ?>" onclick="return confirm('Tem certeza que deseja deletar?');">Deletar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>