<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/warga', function () {
    return view('warga.index');
});

Route::get('/bankSampah', function () {
    return view('bankSampah.index');
});

Route::get('/registerwarga', function () {
    return view('warga.register');
});

Route::get('/registerBankSampah', function () {
    return view('bankSampah.register');
});