@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between mb-6">
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl font-bold leading-7 text-gray-900 dark:text-gray-100 sm:text-3xl">
                    My Profile
                </h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Update your account's profile information and password.
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="px-4 py-2 bg-gradient-to-r from-maroon/10 to-maroon/5 text-maroon dark:text-maroon-light text-sm font-bold rounded-full">
                    <i class="fas fa-shield-alt mr-1"></i>
                    {{ $role->name ?? 'User' }}
                </span>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-6 bg-green-50 dark:bg-green-900/30 border-l-4 border-green-400 dark:border-green-600 p-4 rounded-r-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700 dark:text-green-300">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
        <div class="mb-6 bg-red-50 dark:bg-red-900/30 border-l-4 border-red-400 dark:border-red-600 p-4 rounded-r-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700 dark:text-red-300">
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Profile Information Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-100 dark:border-gray-700">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 flex items-center justify-center mr-3">
                        <i class="fas fa-user text-blue-600 dark:text-blue-400"></i>
                    </div>
                    Profile Information
                </h2>

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profileForm">
                    @csrf
                    @method('PUT')

                    <!-- Profile Photo -->
                    <div class="mb-8">
                        <div class="flex flex-col items-center">
                            <div class="relative mb-4">
                                <div class="w-32 h-32 bg-gradient-to-r from-maroon to-maroon-dark rounded-full flex items-center justify-center shadow-lg overflow-hidden">
                                    @if($user->profile_photo_path)
                                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                             alt="{{ $user->name }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <span class="text-white font-bold text-3xl">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </span>
                                    @endif
                                </div>
                                <label for="photo" class="absolute bottom-0 right-0 w-10 h-10 bg-blue-500 rounded-full border-4 border-white dark:border-gray-800 flex items-center justify-center cursor-pointer hover:bg-blue-600 transition-colors">
                                    <i class="fas fa-camera text-white text-sm"></i>
                                </label>
                            </div>
                            <input type="file"
                                   name="photo"
                                   id="photo"
                                   class="hidden"
                                   accept="image/*">
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Click the camera icon to change photo
                            </p>
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Full Name
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name', $user->name) }}"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-maroon focus:ring-maroon dark:focus:border-maroon-light dark:focus:ring-maroon-light transition-colors"
                               required>
                    </div>

                    <!-- Email -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Email Address
                        </label>
                        <input type="email"
                               name="email"
                               id="email"
                               value="{{ old('email', $user->email) }}"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-maroon focus:ring-maroon dark:focus:border-maroon-light dark:focus:ring-maroon-light transition-colors"
                               required>
                    </div>

                    <!-- Phone -->
                    <div class="mb-6">
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Phone Number
                        </label>
                        <input type="tel"
                               name="phone"
                               id="phone"
                               value="{{ old('phone', $user->phone) }}"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-maroon focus:ring-maroon dark:focus:border-maroon-light dark:focus:ring-maroon-light transition-colors">
                    </div>

                    <!-- Staff ID (Read-only) -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Staff ID
                        </label>
                        <input type="text"
                               value="{{ $user->staff_id }}"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-gray-500 dark:text-gray-400"
                               readonly
                               disabled>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                            Staff ID cannot be changed
                        </p>
                    </div>

                    <div class="mt-8">
                        <button type="submit"
                                class="w-full px-6 py-3 bg-gradient-to-r from-maroon to-maroon-dark text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-[1.02]">
                            <i class="fas fa-save mr-2"></i>
                            Save Profile Changes
                        </button>
                    </div>
                </form>
            </div>

            <!-- Password Update Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-100 dark:border-gray-700">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 flex items-center justify-center mr-3">
                        <i class="fas fa-lock text-red-600 dark:text-red-400"></i>
                    </div>
                    Update Password
                </h2>

                @if($user->must_change_password)
                <div class="mb-6 bg-yellow-50 dark:bg-yellow-900/30 border-l-4 border-yellow-400 dark:border-yellow-600 p-4 rounded-r-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700 dark:text-yellow-300">
                                You must change your password for security reasons.
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" id="passwordForm">
                    @csrf
                    @method('PUT')

                    <!-- Current Password -->
                    <div class="mb-6">
                        <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Current Password
                        </label>
                        <div class="relative">
                            <input type="password"
                                   name="current_password"
                                   id="current_password"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-maroon focus:ring-maroon dark:focus:border-maroon-light dark:focus:ring-maroon-light transition-colors pr-10">
                            <button type="button"
                                    class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                                    onclick="togglePassword('current_password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- New Password -->
                    <div class="mb-6">
                        <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            New Password
                        </label>
                        <div class="relative">
                            <input type="password"
                                   name="new_password"
                                   id="new_password"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-maroon focus:ring-maroon dark:focus:border-maroon-light dark:focus:ring-maroon-light transition-colors pr-10">
                            <button type="button"
                                    class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                                    onclick="togglePassword('new_password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm New Password -->
                    <div class="mb-6">
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Confirm New Password
                        </label>
                        <div class="relative">
                            <input type="password"
                                   name="new_password_confirmation"
                                   id="new_password_confirmation"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-maroon focus:ring-maroon dark:focus:border-maroon-light dark:focus:ring-maroon-light transition-colors pr-10">
                            <button type="button"
                                    class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                                    onclick="togglePassword('new_password_confirmation')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit"
                                class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-[1.02]">
                            <i class="fas fa-key mr-2"></i>
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Account Status Card -->
        <div class="mt-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-100 dark:border-gray-700">
            <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 flex items-center justify-center mr-3">
                    <i class="fas fa-info-circle text-green-600 dark:text-green-400"></i>
                </div>
                Account Information
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-xl">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Account Status</p>
                    <div class="flex items-center">
                        @if($user->is_active)
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                            <span class="font-semibold text-green-600 dark:text-green-400">Active</span>
                        @else
                            <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                            <span class="font-semibold text-red-600 dark:text-red-400">Inactive</span>
                        @endif
                    </div>
                </div>

                <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-xl">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Email Verification</p>
                    <div class="flex items-center">
                        @if($user->email_verified_at)
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                            <span class="font-semibold text-green-600 dark:text-green-400">Verified</span>
                        @else
                            <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                            <span class="font-semibold text-yellow-600 dark:text-yellow-400">Pending</span>
                        @endif
                    </div>
                </div>

                <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-xl">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Last Updated</p>
                    <p class="font-semibold text-gray-900 dark:text-gray-100">
                        {{ $user->updated_at->diffForHumans() }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Toggle password visibility
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.nextElementSibling.querySelector('i');

        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Handle photo upload preview
    document.getElementById('photo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.querySelector('.w-32.h-32 img');
                if (img) {
                    img.src = e.target.result;
                } else {
                    const avatarDiv = document.querySelector('.w-32.h-32');
                    const newImg = document.createElement('img');
                    newImg.src = e.target.result;
                    newImg.className = 'w-full h-full object-cover';
                    avatarDiv.innerHTML = '';
                    avatarDiv.appendChild(newImg);
                }
            }
            reader.readAsDataURL(file);
        }
    });

    // Separate form submission
    document.getElementById('profileForm').addEventListener('submit', function(e) {
        // Clear password fields for profile form
        document.getElementById('current_password').value = '';
        document.getElementById('new_password').value = '';
        document.getElementById('new_password_confirmation').value = '';
    });

    document.getElementById('passwordForm').addEventListener('submit', function(e) {
        // Clear profile fields for password form
        document.getElementById('name').value = '{{ $user->name }}';
        document.getElementById('email').value = '{{ $user->email }}';
        document.getElementById('phone').value = '{{ $user->phone ?? '' }}';
    });
</script>
@endpush
@endsection
