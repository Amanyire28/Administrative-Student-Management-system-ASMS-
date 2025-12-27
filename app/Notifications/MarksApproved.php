<?php

namespace App\Notifications;

use App\Notifications\Base\Notification;

class MarksApproved extends Notification
{
    protected $marks;
    protected $approver;

    // Permission configuration
    protected $requiredPermission = 'marks.view';
    protected $allowedRoles = ['Super Admin', 'Headteacher', 'Teacher'];
    protected $category = 'academic';

    public function __construct($marks, $approver = null)
    {
        $this->marks = $marks;
        $this->approver = $approver;
    }

    // NO via() METHOD NEEDED - Base class handles it

    public function toDatabase($notifiable)
    {
        // Load relationships
        $this->loadCommonRelationships($this->marks);

        $studentName = $this->getEntityDisplayName($this->marks->student ?? null);
        $subjectName = $this->getSubjectName($this->marks->subject ?? null);
        $approverName = $this->approver ? $this->getEntityDisplayName($this->approver) : 'System';

        $data = array_merge($this->getBaseData('marks_approved'), [
            'marks_id' => $this->getSafeId($this->marks),
            'student_name' => $studentName,
            'subject_name' => $subjectName,
            'approver_name' => $approverName,
            'message' => "Marks approved for {$studentName} in {$subjectName} by {$approverName}",
            'action_url' => route('marks.show', $this->getSafeId($this->marks)),
            'action_label' => 'View Marks',
        ]);

        return $data;
    }
}
