<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\LandingPageController;

// student
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\ResourceController;
use App\Http\Controllers\Student\StudentDashboardController;

// counselor
use App\Http\Controllers\Counselor\CounselorDashboard;
use App\Http\Controllers\Counselor\CounselorProfileController;
use App\Http\Controllers\Counselor\CounselorAppointmentController;
use App\Http\Controllers\Counselor\CounselorResourceController;
use App\Http\Controllers\Counselor\CounselorScheduleController;

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
Route::get('/faqs', function () {
    return view('pages.faqs');
})->name('faqs');

Route::get('/', [LandingPageController::class, 'index'])->name('welcome');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->prefix('student')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');

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
    Route::get('/avatars', [StudentProfileController::class, 'getAvatars']);

    // Resources Routes
    Route::get('/resources/videos', [ResourceController::class, 'videos'])->name('student.resources.videos');
    Route::get('/resources/articles', [ResourceController::class, 'articles'])->name('student.resources.articles');
    Route::get('/resources/self-help', [ResourceController::class, 'selfHelp'])->name('student.resources.self-help');
});


Route::middleware('auth')->prefix('counselor')->group(function () {
    Route::get('/dashboard', [CounselorDashboard::class, 'dashboard'])->name('counselor.dashboard');
    Route::get('/profile', [CounselorProfileController::class, 'profile'])->name('counselor.profile');
    Route::put('/profile', [CounselorProfileController::class, 'update'])->name('counselor.profile.update');
    Route::get('/avatars', [CounselorProfileController::class, 'getAvatars']);

    Route::get('/appointments', [CounselorAppointmentController::class, 'index'])->name('counselor.appointment');
    Route::post('/appointments/{appointment}/status', [CounselorAppointmentController::class, 'updateStatus'])->name('counselor.appointments.status');
    Route::post('/appointments/{appointment}/reschedule', [CounselorAppointmentController::class, 'reschedule'])->name('counselor.appointment.reschedule');

    // Articles
    Route::get('/resources/articles', [CounselorResourceController::class, 'articles'])->name('counselor.resources.articles');
    Route::get('/resources/articles/{id}', [CounselorResourceController::class, 'showArticle'])->name('counselor.resources.articles.show');
    Route::post('/resources/articles', [CounselorResourceController::class, 'storeArticle'])->name('counselor.resources.articles.store');
    Route::put('/resources/articles/{id}', [CounselorResourceController::class, 'updateArticle'])->name('counselor.resources.articles.update');
    Route::delete('/resources/articles/{id}', [CounselorResourceController::class, 'destroyArticle'])->name('counselor.resources.articles.destroy');

    // Self-Help Tools
    Route::get('/resources/self-help', [CounselorResourceController::class, 'selfHelp'])->name('counselor.resources.self-help');
    Route::get('/resources/self-help/{id}', [CounselorResourceController::class, 'showSelfHelp'])->name('counselor.resources.self-help.show');
    Route::post('/resources/self-help', [CounselorResourceController::class, 'storeSelfHelp'])->name('counselor.resources.self-help.store');
    Route::put('/resources/self-help/{id}', [CounselorResourceController::class, 'updateSelfHelp'])->name('counselor.resources.self-help.update');
    Route::delete('/resources/self-help/{id}', [CounselorResourceController::class, 'destroySelfHelp'])->name('counselor.resources.self-help.destroy');

    // Videos
    Route::get('/resources/videos', [CounselorResourceController::class, 'videos'])->name('counselor.resources.videos');
    Route::get('/resources/videos/{id}', [CounselorResourceController::class, 'showVideo'])->name('counselor.resources.videos.show');
    Route::post('/resources/videos', [CounselorResourceController::class, 'storeVideo'])->name('counselor.resources.videos.store');
    Route::put('/resources/videos/{id}', [CounselorResourceController::class, 'updateVideo'])->name('counselor.resources.videos.update');
    Route::delete('/resources/videos/{id}', [CounselorResourceController::class, 'destroyVideo'])->name('counselor.resources.videos.destroy');

    Route::get('/schedule', [CounselorScheduleController::class, 'index'])->name('counselor.schedule');
    Route::get('/schedules', [CounselorScheduleController::class, 'fetch'])->name('counselor.schedules.fetch');
    Route::post('/schedules', [CounselorScheduleController::class, 'store'])->name('counselor.schedules.store');
    Route::patch('/schedules/{schedule}', [CounselorScheduleController::class, 'update'])->name('counselor.schedules.update');
    Route::delete('/schedules/{schedule}', [CounselorScheduleController::class, 'destroy'])->name('counselor.schedules.destroy');
}); 


// Route::get('/test-auth', function () {
//     return response()->json(['user' => Auth::check() ? Auth::user() : null]);
// });

// Route::get('/proxy-youtube/{videoId}', function ($videoId) {
//     $embedUrl = 'https://www.youtube.com/embed/' . $videoId . '?rel=0&modestbranding=1&autoplay=1';
//     return redirect($embedUrl);
// })->name('proxy.youtube');