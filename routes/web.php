<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResidentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:Admin,User'])
    ->name('dashboard');

Route::get('/resident', [ResidentController::class, 'index'])->middleware('role:Admin');              
Route::get('/resident/create', [ResidentController::class, 'create'])->middleware('role:Admin');
Route::get('/resident/{id}/edit', [ResidentController::class, 'edit'])->middleware('role:Admin')->name('resident.edit');
Route::post('/resident', [ResidentController::class, 'store'])->middleware('role:Admin')->name('resident.store');
Route::put('/resident/{id}', [ResidentController::class, 'update'])->middleware('role:Admin');
Route::delete('/resident/{id}', [ResidentController::class, 'destroy'])->middleware('role:Admin');

Route::get('/account-request', [UserController::class, 'accountRequestView'])->middleware('role:Admin')->name('account.request');
Route::post('/account-request/{id}', [UserController::class, 'approve'])->middleware('role:Admin')->name('account.approve');
Route::patch('/account-request/{id}', [UserController::class, 'reject'])->middleware('role:Admin')->name('account.reject');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
});
Route::get('/profile/change-password', [UserController::class, 'editPassword'])->name('change-password')->middleware('auth');
Route::put('/profile/change-password', [UserController::class, 'updatePassword'])->name('change-password.update')->middleware('auth');

Route::get('/', [LandingPageController::class, 'LandingPageView'])->name('index');