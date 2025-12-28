<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\ClassModel;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeder.
     *
     * @return void
     */
    public function run()
    {
        $classes = ClassModel::all();
        $studentCounter = 1;

        foreach ($classes as $class) {
            // Add 5-8 students per class
            $studentsCount = rand(5, 8);
            
            for ($i = 1; $i <= $studentsCount; $i++) {
                $studentId = 'STU' . date('Y') . str_pad($studentCounter, 3, '0', STR_PAD_LEFT);
                
                Student::create([
                    'student_id' => $studentId,
                    'first_name' => $this->getRandomFirstName(),
                    'last_name' => $this->getRandomLastName(),
                    'date_of_birth' => $this->getRandomDateOfBirth(),
                    'gender' => rand(0, 1) ? 'male' : 'female',
                    'email' => null,
                    'phone' => null,
                    'address' => $this->getRandomAddress(),
                    'parent_name' => $this->getRandomParentName(),
                    'parent_phone' => '+25670' . rand(1000000, 9999999),
                    'parent_email' => null,
                    'class_id' => $class->id,
                    'enrollment_date' => now()->subDays(rand(30, 365)),
                    'is_active' => true,
                ]);
                
                $studentCounter++;
            }
        }
    }

    private function getRandomFirstName()
    {
        $names = [
            'John', 'Mary', 'David', 'Sarah', 'Michael', 'Grace', 'Peter', 'Jane',
            'Paul', 'Ruth', 'James', 'Rebecca', 'Samuel', 'Esther', 'Daniel', 'Faith',
            'Joseph', 'Joy', 'Emmanuel', 'Peace', 'Isaac', 'Hope', 'Jacob', 'Love'
        ];
        return $names[array_rand($names)];
    }

    private function getRandomLastName()
    {
        $names = [
            'Mukasa', 'Nakato', 'Ssemakula', 'Namukasa', 'Kato', 'Nakamya',
            'Sserwadda', 'Namusoke', 'Lubega', 'Nakabugo', 'Musoke', 'Nalubega',
            'Ssekamate', 'Namatovu', 'Kyeyune', 'Nakiyingi', 'Ssebunya', 'Nakirya'
        ];
        return $names[array_rand($names)];
    }

    private function getRandomDateOfBirth()
    {
        // Generate ages between 6-18 years
        $yearsAgo = rand(6, 18);
        return now()->subYears($yearsAgo)->subDays(rand(0, 365))->format('Y-m-d');
    }

    private function getRandomAddress()
    {
        $areas = [
            'Kampala, Uganda', 'Entebbe, Uganda', 'Mukono, Uganda', 'Jinja, Uganda',
            'Masaka, Uganda', 'Mbarara, Uganda', 'Gulu, Uganda', 'Lira, Uganda'
        ];
        return $areas[array_rand($areas)];
    }

    private function getRandomParentName()
    {
        $titles = ['Mr.', 'Mrs.', 'Ms.'];
        $firstNames = ['John', 'Mary', 'David', 'Sarah', 'Michael', 'Grace', 'Peter', 'Jane'];
        $lastNames = ['Mukasa', 'Nakato', 'Ssemakula', 'Namukasa', 'Kato', 'Nakamya'];
        
        return $titles[array_rand($titles)] . ' ' . 
               $firstNames[array_rand($firstNames)] . ' ' . 
               $lastNames[array_rand($lastNames)];
    }
}