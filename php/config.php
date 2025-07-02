<?php
$host = "localhost";
$dbname = "guvi_intern";
$username = "root";
$password = ""; // Default for XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Proper JSON response on DB error
    header('Content-Type: application/json');
    echo json_encode([
        "success" => false,
        "message" => "DB connection failed"
    ]);
    exit;
}
