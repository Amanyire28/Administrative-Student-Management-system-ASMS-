<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeder.
     *
     * @return void
     */
    public function run()
    {
        $teachers = [
            [
                'teacher_id' => 'TCH001',
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'email' => 'sarah.johnson@school.com',
                'phone' => '+256701234567',
                'subject_specialization' => 'Mathematics',
                'qualification' => 'Bachelor of Education (Mathematics)',
                'hire_date' => '2020-01-15',
                'is_active' => true,
            ],
            [
                'teacher_id' => 'TCH002',
                'first_name' => 'Michael',
                'last_name' => 'Smith',
                'email' => 'michael.smith@school.com',
                'phone' => '+256701234568',
                'subject_specialization' => 'English',
                'qualification' => 'Bachelor of Arts (English Literature)',
                'hire_date' => '2019-08-20',
                'is_active' => true,
            ],
            [
                'teacher_id' => 'TCH003',
                'first_name' => 'Grace',
                'last_name' => 'Nakato',
                'email' => 'grace.nakato@school.com',
                'phone' => '+256701234569',
                'subject_specialization' => 'Science',
                'qualification' => 'Bachelor of Science (Biology)',
                'hire_date' => '2021-03-10',
                'is_active' => true,
            ],
            [
                'teacher_id' => 'TCH004',
                'first_name' => 'David',
                'last_name' => 'Mukasa',
                'email' => 'david.mukasa@school.com',
                'phone' => '+256701234570',
                'subject_specialization' => 'Social Studies',
                'qualification' => 'Bachelor of Arts (History)',
                'hire_date' => '2018-09-05',
                'is_active' => true,
            ],
            [
                'teacher_id' => 'TCH005',
                'first_name' => 'Mary',
                'last_name' => 'Achieng',
                'email' => 'mary.achieng@school.com',
                'phone' => '+256701234571',
                'subject_specialization' => 'Physics',
                'qualification' => 'Bachelor of Science (Physics)',
                'hire_date' => '2022-01-12',
                'is_active' => true,
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}