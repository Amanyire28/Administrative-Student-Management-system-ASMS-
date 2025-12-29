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
                            <dd class="text-lg font-medium text-gray-900 dark:text-white">{{ $totalClassLevels ?? 0 }}</dd>
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
                            <dd class="text-lg font-medium text-gray-900 dark:text-white">{{ $totalStreams ?? 0 }}</dd>
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
                            <dd class="text-lg font-medium text-gray-900 dark:text-white">{{ $totalClassStreams ?? 0 }}</dd>
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
                @if(($totalClassStreams ?? 0) > 0)
                    <div class="flex gap-2">
                        <button type="button" onclick="openSetupModal('fresh')" 
                           class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition"
                           title="Warning: This will delete all existing classes and create new ones">
                            <i class="fas fa-redo mr-2"></i>
                            Reset Classes
                        </button>
                    </div>
                    @can('classes.create')
                    <a href="{{ route('classes.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-maroon border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-maroon-dark transition">
                        <i class="fas fa-plus mr-2"></i>
                        Add Class
                    </a>
                    @endcan
                @else
                    <button type="button" onclick="openSetupModal('fresh')" 
                       class="inline-flex items-center px-4 py-2 bg-maroon border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-maroon-dark transition">
                        <i class="fas fa-magic mr-2"></i>
                        Setup Classes
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
                    @if(isset($classStreams) && $classStreams->count() > 0)
                        @foreach($classStreams as $classStream)
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
                                {{ $classStream->classLevel->name ?? 'N/A' }}
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
                                @if($classStream->is_active ?? true)
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

        <!-- Step 2: School Types -->
        <div id="step2" class="step-content hidden">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Select School Types</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Choose which types of education your school offers:</p>
            
            <div class="space-y-2">
                <label class="flex items-center p-2 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                    <input type="checkbox" name="school_types" value="nursery" class="mr-3 text-maroon">
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white text-sm">Nursery</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Early childhood education (Baby, Middle, Top)</div>
                    </div>
                </label>
                
                <label class="flex items-center p-2 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                    <input type="checkbox" name="school_types" value="primary" class="mr-3 text-maroon">
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white text-sm">Primary</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Primary education (P1 - P7)</div>
                    </div>
                </label>
                
                <label class="flex items-center p-2 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                    <input type="checkbox" name="school_types" value="secondary_o" class="mr-3 text-maroon">
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white text-sm">Secondary - O Level</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Ordinary Level (S1 - S4)</div>
                    </div>
                </label>
                
                <label class="flex items-center p-2 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                    <input type="checkbox" name="school_types" value="secondary_a" class="mr-3 text-maroon">
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white text-sm">Secondary - A Level</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Advanced Level (S5 - S6)</div>
                    </div>
                </label>
                
                <label class="flex items-center p-2 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                    <input type="checkbox" name="school_types" value="other" class="mr-3 text-maroon">
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white text-sm">Other</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Custom education levels</div>
                    </div>
                </label>
            </div>
        </div>

        <!-- Step 3: Class Selection -->
        <div id="step3" class="step-content hidden">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Select Classes</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Choose which classes to create for each school type:</p>
            
            <!-- Loading indicator -->
            <div id="classSelectionLoading" class="text-center py-8 hidden">
                <div class="inline-flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-maroon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-sm text-gray-600 dark:text-gray-400">Loading available classes...</span>
                </div>
            </div>
            
            <div id="classSelectionContainer"></div>
        </div>

        <!-- Step 4: Streams Setup -->
        <div id="step4" class="step-content hidden">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Streams Setup</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Do you want to use streams (A, B, C, etc.) to divide classes?</p>
            
            <div class="space-y-4">
                <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                    <input type="radio" name="has_streams" value="yes" class="mr-3 text-maroon">
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">Yes, use streams</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Create classes like P1A, P1B, S1A, S1B, etc.</div>
                    </div>
                </label>
                
                <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                    <input type="radio" name="has_streams" value="no" class="mr-3 text-maroon">
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">No streams</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Create simple classes like P1, P2, S1, S2, etc.</div>
                    </div>
                </label>
            </div>
        </div>

        <!-- Step 5: Stream Names -->
        <div id="step5" class="step-content hidden">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Stream Names</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Enter the names for your streams:</p>
            
            <div id="streamInputs" class="space-y-2">
                <div class="flex items-center space-x-2">
                    <input type="text" placeholder="Stream name (e.g., A)" class="stream-input flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm">
                    <button type="button" onclick="removeStreamInput(this)" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <button type="button" onclick="addStreamInput()" class="mt-3 text-sm text-maroon hover:text-maroon-dark">
                <i class="fas fa-plus mr-1"></i> Add Stream
            </button>
        </div>

        <!-- Step 6: Stream Assignments -->
        <div id="step6" class="step-content hidden">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Assign Streams to Classes</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Choose which streams each class should have:</p>
            <div id="streamAssignmentContainer"></div>
        </div>

        <!-- Step 7: Preview -->
        <div id="step7" class="step-content hidden">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Preview</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Review the classes that will be created:</p>
            
            <!-- Loading indicator -->
            <div id="previewLoading" class="text-center py-8 hidden">
                <div class="inline-flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-maroon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-sm text-gray-600 dark:text-gray-400">Generating preview...</span>
                </div>
            </div>
            
            <div id="previewContainer" class="max-h-64 overflow-y-auto"></div>
        </div>

        <!-- Step 8: Completion -->
        <div id="step8" class="step-content hidden">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 dark:bg-green-900 mb-4">
                    <i class="fas fa-check text-lg text-green-600 dark:text-green-400"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Setup Complete!</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Your class structure has been created successfully.</p>
                <div id="completionSummary" class="text-left bg-gray-50 dark:bg-gray-700 p-4 rounded-lg"></div>
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

// Setup wizard state
let setupWizardState = {
    mode: 'fresh',
    currentStep: 1,
    totalSteps: 8,
    schoolTypes: [],
    selectedClasses: {},
    hasStreams: false,
    streams: [],
    classStreamAssignments: {},
    classOptionsCache: {}, // Cache for class options
    previewCache: {} // Cache for preview data
};

// Modal functions
function openSetupModal(mode = 'fresh') {
    const modal = document.getElementById('classSetupModal');
    modal.classList.remove('hidden', 'modal-hidden');
    modal.style.display = 'block';
    modal.style.visibility = 'visible';
    modal.style.opacity = '1';
    
    // Reset wizard state
    setupWizardState.mode = mode;
    setupWizardState.currentStep = 1;
    
    // Always show fresh mode UI since we only have one mode now
    document.getElementById('step1Title').textContent = 'Set up your school class structure';
    document.getElementById('step1Description').textContent = 'Generate classes and streams automatically.';
    document.getElementById('freshModeWarning').style.display = 'block';
    document.getElementById('updateModeInfo').style.display = 'none';
    
    updateStepDisplay();
}

function closeSetupModal() {
    const modal = document.getElementById('classSetupModal');
    modal.classList.add('hidden', 'modal-hidden');
    modal.style.display = 'none';
    modal.style.visibility = 'hidden';
    modal.style.opacity = '0';
}

// Close modal when clicking outside
document.getElementById('classSetupModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeSetupModal();
    }
});

// Wizard navigation functions
function nextStep() {
    // Capture current step data before validation
    if (setupWizardState.currentStep === 2) {
        const selectedTypes = Array.from(document.querySelectorAll('input[name="school_types"]:checked')).map(cb => cb.value);
        setupWizardState.schoolTypes = selectedTypes;
    }
    
    if (validateCurrentStep()) {
        if (setupWizardState.currentStep < setupWizardState.totalSteps) {
            setupWizardState.currentStep++;
            updateStepDisplay();
            
            // Handle specific step logic
            if (setupWizardState.currentStep === 3) {
                loadClassOptions();
            } else if (setupWizardState.currentStep === 5 && !setupWizardState.hasStreams) {
                // Skip stream names if no streams
                setupWizardState.currentStep = 7;
                updateStepDisplay();
                generatePreview();
            } else if (setupWizardState.currentStep === 6) {
                generateStreamAssignments();
            } else if (setupWizardState.currentStep === 7) {
                generatePreview();
            }
        }
    }
}

function prevStep() {
    if (setupWizardState.currentStep > 1) {
        setupWizardState.currentStep--;
        
        // Handle skipping stream steps if no streams
        if (setupWizardState.currentStep === 6 && !setupWizardState.hasStreams) {
            setupWizardState.currentStep = 4;
        } else if (setupWizardState.currentStep === 5 && !setupWizardState.hasStreams) {
            setupWizardState.currentStep = 4;
        }
        
        updateStepDisplay();
    }
}

function updateStepDisplay() {
    // Hide all steps
    for (let i = 1; i <= setupWizardState.totalSteps; i++) {
        const step = document.getElementById(`step${i}`);
        if (step) {
            step.classList.add('hidden');
        }
    }
    
    // Show current step
    const currentStepEl = document.getElementById(`step${setupWizardState.currentStep}`);
    if (currentStepEl) {
        currentStepEl.classList.remove('hidden');
    }
    
    // Update progress bar
    const progress = (setupWizardState.currentStep / setupWizardState.totalSteps) * 100;
    document.getElementById('progressBar').style.width = `${progress}%`;
    document.getElementById('currentStep').textContent = setupWizardState.currentStep;
    
    // Update buttons
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const confirmBtn = document.getElementById('confirmBtn');
    const finishBtn = document.getElementById('finishBtn');
    
    prevBtn.classList.toggle('hidden', setupWizardState.currentStep === 1);
    nextBtn.classList.toggle('hidden', setupWizardState.currentStep === setupWizardState.totalSteps || setupWizardState.currentStep === 7);
    confirmBtn.classList.toggle('hidden', setupWizardState.currentStep !== 7);
    finishBtn.classList.toggle('hidden', setupWizardState.currentStep !== 8);
    
    // Update step title
    const stepTitles = {
        1: 'Introduction',
        2: 'School Types',
        3: 'Class Selection',
        4: 'Streams Setup',
        5: 'Stream Names',
        6: 'Stream Assignments',
        7: 'Preview',
        8: 'Complete'
    };
    document.getElementById('stepTitle').textContent = stepTitles[setupWizardState.currentStep] || '';
}

function validateCurrentStep() {
    switch (setupWizardState.currentStep) {
        case 2:
            const selectedTypes = Array.from(document.querySelectorAll('input[name="school_types"]:checked')).map(cb => cb.value);
            if (selectedTypes.length === 0) {
                alert('Please select at least one school type.');
                return false;
            }
            setupWizardState.schoolTypes = selectedTypes;
            break;
            
        case 3:
            // Validate class selection
            const hasSelectedClasses = Object.keys(setupWizardState.selectedClasses).some(type => 
                setupWizardState.selectedClasses[type] && setupWizardState.selectedClasses[type].length > 0
            );
            if (!hasSelectedClasses) {
                alert('Please select at least one class.');
                return false;
            }
            break;
            
        case 4:
            const streamChoice = document.querySelector('input[name="has_streams"]:checked');
            if (!streamChoice) {
                alert('Please choose whether to use streams or not.');
                return false;
            }
            setupWizardState.hasStreams = streamChoice.value === 'yes';
            break;
            
        case 5:
            if (setupWizardState.hasStreams) {
                const streamInputs = document.querySelectorAll('.stream-input');
                const streams = Array.from(streamInputs).map(input => input.value.trim()).filter(v => v);
                if (streams.length === 0) {
                    alert('Please enter at least one stream name.');
                    return false;
                }
                setupWizardState.streams = streams;
            }
            break;
    }
    return true;
}

// Load class options based on selected school types
async function loadClassOptions() {
    const loadingEl = document.getElementById('classSelectionLoading');
    const containerEl = document.getElementById('classSelectionContainer');
    
    // Debug: Check if school types are properly set
    console.log('Loading class options for school types:', setupWizardState.schoolTypes);
    
    if (!setupWizardState.schoolTypes || setupWizardState.schoolTypes.length === 0) {
        console.error('No school types selected');
        containerEl.innerHTML = '<div class="text-center py-4 text-red-600">No school types selected. Please go back and select school types.</div>';
        containerEl.style.display = 'block';
        return;
    }
    
    // Create cache key from selected school types
    const cacheKey = setupWizardState.schoolTypes.sort().join(',');
    
    // Check if we have cached data
    if (setupWizardState.classOptionsCache[cacheKey]) {
        renderClassOptions(setupWizardState.classOptionsCache[cacheKey]);
        return;
    }
    
    // Show loading, hide container
    loadingEl.classList.remove('hidden');
    containerEl.style.display = 'none';
    
    try {
        const response = await fetch('{{ route("api.classes.setup-wizard.class-options") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                school_types: setupWizardState.schoolTypes
            })
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const classOptions = await response.json();
        console.log('Received class options:', classOptions);
        
        // Cache the result
        setupWizardState.classOptionsCache[cacheKey] = classOptions;
        
        // Hide loading, show container
        loadingEl.classList.add('hidden');
        containerEl.style.display = 'block';
        
        renderClassOptions(classOptions);
    } catch (error) {
        console.error('Error loading class options:', error);
        
        // Hide loading, show error
        loadingEl.classList.add('hidden');
        containerEl.innerHTML = '<div class="text-center py-4 text-red-600">Error loading class options. Please try again.</div>';
        containerEl.style.display = 'block';
    }
}

function renderClassOptions(classOptions) {
    const container = document.getElementById('classSelectionContainer');
    container.innerHTML = '';
    
    Object.keys(classOptions).forEach(categoryName => {
        const safeCategoryName = sanitizeCategoryName(categoryName);
        const categoryDiv = document.createElement('div');
        categoryDiv.className = 'mb-6 p-4 border border-gray-200 dark:border-gray-600 rounded-lg';
        
        categoryDiv.innerHTML = `
            <div class="flex justify-between items-center mb-3">
                <h4 class="font-medium text-gray-900 dark:text-white">${categoryName}</h4>
                <div class="flex gap-2">
                    <button type="button" onclick="selectAllClasses('${safeCategoryName}')" class="text-xs text-maroon hover:text-maroon-dark">
                        <i class="fas fa-check-square mr-1"></i>Select All
                    </button>
                    <button type="button" onclick="deselectAllClasses('${safeCategoryName}')" class="text-xs text-gray-500 hover:text-gray-700">
                        <i class="fas fa-square mr-1"></i>Deselect All
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-2 mb-3" id="classes-grid-${safeCategoryName}">
                ${classOptions[categoryName].map(className => `
                    <label class="flex items-center p-2 border border-gray-200 dark:border-gray-600 rounded cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700">
                        <input type="checkbox" name="classes_${safeCategoryName}" value="${className}" class="mr-2 text-maroon" checked>
                        <span class="text-sm">${className}</span>
                        <button type="button" onclick="removeDefaultClass(this)" class="ml-auto text-red-500 hover:text-red-700 text-xs" title="Remove this class">
                            <i class="fas fa-times"></i>
                        </button>
                    </label>
                `).join('')}
            </div>
            <div class="border-t border-gray-200 dark:border-gray-600 pt-3">
                <div class="flex items-center gap-2 mb-2">
                    <input type="text" id="custom-class-${safeCategoryName}" placeholder="Add custom class (e.g., Pre-Unit)" class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm">
                    <button type="button" onclick="addCustomClass('${safeCategoryName}')" class="px-3 py-2 bg-maroon text-white rounded-md text-sm hover:bg-maroon-dark">
                        <i class="fas fa-plus mr-1"></i>Add
                    </button>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Add custom classes specific to your school</p>
            </div>
        `;
        
        container.appendChild(categoryDiv);
        
        // Add event listeners for existing checkboxes
        const checkboxes = categoryDiv.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                updateSelectedClasses();
            });
        });
        
        // Handle Enter key in custom class input
        const customInput = categoryDiv.querySelector(`#custom-class-${safeCategoryName}`);
        customInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                addCustomClass(safeCategoryName);
            }
        });
    });
    
    // Pre-select all classes and update state
    updateSelectedClasses();
}

function updateSelectedClasses() {
    setupWizardState.selectedClasses = {};
    
    setupWizardState.schoolTypes.forEach(type => {
        const schoolTypeName = getSchoolTypeName(type);
        const safeCategoryName = sanitizeCategoryName(schoolTypeName);
        const checkboxes = document.querySelectorAll(`input[name="classes_${safeCategoryName}"]:checked`);
        const selectedClasses = Array.from(checkboxes).map(cb => cb.value);
        if (selectedClasses.length > 0) {
            setupWizardState.selectedClasses[type] = selectedClasses;
        }
    });
}

function getSchoolTypeName(type) {
    const mapping = {
        'nursery': 'Nursery',
        'primary': 'Primary',
        'secondary_o': 'Secondary - O Level',
        'secondary_a': 'Secondary - A Level',
        'other': 'Other'
    };
    return mapping[type] || type;
}

// Helper function to create CSS-safe IDs from category names
function sanitizeCategoryName(categoryName) {
    return categoryName.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();
}

// Class management functions
function selectAllClasses(safeCategoryName) {
    const checkboxes = document.querySelectorAll(`input[name="classes_${safeCategoryName}"]`);
    checkboxes.forEach(cb => {
        cb.checked = true;
    });
    updateSelectedClasses();
}

function deselectAllClasses(safeCategoryName) {
    const checkboxes = document.querySelectorAll(`input[name="classes_${safeCategoryName}"]`);
    checkboxes.forEach(cb => {
        cb.checked = false;
    });
    updateSelectedClasses();
}

function addCustomClass(safeCategoryName) {
    const input = document.getElementById(`custom-class-${safeCategoryName}`);
    const className = input.value.trim();
    
    if (!className) {
        alert('Please enter a class name.');
        return;
    }
    
    // Check if class already exists
    const existingCheckboxes = document.querySelectorAll(`input[name="classes_${safeCategoryName}"]`);
    const existingClasses = Array.from(existingCheckboxes).map(cb => cb.value.toLowerCase());
    
    if (existingClasses.includes(className.toLowerCase())) {
        alert('This class already exists.');
        return;
    }
    
    // Add the new class to the grid
    const grid = document.getElementById(`classes-grid-${safeCategoryName}`);
    const label = document.createElement('label');
    label.className = 'flex items-center p-2 border border-gray-200 dark:border-gray-600 rounded cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 bg-green-50 dark:bg-green-900/20';
    label.innerHTML = `
        <input type="checkbox" name="classes_${safeCategoryName}" value="${className}" class="mr-2 text-maroon" checked>
        <span class="text-sm">${className}</span>
        <button type="button" onclick="removeCustomClass(this)" class="ml-auto text-red-500 hover:text-red-700 text-xs" title="Remove this custom class">
            <i class="fas fa-trash"></i>
        </button>
    `;
    
    grid.appendChild(label);
    
    // Add event listener to the new checkbox
    const checkbox = label.querySelector('input[type="checkbox"]');
    checkbox.addEventListener('change', function() {
        updateSelectedClasses();
    });
    
    // Clear input and update state
    input.value = '';
    updateSelectedClasses();
}

function removeDefaultClass(button) {
    button.closest('label').remove();
    updateSelectedClasses();
}

function removeCustomClass(button) {
    button.closest('label').remove();
    updateSelectedClasses();
}

// Stream assignment management functions
function selectAllStreamsForCategory(schoolType) {
    const checkboxes = document.querySelectorAll(`input[name^="stream_${schoolType}_"]`);
    checkboxes.forEach(cb => {
        cb.checked = true;
    });
}

function deselectAllStreamsForCategory(schoolType) {
    const checkboxes = document.querySelectorAll(`input[name^="stream_${schoolType}_"]`);
    checkboxes.forEach(cb => {
        cb.checked = false;
    });
}

function selectAllStreamsForClass(schoolType, className) {
    const checkboxes = document.querySelectorAll(`input[name="stream_${schoolType}_${className}"]`);
    checkboxes.forEach(cb => {
        cb.checked = true;
    });
}

function deselectAllStreamsForClass(schoolType, className) {
    const checkboxes = document.querySelectorAll(`input[name="stream_${schoolType}_${className}"]`);
    checkboxes.forEach(cb => {
        cb.checked = false;
    });
}

// Stream management functions
function addStreamInput() {
    const container = document.getElementById('streamInputs');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2';
    div.innerHTML = `
        <input type="text" placeholder="Stream name (e.g., A)" class="stream-input flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm">
        <button type="button" onclick="removeStreamInput(this)" class="text-red-500 hover:text-red-700">
            <i class="fas fa-times"></i>
        </button>
    `;
    container.appendChild(div);
}

function removeStreamInput(button) {
    const container = document.getElementById('streamInputs');
    if (container.children.length > 1) {
        button.parentElement.remove();
    }
}

function generateStreamAssignments() {
    const container = document.getElementById('streamAssignmentContainer');
    container.innerHTML = '';
    
    Object.keys(setupWizardState.selectedClasses).forEach(schoolType => {
        const classes = setupWizardState.selectedClasses[schoolType];
        const schoolTypeName = getSchoolTypeName(schoolType);
        
        const categoryDiv = document.createElement('div');
        categoryDiv.className = 'mb-6 p-4 border border-gray-200 dark:border-gray-600 rounded-lg';
        
        categoryDiv.innerHTML = `
            <div class="flex justify-between items-center mb-3">
                <h4 class="font-medium text-gray-900 dark:text-white">${schoolTypeName}</h4>
                <div class="flex gap-2">
                    <button type="button" onclick="selectAllStreamsForCategory('${schoolType}')" class="text-xs text-maroon hover:text-maroon-dark">
                        <i class="fas fa-check-square mr-1"></i>Select All Streams
                    </button>
                    <button type="button" onclick="deselectAllStreamsForCategory('${schoolType}')" class="text-xs text-gray-500 hover:text-gray-700">
                        <i class="fas fa-square mr-1"></i>Deselect All Streams
                    </button>
                </div>
            </div>
            <div class="space-y-3">
                ${classes.map(className => `
                    <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <div class="flex justify-between items-center mb-2">
                            <div class="font-medium text-sm">${className}</div>
                            <div class="flex gap-2">
                                <button type="button" onclick="selectAllStreamsForClass('${schoolType}', '${className}')" class="text-xs text-maroon hover:text-maroon-dark">
                                    <i class="fas fa-check-square mr-1"></i>All
                                </button>
                                <button type="button" onclick="deselectAllStreamsForClass('${schoolType}', '${className}')" class="text-xs text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-square mr-1"></i>None
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                            ${setupWizardState.streams.map(streamName => `
                                <label class="flex items-center text-sm p-2 border border-gray-200 dark:border-gray-600 rounded cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input type="checkbox" name="stream_${schoolType}_${className}" value="${streamName}" class="mr-2 text-maroon" checked>
                                    ${streamName}
                                </label>
                            `).join('')}
                        </div>
                    </div>
                `).join('')}
            </div>
        `;
        
        container.appendChild(categoryDiv);
    });
}

async function generatePreview() {
    const loadingEl = document.getElementById('previewLoading');
    const containerEl = document.getElementById('previewContainer');
    
    // Create cache key from current state
    const cacheKey = JSON.stringify({
        schoolTypes: setupWizardState.schoolTypes.sort(),
        selectedClasses: setupWizardState.selectedClasses,
        hasStreams: setupWizardState.hasStreams,
        streams: setupWizardState.streams.sort()
    });
    
    // Check if we have cached data
    if (setupWizardState.previewCache[cacheKey]) {
        renderPreview(setupWizardState.previewCache[cacheKey]);
        return;
    }
    
    // Show loading, hide container
    loadingEl.classList.remove('hidden');
    containerEl.style.display = 'none';
    
    try {
        const response = await fetch('{{ route("api.classes.setup-wizard.preview") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                school_types: setupWizardState.schoolTypes,
                selected_classes: setupWizardState.selectedClasses,
                has_streams: setupWizardState.hasStreams,
                streams: setupWizardState.streams
            })
        });
        
        const preview = await response.json();
        
        // Cache the result
        setupWizardState.previewCache[cacheKey] = preview;
        
        // Hide loading, show container
        loadingEl.classList.add('hidden');
        containerEl.style.display = 'block';
        
        renderPreview(preview);
    } catch (error) {
        console.error('Error generating preview:', error);
        
        // Hide loading, show error
        loadingEl.classList.add('hidden');
        containerEl.innerHTML = '<div class="text-center py-4 text-red-600">Error generating preview. Please try again.</div>';
        containerEl.style.display = 'block';
    }
}

function renderPreview(preview) {
    const container = document.getElementById('previewContainer');
    container.innerHTML = '';
    
    Object.keys(preview).forEach(categoryName => {
        const categoryDiv = document.createElement('div');
        categoryDiv.className = 'mb-4 p-3 border border-gray-200 dark:border-gray-600 rounded-lg';
        
        let classesHtml = '';
        Object.keys(preview[categoryName]).forEach(className => {
            const streams = preview[categoryName][className];
            if (streams.length > 0) {
                classesHtml += `<div class="mb-2"><strong>${className}:</strong> ${streams.join(', ')}</div>`;
            } else {
                classesHtml += `<div class="mb-2"><strong>${className}</strong></div>`;
            }
        });
        
        categoryDiv.innerHTML = `
            <h4 class="font-medium text-gray-900 dark:text-white mb-2">${categoryName}</h4>
            ${classesHtml}
        `;
        
        container.appendChild(categoryDiv);
    });
}

async function confirmSetup() {
    // Collect stream assignments if using streams
    if (setupWizardState.hasStreams) {
        setupWizardState.classStreamAssignments = {};
        
        Object.keys(setupWizardState.selectedClasses).forEach(schoolType => {
            setupWizardState.selectedClasses[schoolType].forEach(className => {
                const checkboxes = document.querySelectorAll(`input[name="stream_${schoolType}_${className}"]:checked`);
                const assignedStreams = Array.from(checkboxes).map(cb => cb.value);
                if (assignedStreams.length > 0) {
                    setupWizardState.classStreamAssignments[`${schoolType}_${className}`] = assignedStreams;
                }
            });
        });
    }
    
    try {
        const response = await fetch('{{ route("api.classes.setup-wizard.save") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                mode: setupWizardState.mode,
                school_types: setupWizardState.schoolTypes,
                selected_classes: setupWizardState.selectedClasses,
                has_streams: setupWizardState.hasStreams,
                streams: setupWizardState.streams,
                class_stream_assignments: setupWizardState.classStreamAssignments
            })
        });
        
        const result = await response.json();
        
        if (result.success) {
            setupWizardState.currentStep = 8;
            updateStepDisplay();
            
            // Show completion summary
            const summaryContainer = document.getElementById('completionSummary');
            summaryContainer.innerHTML = `
                <div class="text-sm space-y-2">
                    <div><strong>Class Levels Created:</strong> ${result.data.class_levels_created}</div>
                    <div><strong>Streams Created:</strong> ${result.data.streams_created}</div>
                    <div><strong>Class Combinations Created:</strong> ${result.data.class_streams_created}</div>
                    <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-600">
                        <div><strong>Total Class Levels:</strong> ${result.data.total_class_levels}</div>
                        <div><strong>Total Streams:</strong> ${result.data.total_streams}</div>
                        <div><strong>Total Classes:</strong> ${result.data.total_class_streams}</div>
                    </div>
                </div>
            `;
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error saving setup:', error);
        alert('Error saving setup. Please try again.');
    }
}

function finishSetup() {
    closeSetupModal();
    // Reload the page to show updated data
    window.location.reload();
}

async function loadExistingStructure() {
    try {
        const response = await fetch('{{ route("api.classes.setup-wizard.existing-structure") }}');
        const structure = await response.json();
        
        // Pre-populate form with existing data
        setupWizardState.schoolTypes = structure.school_types || [];
        setupWizardState.selectedClasses = structure.selected_classes || {};
        setupWizardState.streams = structure.streams || [];
        setupWizardState.classStreamAssignments = structure.class_stream_assignments || {};
        setupWizardState.hasStreams = setupWizardState.streams.length > 0;
        
    } catch (error) {
        console.error('Error loading existing structure:', error);
    }
}

// Event listeners
document.getElementById('nextBtn').addEventListener('click', nextStep);
document.getElementById('prevBtn').addEventListener('click', prevStep);
document.getElementById('confirmBtn').addEventListener('click', confirmSetup);
document.getElementById('finishBtn').addEventListener('click', finishSetup);
document.getElementById('skipBtn').addEventListener('click', closeSetupModal);
</script>
@endsection