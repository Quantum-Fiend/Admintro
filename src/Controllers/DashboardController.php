<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use App\Models\Notification;

class DashboardController
{
    /**
     * Show dashboard
     */
    public function index()
    {
        $this->requireAuth();
        
        $user = $this->getCurrentUser();
        $stats = $this->getDashboardStats();
        $recentActivities = $this->getRecentActivities();
        $notifications = $this->getUnreadNotifications();
        
        require __DIR__ . '/../../views/dashboard/index.php';
    }
    
    /**
     * Get dashboard statistics
     */
    private function getDashboardStats()
    {
        $sevenDaysAgo = date('Y-m-d H:i:s', strtotime('-7 days'));
        $today = date('Y-m-d');
        
        return [
            'total_users' => User::count(),
            'total_admins' => User::where('role', 'admin')->orWhere('role', 'super_admin')->count(),
            'active_users' => User::where('last_login', '>=', $sevenDaysAgo)->count(),
            'new_users_today' => User::whereDate('created_at', $today)->count(),
        ];
    }
    
    /**
     * Get recent activities
     */
    private function getRecentActivities()
    {
        return ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
    }
    
    /**
     * Get unread notifications
     */
    private function getUnreadNotifications()
    {
        $userId = $_SESSION['user_id'];
        return Notification::where('user_id', $userId)
            ->whereNull('read_at')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    }
    
    /**
     * Get current user
     */
    private function getCurrentUser()
    {
        return User::find($_SESSION['user_id']);
    }
    
    /**
     * Require authentication
     */
    private function requireAuth()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /');
            exit;
        }
    }
}
