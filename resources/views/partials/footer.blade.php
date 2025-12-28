@if(request()->is('mobile*') || request()->header('X-Mobile'))
    <!-- Mobile Footer -->

<footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 py-2">
    <div class="px-4">
        <div class="text-center mb-3">
            <p class="text-gray-600 dark:text-gray-300 text-sm">
                &copy; {{ date('Y') }} {{ config('app.name', 'ASMS') }}. All rights reserved.
            </p>
            <p class="text-gray-500 dark:text-gray-400 text-xs mt-1">
                Academic School Management System v1.0.0
            </p>
        </div>

        <div class="flex justify-center items-center space-x-4 mb-3">
            <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 text-xs transition-colors">
                Privacy
            </a>
            <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 text-xs transition-colors">
                Terms
            </a>
            <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 text-xs transition-colors">
                Help
            </a>
        </div>

        <div class="text-center text-gray-500 dark:text-gray-400 text-xs">
            <p>
                Last updated: {{ date('F d, Y') }} |
                Status: <span class="text-green-600 dark:text-green-400">●</span> Operational
            </p>
        </div>
    </div>
</footer>

@else
<footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 py-3">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <p class="text-gray-600 text-sm">
                    &copy; {{ date('Y') }} {{ config('app.name', 'ASMS') }}. All rights reserved.
                </p>
                <p class="text-gray-500 text-xs mt-1">
                    Academic School Management System v1.0.0
                </p>
            </div>

            <div class="flex items-center space-x-6">
                <a href="#" class="text-gray-500 hover:text-maroon text-sm transition-colors">
                    Privacy Policy
                </a>
                <a href="#" class="text-gray-500 hover:text-maroon text-sm transition-colors">
                    Terms of Service
                </a>
                <a href="#" class="text-gray-500 hover:text-maroon text-sm transition-colors">
                    Help Center
                </a>
            </div>
        </div>


    </div>
</footer>
@endif


