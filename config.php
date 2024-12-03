<?php

// Load environment variables from the .env file
function loadEnv() {
    $envFile = __DIR__ . '/.env';
    
    if (!file_exists($envFile)) {
        throw new Exception('Environment file .env not found');
    }

    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '#') === 0) continue; // Skip comments
        list($key, $value) = explode('=', $line, 2);
        $_ENV[$key] = $value;
    }
}

// Load the environment variables
loadEnv();

// Check if the API key for BallDon'tLie is loaded
if (!isset($_ENV['BALLDONTLIE_API_KEY'])) {
    throw new Exception("API Key for BallDon'tLie is not set.");
}

