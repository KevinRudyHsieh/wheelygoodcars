<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Seeders\CarSeeder;

class DatabaseSeeder extends Seeder
{
        /**
         * Seed the application's database.
         */
    public function run(): void
    {
        // Eerst users maken (BELANGRIJK)
        User::factory(10)->create();

        // Daarna cars
        $this->call([
            CarSeeder::class,
        ]);
    }
}
