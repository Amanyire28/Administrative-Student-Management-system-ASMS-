<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('role', 'admin')->first();
        
        if (!$admin) {
            return; // Skip if no admin user exists
        }

        $announcements = [
            [
                'title' => 'Welcome to New Academic Year 2025',
                'content' => 'We are excited to welcome all students and staff to the new academic year. Classes will commence on February 1st, 2025. Please ensure all registration requirements are completed.',
                'type' => 'academic',
                'created_by' => $admin->id,
                'valid_until' => now()->addDays(30),
            ],
            [
                'title' => 'Parent-Teacher Conference',
                'content' => 'The quarterly parent-teacher conference is scheduled for February 22nd, 2025. All parents are encouraged to attend to discuss their children\'s academic progress.',
                'type' => 'event',
                'created_by' => $admin->id,
                'valid_until' => now()->addDays(45),
            ],
            [
                'title' => 'Library Hours Extended',
                'content' => 'Starting this week, the school library will be open until 6:00 PM on weekdays to provide students with more study time and access to resources.',
                'type' => 'general',
                'created_by' => $admin->id,
                'valid_until' => null,
            ],
            [
                'title' => 'Science Fair Registration Open',
                'content' => 'Registration for the annual science fair is now open. Students interested in participating should submit their project proposals by March 1st, 2025.',
                'type' => 'academic',
                'created_by' => $admin->id,
                'valid_until' => now()->addDays(60),
            ],
            [
                'title' => 'Emergency Contact Update Required',
                'content' => 'All students must update their emergency contact information by January 31st, 2025. Please visit the administration office or update online through the student portal.',
                'type' => 'urgent',
                'created_by' => $admin->id,
                'valid_until' => now()->addDays(10),
            ],
        ];

        foreach ($announcements as $announcement) {
            Announcement::create($announcement);
        }
    }
}
