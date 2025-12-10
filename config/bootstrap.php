<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager as Capsule;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Setup database connection
$capsule = new Capsule;
$capsule->addConnection(require __DIR__ . '/../config/database.php');
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Start session with proper configuration
if (session_status() === PHP_SESSION_NONE) {
    // Set session cookie parameters
    session_set_cookie_params([
        'lifetime' => 86400, // 24 hours
        'path' => '/',
        'domain' => '',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

// Helper function to get env variables
if (!function_exists('env')) {
    function env($key, $default = null) {
        return $_ENV[$key] ?? $default;
    }
}

// Helper function to get config
if (!function_exists('config')) {
    function config($key, $default = null) {
        $keys = explode('.', $key);
        $file = array_shift($keys);
        $config = require __DIR__ . '/../config/' . $file . '.php';
        
        foreach ($keys as $k) {
            $config = $config[$k] ?? $default;
        }
        
        return $config;
    }
}

return $capsule;
