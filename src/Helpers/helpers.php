<?php

/**
 * Helper Functions
 */

if (!function_exists('dd')) {
    /**
     * Dump and die
     */
    function dd(...$vars) {
        foreach ($vars as $var) {
            echo '<pre>';
            var_dump($var);
            echo '</pre>';
        }
        die();
    }
}

if (!function_exists('redirect')) {
    /**
     * Redirect to a URL
     */
    function redirect($url, $statusCode = 302) {
        header('Location: ' . $url, true, $statusCode);
        exit;
    }
}

if (!function_exists('old')) {
    /**
     * Get old input value
     */
    function old($key, $default = '') {
        return $_SESSION['old'][$key] ?? $default;
    }
}

if (!function_exists('csrf_field')) {
    /**
     * Generate CSRF field
     */
    function csrf_field() {
        return \App\Middleware\CsrfMiddleware::field();
    }
}

if (!function_exists('asset')) {
    /**
     * Generate asset URL
     */
    function asset($path) {
        return '/' . ltrim($path, '/');
    }
}

if (!function_exists('url')) {
    /**
     * Generate URL
     */
    function url($path = '') {
        $baseUrl = config('app.url');
        return $baseUrl . '/' . ltrim($path, '/');
    }
}

if (!function_exists('sanitize')) {
    /**
     * Sanitize string
     */
    function sanitize($string) {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('now')) {
    /**
     * Get current datetime
     */
    function now() {
        return new \DateTime();
    }
}

if (!function_exists('today')) {
    /**
     * Get today's date
     */
    function today() {
        return new \DateTime('today');
    }
}
