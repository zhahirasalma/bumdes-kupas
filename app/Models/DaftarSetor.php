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
        'id_bank_sampah',
        'tanggal_transaksi',
        'uraian',
    ];

    public function bank_sampah(){
        return $this->belongsTo('App\Models\BankSampah', 'id_bank_sampah');
    }
}
