<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KonversiSampah extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='konversi';

    protected $fillable=[
        'jenis_sampah',
        'harga_konversi',
    ];
}
