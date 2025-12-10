<?php
// Router script for PHP built-in server
// This file handles routing when using: php -S localhost:8000 router.php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Serve static files directly
$filePath = __DIR__ . $uri;
if ($uri !== '/' && file_exists($filePath)) {
    return false; // Serve the requested resource as-is
}

// Check if file exists in public folder if not found in root (for cleaner URLs if needed)
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false; 
}

// Route all other requests through index.php
require __DIR__ . '/index.php';
