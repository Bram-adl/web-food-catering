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
Route::get('/profile', 'HomeController@profileRedirect')
    ->name('client-profile-redirect');
Route::get('/profile/{id}/{nama}', 'HomeController@profile')
    ->name('client-profile')
    ->where('id', '[0-9]+');
Route::get('/paket/{id}', 'HomeController@package')
    ->name('client-package');

// Client Authentication Related Routes
Route::get('/login', 'AuthController@login')
    ->name('client-login');
Route::post('/login', 'AuthController@authenticate')
    ->name('client-authenticate');
Route::post('/register', 'AuthController@register')
    ->name('client-register');
Route::post('/logout', 'AuthController@logout')
    ->name('client-logout');

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
Route::get('/jabatan', 'DashboardController@jabatan')
    ->name('admin-jabatan');
Route::get('/paket', 'DashboardController@paket')
    ->name('admin-paket');
Route::get('/kategori-paket', 'DashboardController@kategori_paket')
    ->name('admin-kategori-paket');
Route::get('/pelanggan', 'DashboardController@pelanggan')
    ->name('admin-pelanggan');
Route::get('/pembelian', 'DashboardController@pembelian')
    ->name('admin-pembelian');
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
Route::get('/admin/logout', 'AuthController@logout')
    ->name('admin-logout');

/*
|--------------------------------------------------------------------------
| Resources Routes
|--------------------------------------------------------------------------
*/
Route::resources([
    'pelanggan' => 'PelangganController',
    'kota' => 'KotaController',
    'kecamatan' => 'KecamatanController',
    'kelurahan' => 'KelurahanController',
    'personel' => 'Admin\PersonelController',
]);