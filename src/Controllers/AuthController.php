<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController
{
    /**
     * Show login page
     */
    public function showLogin()
    {
        if ($this->isAuthenticated()) {
            header('Location: /dashboard');
            exit;
        }
        
        require __DIR__ . '/../../views/auth/login.php';
    }
    
    /**
     * Handle login request
     */
    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        // Validate input
        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Email and password are required';
            header('Location: /');
            exit;
        }
        
        // Find user
        $user = User::where('email', $email)->first();
        
        if (!$user || !$user->verifyPassword($password)) {
            ActivityLog::log(null, 'login_failed', 'Failed login attempt for: ' . $email);
            $_SESSION['error'] = 'Invalid credentials';
            header('Location: /');
            exit;
        }
        
        // Update last login
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();
        
        // Generate JWT token
        $token = $this->generateJwtToken($user);
        
        // Set session
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_role'] = $user->role;
        $_SESSION['jwt_token'] = $token;
        
        // Log activity
        ActivityLog::log($user->id, 'login', 'User logged in successfully');
        
        $_SESSION['success'] = 'Login successful! Welcome back.';
        header('Location: /dashboard');
        exit;
    }
    
    /**
     * Handle logout
     */
    public function logout()
    {
        if (isset($_SESSION['user_id'])) {
            ActivityLog::log($_SESSION['user_id'], 'logout', 'User logged out');
        }
        
        session_destroy();
        header('Location: /');
        exit;
    }
    
    /**
     * Generate JWT token
     */
    private function generateJwtToken($user)
    {
        $payload = [
            'iss' => config('app.url'),
            'iat' => time(),
            'exp' => time() + config('app.jwt.expiration'),
            'user_id' => $user->id,
            'role' => $user->role,
        ];
        
        return JWT::encode($payload, config('app.jwt.secret'), 'HS256');
    }
    
    /**
     * Validate CSRF token
     */
    private function validateCsrfToken()
    {
        $token = $_POST['csrf_token'] ?? '';
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    
    /**
     * Check if user is authenticated
     */
    private function isAuthenticated()
    {
        return isset($_SESSION['user_id']);
    }
    
    /**
     * JSON response helper
     */
    private function jsonResponse($data, $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
