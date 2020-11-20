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

Route::get('/homewarga', function () {
    return view('warga.index');
});

Route::get('/homebankSampah', function () {
    return view('bankSampah.index');
});

Route::get('/registerwarga', function () {
    return view('warga.register');
});

Route::get('/registerBankSampah', function () {
    return view('bankSampah.register');
});

Route::get('/admin', function () {
    return view('dashboard');
});

Route::get('/admin/warga', function () {
    return view('backend.warga.index');
});

Route::get('/admin/retribusi', function () {
    return view('backend.warga.retribusi');
});

Route::get('/admin/bank_sampah', function () {
    return view('backend.bank_sampah.index');
});

Route::get('/admin/transaksi-bankSampah', function () {
    return view('backend.bank_sampah.transaksi');
});

Route::get('/admin/konversi', function () {
    return view('backend.konversi.index');
});

Route::get('/admin/kategori_sampah', function () {
    return view('backend.kategori_sampah.index');
});

Route::get('/admin/pengambilan', function () {
    return view('backend.pengambilan.index');
});