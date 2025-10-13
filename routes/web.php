<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;

// student
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\ResourceController;

// counselor
use App\Http\Controllers\Counselor\CounselorDashboard;
use App\Http\Controllers\Counselor\CounselorProfileController;
use App\Http\Controllers\Counselor\CounselorAppointmentController;

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

    // profile
    Route::get('/profile', [StudentProfileController::class, 'show'])->name('student.profile');
    Route::get('/profile/edit', [StudentProfileController::class, 'edit'])->name('student.profile.edit');
    Route::put('/profile', [StudentProfileController::class, 'update'])->name('student.profile.update');

    // Resources Routes
    Route::get('/resources/videos', [ResourceController::class, 'videos'])->name('student.resources.videos');
    Route::get('/resources/articles', [ResourceController::class, 'articles'])->name('student.resources.articles');
    Route::get('/resources/self-help', [ResourceController::class, 'selfHelp'])->name('student.resources.self-help');
});

Route::middleware('auth')->prefix('counselor')->group(function () {
    Route::get('/dashboard', [CounselorDashboard::class, 'dashboard'])->name('counselor.dashboard');
    Route::get('/profile', [CounselorProfileController::class, 'profile'])->name('counselor.profile');
    Route::put('/profile', [CounselorProfileController::class, 'update'])->name('counselor.profile.update');

    // Route::get('/appointments', [CounselorAppointmentController::class, 'index'])->name('counselor.appointment');
    // Route::post('/appointments/{appointment}/status', [CounselorAppointmentController::class, 'updateStatus'])->name('appointment.status');
    // Route::post('/appointments/{appointment}/reschedule', [CounselorAppointmentController::class, 'reschedule'])->name('appointment.reschedule');

    Route::get('/appointments', [CounselorAppointmentController::class, 'index'])->name('counselor.appointment');
    Route::post('/appointments/{appointment}/status', [CounselorAppointmentController::class, 'updateStatus'])->name('counselor.appointments.status');
    Route::post('/appointments/{appointment}/reschedule', [CounselorAppointmentController::class, 'reschedule'])->name('counselor.appointments.reschedule');
}); 