<?php

return [
    'name' => env('APP_NAME', 'Modern Admin Dashboard'),
    'env' => env('APP_ENV', 'production'),
    'debug' => env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
    
    'jwt' => [
        'secret' => env('JWT_SECRET', 'your-secret-key'),
        'expiration' => env('JWT_EXPIRATION', 3600),
    ],
    
    'session' => [
        'lifetime' => env('SESSION_LIFETIME', 120),
        'driver' => env('SESSION_DRIVER', 'file'),
    ],
    
    'upload' => [
        'max_size' => env('MAX_UPLOAD_SIZE', 10485760), // 10MB
        'allowed_extensions' => explode(',', env('ALLOWED_EXTENSIONS', 'jpg,jpeg,png,pdf,doc,docx')),
    ],
    
    'two_factor' => [
        'enabled' => env('TWO_FACTOR_ENABLED', true),
    ],
];
