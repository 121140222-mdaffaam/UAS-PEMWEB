<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    if ($username === "user123" && $password === "password123") {
        $_SESSION['user'] = [
            'id' => 1,
            'username' => $username,
            'email' => 'user@example.com'
        ];

        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid username or password";
    }
}
?>
