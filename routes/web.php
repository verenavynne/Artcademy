<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function(){
    return (view('auth.login'));
})->name('login');

Route::get('/register', function(){
    return (view('auth.register'));
})->name('register');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
