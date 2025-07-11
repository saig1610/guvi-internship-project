<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/redis.php';

header("Content-Type: application/json");

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    echo json_encode(["success" => false, "message" => "Email and password are required."]);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // ✅ Set email in Redis with 5 min expiry
        if ($redis) {
            $redis->setex("loggedInUser:$email", 300, $email); // 5 minutes
        }

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid email or password."]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Server error. Please try again."]);
}
