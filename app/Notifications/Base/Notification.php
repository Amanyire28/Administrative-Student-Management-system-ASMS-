<?php

namespace App\Notifications\Base;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification as LaravelNotification;

abstract class Notification extends LaravelNotification implements ShouldQueue
{
    use Queueable;

    /**
     * The permission required to receive this notification
     */
    protected $requiredPermission = null;

    /**
     * The roles allowed to receive this notification
     */
    protected $allowedRoles = null;

    /**
     * The notification category for preference checking
     */
    protected $category = null;

    /**
     * Override the via() method to automatically check permissions
     */
    public function via($notifiable)
    {
        // This will be called by Laravel - check permissions here
        if (!$this->shouldSend($notifiable)) {
            return [];
        }

        return ['database'];
    }

    /**
     * Check if user should receive this notification
     * USING CLASS PROPERTIES (requiredPermission, allowedRoles, category)
     */
    public function shouldSend($notifiable)
    {
        // 1. Check if user is active
        if (property_exists($notifiable, 'is_active') && !$notifiable->is_active) {
            return false;
        }

        // 2. Check required permission
        if ($this->requiredPermission && !$notifiable->can($this->requiredPermission)) {
            return false;
        }

        // 3. Check allowed roles (if specified)
        if ($this->allowedRoles && !$this->userHasAllowedRole($notifiable)) {
            return false;
        }

        // 4. Check notification preference
        if ($this->category && !$notifiable->hasNotificationPreference('in_app', $this->category)) {
            return false;
        }

        return true;
    }

    /**
     * Check if user has any of the allowed roles
     */
    protected function userHasAllowedRole($user)
    {
        if (!$this->allowedRoles || empty($this->allowedRoles)) {
            return true; // No role restriction
        }

        foreach ($this->allowedRoles as $role) {
            if ($user->hasRole($role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get base notification data with permission info
     */
    protected function getBaseData($type)
    {
        return [
            'type' => $type,
            'category' => $this->category,
            'required_permission' => $this->requiredPermission,
            'allowed_roles' => $this->allowedRoles,
            'icon' => $this->getIconByType($type),
            'priority' => $this->getPriorityByType($type),
            'color' => $this->getColorByType($type),
        ];
    }

    /**
     * Get entity display name safely
     */
    protected function getEntityDisplayName($entity)
    {
        if (!$entity) {
            return 'Unknown';
        }

        // Load common relationships
        $this->loadCommonRelationships($entity);

        // Try to get display name
        if (method_exists($entity, 'getDisplayNameAttribute')) {
            return $entity->display_name;
        }

        // For Student model specifically
        if ($entity instanceof \App\Models\Student) {
            if (isset($entity->name) && !empty($entity->name)) {
                return $entity->name;
            }

            if (isset($entity->first_name) && isset($entity->last_name)) {
                return trim($entity->first_name . ' ' . $entity->last_name);
            }

            return "Student #{$entity->id}";
        }

        // For Teacher model
        if ($entity instanceof \App\Models\Teacher) {
            if (isset($entity->full_name) && !empty($entity->full_name)) {
                return $entity->full_name;
            }

            if (isset($entity->name) && !empty($entity->name)) {
                return $entity->name;
            }

            if (isset($entity->first_name) && isset($entity->last_name)) {
                return trim($entity->first_name . ' ' . $entity->last_name);
            }

            return "Teacher #{$entity->id}";
        }

        // Generic fallback
        if (isset($entity->name) && !empty($entity->name)) {
            return $entity->name;
        }

        if (isset($entity->full_name) && !empty($entity->full_name)) {
            return $entity->full_name;
        }

        if (isset($entity->title) && !empty($entity->title)) {
            return $entity->title;
        }

        return class_basename($entity) . " #{$entity->id}";
    }

    /**
     * Load common relationships that might be needed for display
     */
    protected function loadCommonRelationships($entity)
    {
        if (!$entity) {
            return;
        }

        $class = get_class($entity);

        switch ($class) {
            case \App\Models\Student::class:
                // Student might need class relationship
                if (!$entity->relationLoaded('class')) {
                    try {
                        $entity->load('class');
                    } catch (\Exception $e) {
                        // Silent fail - relationship might not exist
                    }
                }
                break;

            case \App\Models\Teacher::class:
                // Teacher might need user relationship
                if (!$entity->relationLoaded('user')) {
                    try {
                        $entity->load('user');
                    } catch (\Exception $e) {
                        // Silent fail
                    }
                }
                break;

            // case \App\Models\Marks::class:
                // Marks need student and subject relationships
                // if (!$entity->relationLoaded('student')) {
                //     try {
                //         $entity->load('student');
                //     } catch (\Exception $e) {
                //         // Silent fail
                //     }
                // }

                if (!$entity->relationLoaded('subject')) {
                    try {
                        $entity->load('subject');
                    } catch (\Exception $e) {
                        // Silent fail
                    }
                }
                break;
        }
    }

    /**
     * Get subject name safely
     */
    protected function getSubjectName($subject)
    {
        if (!$subject) {
            return 'Unknown Subject';
        }

        if (isset($subject->name) && !empty($subject->name)) {
            return $subject->name;
        }

        if (isset($subject->title) && !empty($subject->title)) {
            return $subject->title;
        }

        return "Subject #{$subject->id}";
    }

    /**
     * Get class name safely
     */
    protected function getClassName($class)
    {
        if (!$class) {
            return 'Unknown Class';
        }

        if (isset($class->full_name) && !empty($class->full_name)) {
            return $class->full_name;
        }

        if (isset($class->name) && !empty($class->name)) {
            return $class->name;
        }

        return "Class #{$class->id}";
    }

    /**
     * Get notification icon based on type
     */
    protected function getIconByType($type)
    {
        $icons = [
            'student_registered' => 'fas fa-user-plus',
            'student_updated' => 'fas fa-user-edit',
            'mark_entered' => 'fas fa-edit',
            'marks_approved' => 'fas fa-check-circle',
            'report_generated' => 'fas fa-file-alt',
            'teacher_assigned' => 'fas fa-chalkboard-teacher',
            'system_alert' => 'fas fa-exclamation-triangle',
            'announcement' => 'fas fa-bullhorn',
        ];

        return $icons[$type] ?? 'fas fa-bell';
    }

    /**
     * Get notification color based on type
     */
    protected function getColorByType($type)
    {
        $colors = [
            'student_registered' => 'blue',
            'student_updated' => 'yellow',
            'mark_entered' => 'yellow',
            'marks_approved' => 'green',
            'report_generated' => 'purple',
            'teacher_assigned' => 'green',
            'system_alert' => 'red',
            'announcement' => 'purple',
        ];

        return $colors[$type] ?? 'gray';
    }

    /**
     * Get priority based on notification type
     */
    protected function getPriorityByType($type)
    {
        $priorities = [
            'system_alert' => 'high',
            'student_registered' => 'medium',
            'teacher_assigned' => 'medium',
            'marks_approved' => 'medium',
            'report_generated' => 'medium',
            'mark_entered' => 'low',
            'student_updated' => 'low',
        ];

        return $priorities[$type] ?? 'low';
    }

    /**
     * Get safe ID from entity
     */
    protected function getSafeId($entity)
    {
        if (!$entity) {
            return null;
        }

        return $entity->id ?? null;
    }
}
