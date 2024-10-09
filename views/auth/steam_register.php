<?php
session_start();
require '../../includes/db.php';
require '../../controllers/AuthController.php';
require '../../vendor/autoload.php';
$authController = new AuthController($pdo);
$steamApiKey = $config['STEAM_API_KEY'];
$steamApiKeyValid = !empty($steamApiKey) && strlen($steamApiKey) === 20;

$openid = new LightOpenID('localhost');
if (!$openid->mode) {
    $openid->identity = 'https://steamcommunity.com/openid';
    header('Location: ' . $openid->authUrl());
} elseif ($openid->mode == 'cancel') {
    echo 'User has canceled authentication!';
} else {
    if ($openid->validate()) {
        $id = $openid->identity;
        $steam_id = str_replace('https://steamcommunity.com/openid/id/', '', $id);
        $steamData = $authController->fetchSteamData($steam_id);
        if ($steamData) {
            $_SESSION['steam_id'] = $steam_id;
            $_SESSION['username'] = $steamData['personaname'];
            $_SESSION['avatar_url'] = $steamData['avatarfull'];
            header('Location: enter_email.php');
        } else {
            echo 'Failed to fetch Steam data.';
        }
    } else {
        echo 'User is not logged in.';
    }
}
?>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/nav.php'; ?>
<div class="form-container">
    <h2>Registrar com Steam</h2>
    <div class="steam-login <?php echo !$steamApiKeyValid ? 'btn-disabled' : ''; ?>">
        <a href="steam_login.php" class="btn btn-steam" <?php echo !$steamApiKeyValid ? 'onclick="return false;"' : ''; ?>>
            <img src="../../assets/icons/steam-logo.png" alt="Steam Logo">
            Registrar com Steam
        </a>
    </div>
</div>
<?php include '../../includes/footer.php'; ?>