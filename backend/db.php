<?php
$host = "localhost";
$user = "root";      // MySQL username
$pass = "";          // MySQL password (XAMPP default: empty)
$dbname = "tralive";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
