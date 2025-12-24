<?php

namespace Database\Seeders;

use App\Models\ClassLevel;
use App\Models\ClassCategory;
use App\Models\Stream;
use Illuminate\Database\Seeder;

class ClassLevelSeeder extends Seeder
{
    /**
     * Run the database seeder.
     *
     * @return void
     */
    public function run()
    {
        // Create default class categories first
        $categories = [
            ['name' => 'Nursery', 'description' => 'Early childhood education', 'sort_order' => 1],
            ['name' => 'Primary', 'description' => 'Primary education levels', 'sort_order' => 2],
            ['name' => 'Secondary', 'description' => 'Secondary education levels', 'sort_order' => 3],
            ['name' => 'Advanced', 'description' => 'Advanced level education', 'sort_order' => 4],
        ];

        foreach ($categories as $category) {
            ClassCategory::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }

        // Get category IDs
        $nursery = ClassCategory::where('name', 'Nursery')->first();
        $primary = ClassCategory::where('name', 'Primary')->first();
        $secondary = ClassCategory::where('name', 'Secondary')->first();
        $advanced = ClassCategory::where('name', 'Advanced')->first();

        // Create default class levels
        $classLevels = [
            ['name' => 'Baby Class', 'category_id' => $nursery->id, 'sort_order' => 1],
            ['name' => 'Middle Class', 'category_id' => $nursery->id, 'sort_order' => 2],
            ['name' => 'Top Class', 'category_id' => $nursery->id, 'sort_order' => 3],
            ['name' => 'Primary 1', 'category_id' => $primary->id, 'sort_order' => 4],
            ['name' => 'Primary 2', 'category_id' => $primary->id, 'sort_order' => 5],
            ['name' => 'Primary 3', 'category_id' => $primary->id, 'sort_order' => 6],
            ['name' => 'Primary 4', 'category_id' => $primary->id, 'sort_order' => 7],
            ['name' => 'Primary 5', 'category_id' => $primary->id, 'sort_order' => 8],
            ['name' => 'Primary 6', 'category_id' => $primary->id, 'sort_order' => 9],
            ['name' => 'Primary 7', 'category_id' => $primary->id, 'sort_order' => 10],
            ['name' => 'Senior 1', 'category_id' => $secondary->id, 'sort_order' => 11],
            ['name' => 'Senior 2', 'category_id' => $secondary->id, 'sort_order' => 12],
            ['name' => 'Senior 3', 'category_id' => $secondary->id, 'sort_order' => 13],
            ['name' => 'Senior 4', 'category_id' => $secondary->id, 'sort_order' => 14],
            ['name' => 'Senior 5', 'category_id' => $advanced->id, 'sort_order' => 15],
            ['name' => 'Senior 6', 'category_id' => $advanced->id, 'sort_order' => 16],
        ];

        foreach ($classLevels as $level) {
            ClassLevel::updateOrCreate(
                ['name' => $level['name']],
                $level
            );
        }

        // Create default streams
        $streams = [
            ['name' => 'A', 'description' => 'Stream A', 'sort_order' => 1],
            ['name' => 'B', 'description' => 'Stream B', 'sort_order' => 2],
            ['name' => 'C', 'description' => 'Stream C', 'sort_order' => 3],
            ['name' => 'D', 'description' => 'Stream D', 'sort_order' => 4],
            ['name' => 'E', 'description' => 'Stream E', 'sort_order' => 5],
        ];

        foreach ($streams as $stream) {
            Stream::updateOrCreate(
                ['name' => $stream['name']],
                $stream
            );
        }
    }
}