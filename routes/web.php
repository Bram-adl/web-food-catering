<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
*/

// Client Main Views Related Routes
Route::get('/', 'HomeController@index')
    ->name('client-index');

Route::get('/profile/{nama}', 'ProfileController@profile')
    ->name('client-profile')
    ->where('nama', '[a-zA-Z]+');
Route::get('/profile/{nama}/pembelian', 'ProfileController@profilePembelian')
    ->name('client-profilePembelian')
    ->where('nam', '[a-zA-Z]+');

Route::get('/paket/{id_paket}', 'PaketController@process')
    ->name('client-process');
Route::get('/paket/{id_paket}/pengiriman', 'PaketController@pengiriman')
    ->name('client-pengiriman');
Route::get('/paket/{id_paket}/pembayaran', 'PaketController@pembayaran')
    ->name('client-pembayaran');

// Client Authentication Related Routes
Route::get('/login', 'AuthController@login')
    ->name('client-login');
Route::post('/login', 'AuthController@authenticate')
    ->name('client-authenticate');
Route::post('/register', 'AuthController@register')
    ->name('client-register');
Route::post('/logout', 'AuthController@logout')
    ->name('client-logout');

// Client Requests Related Routes
Route::put('/profile/{id}/update', 'ProfileController@update');
Route::get('/profile/{pengantaran_id}', 'ProfileController@getPengantaran');
Route::put('/profile/{pengantaran_id}/update/pengantaran', 'ProfileController@updatePengantaran');
Route::get('/profile/{id}/pengantaran/list', 'ProfileController@profilePengantaran');
Route::post('/profile/{id}/pengantaran/create', 'ProfileController@storePengantaran');
Route::delete('/profile/{id}/remove/pesanan', 'ProfileController@removePesanan');

Route::get('/pembelian/{id}/list', 'PembelianController@listPembelian');
Route::post('/pembelian/create', 'PembelianController@storePembelian');
Route::put('/pembelian/{id}/edit', 'PembelianController@updatePembelian');
Route::put('/pembelian/{id}/berhenti', 'PembelianController@berhentiPembelian');
Route::put('/pembelian/{id}/batalkan', 'PembelianController@batalkanPembelian');
Route::delete('/pembelian/{id}/hapus', 'PembelianController@deletePembelian');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Admin Main Views Related Routes
Route::get('/dashboard', 'DashboardController@index')
    ->name('admin-dashboard');

// Admin Authentication Related Routes
Route::get('/admin/login', 'AuthController@loginAdmin')
    ->name('admin-login');
Route::post('/admin/login', 'AuthController@authenticateAdmin')
    ->name('admin-authenticate');
Route::post('/admin/register', 'AuthController@registerAdmin')
    ->name('admin-register');
Route::post('/admin/logout', 'AuthController@logoutAdmin')
    ->name('admin-logout');

/*
|--------------------------------------------------------------------------
| Resources Routes
|--------------------------------------------------------------------------
*/

Route::post('/pembelian/verifikasi/{id}', 'Admin\PembelianController@verifikasi');
Route::post('/pembelian/batalkan/{id}', 'Admin\PembelianController@batalkan');
Route::post('/pembelian/selesai/{id}', 'Admin\PembelianController@selesai');

Route::get('/pesanan/cari', 'Admin\PesananController@tanggal');
Route::get('/pesanan/ganti_jadwal/{id}', 'Admin\PesananController@editJadwal');
Route::put('/pesanan/ganti_jadwal/{id}', 'Admin\PesananController@updateJadwal');
Route::post('/pesanan/serve/{id}', 'Admin\PesananController@serve');

Route::post('/profil/{id}/edit/biodata', 'Admin\ProfilController@editBiodata');
Route::post('/profil/{id}/edit/foto', 'Admin\ProfilController@editFoto');
Route::post('/profil/{id}/edit/password', 'Admin\ProfilController@editPassword');

Route::post('/pengantaran/checked/{id}', 'Admin\PengantaranController@store');
Route::post('/pengantaran/unchecked/{id}', 'Admin\PengantaranController@update');

/**
 * Middlewares Routes
 */
Route::resources([
    'pelanggan' => 'PelangganController',
    'kota' => 'KotaController',
    'kecamatan' => 'KecamatanController',
    'kelurahan' => 'KelurahanController',
    'personel' => 'Admin\PersonelController',
    'jabatan' => 'Admin\JabatanController',
    'paket' => 'Admin\PaketController',
    'kategori' => 'Admin\KategoriController',
    'pelanggan' => 'Admin\PelangganController',
    'pembelian' => 'Admin\PembelianController',
    'pesanan' => 'Admin\PesananController',
    'pengantaran' => 'Admin\PengantaranController',
    'profil' => 'Admin\ProfilController',
]);