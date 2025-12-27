<?php

namespace App\Notifications;

use App\Notifications\Base\Notification;

class StudentUpdated extends Notification
{
    protected $student;
    protected $updater;

    // Permission configuration
    protected $requiredPermission = 'students.view';
    protected $allowedRoles = ['Super Admin', 'Headteacher', 'Admin Staff'];
    protected $category = 'academic';

    public function __construct($student, $updater = null)
    {
        $this->student = $student;
        $this->updater = $updater;
    }

    public function toDatabase($notifiable)
    {
        $studentName = $this->getEntityDisplayName($this->student);
        $updaterName = $this->updater ? $this->getEntityDisplayName($this->updater) : 'System';

        $data = array_merge($this->getBaseData('student_updated'), [
            'student_id' => $this->getSafeId($this->student),
            'student_name' => $studentName,
            'updater_name' => $updaterName,
            'message' => "Student updated: {$studentName} by {$updaterName}",
            'action_url' => route('students.show', $this->getSafeId($this->student)),
            'action_label' => 'View Student',
        ]);

        return $data;
    }
}
