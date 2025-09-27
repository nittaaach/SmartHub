<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
<<<<<<< HEAD
use Illuminate\Database\Seeder;
=======
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
>>>>>>> 87ce82732d632cdb7f3956ba3d1115b4cf0b1caa

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin-smarthub',
            'email' => 'admin12@gmail.com', 
            'password' => bcrypt('passwordBaru123')
        ]);
        
=======
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
>>>>>>> 87ce82732d632cdb7f3956ba3d1115b4cf0b1caa
    }
}
