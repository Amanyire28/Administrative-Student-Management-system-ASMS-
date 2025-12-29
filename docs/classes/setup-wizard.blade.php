@extends('layouts.app')

@section('title', 'Class Setup Wizard')
@section('page-title', 'Class Setup Wizard')
@section('page-description', 'Set up your school\'s complete class structure')

@section('content')
<div class="max-w-4xl mx-auto">
            <!-- Wizard Modal -->
            <div id="classSetupModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white dark:bg-gray-800">
                    
                    <!-- Progress Bar -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Step <span id="currentStep">1</span> of 7</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400" id="stepTitle">Setup Class Structure</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 dark:bg-gray-700">
                            <div id="progressBar" class="bg-maroon h-2 rounded-full transition-all duration-300" style="width: 14.3%"></div>
                        </div>
                    </div>

                    <!-- Step 1: Introduction -->
                    <div id="step1" class="step-content">
                        <div class="text-center mb-6">
                            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-maroon/10 mb-4">
                                <i class="fas fa-school text-2xl text-maroon"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Set up your school class structure</h3>
                            <p class="text-gray-600 dark:text-gray-400">This will help us generate classes and streams for your school automatically.</p>
                        </div>
                        
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
                            <div class="flex">
                                <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="text-sm font-medium text-blue-800 dark:text-blue-200">What we'll create:</h4>
                                    <ul class="text-sm text-blue-700 dark:text-blue-300 mt-1 list-disc list-inside">
                                        <li>Class categories (Nursery, Primary, Secondary)</li>
                                        <li>Class levels (P1, P2, S1, S2, etc.)</li>
                                        <li>Streams (A, B, C, etc.) - optional</li>
                                        <li>Class combinations (P1A, P2B, etc.)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: School Type Selection -->
                    <div id="step2" class="step-content hidden">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Choose Type of School</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Select all that apply to your school:</p>
                        
                        <div class="space-y-3">
                            <label class="flex items-center p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <input type="checkbox" name="school_types" value="nursery" class="h-4 w-4 text-maroon focus:ring-maroon border-gray-300 rounded">
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">Nursery</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Baby, Middle, Top classes</div>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <input type="checkbox" name="school_types" value="primary" class="h-4 w-4 text-maroon focus:ring-maroon border-gray-300 rounded">
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">Primary</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">P1, P2, P3, P4, P5, P6, P7</div>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <input type="checkbox" name="school_types" value="secondary_o" class="h-4 w-4 text-maroon focus:ring-maroon border-gray-300 rounded">
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">Secondary – O Level</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">S1, S2, S3, S4</div>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <input type="checkbox" name="school_types" value="secondary_a" class="h-4 w-4 text-maroon focus:ring-maroon border-gray-300 rounded">
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">Secondary – A Level</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">S5, S6</div>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <input type="checkbox" name="school_types" value="other" class="h-4 w-4 text-maroon focus:ring-maroon border-gray-300 rounded">
                                <div class="ml-3 flex-1">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">Other</div>
                                    <input type="text" name="other_type" placeholder="Specify other type..." 
                                           class="mt-2 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-maroon focus:border-maroon bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm" 
                                           disabled>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Step 3: Class Selection -->
                    <div id="step3" class="step-content hidden">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Select Classes</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Choose which classes your school offers:</p>
                        
                        <div id="classSelectionContainer">
                            <!-- Dynamic content will be loaded here -->
                        </div>
                    </div>

                    <!-- Step 4: Streams Question -->
                    <div id="step4" class="step-content hidden">
                        <div class="text-center mb-6">
                            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-orange-100 dark:bg-orange-900/20 mb-4">
                                <i class="fas fa-stream text-2xl text-orange-600 dark:text-orange-400"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Do You Have Streams?</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">Do your classes have streams (like A, B, C sections)?</p>
                        </div>
                        
                        <div class="space-y-4">
                            <label class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-all">
                                <input type="radio" name="has_streams" value="yes" class="h-4 w-4 text-maroon focus:ring-maroon border-gray-300">
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">Yes, we have streams</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Classes are divided into sections (e.g., P1A, P1B, S2A, S2B)</div>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-all">
                                <input type="radio" name="has_streams" value="no" class="h-4 w-4 text-maroon focus:ring-maroon border-gray-300">
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">No streams</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Each class level is a single unit (e.g., P1, P2, S1, S2)</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Step 5: Stream Entry -->
                    <div id="step5" class="step-content hidden">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Enter Streams</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Add the streams your school uses:</p>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Stream Names (comma separated)
                            </label>
                            <input type="text" id="streamsInput" placeholder="A, B, C or Red, Blue, Green..." 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-maroon focus:border-maroon bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Separate multiple streams with commas</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Or add streams individually:</p>
                            <div class="flex gap-2 mb-2">
                                <input type="text" id="singleStreamInput" placeholder="Stream name..." 
                                       class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-maroon focus:border-maroon bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                <button type="button" id="addStreamBtn" 
                                        class="px-4 py-2 bg-maroon text-white rounded-md hover:bg-maroon-dark transition-colors">
                                    <i class="fas fa-plus mr-1"></i> Add
                                </button>
                            </div>
                        </div>
                        
                        <div id="streamsList" class="space-y-2">
                            <!-- Dynamic stream list will appear here -->
                        </div>
                    </div>

                    <!-- Step 6: Preview -->
                    <div id="step6" class="step-content hidden">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Review Your Class Structure</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Please review the class structure that will be created:</p>
                        
                        <div id="previewContainer" class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 max-h-96 overflow-y-auto">
                            <!-- Preview content will be generated here -->
                        </div>
                        
                        <div class="mt-4 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg">
                            <div class="flex">
                                <i class="fas fa-exclamation-triangle text-yellow-500 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Note:</h4>
                                    <p class="text-sm text-yellow-700 dark:text-yellow-300">You can uncheck any classes or modify streams before confirming.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 7: Success -->
                    <div id="step7" class="step-content hidden">
                        <div class="text-center">
                            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 dark:bg-green-900/20 mb-4">
                                <i class="fas fa-check text-2xl text-green-600 dark:text-green-400"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Class Structure Created Successfully!</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">Your school's class structure has been set up and is ready to use.</p>
                            
                            <div id="successSummary" class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 mb-6">
                                <!-- Success summary will be populated here -->
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-8 pt-6 border-t border-gray-200 dark:border-gray-600">
                        <button type="button" id="prevBtn" 
                                class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors hidden">
                            <i class="fas fa-arrow-left mr-2"></i> Previous
                        </button>
                        
                        <div class="flex gap-3">
                            <button type="button" id="skipBtn" 
                                    class="px-6 py-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
                                Skip Setup
                            </button>
                            
                            <button type="button" id="nextBtn" 
                                    class="px-6 py-2 bg-maroon text-white rounded-md hover:bg-maroon-dark transition-colors">
                                Next <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                            
                            <button type="button" id="confirmBtn" 
                                    class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors hidden">
                                <i class="fas fa-check mr-2"></i> Confirm & Save
                            </button>
                            
                            <button type="button" id="finishBtn" 
                                    class="px-6 py-2 bg-maroon text-white rounded-md hover:bg-maroon-dark transition-colors hidden">
                                <i class="fas fa-home mr-2"></i> Go to Dashboard
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Wizard state management
        let currentStep = 1;
        const totalSteps = 7;
        let wizardData = {
            schoolTypes: [],
            selectedClasses: {},
            hasStreams: false,
            streams: []
        };

        // Initialize wizard
        document.addEventListener('DOMContentLoaded', function() {
            initializeWizard();
        });

        function initializeWizard() {
            updateStepDisplay();
            bindEventListeners();
        }

        function bindEventListeners() {
            // Navigation buttons
            document.getElementById('nextBtn').addEventListener('click', nextStep);
            document.getElementById('prevBtn').addEventListener('click', prevStep);
            document.getElementById('confirmBtn').addEventListener('click', confirmSetup);
            document.getElementById('finishBtn').addEventListener('click', () => window.location.href = '{{ route("classes.index") }}');
            document.getElementById('skipBtn').addEventListener('click', () => window.location.href = '{{ route("classes.index") }}');

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
        }

        function updateStepDisplay() {
            // Hide all steps
            document.querySelectorAll('.step-content').forEach(step => step.classList.add('hidden'));
            
            // Show current step
            document.getElementById(`step${currentStep}`).classList.remove('hidden');
            
            // Update progress
            document.getElementById('currentStep').textContent = currentStep;
            document.getElementById('progressBar').style.width = `${(currentStep / totalSteps) * 100}%`;
            
            // Update step title
            const titles = [
                '', 'Setup Class Structure', 'Choose School Type', 'Select Classes', 
                'Streams Question', 'Enter Streams', 'Review Structure', 'Setup Complete'
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
            if (currentStep === 6) {
                nextBtn.classList.add('hidden');
                confirmBtn.classList.remove('hidden');
                finishBtn.classList.add('hidden');
            } else if (currentStep === 7) {
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
                        currentStep = 6; // Skip stream entry if no streams
                    } else if (currentStep === 6) {
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
        }

        function createClassSection(type, options) {
            const section = document.createElement('div');
            section.className = 'mb-6 p-4 border border-gray-200 dark:border-gray-600 rounded-lg';
            
            section.innerHTML = `
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">${options.title}</h4>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    ${options.classes.map(className => `
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                            <input type="checkbox" name="classes_${type}" value="${className}" 
                                   class="h-4 w-4 text-maroon focus:ring-maroon border-gray-300 rounded"
                                   onchange="handleClassSelection('${type}', '${className}', this.checked)">
                            <span class="ml-2 text-sm font-medium text-gray-900 dark:text-white">${className}</span>
                        </label>
                    `).join('')}
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
                streamItem.className = 'flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg';
                streamItem.innerHTML = `
                    <span class="text-sm font-medium text-gray-900 dark:text-white">${stream}</span>
                    <button type="button" onclick="removeStream(${index})" 
                            class="text-red-500 hover:text-red-700 transition-colors">
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
                    categorySection.className = 'mb-6';
                    
                    let categoryHTML = `
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                            ${categoryNames[categoryType]}
                        </h4>
                        <div class="space-y-2">
                    `;
                    
                    classes.forEach(className => {
                        if (wizardData.hasStreams && wizardData.streams.length > 0) {
                            const streamsList = wizardData.streams.join(', ');
                            categoryHTML += `
                                <div class="flex items-center justify-between p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg">
                                    <div>
                                        <span class="font-medium text-gray-900 dark:text-white">${className}</span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">(${streamsList})</span>
                                    </div>
                                    <input type="checkbox" checked class="h-4 w-4 text-maroon focus:ring-maroon border-gray-300 rounded">
                                </div>
                            `;
                        } else {
                            categoryHTML += `
                                <div class="flex items-center justify-between p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg">
                                    <span class="font-medium text-gray-900 dark:text-white">${className}</span>
                                    <input type="checkbox" checked class="h-4 w-4 text-maroon focus:ring-maroon border-gray-300 rounded">
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
                school_types: wizardData.schoolTypes,
                selected_classes: wizardData.selectedClasses,
                has_streams: wizardData.hasStreams,
                streams: wizardData.streams,
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
                    currentStep = 7;
                    updateStepDisplay();
                    
                    // Show success summary
                    const summary = document.getElementById('successSummary');
                    summary.innerHTML = `
                        <div class="text-left">
                            <h4 class="font-semibold text-green-800 dark:text-green-200 mb-2">Successfully Created:</h4>
                            <ul class="text-sm text-green-700 dark:text-green-300 space-y-1">
                                <li><i class="fas fa-check mr-2"></i> ${data.data.categories_created} class categories</li>
                                <li><i class="fas fa-check mr-2"></i> ${data.data.class_levels_created} class levels</li>
                                ${data.data.streams_created > 0 ? `<li><i class="fas fa-check mr-2"></i> ${data.data.streams_created} streams</li>` : ''}
                                <li><i class="fas fa-check mr-2"></i> ${data.data.class_streams_created} class combinations</li>
                            </ul>
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
    @endpush
@endsection