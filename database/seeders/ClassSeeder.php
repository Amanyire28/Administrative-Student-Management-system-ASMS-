<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\ClassLevel;
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
        // Get some class levels and streams
        $primaryLevels = ClassLevel::where('category', 'Primary')->take(3)->get();
        $streams = Stream::take(2)->get(); // A and B streams
        $teachers = Teacher::take(6)->get();

        $classIndex = 0;
        foreach ($primaryLevels as $level) {
            foreach ($streams as $stream) {
                $teacher = $teachers[$classIndex % $teachers->count()];
                
                ClassModel::create([
                    'name' => $level->name . ' ' . $stream->name,
                    'class_level_id' => $level->id,
                    'stream_id' => $stream->id,
                    'capacity' => 35,
                    'classroom' => 'Room ' . ($classIndex + 101),
                    'class_teacher_id' => $teacher->id,
                    'is_active' => true,
                ]);
                
                $classIndex++;
            }
        }
    }
}