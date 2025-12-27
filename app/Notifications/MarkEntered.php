<?php

namespace App\Notifications;

use App\Notifications\Base\Notification;

class MarkEntered extends Notification
{
    protected $student;
    protected $subject;
    protected $marks;
    protected $examType;

    // Permission configuration
    protected $requiredPermission = 'marks.view';
    protected $allowedRoles = ['Super Admin', 'Headteacher', 'Teacher'];
    protected $category = 'academic';

    public function __construct($student, $subject, $marks, $examType)
    {
        $this->student = $student;
        $this->subject = $subject;
        $this->marks = $marks;
        $this->examType = $examType;
    }

    public function toDatabase($notifiable)
    {
        $studentName = $this->getEntityDisplayName($this->student);
        $subjectName = $this->getSubjectName($this->subject);

        $data = array_merge($this->getBaseData('mark_entered'), [
            'student_id' => $this->getSafeId($this->student),
            'student_name' => $studentName,
            'subject_name' => $subjectName,
            'marks' => $this->marks,
            'exam_type' => $this->examType,
            'message' => "Marks entered: {$studentName} scored {$this->marks}% in {$subjectName} ({$this->examType})",
            'action_url' => route('students.show', $this->getSafeId($this->student)),
            'action_label' => 'View Student',
        ]);

        return $data;
    }
}
