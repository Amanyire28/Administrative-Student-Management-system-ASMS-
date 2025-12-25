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

        // 1. Super Admin (doesn't need to change password)
        $admin = User::create([
            'name' => 'System Administrator',
            'email' => User::generateSchoolEmail('System Administrator', 'admin'),
            'password' => Hash::make($defaultPassword),
            'email_verified_at' => now(),
            'staff_id' => 'ADMIN001',
            'phone' => '+256700000000',
            'is_active' => true,
            'must_change_password' => false, // Admin doesn't need to change
            'password_changed_at' => now(),
        ]);
        $admin->assignRole('Super Admin');

        $this->command->info("✅ Super Admin created");
        $this->command->info("   Email: {$admin->email}");
        $this->command->info("   Password: {$defaultPassword}");
        $this->command->info("   Staff ID: {$admin->staff_id}");
        $this->command->info("   Must Change Password: NO");
        $this->command->info('');

        // 2. Headteacher (who is ALSO a Teacher - multi-role!)
        $headteacher = User::create([
            'name' => 'Kamugisha Samuel',
            'email' => User::generateSchoolEmail('Kamugisha Samuel', 'ksamuel'),
            'password' => Hash::make($defaultPassword),
            'email_verified_at' => now(),
            'staff_id' => 'HT001',
            'phone' => '+256700000001',
            'is_active' => true,
            'must_change_password' => true, // Must change on first login
        ]);
        // Assign MULTIPLE roles (both Headteacher and Teacher)
        $headteacher->assignRole(['Headteacher', 'Teacher']);

        $this->command->info("✅ Headteacher+Teacher created (MULTI-ROLE)");
        $this->command->info("   Email: {$headteacher->email}");
        $this->command->info("   Password: {$defaultPassword}");
        $this->command->info("   Staff ID: {$headteacher->staff_id}");
        $this->command->info("   Roles: Headteacher + Teacher");
        $this->command->info("   Must Change Password: YES");
        $this->command->info('');

        // 3. Regular Teacher
        $teacher = User::create([
            'name' => 'Mary Nakato',
            'email' => User::generateSchoolEmail('Mary Nakato', 'mnakato'),
            'password' => Hash::make($defaultPassword),
            'email_verified_at' => now(),
            'staff_id' => 'TCH001',
            'phone' => '+256700000002',
            'is_active' => true,
            'must_change_password' => true,
        ]);
        $teacher->assignRole('Teacher');

        $this->command->info("✅ Teacher created");
        $this->command->info("   Email: {$teacher->email}");
        $this->command->info("   Password: {$defaultPassword}");
        $this->command->info("   Staff ID: {$teacher->staff_id}");
        $this->command->info("   Must Change Password: YES");
        $this->command->info('');

        // 4. Admin Staff
        $staff = User::create([
            'name' => 'John Okello',
            'email' => User::generateSchoolEmail('John Okello', 'jokello'),
            'password' => Hash::make($defaultPassword),
            'email_verified_at' => now(),
            'staff_id' => 'ADM001',
            'phone' => '+256700000003',
            'is_active' => true,
            'must_change_password' => true,
        ]);
        $staff->assignRole('Admin Staff');

        $this->command->info("✅ Admin Staff created");
        $this->command->info("   Email: {$staff->email}");
        $this->command->info("   Password: {$defaultPassword}");
        $this->command->info("   Staff ID: {$staff->staff_id}");
        $this->command->info("   Must Change Password: YES");
        $this->command->info('');

        $this->command->info('📧 All emails use format: username@asms.ac.ug');
        $this->command->info('📊 Total Users Created: ' . User::count());
        $this->command->info('');
        $this->command->info('🎯 Login Credentials:');
        $this->command->info("   admin@asms.ac.ug / {$defaultPassword}");
        $this->command->info("   ksamuel@asms.ac.ug / {$defaultPassword}");
        $this->command->info("   mnakato@asms.ac.ug / {$defaultPassword}");
        $this->command->info("   jokello@asms.ac.ug / {$defaultPassword}");
        $this->command->info('');
    }
}
