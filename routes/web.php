<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/aboutus', function () {
    return view('aboutus');
});

Route::get('/jobs', function () {
    return view('jobs');
});

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup.form');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.submit');

Route::get('/signin', [AuthController::class, 'showLoginForm'])->name('signin');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/worker/dashboard', function () {
    return view('worker.dashboard'); // Create this view
})->name('worker.dashboard');

Route::get('/company/dashboard', function () {
    return view('company.dashboard'); // Create this view
})->name('company.dashboard');

Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
