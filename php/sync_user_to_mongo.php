<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    if (!$email) {
        echo json_encode(["success" => false, "message" => "No email provided"]);
        exit;
    }

    
    $mysql = new mysqli(
        $_ENV['DB_HOST'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        $_ENV['DB_NAME']
    );

    if ($mysql->connect_error) {
        echo json_encode(["success" => false, "message" => "MySQL connection failed"]);
        exit;
    }

    
    $stmt = $mysql->prepare("SELECT name, email, age, dob, contact FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    $user = $res->fetch_assoc();

    if (!$user) {
        echo json_encode(["success" => false, "message" => "User not found"]);
        exit;
    }

    try {
        
        require_once 'mongo.php';

        $collection->updateOne(
            ["email" => $user['email']],
            ['$set' => $user],
            ['upsert' => true]
        );

        echo json_encode(["success" => true, "message" => "User synced to MongoDB"]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "MongoDB sync failed: " . $e->getMessage()]);
    }
}
