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

$email = $input['email'] ?? '';
$password = $input['password'] ?? '';

// Basic validation
if (empty($email) || empty($password)) {
    echo json_encode(['error' => 'Email and password are required']);
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['error' => 'Invalid email format']);
    exit();
}

// For demo purposes - in production, you'd check against database
// Here we'll simulate a successful login for any valid email/password combination
if (strlen($password) >= 6) {
    // Generate API key for successful login
    $api_key = bin2hex(random_bytes(16));
    
    echo json_encode([
        'success' => true,
        'api_key' => $api_key,
        'message' => 'Login successful'
    ]);
} else {
    echo json_encode(['error' => 'Invalid credentials']);
}
?>
