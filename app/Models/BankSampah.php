<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankSampah extends Model
{
    use SoftDeletes;
    protected $table='bank_sampah';
    protected $fillable=['no_telp','id_kota','id_kecamatan','id_desa','dukuh', 'detail_alamat', 'jenis_transaksi', 'id_users'];

    public function user(){
        return $this->belongsTo('App\Models\User', 'id_users');
    }
    public function kota(){
        return $this->belongsTo('App\Models\Kota', 'id_kota');
    }
    public function kecamatan(){
        return $this->belongsTo('App\Models\Kecamatan', 'id_kecamatan');
    }
    public function desa(){
        return $this->belongsTo('App\Models\Desa', 'id_desa');
    }
}
