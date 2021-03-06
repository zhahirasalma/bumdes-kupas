<?php

namespace App\Imports;

use App\Models\Warga;
use App\Models\User;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\KategoriSampah;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WargaImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $now = date('Y-m-d H:i:s');

        foreach ($rows as $row) 
        {
            $user = User::create([
                'nama' => $row['nama'],
                'email' => $row['email'],
                'password' => bcrypt($row['password']),
                'role' => 'warga',
                'created_at'=>$now,
            ]);

            Warga::create([
                'NIK' => $row['nik'],
                'id_users' => $user->id,
                'id_kategori_sampah' => KategoriSampah::where("jenis_sampah", "like", "%".$row['kategori']."%")->first()->id,
                'no_telp' => $row['no_telp'],
                'id_kota' => Kota::where("kota", "like", "%".$row['kota']."%")->first()->id,
                'id_kecamatan' => Kecamatan::where("kecamatan", "like", "%".$row['kecamatan']."%")->first()->id,
                'id_desa' => Desa::where("desa", "like", "%".$row['desa']."%")->first()->id,
                'dukuh' => $row['dukuh'],
                'detail_alamat' => $row['detail_alamat'],
                'lokasi' => $row['lokasi'],
                'created_at'=>$now,
            ]);
        }
    }
}
