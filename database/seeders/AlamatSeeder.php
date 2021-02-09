<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alamat')->insert([
            'kota' => 'Yogyakarta',
            'kecamatan' => 'Sewon',
            'desa' => 'Panggungharjo',
        ]);

        DB::table('alamat')->insert([
            'kota' => 'Bantul',
            'kecamatan' => 'Sewon',
            'desa' => 'Panggungharjo',
        ]);
    }
}
