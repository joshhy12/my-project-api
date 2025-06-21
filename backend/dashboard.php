<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");

require 'auth.php';

$user = authenticate();

echo json_encode(["message" => "Welcome to your dashboard, " . $user['name']]);
?>
