<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $now = now()->toDateString();

        DB::table('MENU')->insert([
            [
                'menu_id'     => 'D01',
                'id_level'    => 'ADM',
                'menu_name'   => 'Dashboard',
                'menu_link'   => '/dashboard',
                'menu_icon'   => 'bi bi-speedometer2',
                'parent_id'   => null,
                'create_by'   => 'SYSTEM',
                'create_date' => $now,
                'delete_mark' => '0',
                'update_by'   => null,
                'update_date' => null,
            ],
            [
                'menu_id'     => 'U01',
                'id_level'    => 'ADM',
                'menu_name'   => 'Manajemen User',
                'menu_link'   => '/users',
                'menu_icon'   => 'bi bi-people-fill',
                'parent_id'   => null,
                'create_by'   => 'SYSTEM',
                'create_date' => $now,
                'delete_mark' => '0',
                'update_by'   => null,
                'update_date' => null,
            ],
            [
                'menu_id'     => 'M01',
                'id_level'    => 'ADM',
                'menu_name'   => 'Manajemen Menu',
                'menu_link'   => '/menus',
                'menu_icon'   => 'bi bi-list-ul',
                'parent_id'   => null,
                'create_by'   => 'SYSTEM',
                'create_date' => $now,
                'delete_mark' => '0',
                'update_by'   => null,
                'update_date' => null,
            ],
            [
                'menu_id'     => 'L01',
                'id_level'    => 'ADM',
                'menu_name'   => 'Log Error',
                'menu_link'   => '/logs/errors',
                'menu_icon'   => 'bi bi-bug-fill',
                'parent_id'   => null,
                'create_by'   => 'SYSTEM',
                'create_date' => $now,
                'delete_mark' => '0',
                'update_by'   => null,
                'update_date' => null,
            ],
            [
                'menu_id'     => 'D02',
                'id_level'    => 'MGR',
                'menu_name'   => 'Dashboard',
                'menu_link'   => '/dashboard',
                'menu_icon'   => 'bi bi-speedometer2',
                'parent_id'   => null,
                'create_by'   => 'SYSTEM',
                'create_date' => $now,
                'delete_mark' => '0',
                'update_by'   => null,
                'update_date' => null,
            ],
            [
                'menu_id'     => 'U02',
                'id_level'    => 'MGR',
                'menu_name'   => 'Daftar User',
                'menu_link'   => '/users/list',
                'menu_icon'   => 'bi bi-person-lines-fill',
                'parent_id'   => null,
                'create_by'   => 'SYSTEM',
                'create_date' => $now,
                'delete_mark' => '0',
                'update_by'   => null,
                'update_date' => null,
            ],
            [
                'menu_id'     => 'D03',
                'id_level'    => 'USR',
                'menu_name'   => 'Dashboard',
                'menu_link'   => '/dashboard',
                'menu_icon'   => 'bi bi-speedometer2',
                'parent_id'   => null,
                'create_by'   => 'SYSTEM',
                'create_date' => $now,
                'delete_mark' => '0',
                'update_by'   => null,
                'update_date' => null,
            ],
            [
                'menu_id'     => 'P01',
                'id_level'    => 'USR',
                'menu_name'   => 'Profil Saya',
                'menu_link'   => '/profile',
                'menu_icon'   => 'bi bi-person-circle',
                'parent_id'   => null,
                'create_by'   => 'SYSTEM',
                'create_date' => $now,
                'delete_mark' => '0',
                'update_by'   => null,
                'update_date' => null,
            ],
        ]);
    }
}
