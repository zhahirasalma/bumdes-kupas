<?php

namespace Database\Seeders;

use Carbon\carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            // 'id' => 1,
            'nama' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => "2020-08-01 01:00:00",
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'remember_token' => "1234567890",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => Carbon::now(),
        ]);
    }
}
