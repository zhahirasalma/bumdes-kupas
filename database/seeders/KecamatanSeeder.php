<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kecamatan')->insert([
            'kecamatan' => 'Kasihan',
        ]);

        DB::table('kecamatan')->insert([
            'kecamatan' => 'Sewon',
        ]);
    }
}
