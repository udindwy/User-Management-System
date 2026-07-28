<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuLevelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('MENU_LEVEL')->insert([
            ['id_level' => 'ADM', 'level' => 'Administrator'],
            ['id_level' => 'MGR', 'level' => 'Manager'],
            ['id_level' => 'USR', 'level' => 'User'],
        ]);
    }
}
