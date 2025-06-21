<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // For demo purposes, you can hardcode admin credentials
    if ($username == 'admin' && $password == 'admin123') {
        $_SESSION['admin'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = "Invalid login!";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Admin Login</title></head>
<link rel="stylesheet" href="style.css">

<body>
    <h2>Admin Login</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
