<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warga extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='warga';

    protected $fillable=[
        'NIK',
        'id_users',
        'id_kategori_sampah',
        'no_telp',
        'id_kota',
        'id_kecamatan',
        'id_desa',
        'dukuh',
        'detail_alamat',
        'latitude',
        'longitude'
    ];
    
    public function user(){
        return $this->belongsTo('App\Models\User', 'id_users');
    }
    public function kategori(){
        return $this->belongsTo('App\Models\KategoriSampah', 'id_kategori_sampah');
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
