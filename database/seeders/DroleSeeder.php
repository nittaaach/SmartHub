<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DroleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('drole')->truncate();

        $now = Carbon::now();

        DB::table('drole')->insert([
            ['role' => 'ketua_rw', 'created_at' => $now, 'updated_at' => $now],
            ['role' => 'pkk',      'created_at' => $now, 'updated_at' => $now],
            ['role' => 'katar',    'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
