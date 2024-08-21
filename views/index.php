<?php
require '../includes/db.php';
require '../includes/functions.php';
$mesas = getAllTables($pdo);
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>

<h1 class="evil-aura">Mesas de RPG</h1>
<p>Essa são as listas de mesas existentes no nosso banco de dados.</p>
<table>
    <thead>
        <tr>
            <th>♛ ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($mesas as $mesa): ?>
            <tr>
                <td><?php echo htmlspecialchars($mesa['id']); ?></td>
                <td><?php echo htmlspecialchars($mesa['nome']); ?></td>
                <td><?php echo htmlspecialchars($mesa['descricao']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $mesa['id']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $mesa['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>
