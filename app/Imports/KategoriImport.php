<?php

namespace App\Imports;

use App\Models\KategoriSampah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KategoriImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $now = date('Y-m-d H:i:s');
        return new KategoriSampah([
            'jenis_sampah'=>$row['jenis_sampah'],
            'harga_retribusi'=>$row['harga_retribusi'],
            'created_at'=>$now,
        ]);
    }
}
