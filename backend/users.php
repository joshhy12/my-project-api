<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}

require 'db.php';
$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head><title>Users</title></head>
<body>
    <h2>Registered Users</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>API Key</th><th>Actions</th>
        </tr>
        <?php foreach ($users as $user) { ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['api_key'] ?></td>
            <td><a href="delete.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
        </tr>
        <?php } ?>
    </table><br>
    <a href="admin.php"><button>Back to Dashboard</button></a>
</body>
</html>
