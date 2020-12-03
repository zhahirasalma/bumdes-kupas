<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankSampah extends Model
{
    use SoftDeletes;
    protected $table='bank_sampah';
    protected $fillable=['no_telp','kota','kecamatan','desa','dukuh', 'RT', 'RW', 'detail_alamat', 'id_users'];

    // public function user(){
    //     return $this->belongsTo('App\Models\User', 'id_users');
    // }
}
