<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ClassLevel;
use App\Models\Stream;
use App\Models\ClassStream;
use App\Models\SchoolType;

class ClassSetupWizardController extends Controller
{
    /**
     * Show the class setup wizard
     */
    public function index()
    {
        return view('modules.classes.setup-wizard');
    }

    /**
     * Get predefined class options based on school type
     */
    public function getClassOptions(Request $request)
    {
        $schoolTypes = $request->input('school_types', []);
        $classOptions = [];

        foreach ($schoolTypes as $type) {
            switch ($type) {
                case 'nursery':
                    $classOptions['Nursery'] = [
                        'Baby', 'Middle', 'Top'
                    ];
                    break;
                
                case 'primary':
                    $classOptions['Primary'] = [
                        'P1', 'P2', 'P3', 'P4', 'P5', 'P6', 'P7'
                    ];
                    break;
                
                case 'secondary_o':
                    $classOptions['Secondary - O Level'] = [
                        'S1', 'S2', 'S3', 'S4'
                    ];
                    break;
                
                case 'secondary_a':
                    $classOptions['Secondary - A Level'] = [
                        'S5', 'S6'
                    ];
                    break;
            }
        }

        return response()->json($classOptions);
    }

    /**
     * Process and save the class structure
     */
    public function saveClassStructure(Request $request)
    {
        $request->validate([
            'mode' => 'required|in:fresh,update',
            'school_types' => 'required|array',
            'selected_classes' => 'required|array',
            'has_streams' => 'required|boolean',
            'streams' => 'nullable|array',
            'class_stream_assignments' => 'nullable|array',
            'custom_classes' => 'nullable|array',
        ]);

        try {
            DB::beginTransaction();

            $mode = $request->input('mode');
            $schoolTypes = $request->input('school_types');
            $selectedClasses = $request->input('selected_classes');
            $hasStreams = $request->input('has_streams');
            $streams = $request->input('streams', []);
            $classStreamAssignments = $request->input('class_stream_assignments', []);
            $customClasses = $request->input('custom_classes', []);

            // Track counts for response
            $initialClassLevels = ClassLevel::count();
            $initialStreams = Stream::count();
            $initialClassStreams = ClassStream::count();
            
            // Only clear existing data in fresh mode
            if ($mode === 'fresh') {
                // Clear all existing class data before creating new structure
                // Use delete instead of truncate to handle foreign key constraints properly
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                
                // Clear in proper order to respect foreign key constraints
                DB::table('class_subject')->delete();  // Clear pivot table first
                DB::table('marks')->delete();          // Clear marks that reference class_streams
                DB::table('students')->delete();       // Clear students that reference class_streams
                ClassStream::query()->delete();        // Clear class streams
                ClassLevel::query()->delete();         // Clear class levels
                Stream::query()->delete();             // Clear streams
                
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                
                // Reset counts for fresh mode
                $initialClassLevels = 0;
                $initialStreams = 0;
                $initialClassStreams = 0;
            }

            // Step 1: Create Streams (if applicable)
            $streamModels = [];
            if ($hasStreams && !empty($streams)) {
                foreach ($streams as $index => $streamName) {
                    if (!empty($streamName)) {
                        $stream = Stream::firstOrCreate([
                            'name' => trim($streamName)
                        ], [
                            'sort_order' => Stream::max('sort_order') + 1 ?? $index + 1,
                            'is_active' => true
                        ]);
                        $streamModels[$streamName] = $stream;
                    }
                }
            }

            // Step 2: Create Class Levels (with school type relationship)
            $classLevels = [];
            foreach ($selectedClasses as $categoryType => $classes) {
                $schoolType = $this->getSchoolType($categoryType);
                
                if ($schoolType) {
                    foreach ($classes as $index => $className) {
                        $classLevel = ClassLevel::firstOrCreate([
                            'name' => $className,
                            'school_type_id' => $schoolType->id,
                        ], [
                            'sort_order' => ClassLevel::where('school_type_id', $schoolType->id)->max('sort_order') + 1 ?? $index + 1,
                            'is_active' => true
                        ]);
                        $classLevels["{$categoryType}_{$className}"] = $classLevel;
                    }
                }
            }

            // Step 3: Create Class Streams (combinations) with flexible assignments
            if ($hasStreams && !empty($streamModels)) {
                foreach ($classLevels as $classKey => $classLevel) {
                    $assignedStreams = $classStreamAssignments[$classKey] ?? [];
                    
                    if (!empty($assignedStreams)) {
                        foreach ($assignedStreams as $streamName) {
                            if (isset($streamModels[$streamName])) {
                                $stream = $streamModels[$streamName];
                                ClassStream::firstOrCreate([
                                    'class_level_id' => $classLevel->id,
                                    'stream_id' => $stream->id
                                ], [
                                    'name' => $classLevel->name . ' ' . $stream->name,
                                    'is_active' => true
                                ]);
                            }
                        }
                    } else {
                        // If no streams assigned to this class, create without stream
                        ClassStream::firstOrCreate([
                            'class_level_id' => $classLevel->id,
                            'stream_id' => null
                        ], [
                            'name' => $classLevel->name,
                            'is_active' => true
                        ]);
                    }
                }
            } else {
                // Create class streams without streams (just the class level)
                foreach ($classLevels as $classLevel) {
                    ClassStream::firstOrCreate([
                        'class_level_id' => $classLevel->id,
                        'stream_id' => null
                    ], [
                        'name' => $classLevel->name,
                        'is_active' => true
                    ]);
                }
            }

            DB::commit();

            // Calculate what was actually created
            $finalClassLevels = ClassLevel::count();
            $finalStreams = Stream::count();
            $finalClassStreams = ClassStream::count();

            $message = $mode === 'fresh' 
                ? 'Class structure successfully created!' 
                : 'Class structure successfully updated!';

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => [
                    'class_levels_created' => $finalClassLevels - $initialClassLevels,
                    'streams_created' => $finalStreams - $initialStreams,
                    'class_streams_created' => $finalClassStreams - $initialClassStreams,
                    'total_class_levels' => $finalClassLevels,
                    'total_streams' => $finalStreams,
                    'total_class_streams' => $finalClassStreams,
                    'mode' => $mode
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Error ' . ($mode === 'fresh' ? 'creating' : 'updating') . ' class structure: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get school type by code
     */
    private function getSchoolType($code)
    {
        $nameMapping = [
            'nursery' => 'Nursery',
            'primary' => 'Primary',
            'secondary_o' => 'Secondary - O Level',
            'secondary_a' => 'Secondary - A Level',
            'other' => 'Other'
        ];
        
        $name = $nameMapping[$code] ?? 'Other';
        return SchoolType::where('name', $name)->first();
    }

    /**
     * Get school type code from name
     */
    private function getSchoolTypeCode($name)
    {
        $codeMapping = [
            'Nursery' => 'nursery',
            'Primary' => 'primary',
            'Secondary - O Level' => 'secondary_o',
            'Secondary - A Level' => 'secondary_a'
        ];
        
        return $codeMapping[$name] ?? 'other';
    }

    /**
     * Get category name from school type (for backward compatibility)
     */
    private function getCategoryName($type)
    {
        $schoolType = $this->getSchoolType($type);
        return $schoolType ? $schoolType->name : 'Other';
    }

    /**
     * Get existing class structure for update mode
     */
    public function getExistingStructure()
    {
        $classLevels = ClassLevel::with(['classStreams.stream', 'schoolType'])->get();
        $streams = Stream::all();
        
        $existingStructure = [
            'school_types' => [],
            'selected_classes' => [],
            'streams' => $streams->pluck('name')->toArray(),
            'class_stream_assignments' => []
        ];
        
        // Group class levels by school type
        foreach ($classLevels->groupBy('school_type_id') as $schoolTypeId => $levels) {
            $schoolType = $levels->first()->schoolType;
            if ($schoolType) {
                $schoolTypeCode = $this->getSchoolTypeCode($schoolType->name);
                $existingStructure['school_types'][] = $schoolTypeCode;
                $existingStructure['selected_classes'][$schoolTypeCode] = $levels->pluck('name')->toArray();
                
                // Get stream assignments for each class
                foreach ($levels as $level) {
                    $classKey = "{$schoolTypeCode}_{$level->name}";
                    $assignedStreams = $level->classStreams
                        ->filter(fn($cs) => $cs->stream)
                        ->map(fn($cs) => $cs->stream->name)
                        ->toArray();
                    
                    if (!empty($assignedStreams)) {
                        $existingStructure['class_stream_assignments'][$classKey] = $assignedStreams;
                    }
                }
            }
        }
        
        return response()->json($existingStructure);
    }

    /**
     * Get preview of class structure
     */
    public function getPreview(Request $request)
    {
        $schoolTypes = $request->input('school_types', []);
        $selectedClasses = $request->input('selected_classes', []);
        $hasStreams = $request->input('has_streams', false);
        $streams = $request->input('streams', []);

        $preview = [];

        foreach ($selectedClasses as $categoryType => $classes) {
            $categoryName = $this->getCategoryName($categoryType);
            
            if ($categoryName) {
                $preview[$categoryName] = [];
                
                foreach ($classes as $className) {
                    if ($hasStreams && !empty($streams)) {
                        $classStreams = [];
                        foreach ($streams as $streamName) {
                            if (!empty($streamName)) {
                                $classStreams[] = trim($streamName);
                            }
                        }
                        $preview[$categoryName][$className] = $classStreams;
                    } else {
                        $preview[$categoryName][$className] = [];
                    }
                }
            }
        }

        return response()->json($preview);
    }
}