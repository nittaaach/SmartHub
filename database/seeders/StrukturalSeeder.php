<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StrukturalModels;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StrukturalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StrukturalModels::create([
            'id_datadiri' => 1, 
            'jabatan' => 'Ketua RW',
            'tingkatan' => 'RW',
            'gambar' => null
        ]);
    }
}
