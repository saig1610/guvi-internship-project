<?php
header("Content-Type: application/json");

// Load MongoDB library
require '../vendor/autoload.php';

$email = $_POST['email'] ?? '';

if (!$email) {
    echo json_encode(["success" => false, "message" => "Email is required"]);
    exit;
}

try {
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $client->guvi->profiles;

    $user = $collection->findOne(['email' => $email]);

    if ($user) {
        $userArray = json_decode(json_encode($user), true);
        unset($userArray['_id']);
        echo json_encode(["success" => true, "user" => $userArray]);
    } else {
        echo json_encode(["success" => false, "message" => "User not found in MongoDB"]);
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "MongoDB error: " . $e->getMessage()]);
}
