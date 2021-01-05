<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'HomeController@index')
    ->name('client-index');

Route::get('/paket/{id}', 'HomeController@package')
    ->name('client-package');

Route::get('/login/{intended?}', 'HomeController@login')
    ->name('client-login');
Route::post('/login', 'HomeController@authenticate')
    ->name('client-authenticate');
Route::post('/register', 'HomeController@register')
    ->name('client-register');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/