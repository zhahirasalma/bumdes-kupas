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

// Route::get('/registerwarga', function () {
//     return view('warga.register');
// });

// Route::get('/registerBankSampah', function () {
//     return view('bankSampah.register');
// });

Route::get('/historyTransaksi', function () {
    return view('bankSampah.layanan.history_transaksi');
});

Route::resources([
    'daftar_setor' => App\Http\Controllers\DaftarSetorController::class,
    'warga' => App\Http\Controllers\WargaController::class,
    'registrasi' => App\Http\Controllers\Auth\RegisterController::class,
    'history_transaksi' => App\Http\Controllers\HistoryTransaksiController::class
    ]);
// Route::get('/registrasi/warga', [App\Http\Controllers\RegisterController::class, 'warga'])->name('warga');
Route::get('/bank_sampah', [App\Http\Controllers\Auth\RegisterController::class, 'create_bank_sampah'])->name('create_bank_sampah');

// Route::get('/registerBankSampah', function () {
//     return view('bankSampah.register');
// });

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
    Route::get('/ubahstatus', [App\Http\Controllers\Admin\PengambilanController::class, 'ubahstatus'])->name('ubahstatus');

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