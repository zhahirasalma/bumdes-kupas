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
        DB::table('kota')->insert(array(
            array('kota' => 'Bantul'),
            array('kota' => 'Yogyakarta'),
            array('kota' => 'Sleman')
        ));

        DB::table('kecamatan')->insert(array(
            array('kecamatan' => 'Srandakan', 'id_kota' => 1),
            array('kecamatan' => 'Sanden', 'id_kota' => 1),
            array('kecamatan' => 'Kretek', 'id_kota' => 1),
            array('kecamatan' => 'Pundong', 'id_kota' => 1),
            array('kecamatan' => 'Bambanglipuro', 'id_kota' => 1),
            array('kecamatan' => 'Pandak', 'id_kota' => 1),
            array('kecamatan' => 'Panjangan', 'id_kota' => 1),
            array('kecamatan' => 'Bantul', 'id_kota' => 1),
            array('kecamatan' => 'Jetis', 'id_kota' => 1),
            array('kecamatan' => 'Imogiri', 'id_kota' => 1),
            array('kecamatan' => 'Dlingo', 'id_kota' => 1),
            array('kecamatan' => 'Banguntapan', 'id_kota' => 1),
            array('kecamatan' => 'Pleret', 'id_kota' => 1),
            array('kecamatan' => 'Piyungan', 'id_kota' => 1),
            array('kecamatan' => 'Sewon', 'id_kota' => 1),
            array('kecamatan' => 'Kasihan', 'id_kota' => 1),
            array('kecamatan' => 'Sedayu', 'id_kota' => 1)
        ));

        DB::table('desa')->insert(array(
            array('desa' => 'Poncosari', 'id_kecamatan' => 1),
            array('desa' => 'Trimurti', 'id_kecamatan' => 1),
            array('desa' => 'Gadingsari', 'id_kecamatan' => 2),
            array('desa' => 'Gadingharjo', 'id_kecamatan' => 2),
            array('desa' => 'Srigading', 'id_kecamatan' => 2),
            array('desa' => 'Murtigading', 'id_kecamatan' => 2),
            array('desa' => 'Tirtomulyo', 'id_kecamatan' => 3),
            array('desa' => 'Parangtritis', 'id_kecamatan' => 3),
            array('desa' => 'Donotirto', 'id_kecamatan' => 3),
            array('desa' => 'Tirtosari', 'id_kecamatan' => 3),
            array('desa' => 'Tirtoharjo', 'id_kecamatan' => 3),
            array('desa' => 'Seloharjo', 'id_kecamatan' => 4),
            array('desa' => 'Panjangrejo', 'id_kecamatan' => 4),
            array('desa' => 'Srihardono', 'id_kecamatan' => 4),
            array('desa' => 'Sidomulyo', 'id_kecamatan' => 5),
            array('desa' => 'Mulyodadi', 'id_kecamatan' => 5),
            array('desa' => 'Sumbermulyo', 'id_kecamatan' => 5)
        ));
    }
}
