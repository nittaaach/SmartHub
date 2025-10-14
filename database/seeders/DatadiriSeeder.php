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
        DB::table('datadiri')->insert([
            [
            'id_users' => 1,
            'name' => 'Admin RW',
            'email' => 'adminrw@gmail.com',
            'notelp' => '08123456789',
            'alamat' => 'Jl. Mawar No.1',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'id_users' => 2,
            'name' => 'Admin PKK',
            'email' => 'adminpkk@gmail.com',
            'notelp' => '08123456788',
            'alamat' => 'Jl. Melati No.2',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'id_users' => 3,
            'name' => 'Admin Katar',
            'email' => 'adminkatar@gmail.com',
            'notelp' => '08123456787',
            'alamat' => 'Jl. Kenanga No.3',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'id_users' => 4,
            'name' => 'Admin RT',
            'email' => 'adminrt@gmail.com',
            'notelp' => '08123456786',
            'alamat' => 'Jl. Anggrek No.4',
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
    }
}
