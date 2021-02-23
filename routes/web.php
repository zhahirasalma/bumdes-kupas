<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

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

Route::post('/store_bank_sampah', [App\Http\Controllers\Auth\RegisterController::class, 'store_bank_sampah'])->name('store_bank_sampah');
Route::post('/store_warga', [App\Http\Controllers\Auth\RegisterController::class, 'store_warga'])->name('store_warga');

Route::get('/historyTransaksi', function () {
    return view('bankSampah.layanan.history_transaksi');
});

Route::resources([
    'daftar_setor' => App\Http\Controllers\DaftarSetorController::class,
    'warga' => App\Http\Controllers\WargaController::class,
    'registrasi' => App\Http\Controllers\Auth\RegisterController::class,
    'history_transaksi' => App\Http\Controllers\HistoryTransaksiController::class,
    'bankSampah' => App\Http\Controllers\BankSampahController::class,
    ]);
// Route::get('/registrasi/warga', [App\Http\Controllers\RegisterController::class, 'warga'])->name('warga');
Route::get('/bank_sampah', [App\Http\Controllers\Auth\RegisterController::class, 'create_bank_sampah'])->name('create_bank_sampah');

Route::get('/admin', function () {
    return view('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin'], function(){
    Route::get('/ubahstatus', [App\Http\Controllers\Admin\PengambilanController::class, 'ubahstatus'])->name('ubahstatus');
    Route::any('/data', [App\Http\Controllers\Admin\PengambilanController::class, 'data'])->name('data');
    Route::any('/pengambilan/tambah', [App\Http\Controllers\Admin\PengambilanController::class, 'tambah'])
    ->name('pengambilan/tambah');
    Route::get('/list-kecamatan/{kota_id}', [App\Http\Controllers\Admin\AlamatController::class, 'listKecamatan'])
    ->name('list-kecamatan');
    Route::get('/list-desa/{id_kecamatan}', [App\Http\Controllers\Admin\AlamatController::class, 'listDesa'])
    ->name('list-desa');

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