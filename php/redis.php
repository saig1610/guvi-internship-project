<?php
require_once __DIR__ . '/../vendor/autoload.php';

try {
    $redis = new Predis\Client(); // Default localhost:6379
} catch (Exception $e) {
    $redis = null; // Redis not available, but code will not crash
}
