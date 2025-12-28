<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassLevelController;
use App\Http\Controllers\ClassCategoryController;
use App\Http\Controllers\StreamController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ReportController;
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

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Dashboard with SPA support
Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth:sanctum', 'verified'])
    ->name('dashboard');

// Password Change Routes (no permission required)
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/password/change', function () {
        return view('auth.change-password');
    })->name('password.change');

    Route::post('/password/change', [PasswordChangeController::class, 'update'])
        ->name('password.update');
});

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');

// Admin Routes - Protected by Permissions
Route::prefix('admin')->middleware(['auth:sanctum', 'verified'])->group(function () {

    // ========================================
    // STUDENT MANAGEMENT - Protected
    // ========================================
    Route::middleware('permission:students.view')->group(function () {
        Route::get('students', [StudentController::class, 'index'])->name('students.index');
    });

    Route::get('students/create', [StudentController::class, 'create'])
        ->middleware('permission:students.create')
        ->name('students.create');

    Route::post('students', [StudentController::class, 'store'])
        ->middleware('permission:students.create')
        ->name('students.store');

    Route::get('students/{student}', [StudentController::class, 'show'])
        ->middleware('permission:students.view-detail')
        ->name('students.show');

    Route::get('students/{student}/edit', [StudentController::class, 'edit'])
        ->middleware('permission:students.edit')
        ->name('students.edit');

    Route::put('students/{student}', [StudentController::class, 'update'])
        ->middleware('permission:students.edit')
        ->name('students.update');

    Route::delete('students/{student}', [StudentController::class, 'destroy'])
        ->middleware('permission:students.delete')
        ->name('students.destroy');

    // ========================================
    // TEACHER MANAGEMENT - Protected
    // ========================================
    Route::middleware('permission:teachers.view')->group(function () {
        Route::get('teachers', [TeacherController::class, 'index'])->name('teachers.index');
    });

    Route::get('teachers/create', [TeacherController::class, 'create'])
        ->middleware('permission:teachers.create')
        ->name('teachers.create');

    Route::post('teachers', [TeacherController::class, 'store'])
        ->middleware('permission:teachers.create')
        ->name('teachers.store');

    Route::get('teachers/{teacher}', [TeacherController::class, 'show'])
        ->middleware('permission:teachers.view-detail')
        ->name('teachers.show');

    Route::get('teachers/{teacher}/edit', [TeacherController::class, 'edit'])
        ->middleware('permission:teachers.edit')
        ->name('teachers.edit');

    Route::put('teachers/{teacher}', [TeacherController::class, 'update'])
        ->middleware('permission:teachers.edit')
        ->name('teachers.update');

    Route::delete('teachers/{teacher}', [TeacherController::class, 'destroy'])
        ->middleware('permission:teachers.delete')
        ->name('teachers.destroy');

    // ========================================
    // CLASS CATEGORY MANAGEMENT (from julius2)
    // ========================================
    Route::middleware('permission:classes.view')->group(function () {
        Route::get('class-categories', [ClassCategoryController::class, 'index'])->name('class-categories.index');
    });

    Route::get('class-categories/create', [ClassCategoryController::class, 'create'])
        ->middleware('permission:classes.create')
        ->name('class-categories.create');

    Route::post('class-categories', [ClassCategoryController::class, 'store'])
        ->middleware('permission:classes.create')
        ->name('class-categories.store');

    Route::get('class-categories/{class_category}', [ClassCategoryController::class, 'show'])
        ->middleware('permission:classes.view-detail')
        ->name('class-categories.show');

    Route::get('class-categories/{class_category}/edit', [ClassCategoryController::class, 'edit'])
        ->middleware('permission:classes.edit')
        ->name('class-categories.edit');

    Route::put('class-categories/{class_category}', [ClassCategoryController::class, 'update'])
        ->middleware('permission:classes.edit')
        ->name('class-categories.update');

    Route::delete('class-categories/{class_category}', [ClassCategoryController::class, 'destroy'])
        ->middleware('permission:classes.delete')
        ->name('class-categories.destroy');

    // ========================================
    // CLASS LEVEL MANAGEMENT (from julius2)
    // ========================================
    Route::middleware('permission:classes.view')->group(function () {
        Route::get('class-levels', [ClassLevelController::class, 'index'])->name('class-levels.index');
    });

    Route::get('class-levels/create', [ClassLevelController::class, 'create'])
        ->middleware('permission:classes.create')
        ->name('class-levels.create');

    Route::post('class-levels', [ClassLevelController::class, 'store'])
        ->middleware('permission:classes.create')
        ->name('class-levels.store');

    Route::get('class-levels/{class_level}', [ClassLevelController::class, 'show'])
        ->middleware('permission:classes.view-detail')
        ->name('class-levels.show');

    Route::get('class-levels/{class_level}/edit', [ClassLevelController::class, 'edit'])
        ->middleware('permission:classes.edit')
        ->name('class-levels.edit');

    Route::put('class-levels/{class_level}', [ClassLevelController::class, 'update'])
        ->middleware('permission:classes.edit')
        ->name('class-levels.update');

    Route::delete('class-levels/{class_level}', [ClassLevelController::class, 'destroy'])
        ->middleware('permission:classes.delete')
        ->name('class-levels.destroy');

    // ========================================
    // STREAM MANAGEMENT (from julius2)
    // ========================================
    Route::middleware('permission:classes.view')->group(function () {
        Route::get('streams', [StreamController::class, 'index'])->name('streams.index');
    });

    Route::get('streams/create', [StreamController::class, 'create'])
        ->middleware('permission:classes.create')
        ->name('streams.create');

    Route::post('streams', [StreamController::class, 'store'])
        ->middleware('permission:classes.create')
        ->name('streams.store');

    Route::get('streams/{stream}', [StreamController::class, 'show'])
        ->middleware('permission:classes.view-detail')
        ->name('streams.show');

    Route::get('streams/{stream}/edit', [StreamController::class, 'edit'])
        ->middleware('permission:classes.edit')
        ->name('streams.edit');

    Route::put('streams/{stream}', [StreamController::class, 'update'])
        ->middleware('permission:classes.edit')
        ->name('streams.update');

    Route::delete('streams/{stream}', [StreamController::class, 'destroy'])
        ->middleware('permission:classes.delete')
        ->name('streams.destroy');

    // ========================================
    // CLASS MANAGEMENT - Protected
    // ========================================
    Route::middleware('permission:classes.view')->group(function () {
        Route::get('classes', [ClassController::class, 'index'])->name('classes.index');
    });

    Route::get('classes/create', [ClassController::class, 'create'])
        ->middleware('permission:classes.create')
        ->name('classes.create');

    Route::post('classes', [ClassController::class, 'store'])
        ->middleware('permission:classes.create')
        ->name('classes.store');

    Route::get('classes/{class}', [ClassController::class, 'show'])
        ->middleware('permission:classes.view-detail')
        ->name('classes.show');

    Route::get('classes/{class}/edit', [ClassController::class, 'edit'])
        ->middleware('permission:classes.edit')
        ->name('classes.edit');

    Route::put('classes/{class}', [ClassController::class, 'update'])
        ->middleware('permission:classes.edit')
        ->name('classes.update');

    Route::delete('classes/{class}', [ClassController::class, 'destroy'])
        ->middleware('permission:classes.delete')
        ->name('classes.destroy');

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
    
    // Report Management Routes
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
    Route::get('reports/{report}', [ReportController::class, 'show'])->name('reports.show');
    Route::get('reports/{report}/print', [ReportController::class, 'print'])->name('reports.print');
    Route::delete('reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');
    Route::get('api/students-by-class', [ReportController::class, 'getStudentsByClass'])->name('api.students-by-class');
    
});
