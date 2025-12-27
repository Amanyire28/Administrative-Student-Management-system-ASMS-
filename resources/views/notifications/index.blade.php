@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between mb-6">
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl font-bold leading-7 text-gray-900 dark:text-gray-100 sm:text-3xl">
                    <i class="fas fa-bell mr-2 text-yellow-500"></i>
                    Notifications
                </h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Manage your notifications and preferences
                </p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                @if($unreadCount > 0)
                <form action="{{ route('notifications.markAllAsRead') }}" method="POST" class="inline">
                    @csrf
                    @method('POST')
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        <i class="fas fa-check-double mr-2"></i>
                        Mark All as Read
                    </button>
                </form>
                @endif

                @if($notifications->count() > 0)
                <form action="{{ route('notifications.clearAll') }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to clear all notifications?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        <i class="fas fa-trash-alt mr-2"></i>
                        Clear All
                    </button>
                </form>
                @endif
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-blue-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-bell text-blue-500 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Notifications</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $notifications->total() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-yellow-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-bell-slash text-yellow-500 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Unread</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $unreadCount }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Read</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $notifications->total() - $unreadCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Notifications List -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                    @if($notifications->count() > 0)
                        @foreach($groupedNotifications as $date => $dayNotifications)
                        <div class="border-b border-gray-200 dark:border-gray-700">
                            <div class="px-6 py-3 bg-gray-50 dark:bg-gray-900">
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    {{ \Carbon\Carbon::parse($date)->format('F d, Y') }}
                                </h3>
                            </div>

                            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($dayNotifications as $notification)
                                <div class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors duration-150 {{ is_null($notification->read_at) ? 'bg-blue-50 dark:bg-blue-900/10' : '' }}"
                                     id="notification-{{ $notification->id }}">
                                    <div class="flex items-start">
                                        <!-- Icon -->
                                        <div class="flex-shrink-0 pt-1">
                                            @php
                                                $icon = 'fas fa-bell';
                                                $color = 'text-gray-600 bg-gray-100 dark:bg-gray-700';

                                                if(isset($notification->data['icon'])) {
                                                    $icon = $notification->data['icon'];
                                                }
                                                if(isset($notification->data['type'])) {
                                                    $types = [
                                                        'student_registered' => 'text-blue-600 bg-blue-100 dark:bg-blue-900/30',
                                                        'teacher_assigned' => 'text-green-600 bg-green-100 dark:bg-green-900/30',
                                                        'mark_entered' => 'text-yellow-600 bg-yellow-100 dark:bg-yellow-900/30',
                                                        'system_alert' => 'text-red-600 bg-red-100 dark:bg-red-900/30',
                                                    ];
                                                    $color = $types[$notification->data['type']] ?? $color;
                                                }
                                            @endphp
                                            <div class="w-10 h-10 rounded-lg flex items-center justify-center {{ $color }}">
                                                <i class="{{ $icon }}"></i>
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="ml-4 flex-1">
                                            <p class="text-sm text-gray-900 dark:text-gray-100">
                                                {{ $notification->data['message'] ?? 'Notification' }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>

                                            @if(isset($notification->data['action_url']))
                                            <div class="mt-2">
                                                <a href="{{ $notification->data['action_url'] }}"
                                                   class="inline-flex items-center text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                                    <i class="fas fa-external-link-alt mr-1 text-xs"></i>
                                                    View Details
                                                </a>
                                            </div>
                                            @endif
                                        </div>

                                        <!-- Actions -->
                                        <div class="flex flex-col items-center space-y-2 ml-4">
                                            @if(is_null($notification->read_at))
                                            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <button type="submit"
                                                        class="p-1 text-gray-400 hover:text-green-600 dark:hover:text-green-400"
                                                        title="Mark as read">
                                                    <i class="fas fa-check-circle"></i>
                                                </button>
                                            </form>
                                            @endif

                                            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="p-1 text-gray-400 hover:text-red-600 dark:hover:text-red-400"
                                                        title="Delete notification"
                                                        onclick="return confirm('Delete this notification?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach

                        <!-- Pagination -->
                        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                            {{ $notifications->links() }}
                        </div>
                    @else
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <div class="inline-block p-6 bg-gray-100 dark:bg-gray-900 rounded-full mb-4">
                            <i class="fas fa-bell-slash text-gray-300 dark:text-gray-600 text-5xl"></i>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 text-lg">No notifications yet</p>
                        <p class="text-gray-400 dark:text-gray-500 text-sm mt-2">You're all caught up!</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Preferences Panel -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                        <i class="fas fa-cog mr-2 text-gray-500"></i>
                        Notification Preferences
                    </h3>

                    <form action="{{ route('notifications.preferences.update') }}" method="POST">
                        @csrf

                        <div class="space-y-6">
                            @foreach(['in_app' => 'In-App Notifications'] as $type => $typeLabel)
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-3">
                                    {{ $typeLabel }}
                                </h4>

                                <div class="space-y-3">
                                    @foreach([
                                        'system' => 'System Updates',
                                        'academic' => 'Academic Updates',
                                        'security' => 'Security Alerts',
                                        'announcements' => 'Announcements'
                                    ] as $category => $categoryLabel)
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                {{ $categoryLabel }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                Receive {{ $category }} notifications
                                            </p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="hidden" name="preferences[{{ $type }}][{{ $category }}]" value="0">
                                            <input type="checkbox"
                                                   name="preferences[{{ $type }}][{{ $category }}]"
                                                   value="1"
                                                   class="sr-only peer"
                                                   @if($preferences->where('type', $type)->where('category', $category)->first()?->enabled ?? true) checked @endif>
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <button type="submit"
                                    class="w-full px-4 py-2 bg-gradient-to-r from-maroon to-maroon-dark text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-300">
                                <i class="fas fa-save mr-2"></i>
                                Save Preferences
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-refresh notifications every 30 seconds
    setInterval(function() {
        fetch('{{ route("notifications.unreadCount") }}')
            .then(response => response.json())
            .then(data => {
                // Update badge count in navbar if needed
                const badge = document.querySelector('.notification-badge');
                if (badge) {
                    if (data.count > 0) {
                        badge.textContent = data.count;
                        badge.classList.remove('hidden');
                    } else {
                        badge.classList.add('hidden');
                    }
                }
            });
    }, 30000);
</script>
@endpush
@endsection
