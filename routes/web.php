<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseDetailController;
use App\Http\Controllers\CourseEnrollmentController;
use App\Http\Controllers\CourseWeekController;
use App\Http\Controllers\ZoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AdminCourseController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::post('logout', function () {
    Auth::logout();
    return redirect('/login'); 
})->name('logout');

Route::middleware(['auth', 'checkRole:student'])->prefix('/student')->group(function () {
    Route::get('/home', function(){
        return view('student.home');
    })->name('student.home');
});

Route::middleware(['auth', 'checkRole:lecturer'])->prefix('/lecturer')->group(function () {
    Route::get('/home', function(){
        return view('lecturer.home');
    })->name('lecturer.home');
});

Route::middleware(['auth', 'checkRole:admin'])->prefix('/admin')->group(function () {
    Route::get('/home', function(){
        return view('admin.home');
    })->name('admin.home');

    Route::resource('/courses', AdminCourseController::class)->names('admin.courses');

    Route::post('/courses/draft', [AdminCourseController::class, 'draftCourseInformation'])->name('admin.courses.draftCourseInformation');
    Route::post('/courses/{course}/save-syllabus', [AdminCourseController::class, 'saveSyllabus'])->name('admin.courses.saveSyllabus');
    Route::get('/courses/{course}/syllabus', [AdminCourseController::class, 'syllabus'])->name('admin.courses.syllabus');

});


Route::get('/course', [CourseController::class, 'index']
)->name('course');

Route::get('/course/{id}', [CourseController::class, 'showCourseDetail'])
    ->name('course.detail');

Route::post('/course/{id}/enroll', [CourseEnrollmentController::class, 'createEnrollment'])
    ->name('course.enroll')
    ->middleware('auth');

Route::post('/zoom/{id}/register', [ZoomController::class, 'register'])
    ->name('zoom.register')
    ->middleware('auth');

Route::get('/course-week', function() {
    return view('Artcademy.course-week-vbl');
})->name('course-week');

Route::get('/course/{courseId}/week/start', [CourseWeekController::class, 'startWeek'])
    ->name('course.startWeek');

Route::get('/course/week/{weekId}/materi/{materiId}', [CourseWeekController::class, 'showMateri'])
    ->name('course.showMateri');

Route::post('/materi/{materiId}/complete', [CourseWeekController::class, 'completeMateri'])
->name('materi.complete');

Route::get('/project-submission', function () {
    return view('Artcademy.course-project-submission');
})->name('course.project');

