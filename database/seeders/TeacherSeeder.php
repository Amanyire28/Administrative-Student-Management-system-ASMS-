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
                'employee_id' => 'TCH001',
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'email' => 'sarah.johnson@school.com',
                'phone' => '+256701234567',
                'date_of_birth' => '1985-05-15',
                'gender' => 'female',
                'address' => 'Kampala, Uganda',
                'qualifications' => 'Bachelor of Education (Mathematics)',
                'employment_date' => '2020-01-15',
                'photo' => null,
                'is_active' => true,
            ],
            [
                'employee_id' => 'TCH002',
                'first_name' => 'Michael',
                'last_name' => 'Smith',
                'email' => 'michael.smith@school.com',
                'phone' => '+256701234568',
                'date_of_birth' => '1982-08-22',
                'gender' => 'male',
                'address' => 'Kampala, Uganda',
                'qualifications' => 'Bachelor of Arts (English Literature)',
                'employment_date' => '2019-08-20',
                'photo' => null,
                'is_active' => true,
            ],
            [
                'employee_id' => 'TCH003',
                'first_name' => 'Grace',
                'last_name' => 'Nakato',
                'email' => 'grace.nakato@school.com',
                'phone' => '+256701234569',
                'date_of_birth' => '1990-03-10',
                'gender' => 'female',
                'address' => 'Kampala, Uganda',
                'qualifications' => 'Bachelor of Science (Biology)',
                'employment_date' => '2021-03-10',
                'photo' => null,
                'is_active' => true,
            ],
            [
                'employee_id' => 'TCH004',
                'first_name' => 'David',
                'last_name' => 'Mukasa',
                'email' => 'david.mukasa@school.com',
                'phone' => '+256701234570',
                'date_of_birth' => '1987-11-30',
                'gender' => 'male',
                'address' => 'Kampala, Uganda',
                'qualifications' => 'Bachelor of Arts (History)',
                'employment_date' => '2018-09-05',
                'photo' => null,
                'is_active' => true,
            ],
            [
                'employee_id' => 'TCH005',
                'first_name' => 'Mary',
                'last_name' => 'Achieng',
                'email' => 'mary.achieng@school.com',
                'phone' => '+256701234571',
                'date_of_birth' => '1992-07-18',
                'gender' => 'female',
                'address' => 'Kampala, Uganda',
                'qualifications' => 'Bachelor of Science (Physics)',
                'employment_date' => '2022-01-12',
                'photo' => null,
                'is_active' => true,
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::updateOrCreate(
                ['employee_id' => $teacher['employee_id']], // Search by unique identifier
                $teacher // Data to update or create
            );
        }
    }
}
