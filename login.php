<?php
session_start();
$admin_username = 'admin';
$admin_password = '12345';
$error_message = '';

// We are not going to hash for every request, but we should verify
// $admin_password = password_hash('12345', PASSWORD_ARGON2I); // Hash with argon2 because it won the competition
if (isset($_POST['submit'])) {
    if (
        isset($_POST['username'], $_POST['password'])
        &&
        $_POST['username'] == $admin_username
        &&
        $_POST['password'] == $admin_password
        // Verify the hash if you hashed the password
        // password_verify($_POST['password'], $admin_password)
    ) {
        session_regenerate_id(true); // This deletes the file for login to prevent sesion fixation.

        $_SESSION['user_id'] = 'long-UUID';
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['is_logged_in'] = true;
        $_SESSION['role'] = 'admin';

        header('Location: dashboard.php');
        exit;
    } else {
        $error_message = 'Invalid login credentials';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body class="auth-page">
    <main class="auth-wrapper">
        <form method="POST" class="auth-card">
            <p class="eyebrow">Admin area</p>
            <h1>Login</h1>
            <p class="auth-text">Enter your username and password to continue.</p>

            <?php if ($error_message) { ?>
                <p class="message error"><?php echo $error_message; ?></p>
            <?php } ?>

            <label for="username-input">Username</label>
            <input type="text" name="username" id="username-input" placeholder="Enter username">

            <label for="password-input">Password</label>
            <input type="password" name="password" id="password-input" placeholder="Enter password">

            <input type="submit" name="submit" value="Login" class="button">
        </form>
    </main>
</body>

</html>
