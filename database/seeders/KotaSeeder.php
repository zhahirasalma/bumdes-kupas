<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kota')->insert([
            'kota' => 'Yogyakarta',
        ]);

        DB::table('kota')->insert([
            'kota' => 'Bantul',
        ]);

        DB::table('kota')->insert([
            'kota' => 'Sleman',
        ]);
    }
}
