@extends('layouts.app')

@section('title', 'Class Setup')
@section('page-title', 'Set Up Your School\'s Class Structure')
@section('page-description', 'Quick setup to create all the classes, streams, and combinations your school needs')

@section('content')
<!-- Empty State - Setup Required -->
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
    <div class="p-8 text-center">
        <!-- Icon -->
        <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-maroon/10 mb-6">
            <i class="fas fa-chalkboard text-4xl text-maroon"></i>
        </div>
        
        <!-- Title -->
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
            Set Up Your School's Class Structure
        </h3>
        
        <!-- Description -->
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 max-w-2xl mx-auto">
            Welcome! Before you can manage students and classes, we need to set up your school's class structure. 
            This quick setup will create all the classes, streams, and combinations your school needs.
        </p>
        
        <!-- Features List -->
        <div class="grid md:grid-cols-2 gap-6 mb-8 max-w-3xl mx-auto">
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                <div class="flex items-center mb-3">
                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900/20 mr-3">
                        <i class="fas fa-layer-group text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Class Levels</h4>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Set up your school's class levels like P1, P2, S1, S2, Nursery classes, etc.
                </p>
            </div>
            
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                <div class="flex items-center mb-3">
                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-green-100 dark:bg-green-900/20 mr-3">
                        <i class="fas fa-stream text-green-600 dark:text-green-400"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Streams</h4>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Add streams like A, B, C or Red, Blue, Green to divide classes into sections.
                </p>
            </div>
            
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                <div class="flex items-center mb-3">
                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-purple-100 dark:bg-purple-900/20 mr-3">
                        <i class="fas fa-tags text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white">School Types</h4>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Organize classes into school types like Nursery, Primary, Secondary for better management.
                </p>
            </div>
            
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                <div class="flex items-center mb-3">
                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-orange-100 dark:bg-orange-900/20 mr-3">
                        <i class="fas fa-chalkboard text-orange-600 dark:text-orange-400"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Class Combinations</h4>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Automatically generate class combinations like P1A, P2B, S1Red for student assignment.
                </p>
            </div>
        </div>
        
        <!-- Setup Button -->
        <div class="space-y-4">
            <a href="{{ route('classes.setup-wizard') }}" 
               class="inline-flex items-center px-8 py-4 bg-maroon border border-transparent rounded-lg font-semibold text-lg text-white uppercase tracking-widest hover:bg-maroon-dark focus:bg-maroon-dark active:bg-maroon-dark focus:outline-none focus:ring-2 focus:ring-maroon focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <i class="fas fa-magic mr-3"></i>
                Start Class Setup Wizard
            </a>
            
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Takes about 2-3 minutes to complete
            </p>
        </div>
        
        <!-- Alternative Options -->
        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-600">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Need help or want to set up manually?
            </p>
            <div class="flex justify-center space-x-4">
                <a href="#" class="text-sm text-maroon hover:text-maroon-dark transition-colors">
                    <i class="fas fa-question-circle mr-1"></i>
                    Setup Guide
                </a>
                <span class="text-gray-300 dark:text-gray-600">|</span>
                <a href="{{ route('classes.create') }}" class="text-sm text-maroon hover:text-maroon-dark transition-colors">
                    <i class="fas fa-cog mr-1"></i>
                    Manual Setup
                </a>
            </div>
        </div>
    </div>
</div>
@endsection