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
    <link rel="stylesheet" href="styles.css">
</head>

<body class="dashboard-page">
    <?php include 'nav.php'; ?>

    <main class="dashboard-main">
        <section class="dashboard-card">
            <p class="eyebrow">Dashboard</p>
            <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
            <p class="dashboard-text">You are logged in and can now access the protected page.</p>
        </section>
    </main>
</body>

</html>
