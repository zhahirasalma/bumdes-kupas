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
        'nama_cp',
        'no_telp',
        'no_telp_cp',
        'kota',
        'kecamatan',
        'desa',
        'dukuh',
        'RT',
        'RW',
        'detail_alamat',
        'lokasi',
        
    ];
    
    public function warga(){
        return $this->belongsTo('App\Models\User', 'id_users');
    }
    public function kategori(){
        return $this->belongsTo('App\Models\KategoriSampah', 'id_kategori_sampah');
    }
}
