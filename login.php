<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <h2>Login Page</h2>
    <form action="process_login.php" method="post" class="lp">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required placeholder="username -> user123">
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required placeholder="password -> password123">
        
        <button type="submit">Login</button>
    </form>
    <br>
    <a href="index.html" class="button">Beranda</a>

</body>
</html>
