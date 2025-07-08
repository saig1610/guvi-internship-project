<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

header("Content-Type: application/json");

$email = $_POST['email'] ?? '';
$age = $_POST['age'] ?? '';
$dob = $_POST['dob'] ?? '';
$contact = $_POST['contact'] ?? '';

if (!$email) {
    echo json_encode(["success" => false, "message" => "Email is required"]);
    exit;
}

try {
    $client = new MongoDB\Client($_ENV['MONGO_URI']);
    $collection = $client->selectCollection($_ENV['MONGO_DB'], 'profiles');

    $updateResult = $collection->updateOne(
        ['email' => $email],
        ['$set' => ['age' => $age, 'dob' => $dob, 'contact' => $contact]],
        ['upsert' => true]
    );

    echo json_encode(["success" => true]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "MongoDB update failed: " . $e->getMessage()]);
}
