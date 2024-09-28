<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>

<div class="form-container">
    <h2>Logar</h2>
    <form action="login.php" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn">Logar</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>