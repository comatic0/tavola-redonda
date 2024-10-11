<?php
session_start();
require_once '../includes/db.php';
require_once '../models/User.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

$userModel = new User($pdo);
$user = $userModel->getUserById($_SESSION['user_id']);
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $bio = $_POST['bio'];
    $password = $_POST['password'];
    $profile_picture = $_FILES['profile_picture'];
    $header_image = $_FILES['header_image'];

    // Check if username is already taken
    $existingUser = $userModel->getUserByUsername($username);
    if ($existingUser && $existingUser['id'] != $_SESSION['user_id']) {
        $error = 'Username is already taken.';
    } else {
        // Update username
        $userModel->updateUsername($_SESSION['user_id'], $username);

        // Update bio
        if (strlen($bio) <= 150) {
            $userModel->updateUserBio($_SESSION['user_id'], $bio);
        }

        // Update password
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $userModel->updateUserPassword($_SESSION['user_id'], $hashedPassword);
        }

        // Update profile picture
        if ($profile_picture['error'] === UPLOAD_ERR_OK) {
            $target_dir = "../assets/profile_pictures/";
            $target_file = $target_dir . basename($profile_picture["name"]);
            move_uploaded_file($profile_picture["tmp_name"], $target_file);
            $userModel->updateUserProfilePicture($_SESSION['user_id'], basename($profile_picture["name"]));
        }

        // Update header image
        if ($header_image['error'] === UPLOAD_ERR_OK) {
            $target_dir = "../assets/profile_headers/";
            $target_file = $target_dir . basename($header_image["name"]);
            move_uploaded_file($header_image["tmp_name"], $target_file);
            $userModel->updateUserHeaderImage($_SESSION['user_id'], basename($header_image["name"]));
        }

        header('Location: profile.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <?php include '../includes/nav.php'; ?>
    <div class="profile-container">
        <h2>Edit Profile</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="edit_profile.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio" maxlength="150"><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea>
            </div>
            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture">
            </div>
            <div class="form-group">
                <label for="header_image">Header Image:</label>
                <input type="file" id="header_image" name="header_image">
            </div>
            <button type="submit" class="btn">Save Changes</button>
        </form>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>