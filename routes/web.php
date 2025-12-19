<?php

use App\Http\Controllers\HomeController;
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

// Landing page
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

// Dashboard (will require auth later)
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// Legacy route for compatibility
Route::get('/index', [HomeController::class, 'welcome'])->name('index');
