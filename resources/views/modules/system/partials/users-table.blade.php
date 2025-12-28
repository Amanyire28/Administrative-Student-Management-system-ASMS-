@if($users->count() > 0)
<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Staff ID</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Roles</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                    <!-- User Column -->
                    <td class="px-4 py-3 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-8 w-8">
                                <div class="h-8 w-8 rounded-full bg-maroon bg-opacity-20 dark:bg-opacity-30 flex items-center justify-center text-sm">
                                    <span class="text-maroon dark:text-maroon-light font-semibold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <div class="font-medium text-gray-900 dark:text-gray-100 truncate max-w-[150px]">
                                    {{ $user->name }}
                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- Email Column -->
                    <td class="px-4 py-3 whitespace-nowrap text-gray-500 dark:text-gray-400 truncate max-w-[180px]">
                        {{ $user->email }}
                    </td>

                    <!-- Staff ID Column -->
                    <td class="px-4 py-3 whitespace-nowrap text-gray-500 dark:text-gray-400">
                        {{ $user->staff_id }}
                    </td>

                    <!-- Roles Column -->
                    <td class="px-4 py-3">
                        <div class="flex flex-wrap gap-1">
                            @foreach($user->roles as $role)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-maroon bg-opacity-10 dark:bg-opacity-20 text-maroon dark:text-maroon-light border border-maroon border-opacity-20">
                                    {{ substr($role->name, 0, 12) }}{{ strlen($role->name) > 12 ? '...' : '' }}
                                </span>
                            @endforeach
                        </div>
                    </td>

                    <!-- Status Column -->
                    <td class="px-4 py-3 whitespace-nowrap">
                        <div class="flex items-center justify-center">
                            @if($user->is_active)
                                <span class="relative flex h-3 w-3" title="Active">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                </span>
                            @else
                                <span class="relative flex h-3 w-3" title="Inactive">
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                                </span>
                            @endif
                        </div>
                    </td>

                    <!-- Actions Column -->
                    <td class="px-4 py-3 whitespace-nowrap">
                        <button onclick="window.navigateTo('/admin/system/users/{{ $user->id }}/permissions')"
                                class="inline-flex items-center p-1.5 border border-maroon text-maroon dark:text-maroon-light rounded text-xs font-medium hover:bg-maroon hover:text-white dark:hover:text-white transition-colors duration-200 cursor-pointer"
                                title="Edit Permissions">
                            <i class="fas fa-key"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Compact Pagination -->
    @if($users->hasPages())
    <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
        <div class="flex items-center justify-between">
            <div class="text-xs text-gray-600 dark:text-gray-400">
                Page {{ $users->currentPage() }} of {{ $users->lastPage() }}
            </div>
            <div class="flex space-x-1">
                <!-- Previous -->
                @if(!$users->onFirstPage())
                    <a href="{{ $users->previousPageUrl() }}"
                       class="px-2 py-1 rounded bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-500 text-xs">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                @endif

                <!-- Page Numbers -->
                @foreach($users->getUrlRange(max($users->currentPage() - 1, 1), min($users->currentPage() + 1, $users->lastPage())) as $page => $url)
                    @if($page == $users->currentPage())
                        <span class="px-2 py-1 rounded bg-maroon text-white text-xs">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="px-2 py-1 rounded bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-500 text-xs">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                <!-- Next -->
                @if($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}"
                       class="px-2 py-1 rounded bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-500 text-xs">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>
@else
<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
    <div class="px-6 py-8 text-center">
        <div class="text-gray-500 dark:text-gray-400">
            <i class="fas fa-users text-3xl mb-3"></i>
            <p class="text-sm">No users found</p>
            @if(request('search'))
                <p class="text-xs mt-1">Try adjusting your search criteria</p>
            @endif
        </div>
    </div>
</div>
@endif
