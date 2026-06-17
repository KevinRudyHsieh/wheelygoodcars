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

        // 2. Maak hier de 20 tags aan
        $tags = ['Nieuw', 'Zuinig', 'Sportief', 'Elektrisch', 'Luxe', 'Occasion', 'Actie', 'Gezinsauto', 'Automaat', 'Handgeschakeld', 'Rookvrij', 'Dealeronderhouden', 'Inruil', '4x4', 'Turbo', 'Cabrio', 'SUV', 'Station', 'Compact', 'Hybride'];

        foreach ($tags as $name) {
            \App\Models\Tag::create(['name' => $name]);
        }
        // Daarna cars
        $this->call([
            CarSeeder::class,
        ]);
    }
}
