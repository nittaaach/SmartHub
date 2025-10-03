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
            [
                'rt' => 1,
                'jumlah' => 94,
                'laki_laki' => 50,
                'perempuan' => 44,
                'jumlah_kk' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rt' => 2,
                'jumlah' => 296,
                'laki_laki' => 161,
                'perempuan' => 135,
                'jumlah_kk' => 87,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rt' => 3,
                'jumlah' => 103,
                'laki_laki' => 52,
                'perempuan' => 51,
                'jumlah_kk' => 28,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rt' => 4,
                'jumlah' => 108,
                'laki_laki' => 53,
                'perempuan' => 55,
                'jumlah_kk' => 27,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rt' => 5,
                'jumlah' => 236,
                'laki_laki' => 94,
                'perempuan' => 142,
                'jumlah_kk' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rt' => 6,
                'jumlah' => 144,
                'laki_laki' => 101,
                'perempuan' => 43,
                'jumlah_kk' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rt' => 7,
                'jumlah' => 12,
                'laki_laki' => 6,
                'perempuan' => 6,
                'jumlah_kk' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rt' => 8,
                'jumlah' => 10,
                'laki_laki' => 5,
                'perempuan' => 5,
                'jumlah_kk' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
