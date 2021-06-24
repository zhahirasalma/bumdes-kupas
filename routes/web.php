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
    return view('auth.home');
});

Route::middleware(['auth'])->group(function(){
    Route::middleware(['admin'])->group(function(){
        Route::get('admin', [App\Http\Controllers\AdminController::class, 'index']);
    });
    Route::middleware(['educator'])->group(function(){
        Route::get('educator', [App\Http\Controllers\EducatorController::class, 'index']);
    });
    Route::middleware(['warga'])->group(function(){
        Route::get('warga', [App\Http\Controllers\WargaController::class, 'index']);
        Route::get('/homewarga', function () {
            return view('warga.index');
        });
        Route::get('/transaksi_warga', [App\Http\Controllers\WargaController::class, 'transaksi_warga'])
            ->name('transaksi_warga');
        Route::get('/konfirmasistatus', [App\Http\Controllers\WargaController::class, 'konfirmasistatus'])
            ->name('konfirmasistatus');
        Route::post('/konfirmasistatus', [App\Http\Controllers\WargaController::class, 'konfirmasistatus'])
            ->name('konfirmasistatus');
    });
    Route::middleware(['bank_sampah'])->group(function(){
        Route::get('bank_sampah', [App\Http\Controllers\BankSampahController::class, 'index']);
        Route::get('/historyTransaksi', function () {
            return view('bankSampah.layanan.history_transaksi');
        });
        Route::resources([
            'bankSampah' => App\Http\Controllers\BankSampahController::class,
            'daftar_setor' => App\Http\Controllers\DaftarSetorController::class,
        ]);
    });
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->name('logout');
});

Route::get('/create_bank_sampah', [App\Http\Controllers\Auth\RegisterController::class, 'create_bank_sampah'])
    ->name('create_bank_sampah');
Route::post('/store_bank_sampah', [App\Http\Controllers\Auth\RegisterController::class, 'store_bank_sampah'])
    ->name('store_bank_sampah');
Route::post('/store_warga', [App\Http\Controllers\Auth\RegisterController::class, 'store_warga'])
    ->name('store_warga');
Route::get('/pesan', [App\Http\Controllers\FlashMessageController::class, 'index']);

Route::resources([
    'warga' => App\Http\Controllers\WargaController::class,
    'registrasi' => App\Http\Controllers\Auth\RegisterController::class,
    'history_transaksi' => App\Http\Controllers\HistoryTransaksiController::class,
    'nasabah_warga' => App\Http\Controllers\WargaController::class,
    'login' => App\Http\Controllers\Auth\LoginController::class
    ]);

Auth::routes();

Route::group(['prefix'=>'admin'], function(){
    Route::get('/ubahstatus', [App\Http\Controllers\Admin\PengambilanController::class, 'ubahstatus'])->name('ubahstatus');
    Route::any('/data', [App\Http\Controllers\Admin\PengambilanController::class, 'data'])->name('data');
    Route::any('/pengambilan/tambah', [App\Http\Controllers\Admin\PengambilanController::class, 'tambah'])
    ->name('pengambilan/tambah');
    Route::get('/list-kecamatan/{kota_id}', [App\Http\Controllers\Admin\AlamatController::class, 'listKecamatan'])
    ->name('list-kecamatan');
    Route::get('/list-desa/{id_kecamatan}', [App\Http\Controllers\Admin\AlamatController::class, 'listDesa'])
    ->name('list-desa');
    Route::put('/import-kategori',[App\Http\Controllers\Admin\KategoriSampahController::class, 'importKategori']);
    Route::put('/import-konversi',[App\Http\Controllers\Admin\KonversiController::class, 'importKonversi']);
    Route::put('/import-bankSampah',[App\Http\Controllers\Admin\BankSampahController::class, 'importBankSampah']);
    Route::put('/import-warga',[App\Http\Controllers\Admin\WargaController::class, 'importWarga']);
    Route::get('/get-tagihan/{user_id}', [App\Http\Controllers\Admin\TransaksiRetribusiController::class, 'getTagihan'])
    ->name('get-tagihan');
    Route::get('/reset', [App\Http\Controllers\Admin\PengambilanController::class, 'reset'])
    ->name('reset');

    Route::get('export-transaksi/{id_bank_sampah}',[App\Http\Controllers\Admin\TransaksiBankSampahController::class, 'exportExcel'])
    ->name('export-transaksi');

    //detail transaksi
    Route::get('detail-transaksi/{id_bank_sampah}', [App\Http\Controllers\Admin\TransaksiBankSampahController::class, 'detail'])
    ->name('detail-transaksi');
    Route::delete('delete-transaksi/{id}', [App\Http\Controllers\Admin\TransaksiBankSampahController::class, 'deleteItem'])
    ->name('delete-transaksi');

    //get konversi
    Route::get('/get-konversi/{konversi}', [App\Http\Controllers\Admin\TransaksiBankSampahController::class, 'getKonversi'])
    ->name('get-konversi');

    Route::resources([
        'pengambilan' => App\Http\Controllers\Admin\PengambilanController::class,
        'users' => App\Http\Controllers\Admin\UsersController::class,
        'warga' => App\Http\Controllers\Admin\WargaController::class,
        'retribusi' => App\Http\Controllers\Admin\TransaksiRetribusiController::class,
        'bank_sampah' => App\Http\Controllers\Admin\BankSampahController::class,
        'transaksi' => App\Http\Controllers\Admin\TransaksiBankSampahController::class,
        'konversi' => App\Http\Controllers\Admin\KonversiController::class,
        'kategori_sampah' => App\Http\Controllers\Admin\KategoriSampahController::class,
        'dashboard' => App\Http\Controllers\Admin\DashboardController::class
        ]);
});