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
        $drole = 1;// Define $datadiri and $user with appropriate values before using them
        $datadiri = 1; // Replace 1 with the actual datadiri_id you want to use
        $user = 1;     // Replace 1 with the actual user_id you want to use

        DB::table('role')->insert([
            'id_drole'   => $drole,         // contoh ketua_rw
            'id_datadiri' => $datadiri,
            'id_users'    => $user,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
