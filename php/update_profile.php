<?php
header("Content-Type: application/json");

require '../vendor/autoload.php';

$email = $_POST['email'] ?? '';
$age = $_POST['age'] ?? '';
$dob = $_POST['dob'] ?? '';
$contact = $_POST['contact'] ?? '';

if (!$email) {
    echo json_encode(["success" => false, "message" => "Email is required"]);
    exit;
}

try {
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $client->guvi->profiles;

    $updateResult = $collection->updateOne(
        ['email' => $email],
        ['$set' => [
            'age' => $age,
            'dob' => $dob,
            'contact' => $contact
        ]],
        ['upsert' => true] // Will create the document if it doesn't exist
    );

    echo json_encode(["success" => true]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "MongoDB update failed: " . $e->getMessage()]);
}
