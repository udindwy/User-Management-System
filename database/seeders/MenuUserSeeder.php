<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuUserSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('MENU_USER')->insert([
            ['id_user' => 'USR001', 'menu_id' => 'D01', 'create_date' => $now, 'create_time' => $now, 'delete_mark' => '0', 'update_by' => null, 'update_date' => null],
            ['id_user' => 'USR001', 'menu_id' => 'U01', 'create_date' => $now, 'create_time' => $now, 'delete_mark' => '0', 'update_by' => null, 'update_date' => null],
            ['id_user' => 'USR001', 'menu_id' => 'M01', 'create_date' => $now, 'create_time' => $now, 'delete_mark' => '0', 'update_by' => null, 'update_date' => null],
            ['id_user' => 'USR001', 'menu_id' => 'L01', 'create_date' => $now, 'create_time' => $now, 'delete_mark' => '0', 'update_by' => null, 'update_date' => null],
            ['id_user' => 'USR002', 'menu_id' => 'D02', 'create_date' => $now, 'create_time' => $now, 'delete_mark' => '0', 'update_by' => null, 'update_date' => null],
            ['id_user' => 'USR002', 'menu_id' => 'U02', 'create_date' => $now, 'create_time' => $now, 'delete_mark' => '0', 'update_by' => null, 'update_date' => null],
            ['id_user' => 'USR003', 'menu_id' => 'D03', 'create_date' => $now, 'create_time' => $now, 'delete_mark' => '0', 'update_by' => null, 'update_date' => null],
            ['id_user' => 'USR003', 'menu_id' => 'P01', 'create_date' => $now, 'create_time' => $now, 'delete_mark' => '0', 'update_by' => null, 'update_date' => null],
        ]);
    }
}
