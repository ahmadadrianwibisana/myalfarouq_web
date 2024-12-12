<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DataAdministrasiController;
use App\Http\Controllers\Admin\OpenTripController;
use App\Http\Controllers\Admin\PrivateTripController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\PemesananController;
use App\Http\Controllers\AdminBesar\AdminBesarController;
use App\Http\Controllers\AdminBesar\ArtikelController;
use App\Http\Controllers\AdminBesar\LaporanController;
use App\Http\Controllers\AdminBesar\RiwayatController;
use App\Http\Controllers\User\UserController;
use App\Models\Riwayat;
use Symfony\Component\VarDumper\Cloner\Data;

// Route untuk tamu (guest) -> login dan register
Route::group(['middleware' => 'guest'], function () {

    // Halaman Home
    Route::get('/', function () {
        return view('home');  // pastikan Anda memiliki file resources/views/home.blade.php
    })->name('home');
    
    // Halaman Open Trip
    Route::get('/opentrip', function () {
        return view('opentrip');  // pastikan Anda memiliki file resources/views/opentrip.blade.php
    })->name('opentrip');
    
    // Halaman Private Trip
    Route::get('/privatetrip', function () {
        return view('privatetrip');  // pastikan Anda memiliki file resources/views/privatetrip.blade.php
    })->name('privatetrip');
    
    // Halaman Artikel
    Route::get('/dokumen', function () {
        return view('dokumen');  // pastikan Anda memiliki file resources/views/artikel.blade.php
    })->name('dokumen');
    
    // Halaman Profil Kami
    Route::get('/profil-kami', function () {
        return view('profil-kami');  // pastikan Anda memiliki file resources/views/profil-kami.blade.php
    })->name('profil.kami');
    
    // Halaman Tentang Kami
    Route::get('/tentang-kami', function () {
        return view('tentang-kami');  // pastikan Anda memiliki file resources/views/tentang-kami.blade.php
    })->name('tentang.kami');

    // Halaman Detail
    Route::get('/detail', function () {
        return view('detail');  // pastikan Anda memiliki file resources/views/tentang-kami.blade.php
    })->name('detail');

    // Halaman Detail Open trip
    Route::get('/detailopen', function () {
        return view('detailopen');  
    })->name('detailopen');
    

    
    
    // Halama Login Admin
    Route::get('/login-admin', function () {
        return view('welcome'); // Halaman utama
    })->name('welcome');

    // Login Route
    Route::get('/login', function () {
        return view('login');  // pastikan Anda memiliki file resources/views/login.blade.php
    })->name('login');
    

    // register user
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/post-register', [AuthController::class, 'post_register'])->name('post.register');

    Route::post('/post-login', [AuthController::class, 'login'])->name('post.login');
});


// Grouping admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('open_trip', OpenTripController::class);
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('private_trip', PrivateTripController::class);
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('data_administrasi', DataAdministrasiController::class);
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('pemesanan', PemesananController::class);
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('pembayaran', PembayaranController::class);
    });

// Route untuk admin -> dashboard admin
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard'); // Halaman dashboard admin

    // Open Trip
    Route::get('/open_trip', [OpenTripController::class, 'index'])->name('admin.open_trip');
    Route::get('/admin/open_trip/create', [OpenTripController::class, 'create'])->name('admin.open_trip.create');
    Route::post('/admin/open_trip/store', [OpenTripController::class, 'store'])->name('admin.open_trip.store');
    Route::get('/admin/open-trip/{id}', [OpenTripController::class, 'detail'])->name('admin.open_trip.detail');
    Route::get('/admin/open_trip/{id}/edit', [OpenTripController::class, 'edit'])->name('admin.open_trip.edit');
    Route::put('/admin/open_trip/{id}', [OpenTripController::class, 'update'])->name('admin.open_trip.update');
    Route::delete('/admin/open_trip/{id}', [OpenTripController::class, 'destroy'])->name('admin.open_trip.delete');


     // Private Trip
    Route::get('/private_trip', [PrivateTripController::class, 'index'])->name('admin.private_trip');
    Route::get('/admin/private_trip/create', [PrivateTripController::class, 'create'])->name('admin.private_trip.create');
    Route::post('/admin/private_trip/store', [PrivateTripController::class, 'store'])->name('admin.private_trip.store');
    Route::get('/admin/private_trip/{id}', [PrivateTripController::class, 'show'])->name('admin.private_trip.show');
    Route::get('admin/private_trip/{id}/edit', [PrivateTripController::class, 'edit'])->name('admin.private_trip.edit');
    Route::put('admin/private_trip/{id}', [PrivateTripController::class, 'update'])->name('admin.private_trip.update');
    Route::delete('/admin/private_trip/{id}', [PrivateTripController::class, 'delete'])->name('admin.private_trip.delete');

    // Pemesanan    
    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('admin.pemesanan');
    Route::get('/admin/pemesanan/create', [PemesananController::class, 'create'])->name('admin.pemesanan.create');
    Route::post('/admin/pemesanan/store', [PemesananController::class, 'store'])->name('admin.pemesanan.store');
    Route::get('/admin/pemesanan/{id}', [PemesananController::class, 'show'])->name('admin.pemesanan.show');
    Route::get('admin/pemesanan/{id}/edit', [PemesananController::class, 'edit'])->name('admin.pemesanan.edit');
    Route::put('admin/pemesanan/{id}', [PemesananController::class, 'update'])->name('admin.pemesanan.update');
    Route::delete('/admin/pemesanan/{id}', [PemesananController::class, 'delete'])->name('admin.pemesanan.delete');





    // Pembayaran
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('admin.pembayaran');
    Route::get('/admin/pembayaran/create', [PembayaranController::class, 'create'])->name('admin.pembayaran.create');
    Route::post('/admin/pembayaran/store', [PembayaranController::class, 'store'])->name('admin.pembayaran.store');
    Route::post('/admin/pembayaran/{id}', [PembayaranController::class, 'show'])->name('admin.pembayaran.show');
    Route::put('admin/pembayaran/{id}', [PembayaranController::class, 'edit'])->name('admin.pembayaran.edit');
    Route::put('admin/pembayaran/{id}', [PembayaranController::class, 'update'])->name('admin.pembayaran.update');
    Route::delete('/admin/pembayaran/{id}', [PembayaranController::class, 'delete'])->name('admin.pembayaran.delete');

    // Route Data Administrsi
    Route::get('/data_administrasi', [DataAdministrasiController::class, 'index'])->name('admin.data_administrasi');
    Route::get('/admin/data_administrasi/create', [DataAdministrasiController::class, 'create'])->name('admin.data_administrasi.create');
    Route::post('/admin/data_administrasi/store', [DataAdministrasiController::class, 'store'])->name('admin.data_administrasi.store');
    Route::get('admin/data_administrasi/{id}', [DataAdministrasiController::class, 'show'])->name('admin.data_administrasi.show');
    Route::get('/admin/data-administrasi/{id}/edit', [DataAdministrasiController::class, 'edit'])->name('admin.data_administrasi.edit');
    Route::put('/admin/data-administrasi/{id}', [DataAdministrasiController::class, 'update'])->name('admin.data_administrasi.update');
    Route::delete('/admin/data-administrasi/{id}', [DataAdministrasiController::class, 'destroy'])->name('admin.data_administrasi.destroy');


    Route::post('/admin/logout', [AuthController::class, 'admin_logout'])->name('admin.logout'); // Logout admin
});


// Grouping admin besar routes
    Route::prefix('adminbesar')->name('adminbesar.')->group(function () {
        Route::resource('artikel', ArtikelController::class);
    });
    Route::prefix('adminbesar')->name('adminbesar.')->group(function () {
        Route::resource('riwayat', RiwayatController::class);
    });
    Route::prefix('adminbesar')->name('adminbesar.')->group(function () {
        Route::resource('laporan', LaporanController::class);
    });

// Route untuk admin besar -> dashboard admin besar
Route::group(['middleware' => 'adminbesar'], function () {
    Route::get('/adminbesar', [AdminBesarController::class, 'dashboard'])->name('adminbesar.dashboard'); // Halaman dashboard admin

    // Artikel
    Route::get('/artikel', [ArtikelController::class,'index'])->name('adminbesar.artikel');
    // Route for showing the create form
    Route::get('/adminbesar/artikel/create', [ArtikelController::class, 'create'])->name('adminbesar.artikel.create');
    // Route for storing a new article
    Route::post('/adminbesar/artikel', [ArtikelController::class, 'store'])->name('adminbesar.artikel.store');
    // Route for showing a single article (optional)
    Route::get('/adminbesar/artikel/{id}', [ArtikelController::class, 'show'])->name('adminbesar.artikel.show');
    // Route for showing the edit form (optional)
    Route::get('/adminbesar/artikel/{id}/edit', [ArtikelController::class, 'edit'])->name('adminbesar.artikel.edit');
    // Route for updating an article (optional)
    Route::put('/adminbesar/artikel/{id}', [ArtikelController::class, 'update'])->name('adminbesar.artikel.update');
    // Route for deleting an article (optional)
    Route::delete('/adminbesar/artikel/{id}', [ArtikelController::class, 'destroy'])->name('adminbesar.artikel.destroy');


    // Laporan
    Route::get('/laporan', [LaporanController::class,'index'])->name('adminbesar.laporan');
    Route::get('adminbesar/laporan/{id}', [RiwayatController::class, 'show'])->name('adminbesar.laporan.show');
    Route::get('/adminbesar/laporan/total-pendapatan-per-bulan', [LaporanController::class, 'totalPendapatanPerBulan']);
    Route::get('/adminbesar/laporan/total-pendapatan-per-tahun', [LaporanController::class, 'totalPendapatanPerTahun']);
    Route::post('adminbesar/laporan/filter', [LaporanController::class, 'filterByDate'])->name('adminbesar.laporan.filter');


    // Riwayat
    Route::get('/riwayat', [RiwayatController::class,'index'])->name('adminbesar.riwayat');
    Route::get('adminbesar/riwayat/{id}', [RiwayatController::class, 'show'])->name('adminbesar.riwayat.show');


    Route::post('/adminbesar/logout', [AuthController::class, 'admin_logout'])->name('adminbesar.logout'); // Logout admin
});



// Route untuk user
Route::group(['middleware' => 'web'], function () {
    Route::get('/user', [UserController::class, 'home'])->name('user.home');
<<<<<<< HEAD
    
    // Artikel 
    Route::get('/user/dokumen', [UserController::class, 'dokumen'])->name('user.dokumen');
    Route::get('/user/dokumen/detail', [UserController::class, 'detail'])->name('user.detail');
    Route::get('/detail-artikel/{id}', [UserController::class, 'detailArtikel'])->name('user.detail-artikel');


    // Open Trip
    Route::get('/user/opentrip', [UserController::class, 'opentrip'])->name('user.opentrip');
    Route::get('/open-trip/{id}', [UserController::class, 'detailopen'])->name('user.detailopen');
    Route::post('opentrip/{id}/book', [UserController::class, 'bookOpenTrip'])->name('user.bookOpenTrip');

    // Privat Trip
    Route::get('/user/privatetrip', [UserController::class, 'privatetrip'])->name('user.privatetrip');
    Route::post('/user/private_trip/store', [UserController::class, 'storePrivateTrip'])->name('user.private_trip.store');

    // Profil Kami
    Route::get('/user/profil-kami', [UserController::class, 'profilKami'])->name('user.profil-kami');
    
    // Tentang Kami
    Route::get('/user/tentang-kami', [UserController::class, 'tentangKami'])->name('user.tentang-kami');


    // Trip Saya
    Route::get('/user/tripsaya', [UserController::class, 'tripsaya'])->name('user.tripsaya');
    Route::delete('/user/tripsaya/batal-pemesanan/{id}', [UserController::class, 'batalPemesanan'])->name('user.tripsaya.batalPemesanan');
    Route::get('/user/tripsaya/detail/{id}', [UserController::class, 'detailPemesanan'])->name('user.tripsaya.detail-pemesanan');
    
=======
    Route::get('/user/opentrip', [UserController::class, 'opentrip'])->name('user.opentrip');


    Route::get('/user/privatetrip', [UserController::class, 'privatetrip'])->name('user.privatetrip');
    Route::post('user/private-trip', [UserController::class, 'store'])->name('user.private_trip.store');
    Route::get('user/trip-saya', [UserController::class, 'tripSaya'])->name('user.trip_saya');



    Route::get('/user/dokumen', [UserController::class, 'dokumen'])->name('user.dokumen');


    Route::get('/user/profil-kami', [UserController::class, 'profilKami'])->name('user.profil-kami');


    Route::get('/user/tentang-kami', [UserController::class, 'tentangKami'])->name('user.tentang-kami');


    Route::get('/user/dokumen/detail', [UserController::class, 'detail'])->name('user.detail');


    Route::get('/user/opentrip/detail', [UserController::class, 'detailopen'])->name('user.detailopen');


    Route::get('user/tripsaya', [UserController::class, 'showTripsSaya'])->name('user.tripsaya');


>>>>>>> 6698e896e4ee9804ef66c5a69f29fa41f7ab645a

    Route::post('/user/logout', [AuthController::class, 'user_logout'])->name('user.logout');

})->middleware('web');

