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

// Resources Related Routes
Route::resources([
    'pelanggan' => 'PelangganController',
    'kota' => 'KotaController',
    'kecamatan' => 'KecamatanController',
    'kelurahan' => 'KelurahanController',
]);

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/