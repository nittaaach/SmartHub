<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ktp_rw12Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ktp_rw12')->insert([
            [
                'rt' => 'RT 001',
                'jumlah' => 192,
                'laki_laki' => 80,
                'perempuan' => 112,
                'jumlah_kk' => 67,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rt' => 'RT 002',
                'jumlah' => 437,
                'laki_laki' => 229,
                'perempuan' => 208,
                'jumlah_kk' => 115,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rt' => 'RT 003',
                'jumlah' => 313,
                'laki_laki' => 155,
                'perempuan' => 158,
                'jumlah_kk' => 82,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rt' => 'RT 004',
                'jumlah' => 683,
                'laki_laki' => 328,
                'perempuan' => 355,
                'jumlah_kk' => 159,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rt' => 'RT 005',
                'jumlah' => 515,
                'laki_laki' => 227,
                'perempuan' => 288,
                'jumlah_kk' => 108,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rt' => 'RT 006',
                'jumlah' => 995,
                'laki_laki' => 482,
                'perempuan' => 513,
                'jumlah_kk' => 256,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rt' => 'RT 007',
                'jumlah' => 256,
                'laki_laki' => 122,
                'perempuan' => 134,
                'jumlah_kk' => 70,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rt' => 'RT 008',
                'jumlah' => 113,
                'laki_laki' => 49,
                'perempuan' => 64,
                'jumlah_kk' => 24,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
