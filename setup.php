<?php

// Quick setup script to create database and run migrations

echo "=== Quick Setup Script ===\n\n";

// Database connection details
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'todays-task';

// Step 1: Create database
echo "Step 1: Creating database...\n";
try {
    $conn = new PDO("mysql:host=$host", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    $conn->exec($sql);
    echo "✅ Database '$database' created successfully!\n\n";
} catch(PDOException $e) {
    echo "❌ Error creating database: " . $e->getMessage() . "\n";
    echo "Please create the database manually:\n";
    echo "CREATE DATABASE `todays-task` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;\n\n";
    exit(1);
}

// Step 2: Run migrations
echo "Step 2: Running migrations...\n";
require_once __DIR__ . '/database/migrate.php';
