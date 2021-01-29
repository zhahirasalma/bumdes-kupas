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

Route::get('/historyTransaksi', function () {
    return view('bankSampah.layanan.history_transaksi');
});

Route::get('/daftarSetorBankSampah', function () {
    return view('bankSampah.layanan.daftar_setor.index');
});

Route::get('/tambahSetorBankSampah', function () {
    return view('bankSampah.layanan.daftar_setor.tambah');
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

Route::group(['prefix'=>'admin'], function(){
    Route::get('/cari', [App\Http\Controllers\Admin\WargaController::class, 'searchKategori'])->name('cari');
    Route::resources([
        'pengambilan' => App\Http\Controllers\Admin\PengambilanController::class,
        'users' => App\Http\Controllers\Admin\UsersController::class,
        'warga' => App\Http\Controllers\Admin\WargaController::class,
        'retribusi' => App\Http\Controllers\Admin\TransaksiRetribusiController::class,
        'bank_sampah' => App\Http\Controllers\Admin\BankSampahController::class,
        'transaksi' => App\Http\Controllers\Admin\TransaksiBankSampahController::class,
        'konversi' => App\Http\Controllers\Admin\KonversiController::class,
        'kategori_sampah' => App\Http\Controllers\Admin\KategoriSampahController::class
        ]);
});