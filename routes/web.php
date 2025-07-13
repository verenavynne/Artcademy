<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;

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
});
