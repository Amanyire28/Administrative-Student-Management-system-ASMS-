@extends('layouts.app')

@section('title', 'Class Setup Wizard')
@section('page-title', 'Class Setup Wizard')
@section('page-description', 'Set up your school\'s complete class structure')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-8">
        <div class="text-center mb-8">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-maroon/10 mb-4">
                <i class="fas fa-school text-2xl text-maroon"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Class Setup Wizard</h2>
            <p class="text-gray-600 dark:text-gray-400">This wizard will help you set up your school's complete class structure automatically.</p>
        </div>

        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-6 mb-8">
            <div class="flex">
                <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                <div>
                    <h4 class="text-sm font-medium text-blue-800 dark:text-blue-200 mb-2">What this wizard will create:</h4>
                    <ul class="text-sm text-blue-700 dark:text-blue-300 list-disc list-inside space-y-1">
                        <li>School types (Nursery, Primary, Secondary)</li>
                        <li>Class levels (P1, P2, S1, S2, etc.)</li>
                        <li>Streams (A, B, C, etc.) - optional</li>
                        <li>Class combinations (P1A, P2B, etc.)</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="text-center">
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                The setup wizard functionality will be implemented with the controller updates. 
                For now, you can create classes manually.
            </p>
            
            <div class="flex justify-center space-x-4">
                <a href="{{ route('classes.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-maroon border border-transparent rounded-lg font-semibold text-white hover:bg-maroon-dark transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Create Class Manually
                </a>
                
                <a href="{{ route('classes.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gray-600 border border-transparent rounded-lg font-semibold text-white hover:bg-gray-700 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Classes
                </a>
            </div>
        </div>
    </div>
</div>
@endsection