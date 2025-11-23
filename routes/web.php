<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanPublikController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\Auth\OtpLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $total = \App\Models\Laporan::count();
    $pending = \App\Models\Laporan::where('status','pending')->count();
    $selesai = \App\Models\Laporan::where('status','selesai')->count();
    return view('welcome', compact('total','pending','selesai'));
});

// Landing sub pages
Route::get('/statistik', function () {
    $total = \App\Models\Laporan::count();
    $pending = \App\Models\Laporan::where('status','pending')->count();
    $selesai = \App\Models\Laporan::where('status','selesai')->count();
    return view('landing.statistik', compact('total','pending','selesai'));
})->name('statistik');

Route::get('/tentang', function () {
    return view('landing.tentang');
})->name('tentang');

Route::get('/kontak', function () {
    return view('landing.kontak');
})->name('kontak');

// Dashboard (tampilkan daftar laporan milik user terverifikasi)
Route::get('/dashboard', [App\Http\Controllers\LaporanPublikController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Hindari mendefinisikan ulang route 'dashboard' tanpa middleware verified.
    Route::get('/laporan-saya', [LaporanPublikController::class, 'myReports'])->name('laporan.saya');
    Route::get('/lapor', [LaporanPublikController::class, 'create'])->name('lapor.create');
    Route::post('/lapor', [LaporanPublikController::class, 'store'])->name('lapor.store');
    Route::delete('/lapor/{laporan}', [LaporanPublikController::class, 'destroy'])->name('laporan.destroy');

    // Admin panel biasa: laporan masuk & aksi (gunakan gate sederhana)
    Route::middleware('admin.only')->group(function(){
        Route::get('/laporan-masuk', [AdminLaporanController::class,'index'])->name('admin.laporan.masuk');
        Route::post('/laporan/{laporan}/approve-assign', [AdminLaporanController::class,'approveAssign'])->name('admin.laporan.approveAssign');
        Route::post('/laporan/{laporan}/start', [AdminLaporanController::class,'startWork'])->name('admin.laporan.start');
        Route::post('/laporan/{laporan}/finish', [AdminLaporanController::class,'finish'])->name('admin.laporan.finish');
    });
});

Route::get('peng', function () {
    return view('dpengguna');
});

Route::get('Laporan', function () {
    return view('laporan');
});

Route::get('daur', function () {
    return view('daurulang');
});

Route::get('progress', function () {
    return view('progress');
});

require __DIR__.'/auth.php';

// OTP login routes
Route::get('/login/otp', [OtpLoginController::class,'show'])->name('otp.form');
Route::post('/login/otp/verify', [OtpLoginController::class,'verify'])->name('otp.verify');
Route::post('/login/otp/resend', [OtpLoginController::class,'resend'])->name('otp.resend');
