<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['email'] = $email;
        header('Location: complete_registration.php');
    } else {
        $error = 'Invalid email address.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Enter Email</title>
</head>
<body>
    <h1>Enter Your Email Address</h1>
    <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
    <form method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>