<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
            'name' => 'admin_rw',
            'email' => 'adminrw@gmail.com',
            'password' => bcrypt('ketuarw12'),
            'role' => 'ketua_rw',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'admin_pkk',
            'email' => 'adminpkk@gmail.com',
            'password' => bcrypt('pkkrw12'),
            'role' => 'pkk',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'admin_katar',
            'email' => 'adminkatar@gmail.com',
            'password' => bcrypt('katarrw12'),
            'role' => 'katar',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'admin_rt',
            'email' => 'adminrt@gmail.com',
            'password' => bcrypt('katarrw12'),
            'role' => 'rt',
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
    }
}
