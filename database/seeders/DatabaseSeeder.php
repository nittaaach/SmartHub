<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'admin-smarthub',
        //     'email' => 'admin12@gmail.com', 
        //     'password' => bcrypt('passwordBaru123')
        // ]);

        $this->call([
            DroleSeeder::class,
            UserSeeder::class,
            DataDiriSeeder::class,
            RoleSeeder::class,
            ktp_rw12Seeder::class,
            non_ktpSeeder::class,
            StrukturalSeeder::class,
        ]);
    }
}
