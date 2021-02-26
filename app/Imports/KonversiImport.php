<?php

namespace App\Imports;

use App\Models\KonversiSampah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KonversiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $now = date('Y-m-d H:i:s');
        return new KonversiSampah([
            'jenis_sampah'=>$row['jenis_sampah'],
            'harga_konversi'=>$row['harga_konversi'],
            'created_at'=>$now,
        ]);
    }
}
