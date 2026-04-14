<?php
session_start();

if (!isset($_SESSION['is_logged_in'])) {
    header('Location: login.php');
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    http_response_code(403);
    exit('Forbidden');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <?php include 'nav.php'; ?>

    <main>
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    </main>
</body>

</html>
