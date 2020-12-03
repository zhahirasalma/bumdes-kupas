<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankSampah extends Model
{
    use SoftDeletes;
    protected $table='bank_sampah';
    protected $fillable=['no_telp','kota','kecamatan','desa','dukuh', 'RT', 'RW', 'detail_alamat', 'id_users'];
}
