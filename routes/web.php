<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UnitPeralatanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\VerifikasiController;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\JenisPeralatanController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/verifikasi-pelanggan', function () {
    return view('admin.verifikasi.verifikasi-pelanggan');
})->middleware(['auth', 'verified'])->name('verifikasi-pelanggan');

Route::get('/katalog', function () {
    return view('layouts.katalog');
})->name('katalog');

Route::get('/checkout', function () {
    return view('layouts.checkout');
})->name('checkout');
Route::get('/histori-rental', function (Request $request) {
    return view('layouts.histori-rental');
})->name('histori-rental.index');

Route::get('/search', [SearchController::class, 'index']);

Route::get('/payment', function () {
    return view('layouts.payment');
})->name('payment');

// Route::get('/checkout', [checkoutController::class, 'index'])->name('checkout.index');
// Route::post('/checkout', [checkoutController::class, 'process'])->name('checkout.process');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route CRUD
    Route::resource('/jenis_peralatan', JenisPeralatanController::class);
    Route::resource('/akun_user', UserController::class);
    Route::resource('/unit_peralatan', UnitPeralatanController::class);
    Route::resource('/pemesanan', PemesananController::class);

    Route::get('/qr/konversi/{token}', [PemesananController::class, 'downloadQrCode'])
        ->name('pemesanan.qr.konversi');

    Route::get('/api/verifikasi/detail/{token}', [VerifikasiController::class, 'getDetailByToken'])
    ->name('api.verifikasi.detail');
    // Route Serah Terima (Ubah ke Dirental)
    Route::patch('/pemesanan/konfirmasi/{pemesanan}', [PemesananController::class, 'konfirmasiAksi'])
        ->name('pemesanan.serah_terima');

    // Route Pengembalian (Ubah ke Selesai)
    Route::patch('/pemesanan/pengembalian/{pemesanan}', [PemesananController::class, 'konfirmasiAksi'])
        ->name('pemesanan.pengembalian');
});

require __DIR__.'/auth.php';

