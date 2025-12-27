<?php

namespace App\Notifications;

use App\Notifications\Base\Notification;

class StudentRegistered extends Notification
{
    protected $student;

    // Permission configuration - THESE ARE NOW USED BY BASE CLASS
    protected $requiredPermission = 'students.view';
    protected $allowedRoles = ['Super Admin', 'Headteacher', 'Admin Staff'];
    protected $category = 'academic';

    public function __construct($student)
    {
        $this->student = $student;
    }

    // NO VIA() METHOD NEEDED - Base class handles it

    public function toDatabase($notifiable)
    {
        $studentName = $this->getEntityDisplayName($this->student);

        $data = array_merge($this->getBaseData('student_registered'), [
            'student_id' => $this->getSafeId($this->student),
            'student_name' => $studentName,
            'message' => "New student registered: {$studentName}",
            'action_url' => route('students.show', $this->getSafeId($this->student)),
            'action_label' => 'View Student',
        ]);

        return $data;
    }
}
