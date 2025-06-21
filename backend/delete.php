<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}

if (isset($_GET['id'])) {
    require 'db.php';
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}

header('Location: users.php');
exit;
?>
