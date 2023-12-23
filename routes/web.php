<?php

use App\Http\Controllers\Akuntansi\HomeController;
use App\Http\Controllers\Akuntansi\RekeningController;
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

Route::middleware('auth', 'verified')->group(function () {
    Route::controller(ProfileController::class)->group(function(){
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::controller(RekeningController::class)->group(function(){
        Route::get('/rekening', 'index');
    });
});

require __DIR__.'/auth.php';
