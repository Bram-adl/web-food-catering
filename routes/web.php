<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('client.index');
})->name('landing-page');

Route::get('/profile/{id}', function ($id) {
    return view('client.profile', $id);
})->where('id', '[0-9]+')->name('client-profile');

Route::get('/payment/{paymentId}', function ($paymentId) {
    return view('client-payment', $paymentId);
})->where('paymentId', '[0-9]+')->name('client-payment');

Route::get('/delivery/{deliveryId}', function ($deliveryId) {
    return view('client-delivery', $deliveryId);
})->where('deliveryId', '[0-9]+')->name('client-delivery');

Route::get('/login', function () {
    return view('client.login');
})->name('client-login');

Route::get('/register', function () {
    return view('client.register');
})->name('client-register');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/