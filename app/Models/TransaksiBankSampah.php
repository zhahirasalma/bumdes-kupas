<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiBankSampah extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='transaksi_bank_sampah';

    protected $fillable=[
        'id_bank_sampah',
        'tanggal_transaksi',
        'keterangan',
        'id_konversi',
        'id_users',
        'berat',
        'harga_total',
    ];
    
    public function bankSampah(){
        return $this->belongsTo('App\Models\BankSampah', 'id_bank_sampah');
    }
    public function user(){
        return $this->belongsTo('App\Models\User', 'id_users');
    }
    public function konversi(){
        return $this->belongsTo('App\Models\KonversiSampah', 'id_konversi');
    }
}
