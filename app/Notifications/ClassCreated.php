<?php

namespace App\Notifications;

use App\Notifications\Base\Notification;

class ClassCreated extends Notification
{
    protected $class;

    // Permission configuration
    protected $requiredPermission = 'classes.view';
    protected $allowedRoles = ['Super Admin', 'Headteacher', 'Admin Staff'];
    protected $category = 'academic';

    public function __construct($class)
    {
        $this->class = $class;
    }

    // NO via() METHOD NEEDED - Base class handles it

    public function toDatabase($notifiable)
    {
        $className = $this->getClassName($this->class);

        $data = array_merge($this->getBaseData('class_created'), [
            'class_id' => $this->getSafeId($this->class),
            'class_name' => $className,
            'message' => "New class created: {$className}",
            'action_url' => route('classes.show', $this->getSafeId($this->class)),
            'action_label' => 'View Class',
        ]);

        return $data;
    }

    /**
     * Helper method to get class name
     */
    protected function getClassName($class)
    {
        if (!$class) {
            return 'Unknown Class';
        }

        // Load relationships if needed
        if (!$class->relationLoaded('classLevel') || !$class->relationLoaded('stream')) {
            try {
                $class->load(['classLevel', 'stream']);
            } catch (\Exception $e) {
                // Silent fail
            }
        }

        // Use the accessor if available
        if (method_exists($class, 'getDisplayNameAttribute')) {
            return $class->display_name;
        }

        return $class->full_name ?? $class->name ?? "Class #{$class->id}";
    }
}
