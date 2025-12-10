<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    
    protected $fillable = [
        'user_id',
        'title',
        'message',
        'type',
        'read_at',
        'action_url'
    ];
    
    protected $casts = [
        'read_at' => 'datetime',
        'created_at' => 'datetime',
    ];
    
    /**
     * Get the user that owns the notification
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Mark notification as read
     */
    public function markAsRead()
    {
        $this->read_at = now();
        $this->save();
    }
    
    /**
     * Check if notification is read
     */
    public function isRead()
    {
        return $this->read_at !== null;
    }
    
    /**
     * Create a notification
     */
    public static function notify($userId, $title, $message, $type = 'info', $actionUrl = null)
    {
        return self::create([
            'user_id' => $userId,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'action_url' => $actionUrl,
        ]);
    }
}
