<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function(){
    return (view('auth.login'));
})->name('login');

Auth::routes();

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
