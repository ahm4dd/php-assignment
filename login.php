<?php
session_start();
$admin_username = 'admin';
$admin_password = '12345';

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
        echo "Invalid login credentials";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <label for="username-input"></label>
        <input type="text" name="username" id="username-input">

        <label for="password-input"></label>
        <input type="password" name="password" id="password-input">

        <input type="submit" name="submit">
    </form>
</body>

</html>
