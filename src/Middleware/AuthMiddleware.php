<?php

namespace App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware
{
    /**
     * Handle authentication
     */
    public static function handle()
    {
        // Check session
        if (!isset($_SESSION['user_id'])) {
            header('Location: /');
            exit;
        }
        
        // Validate JWT if present
        if (isset($_SESSION['jwt_token'])) {
            try {
                $decoded = JWT::decode(
                    $_SESSION['jwt_token'],
                    new Key(config('app.jwt.secret'), 'HS256')
                );
                
                // Check if token is expired
                if ($decoded->exp < time()) {
                    session_destroy();
                    header('Location: /');
                    exit;
                }
            } catch (\Exception $e) {
                session_destroy();
                header('Location: /');
                exit;
            }
        }
        
        return true;
    }
    
    /**
     * Check if user has role
     */
    public static function hasRole($role)
    {
        if (!isset($_SESSION['user_role'])) {
            return false;
        }
        
        $userRole = $_SESSION['user_role'];
        
        if ($role === 'admin') {
            return in_array($userRole, ['admin', 'super_admin']);
        }
        
        return $userRole === $role;
    }
}
