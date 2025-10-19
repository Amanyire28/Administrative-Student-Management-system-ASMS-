<?php

use App\Http\Controllers\HomeComtroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/Classes&subjects/classform',[HomeController::class,'classform']);
Route::get('/Classes&subjects/classedit',[HomeController::class,'classedit']);
Route::get('/Classes&subjects/classshow',[HomeController::class,'classshow']);
Route::get('/Classes&subjects/singleclass',[HomeController::class,'singleclass']);
//subjects routes
Route::get('/Classes&subjects/subjectform',[HomeController::class,'subjectform']);
Route::get('/Classes&subjects/singlesubject',[HomeController::class,'singlesubject']);
Route::get('/Classes&subjects/subjectshow',[HomeController::class,'subjectshow']);
Route::get('/Classes&subjects/editsubject',[HomeController::class,'editsubject']);

Route::get('/students/studentreg',[HomeController::class,'studentreg']);
Route::get('/students/studentshow',[HomeController::class,'studentshow']);
Route::get('/students/singlestudent',[HomeController::class,'singlestudent']);
Route::get('/students/student',[HomeController::class,'student']);
