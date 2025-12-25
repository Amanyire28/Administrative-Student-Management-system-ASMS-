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
            ['name' => 'Mathematics', 'code' => 'MATH', 'description' => 'Core Mathematics', 'credit_hours' => 5, 'is_active' => true],
            ['name' => 'English', 'code' => 'ENG', 'description' => 'English Language', 'credit_hours' => 5, 'is_active' => true],
            ['name' => 'Science', 'code' => 'SCI', 'description' => 'General Science', 'credit_hours' => 4, 'is_active' => true],
            ['name' => 'Social Studies', 'code' => 'SST', 'description' => 'Social Studies', 'credit_hours' => 3, 'is_active' => true],
            ['name' => 'Religious Education', 'code' => 'RE', 'description' => 'Religious Education', 'credit_hours' => 2, 'is_active' => true],
            
            // Secondary Subjects
            ['name' => 'Physics', 'code' => 'PHY', 'description' => 'Physics', 'credit_hours' => 4, 'is_active' => true],
            ['name' => 'Chemistry', 'code' => 'CHEM', 'description' => 'Chemistry', 'credit_hours' => 4, 'is_active' => true],
            ['name' => 'Biology', 'code' => 'BIO', 'description' => 'Biology', 'credit_hours' => 4, 'is_active' => true],
            ['name' => 'History', 'code' => 'HIST', 'description' => 'History', 'credit_hours' => 3, 'is_active' => true],
            ['name' => 'Geography', 'code' => 'GEO', 'description' => 'Geography', 'credit_hours' => 3, 'is_active' => true],
            ['name' => 'Literature', 'code' => 'LIT', 'description' => 'Literature in English', 'credit_hours' => 3, 'is_active' => true],
            ['name' => 'Computer Studies', 'code' => 'ICT', 'description' => 'Information Technology', 'credit_hours' => 3, 'is_active' => true],
            ['name' => 'Art & Design', 'code' => 'ART', 'description' => 'Art and Design', 'credit_hours' => 2, 'is_active' => true],
            ['name' => 'Music', 'code' => 'MUS', 'description' => 'Music', 'credit_hours' => 2, 'is_active' => true],
            ['name' => 'Physical Education', 'code' => 'PE', 'description' => 'Physical Education', 'credit_hours' => 2, 'is_active' => true],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}