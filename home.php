<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: sign-in.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tralive Home</title>
    <link rel="stylesheet" href="assets/css/home.css"> <!-- Optional CSS -->
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['name']; ?>!</h1>
        <p>You are successfully logged in.</p>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</body>
</html>
