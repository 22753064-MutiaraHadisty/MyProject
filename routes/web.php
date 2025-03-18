<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\NilaiController;
use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Rfc4122\NilTrait;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Routes untuk User
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    // Routes untuk Teacher (Pastikan Konsisten)
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher');
    Route::get('/teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
    Route::post('/teacher', [TeacherController::class, 'store'])->name('teacher.store');
    Route::get('/teacher/{id}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::put('/teacher/{id}', [TeacherController::class, 'update'])->name('teacher.update');
    Route::delete('/teacher/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');

    // Routes untuk Students
    Route::get('/students', [StudentController::class, 'index'])->name('students');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

    // Routes untuk Search
    Route::get('/search', [SearchController::class, 'search'])->name('search');

    // Routes untuk mapel
    Route::get('/mapel', [MapelController::class, 'index'])->name('mapel');
    Route::get('/mapel/create', [MapelController::class, 'create'])->name('mapel.create');
    Route::post('/mapel/store', [MapelController::class, 'store'])->name('mapel.store');
    Route::get('/mapel/edit/{id}', [MapelController::class, 'edit'])->name('mapel.edit');
    Route::put('/mapel/update/{id}', [MapelController::class, 'update'])->name('mapel.update');
    Route::delete('/mapel/delete/{id}', [MapelController::class, 'destroy'])->name('mapel.destroy');

    // Routes untuk nilai
    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai');
    Route::get('/nilai/create', [NilaiController::class, 'create'])->name('nilai.create');
    Route::post('/nilai/store', [NilaiController::class, 'store'])->name('nilai.store');
    Route::get('/nilai/edit/{id}', [NilaiController::class, 'edit'])->name('nilai.edit');
    Route::put('/nilai/update/{id}', [NilaiController::class, 'update'])->name('nilai.update');
    Route::delete('/nilai/delete/{id}', [NilaiController::class, 'destroy'])->name('nilai.destroy');
    Route::get('/nilai/export/pdf', [NilaiController::class, 'exportPDF'])->name('nilai.export.pdf');



    // Routes untuk Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
