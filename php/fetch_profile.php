<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

header("Content-Type: application/json");

$email = $_POST['email'] ?? '';

if (!$email) {
    echo json_encode(["success" => false, "message" => "Email is required"]);
    exit;
}

try {
    
    require_once 'mongo.php';

    $user = $collection->findOne(['email' => $email]);

    if ($user) {
        $userArray = json_decode(json_encode($user), true);
        unset($userArray['_id']); 
        echo json_encode(["success" => true, "user" => $userArray]);
    } else {
        echo json_encode(["success" => false, "message" => "User not found"]);
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "MongoDB error: " . $e->getMessage()]);
}
