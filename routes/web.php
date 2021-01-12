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

Route::get('/profile/{nama}', 'HomeController@profile')
    ->name('client-profile')
    ->where('nama', '[a-zA-Z]+');

Route::get('/paket/{id_paket}', 'PembelianController@process')
    ->name('client-process');

Route::get('/paket/{id_paket}/pengiriman', 'PembelianController@pengiriman')
    ->name('client-pengiriman');

Route::get('/paket/{id_paket}/pembayaran', 'PembelianController@pembayaran')
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
Route::put('/pelanggan/update/{id}', 'PelangganController@update');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Admin Main Views Related Routes
Route::get('/dashboard', 'DashboardController@index')
    ->name('admin-dashboard');
Route::get('/profil/{id}', 'DashboardController@profil')
    ->name('admin-profil');
Route::get('/pesanan', 'DashboardController@pesanan')
    ->name('admin-pesanan');
Route::get('/pengantaran', 'DashboardController@pengantaran')
    ->name('admin-pengantaran');

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
Route::post('/pembelian/selesai/{id}', 'Admin\PembelianController@selesai');

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
]);