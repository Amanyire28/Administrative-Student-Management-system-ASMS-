<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
<<<<<<< HEAD
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,    // Create roles & permissions first
            AdminUserSeeder::class,     // Then create users with roles
            SchoolSettingSeeder::class,
=======
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            // SubjectSeeder::class,
            // TeacherSeeder::class,
            ClassLevelSeeder::class,
            // ClassSeeder::class,
            // StudentSeeder::class,
>>>>>>> julius2
        ]);
    }
}
