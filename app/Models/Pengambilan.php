<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengambilan extends Model
{
    use HasFactory;
    protected $table ='pengambilan_sampah';

    protected $fillable=[
        'id_users',
        'id_warga',
        'waktu_pengambilan',
        'status'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'id_users');
    }
    public function warga(){
        return $this->belongsTo('App\Models\Warga', 'id_warga');
    }
}
