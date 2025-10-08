<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;

// student
use App\Http\Controllers\Student\StudentProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->prefix('student')->group(function () {
    Route::get('/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');

    Route::get('/appointments', [AppointmentController::class, 'index'])->name('student.appointments');
    Route::get('/appointments/book', [AppointmentController::class, 'create'])->name('student.appointments.book');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('student.appointments.store');
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('student.appointments.show');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('student.appointments.destroy');
    Route::post('/student/appointments/{appointment}/receive', [AppointmentController::class, 'receive'])->name('student.appointments.receive');
Route::post('/student/appointments/{appointment}/complete', [AppointmentController::class, 'complete'])->name('student.appointments.complete');

    Route::get('/profile', [StudentProfileController::class, 'show'])->name('student.profile');
    Route::get('/profile/edit', [StudentProfileController::class, 'edit'])->name('student.profile.edit');
    Route::post('/profile', [StudentProfileController::class, 'update'])->name('student.profile.update');
});

Route::middleware('auth')->prefix('counselor')->group(function () {
    Route::get('/dashboard', function () {
        return view('counselor.dashboard');
    })->name('counselor.dashboard');
});