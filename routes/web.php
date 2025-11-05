<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanPublikController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [LaporanPublikController::class, 'index'])->name('dashboard');
    Route::get('/lapor', [LaporanPublikController::class, 'create'])->name('lapor.create');
    Route::post('/lapor', [LaporanPublikController::class, 'store'])->name('lapor.store');
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

require __DIR__.'/auth.php';
