<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController; 



// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/student', function () {
//     return view('student');
// });

Route::get('/user', [UserController::class, 'index']);
Route::get('/student', [StudentController::class, 'index']); 
