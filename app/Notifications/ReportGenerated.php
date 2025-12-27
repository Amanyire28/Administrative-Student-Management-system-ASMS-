<?php

namespace App\Notifications;

use App\Notifications\Base\Notification;

class ReportGenerated extends Notification
{
    protected $report;
    protected $reportType;

    // Permission configuration
    protected $requiredPermission = 'reports.view';
    protected $allowedRoles = ['Super Admin', 'Headteacher', 'Teacher'];
    protected $category = 'academic';

    public function __construct($report, $reportType)
    {
        $this->report = $report;
        $this->reportType = $reportType;
    }

    // NO via() METHOD NEEDED - Base class handles it

    public function toDatabase($notifiable)
    {
        $reportId = $this->getSafeId($this->report);
        $actionUrl = $reportId ? route('reports.download', $reportId) : '#';

        $data = array_merge($this->getBaseData('report_generated'), [
            'report_id' => $reportId,
            'report_type' => $this->reportType,
            'message' => "Report generated: {$this->reportType}",
            'action_url' => $actionUrl,
            'action_label' => 'Download Report',
        ]);

        return $data;
    }
}
