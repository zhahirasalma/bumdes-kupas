<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RetribusiWarga extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='retribusi_warga';

    protected $fillable=[
        'nama_kolektor',
        'jumlah_tagihan',
        'bulan_tagihan',
        'alamat',
        'keterangan',
        'tanggal_transaksi',
        'id_users',
        'id_warga',
    ];
    
    public function user(){
        return $this->belongsTo('App\Models\User', 'id_users');
    }
    public function warga(){
        return $this->belongsTo('App\Models\Warga', 'id_warga');
    }
}
