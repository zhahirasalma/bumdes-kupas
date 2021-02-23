<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Desa;

class AlamatController extends Controller
{
    public function listKecamatan($kota_id)
    {
        $kecamatan = Kecamatan::WHERE('id_kota', $kota_id)->get();
        return response()->json($kecamatan);
    }

    public function listDesa($id_kecamatan)
    {
        $desa = Desa::WHERE('id_kecamatan', $id_kecamatan)->get();
        return response()->json($desa);
    }
       
}
