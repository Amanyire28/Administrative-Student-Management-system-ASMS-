<?php

namespace App\Notifications;

use App\Notifications\Base\Notification;

class TeacherUpdated extends Notification
{
    protected $teacher;
    protected $changes;

    // Permission configuration
    protected $requiredPermission = 'teachers.view';
    protected $allowedRoles = ['Super Admin', 'Headteacher', 'Admin Staff'];
    protected $category = 'academic';

    public function __construct($teacher, array $changes = [])
    {
        $this->teacher = $teacher;
        $this->changes = $changes;
    }

    public function toDatabase($notifiable)
    {
        $teacherName = $this->getEntityDisplayName($this->teacher);

        // Create meaningful message based on changes
        $message = "Teacher updated: {$teacherName}";
        if (!empty($this->changes)) {
            $changeList = implode(', ', array_keys($this->changes));
            $message .= " ({$changeList} updated)";
        }

        $data = array_merge($this->getBaseData('teacher_updated'), [
            'teacher_id' => $this->getSafeId($this->teacher),
            'teacher_name' => $teacherName,
            'employee_id' => $this->teacher->employee_id ?? 'N/A',
            'changes' => $this->changes,
            'message' => $message,
            'action_url' => route('teachers.show', $this->getSafeId($this->teacher)),
            'action_label' => 'View Teacher',
        ]);

        return $data;
    }
}
