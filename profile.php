<?php
session_start();

// Check if user is logged in
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
    <title>Profile - Travlive</title>
    <link rel="stylesheet" href="assets/css/home.css"> <!-- Reuse CSS -->
</head>
<body>
    <div class="container">
        <h1>Your Profile</h1>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        <?php if (!empty($_SESSION['profile_img'])): ?>
            <p><strong>Profile Image:</strong></p>
            <img src="uploads/<?php echo htmlspecialchars($_SESSION['profile_img']); ?>" alt="Profile Image" style="max-width: 200px;">
        <?php endif; ?>
        <a href="index.php" class="btn-logout">Back to Home</a>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</body>
</html>
