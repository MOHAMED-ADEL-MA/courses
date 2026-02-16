<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // User Routes
    Route::get('/show-user',[UserController::class, 'show'])->name('show.user');
});

Route::middleware(['auth','admin'])->group(function () {
    
    // User Routes
    Route::get('/edit-user/{id}',[UserController::class, 'edit'])->name('edit.user');
    Route::patch('/edit-user/{user}',[UserController::class, 'update'])->name('update.user');
    Route::delete('/delete-user/{user}', [UserController::class, 'destroy'])->name('delete.user');
});

// Instructor Routes
Route::resource('instructors', InstructorController::class);

// Courses Routes
Route::resource('courses',CourseController::class);

// Students Routes
Route::resource('students',StudentController::class);

// Invoices Routes
Route::resource('invoices',InvoiceController::class);

require __DIR__.'/auth.php';
