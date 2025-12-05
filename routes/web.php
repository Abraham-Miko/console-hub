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

Route::get('/katalog', [JenisPeralatanController::class, 'katalog'])->name('katalog');

Route::get('/search', [SearchController::class, 'index']);

// Route::get('/checkout', [checkoutController::class, 'index'])->name('checkout.index');
// Route::post('/checkout', [checkoutController::class, 'process'])->name('checkout.process');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/qr/konversi/{token}', [PemesananController::class, 'downloadQrCode'])
        ->name('pemesanan.qr.konversi');

    Route::get('/api/riwayat/detail/{id}', [PemesananController::class, 'getDetailRiwayat'])
    ->name('api.riwayat.detail');

    Route::get('/histori-rental', [PemesananController::class, 'historiRental'])
        ->name('histori.index');

    Route::get('/checkout/{jenis_peralatan}', [PemesananController::class, 'showCheckoutForm'])
        ->name('pemesanan.checkout');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
    // Route CRUD
    Route::resource('/jenis_peralatan', JenisPeralatanController::class);
    Route::resource('/akun_user', UserController::class);
    Route::resource('/unit_peralatan', UnitPeralatanController::class);
    Route::resource('/pemesanan', PemesananController::class);

    Route::get('/api/verifikasi/detail/{token}', [VerifikasiController::class, 'getDetailByToken'])
    ->name('api.verifikasi.detail');

    Route::patch('/pemesanan/konfirmasi/{pemesanan}', [PemesananController::class, 'konfirmasiAksi'])
        ->name('pemesanan.serah_terima');

    Route::patch('/pemesanan/pengembalian/{pemesanan}', [PemesananController::class, 'konfirmasiAksi'])
        ->name('pemesanan.pengembalian');

    Route::get('/verifikasi-pelanggan', function () {
        return view('admin.verifikasi.verifikasi-pelanggan');
    })->name('verifikasi-pelanggan');

});

require __DIR__.'/auth.php';

