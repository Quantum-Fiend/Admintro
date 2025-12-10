<?php

namespace App\Controllers;

class PlaceholderController
{
    public function analytics()
    {
        $title = 'Analytics';
        require __DIR__ . '/../../views/placeholder.php';
    }

    public function settings()
    {
        $title = 'Settings';
        require __DIR__ . '/../../views/placeholder.php';
    }

    public function activity()
    {
        $title = 'Activity Logs';
        require __DIR__ . '/../../views/placeholder.php';
    }
}
