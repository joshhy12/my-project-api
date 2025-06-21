<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

require 'db.php';

$data = json_decode(file_get_contents("php://input"));

if (empty($data->name) || empty($data->email) || empty($data->password)) {
    echo json_encode(["error" => "All fields are required"]);
    exit;
}

$name = $data->name;
$email = $data->email;
$password = password_hash($data->password, PASSWORD_BCRYPT);
$api_key = bin2hex(random_bytes(16));

$stmt = $conn->prepare("INSERT INTO users (name, email, password, api_key) VALUES (?, ?, ?, ?)");

try {
    $stmt->execute([$name, $email, $password, $api_key]);
    echo json_encode(["message" => "User registered successfully", "api_key" => $api_key]);
} catch (PDOException $e) {
    echo json_encode(["error" => "Email already exists"]);
}
?>
