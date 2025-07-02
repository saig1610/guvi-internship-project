<?php
require '../vendor/autoload.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    if (!$email) {
        echo json_encode(["success" => false, "message" => "No email provided"]);
        exit;
    }

    $mysql = new mysqli("localhost", "root", "", "guvi_intern");

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
        $client = new MongoDB\Client("mongodb://localhost:27017");
        $collection = $client->guvi->profiles;

        $collection->updateOne(
            ["email" => $user['email']],
            ['$set' => $user],
            ['upsert' => true]
        );

        echo json_encode(["success" => true, "message" => "User synced to MongoDB"]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}
