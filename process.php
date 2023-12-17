<?php
require_once 'db_connection.php';

$dbConnection = new DatabaseConnection();
$conn = $dbConnection->getConnection();

function getUsersFromDatabase() {
    global $conn;
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);

    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }

    return $users;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = ($_POST["email"]);
    $age = intval($_POST["age"]);
    $gender = $_POST['gender'];
    $subscribe = $_POST['subscribe'];

    if (empty($name) || empty($email)) {
        die("Invalid input. Please fill in all the fields with valid data.");
    }

    $browser = mysqli_real_escape_string($conn, $_SERVER['HTTP_USER_AGENT']);
    $ip_address = $_SERVER['REMOTE_ADDR'];

    $query = "INSERT INTO users (name, email, age, gender, subscribe, browser, ip_address) VALUES ('$name', '$email', $age, '$gender', $subscribe, '$browser', '$ip_address')";


    if (mysqli_query($conn, $query)) {
        echo "<p style='color: white;'>Data added to the database successfully.</p>";
        $_SESSION['users'] = getUsersFromDatabase();
    } else {
        echo "<p>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>";
    }

    

    
} 
    echo "<h2>Data yang tersimpan dalam database</h2>";
    echo "<table id='dataTable' border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th><th>Gender</th><th>Subscribe</th><th>browser</th><th>ip_address</th></tr>";

    foreach ($_SESSION['users'] as $user) {
        echo "<tr>";
        echo "<td>{$user['id']}</td>";
        echo "<td>{$user['name']}</td>";
        echo "<td>{$user['email']}</td>";
        echo "<td>{$user['age']}</td>";
        echo "<td>{$user['gender']}</td>";
        echo "<td>{$user['subscribe']}</td>";
        echo "<td>{$user['browser']}</td>";
        echo "<td>{$user['ip_address']}</td>";
        echo "</tr>";
    }

    echo "</table>";

    mysqli_close($conn);
?>
