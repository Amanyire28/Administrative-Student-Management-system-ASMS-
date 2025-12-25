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
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\SchoolSettingController;
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
        ->middleware('permission:classes.assign-subjects')
        ->name('classes.assign-subjects');

    // ========================================
    // SUBJECT MANAGEMENT - Protected
    // ========================================
    Route::middleware('permission:subjects.view')->group(function () {
        Route::get('subjects', [SubjectController::class, 'index'])->name('subjects.index');
    });

    Route::get('subjects/create', [SubjectController::class, 'create'])
        ->middleware('permission:subjects.create')
        ->name('subjects.create');

    Route::post('subjects', [SubjectController::class, 'store'])
        ->middleware('permission:subjects.create')
        ->name('subjects.store');

    Route::get('subjects/{subject}', [SubjectController::class, 'show'])
        ->middleware('permission:subjects.view-detail')
        ->name('subjects.show');

    Route::get('subjects/{subject}/edit', [SubjectController::class, 'edit'])
        ->middleware('permission:subjects.edit')
        ->name('subjects.edit');

    Route::put('subjects/{subject}', [SubjectController::class, 'update'])
        ->middleware('permission:subjects.edit')
        ->name('subjects.update');

    Route::delete('subjects/{subject}', [SubjectController::class, 'destroy'])
        ->middleware('permission:subjects.delete')
        ->name('subjects.destroy');

    // ========================================
    // MARKS MANAGEMENT - Protected
    // ========================================
    Route::middleware('permission:marks.view')->group(function () {
        Route::get('marks', [MarkController::class, 'index'])->name('marks.index');
    });

    Route::get('marks-entry', [MarkController::class, 'create'])
        ->middleware('permission:marks.entry')
        ->name('marks.entry.form');

    Route::post('marks-entry', [MarkController::class, 'entry'])
        ->middleware('permission:marks.entry')
        ->name('marks.entry');

    Route::post('marks-store-multiple', [MarkController::class, 'storeMultiple'])
        ->middleware('permission:marks.entry')
        ->name('marks.store.multiple');

    Route::get('marks/{mark}/edit', [MarkController::class, 'edit'])
        ->middleware('permission:marks.edit')
        ->name('marks.edit');

    Route::put('marks/{mark}', [MarkController::class, 'update'])
        ->middleware('permission:marks.edit')
        ->name('marks.update');

    Route::delete('marks/{mark}', [MarkController::class, 'destroy'])
        ->middleware('permission:marks.delete')
        ->name('marks.destroy');

    // ========================================
    // REPORT CARD - Protected
    // ========================================
    Route::get('report-card/form', [ReportController::class, 'form'])
        ->middleware('permission:reports.view')
        ->name('report.card.form');

    Route::post('report-card/generate', [ReportController::class, 'generate'])
        ->middleware('permission:reports.generate')
        ->name('report.card.generate');

    Route::get('report-card/{student}', [ReportController::class, 'show'])
        ->middleware('permission:reports.view')
        ->name('report.card');

    Route::get('report-card/{student}/download', [ReportController::class, 'download'])
        ->middleware('permission:reports.export')
        ->name('report.card.download');

    // ========================================
    // SYSTEM MANAGEMENT - Protected
    // ========================================
    Route::middleware('permission:system.users')->group(function () {
        Route::get('system', [SystemController::class, 'index'])->name('system.index');
        Route::get('system/users', [SystemController::class, 'users'])->name('system.users');
        Route::get('system/users/{user}/permissions', [SystemController::class, 'editUserPermissions'])->name('system.user-permissions');
        Route::post('system/users/{user}/permissions', [SystemController::class, 'updateUserPermissions'])->name('system.update-user-permissions');
    });

    Route::middleware('permission:system.roles')->group(function () {
        Route::get('system/roles', [SystemController::class, 'roles'])->name('system.roles');
    });

    // ========================================
    // SCHOOL SETTINGS - Protected (from HEAD)
    // ========================================
    Route::middleware('permission:system.settings')->group(function () {
        // Main settings page
        Route::get('settings/school-profile', [SchoolSettingController::class, 'edit'])
            ->name('settings.school-profile');

        // Update routes for each section
        Route::post('settings/school-profile/basic-info', [SchoolSettingController::class, 'updateBasicInfo'])
            ->name('settings.update-basic-info');

        Route::post('settings/school-profile/contact-info', [SchoolSettingController::class, 'updateContactInfo'])
            ->name('settings.update-contact-info');

        Route::post('settings/school-profile/academic-structure', [SchoolSettingController::class, 'updateAcademicStructure'])
            ->name('settings.update-academic-structure');

        Route::post('settings/school-profile/email-config', [SchoolSettingController::class, 'updateEmailConfig'])
            ->name('settings.update-email-config');

        Route::post('settings/school-profile/report-card', [SchoolSettingController::class, 'updateReportCardSettings'])
            ->name('settings.update-report-card');

        // Delete routes
        Route::delete('settings/school-profile/delete-logo', [SchoolSettingController::class, 'deleteLogo'])
            ->name('settings.delete-logo');

        Route::delete('settings/school-profile/delete-signature', [SchoolSettingController::class, 'deleteSignature'])
            ->name('settings.delete-signature');
    });

});
