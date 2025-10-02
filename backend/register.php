<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm_password']);

    if (empty($name) || empty($email) || empty($password) || empty($confirm)) {
        $_SESSION['error'] = "All fields are required";
        header("Location: ../sign-up.php");
        exit();
    }

    if ($password !== $confirm) {
        $_SESSION['error'] = "Passwords do not match";
        header("Location: ../sign-up.php");
        exit();
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $provider = 'local';

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "Email already registered";
        $stmt->close();
        header("Location: ../sign-up.php");
        exit();
    }
    $stmt->close();

    //  Handle profile image
    $profile_img = NULL;
    if (!empty($_FILES['profile_img']['name'])) {
        $targetDir = "../uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0744, true);
        }

        $fileName = time() . "_" . basename($_FILES["profile_img"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["profile_img"]["tmp_name"], $targetFilePath)) {
            $profile_img = $fileName;
        }
    }

    //  Insert user (with image)
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, profile_img, provider) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $password_hash, $profile_img, $provider);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful! Please login.";
        header("Location: ../sign-in.php");
        exit();
    } else {
        $_SESSION['error'] = "Database error: " . $stmt->error;
        header("Location: ../sign-up.php");
        exit();
    }
}
?>
