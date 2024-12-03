<?php

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

// Call the function to load the variables
loadEnv();
