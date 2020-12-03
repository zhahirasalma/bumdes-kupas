<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BankSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bank_sampah')->insert([
            'no_telp' => '0857868790',
            'kota' => 'Yogyakarta',
            'kecamatan' => 'Sewon',
            'desa' => 'Panggungharjo',
            'dukuh' => 'Panggungharjo', 
            'RT' => '0', 
            'RW' => '0', 
            'detail_alamat' => 'Panggungharjo, sewon, jogja', 
            'id_users' => 1
        ]);
    }
}
