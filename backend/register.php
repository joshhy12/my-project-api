<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit();
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['error' => 'Invalid JSON']);
    exit();
}

$name = $input['name'] ?? '';
$email = $input['email'] ?? '';
$password = $input['password'] ?? '';

// Basic validation
if (empty($name) || empty($email) || empty($password)) {
    echo json_encode(['error' => 'All fields are required']);
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['error' => 'Invalid email format']);
    exit();
}

// For demo purposes, generate a simple API key
// In production, you'd save to database and use proper hashing
$api_key = bin2hex(random_bytes(16));

// Here you would typically:
// 1. Hash the password
// 2. Save user to database
// 3. Generate proper API key

// For now, just return success
echo json_encode([
    'success' => true,
    'api_key' => $api_key,
    'message' => 'User registered successfully'
]);
?>
