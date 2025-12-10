<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Respect\Validation\Validator as v;

class UserController
{
    /**
     * List all users
     */
    public function index()
    {
        $this->requireAdmin();
        
        $users = User::orderBy('created_at', 'desc')->get();
        require __DIR__ . '/../../views/users/index.php';
    }
    
    /**
     * Show create user form
     */
    public function create()
    {
        $this->requireAdmin();
        require __DIR__ . '/../../views/users/create.php';
    }
    
    /**
     * Store new user
     */
    public function store()
    {
        $this->requireAdmin();
        
        $data = [
            'username' => $_POST['username'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
            'role' => $_POST['role'] ?? 'user',
        ];
        
        // Validate
        $errors = $this->validateUser($data);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: /users/create');
            exit;
        }
        
        // Create user
        $user = User::create($data);
        
        // Log activity
        ActivityLog::log($_SESSION['user_id'], 'user_created', 'Created user: ' . $user->username);
        
        $_SESSION['success'] = 'User created successfully';
        header('Location: /users');
        exit;
    }
    
    /**
     * Show edit user form
     */
    public function edit($id)
    {
        $this->requireAdmin();
        
        $user = User::findOrFail($id);
        require __DIR__ . '/../../views/users/edit.php';
    }
    
    /**
     * Update user
     */
    public function update($id)
    {
        $this->requireAdmin();
        
        $user = User::findOrFail($id);
        
        $data = [
            'username' => $_POST['username'] ?? $user->username,
            'email' => $_POST['email'] ?? $user->email,
            'role' => $_POST['role'] ?? $user->role,
        ];
        
        if (!empty($_POST['password'])) {
            $data['password'] = $_POST['password'];
        }
        
        $user->update($data);
        
        ActivityLog::log($_SESSION['user_id'], 'user_updated', 'Updated user: ' . $user->username);
        
        $_SESSION['success'] = 'User updated successfully';
        header('Location: /users');
        exit;
    }
    
    /**
     * Delete user
     */
    public function delete($id)
    {
        $this->requireAdmin();
        
        $user = User::findOrFail($id);
        $username = $user->username;
        
        $user->delete();
        
        ActivityLog::log($_SESSION['user_id'], 'user_deleted', 'Deleted user: ' . $username);
        
        $_SESSION['success'] = 'User deleted successfully';
        header('Location: /users');
        exit;
    }
    
    /**
     * Validate user data
     */
    private function validateUser($data)
    {
        $errors = [];
        
        if (!v::alnum('_')->length(3, 50)->validate($data['username'])) {
            $errors['username'] = 'Username must be 3-50 characters and alphanumeric';
        }
        
        if (!v::email()->validate($data['email'])) {
            $errors['email'] = 'Invalid email address';
        }
        
        if (!v::length(6)->validate($data['password'])) {
            $errors['password'] = 'Password must be at least 6 characters';
        }
        
        if (!in_array($data['role'], ['user', 'admin', 'super_admin'])) {
            $errors['role'] = 'Invalid role';
        }
        
        return $errors;
    }
    
    /**
     * Require admin access
     */
    private function requireAdmin()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /');
            exit;
        }
        
        $user = User::find($_SESSION['user_id']);
        if (!$user->isAdmin()) {
            http_response_code(403);
            die('Access denied');
        }
    }
}
