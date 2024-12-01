<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\WorkerController;

Route::get('/', function () {
    return view('index');
});

Route::get('/aboutus', function () {
    return view('aboutus');
});

Route::get('/jobs', function () {
    return view('jobs');
});

Route::get('/login', function () {
    return redirect()->route('signin');
});

// Public routes
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup.form');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.submit');
Route::get('/signin', [AuthController::class, 'showLoginForm'])->name('signin'); // For displaying login form
Route::post('/login', [AuthController::class, 'login'])->name('login'); // For processing login

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/company/dashboard', [CompanyController::class, 'companyDashboard'])->name('company.dashboard');
    Route::get('/company/profile', [CompanyController::class, 'showProfile'])->name('profile');
    Route::post('/company/profile', [CompanyController::class, 'updateProfile'])->name('profile.update.company');
    Route::post('/company/profile/update-password', [CompanyController::class, 'companyUpdatePassword'])->name('company.profile.update.password');
    Route::get('/company/kelolajobs', [CompanyController::class, 'jobs'])->name('company.jobs');
    Route::post('/company/kelolajobs', [CompanyController::class, 'store'])->name('jobs.store');
    Route::get('/company/kelolajobs/{id}/edit', [CompanyController::class, 'edit'])->name('jobs.edit');
    Route::post('/company/kelolajobs/update/{id}', [CompanyController::class, 'update'])->name('jobs.update');
    Route::delete('/company/kelolajobs/delete/{id}', [CompanyController::class, 'delete'])->name('jobs.delete');
    Route::get('/company/datapelamar', [CompanyController::class, 'pelamar'])->name('pelamar');
    Route::get('/company/datapelamar/detail/{id}', [CompanyController::class, 'detail'])->name('pelamar.detail');
    Route::get('/storage/{filename}', [CompanyController::class, 'showPdf'])->name('cv.show');
    Route::post('/process/application/{id}', [CompanyController::class, 'processApplication'])->name('process.application');

    Route::get('/worker/dashboard', [WorkerController::class, 'workerDashboard'])->name('worker.dashboard'); 
    Route::get('/worker/jobs', [WorkerController::class, 'workerJobs'])->name('worker.jobs'); 
    Route::get('/worker/jobs/{id}', [WorkerController::class, 'showWorkerJobs'])->name('worker.jobs.show');
    Route::post('/apply/job/{id}', [WorkerController::class, 'apply'])->name('apply.job');
    Route::get('/worker/aboutus', [WorkerController::class, 'workerAboutus'])->name('worker.aboutus'); 
    Route::get('/worker/lamaran', [WorkerController::class, 'workerLamaran'])->name('worker.lamaran'); 
    Route::get('/worker/lamaran/{id_lamar}/status', [WorkerController::class, 'getStatusDetail'])->name('worker.lamaran.status');
    Route::get('/worker/profile', [WorkerController::class, 'workerProfile'])->name('worker.profile'); 
    Route::post('/worker/profile', [WorkerController::class, 'workerProfileUpdate'])->name('profile.update.worker');
    Route::post('/profile/update-password', [WorkerController::class, 'updatePassword'])->name('profile.worker.update.password'); 
    Route::post('/worker/education', [WorkerController::class, 'workerStoreEducation'])->name('worker.education.store'); // Store
    Route::post('/worker/education/update/{id}', [WorkerController::class, 'workerUpdateEducation'])->name('worker.education.update');
    Route::delete('/worker/education/delete/{id}', [WorkerController::class, 'workerDestroyEducation'])->name('worker.education.destroy');
    Route::post('/worker/skills/store', [WorkerController::class, 'storeSkills'])->name('worker.skills.store');
    Route::delete('/worker/skills/delete/{id}', [WorkerController::class, 'deleteSkill'])->name('worker.skills.delete');
    

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});