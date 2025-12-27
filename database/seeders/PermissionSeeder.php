<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define all permissions (these will be stored in database)
        $permissions = [
            // Students Module
            'students.view',
            'students.view-detail',
            'students.create',
            'students.edit',
            'students.delete',
            'students.export',
            'students.promote',

            // Teachers Module
            'teachers.view',
            'teachers.view-detail',
            'teachers.create',
            'teachers.edit',
            'teachers.delete',
            'teachers.assign',

            // Classes Module (UPDATED - More granular)
            'classes.view',
            'classes.view-detail',
            'classes.create',
            'classes.edit',
            'classes.delete',
            'classes.assign-subjects',
            'classes.assign-students',

            // Subjects Module (UPDATED - More granular)
            'subjects.view',
            'subjects.view-detail',
            'subjects.create',
            'subjects.edit',
            'subjects.delete',
            'subjects.assign-teachers',

            // Marks Module
            'marks.view',
            'marks.entry',
            'marks.edit',
            'marks.delete',
            'marks.approve',
            'marks.view-all',

            // Reports Module
            'reports.view',
            'reports.generate',
            'reports.print',
            'reports.export',
            'reports.analytics',

            // System Module
            'system.settings',
            'system.users',
            'system.roles',
            'system.permissions',
            'system.backup',
            'system.logs',
        ];

        // Create all permissions in database
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        $this->command->info('✅ Created ' . count($permissions) . ' permissions in database');

        // Create roles
        $this->createRoles();
    }

    /**
     * Create roles and assign permissions
     */
   private function createRoles(): void
{
    // 1. Super Admin Role (has ALL permissions)
    $superAdmin = Role::firstOrCreate([
        'name' => 'Super Admin',
        'guard_name' => 'web'
    ]);
    $superAdmin->syncPermissions(Permission::all());
    $this->command->info('✅ Super Admin role synced with ALL permissions');

    // 2. Headteacher Role
    $headteacher = Role::firstOrCreate([
        'name' => 'Headteacher',
        'guard_name' => 'web'
    ]);
    $headteacher->syncPermissions([
        // Students - full access
        'students.view',
        'students.view-detail',
        'students.create',
        'students.edit',
        'students.delete',
        'students.export',
        'students.promote',

        // Teachers - can manage
        'teachers.view',
        'teachers.view-detail',
        'teachers.create',
        'teachers.edit',
        'teachers.assign',

        // Classes - full access (UPDATED)
        'classes.view',
        'classes.view-detail',
        'classes.create',
        'classes.edit',
        'classes.delete',
        'classes.assign-subjects',
        'classes.assign-students',

        // Subjects - full access (UPDATED)
        'subjects.view',
        'subjects.view-detail',
        'subjects.create',
        'subjects.edit',
        'subjects.delete',
        'subjects.assign-teachers',

        // Reports - full access
        'reports.view',
        'reports.generate',
        'reports.print',
        'reports.export',
        'reports.analytics',
    ]);
    $this->command->info('✅ Headteacher role synced with ' . count($headteacher->permissions) . ' permissions');

    // 3. Teacher Role
    $teacher = Role::firstOrCreate([
        'name' => 'Teacher',
        'guard_name' => 'web'
    ]);
    $teacher->syncPermissions([
        // Students - view only
        'students.view',
        'students.view-detail',

        // Classes - view only (UPDATED)
        'classes.view',
        'classes.view-detail',

        // Subjects - view only (UPDATED)
        'subjects.view',
        'subjects.view-detail',

        // Marks - can enter and edit
        'marks.view',
        'marks.entry',
        'marks.edit',

        // Reports - view and print
        'reports.view',
        'reports.print',
    ]);
    $this->command->info('✅ Teacher role synced with ' . count($teacher->permissions) . ' permissions');

    // 4. Admin Staff Role
    $adminStaff = Role::firstOrCreate([
        'name' => 'Admin Staff',
        'guard_name' => 'web'
    ]);
    $adminStaff->syncPermissions([
        // Students - full access except delete
        'students.view',
        'students.view-detail',
        'students.create',
        'students.edit',
        'students.export',

        // Teachers - view and manage
        'teachers.view',
        'teachers.view-detail',
        'teachers.create',
        'teachers.edit',

        // Classes - can manage (UPDATED)
        'classes.view',
        'classes.view-detail',
        'classes.create',
        'classes.edit',
        'classes.assign-subjects',
        'classes.assign-students',

        // Subjects - can manage (UPDATED)
        'subjects.view',
        'subjects.view-detail',
        'subjects.create',
        'subjects.edit',
    ]);
    $this->command->info('✅ Admin Staff role synced with ' . count($adminStaff->permissions) . ' permissions');

    $this->command->info('');
    $this->command->info('📊 Summary:');
    $this->command->info('   Total Roles: ' . Role::count());
    $this->command->info('   Total Permissions: ' . Permission::count());
}
}
