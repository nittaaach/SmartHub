<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $drole = 1;// Define $datadiri and $user with appropriate values before using them
        // $datadiri = 1; // Replace 1 with the actual datadiri_id you want to use
        // $user = 1;     // Replace 1 with the actual user_id you want to use

        DB::table('role')->insert([
            [
            'id_drole'   => 1,         // contoh ketua_rw
            'id_datadiri' => 1,
            'id_users'    => 1,
            'created_at' => now(),
            'updated_at' => now(),
            ],  
            [
            'id_drole'   => 2,         // contoh ketua_pkk
            'id_datadiri' => 2,
            'id_users'    => 2,
            'created_at' => now(),
            'updated_at' => now(),
            ],  
            [
            'id_drole'   => 3,         // contoh ketua_katar
            'id_datadiri' => 3,
            'id_users'    => 3,
            'created_at' => now(),
            'updated_at' => now(),
            ],  
            [
            'id_drole'   => 4,         // contoh ketua_rt
            'id_datadiri' => 4,
            'id_users'    => 4,
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
    }
}
