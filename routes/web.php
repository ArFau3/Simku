<?php

use App\Http\Controllers\Akuntansi\AktivitasController;
use App\Http\Controllers\Akuntansi\AkuntanController;
use App\Http\Controllers\Akuntansi\BukuBesarController;
use App\Http\Controllers\Akuntansi\GrafikController;
use App\Http\Controllers\Akuntansi\HomeController;
use App\Http\Controllers\Akuntansi\JurnalUmumController;
use App\Http\Controllers\Akuntansi\LabaRugiController;
use App\Http\Controllers\Akuntansi\NeracaController;
use App\Http\Controllers\Akuntansi\PerubahanModalController;
use App\Http\Controllers\Akuntansi\RekeningController;
use App\Http\Controllers\Akuntansi\TBSController;
use App\Http\Controllers\Akuntansi\TransaksiController;
use App\Http\Controllers\Akuntansi\TutupBukuController;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\KoperasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Supplier\AngkutanController;
use App\Http\Controllers\Supplier\BerandaController;
use App\Http\Controllers\Supplier\PanenController;
use App\Http\Controllers\Supplier\PetaniController;
use App\Http\Controllers\Supplier\PupukController;
use App\Http\Controllers\Supplier\SawitController;
use App\Http\Controllers\Supplier\SuratJalanController;
use App\Http\Controllers\Supplier\SuratKonfirmasiController;
use App\Http\Controllers\Supplier\VarietasController;
use Illuminate\Support\Facades\Route;

// TODO: Async programming & caching data

Route::get('/', function () {
    return view('welcome');
});

// HACK: redirect user with !== roles access
Route::get('/gateway', [GatewayController::class, 'index'])->middleware(['auth', 'verified']);

// SISTEM AKUNTANSI
// USER: Akuntan & Pengurus
Route::middleware(['auth', 'verified', 'role:akuntan|pengurus'])->group(function () {
    Route::controller(App\Http\Controllers\Akuntansi\ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profil.edit');
        // HACK: perlu route model binding ?
        Route::get('/profile/updateHp', 'updateHp');
        Route::get('/profile/kodeOTP', 'kodeOTP');
        Route::patch('/profile', 'update')->name('profil.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::get('/grafik', [GrafikController::class, 'index']);

    Route::controller(RekeningController::class)->group(function () {
        Route::get('/rekening', 'index');
    });

    Route::controller(TransaksiController::class)->group(function () {
        Route::get('/transaksi', 'indexTransaksi');
        Route::get('/transaksi/download', 'downloadTransaksi');

        Route::get('/inventaris', 'indexInventaris');
        Route::get('/inventaris/download', 'downloadInventaris');
    });

    Route::controller(TutupBukuController::class)->group(function () {
        Route::get('/tutup-buku', 'index');
    });

    Route::controller(JurnalUmumController::class)->group(function () {
        Route::get('/jurnal-umum', 'index');
        Route::get('/jurnal-umum/download', 'download');
    });

    Route::controller(BukuBesarController::class)->group(function () {
        Route::get('/buku-besar', 'index');
        Route::get('/buku-besar/download', 'download');
    });

    Route::controller(LabaRugiController::class)->group(function () {
        Route::get('/laba-rugi', 'index');
        Route::get('/laba-rugi/download', 'download');
    });

    Route::controller(NeracaController::class)->group(function () {
        Route::get('/neraca', 'index');
        Route::get('/neraca/download', 'download');
    });

    Route::controller(PerubahanModalController::class)->group(function () {
        Route::get('/perubahan-modal', 'index');
    });

    Route::controller(TBSController::class)->group(function () {
        Route::get('/penjualan-tbs', 'index');
        Route::get('/penjualan-tbs/pilih-rekening', 'tautkanIndex');
        Route::post('/penjualan-tbs/tautkan/{id}', 'tautkan')->whereNumber('id');
        Route::delete('/penjualan-tbs/hapus/{id}', 'delete')->whereNumber('id');
        Route::get('/penjualan-tbs/download', 'download');
    });

    Route::controller(AktivitasController::class)->group(function () {
        Route::get('/aktivitas', 'index');
        Route::get('/aktivitas-rekening/{id}', 'historyRekening')->whereNumber('id');
        Route::get('/aktivitas-transaksi/{id}', 'historyTransaksi')->whereNumber('id');
    });
});
#TODO: buat sistem download data sebagai pdf di data yg bisa di download
// USER: Akuntan
Route::middleware(['auth', 'verified', 'role:akuntan'])->group(function () {
    Route::controller(RekeningController::class)->group(function () {
        Route::get('/rekening/{id}', 'edit')->whereNumber('id');
        Route::post('/rekening/update/{id}', 'update')->whereNumber('id');
        Route::get('/rekening/tambah', 'tambah');
        Route::post('/rekening/tambah/simpan', 'store');
        // QOL: soft deleting with rollback
        Route::delete('/rekening/hapus/{id}', 'delete')->whereNumber('id');
        // HACK: DEBUG: cek sistem download
        // Route::get('/downloadPDF','downloadPDF');
    });

    Route::controller(TutupBukuController::class)->group(function () {
        Route::get('/tutup-buku/pilih-tanggal', 'pilihTanggal');
        Route::post('/lakukan-tutup-buku', 'tambah');
        Route::post('/tutup-buku/selesaikan', 'store');
        Route::delete('/tutup-buku/hapus/{id}', 'delete')->whereNumber('id');
    });
    
    // HACK: DEBUG Download system
    Route::get('/downloadPDF', [RekeningController::class, 'downloadPDF']);

    Route::controller(TransaksiController::class)->group(function () {
        Route::get('/transaksi/{id}', 'edit')->whereNumber('id');
        Route::post('/transaksi/update/{id}', 'update')->whereNumber('id');
        Route::get('/transaksi/tambah', 'tambah');
        Route::post('/transaksi/tambah/simpan', 'store');
        // QOL: soft deleting with rollback
        Route::delete('/transaksi/hapus/{id}', 'delete')->whereNumber('id');
    });
});

// USER: Pengurus
Route::middleware(['auth', 'verified', 'role:pengurus'])->group(function () {
    Route::controller(KoperasiController::class)->group(function () {
        // Pengaturan Koperasi
        Route::get('/pengaturan-koperasi', 'edit');
        Route::post('koperasi/update/{id}', 'update')->whereNumber('id'); //TODO: ganti slug
    });

    Route::controller(AkuntanController::class)->group(function () {
    // TODO: buat logic dan UI
    // TODO: siapkan sistem tambah dan hapus akuntan
        Route::get('/pengaturan-akuntan', 'index'); //daftar akuntan
        Route::get('/Akuntan/tambah', 'tambah'); //tambah akuntan
        Route::post('/akuntan/tambah/simpan', 'store'); //simpan tambahan akuntan
        Route::delete('/akuntan/hapus/{id}', 'delete')->whereNumber('id'); //hapus akuntan
        //TODO: jika tambah maka cek untuk akuntan baru, jika hapus cek di nomor ketua
        Route::get('/profile/kodeOTP', 'kodeOTP'); //untuk konfirm akuntan baru pakai kode otp 

    }); 
});

// HACK: sementara for dev
Route::middleware('auth', 'verified')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profil', 'edit')->name('profile.edit');
        Route::post('/profil', 'update')->name('profile.update');
        Route::delete('/profil', 'destroy')->name('profile.destroy');
    });
});
// END SEMENTARA

require __DIR__ . '/auth.php';

// SISTEM SUPPLIER
// USER: Akuntan & Pengurus
Route::middleware(['auth', 'verified', 'role:petugas|pengurus'])->group(function () {
    Route::get('/beranda', [BerandaController::class, 'index']);// Halaman Beranda
    Route::get('/petani', [PetaniController::class, 'index']);// Halaman Petani
    Route::get('/panen', [PanenController::class, 'index']);// Halaman Hasil Panen
    Route::get('/sawit', [SawitController::class, 'index']);// Halaman Harga Sawit
    Route::get('/angkutan', [AngkutanController::class, 'index']);// Halaman Angkutan
    Route::get('/varietas', [VarietasController::class, 'index']);// Halaman Jenis Varietas
    Route::get('/pupuk', [PupukController::class, 'index']);// Halaman Jenis Pupuk
    // FIXME: route bentrok
    // Route::get('/transaksi', [TransaksiController::class, 'index']);// Halaman Data Transaksi
    Route::get('/suratjalan', [SuratJalanController::class, 'index']);// Halaman Data Surat Jalan
    Route::get('/suratkonfirmasi', [SuratKonfirmasiController::class, 'index']);// Halaman Surat Konfirmasi Perusahaan
});
