<?php
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = [
        'id' => 1,
        'username' => 'user123',
        'email' => 'user@example.com'
    ];
}

echo "<h2>User Information</h2>";
echo "<p>User ID: {$_SESSION['user']['id']}</p>";
echo "<p>Username: {$_SESSION['user']['username']}</p>";
echo "<p>Email: {$_SESSION['user']['email']}</p>";

$_SESSION['user']['username'] = 'newuser123';
?>

<a href="logout.php">Logout</a>
