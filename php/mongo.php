<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$client = new MongoDB\Client($_ENV['MONGO_URI']);
$collection = $client->selectCollection($_ENV['MONGO_DB'], 'profiles');
