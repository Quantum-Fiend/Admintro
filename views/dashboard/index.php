<?php
require_once __DIR__ . '/../../config/bootstrap.php';
use App\Middleware\CsrfMiddleware;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?php echo config('app.name'); ?></title>
    <link rel="stylesheet" href="/public/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php echo CsrfMiddleware::metaTag(); ?>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="/dashboard" class="logo">
                    <i class="fas fa-shield-alt"></i> Admin
                </a>
            </div>
            
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="/dashboard" class="active">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/users">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/analytics">
                        <i class="fas fa-chart-line"></i>
                        <span>Analytics</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/settings">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/activity">
                        <i class="fas fa-history"></i>
                        <span>Activity Logs</span>
                    </a>
                </li>
            </ul>
            
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-details">
                        <div class="name"><?php echo htmlspecialchars($user->username); ?></div>
                        <div class="role"><?php echo ucfirst($user->role); ?></div>
                    </div>
                    <a href="/logout" style="color: rgba(255,255,255,0.6); font-size: 1.2rem;">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Navbar -->
            <nav class="navbar">
                <div class="navbar-left">
                    <h1 class="page-title">Dashboard</h1>
                </div>
                <div class="navbar-right">
                    <div class="notification-icon">
                        <i class="fas fa-bell"></i>
                        <?php if (count($notifications) > 0): ?>
                            <span class="badge"><?php echo count($notifications); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="theme-toggle">
                        <i class="fas fa-moon"></i>
                    </div>
                </div>
            </nav>
            
            <!-- Stats Cards -->
            <div class="grid grid-4 mt-4 animate-fade-in">
                <div class="stat-card">
                    <div class="stat-icon primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-value"><?php echo $stats['total_users']; ?></div>
                    <div class="stat-label">Total Users</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon success">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="stat-value"><?php echo $stats['total_admins']; ?></div>
                    <div class="stat-label">Administrators</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon primary">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="stat-value"><?php echo $stats['active_users']; ?></div>
                    <div class="stat-label">Active Users</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon danger">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="stat-value"><?php echo $stats['new_users_today']; ?></div>
                    <div class="stat-label">New Today</div>
                </div>
            </div>
            
            <!-- Recent Activity -->
            <div class="grid grid-2 mt-4">
                <div class="card animate-slide-left">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-history"></i> Recent Activity
                        </h2>
                    </div>
                    <div class="card-body">
                        <?php if (count($recentActivities) > 0): ?>
                            <div class="activity-list">
                                <?php foreach ($recentActivities as $activity): ?>
                                    <div class="activity-item" style="padding: 1rem; border-bottom: 1px solid rgba(255,255,255,0.05);">
                                        <div style="display: flex; align-items: center; gap: 1rem;">
                                            <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(100, 200, 255, 0.2); display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-bolt" style="color: #00f2fe;"></i>
                                            </div>
                                            <div style="flex: 1;">
                                                <div style="color: white; font-weight: 500;">
                                                    <?php echo htmlspecialchars($activity->user ? $activity->user->username : 'System'); ?>
                                                </div>
                                                <div style="color: rgba(255,255,255,0.6); font-size: 0.875rem;">
                                                    <?php echo htmlspecialchars($activity->description); ?>
                                                </div>
                                                <div style="color: rgba(255,255,255,0.4); font-size: 0.75rem; margin-top: 0.25rem;">
                                                    <?php echo $activity->created_at->diffForHumans(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p style="text-align: center; color: rgba(255,255,255,0.5);">No recent activity</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Notifications -->
                <div class="card animate-slide-right">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-bell"></i> Notifications
                        </h2>
                    </div>
                    <div class="card-body">
                        <?php if (count($notifications) > 0): ?>
                            <div class="notification-list">
                                <?php foreach ($notifications as $notification): ?>
                                    <div class="notification-item" style="padding: 1rem; border-bottom: 1px solid rgba(255,255,255,0.05);">
                                        <div style="display: flex; align-items: start; gap: 1rem;">
                                            <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(245, 87, 108, 0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                <i class="fas fa-info-circle" style="color: #f5576c;"></i>
                                            </div>
                                            <div style="flex: 1;">
                                                <div style="color: white; font-weight: 500; margin-bottom: 0.25rem;">
                                                    <?php echo htmlspecialchars($notification->title); ?>
                                                </div>
                                                <div style="color: rgba(255,255,255,0.6); font-size: 0.875rem;">
                                                    <?php echo htmlspecialchars($notification->message); ?>
                                                </div>
                                                <div style="color: rgba(255,255,255,0.4); font-size: 0.75rem; margin-top: 0.25rem;">
                                                    <?php echo $notification->created_at->diffForHumans(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p style="text-align: center; color: rgba(255,255,255,0.5);">No new notifications</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="card mt-4 animate-fade-in">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-bolt"></i> Quick Actions
                    </h2>
                </div>
                <div class="card-body">
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <a href="/users/create" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> Add New User
                        </a>
                        <a href="/export/users" class="btn btn-success">
                            <i class="fas fa-file-export"></i> Export Data
                        </a>
                        <a href="/settings" class="btn">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
