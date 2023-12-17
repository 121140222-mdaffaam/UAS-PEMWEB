<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

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

if (isset($_GET['del'])) {
    $delete = $_GET['del'];
    $delete_query = "DELETE FROM users WHERE id = '$delete'";

    if (mysqli_query($conn, $delete_query)) {
        echo '<script>alert("Data berhasil dihapus.");</script>';
        echo '<script>window.location.href = "dashboard.php";</script>';
        exit();
    } else {
        echo "Error: " . $delete_query . "<br>" . mysqli_error($conn);
    }
}

$users = getUsersFromDatabase();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Dashboard</h2>
    <p style='color: white;'>User ID: <?php echo $_SESSION['user']['id']; ?></p>
    <p style='color: white;'>Username: <?php echo $_SESSION['user']['username']; ?></p>
    <p style='color: white;'>Email: <?php echo $_SESSION['user']['email']; ?></p>

    <h3>User List</h3>
    <table border="1" id="user_list">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><form action="dashboard.php" method="get">
                    <input type="hidden" name="del" value="<?php echo $user['id']; ?>">
                    <button type="submit">Hapus</button>
                </form></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="index.html" class="button">Beranda</a>
    <a href="logout.php" class="button">Logout</a>
</body>
</html>
