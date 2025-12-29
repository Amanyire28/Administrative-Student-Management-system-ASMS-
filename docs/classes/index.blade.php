@extends('layouts.app')

@section('title', 'Classes')
@section('page-title', 'Classes')
@section('page-description', 'Manage your school class structure')

@push('styles')
<style>
    .modal-hidden {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
    }
    
    .step-content {
        display: none;
    }
    
    .step-content:not(.hidden) {
        display: block;
    }
    
    /* Force maroon color for checkboxes and radio buttons */
    input[type="checkbox"]:checked,
    input[type="radio"]:checked {
        background-color: #800020 !important;
        border-color: #800020 !important;
    }
    
    input[type="checkbox"]:focus,
    input[type="radio"]:focus {
        ring-color: #800020 !important;
        border-color: #800020 !important;
        box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1) !important;
    }
    
    input[type="checkbox"],
    input[type="radio"] {
        accent-color: #800020 !important;
    }
</style>
@endpush

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-layer-group text-2xl text-green-600"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Class Levels</dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white">{{ $totalClassLevels }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-stream text-2xl text-purple-600"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Streams</dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white">{{ $totalStreams }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-chalkboard text-2xl text-orange-600"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Classes</dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white">{{ $totalClassStreams }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Classes Table -->
    <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center border-b border-gray-200 dark:border-gray-600">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                    All Classes
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                    Complete list of all classes in your school
                </p>
            </div>
            <div class="flex space-x-3">
                @if($totalClassStreams > 0)
                    <div class="flex gap-2">
                        <button type="button" onclick="openSetupModal('update')" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition"
                           title="Add new classes and streams to existing structure">
                            <i class="fas fa-plus mr-2"></i>
                            Update Structure
                        </button>
                        <button type="button" onclick="openSetupModal('fresh')" 
                           class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition"
                           title="Warning: This will delete all existing classes and create new ones">
                            <i class="fas fa-redo mr-2"></i>
                            Reset & Re-setup
                        </button>
                    </div>
                    @can('classes.create')
                    <a href="#" 
                       class="inline-flex items-center px-4 py-2 bg-maroon border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-maroon-dark transition">
                        <i class="fas fa-plus mr-2"></i>
                        Add Class
                    </a>
                    @endcan
                @else
                    <button type="button" onclick="openSetupModal('fresh')" 
                       class="inline-flex items-center px-4 py-2 bg-maroon border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-maroon-dark transition">
                        <i class="fas fa-magic mr-2"></i>
                        Set Up Class Structure
                    </button>
                @endif
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Class Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Class Level
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Stream
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Students
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                    @if($totalClassStreams > 0)
                        @foreach($categories as $category)
                            @foreach($category->classLevels as $classLevel)
                                @foreach($classLevel->classStreams as $classStream)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-maroon/10 flex items-center justify-center">
                                                    <i class="fas fa-chalkboard text-maroon"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $classStream->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        {{ $classLevel->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        @if($classStream->stream)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                                {{ $classStream->stream->name }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">No stream</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        <div class="flex items-center">
                                            <span class="text-sm font-medium">{{ $classStream->students->count() ?? 0 }}</span>
                                            <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">students</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($classStream->is_active)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            @can('classes.view-detail')
                                            <a href="{{ route('classes.show', $classStream->id) }}" class="text-maroon hover:text-maroon-dark" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @endcan
                                            @can('classes.edit')
                                            <a href="{{ route('classes.edit', $classStream->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300" title="Edit Class">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endcan
                                            @can('classes.delete')
                                            <form method="POST" action="{{ route('classes.destroy', $classStream->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this class?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" title="Delete Class">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-chalkboard text-4xl text-gray-400 dark:text-gray-500 mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No classes found</h3>
                                    <p class="text-gray-500 dark:text-gray-400 mb-4">Get started by setting up your school's class structure.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Setup Wizard Modal -->
<div id="classSetupModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden modal-hidden">
    <div class="relative top-10 mx-auto p-4 border w-11/12 md:w-3/4 lg:w-1/2 max-w-2xl shadow-lg rounded-md bg-white dark:bg-gray-800 max-h-[90vh] overflow-y-auto">
        
        <!-- Progress Bar -->
        <div class="mb-4">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">Step <span id="currentStep">1</span> of 8</span>
                <span class="text-xs text-gray-500 dark:text-gray-400" id="stepTitle">Setup Class Structure</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                <div id="progressBar" class="bg-maroon h-1.5 rounded-full transition-all duration-300" style="width: 12.5%"></div>
            </div>
        </div>

        <!-- Step 1: Introduction -->
        <div id="step1" class="step-content">
            <div class="text-center mb-4">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-maroon/10 mb-3">
                    <i class="fas fa-school text-lg text-maroon"></i>
                </div>
                <h3 id="step1Title" class="text-lg font-bold text-gray-900 dark:text-white mb-2">Set up your school class structure</h3>
                <p id="step1Description" class="text-sm text-gray-600 dark:text-gray-400">Generate classes and streams automatically.</p>
            </div>
            
            <div class="p-3">
                <div class="flex">
                    <i class="fas fa-info-circle text-gray-500 mt-0.5 mr-2 text-sm"></i>
                    <div>
                        <h4 class="text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">What we'll create:</h4>
                        <ul class="text-xs text-gray-600 dark:text-gray-400 list-disc list-inside space-y-0.5">
                            <li>Class levels (P1, P2, S1, S2, etc.)</li>
                            <li>Streams (A, B, C, etc.) - optional</li>
                            <li>Class combinations (P1A, P2B, etc.)</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div id="freshModeWarning" class="mt-3 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                <div class="flex">
                    <i class="fas fa-exclamation-triangle text-red-500 mt-0.5 mr-2 text-sm"></i>
                    <div>
                        <h4 class="text-xs font-medium text-red-800 dark:text-red-200 mb-1">Important Warning:</h4>
                        <p class="text-xs text-red-700 dark:text-red-300">Running this setup will permanently delete all existing classes, streams, and class combinations. Students will need to be reassigned to new classes.</p>
                    </div>
                </div>
            </div>
            
            <div id="updateModeInfo" class="mt-3 p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg hidden">
                <div class="flex">
                    <i class="fas fa-plus-circle text-green-500 mt-0.5 mr-2 text-sm"></i>
                    <div>
                        <h4 class="text-xs font-medium text-green-800 dark:text-green-200 mb-1">Update Mode:</h4>
                        <p class="text-xs text-green-700 dark:text-green-300">This will add new classes and streams to your existing structure. Existing classes and student assignments will be preserved.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 2: School Type Selection -->
        <div id="step2" class="step-content hidden">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Choose Type of School</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Select all that apply:</p>
            
            <div class="space-y-2">
                <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                    <input type="checkbox" name="school_types" value="nursery" class="h-4 w-4 text-maroon focus:ring-maroon border-gray-300 rounded">
                    <div class="ml-3 flex-1">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">Nursery</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Baby, Middle, Top classes</div>
                    </div>
                    <i class="fas fa-check text-green-600 dark:text-green-400 ml-2 hidden existing-indicator"></i>
                </label>
                
                <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                    <input type="checkbox" name="school_types" value="primary" class="h-4 w-4 text-maroon focus:ring-maroon border-gray-300 rounded">
                    <div class="ml-3 flex-1">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">Primary</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">P1, P2, P3, P4, P5, P6, P7</div>
                    </div>
                    <i class="fas fa-check text-green-600 dark:text-green-400 ml-2 hidden existing-indicator"></i>
                </label>
                
                <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                    <input type="checkbox" name="school_types" value="secondary_o" class="h-4 w-4 text-maroon focus:ring-maroon border-gray-300 rounded">
                    <div class="ml-3 flex-1">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">Secondary – O Level</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">S1, S2, S3, S4</div>
                    </div>
                    <i class="fas fa-check text-green-600 dark:text-green-400 ml-2 hidden existing-indicator"></i>
                </label>
                
                <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                    <input type="checkbox" name="school_types" value="secondary_a" class="h-4 w-4 text-maroon focus:ring-maroon border-gray-300 rounded">
                    <div class="ml-3 flex-1">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">Secondary – A Level</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">S5, S6</div>
                    </div>
                    <i class="fas fa-check text-green-600 dark:text-green-400 ml-2 hidden existing-indicator"></i>
                </label>
                
                <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                    <input type="checkbox" name="school_types" value="other" class="h-4 w-4 text-maroon focus:ring-maroon border-gray-300 rounded">
                    <div class="ml-3 flex-1">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">Other</div>
                        <input type="text" name="other_type" placeholder="Specify other type..." 
                               class="mt-1 w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded focus:ring-maroon focus:border-maroon bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-xs" 
                               disabled>
                    </div>
                    <i class="fas fa-check text-green-600 dark:text-green-400 ml-2 hidden existing-indicator"></i>
                </label>
            </div>
        </div>

        <!-- Step 3: Class Selection -->
        <div id="step3" class="step-content hidden">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Select Classes</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Choose which classes your school offers:</p>
            
            <div id="classSelectionContainer" class="max-h-64 overflow-y-auto mb-4">
                <!-- Dynamic content will be loaded here -->
            </div>
            
            <!-- Custom Classes Section -->
            <div class="border-t border-gray-200 dark:border-gray-600 pt-4">
                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Add Custom Classes</h4>
                <p class="text-xs text-gray-600 dark:text-gray-400 mb-3">Add classes that are not in the standard list above for each selected category:</p>
                
                <div id="customClassesContainer">
                    <!-- Custom classes will be added here organized by category -->
                </div>
                
                <div class="p-3">
                    <div class="flex">
                        <i class="fas fa-info-circle text-gray-500 mt-0.5 mr-2 text-sm"></i>
                        <div>
                            <h4 class="text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Tip:</h4>
                            <p class="text-xs text-gray-600 dark:text-gray-400">You can mix standard classes with custom ones. Custom classes will be grouped by category.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 4: Streams Question -->
        <div id="step4" class="step-content hidden">
            <div class="text-center mb-4">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-orange-100 dark:bg-orange-900/20 mb-3">
                    <i class="fas fa-stream text-lg text-orange-600 dark:text-orange-400"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Do You Have Streams?</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Do your classes have streams (like A, B, C sections)?</p>
            </div>
            
            <div class="space-y-3">
                <label class="flex items-center p-3 border-2 border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-all">
                    <input type="radio" name="has_streams" value="yes" class="h-4 w-4 text-maroon focus:ring-maroon border-gray-300">
                    <div class="ml-3">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">Yes, we have streams</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Classes divided into sections (e.g., P1A, P1B)</div>
                    </div>
                </label>
                
                <label class="flex items-center p-3 border-2 border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-all">
                    <input type="radio" name="has_streams" value="no" class="h-4 w-4 text-maroon focus:ring-maroon border-gray-300">
                    <div class="ml-3">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">No streams</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Single unit per class level (e.g., P1, P2)</div>
                    </div>
                </label>
            </div>
        </div>

        <!-- Step 5: Stream Entry -->
        <div id="step5" class="step-content hidden">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Enter Streams</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Add the streams your school uses:</p>
            
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Stream Names (comma separated)
                </label>
                <input type="text" id="streamsInput" placeholder="A, B, C or Red, Blue, Green..." 
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-maroon focus:border-maroon bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm">
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Separate multiple streams with commas</p>
            </div>
            
            <div class="mb-3">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Or add individually:</p>
                <div class="flex gap-2 mb-2">
                    <input type="text" id="singleStreamInput" placeholder="Stream name..." 
                           class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-maroon focus:border-maroon bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm">
                    <button type="button" id="addStreamBtn" 
                            class="px-3 py-2 bg-maroon text-white rounded-md hover:bg-maroon-dark transition-colors text-sm">
                        <i class="fas fa-plus mr-1"></i> Add
                    </button>
                </div>
            </div>
            
            <div id="streamsList" class="space-y-2 max-h-32 overflow-y-auto">
                <!-- Dynamic stream list will appear here -->
            </div>
        </div>

        <!-- Step 6: Assign Streams to Classes -->
        <div id="step6" class="step-content hidden">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Assign Streams to Classes</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Choose which streams each class level should have:</p>
            
            <div id="classStreamAssignmentContainer" class="max-h-64 overflow-y-auto space-y-3">
                <!-- Dynamic content will be loaded here -->
            </div>
            
            <div class="mt-3 p-3">
                <div class="flex">
                    <i class="fas fa-info-circle text-gray-500 mt-0.5 mr-2 text-sm"></i>
                    <div>
                        <h4 class="text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Tip:</h4>
                        <p class="text-xs text-gray-600 dark:text-gray-400">You can assign different streams to different classes. For example, P1 might have streams A, B, C while P2 only has A, B.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 7: Preview -->
        <div id="step7" class="step-content hidden">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Review Your Class Structure</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Review the class structure that will be created:</p>
            
            <div id="previewContainer" class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3 max-h-48 overflow-y-auto text-sm">
                <!-- Preview content will be generated here -->
            </div>
            
            <div class="mt-3 p-3">
                <div class="flex">
                    <i class="fas fa-exclamation-triangle text-gray-500 mt-0.5 mr-2 text-sm"></i>
                    <div>
                        <h4 class="text-xs font-medium text-gray-700 dark:text-gray-300">Note:</h4>
                        <p class="text-xs text-gray-600 dark:text-gray-400">You can modify before confirming.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 8: Success -->
        <div id="step8" class="step-content hidden">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 dark:bg-green-900/20 mb-3">
                    <i class="fas fa-check text-lg text-green-600 dark:text-green-400"></i>
                </div>
                <h3 id="step8Title" class="text-lg font-bold text-gray-900 dark:text-white mb-2">Class Structure Created Successfully!</h3>
                <p id="step8Description" class="text-sm text-gray-600 dark:text-gray-400 mb-4">Your school's class structure has been set up and is ready to use.</p>
                
                <div id="successSummary" class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-3 text-sm">
                    <!-- Success summary will be populated here -->
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
            <button type="button" id="prevBtn" 
                    class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors hidden text-sm">
                <i class="fas fa-arrow-left mr-1"></i> Previous
            </button>
            
            <div class="flex gap-2">
                <button type="button" id="skipBtn" 
                        class="px-4 py-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-colors text-sm">
                    Skip Setup
                </button>
                
                <button type="button" id="nextBtn" 
                        class="px-4 py-2 bg-maroon text-white rounded-md hover:bg-maroon-dark transition-colors text-sm">
                    Next <i class="fas fa-arrow-right ml-1"></i>
                </button>
                
                <button type="button" id="confirmBtn" 
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors hidden text-sm">
                    <i class="fas fa-check mr-1"></i> Confirm & Save
                </button>
                
                <button type="button" id="finishBtn" 
                        class="px-4 py-2 bg-maroon text-white rounded-md hover:bg-maroon-dark transition-colors hidden text-sm">
                    <i class="fas fa-times mr-1"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Ensure modal is hidden on page load
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('classSetupModal');
    if (modal) {
        modal.classList.add('hidden', 'modal-hidden');
        modal.style.display = 'none';
        modal.style.visibility = 'hidden';
        modal.style.opacity = '0';
    }
});

// Modal functions
function openSetupModal(mode = 'fresh') {
    const modal = document.getElementById('classSetupModal');
    modal.classList.remove('hidden', 'modal-hidden');
    modal.style.display = 'block';
    modal.style.visibility = 'visible';
    modal.style.opacity = '1';
    initializeWizard(mode);
}

function closeSetupModal() {
    const modal = document.getElementById('classSetupModal');
    modal.classList.add('hidden', 'modal-hidden');
    modal.style.display = 'none';
    modal.style.visibility = 'hidden';
    modal.style.opacity = '0';
    resetWizard();
}

// Wizard state management
let currentStep = 1;
const totalSteps = 8;
let wizardData = {
    mode: 'fresh', // 'fresh' or 'update'
    schoolTypes: [],
    selectedClasses: {},
    hasStreams: false,
    streams: [],
    classStreamAssignments: {}, // New property for flexible stream assignments
    customClasses: {} // New property for custom classes
};

// Initialize wizard
function initializeWizard(mode = 'fresh') {
    currentStep = 1;
    wizardData = {
        mode: mode,
        schoolTypes: [],
        selectedClasses: {},
        hasStreams: false,
        streams: [],
        classStreamAssignments: {},
        customClasses: {}
    };
    
    updateStepDisplay();
    bindEventListeners();
    
    // Load existing data if in update mode (with small delay to ensure DOM is ready)
    if (mode === 'update') {
        setTimeout(() => {
            loadExistingStructure();
        }, 100);
    }
}

function resetWizard() {
    currentStep = 1;
    wizardData = {
        schoolTypes: [],
        selectedClasses: {},
        hasStreams: false,
        streams: [],
        classStreamAssignments: {},
        customClasses: {}
    };
    // Reset all form inputs
    document.querySelectorAll('input[type="checkbox"], input[type="radio"]').forEach(input => {
        input.checked = false;
    });
    document.querySelectorAll('input[type="text"]').forEach(input => {
        input.value = '';
    });
}

function loadExistingStructure() {
    fetch('/admin/api/classes/setup-wizard/existing-structure', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        // Pre-populate wizard data with existing structure
        wizardData.schoolTypes = data.school_types || [];
        wizardData.selectedClasses = data.selected_classes || {};
        wizardData.streams = data.streams || [];
        wizardData.classStreamAssignments = data.class_stream_assignments || {};
        wizardData.hasStreams = wizardData.streams.length > 0;
        
        // Pre-populate streams input in step 5
        if (wizardData.streams.length > 0) {
            const streamsInput = document.getElementById('streamsInput');
            if (streamsInput) {
                streamsInput.value = wizardData.streams.join(', ');
            }
            updateStreamsList();
        }
    })
    .catch(error => {
        console.error('Error loading existing structure:', error);
    });
}

function preCheckSchoolTypes() {
    // This function is now only used for initial setup, not for highlighting
    // The highlighting is handled by applyStep2Highlighting and applyStep4Highlighting
}

function applyStep2Highlighting() {
    // Pre-check school type checkboxes and show indicators
    wizardData.schoolTypes.forEach(type => {
        const checkbox = document.querySelector(`input[name="school_types"][value="${type}"]`);
        if (checkbox) {
            checkbox.checked = true;
            // Show existing indicator and highlight the label
            const label = checkbox.closest('label');
            const indicator = label.querySelector('.existing-indicator');
            if (indicator) {
                indicator.classList.remove('hidden');
            }
            label.classList.add('bg-green-50', 'dark:bg-green-900/20', 'border-green-300', 'dark:border-green-600');
        }
    });
}

function applyStep4Highlighting() {
    // Pre-check streams radio button and highlight it
    if (wizardData.hasStreams) {
        const streamsRadio = document.querySelector('input[name="has_streams"][value="yes"]');
        if (streamsRadio) {
            streamsRadio.checked = true;
            const label = streamsRadio.closest('label');
            label.classList.add('bg-green-50', 'dark:bg-green-900/20', 'border-green-300', 'dark:border-green-600');
        }
    } else {
        const noStreamsRadio = document.querySelector('input[name="has_streams"][value="no"]');
        if (noStreamsRadio) {
            noStreamsRadio.checked = true;
            const label = noStreamsRadio.closest('label');
            label.classList.add('bg-green-50', 'dark:bg-green-900/20', 'border-green-300', 'dark:border-green-600');
        }
    }
}

function bindEventListeners() {
    // Navigation buttons
    document.getElementById('nextBtn').addEventListener('click', nextStep);
    document.getElementById('prevBtn').addEventListener('click', prevStep);
    document.getElementById('confirmBtn').addEventListener('click', confirmSetup);
    document.getElementById('finishBtn').addEventListener('click', () => {
        closeSetupModal();
        location.reload(); // Refresh to show new classes
    });
    document.getElementById('skipBtn').addEventListener('click', closeSetupModal);

    // School type checkboxes
    document.querySelectorAll('input[name="school_types"]').forEach(checkbox => {
        checkbox.addEventListener('change', handleSchoolTypeChange);
    });

    // Other type input
    document.querySelector('input[name="school_types"][value="other"]').addEventListener('change', function() {
        const otherInput = document.querySelector('input[name="other_type"]');
        otherInput.disabled = !this.checked;
        if (!this.checked) otherInput.value = '';
    });

    // Streams radio buttons
    document.querySelectorAll('input[name="has_streams"]').forEach(radio => {
        radio.addEventListener('change', handleStreamsChoice);
    });

    // Stream input handlers
    document.getElementById('addStreamBtn').addEventListener('click', addSingleStream);
    document.getElementById('singleStreamInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') addSingleStream();
    });
    document.getElementById('streamsInput').addEventListener('input', handleStreamsInput);

    // Close modal when clicking outside
    document.getElementById('classSetupModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeSetupModal();
        }
    });
}

function updateStepDisplay() {
    // Hide all steps
    document.querySelectorAll('.step-content').forEach(step => step.classList.add('hidden'));
    
    // Show current step
    document.getElementById(`step${currentStep}`).classList.remove('hidden');
    
    // Update mode-specific content for Step 1
    if (currentStep === 1) {
        const title = document.getElementById('step1Title');
        const description = document.getElementById('step1Description');
        const freshWarning = document.getElementById('freshModeWarning');
        const updateInfo = document.getElementById('updateModeInfo');
        
        if (wizardData.mode === 'update') {
            title.textContent = 'Update your school class structure';
            description.textContent = 'Add new classes and streams to existing structure.';
            freshWarning.classList.add('hidden');
            updateInfo.classList.remove('hidden');
        } else {
            title.textContent = 'Set up your school class structure';
            description.textContent = 'Generate classes and streams automatically.';
            freshWarning.classList.remove('hidden');
            updateInfo.classList.add('hidden');
        }
    }
    
    // Apply existing data highlighting when step 2 is shown
    if (currentStep === 2 && wizardData.mode === 'update') {
        setTimeout(() => {
            applyStep2Highlighting();
        }, 50);
    }
    
    // Apply streams radio button highlighting when step 4 is shown
    if (currentStep === 4 && wizardData.mode === 'update') {
        setTimeout(() => {
            applyStep4Highlighting();
        }, 50);
    }
    
    // Update progress
    document.getElementById('currentStep').textContent = currentStep;
    document.getElementById('progressBar').style.width = `${(currentStep / totalSteps) * 100}%`;
    
    // Update step title
    const titles = [
        '', 'Setup Class Structure', 'Choose School Type', 'Select Classes', 
        'Streams Question', 'Enter Streams', 'Assign Streams', 'Review Structure', 'Setup Complete'
    ];
    document.getElementById('stepTitle').textContent = titles[currentStep];
    
    // Update button visibility
    updateButtonVisibility();
}

function updateButtonVisibility() {
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const confirmBtn = document.getElementById('confirmBtn');
    const finishBtn = document.getElementById('finishBtn');
    
    // Previous button
    prevBtn.classList.toggle('hidden', currentStep === 1);
    
    // Next/Confirm/Finish buttons
    if (currentStep === 7) {
        nextBtn.classList.add('hidden');
        confirmBtn.classList.remove('hidden');
        finishBtn.classList.add('hidden');
    } else if (currentStep === 8) {
        nextBtn.classList.add('hidden');
        confirmBtn.classList.add('hidden');
        finishBtn.classList.remove('hidden');
    } else {
        nextBtn.classList.remove('hidden');
        confirmBtn.classList.add('hidden');
        finishBtn.classList.add('hidden');
    }
}

function nextStep() {
    if (validateCurrentStep()) {
        if (currentStep < totalSteps) {
            currentStep++;
            
            // Special handling for conditional steps
            if (currentStep === 3) {
                loadClassOptions();
            } else if (currentStep === 5 && !wizardData.hasStreams) {
                currentStep = 7; // Skip stream entry and assignment if no streams
            } else if (currentStep === 6 && !wizardData.hasStreams) {
                currentStep = 7; // Skip stream assignment if no streams
            } else if (currentStep === 6 && wizardData.hasStreams) {
                loadClassStreamAssignments();
            } else if (currentStep === 7) {
                generatePreview();
            }
            
            updateStepDisplay();
        }
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        
        // Special handling for conditional steps
        if (currentStep === 4 && !wizardData.hasStreams) {
            currentStep = 4; // Always show streams question
        }
        
        updateStepDisplay();
    }
}

function validateCurrentStep() {
    switch (currentStep) {
        case 2:
            const selectedTypes = document.querySelectorAll('input[name="school_types"]:checked');
            if (selectedTypes.length === 0) {
                alert('Please select at least one school type.');
                return false;
            }
            wizardData.schoolTypes = Array.from(selectedTypes).map(cb => cb.value);
            return true;
            
        case 3:
            // Validate class selection
            const hasSelectedClasses = Object.keys(wizardData.selectedClasses).some(
                category => wizardData.selectedClasses[category].length > 0
            );
            if (!hasSelectedClasses) {
                alert('Please select at least one class.');
                return false;
            }
            return true;
            
        case 4:
            const streamsChoice = document.querySelector('input[name="has_streams"]:checked');
            if (!streamsChoice) {
                alert('Please choose whether your school has streams.');
                return false;
            }
            wizardData.hasStreams = streamsChoice.value === 'yes';
            return true;
            
        case 5:
            if (wizardData.hasStreams && wizardData.streams.length === 0) {
                alert('Please add at least one stream.');
                return false;
            }
            return true;
            
        case 6:
            if (wizardData.hasStreams) {
                // Validate that at least one class has streams assigned
                const hasAssignments = Object.keys(wizardData.classStreamAssignments).some(
                    classKey => wizardData.classStreamAssignments[classKey].length > 0
                );
                if (!hasAssignments) {
                    alert('Please assign at least one stream to at least one class.');
                    return false;
                }
            }
            return true;
            
        default:
            return true;
    }
}

function handleSchoolTypeChange() {
    const selectedTypes = Array.from(document.querySelectorAll('input[name="school_types"]:checked'))
        .map(cb => cb.value);
    wizardData.schoolTypes = selectedTypes;
}

function loadClassOptions() {
    const container = document.getElementById('classSelectionContainer');
    container.innerHTML = '';
    
    const classOptions = {
        'nursery': {
            title: 'Nursery Classes',
            classes: ['Baby', 'Middle', 'Top']
        },
        'primary': {
            title: 'Primary Classes', 
            classes: ['P1', 'P2', 'P3', 'P4', 'P5', 'P6', 'P7']
        },
        'secondary_o': {
            title: 'Secondary - O Level',
            classes: ['S1', 'S2', 'S3', 'S4']
        },
        'secondary_a': {
            title: 'Secondary - A Level',
            classes: ['S5', 'S6']
        }
    };

    wizardData.schoolTypes.forEach(type => {
        if (classOptions[type]) {
            const section = createClassSection(type, classOptions[type]);
            container.appendChild(section);
        }
    });
    
    // Load custom classes interface for selected school types
    loadCustomClassesInterface();
}

function createClassSection(type, options) {
    const section = document.createElement('div');
    section.className = 'mb-3 p-3 border border-gray-200 dark:border-gray-600 rounded-lg';
    
    const existingClasses = wizardData.selectedClasses[type] || [];
    
    section.innerHTML = `
        <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">${options.title}</h4>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
            ${options.classes.map(className => {
                const isChecked = existingClasses.includes(className);
                return `
                    <label class="flex items-center p-2 border border-gray-200 dark:border-gray-600 rounded hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer ${isChecked ? 'bg-green-50 dark:bg-green-900/20 border-green-300 dark:border-green-600' : ''}">
                        <input type="checkbox" name="classes_${type}" value="${className}" 
                               ${isChecked ? 'checked' : ''}
                               class="h-3 w-3 text-maroon focus:ring-maroon border-gray-300 rounded"
                               onchange="handleClassSelection('${type}', '${className}', this.checked)">
                        <span class="ml-2 text-xs font-medium text-gray-900 dark:text-white">${className}</span>
                        ${isChecked ? '<i class="fas fa-check text-green-600 dark:text-green-400 ml-auto text-xs"></i>' : ''}
                    </label>
                `;
            }).join('')}
        </div>
    `;
    
    return section;
}

function handleClassSelection(type, className, isChecked) {
    if (!wizardData.selectedClasses[type]) {
        wizardData.selectedClasses[type] = [];
    }
    
    if (isChecked) {
        if (!wizardData.selectedClasses[type].includes(className)) {
            wizardData.selectedClasses[type].push(className);
        }
    } else {
        wizardData.selectedClasses[type] = wizardData.selectedClasses[type].filter(c => c !== className);
    }
}

function loadCustomClassesInterface() {
    const container = document.getElementById('customClassesContainer');
    container.innerHTML = '';
    
    const categoryNames = {
        'nursery': 'Nursery',
        'primary': 'Primary',
        'secondary_o': 'Secondary - O Level',
        'secondary_a': 'Secondary - A Level',
        'other': 'Other'
    };
    
    // Create custom class input sections for each selected school type
    wizardData.schoolTypes.forEach(type => {
        const categoryDiv = document.createElement('div');
        categoryDiv.className = 'mb-4 p-3 border border-gray-200 dark:border-gray-600 rounded-lg';
        
        categoryDiv.innerHTML = `
            <h5 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">${categoryNames[type]} - Add Custom Classes</h5>
            
            <div class="flex gap-2 mb-3">
                <input type="text" id="customClassName_${type}" placeholder="Class name (e.g., Grade 1, Form 1)" 
                       class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-maroon focus:border-maroon bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm">
                <button type="button" onclick="addCustomClass('${type}')" 
                        class="px-3 py-2 bg-maroon text-white rounded-md hover:bg-maroon-dark transition-colors text-sm">
                    <i class="fas fa-plus mr-1"></i> Add
                </button>
            </div>
            
            <div id="customClassesList_${type}" class="space-y-1">
                <!-- Custom classes for this category will appear here -->
            </div>
        `;
        
        container.appendChild(categoryDiv);
        
        // Add enter key listener for this input
        const input = categoryDiv.querySelector(`#customClassName_${type}`);
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') addCustomClass(type);
        });
    });
    
    // Update display with existing custom classes
    updateCustomClassesDisplay();
}

function addCustomClass(category) {
    const classNameInput = document.getElementById(`customClassName_${category}`);
    const className = classNameInput.value.trim();
    
    if (!className) {
        alert('Please enter a class name.');
        return;
    }
    
    // Initialize custom classes for category if not exists
    if (!wizardData.customClasses[category]) {
        wizardData.customClasses[category] = [];
    }
    
    // Check if class already exists in custom or selected classes
    const allClasses = [...(wizardData.selectedClasses[category] || []), ...wizardData.customClasses[category]];
    if (allClasses.includes(className)) {
        alert('This class already exists in this category.');
        return;
    }
    
    // Add to custom classes
    wizardData.customClasses[category].push(className);
    
    // Also add to selected classes
    if (!wizardData.selectedClasses[category]) {
        wizardData.selectedClasses[category] = [];
    }
    wizardData.selectedClasses[category].push(className);
    
    // Clear input
    classNameInput.value = '';
    
    // Update display
    updateCustomClassesDisplay();
}

function removeCustomClass(category, className) {
    // Remove from custom classes
    if (wizardData.customClasses[category]) {
        wizardData.customClasses[category] = wizardData.customClasses[category].filter(c => c !== className);
    }
    
    // Remove from selected classes
    if (wizardData.selectedClasses[category]) {
        wizardData.selectedClasses[category] = wizardData.selectedClasses[category].filter(c => c !== className);
    }
    
    // Update display
    updateCustomClassesDisplay();
}

function updateCustomClassesDisplay() {
    Object.keys(wizardData.customClasses).forEach(category => {
        const listContainer = document.getElementById(`customClassesList_${category}`);
        if (listContainer) {
            listContainer.innerHTML = '';
            
            const classes = wizardData.customClasses[category];
            classes.forEach(className => {
                const classDiv = document.createElement('div');
                classDiv.className = 'flex items-center justify-between p-2 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded';
                classDiv.innerHTML = `
                    <span class="text-sm font-medium text-gray-900 dark:text-white">${className}</span>
                    <button type="button" onclick="removeCustomClass('${category}', '${className}')" 
                            class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-sm">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                listContainer.appendChild(classDiv);
            });
        }
    });
}

function handleStreamsChoice() {
    const choice = document.querySelector('input[name="has_streams"]:checked');
    wizardData.hasStreams = choice.value === 'yes';
}

function handleStreamsInput() {
    const input = document.getElementById('streamsInput');
    const streams = input.value.split(',').map(s => s.trim()).filter(s => s.length > 0);
    wizardData.streams = streams;
    updateStreamsList();
}

function addSingleStream() {
    const input = document.getElementById('singleStreamInput');
    const streamName = input.value.trim();
    
    if (streamName && !wizardData.streams.includes(streamName)) {
        wizardData.streams.push(streamName);
        input.value = '';
        updateStreamsList();
        
        // Update the comma-separated input too
        document.getElementById('streamsInput').value = wizardData.streams.join(', ');
    }
}

function updateStreamsList() {
    const container = document.getElementById('streamsList');
    container.innerHTML = '';
    
    wizardData.streams.forEach((stream, index) => {
        const streamItem = document.createElement('div');
        streamItem.className = 'flex items-center justify-between p-2 bg-gray-50 dark:bg-gray-700 rounded';
        streamItem.innerHTML = `
            <div class="flex items-center">
                <span class="text-sm font-medium text-gray-900 dark:text-white">${stream}</span>
                ${wizardData.mode === 'update' ? '<i class="fas fa-info-circle text-blue-500 ml-2 text-xs" title="Existing stream"></i>' : ''}
            </div>
            <button type="button" onclick="removeStream(${index})" 
                    class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-sm">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(streamItem);
    });
}

function removeStream(index) {
    wizardData.streams.splice(index, 1);
    updateStreamsList();
    document.getElementById('streamsInput').value = wizardData.streams.join(', ');
}

function loadClassStreamAssignments() {
    const container = document.getElementById('classStreamAssignmentContainer');
    container.innerHTML = '';
    
    // Initialize assignments if not already done (for fresh mode)
    if (Object.keys(wizardData.classStreamAssignments).length === 0 && wizardData.mode === 'fresh') {
        Object.keys(wizardData.selectedClasses).forEach(categoryType => {
            wizardData.selectedClasses[categoryType].forEach(className => {
                const classKey = `${categoryType}_${className}`;
                wizardData.classStreamAssignments[classKey] = [...wizardData.streams]; // Default to all streams
            });
        });
    }
    
    const categoryNames = {
        'nursery': 'Nursery',
        'primary': 'Primary', 
        'secondary_o': 'Secondary - O Level',
        'secondary_a': 'Secondary - A Level'
    };
    
    Object.keys(wizardData.selectedClasses).forEach(categoryType => {
        const classes = wizardData.selectedClasses[categoryType];
        if (classes.length > 0) {
            const categorySection = document.createElement('div');
            categorySection.className = 'mb-4 p-3 border border-gray-200 dark:border-gray-600 rounded-lg';
            
            let categoryHTML = `
                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">
                    ${categoryNames[categoryType]}
                </h4>
            `;
            
            classes.forEach(className => {
                const classKey = `${categoryType}_${className}`;
                const assignedStreams = wizardData.classStreamAssignments[classKey] || [];
                
                categoryHTML += `
                    <div class="mb-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-900 dark:text-white">${className}</span>
                            <div class="flex gap-2">
                                <button type="button" onclick="selectAllStreamsForClass('${classKey}')" 
                                        class="text-xs px-2 py-1 bg-maroon text-white rounded hover:bg-maroon-dark">
                                    Select All
                                </button>
                                <button type="button" onclick="clearAllStreamsForClass('${classKey}')" 
                                        class="text-xs px-2 py-1 bg-gray-500 text-white rounded hover:bg-gray-600">
                                    Clear All
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                `;
                
                wizardData.streams.forEach(streamName => {
                    const isChecked = assignedStreams.includes(streamName);
                    categoryHTML += `
                        <label class="flex items-center p-2 border border-gray-200 dark:border-gray-600 rounded hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer ${isChecked ? 'bg-green-50 dark:bg-green-900/20 border-green-300 dark:border-green-600' : ''}">
                            <input type="checkbox" 
                                   ${isChecked ? 'checked' : ''} 
                                   onchange="handleStreamAssignment('${classKey}', '${streamName}', this.checked)"
                                   class="h-3 w-3 text-maroon focus:ring-maroon border-gray-300 rounded">
                            <span class="ml-2 text-xs font-medium text-gray-900 dark:text-white">${streamName}</span>
                            ${isChecked ? '<i class="fas fa-check text-green-600 dark:text-green-400 ml-auto text-xs"></i>' : ''}
                        </label>
                    `;
                });
                
                categoryHTML += `
                        </div>
                    </div>
                `;
            });
            
            categorySection.innerHTML = categoryHTML;
            container.appendChild(categorySection);
        }
    });
}

function handleStreamAssignment(classKey, streamName, isChecked) {
    if (!wizardData.classStreamAssignments[classKey]) {
        wizardData.classStreamAssignments[classKey] = [];
    }
    
    if (isChecked) {
        if (!wizardData.classStreamAssignments[classKey].includes(streamName)) {
            wizardData.classStreamAssignments[classKey].push(streamName);
        }
    } else {
        wizardData.classStreamAssignments[classKey] = wizardData.classStreamAssignments[classKey].filter(s => s !== streamName);
    }
}

function selectAllStreamsForClass(classKey) {
    wizardData.classStreamAssignments[classKey] = [...wizardData.streams];
    loadClassStreamAssignments(); // Refresh the display
}

function clearAllStreamsForClass(classKey) {
    wizardData.classStreamAssignments[classKey] = [];
    loadClassStreamAssignments(); // Refresh the display
}

function generatePreview() {
    const container = document.getElementById('previewContainer');
    container.innerHTML = '';
    
    Object.keys(wizardData.selectedClasses).forEach(categoryType => {
        const classes = wizardData.selectedClasses[categoryType];
        if (classes.length > 0) {
            const categoryNames = {
                'nursery': 'Nursery',
                'primary': 'Primary', 
                'secondary_o': 'Secondary - O Level',
                'secondary_a': 'Secondary - A Level'
            };
            
            const categorySection = document.createElement('div');
            categorySection.className = 'mb-4';
            
            let categoryHTML = `
                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">
                    ${categoryNames[categoryType]}
                </h4>
                <div class="space-y-1">
            `;
            
            classes.forEach(className => {
                const classKey = `${categoryType}_${className}`;
                const assignedStreams = wizardData.classStreamAssignments[classKey] || [];
                
                if (wizardData.hasStreams && assignedStreams.length > 0) {
                    const streamsList = assignedStreams.join(', ');
                    categoryHTML += `
                        <div class="flex items-center justify-between p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded">
                            <div>
                                <span class="font-medium text-gray-900 dark:text-white text-sm">${className}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">(${streamsList})</span>
                            </div>
                            <input type="checkbox" checked class="h-3 w-3 text-maroon focus:ring-maroon border-gray-300 rounded">
                        </div>
                    `;
                } else if (!wizardData.hasStreams) {
                    categoryHTML += `
                        <div class="flex items-center justify-between p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded">
                            <span class="font-medium text-gray-900 dark:text-white text-sm">${className}</span>
                            <input type="checkbox" checked class="h-3 w-3 text-maroon focus:ring-maroon border-gray-300 rounded">
                        </div>
                    `;
                } else {
                    // Class with no streams assigned
                    categoryHTML += `
                        <div class="flex items-center justify-between p-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded">
                            <div>
                                <span class="font-medium text-gray-900 dark:text-white text-sm">${className}</span>
                                <span class="text-xs text-gray-600 dark:text-gray-400 ml-2">(No streams assigned)</span>
                            </div>
                            <input type="checkbox" checked class="h-3 w-3 text-maroon focus:ring-maroon border-gray-300 rounded">
                        </div>
                    `;
                }
            });
            
            categoryHTML += '</div>';
            categorySection.innerHTML = categoryHTML;
            container.appendChild(categorySection);
        }
    });
}

function confirmSetup() {
    // Show loading state
    const confirmBtn = document.getElementById('confirmBtn');
    const originalText = confirmBtn.innerHTML;
    confirmBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Creating...';
    confirmBtn.disabled = true;
    
    // Prepare data for API
    const setupData = {
        mode: wizardData.mode,
        school_types: wizardData.schoolTypes,
        selected_classes: wizardData.selectedClasses,
        has_streams: wizardData.hasStreams,
        streams: wizardData.streams,
        class_stream_assignments: wizardData.classStreamAssignments,
        custom_classes: wizardData.customClasses,
        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };
    
    // Make API call to save class structure
    fetch('/admin/api/classes/setup-wizard/save', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': setupData._token,
            'Accept': 'application/json'
        },
        body: JSON.stringify(setupData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            currentStep = 8;
            
            // Update step 8 content based on mode
            const mode = data.data.mode || wizardData.mode;
            const isUpdate = mode === 'update';
            
            document.getElementById('step8Title').textContent = isUpdate 
                ? 'Class Structure Updated Successfully!' 
                : 'Class Structure Created Successfully!';
            document.getElementById('step8Description').textContent = isUpdate
                ? 'Your school\'s class structure has been updated with new classes and streams.'
                : 'Your school\'s class structure has been set up and is ready to use.';
            
            updateStepDisplay();
            
            // Show success summary
            const summary = document.getElementById('successSummary');
            
            summary.innerHTML = `
                <div class="text-left">
                    <h4 class="font-semibold text-green-800 dark:text-green-200 mb-2">Successfully ${isUpdate ? 'Updated' : 'Created'}:</h4>
                    <ul class="text-sm text-green-700 dark:text-green-300 space-y-1">
                        ${data.data.class_levels_created > 0 ? `<li><i class="fas fa-check mr-2"></i> ${data.data.class_levels_created} ${isUpdate ? 'new ' : ''}class levels</li>` : ''}
                        ${data.data.streams_created > 0 ? `<li><i class="fas fa-check mr-2"></i> ${data.data.streams_created} ${isUpdate ? 'new ' : ''}streams</li>` : ''}
                        ${data.data.class_streams_created > 0 ? `<li><i class="fas fa-check mr-2"></i> ${data.data.class_streams_created} ${isUpdate ? 'new ' : ''}class combinations</li>` : ''}
                    </ul>
                    ${isUpdate ? `
                        <div class="mt-3 pt-3 border-t border-green-200 dark:border-green-700">
                            <h5 class="font-medium text-green-800 dark:text-green-200 mb-1">Total Structure:</h5>
                            <ul class="text-xs text-green-600 dark:text-green-400 space-y-0.5">
                                <li>${data.data.total_class_levels} total class levels</li>
                                <li>${data.data.total_streams} total streams</li>
                                <li>${data.data.total_class_streams} total class combinations</li>
                            </ul>
                        </div>
                    ` : ''}
                </div>
            `;
        } else {
            alert('Error: ' + data.message);
            confirmBtn.innerHTML = originalText;
            confirmBtn.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while creating the class structure. Please try again.');
        confirmBtn.innerHTML = originalText;
        confirmBtn.disabled = false;
    });
}
</script>
@endsection