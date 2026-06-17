<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\Tag;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        Car::factory(250)->create()->each(function ($car) {
            // Randomly assign 1 to 3 tags to each car
            $tags = Tag::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $car->tags()->attach($tags);
        });

    }
}
