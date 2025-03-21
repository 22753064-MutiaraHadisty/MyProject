<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\StudentController; // Tambahkan jika belum ada

// Halaman Utama (Welcome)
Route::get('/', function () {
    return view('welcome');
});

// ==================== Pendaftaran (Bisa Diakses Tanpa Login) ====================
Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create'); // Form Pendaftaran
Route::post('/pendaftaran/store', [PendaftaranController::class, 'store'])->name('pendaftaran.store'); // Simpan Pendaftaran

// ==================== Routes yang Memerlukan Login ====================
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    // Teacher Management
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher');
    Route::get('/teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
    Route::post('/teacher/store', [TeacherController::class, 'store'])->name('teacher.store');
    Route::get('/teacher/edit/{id}', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::put('/teacher/update/{id}', [TeacherController::class, 'update'])->name('teacher.update');
    Route::delete('/teacher/delete/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');

    // Student Management
    Route::get('/students', [StudentController::class, 'index'])->name('students');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/edit/{id}', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/update/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/delete/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

    // Search
    Route::get('/search', [SearchController::class, 'search'])->name('search');

    // Mapel (Mata Pelajaran)
    Route::get('/mapel', [MapelController::class, 'index'])->name('mapel');
    Route::get('/mapel/create', [MapelController::class, 'create'])->name('mapel.create');
    Route::post('/mapel/store', [MapelController::class, 'store'])->name('mapel.store');
    Route::get('/mapel/edit/{id}', [MapelController::class, 'edit'])->name('mapel.edit');
    Route::put('/mapel/update/{id}', [MapelController::class, 'update'])->name('mapel.update');
    Route::delete('/mapel/delete/{id}', [MapelController::class, 'destroy'])->name('mapel.destroy');

    // Nilai
    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai');
    Route::get('/nilai/create', [NilaiController::class, 'create'])->name('nilai.create');
    Route::post('/nilai/store', [NilaiController::class, 'store'])->name('nilai.store');
    Route::get('/nilai/edit/{id}', [NilaiController::class, 'edit'])->name('nilai.edit');
    Route::put('/nilai/update/{id}', [NilaiController::class, 'update'])->name('nilai.update');
    Route::delete('/nilai/delete/{id}', [NilaiController::class, 'destroy'])->name('nilai.destroy');
    Route::get('/nilai/export/pdf', [NilaiController::class, 'exportPDF'])->name('nilai.export.pdf');

    // Pendaftaran (Admin)
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran'); // Hanya Admin
    Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'show'])->name('pendaftaran.show'); // Menampilkan detail
    Route::get('/pendaftaran/edit/{id}', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('/pendaftaran/update/{id}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
    Route::delete('/pendaftaran/delete/{id}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
    Route::get('/pendaftaran/export/pdf', [PendaftaranController::class, 'exportPDF'])->name('pendaftaran.export.pdf');
    Route::post('/pendaftaran/{id}/update-status', [PendaftaranController::class, 'updateStatus']);


    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==================== Include Routes Auth ====================
require __DIR__ . '/auth.php';
