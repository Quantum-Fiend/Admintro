<?php
require_once __DIR__ . '/../config/bootstrap.php';
$title = $title ?? 'Page';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - <?php echo config('app.name'); ?></title>
    <link rel="stylesheet" href="/public/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                    <a href="/dashboard">
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
                    <a href="/analytics" class="<?php echo $title === 'Analytics' ? 'active' : ''; ?>">
                        <i class="fas fa-chart-line"></i>
                        <span>Analytics</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/settings" class="<?php echo $title === 'Settings' ? 'active' : ''; ?>">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/activity" class="<?php echo $title === 'Activity Logs' ? 'active' : ''; ?>">
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
                        <div class="name"><?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?></div>
                        <div class="role"><?php echo ucfirst($_SESSION['role'] ?? 'admin'); ?></div>
                    </div>
                    <a href="/logout" style="color: rgba(255,255,255,0.6); font-size: 1.2rem;">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <div style="min-height: 80vh; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="glass-card" style="padding: 4rem; max-width: 600px;">
                    <i class="fas fa-rocket" style="font-size: 4rem; margin-bottom: 2rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                    <h1 style="font-size: 2.5rem; margin-bottom: 1rem; color: white;"><?php echo $title; ?></h1>
                    <p style="color: rgba(255,255,255,0.7); font-size: 1.1rem; margin-bottom: 2rem;">
                        This feature is currently under development. Stay tuned!
                    </p>
                    <a href="/dashboard" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
