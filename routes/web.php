<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResidentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfilNagariController;
use App\Http\Controllers\ProfilNagariContentController;
use App\Http\Controllers\StrukturOrganisasiController;

// Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register']); 
 
// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:Admin,User'])
    ->name('dashboard');

// Resident
Route::get('/resident', [ResidentController::class, 'index'])->middleware('role:Admin');              
Route::get('/resident/create', [ResidentController::class, 'create'])->middleware('role:Admin');
Route::get('/resident/{id}/edit', [ResidentController::class, 'edit'])->middleware('role:Admin')->name('resident.edit');
Route::post('/resident', [ResidentController::class, 'store'])->middleware('role:Admin')->name('resident.store');
Route::put('/resident/{id}', [ResidentController::class, 'update'])->middleware('role:Admin');
Route::delete('/resident/{id}', [ResidentController::class, 'destroy'])->middleware('role:Admin');

// User
Route::get('/account-request', [UserController::class, 'accountRequestView'])->middleware('role:Admin')->name('account.request');
Route::post('/account-request/{id}', [UserController::class, 'approve'])->middleware('role:Admin')->name('account.approve');
Route::patch('/account-request/{id}', [UserController::class, 'reject'])->middleware('role:Admin')->name('account.reject');

// Profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
});
Route::get('/profile/change-password', [UserController::class, 'editPassword'])->name('change-password')->middleware('auth');
Route::put('/profile/change-password', [UserController::class, 'updatePassword'])->name('change-password.update')->middleware('auth');

// Complaint
Route::get('/complaint', [ComplaintController::class, 'index'])->middleware('role:Admin,User');              
Route::get('/complaint/create', [ComplaintController::class, 'create'])->middleware('role:User');
Route::get('/complaint/{id}/edit', [ComplaintController::class, 'edit'])->middleware('role:User')->name('complaint.edit');
Route::post('/complaint', [ComplaintController::class, 'store'])->middleware('role:User')->name('complaint.store');
Route::put('/complaint/{id}', [ComplaintController::class, 'update'])->middleware('role:User');
Route::delete('/complaint/{id}', [ComplaintController::class, 'destroy'])->middleware('role:User')->name('complaint.destroy');;
Route::patch('/complaint/update-status/{id}', [ComplaintController::class, 'updateStatus'])->middleware('role:Admin')->name('complaint.updateStatus');

// Profile Nagari Content
 Route::get('/profile-nagari-content', [ProfilNagariContentController::class, 'index'])->middleware('role:Admin')->name('profile-nagari-content.index');
 // Rute untuk Visi & Misi
 Route::get('/profile-nagari-content/edit-visi-misi', [ProfilNagariContentController::class, 'editVisiMisi'])->middleware('role:Admin')->name('profile-nagari-content.edit');
 Route::put('/profile-nagari-content/edit-visi-misi', [ProfilNagariContentController::class, 'updateVisiMisi'])->middleware('role:Admin')->name('profile-nagari-content.update');
 // Rute untuk Struktur Organisasi
 Route::get('/profile-nagari-content/struktur-organisasi', [ProfilNagariContentController::class, 'indexStrukturOrganisasi'])->middleware('role:Admin')->name('profilNagari.strukturOrganisasi.index');
 Route::get('/profile-nagari-content/struktur-organisasi/create', [ProfilNagariContentController::class, 'createStrukturOrganisasi'])->middleware('role:Admin')->name('profilNagari.strukturOrganisasi.create');
 Route::post('/profile-nagari-content/struktur-organisasi', [ProfilNagariContentController::class, 'storeStrukturOrganisasi'])->middleware('role:Admin')->name('profilNagari.strukturOrganisasi.store');
 Route::get('/profile-nagari-content/struktur-organisasi/{id}/edit', [ProfilNagariContentController::class, 'editStrukturOrganisasi'])->middleware('role:Admin')->name('profilNagari.strukturOrganisasi.edit');
 Route::put('/profile-nagari-content/struktur-organisasi/{id}', [ProfilNagariContentController::class, 'updateStrukturOrganisasi'])->middleware('role:Admin')->name('profilNagari.strukturOrganisasi.update');
 Route::delete('/profile-nagari-content/struktur-organisasi/{id}', [ProfilNagariContentController::class, 'destroyStrukturOrganisasi'])->middleware('role:Admin')->name('profilNagari.strukturOrganisasi.destroy');


// Beranda
Route::get('/', [LandingPageController::class, 'LandingPageView'])->name('index');

// Profil Nagari
Route::get('/profil-nagari', [ProfilNagariController::class, 'ProfilNagariView'])->name('profil-nagari');
Route::get('/perangkat-nagari', [ProfilNagariController::class, 'perangkatNagariView'])->name('perangkat-nagari'); // Rute baru