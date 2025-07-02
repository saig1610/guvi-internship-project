<?php
header('Content-Type: application/json');

// 1. MySQL connection
$host = "localhost";
$dbname = "guvi_intern";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database connection failed."]);
    exit();
}

// 2. Collect and sanitize input
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$pass = $_POST['password'] ?? '';
$age = trim($_POST['age'] ?? '');
$dob = trim($_POST['dob'] ?? '');
$contact = trim($_POST['contact'] ?? '');

// 3. Validate required fields
if (!$name || !$email || !$pass || !$age || !$dob || !$contact) {
    echo json_encode(["status" => "error", "message" => "All fields are required."]);
    exit();
}

// 4. Hash the password
$hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

// 5. Check if email already exists
try {
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $checkStmt->execute([$email]);
    if ($checkStmt->fetchColumn() > 0) {
        echo json_encode(["status" => "error", "message" => "Email already exists."]);
        exit();
    }

    // ✅ 6. Insert into MySQL (with all fields!)
    $insertStmt = $pdo->prepare("INSERT INTO users (name, email, password, age, dob, contact) VALUES (?, ?, ?, ?, ?, ?)");
    $insertStmt->execute([$name, $email, $hashedPassword, $age, $dob, $contact]);

} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "MySQL error: " . $e->getMessage()]);
    exit();
}

// 7. Insert into MongoDB
try {
    require '../vendor/autoload.php';

    $client = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $client->guvi->profiles;

    $collection->insertOne([
        "name" => $name,
        "email" => $email,
        "age" => $age,
        "dob" => $dob,
        "contact" => $contact
    ]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "MongoDB error: " . $e->getMessage()]);
    exit();
}

// 8. Final success response
echo json_encode(["status" => "success", "message" => "Signup successful!"]);
?>
