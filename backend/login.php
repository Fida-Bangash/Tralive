<?php
session_start();
include "db.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Both fields are required";
        header("Location: ../sign-in.php");
        exit();
    }

    // Get full user info
    $stmt = $conn->prepare("SELECT id, name, email, password, profile_img 
                            FROM users 
                            WHERE email = ? AND provider='local'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $name, $email_db, $hashed_password, $profile_img);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Save full user info in session
            $_SESSION['user_id'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email_db;
            $_SESSION['profile_img'] = $profile_img;

            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['error'] = "Incorrect password";
            header("Location: ../sign-in.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Email not registered";
        header("Location: ../sign-in.php");
        exit();
    }
}
?>
