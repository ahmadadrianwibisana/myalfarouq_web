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
use App\Http\Controllers\Pengunjung\PengunjungController;

// Route untuk tamu (guest) -> login dan register
Route::group(['middleware' => 'guest'], function () {

    // Halaman Home
    Route::get('/', [PengunjungController::class, 'home'])->name('home');
        
    // Halaman Open Trip
    Route::get('/opentrip', [PengunjungController::class, 'opentrip'])->name('opentrip');

    // Halaman Detail Open Trip
    Route::get('/detailopen/{id}', [PengunjungController::class, 'detailopen'])->name('detailopen');

    // Halaman Artikel
    Route::get('/dokumen', [PengunjungController::class, 'dokumen'])->name('dokumen');

    // Halaman Detail Artikel
    Route::get('/artikel/{id}', [PengunjungController::class, 'detailArtikel'])->name('detail-artikel');

    // Halaman Privat Trip
    Route::get('/privatetrip', [PengunjungController::class, 'privatetrip'])->name('privatetrip');

    // Halaman Profil Kami
    Route::get('/profil-kami', [PengunjungController::class, 'profilKami'])->name('profil.kami');

    // Halaman Tentang Kami
    Route::get('/tentang-kami', [PengunjungController::class, 'tentangKami'])->name('tentang.kami');

    // Halaman Detail
    Route::get('/detail', [PengunjungController::class, 'detail'])->name('detail');

        

    
    
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
    Route::put('/admin/data-administrasi/edit-all/{pemesanan_id}', [DataAdministrasiController::class, 'editAll'])->name('admin.data_administrasi.editAll');
    Route::delete('admin/data-administrasi/destroy-all/{pemesanan_id}', [DataAdministrasiController::class, 'destroyAll'])->name('admin.data_administrasi.destroyAll');
    
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
    Route::post('/private-trip/store', [UserController::class, 'storePrivateTrip'])->name('user.private_trip.store');
    // Route to show the create private trip form
Route::get('/user/private-trip/create', [UserController::class, 'createPrivateTrip'])->name('user.private_trip.create');

// Route to store the private trip
Route::post('/user/private-trip/store', [UserController::class, 'storePrivateTrip'])->name('user.private_trip.store');



    // Profil Kami
    Route::get('/user/profil-kami', [UserController::class, 'profilKami'])->name('user.profil-kami');
    
    // Tentang Kami
    Route::get('/user/tentang-kami', [UserController::class, 'tentangKami'])->name('user.tentang-kami');


    // Trip Saya
    Route::get('/user/tripsaya', [UserController::class, 'tripsaya'])->name('user.tripsaya');
    Route::delete('/user/tripsaya/batal-pemesanan/{id}', [UserController::class, 'batalPemesanan'])->name('user.tripsaya.batalPemesanan');
    Route::get('/user/tripsaya/detail/{id}', [UserController::class, 'detailPemesanan'])->name('user.tripsaya.detail-pemesanan');
    // Rute untuk Edit dan Update Pemesanan
    Route::get('/user/pemesanan/edit/{id}', [UserController::class, 'editPemesanan'])->name('user.editPemesanan');
    Route::put('/user/pemesanan/update/{id}', [UserController::class, 'updatePemesanan'])->name('user.updatePemesanan');
    // Rute untuk detail pemesanan
    Route::get('/user/pemesanan/detail/{id}', [UserController::class, 'detailPemesanan'])->name('user.detailPemesanan');
    // Route untuk mendapatkan kuota open trip
    Route::get('/open-trips/{id}', [UserController::class, 'getOpenTripQuota']);
    Route::post('/tripsaya/{id}/upload-bukti', [UserController::class, 'uploadBuktiPembayaran'])->name('user.uploadBuktiPembayaran');
    Route::get('/pemesanan/{id}/upload-bukti-pembayaran', [UserController::class, 'showUploadBuktiPembayaran'])->name('user.showUploadBuktiPembayaran');
    Route::get('/user/upload-data-administrasi/{id}', [UserController::class, 'showUploadDataAdministrasi'])->name('user.showUploadDataAdministrasi');
    Route::post('/user/data-administrasi', [UserController::class, 'storeDataAdministrasi'])->name('user.storeDataAdministrasi');
    Route::post('/user/data-administrasi/update', [UserController::class, 'updateDataAdministrasi'])->name('user.updateDataAdministrasi');
    Route::post('/user/data-administrasi/store', [UserController::class, 'storeDataAdministrasi'])->name('user.storeDataAdministrasi');

    Route::post('/user/logout', [AuthController::class, 'user_logout'])->name('user.logout');

})->middleware('web');

