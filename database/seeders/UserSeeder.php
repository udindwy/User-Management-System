<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('USER')->insert([
            [
                'id_user'       => 'USR001',
                'nama_user'     => 'Super Administrator',
                'username'      => 'superadmin',
                'password'      => Hash::make('Admin@1234'),
                'email'         => 'superadmin@example.com',
                'no_hp'         => '081200000001',
                'wa'            => '081200000001',
                'pin'           => null,
                'id_jenis_user' => 'ADM',
                'status_user'   => 'AKTIF',
                'delete_mark'   => '0',
                'create_by'     => 'SYSTEM',
                'create_date'   => $now,
                'update_by'     => null,
                'update_date'   => null,
            ],
            [
                'id_user'       => 'USR002',
                'nama_user'     => 'Budi Santoso',
                'username'      => 'budi.mgr',
                'password'      => Hash::make('Manager@1234'),
                'email'         => 'budi.santoso@example.com',
                'no_hp'         => '081200000002',
                'wa'            => '081200000002',
                'pin'           => null,
                'id_jenis_user' => 'MGR',
                'status_user'   => 'AKTIF',
                'delete_mark'   => '0',
                'create_by'     => 'USR001',
                'create_date'   => $now,
                'update_by'     => null,
                'update_date'   => null,
            ],
            [
                'id_user'       => 'USR003',
                'nama_user'     => 'Sari Dewi',
                'username'      => 'sari.dewi',
                'password'      => Hash::make('User@1234'),
                'email'         => 'sari.dewi@example.com',
                'no_hp'         => '081200000003',
                'wa'            => '081200000003',
                'pin'           => null,
                'id_jenis_user' => 'USR',
                'status_user'   => 'AKTIF',
                'delete_mark'   => '0',
                'create_by'     => 'USR001',
                'create_date'   => $now,
                'update_by'     => null,
                'update_date'   => null,
            ],
            [
                'id_user'       => 'USR004',
                'nama_user'     => 'Eko Prasetyo',
                'username'      => 'eko.prasetyo',
                'password'      => Hash::make('User@1234'),
                'email'         => 'eko.prasetyo@example.com',
                'no_hp'         => '081200000004',
                'wa'            => '081200000004',
                'pin'           => null,
                'id_jenis_user' => 'USR',
                'status_user'   => 'NON-AKTIF',
                'delete_mark'   => '1',
                'create_by'     => 'USR001',
                'create_date'   => $now,
                'update_by'     => 'USR001',
                'update_date'   => $now,
            ],
        ]);
    }
}
