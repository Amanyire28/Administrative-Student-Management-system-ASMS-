<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Redirect to login if not authenticated, dashboard if authenticated
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Dashboard (protected by authentication)
Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth:sanctum', 'verified'])->name('dashboard');

// Legacy route for compatibility
Route::get('/index', [HomeController::class, 'welcome'])->name('index');

// Logout route
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');

// Admin Routes (protected by authentication)
Route::prefix('admin')->middleware(['auth:sanctum', 'verified'])->group(function () {
    
    // Student Management Routes
    Route::resource('students', StudentController::class);
    
    // Teacher Management Routes
    Route::resource('teachers', TeacherController::class);
    
    // Class Management Routes
    Route::resource('classes', ClassController::class);
    Route::post('classes/{class}/assign-subjects', [ClassController::class, 'assignSubjects'])
         ->name('classes.assign-subjects');
    
    // Subject Management Routes
    Route::resource('subjects', SubjectController::class);
    
    // Marks Management Routes
    Route::resource('marks', MarkController::class);
    Route::get('marks-entry', [MarkController::class, 'create'])->name('marks.entry.form');
    Route::post('marks-entry', [MarkController::class, 'entry'])->name('marks.entry');
    Route::post('marks-store-multiple', [MarkController::class, 'storeMultiple'])->name('marks.store.multiple');
    Route::get('report-card/{student}', [MarkController::class, 'reportCard'])->name('report.card');
    
    // Announcement Management Routes
    Route::resource('announcements', AnnouncementController::class);
    Route::patch('announcements/{announcement}/toggle', [AnnouncementController::class, 'toggle'])
         ->name('announcements.toggle');
    
});
