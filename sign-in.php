<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/sign-in.css">
  <title>Tralive Sign In</title>
</head>

<body>
  <div class="overlay"></div>

  <div class="container" id="form-container">
    <h2 id="form-title">Sign In</h2>
    <form id="main-form" action="backend/login.php" method="POST">
      <div class="input-group">
        <label>Email</label>
        <input type="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="input-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter your password" required>
      </div>
      <button type="submit" class="btn">Sign In</button>
      <?php
      if (!empty($_SESSION['error'])) {
        echo '<p class="error-msg">' . $_SESSION['error'] . '</p>';
        unset($_SESSION['error']);
      }

      if (!empty($_SESSION['success'])) {
        echo '<p class="success-msg">' . $_SESSION['success'] . '</p>';
        unset($_SESSION['success']);
      }
      ?>
    </form>

    <p class="or">OR</p>

    <button class="social-btn google">
      <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg" alt="Google">
      Continue with Google
    </button>

    <button class="social-btn facebook">
      <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/facebook/facebook-original.svg" alt="Facebook">
      Continue with Facebook
    </button>

    <p class="switch">Don’t have an account? <a href="sign-up.php">Sign Up</a></p>
  </div>
</body>

</html>