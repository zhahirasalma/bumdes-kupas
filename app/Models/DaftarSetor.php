<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DaftarSetor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='setoran_anggota_bank_sampah';

    protected $fillable=[
        'nama',
        'tanggal_transaksi',
        'id_bank_sampah',
        'id_konversi',
        'berat',
        'harga_total',
    ];

    public function bank_sampah(){
        return $this->belongsTo('App\Models\BankSampah', 'id_bank_sampah');
    }

    public function konversi_sampah(){
        return $this->belongsTo('App\Models\KonversiSampah', 'id_konversi');
    }
}
