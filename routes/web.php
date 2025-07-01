<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\ProjectSubmissionController;
use App\Http\Controllers\Admin\QuizQuestionController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

 Route::get('/', [HomeController::class, 'index'])->name('home');

  Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::get('/privacy-policy', [HomeController::class, 'privacy'])->name('privacy.policy');
     Route::get('/terms-of-service', [HomeController::class, 'terms'])->name('terms.of.service');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/my-courses', [\App\Http\Controllers\CourseController::class, 'myCourses'])
        ->middleware(['verified'])
        ->name('my-courses');
        Route::get('/courses/{course:slug}/lessons/{lesson}', [\App\Http\Controllers\CourseController::class, 'showLesson'])
        ->middleware(['verified'])
        ->name('courses.lesson');
        Route::post('/quiz/{quiz}/submit', [\App\Http\Controllers\QuizController::class, 'submit'])
        ->name('quiz.submit');
        Route::get('/courses', [\App\Http\Controllers\CourseController::class, 'index'])->name('courses.index');
        Route::get('/courses/{course:slug}', [\App\Http\Controllers\CourseController::class, 'show'])
        ->name('courses.show');
        Route::post('/courses/{course}/enroll', [\App\Http\Controllers\CourseController::class, 'enroll'])
    ->name('courses.enroll');
    Route::get('/courses/{course:slug}/completion', [\App\Http\Controllers\CourseController::class, 'showCompletion'])
        ->name('courses.completion');
    Route::post('/lessons/{lesson}/complete', [\App\Http\Controllers\CourseController::class, 'completeLesson'])
        ->name('lessons.complete');
    Route::get('/leaderboard', [\App\Http\Controllers\LeaderboardController::class, 'index'])
    ->name('leaderboard.index');
    Route::post('/lessons/{lesson}/projects/submit', [\App\Http\Controllers\ProjectController   ::class, 'submit'])->name('projects.submit');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
     // TAMBAHKAN RUTE INI
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    // RUTE BARU: Menampilkan formulir edit pengguna
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    // RUTE BARU: Memperbarui data pengguna
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
     Route::get('/courses', [\App\Http\Controllers\Admin\CourseController::class, 'index'])->name('courses.index');
     Route::get('/courses/create', [\App\Http\Controllers\Admin\CourseController::class, 'create'])->name('courses.create');
    
    // RUTE BARU: Menyimpan data kursus baru dari formulir
    Route::post('/courses', [\App\Http\Controllers\Admin\CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}/edit', [App\Http\Controllers\Admin\CourseController::class, 'edit'])->name('courses.edit');

    // RUTE BARU: Memperbarui data kursus dari formulir edit
    Route::put('/courses/{course}', [App\Http\Controllers\Admin\CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [App\Http\Controllers\Admin\CourseController::class, 'destroy'])->name('courses.destroy');
     Route::post('/courses/{course}/modules', [ModuleController::class, 'store'])->name('modules.store');
     Route::get('/modules/{module}/edit', [ModuleController::class, 'edit'])->name('modules.edit');
    // RUTE BARU: Memperbarui modul
    Route::put('/modules/{module}', [ModuleController::class, 'update'])->name('modules.update');
    // RUTE BARU: Menghapus modul
    Route::delete('/modules/{module}', [ModuleController::class, 'destroy'])->name('modules.destroy');
    Route::get('/modules/{module}/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
        // Menyimpan pelajaran baru
        Route::post('/modules/{module}/lessons', [LessonController::class, 'store'])->name('lessons.store');
        // Menampilkan form edit pelajaran
        Route::get('/lessons/{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
        // Memperbarui pelajaran
        Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
        // Menghapus pelajaran
        Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');
         Route::get('/quizzes/{quiz}/questions', [QuizQuestionController::class, 'index'])->name('quizzes.questions.index');
          Route::post('/quizzes/{quiz}/questions', [QuizQuestionController::class, 'store'])->name('quizzes.questions.store');
          Route::get('/questions/{question}/edit', [QuizQuestionController::class, 'edit'])->name('quizzes.questions.edit');
    // RUTE BARU: Memperbarui pertanyaan
    Route::put('/questions/{question}', [QuizQuestionController::class, 'update'])->name('quizzes.questions.update');
    // RUTE BARU: Menghapus pertanyaan
    Route::delete('/questions/{question}', [QuizQuestionController::class, 'destroy'])->name('quizzes.questions.destroy');
          Route::get('/projects/{project}/edit', [\App\Http\Controllers\Admin\ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [\App\Http\Controllers\Admin\ProjectController::class, 'update'])->name('projects.update');

    Route::get('/analytics', [\App\Http\Controllers\Admin\AnalyticsController::class, 'index'])->name('analytics.index');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/submissions/projects', [ProjectSubmissionController::class, 'index'])->name('projects.submissions.index');
    Route::get('/submissions/projects/{submission}', [ProjectSubmissionController::class, 'show'])->name('projects.submissions.show');
    
    // RUTE BARU: Memperbarui status dan feedback kiriman proyek
    Route::put('/submissions/projects/{submission}', [ProjectSubmissionController::class, 'update'])->name('projects.submissions.update');
});


require __DIR__.'/auth.php';
