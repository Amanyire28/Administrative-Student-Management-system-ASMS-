<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeder.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            // Primary Subjects
            ['name' => 'Mathematics', 'code' => 'MATH', 'description' => 'Core Mathematics', 'is_active' => true],
            ['name' => 'English', 'code' => 'ENG', 'description' => 'English Language', 'is_active' => true],
            ['name' => 'Science', 'code' => 'SCI', 'description' => 'General Science', 'is_active' => true],
            ['name' => 'Social Studies', 'code' => 'SST', 'description' => 'Social Studies', 'is_active' => true],
            ['name' => 'Religious Education', 'code' => 'RE', 'description' => 'Religious Education', 'is_active' => true],

            // Secondary Subjects
            ['name' => 'Physics', 'code' => 'PHY', 'description' => 'Physics', 'is_active' => true],
            ['name' => 'Chemistry', 'code' => 'CHEM', 'description' => 'Chemistry', 'is_active' => true],
            ['name' => 'Biology', 'code' => 'BIO', 'description' => 'Biology', 'is_active' => true],
            ['name' => 'History', 'code' => 'HIST', 'description' => 'History', 'is_active' => true],
            ['name' => 'Geography', 'code' => 'GEO', 'description' => 'Geography', 'is_active' => true],
            ['name' => 'Literature', 'code' => 'LIT', 'description' => 'Literature in English', 'is_active' => true],
            ['name' => 'Computer Studies', 'code' => 'ICT', 'description' => 'Information Technology', 'is_active' => true],
            ['name' => 'Art & Design', 'code' => 'ART', 'description' => 'Art and Design', 'is_active' => true],
            ['name' => 'Music', 'code' => 'MUS', 'description' => 'Music', 'is_active' => true],
            ['name' => 'Physical Education', 'code' => 'PE', 'description' => 'Physical Education', 'is_active' => true],
        ];

        $this->command->info('📚 Seeding subjects...');

        foreach ($subjects as $subject) {
            try {
                Subject::updateOrCreate(
                    ['code' => $subject['code']], // Use code as unique identifier
                    $subject
                );
            } catch (\Exception $e) {
                $this->command->error("❌ Error creating subject {$subject['name']}: {$e->getMessage()}");
            }
        }

        $this->command->info('✅ Subjects seeded successfully!');
        $this->command->info('📊 Total subjects: ' . Subject::count());
    }
}
