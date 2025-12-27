<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultPassword = User::generateDefaultPassword(); // ASMS@2025

        $this->command->info('');
        $this->command->info('🔐 Default Password for all users: ' . $defaultPassword);
        $this->command->info('');

        // Define users with unique staff_id as the identifier
        $users = [
            [
                'identifier' => 'staff_id',
                'identifier_value' => 'ADMIN001',
                'email' => User::generateSchoolEmail('System Administrator', 'admin'),
                'name' => 'System Administrator',
                'staff_id' => 'ADMIN001',
                'phone' => '+256700000000',
                'must_change_password' => false,
                'roles' => ['Super Admin'],
            ],
            [
                'identifier' => 'staff_id',
                'identifier_value' => 'HT001',
                'email' => User::generateSchoolEmail('Kamugisha Samuel', 'ksamuel'),
                'name' => 'Kamugisha Samuel',
                'staff_id' => 'HT001',
                'phone' => '+256700000001',
                'must_change_password' => true,
                'roles' => ['Headteacher', 'Teacher'],
            ],
            [
                'identifier' => 'staff_id',
                'identifier_value' => 'TCH001',
                'email' => User::generateSchoolEmail('Mary Nakato', 'mnakato'),
                'name' => 'Mary Nakato',
                'staff_id' => 'TCH001',
                'phone' => '+256700000002',
                'must_change_password' => true,
                'roles' => ['Teacher'],
            ],
            [
                'identifier' => 'staff_id',
                'identifier_value' => 'ADM001',
                'email' => User::generateSchoolEmail('John Okello', 'jokello'),
                'name' => 'John Okello',
                'staff_id' => 'ADM001',
                'phone' => '+256700000003',
                'must_change_password' => true,
                'roles' => ['Admin Staff'],
            ],
        ];

        foreach ($users as $userData) {
            try {
                $user = User::updateOrCreate(
                    [
                        'staff_id' => $userData['staff_id'] // Use staff_id as unique identifier
                    ],
                    [
                        'name' => $userData['name'],
                        'email' => $userData['email'],
                        'password' => Hash::make($defaultPassword),
                        'email_verified_at' => now(),
                        'staff_id' => $userData['staff_id'],
                        'phone' => $userData['phone'],
                        'is_active' => true,
                        'must_change_password' => $userData['must_change_password'],
                        'password_changed_at' => $userData['must_change_password'] ? null : now(),
                    ]
                );

                // Sync roles (removes old ones, adds new ones)
                $user->syncRoles($userData['roles']);

                $this->command->info("✅ {$userData['name']} " . ($user->wasRecentlyCreated ? 'created' : 'updated'));
                $this->command->info("   Email: {$user->email}");
                $this->command->info("   Staff ID: {$user->staff_id}");
                $this->command->info("   Roles: " . implode(', ', $userData['roles']));
                $this->command->info("   Must Change Password: " . ($userData['must_change_password'] ? 'YES' : 'NO'));
                $this->command->info('');

            } catch (\Exception $e) {
                $this->command->error("❌ Error creating user {$userData['name']}: " . $e->getMessage());
                // Continue with other users instead of stopping completely
                continue;
            }
        }

        $this->command->info('📧 All emails use format: username@asms.ac.ug');
        $this->command->info('📊 Total Users in Database: ' . User::count());
        $this->command->info('');
        $this->command->info('🎯 Login Credentials:');

        foreach ($users as $userData) {
            $user = User::where('staff_id', $userData['staff_id'])->first();
            if ($user) {
                $this->command->info("   {$user->email} / {$defaultPassword}");
            }
        }

        $this->command->info('');
    }
}
