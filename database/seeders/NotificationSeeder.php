<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\ClassModel;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing notifications
        \Illuminate\Notifications\DatabaseNotification::truncate();

        // Get all users - create some if none exist
        $users = User::all();
        if ($users->isEmpty()) {
            $this->command->info('Creating sample users for notifications...');
            $users = $this->createSampleUsers();
        }

        // Get or create sample data
        $students = Student::all();
        $teachers = Teacher::all();
        $subjects = Subject::all();
        $classes = ClassModel::all();

        // If no sample data exists, create dummy data for notifications
        $sampleStudents = $this->getOrCreateSampleStudents($students);
        $sampleTeachers = $this->getOrCreateSampleTeachers($teachers);

        $this->command->info('Creating sample notifications...');

        // Create various notifications
        $this->createBasicNotifications($users, $sampleStudents, $sampleTeachers);

        $count = \Illuminate\Notifications\DatabaseNotification::count();
        $this->command->info("✅ Created {$count} sample notifications");
    }

    private function createSampleUsers()
    {
        $users = [];

        // Create Super Admin
        $users[] = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@asms.com',
            'password' => Hash::make('password'),
            'role' => 'Super Admin',
            'is_active' => true,
            'staff_id' => 'SA001',
            'phone' => '0777123456',
        ]);

        // Create Admin Staff
        $users[] = User::create([
            'name' => 'Admin Staff',
            'email' => 'admin@asms.com',
            'password' => Hash::make('password'),
            'role' => 'Admin Staff',
            'is_active' => true,
            'staff_id' => 'AS001',
            'phone' => '0777123457',
        ]);

        // Create Teacher
        $users[] = User::create([
            'name' => 'John Teacher',
            'email' => 'teacher@asms.com',
            'password' => Hash::make('password'),
            'role' => 'Teacher',
            'is_active' => true,
            'staff_id' => 'T001',
            'phone' => '0777123458',
        ]);

        return collect($users);
    }

    private function getOrCreateSampleStudents($students)
    {
        if ($students->isEmpty()) {
            return collect([
                (object) ['id' => 1, 'name' => 'John Doe', 'first_name' => 'John', 'last_name' => 'Doe'],
                (object) ['id' => 2, 'name' => 'Jane Smith', 'first_name' => 'Jane', 'last_name' => 'Smith'],
                (object) ['id' => 3, 'name' => 'Robert Johnson', 'first_name' => 'Robert', 'last_name' => 'Johnson'],
            ]);
        }

        return $students->take(3);
    }

    private function getOrCreateSampleTeachers($teachers)
    {
        if ($teachers->isEmpty()) {
            return collect([
                (object) ['id' => 1, 'name' => 'Dr. James Wilson', 'first_name' => 'James', 'last_name' => 'Wilson'],
                (object) ['id' => 2, 'name' => 'Ms. Sarah Miller', 'first_name' => 'Sarah', 'last_name' => 'Miller'],
            ]);
        }

        return $teachers->take(2);
    }

    private function createBasicNotifications($users, $students, $teachers): void
    {
        $notificationTypes = [
            'student_registered' => [
                'icon' => 'fas fa-user-plus',
                'color' => 'blue',
                'message' => function() use ($students) {
                    $student = $students->isNotEmpty() ? $students->first() : (object) ['name' => 'New Student'];
                    return "New student registered: {$student->name}";
                },
            ],
            'teacher_assigned' => [
                'icon' => 'fas fa-chalkboard-teacher',
                'color' => 'green',
                'message' => function() use ($teachers) {
                    $teacher = $teachers->isNotEmpty() ? $teachers->first() : (object) ['name' => 'New Teacher'];
                    return "Teacher assigned to class: {$teacher->name}";
                },
            ],
            'marks_entered' => [
                'icon' => 'fas fa-edit',
                'color' => 'yellow',
                'message' => function() use ($students) {
                    $student = $students->isNotEmpty() ? $students->get(1) ?? $students->first() : (object) ['name' => 'Student'];
                    return "Marks entered for {$student->name}: 85% in Mathematics";
                },
            ],
            'system_alert' => [
                'icon' => 'fas fa-exclamation-triangle',
                'color' => 'red',
                'message' => fn() => "System Alert: Server maintenance scheduled for Saturday",
            ],
            'announcement' => [
                'icon' => 'fas fa-bullhorn',
                'color' => 'purple',
                'message' => fn() => "Announcement: Parent-Teacher meeting next Friday",
            ],
            'report_generated' => [
                'icon' => 'fas fa-file-alt',
                'color' => 'indigo',
                'message' => function() use ($students) {
                    $student = $students->isNotEmpty() ? $students->get(2) ?? $students->first() : (object) ['name' => 'Student'];
                    return "Report generated for {$student->name} - Term 1";
                },
            ],
            'payment_received' => [
                'icon' => 'fas fa-money-check-alt',
                'color' => 'emerald',
                'message' => function() use ($students) {
                    $student = $students->isNotEmpty() ? $students->first() : (object) ['name' => 'Student'];
                    return "Payment received from {$student->name}: UGX 150,000";
                },
            ],
        ];

        $daysAgo = [0, 1, 2, 3, 7, 14]; // Today, yesterday, etc.

        foreach ($users as $user) {
            // Determine user type for targeted notifications
            $isSuperAdmin = $user->role === 'Super Admin' || $user->id === 1;
            $isAdminStaff = $user->role === 'Admin Staff';
            $isTeacher = $user->role === 'Teacher';

            foreach ($daysAgo as $days) {
                // Create notifications based on user role
                $notificationCount = $isSuperAdmin ? rand(2, 4) : rand(1, 3);

                for ($i = 0; $i < $notificationCount; $i++) {
                    // Select appropriate notification types based on user role
                    $availableTypes = array_keys($notificationTypes);

                    if ($isTeacher) {
                        $availableTypes = ['marks_entered', 'system_alert', 'announcement'];
                    } elseif ($isAdminStaff) {
                        $availableTypes = ['student_registered', 'report_generated', 'payment_received', 'system_alert'];
                    }

                    $type = $availableTypes[array_rand($availableTypes)];
                    $config = $notificationTypes[$type];

                    $createdAt = Carbon::now()->subDays($days)->subHours(rand(0, 23))->subMinutes(rand(0, 59));
                    $readAt = rand(0, 1) ? $createdAt->copy()->addHours(rand(1, 5)) : null;

                    $user->notifications()->create([
                        'id' => Str::uuid(),
                        'type' => 'App\Notifications\SystemAlert',
                        'notifiable_type' => get_class($user),
                        'notifiable_id' => $user->id,
                        'data' => [
                            'message' => is_callable($config['message']) ? $config['message']() : $config['message'],
                            'icon' => $config['icon'],
                            'type' => $type,
                            'color' => $config['color'],
                            'action_url' => '#',
                            'created_at_human' => $createdAt->diffForHumans(),
                        ],
                        'read_at' => $readAt,
                        'created_at' => $createdAt,
                        'updated_at' => $createdAt,
                    ]);
                }
            }
        }
    }
}
