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
        // Define $datadiri and $user with appropriate values before using them
        $datadiri = 1; // Replace 1 with the actual datadiri_id you want to use
        $user = 1;     // Replace 1 with the actual user_id you want to use

        DB::table('role')->insert([
            'drole_id'   => 1,         // contoh ketua_rw
            'datadiri_id' => $datadiri,
            'user_id'    => $user,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
