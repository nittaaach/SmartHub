<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class non_ktpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nonktp_rw12')->insert([

            'rt' => 001,
            'jumlah' => 192,
            'laki_laki' => 80,
            'perempuan' => 112,
            'jumlah_kk' => 67,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
