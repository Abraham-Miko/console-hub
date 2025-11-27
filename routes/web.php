<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UnitMobilController;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\JenisMobilController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/verifikasi-pelanggan', function () {
    return view('admin.verifikasi-pelanggan');
})->middleware(['auth', 'verified'])->name('verifikasi-pelanggan');

route::get('/katalog', function () {
    return view('layouts.katalog');
})->name('katalog');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route CRUD
    Route::resource('/jenis_mobil', JenisMobilController::class);
    Route::resource('/akun_user', UserController::class);
    Route::resource('/unit_mobil', UnitMobilController::class);
});

require __DIR__.'/auth.php';

