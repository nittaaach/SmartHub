<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatadiriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Replace 1 with the actual user ID you want to associate
        $datadiri = DB::table('datadiri')->insertGetId([
            'id_users' => 1,
            'nama' => 'Admin RW',
            'email' => 'admin@gmail.com',
            'notelp' => '08123456789',
            'alamat' => 'Jl. Mawar No.1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
