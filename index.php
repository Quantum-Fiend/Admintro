<?php

require_once __DIR__ . '/config/bootstrap.php';

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\UserController;

// Get the request URI and method
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Remove trailing slash
$requestUri = rtrim($requestUri, '/');
if (empty($requestUri)) {
    $requestUri = '/';
}

// Simple routing
switch ($requestUri) {
    // Auth routes
    case '/':
        if ($requestMethod === 'GET') {
            $controller = new AuthController();
            $controller->showLogin();
        }
        break;
        
    case '/login':
        if ($requestMethod === 'POST') {
            $controller = new AuthController();
            $controller->login();
        } else {
            header('Location: /');
        }
        break;
        
    case '/logout':
        $controller = new AuthController();
        $controller->logout();
        break;
        
    // Dashboard routes
    case '/dashboard':
        $controller = new DashboardController();
        $controller->index();
        break;
        
    // Placeholder routes
    case '/analytics':
        $controller = new \App\Controllers\PlaceholderController();
        $controller->analytics();
        break;

    case '/settings':
        $controller = new \App\Controllers\PlaceholderController();
        $controller->settings();
        break;

    case '/activity':
        $controller = new \App\Controllers\PlaceholderController();
        $controller->activity();
        break;

    // User routes
    case '/users':
        if ($requestMethod === 'GET') {
            $controller = new UserController();
            $controller->index();
        }
        break;
        
    case '/users/create':
    // ... rest of code
        if ($requestMethod === 'GET') {
            $controller = new UserController();
            $controller->create();
        } elseif ($requestMethod === 'POST') {
            $controller = new UserController();
            $controller->store();
        }
        break;
        
    // Handle user edit/delete with ID
    default:
        if (preg_match('/^\/users\/(\d+)\/edit$/', $requestUri, $matches)) {
            $controller = new UserController();
            $controller->edit($matches[1]);
        } elseif (preg_match('/^\/users\/(\d+)\/update$/', $requestUri, $matches)) {
            $controller = new UserController();
            $controller->update($matches[1]);
        } elseif (preg_match('/^\/users\/(\d+)\/delete$/', $requestUri, $matches)) {
            $controller = new UserController();
            $controller->delete($matches[1]);
        } else {
            // 404 Not Found
            http_response_code(404);
            echo '<!DOCTYPE html>
<html>
<head>
    <title>404 - Page Not Found</title>
    <link rel="stylesheet" href="/public/css/app.css">
</head>
<body>
    <div style="min-height: 100vh; display: flex; align-items: center; justify-content: center;">
        <div class="glass-card" style="text-align: center; max-width: 500px;">
            <h1 style="font-size: 6rem; margin: 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">404</h1>
            <h2 style="color: white; margin: 1rem 0;">Page Not Found</h2>
            <p style="color: rgba(255,255,255,0.7); margin-bottom: 2rem;">The page you are looking for does not exist.</p>
            <a href="/dashboard" class="btn btn-primary">
                <i class="fas fa-home"></i> Go to Dashboard
            </a>
        </div>
    </div>
</body>
</html>';
        }
        break;
}