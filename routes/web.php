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

Auth::routes();

Route::group(['prefix'=>'admin'], function(){
    Route::resource('bank_sampah', App\Http\Controllers\Admin\BankSampahController::class);
    Route::resource('warga', App\Http\Controllers\Admin\WargaController::class);
    Route::resource('transaksi', App\Http\Controllers\Admin\TransaksiBankSampahController::class);
    Route::resource('retribusi', App\Http\Controllers\Admin\TransaksiRetribusiController::class);
});


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



Route::get('/admin/konversi', function () {
    return view('backend.konversi.index');
});

Route::get('/admin/kategori_sampah', function () {
    return view('backend.kategori_sampah.index');
});

Route::get('/admin/pengambilan', function () {
    return view('backend.pengambilan.index');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
