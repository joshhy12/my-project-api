<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<link rel="stylesheet" href="style.css">

<html>
<head><title>Admin Dashboard</title></head>
<body>
    <h2>Admin Dashboard</h2>
    <a href="users.php"><button>View Users</button></a>
    <a href="index.php"><button>Logout</button></a>
</body>
</html>
