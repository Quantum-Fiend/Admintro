<?php
require_once __DIR__ . '/../../config/bootstrap.php';
// Use same layout structure as dashboard
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - <?php echo config('app.name'); ?></title>
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
                    <a href="/users" class="active">
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
                        <div class="name"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></div>
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
            <!-- Navbar -->
            <nav class="navbar">
                <div class="navbar-left">
                    <h1 class="page-title">Users</h1>
                </div>
                <!-- ... navbar right ... -->
            </nav>
            
            <!-- Content -->
            <div class="card mt-4 animate-fade-in">
                <div class="card-header">
                    <h2 class="card-title">User Management</h2>
                    <a href="/users/create" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add User
                    </a>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success mb-3">
                            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>

                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $u): ?>
                                <tr>
                                    <td>#<?php echo $u->id; ?></td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <div class="avatar-sm" style="width: 32px; height: 32px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-user" style="font-size: 0.8rem;"></i>
                                            </div>
                                            <?php echo htmlspecialchars($u->username); ?>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($u->email); ?></td>
                                    <td>
                                        <span class="glass-badge">
                                            <?php echo ucfirst($u->role); ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('M d, Y', strtotime($u->created_at)); ?></td>
                                    <td>
                                        <a href="/users/<?php echo $u->id; ?>/edit" class="btn btn-sm" style="padding: 0.25rem 0.5rem; color: #4facfe;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="/users/<?php echo $u->id; ?>/delete" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                            <button type="submit" class="btn btn-sm" style="padding: 0.25rem 0.5rem; color: #fa709a; background: none; border: none;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination (simplified) -->
                    <div class="mt-4" style="display: flex; justify-content: flex-end;">
                        <!-- Add pagination links here if supported by ORM logic -->
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
