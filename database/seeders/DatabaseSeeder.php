<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ➜ Matikan sementara foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // panggil seeder sesuai urutan yang benar
        $this->call([
            DroleSeeder::class,
            UserSeeder::class,
            DatadiriSeeder::class,
            RoleSeeder::class,
        ]);

        // ➜ Hidupkan kembali
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
