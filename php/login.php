<?php
require_once __DIR__ . '/config.php';

header("Content-Type: application/json");

// Get POST data
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Validate inputs
if (!$email || !$password) {
    echo json_encode(["success" => false, "message" => "Email and password are required."]);
    exit;
}

try {
    // Prepare and execute query
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid email or password."]);
    }
} catch (PDOException $e) {
    // Don’t expose error to frontend for security
    echo json_encode(["success" => false, "message" => "Server error. Please try again."]);
}
