<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');
Route::get('/home', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('home');

Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('dashboard');
})->name('logout');

// TODO: Buatlah Route Resource untuk Master Data Kelas
Route::resource('kelas', KelasController::class);

// TODO: Buatlah Route Resource untuk Master Data Siswa
Route::resource('siswa', SiswaController::class);


// TODO: Buatlah Route Resource untuk Master Data Guru
Route::resource('guru', GuruController::class);


// TODO: Buatlah Route Resource untuk Master Data Mata Pelajaran (Mapel)
Route::resource('mapel', MapelController::class);


// TODO: Buatlah Route Resource untuk Data Nilai Akademik
Route::resource('nilai', NilaiController::class);


