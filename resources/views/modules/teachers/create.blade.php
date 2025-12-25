@extends('layouts.app')

@section('title', 'Add New Teacher')
@section('page-title', 'Add New Teacher')
@section('page-description', 'Create a new teacher record in the system')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-gradient-to-r from-maroon/10 to-maroon/5 rounded-2xl">
                        <i class="fas fa-chalkboard-teacher text-maroon text-2xl"></i>
                    </div>

                </div>
            </div>
            <a href="{{ route('teachers.index') }}"
               class="inline-flex items-center px-4 py-3 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 hover:from-gray-100 hover:to-gray-200 dark:hover:from-gray-600 dark:hover:to-gray-500 text-gray-700 dark:text-gray-300 font-semibold rounded-xl transition-all duration-300 shadow-sm hover:shadow-md">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Teachers
            </a>
        </div>
    </div>

    <!-- Main Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
        <!-- Form Header -->
        <div class="px-6 py-8 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Teacher Information</h2>
                    <p class="text-gray-600 dark:text-gray-300 mt-1">Enter all required details accurately</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-300">All fields marked with * are required</span>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            <!-- Personal Information Section -->
            <div class="mb-10">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/10 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-user text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Personal Information</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- First Name -->
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            First Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="first_name"
                               id="first_name"
                               value="{{ old('first_name') }}"
                               required
                               class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-300 @error('first_name') border-red-500 @enderror"
                               placeholder="Enter first name">
                        @error('first_name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Last Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="last_name"
                               id="last_name"
                               value="{{ old('last_name') }}"
                               required
                               class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-300 @error('last_name') border-red-500 @enderror"
                               placeholder="Enter last name">
                        @error('last_name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Other Names -->
                    <div>
                        <label for="other_names" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Other Names
                        </label>
                        <input type="text"
                               name="other_names"
                               id="other_names"
                               value="{{ old('other_names') }}"
                               class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-300"
                               placeholder="Optional">
                    </div>

                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Gender <span class="text-red-500">*</span>
                        </label>
                        <select name="gender"
                                id="gender"
                                required
                                class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-300 @error('gender') border-red-500 @enderror">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Second Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                    <!-- Date of Birth -->
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Date of Birth <span class="text-red-500">*</span>
                        </label>
                        <input type="date"
                               name="date_of_birth"
                               id="date_of_birth"
                               value="{{ old('date_of_birth') }}"
                               required
                               class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-300 @error('date_of_birth') border-red-500 @enderror">
                        @error('date_of_birth')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- National ID -->
                    <div>
                        <label for="national_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            National ID / Passport
                        </label>
                        <input type="text"
                               name="national_id"
                               id="national_id"
                               value="{{ old('national_id') }}"
                               class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-300"
                               placeholder="Enter national ID">
                    </div>

                    <!-- Teacher ID -->
                    <div>
                        <label for="teacher_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Teacher ID <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="teacher_id"
                               id="teacher_id"
                               value="{{ old('teacher_id') }}"
                               required
                               class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-300 @error('teacher_id') border-red-500 @enderror"
                               placeholder="TEA-XXXX">
                        @error('teacher_id')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Contact Information Section -->
            <div class="mb-10">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/10 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-phone text-green-600 dark:text-green-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Contact Information</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email"
                               name="email"
                               id="email"
                               value="{{ old('email') }}"
                               required
                               class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-300 @error('email') border-red-500 @enderror"
                               placeholder="teacher@example.com">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input type="tel"
                               name="phone"
                               id="phone"
                               value="{{ old('phone') }}"
                               required
                               class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-300 @error('phone') border-red-500 @enderror"
                               placeholder="+256 XXX XXX XXX">
                        @error('phone')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="mt-6">
                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Residential Address
                    </label>
                    <textarea name="address"
                              id="address"
                              rows="3"
                              class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-300"
                              placeholder="Enter full address">{{ old('address') }}</textarea>
                </div>
            </div>

            <!-- Employment Information Section -->
            <div class="mb-10">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/10 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-briefcase text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Employment Information</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Employment Date -->
                    <div>
                        <label for="employment_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Employment Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date"
                               name="employment_date"
                               id="employment_date"
                               value="{{ old('employment_date') }}"
                               required
                               class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-300 @error('employment_date') border-red-500 @enderror">
                        @error('employment_date')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Department -->
                    <div>
                        <label for="department_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Department <span class="text-red-500">*</span>
                        </label>
                        <select name="department_id"
                                id="department_id"
                                required
                                class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-300 @error('department_id') border-red-500 @enderror">
                            <option value="">Select Department</option>

                        </select>
                        @error('department_id')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Designation -->
                    <div>
                        <label for="designation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Designation <span class="text-red-500">*</span>
                        </label>
                        <select name="designation"
                                id="designation"
                                required
                                class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-300 @error('designation') border-red-500 @enderror">
                            <option value="">Select Designation</option>
                            <option value="teacher" {{ old('designation') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                            <option value="senior_teacher" {{ old('designation') == 'senior_teacher' ? 'selected' : '' }}>Senior Teacher</option>
                            <option value="head_of_department" {{ old('designation') == 'head_of_department' ? 'selected' : '' }}>Head of Department</option>
                            <option value="deputy_head" {{ old('designation') == 'deputy_head' ? 'selected' : '' }}>Deputy Head Teacher</option>
                            <option value="head_teacher" {{ old('designation') == 'head_teacher' ? 'selected' : '' }}>Head Teacher</option>
                        </select>
                        @error('designation')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Qualifications & Subjects -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <!-- Qualifications -->
                    <div>
                        <label for="qualifications" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Qualifications
                        </label>
                        <textarea name="qualifications"
                                  id="qualifications"
                                  rows="3"
                                  class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-300"
                                  placeholder="List qualifications (e.g., B.Ed, M.Ed, etc.)">{{ old('qualifications') }}</textarea>
                    </div>

                    <!-- Subjects (Multiselect) -->
                    <div>
                        <label for="subjects" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Subjects Taught
                        </label>
                        <select name="subjects[]"
                                id="subjects"
                                multiple
                                class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-300 h-32">

                        </select>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Hold Ctrl/Cmd to select multiple subjects</p>
                    </div>
                </div>
            </div>

            <!-- Account & Photo Section -->
            <div class="mb-10">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-r from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/10 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-camera text-orange-600 dark:text-orange-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Profile & Account</h3>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Profile Photo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">
                            Profile Photo
                        </label>
                        <div class="flex items-center space-x-6">
                            <!-- Photo Preview -->
                            <div class="relative">
                                <div id="photoPreview" class="w-32 h-32 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 rounded-2xl flex items-center justify-center shadow-lg overflow-hidden">
                                    <i class="fas fa-user text-gray-400 dark:text-gray-500 text-4xl"></i>
                                </div>
                                <div id="uploadProgress" class="hidden absolute inset-0 bg-black/50 flex items-center justify-center rounded-2xl">
                                    <div class="spinner border-2 border-white border-t-transparent rounded-full w-8 h-8 animate-spin"></div>
                                </div>
                            </div>

                            <!-- Upload Controls -->
                            <div class="flex-1">
                                <div class="mb-4">
                                    <input type="file"
                                           name="photo"
                                           id="photo"
                                           accept="image/*"
                                           class="hidden"
                                           onchange="previewPhoto(event)">
                                    <label for="photo"
                                           class="cursor-pointer inline-flex items-center px-4 py-3 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/10 hover:from-blue-100 hover:to-blue-200 dark:hover:from-blue-800/30 dark:hover:to-blue-700/20 text-blue-600 dark:text-blue-400 font-semibold rounded-xl transition-all duration-300 shadow-sm hover:shadow-md">
                                        <i class="fas fa-upload mr-2"></i>
                                        Upload Photo
                                    </label>
                                    <button type="button"
                                            onclick="clearPhoto()"
                                            class="ml-3 inline-flex items-center px-4 py-3 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 hover:from-gray-100 hover:to-gray-200 dark:hover:from-gray-600 dark:hover:to-gray-500 text-gray-700 dark:text-gray-300 font-semibold rounded-xl transition-all duration-300 shadow-sm hover:shadow-md">
                                        <i class="fas fa-times mr-2"></i>
                                        Remove
                                    </button>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Recommended: Square image, maximum 2MB, JPG or PNG format
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Initial Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password"
                                   name="password"
                                   id="password"
                                   required
                                   class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-300 pr-12 @error('password') border-red-500 @enderror"
                                   placeholder="Set initial password">
                            <button type="button"
                                    onclick="togglePassword()"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                                <i id="passwordIcon" class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror

                        <div class="mt-6">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Confirm Password <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="password"
                                       name="password_confirmation"
                                       id="password_confirmation"
                                       required
                                       class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-300 pr-12"
                                       placeholder="Confirm password">
                                <button type="button"
                                        onclick="toggleConfirmPassword()"
                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                                    <i id="confirmPasswordIcon" class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-8 border-t border-gray-100 dark:border-gray-700">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    <i class="fas fa-info-circle mr-2"></i>
                    All information will be saved securely
                </div>
                <div class="flex items-center space-x-4">
                    <button type="button"
                            onclick="window.history.back()"
                            class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 hover:from-gray-100 hover:to-gray-200 dark:hover:from-gray-600 dark:hover:to-gray-500 text-gray-700 dark:text-gray-300 font-semibold rounded-xl transition-all duration-300 shadow-sm hover:shadow-md">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-maroon to-maroon-dark hover:from-maroon-dark hover:to-maroon text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-[1.02] flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Create Teacher Record
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Help Card -->
    <div class="mt-8 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/10 rounded-2xl p-6 border border-blue-200 dark:border-blue-800/30">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-lightbulb text-blue-600 dark:text-blue-400 text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Quick Tips</h3>
                <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                    <li class="flex items-start">
                        <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                        <span>Ensure all required fields are filled before submission</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                        <span>Teacher ID should follow the format: TEA-XXXX (e.g., TEA-2024)</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                        <span>Upload a clear profile photo for better identification</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                        <span>The teacher will receive login credentials via email</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Photo Preview Functionality
    function previewPhoto(event) {
        const input = event.target;
        const preview = document.getElementById('photoPreview');
        const progress = document.getElementById('uploadProgress');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            // Show progress
            progress.classList.remove('hidden');

            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                progress.classList.add('hidden');
            }

            reader.onerror = function() {
                progress.classList.add('hidden');
                alert('Error loading image. Please try again.');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function clearPhoto() {
        document.getElementById('photo').value = '';
        const preview = document.getElementById('photoPreview');
        preview.innerHTML = '<i class="fas fa-user text-gray-400 dark:text-gray-500 text-4xl"></i>';
    }

    // Password Toggle Functionality
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const icon = document.getElementById('passwordIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    function toggleConfirmPassword() {
        const passwordInput = document.getElementById('password_confirmation');
        const icon = document.getElementById('confirmPasswordIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Auto-generate Teacher ID
    document.addEventListener('DOMContentLoaded', function() {
        const teacherIdInput = document.getElementById('teacher_id');
        if (!teacherIdInput.value) {
            const randomNum = Math.floor(1000 + Math.random() * 9000);
            teacherIdInput.value = 'TEA-' + randomNum;
        }

        // Form validation before submission
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            // You can add custom validation here
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields marked with *');
            }
        });
    });
</script>
@endpush

<style>
    /* Custom styles for better UX */
    .spinner {
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top: 2px solid #fff;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Select multiple styling */
    select[multiple] option:checked {
        background: linear-gradient(to right, #800000, #5f0000);
        color: white;
    }

    /* Form input focus effects */
    input:focus, select:focus, textarea:focus {
        outline: none;
        box-shadow: 0 0 0 4px rgba(128, 0, 0, 0.1);
    }

    .dark input:focus, .dark select:focus, .dark textarea:focus {
        box-shadow: 0 0 0 4px rgba(128, 0, 0, 0.2);
    }
</style>
@endsection
