<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonversiSampah extends Model
{
    use HasFactory;

    protected $table ='konversi';

    protected $fillable=[
        'jenis_sampah',
        'harga_konversi',
    ];
}
