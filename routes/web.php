<?php

use App\Http\Controllers\Akuntansi\AktivitasController;
use App\Http\Controllers\Akuntansi\BukuBesarController;
use App\Http\Controllers\Akuntansi\HomeController;
use App\Http\Controllers\Akuntansi\JurnalUmumController;
use App\Http\Controllers\Akuntansi\LabaRugiController;
use App\Http\Controllers\Akuntansi\NeracaController;
use App\Http\Controllers\Akuntansi\RekeningController;
use App\Http\Controllers\Akuntansi\TransaksiInventarisController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// SISTEM AKUNTANSI
    // USER: Akuntan & Pengurus
Route::middleware(['auth', 'verified', 'role:akuntan|pengurus'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::controller(RekeningController::class)->group(function(){
        Route::get('/rekening', 'index');
    });

    Route::controller(TransaksiInventarisController::class)->group(function(){
        Route::get('/transaksi', 'indexTransaksi');

        Route::get('/inventaris', 'indexInventaris');
    });

    Route::controller(JurnalUmumController::class)->group(function(){
        Route::get('/jurnal-umum', 'index');
    });

    Route::controller(BukuBesarController::class)->group(function(){
        Route::get('/buku-besar', 'index');
    });

    Route::controller(LabaRugiController::class)->group(function(){
        Route::get('/laba-rugi', 'index');
    });

    Route::controller(NeracaController::class)->group(function(){
        Route::get('/neraca', 'index');
    });

    Route::controller(AktivitasController::class)->group(function(){
        Route::get('/aktivitas', 'index');
    });
});

    // USER: Akuntan
Route::middleware(['auth', 'verified', 'role:akuntan'])->group(function () {
    Route::controller(RekeningController::class)->group(function(){
        Route::get('/rekening/tambah', 'tambah');
    });

    Route::controller(TransaksiInventarisController::class)->group(function(){
        Route::get('/transaksi/tambah', 'tambah');
    });
});

// SEMENTARA
Route::middleware('auth', 'verified')->group(function () {
    Route::controller(ProfileController::class)->group(function(){
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});
// END SEMENTARA

require __DIR__.'/auth.php';
