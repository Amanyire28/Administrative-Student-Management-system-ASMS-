<?php

namespace App\Notifications;

use App\Notifications\Base\Notification;

class SystemAlert extends Notification
{
    protected $title;
    protected $message;
    protected $alertType;

    // System alerts go to everyone with system notifications enabled
    protected $requiredPermission = null; // No permission required
    protected $allowedRoles = ['Super Admin', 'Headteacher', 'Admin Staff', 'Teacher'];
    protected $category = 'system';

    public function __construct($title, $message, $alertType = 'info')
    {
        $this->title = $title;
        $this->message = $message;
        $this->alertType = $alertType;
    }

    public function toDatabase($notifiable)
    {
        $data = array_merge($this->getBaseData('system_alert'), [
            'title' => $this->title,
            'message' => $this->message,
            'alert_type' => $this->alertType,
            'action_url' => '#',
            'action_label' => 'View Details',
        ]);

        return $data;
    }
}
