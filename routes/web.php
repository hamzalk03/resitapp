<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\InstructorAuthController;
use App\Http\Controllers\SecretaryAuthController;
use App\Http\Controllers\SecretaryController;

// Route::get('/', function () {
//     return view('home');
// })->name('home');
Route::get('/', function () {
    return view('login');
})->name('login');

// Student Routes
Route::prefix('student')->group(function () {
    Route::get('/courses', [StudentController::class, 'index'])->name('student.courses');
    Route::post('/courses/{course}/resit/request', [StudentController::class, 'requestResitExam'])->name('student.resit.request');
    Route::get('/courses/{course}/announcements', [StudentController::class, 'showCourseAnnouncements'])->name('student.course.announcements');

    Route::get('/login', [StudentAuthController::class, 'loginIndex'])->name('student.login');
    Route::post('/login', [StudentAuthController::class, 'Login'])->name('student.login.submit');
    Route::post('/logout', [StudentAuthController::class, 'logout'])->name('student.logout');
});

// Instructor Routes
Route::prefix('instructor')->group(function () {
    Route::get('/courses', [InstructorController::class, 'index'])->name('instructor.courses');
    Route::post('/courses/{course}/grades/upload', [InstructorController::class, 'uploadGrades'])->name('instructor.grades.upload');
    Route::get('/courses/{course}/resit-exams', [InstructorController::class, 'resitExamList'])->name('instructor.resit.exams');
    Route::get('/courses/{course}/announcement', [InstructorController::class, 'showAnnouncementForm'])->name('instructor.announcement.form');
    Route::post('/courses/{course}/announcement', [InstructorController::class, 'storeAnnouncement'])->name('instructor.announcement.store');
    Route::get('/courses/{course}/announcements', [InstructorController::class, 'showCourseAnnouncements'])->name('instructor.course.announcements');

    Route::get('/login', [InstructorAuthController::class, 'loginIndex'])->name('instructor.login');
    Route::post('/login', [InstructorAuthController::class, 'Login'])->name('instructor.login.submit');
    Route::post('/logout', [InstructorAuthController::class, 'logout'])->name('instructor.logout');
});


Route::prefix('secretary')->group(function () {
    Route::get('/courses', [SecretaryController::class, 'index'])->name('secretary.courses');
    Route::get('/courses/{course}/announcement', [SecretaryController::class, 'showAnnouncementForm'])->name('secretary.announcement.form');
    Route::post('/courses/{course}/announcement', [SecretaryController::class, 'storeAnnouncement'])->name('secretary.announcement.store');
    Route::get('/courses/{course}/announcements', [SecretaryController::class, 'showCourseAnnouncements'])->name('secretary.course.announcements');


    Route::get('/login', [SecretaryAuthController::class, 'loginIndex'])->name('secretary.login');
    Route::post('/login', [SecretaryAuthController::class, 'Login'])->name('secretary.login.submit');
    Route::post('/logout', [SecretaryAuthController::class, 'logout'])->name('secretary.logout');
});

