<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseDetailController;
use App\Http\Controllers\CourseEnrollmentController;
use App\Http\Controllers\CourseWeekController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectSubmissionController;
use App\Http\Controllers\StudentCertificateController;
use App\Http\Controllers\ZoomController;
use App\Http\Controllers\UserListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AdminCourseController;
use App\Http\Controllers\AdminZoomController;

Route::get('/', [HomePageController::class, 'index'])->name('home');

Route::get('/course', [CourseController::class, 'index']
)->name('course');


Auth::routes();

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::post('logout', function () {
    Auth::logout();
    return redirect('/login'); 
})->name('logout');

Route::middleware(['auth', 'checkRole:student'])->prefix('/student')->group(function () {
    Route::get('/course/{id}', [CourseController::class, 'showCourseDetail'])
    ->name('course.detail');

    Route::post('/course/{id}/enroll', [CourseEnrollmentController::class, 'createEnrollment'])
        ->name('course.enroll')
        ->middleware('auth');

    Route::get('/course/{courseId}/week/start', [CourseWeekController::class, 'startWeek'])
        ->name('course.startWeek');

    Route::get('/course/week/{weekId}/materi/{materiId}', [CourseWeekController::class, 'showMateri'])
        ->name('course.showMateri');

    Route::post('/materi/{materiId}/complete', [CourseWeekController::class, 'completeMateri'])
    ->name('materi.complete');

    Route::get('/course/{courseId}/project-submission', [ProjectController::class, 'showProject'])->name('course.project');

    Route::post('/project-submission', [ProjectSubmissionController::class, 'submitProject'])->name('projectSubmission.submit');

    Route::get('/project-submission/{id}/hasil-penilaian',[ProjectSubmissionController::class,'showSubmittedProject'])->name('projectSubmission.hasil');
    
    Route::get('/certificate/{courseId}/generate', [StudentCertificateController::class, 'generateCertificate'])->name('certificate.generate');

    Route::get('/zoom-detail/{id}', [ZoomController::class,'showDetail'])->name('zoom.showDetail');
    Route::post('/zoom/{id}/register', [ZoomController::class, 'register'])
    ->name('zoom.register')
    ->middleware('auth');

    // Profile
    Route::get('/my-courses', [ProfileController::class, 'showMyCourses'])->name('profile.courses');

    Route::get('/my-schedule',[ProfileController::class, 'showMySchedule'])->name('profile.schedule');
   
});

Route::middleware(['auth', 'checkRole:lecturer'])->prefix('/lecturer')->group(function () {
    Route::get('/home', function(){
        return view('lecturer.home');
    })->name('lecturer.home');

    Route::get('/nilai-projek', function(){
        return view('lecturer.nilai-projek.nilai-projek');
    })->name('lecturer.nilai-projek');

    Route::get('/detail-nilai-projek', function(){
        return view('lecturer.nilai-projek.detail-nilai-projek');
    })->name('lecturer.detail-nilai-projek');

});

Route::middleware(['auth', 'checkRole:admin'])->prefix('/admin')->group(function () {
    Route::get('/home', function(){
        return view('admin.home');
    })->name('admin.home');


    // Manajemen Zoom
    Route::resource('/zoom', AdminZoomController::class)->names('admin.zoom');
    Route::post('/zoom/createZoom', [AdminZoomController::class, 'createZoom'])->name('admin.zoom.createZoom');
    Route::post('/courses/updateZoom/{zoomId}', [AdminZoomController::class, 'updateZoom'])->name('admin.zoom.updateZoom');


    // Manajemen Kursus
    Route::resource('/courses', AdminCourseController::class)->except(['show'])->names('admin.courses');

    Route::post('/courses/temp-store', [AdminCourseController::class, 'tempStore'])->name('admin.courses.tempStore');
    Route::post('/courses/draft', [AdminCourseController::class, 'draftCourseInformation'])->name('admin.courses.draftCourseInformation');
    Route::post('/courses/temp-syllabus', [AdminCourseController::class, 'tempSyllabus'])->name('admin.courses.tempSyllabus');
    Route::post('/courses/draftSyllabus', [AdminCourseController::class, 'draftSyllabus'])->name('admin.courses.draftSyllabus');
    Route::get('/courses/syllabus', [AdminCourseController::class, 'syllabus'])->name('admin.courses.syllabus');
    Route::get('/courses/create-project', [AdminCourseController::class, 'createProject'])->name('admin.courses.createProject');
    Route::post('/courses/saveCourse', [AdminCourseController::class, 'saveCourse'])->name('admin.courses.saveCourse');


    Route::post('/courses/temp-update-store/{courseId}', [AdminCourseController::class, 'tempUpdateStore'])->name('admin.courses.tempUpdateStore');
    Route::post('/courses/draftUpdate/{courseId}', [AdminCourseController::class, 'updateDraftCourseInformation'])->name('admin.courses.updateDraftCourseInformation');
    Route::post('/courses/temp-update-syllabus/{courseId}', [AdminCourseController::class, 'tempUpdateSyllabus'])->name('admin.courses.tempUpdateSyllabus');
    Route::post('/courses/updateDraftSyllabus/{courseId}', [AdminCourseController::class, 'updateDraftSyllabus'])->name('admin.courses.updateDraftSyllabus');
    Route::get('/courses/edit-syllabus/{courseId}', [AdminCourseController::class, 'editSyllabus'])->name('admin.courses.editSyllabus');
    Route::get('/courses/edit-project/{courseId}', [AdminCourseController::class, 'editProject'])->name('admin.courses.editProject');
    Route::post('/courses/updateCourse/{courseId}', [AdminCourseController::class, 'updateCourse'])->name('admin.courses.updateCourse');

    Route::delete('/archive/{id}', [AdminCourseController::class, 'archive'])->name('admin.courses.archive');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/profile', [ProfileController::class, 'show'])->name('my-profile');
    
    Route::get('/add-portfolio', function(){
        return view('profile.add-portfolio');
    })->name('add-portfolio');
    
    Route::post('/add-portfolio/submit', [PortfolioController::class, 'addPortfolio'])->name('portfolio.add');
    
    Route::get('/edit-portfolio/{id}',[PortfolioController::class, 'editPortfolio'])->name('portfolio.edit');
    Route::post('/update-portfolio/{id}',[PortfolioController::class, 'updatePortfolio'])->name('portfolio.update');
    
    Route::post('/add-portfolio-from-project/{id}',[PortfolioController::class, 'addFromProject'])->name('add.to.portfolio');
    
    Route::delete('/portfolio/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');

    Route::get('/my-info', [ProfileController::class,'showMyInfo'])->name('profile.info');
    Route::post('/my-info/update',[ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/update-picture',[ProfileController::class, 'updateProfilePicture'])->name('profile.updatePicture');

});

Route::get('/my-transaction-history',function(){
    return view('profile.transaction-history');
})->name('profile.history');


