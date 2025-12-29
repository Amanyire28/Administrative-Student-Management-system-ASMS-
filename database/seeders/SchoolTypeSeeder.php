<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolType;

class SchoolTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schoolTypes = [
            [
                'name' => 'Nursery',
                'description' => 'Early childhood education (ages 3-5)',
                'default_classes' => ['Baby', 'Middle', 'Top'],
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Primary',
                'description' => 'Primary education (ages 6-12)',
                'default_classes' => ['P1', 'P2', 'P3', 'P4', 'P5', 'P6', 'P7'],
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Secondary - O Level',
                'description' => 'Ordinary Level secondary education (ages 13-16)',
                'default_classes' => ['S1', 'S2', 'S3', 'S4'],
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Secondary - A Level',
                'description' => 'Advanced Level secondary education (ages 17-18)',
                'default_classes' => ['S5', 'S6'],
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Other',
                'description' => 'Other educational levels',
                'default_classes' => [],
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($schoolTypes as $schoolType) {
            SchoolType::firstOrCreate(
                ['name' => $schoolType['name']],
                $schoolType
            );
        }
    }
}