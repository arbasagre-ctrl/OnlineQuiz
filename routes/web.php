<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\YearLevelController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ConfigurationController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\QuizController as TeacherQuizController;
use App\Http\Controllers\Teacher\QuestionController;
use App\Http\Controllers\Teacher\GradingController;
use App\Http\Controllers\Teacher\ProfileController as TeacherProfileController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\QuizController as StudentQuizController;
use App\Http\Controllers\Student\ResultController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->isTeacher()) {
            return redirect()->route('teacher.dashboard');
        } elseif (auth()->user()->isStudent()) {
            return redirect()->route('student.dashboard');
        }
    }
    return redirect()->route('login');
});

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // User Management
    Route::resource('users', UserController::class);
    
    // Course Management
    Route::resource('courses', CourseController::class);
    
    // Year Level Management
    Route::resource('year-levels', YearLevelController::class);
    
    // Section Management
    Route::resource('sections', SectionController::class);
    
    // Configuration
    Route::get('configuration', [ConfigurationController::class, 'index'])->name('configuration.index');
    Route::delete('quizzes/{quiz}', [ConfigurationController::class, 'deleteQuiz'])->name('quizzes.delete');
    Route::delete('submissions/{submission}', [ConfigurationController::class, 'deleteSubmission'])->name('submissions.delete');
});

// Teacher Routes
Route::middleware(['auth'])->prefix('teacher')->name('teacher.')->group(function () {
    // Dashboard
    Route::get('dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');
    
    // Quiz Management
    Route::resource('quizzes', TeacherQuizController::class);
    Route::post('quizzes/{quiz}/publish', [TeacherQuizController::class, 'publish'])->name('quizzes.publish');
    Route::post('quizzes/{quiz}/unpublish', [TeacherQuizController::class, 'unpublish'])->name('quizzes.unpublish');
    
    // Question Management
    Route::post('quizzes/{quiz}/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::put('quizzes/{quiz}/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');
    Route::delete('quizzes/{quiz}/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
    
    // Grading
    Route::get('grading', [GradingController::class, 'index'])->name('grading.index');
    Route::get('grading/{submission}', [GradingController::class, 'show'])->name('grading.show');
    Route::put('grading/{submission}', [GradingController::class, 'update'])->name('grading.update');
    
    // Profile
    Route::get('profile', [TeacherProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [TeacherProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile/picture', [TeacherProfileController::class, 'removeProfilePicture'])->name('profile.remove-picture');
});

// Student Routes
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    // Dashboard
    Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    
    // Quiz Taking
    Route::get('quizzes', [StudentQuizController::class, 'index'])->name('quizzes.index');
    Route::get('quizzes/{quiz}', [StudentQuizController::class, 'show'])->name('quizzes.show');
    Route::post('quizzes/{quiz}/submit', [StudentQuizController::class, 'submit'])->name('quizzes.submit');
    
    // Results
    Route::get('results', [ResultController::class, 'index'])->name('results.index');
    Route::get('results/{submission}', [ResultController::class, 'show'])->name('results.show');
    
    // Profile
    Route::get('profile', [StudentProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [StudentProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile/picture', [StudentProfileController::class, 'removeProfilePicture'])->name('profile.remove-picture');
});

