<?php
function authenticate() {
    $headers = apache_request_headers();

    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(["error" => "API Key missing"]);
        exit;
    }

    $api_key = $headers['Authorization'];

    require 'db.php';
    $stmt = $conn->prepare("SELECT * FROM users WHERE api_key = ?");
    $stmt->execute([$api_key]);
    $user = $stmt->fetch();

    if (!$user) {
        http_response_code(403);
        echo json_encode(["error" => "Invalid API Key"]);
        exit;
    }

    return $user;
}
?>
