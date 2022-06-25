<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailNilaiController;
use App\Http\Controllers\GenerateLaporanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::prefix('user')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('manage.user');
        Route::get('/create', [UserController::class, 'create'])->name('manage.user.create');
        Route::post('/', [UserController::class, 'store'])->name('manage.user.store');
        Route::post('/delete', [UserController::class, 'delete'])->name('manage.user.delete');
    });

    Route::prefix('siswa')->group(function() {
        Route::get('/', [SiswaController::class, 'index'])->name('manage.siswa');
        Route::get('/create', [SiswaController::class, 'create'])->name('manage.siswa.create');
        Route::post('/store', [SiswaController::class, 'store'])->name('manage.siswa.store');
        Route::get('/edit/{no_induk}', [SiswaController::class, 'edit'])->name('manage.siswa.edit');
        Route::post('/update', [SiswaController::class, 'update'])->name('manage.siswa.update');
        Route::get('/delete/{no_induk}', [SiswaController::class, 'delete'])->name('manage.siswa.delete');
        Route::get('/{no_induk}', [SiswaController::class, 'detail'])->name('manage.siswa.detail');
    });

    Route::prefix('detail_nilai')->group(function() {
        Route::get('/', [DetailNilaiController::class, 'index'])->name('manage.detail_nilai');
        Route::get('/edit/{no_induk}/{tahun_ajaran}/{kelas}', [DetailNilaiController::class, 'edit'])->name('manage.detail_nilai.edit');
        Route::post('/{no_induk}/{tahun_ajaran}/{kelas}', [DetailNilaiController::class, 'update'])->name('manage.detail_nilai.update');
    });

    Route::prefix('generate_laporan')->group(function() {
        Route::get('/', [GenerateLaporanController::class, 'index'])->name('manage.generate_laporan');
        Route::post('/generate', [GenerateLaporanController::class, 'generate'])->name('manage.generate_laporan.generate');
    });

    Route::prefix('laporan')->group(function() {
        Route::get('/', [LaporanController::class, 'index'])->name('manage.laporan');
    });
});
