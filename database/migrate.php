<?php

require_once __DIR__ . '/../config/bootstrap.php';

use Illuminate\Database\Capsule\Manager as Capsule;

echo "Running migrations...\n\n";

// Create users table
echo "Creating users table...";
Capsule::schema()->dropIfExists('users');
Capsule::schema()->create('users', function ($table) {
    $table->id();
    $table->string('username', 50)->unique();
    $table->string('email', 100)->unique();
    $table->string('password');
    $table->enum('role', ['user', 'admin', 'super_admin'])->default('user');
    $table->string('avatar')->nullable();
    $table->string('two_factor_secret')->nullable();
    $table->boolean('two_factor_enabled')->default(false);
    $table->timestamp('last_login')->nullable();
    $table->integer('login_attempts')->default(0);
    $table->timestamps();
    $table->softDeletes();
});
echo " Done!\n";

// Create activity_logs table
echo "Creating activity_logs table...";
Capsule::schema()->dropIfExists('activity_logs');
Capsule::schema()->create('activity_logs', function ($table) {
    $table->id();
    $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
    $table->string('action', 100);
    $table->text('description');
    $table->string('ip_address', 45)->nullable();
    $table->text('user_agent')->nullable();
    $table->json('metadata')->nullable();
    $table->timestamp('created_at')->useCurrent();
});
echo " Done!\n";

// Create notifications table
echo "Creating notifications table...";
Capsule::schema()->dropIfExists('notifications');
Capsule::schema()->create('notifications', function ($table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    $table->string('title');
    $table->text('message');
    $table->enum('type', ['info', 'success', 'warning', 'error'])->default('info');
    $table->string('action_url')->nullable();
    $table->timestamp('read_at')->nullable();
    $table->timestamps();
});
echo " Done!\n";

// Create default super admin
echo "Creating default super admin...";
$adminExists = \App\Models\User::where('email', 'admin@admin.com')->first();
if (!$adminExists) {
    \App\Models\User::create([
        'username' => 'admin',
        'email' => 'admin@admin.com',
        'password' => 'admin123',
        'role' => 'super_admin',
    ]);
    echo " Done!\n";
} else {
    echo " Already exists!\n";
}

echo "\n✅ All migrations completed successfully!\n";
echo "Default credentials: admin@admin.com / admin123\n";
