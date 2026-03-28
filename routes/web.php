<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



//Guest Route
Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

//Dashboard Route
Route::get('/dashboard',[DashboardController::class,'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

// User Profile Routs
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // User Routes
    Route::get('/show-user',[UserController::class, 'show'])->name('show.user');
});

Route::middleware('auth')->group(function () {

    // User Routes
    Route::get('/edit-user/{id}',[UserController::class, 'edit'])->name('edit.user');
    Route::patch('/edit-user/{user}',[UserController::class, 'update'])->name('update.user');
    Route::delete('/delete-user/{user}', [UserController::class, 'destroy'])->name('delete.user');
});

Route::middleware(['auth'])->group(function () {

// Instructor Routes
Route::resource('instructors', InstructorController::class);

// Courses Routes
Route::resource('courses',CourseController::class);

// Students Routes
Route::resource('students',StudentController::class);

// Invoices Routes
Route::resource('invoices',InvoiceController::class);
Route::get('/invoices/{invoice}/preview', [InvoiceController::class, 'previewInvoice'])->name('invoices.preview');
Route::post('invoices/{invoice}/pay',[InvoiceController::class,'addPayment'])->name('invoices.pay');
Route::get('invoices/{invoice}/download',[InvoiceController::class,'downloadPdf'])->name('invoices.download');

// Attendance And Sessions
Route::resource('sessions', CourseSessionController::class);
Route::get('/sessions/{session}/end', [CourseSessionController::class, 'endSession'])->name('sessions.end');
Route::get('/sessions/{session}/attendance', [AttendanceController::class, 'create'])->name('attendance.create');
Route::post('/sessions/{session}/attendance', [AttendanceController::class, 'store'])->name('attendance.store');

// Reports Routs
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');
Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');
});
require __DIR__.'/auth.php';
