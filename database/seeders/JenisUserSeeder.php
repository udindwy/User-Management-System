<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('JENIS_USER')->insert([
            ['id_jenis_user' => 'ADM', 'jenis_user' => 'Administrator'],
            ['id_jenis_user' => 'MGR', 'jenis_user' => 'Manager'],
            ['id_jenis_user' => 'USR', 'jenis_user' => 'User'],
        ]);
    }
}
