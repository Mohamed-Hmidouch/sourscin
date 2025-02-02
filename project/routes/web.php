<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;

/*
|---------------------------------------------------------------------------
| Web Routes                                                               |
|---------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

// Public dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/users', [AdminController::class, 'users']);
    
    // Question and quiz resources
    Route::resource('questions', QuestionController::class);
    Route::resource('quizzes', QuizController::class);
});

// Teacher routes
Route::middleware(['auth', 'role:condidat'])->prefix('condidat')->group(function () {
    Route::get('/dashboard', [CondidatController::class, 'dashboard']);
});
