<div id="permissionDeniedModal"
     class="fixed inset-0 z-[9999] flex items-center justify-center px-4 py-6 pointer-events-none hidden">
    <div class="fixed inset-0 bg-black/50 pointer-events-auto" onclick="hidePermissionDeniedModal()"></div>

    <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full pointer-events-auto transform transition-all scale-95 opacity-0"
         id="permissionModalContent">
        <!-- Modal Header -->
        <div class="flex items-start justify-between p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-red-100 dark:bg-red-900">
                    <svg class="h-6 w-6 text-red-600 dark:text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Access Denied
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Permission Required
                    </p>
                </div>
            </div>
            <button type="button"
                    onclick="hidePermissionDeniedModal()"
                    class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <div id="permissionDeniedMessage" class="text-gray-700 dark:text-gray-300">
                <!-- Message will be inserted here by JavaScript -->
            </div>

            <!-- Permission Info -->
            <div class="mt-4 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                <p class="text-sm font-medium text-yellow-800 dark:text-yellow-200 mb-2">
                    Required Permission:
                </p>
                <code id="requiredPermission" class="text-sm bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200 px-3 py-1 rounded">
                    <!-- Permission will be inserted here -->
                </code>
            </div>

            <!-- User's Current Permissions -->
            <div id="userPermissionsSection" class="mt-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg hidden">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Your Permissions:
                </p>
                <div id="userPermissionsList" class="flex flex-wrap gap-2">
                    <!-- Permissions will be inserted here -->
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="flex items-center justify-end px-6 py-4 bg-gray-50 dark:bg-gray-800/50 rounded-b-lg space-x-3">
            <button type="button"
                    onclick="hidePermissionDeniedModal()"
                    class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md transition-colors">
                Close
            </button>
            @if(auth()->check() && auth()->user()->can('system.users'))
            <button type="button"
                    onclick="requestPermissionAccess()"
                    class="px-4 py-2 text-sm font-medium text-white bg-maroon hover:bg-maroon-dark rounded-md transition-colors">
                Request Access
            </button>
            @endif
        </div>
    </div>
</div>

<style>
    #permissionDeniedModal.show {
        display: flex !important;
    }

    #permissionDeniedModal.show #permissionModalContent {
        transform: scale(1);
        opacity: 1;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }

    .shake {
        animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
    }
</style>

<script>
    // Store user permissions globally
    window.userPermissions = @json(auth()->check() ? auth()->user()->getAllPermissions()->pluck('name') : []);
    window.userRole = @json(auth()->check() ? auth()->user()->roles->first()?->name : 'No Role');

    function showPermissionDeniedModal(requiredPermission, customMessage = null) {
        const modal = document.getElementById('permissionDeniedModal');
        const content = document.getElementById('permissionModalContent');

        // Set message
        const message = customMessage || 'You do not have permission to access this feature.';
        document.getElementById('permissionDeniedMessage').innerHTML = `
            <p class="text-base">${message}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                Your role: <span class="font-medium text-maroon dark:text-maroon-light">${window.userRole}</span>
            </p>
        `;

        // Set required permission
        document.getElementById('requiredPermission').textContent = requiredPermission;

        // Show user's permissions if available
        if (window.userPermissions.length > 0) {
            const permissionsList = document.getElementById('userPermissionsList');
            permissionsList.innerHTML = window.userPermissions.map(perm =>
                `<span class="text-xs bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-2 py-1 rounded">${perm}</span>`
            ).join('');
            document.getElementById('userPermissionsSection').classList.remove('hidden');
        }

        // Show modal with animation
        modal.classList.add('show');
        setTimeout(() => {
            content.classList.add('shake');
        }, 100);

        // Prevent background scrolling
        document.body.style.overflow = 'hidden';
    }

    function hidePermissionDeniedModal() {
        const modal = document.getElementById('permissionDeniedModal');
        const content = document.getElementById('permissionModalContent');

        modal.classList.remove('show');
        content.classList.remove('shake');

        // Restore scrolling
        document.body.style.overflow = '';
    }

    function requestPermissionAccess() {
        const requiredPermission = document.getElementById('requiredPermission').textContent;

        // You can implement a request system here
        fetch('/api/permission-request', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                permission: requiredPermission,
                user_id: {{ auth()->id() }},
                reason: 'Requested from permission denial modal'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success notification
                showToast('Permission request sent to administrator.', 'success');
                hidePermissionDeniedModal();
            }
        })
        .catch(error => {
            showToast('Failed to send request. Please try again.', 'error');
        });
    }

    function showToast(message, type = 'info') {
        // Implement your toast notification here
        console.log(`${type}: ${message}`);
    }

    // Close modal on ESC key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            hidePermissionDeniedModal();
        }
    });

    // Close modal when clicking outside
    document.getElementById('permissionDeniedModal').addEventListener('click', (e) => {
        if (e.target.id === 'permissionDeniedModal') {
            hidePermissionDeniedModal();
        }
    });
</script>
