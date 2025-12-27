<?php

namespace App\Notifications;

use App\Notifications\Base\Notification;

class TeacherCreated extends Notification
{
    protected $teacher;

    // Permission configuration
    protected $requiredPermission = 'teachers.view';
    protected $allowedRoles = ['Super Admin', 'Headteacher', 'Admin Staff'];
    protected $category = 'academic';

    public function __construct($teacher)
    {
        $this->teacher = $teacher;
    }

    public function toDatabase($notifiable)
    {
        $teacherName = $this->getEntityDisplayName($this->teacher);

        $data = array_merge($this->getBaseData('teacher_created'), [
            'teacher_id' => $this->getSafeId($this->teacher),
            'teacher_name' => $teacherName,
            'employee_id' => $this->teacher->employee_id ?? 'N/A',
            'email' => $this->teacher->email ?? 'N/A',
            'message' => "New teacher created: {$teacherName} ({$this->teacher->employee_id})",
            'action_url' => route('teachers.show', $this->getSafeId($this->teacher)),
            'action_label' => 'View Teacher',
        ]);

        return $data;
    }
}
