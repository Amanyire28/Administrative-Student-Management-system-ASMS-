<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'category',
        'enabled'
    ];

    protected $casts = [
        'enabled' => 'boolean'
    ];

    /**
     * Get the user that owns the preference
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Notification types
     */
    public static function getTypes()
    {
        return [
            'email' => 'Email',
            'sms' => 'SMS',
            'push' => 'Push Notification',
            'in_app' => 'In-App Notification'
        ];
    }

    /**
     * Notification categories
     */
    public static function getCategories()
    {
        return [
            'system' => 'System Updates',
            'academic' => 'Academic Updates',
            'financial' => 'Financial Updates',
            'security' => 'Security Alerts',
            'announcements' => 'Announcements'
        ];
    }
}
