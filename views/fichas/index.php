<?php
session_start();
require '../../controllers/FichaController.php';
use controllers\FichaController;
$fichaController = new FichaController($pdo);
$fichas = $fichaController->getAllFichas();
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<style>
    .circular-image {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 10px;
    }
    .name-with-image {
        align-items: center;
    }
</style>
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
                        <td class="name-with-image">
                            <img src="<?php echo htmlspecialchars($ficha['imagem'] ?: '../../assets/profile_pictures/user-icon.png'); ?>" class="circular-image">
                            <?php echo htmlspecialchars($ficha['nome']); ?>
                        </td>
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
    
    <form method="post" action="">
            <button type="submit" name="rollDiceD4" class="btn-dice">Rolar D4</button>
        </form>
        <?php
        if (isset($_POST['rollDiceD4'])) {
            $result = rand(1, 4);
            echo '<p>Resultado: ' . $result . '</p>';
        }
        ?> <form method="post" action="">
        <button type="submit" name="rollDiceD6" class="btn-dice">Rolar D6</button>
    
    </form>
    <?php
    if (isset($_POST['rollDiceD6'])) {
        $result = rand(1, 6);
        echo '<p>Resultado: ' . $result . '</p>';
    }
    ?>
        <form method="post" action="">
            <button type="submit" name="rollDiceD8" class="btn-dice">Rolar D8</button>
        
        </form>

        <?php
        if (isset($_POST['rollDiceD8'])) {
            $result = rand(1, 8);
            echo '<p>Resultado: ' . $result . '</p>';

        }
        ?>

<form method="post" action="">
            <button type="submit" name="rollDiceD10" class="btn-dice">Rolar D10</button>
        </form>
        <?php
        if (isset($_POST['rollDiceD10'])) {
            $result = rand(1, 10);
            echo '<p>Resultado: ' . $result . '</p>';

        }
        ?>
        <form method="post" action="">
            <button type="submit" name="rollDiceD12" class="btn-dice">Rolar D12</button>
        </form>
        <?php
        if (isset($_POST['rollDiceD12'])) {
            $result = rand(1, 12);
            echo '<p>Resultado: ' . $result . '</p>';

        }
        ?>

<form method="post" action="">
            <button type="submit" name="rollDiceD20" class="btn-dice">Rolar D20</button>
        </form>
        <?php
        if (isset($_POST['rollDiceD20'])) {
            $result = rand(1, 20);
            echo '<p>Resultado: ' . $result . '</p>';

        }
        ?>

<form method="post" action="">
            <button type="submit" name="rollDiceD100" class="btn-dice">Rolar D100</button>
        </form>
        <?php
        if (isset($_POST['rollDiceD100'])) {
            $result = rand(1, 100);
            echo '<p>Resultado: ' . $result . '</p>';

        }
        ?>

<form method="post" action="">
            <label for="customDice">Numero de lados:</label>
            <input type="number" id="customDice" name="customDice" min="1"  class="fourm-group" required>
            <button type="submit" name="rollCustomDice" class="btn-dice">Rolar Dado Personalizado</button>
        </form>
        <?php
        if (isset($_POST['rollCustomDice'])) {
            $sides = intval($_POST['customDice']);
            if ($sides > 0) {
                $result = rand(1, $sides);
                echo '<p>Resultado: ' . $result . '</p>';
            } else {
                echo '<p>Por favor, insira um número válido de lados.</p>';
            }
        }
        ?>
    </section>
    <footer>
        <p>&copy; 2024 Távola Redonda</p>
    </footer>
</main>
<?php include '../../includes/footer.php'; ?>