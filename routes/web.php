<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;   // 👈 নতুন লাইন
use App\Http\Controllers\LessonController;   // 👈 নতুন লাইন
use Illuminate\Support\Facades\Route;

// ডিফল্ট রুট
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// প্রোফাইল রুট (লগইন করা ইউজারদের জন্য)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


    // 👇 অ্যাডমিন ইউজার ম্যানেজমেন্ট রুট
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])
        ->name('admin.users.index');

        Route::get('/admin/users/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');

});

// 👇 আপনার আগের কোর্স এবং লেসনের রুটগুলো এখানে ফিরিয়ে আনুন

// 👇 শুধু কোর্সের create, store, edit, update, delete-এ লগইন লাগবে
Route::middleware('auth')->group(function () {
    Route::resource('courses', CourseController::class)->except(['index', 'show']);
});

// 👇 কোর্স দেখা (index, show) সবার জন্য উন্মুক্ত থাকবে
Route::resource('courses', CourseController::class)->only(['index', 'show']);

Route::get('courses/{course}/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
Route::post('courses/{course}/lessons', [LessonController::class, 'store'])->name('lessons.store');

// Breeze-এর অথেনটিকেশন রুট
require __DIR__.'/auth.php';