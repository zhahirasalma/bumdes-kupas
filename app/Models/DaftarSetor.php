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
        'uraian',
    ];
}
