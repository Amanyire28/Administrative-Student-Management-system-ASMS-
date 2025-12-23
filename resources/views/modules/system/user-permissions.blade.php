@extends('layouts.app')

@section('title', 'Edit User Permissions')

@section('content')
<div class="py-4 sm:py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Edit User Permissions</h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $user->name }} ({{ $user->email }})</p>
            </div>
            <a href="{{ route('system.users') }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>

        <form action="{{ route('system.update-user-permissions', $user) }}" method="POST">
            @csrf
            @method('POST')

            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">User Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
                            <p class="text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <p class="text-gray-900 dark:text-gray-100">{{ $user->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Staff ID</label>
                            <p class="text-gray-900 dark:text-gray-100">{{ $user->staff_id }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Assign Roles</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                        @foreach($roles as $role)
                        <div class="flex items-center">
                            <input type="checkbox"
                                   id="role_{{ $role->id }}"
                                   name="roles[]"
                                   value="{{ $role->id }}"
                                   {{ in_array($role->id, $userRoles) ? 'checked' : '' }}
                                   class="h-4 w-4 text-maroon border-gray-300 rounded focus:ring-maroon focus:ring-offset-0">
                            <label for="role_{{ $role->id }}"
                                   class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                {{ ucfirst($role->name) }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Direct Permissions</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                        Note: Direct permissions override role permissions. Use with caution.
                    </p>

                    @foreach($permissions as $module => $modulePermissions)
                    <div class="mb-8 last:mb-0">
                        <h4 class="text-md font-medium text-gray-900 dark:text-gray-100 mb-3 capitalize">{{ str_replace('-', ' ', $module) }}</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                            @foreach($modulePermissions as $permission)
                            <div class="flex items-center">
                                <input type="checkbox"
                                       id="permission_{{ $permission->id }}"
                                       name="permissions[]"
                                       value="{{ $permission->id }}"
                                       {{ in_array($permission->id, $userPermissions) ? 'checked' : '' }}
                                       class="h-4 w-4 text-maroon border-gray-300 rounded focus:ring-maroon focus:ring-offset-0">
                                <label for="permission_{{ $permission->id }}"
                                       class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                    {{ ucwords(str_replace('.', ' ', str_replace($module . '.', '', $permission->name))) }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('system.users') }}"
                           class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Cancel
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-maroon border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-maroon-dark active:bg-maroon-dark focus:outline-none focus:ring-2 focus:ring-maroon focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            <i class="fas fa-save mr-2"></i>
                            Save Permissions
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add some interactivity
    const roleCheckboxes = document.querySelectorAll('input[name="roles[]"]');
    const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');

    // Example: Log when permissions are changed
    permissionCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            console.log('Permission changed:', this.value, this.checked);
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('permissionsForm');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const roles = formData.getAll('roles[]');
        const permissions = formData.getAll('permissions[]');

        console.log('Roles being sent:', roles);
        console.log('Permissions being sent:', permissions);

        // Continue with your AJAX submission...
    });
});
</script>

