<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\ClassLevel;
use App\Models\ClassCategory;
use App\Models\Stream;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeder.
     *
     * @return void
     */
    public function run()
    {
        // First, let's check if we have a Primary category
        $primaryCategory = ClassCategory::where('name', 'Primary')->first();

        if (!$primaryCategory) {
            $this->command->warn('⚠️ Primary class category not found. Creating it...');
            $primaryCategory = ClassCategory::create([
                'name' => 'Primary',
                'description' => 'Primary school classes',
                'is_active' => true
            ]);
        }

        // Get class levels that belong to the Primary category
        $primaryLevels = ClassLevel::where('category_id', $primaryCategory->id)
                                  ->take(3)
                                  ->get();

        // Check if we have primary levels
        if ($primaryLevels->isEmpty()) {
            $this->command->warn('⚠️ No primary class levels found. Creating some...');

            // Create some primary class levels
            $primaryLevels = collect([
                ClassLevel::create(['name' => 'P.1', 'category_id' => $primaryCategory->id, 'sort_order' => 1, 'is_active' => true]),
                ClassLevel::create(['name' => 'P.2', 'category_id' => $primaryCategory->id, 'sort_order' => 2, 'is_active' => true]),
                ClassLevel::create(['name' => 'P.3', 'category_id' => $primaryCategory->id, 'sort_order' => 3, 'is_active' => true]),
            ]);
        }

        // Get streams
        $streams = Stream::take(2)->get();
        if ($streams->isEmpty()) {
            $this->command->warn('⚠️ No streams found. Creating streams A and B...');

            // Create streams if they don't exist
            $streams = collect([
                Stream::create(['name' => 'A', 'description' => 'Stream A', 'is_active' => true]),
                Stream::create(['name' => 'B', 'description' => 'Stream B', 'is_active' => true]),
            ]);
        }

        // Get teachers
        $teachers = Teacher::take(6)->get();
        if ($teachers->isEmpty()) {
            $this->command->warn('⚠️ No teachers found. Skipping class teacher assignment.');
        }

        $classIndex = 0;
        foreach ($primaryLevels as $level) {
            foreach ($streams as $stream) {
                $teacher = $teachers->isNotEmpty() ? $teachers[$classIndex % $teachers->count()] : null;

                ClassModel::firstOrCreate([
                    'class_level_id' => $level->id,
                    'stream_id' => $stream->id,
                ], [
                    'name' => $level->name . ' ' . $stream->name,

                    'classroom' => 'Room ' . ($classIndex + 101),
                    'class_teacher_id' => $teacher ? $teacher->id : null,
                    'is_active' => true,
                ]);

                $classIndex++;
            }
        }

        $this->command->info("✅ Created " . $classIndex . " classes");
    }
}
