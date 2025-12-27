<?php

namespace App\Notifications;

use App\Notifications\Base\Notification;

class Announcement extends Notification
{
    protected $title;
    protected $message;
    protected $link;

    // Announcements can be targeted to specific roles
    protected $requiredPermission = null;
    protected $category = 'announcements';

    // Default to all roles, can be overridden
    protected $allowedRoles = ['Super Admin', 'Headteacher', 'Admin Staff', 'Teacher', 'Student', 'Parent'];

    public function __construct($title, $message, $link = null, $targetRoles = null)
    {
        $this->title = $title;
        $this->message = $message;
        $this->link = $link;

        // Override allowed roles if specified
        if ($targetRoles) {
            $this->allowedRoles = $targetRoles;
        }
    }

    public function toDatabase($notifiable)
    {
        $data = array_merge($this->getBaseData('announcement'), [
            'title' => $this->title,
            'message' => $this->message,
            'link' => $this->link,
            'action_url' => $this->link,
            'action_label' => 'Read More',
        ]);

        return $data;
    }
}
