<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@asms.com',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'is_active' => true,
        ]);

        // Create Staff User
        User::create([
            'name' => 'Records Officer',
            'email' => 'staff@asms.com',
            'role' => 'staff',
            'email_verified_at' => now(),
            'password' => Hash::make('staff123'),
            'is_active' => true,
        ]);

        // Create Teacher User
        User::create([
            'name' => 'John Teacher',
            'email' => 'teacher@asms.com',
            'role' => 'teacher',
            'email_verified_at' => now(),
            'password' => Hash::make('teacher123'),
            'is_active' => true,
        ]);

        // Create Demo Admin (Mathew Amanyire from SRS)
        User::create([
            'name' => 'Mathew Amanyire',
            'email' => 'mathew@asms.com',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);

        User::updateOrCreate(
            ['email' => 'admin@asms.com'],
            [
                'name' => 'System Administrator',
                'role' => 'admin',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'is_active' => true,
            ]
        );

        // Create Staff User
        User::updateOrCreate(
            ['email' => 'staff@asms.com'],
            [
                'name' => 'Records Officer',
                'role' => 'staff',
                'email_verified_at' => now(),
                'password' => Hash::make('staff123'),
                'is_active' => true,
            ]
        );

        // Create Teacher User
        User::updateOrCreate(
            ['email' => 'teacher@asms.com'],
            [
                'name' => 'John Teacher',
                'role' => 'teacher',
                'email_verified_at' => now(),
                'password' => Hash::make('teacher123'),
                'is_active' => true,
            ]
        );

        // Create Demo Admin (Mathew Amanyire from SRS)
        User::updateOrCreate(
            ['email' => 'mathew@asms.com'],
            [
                'name' => 'Mathew Amanyire',
                'role' => 'admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );

    }
}
