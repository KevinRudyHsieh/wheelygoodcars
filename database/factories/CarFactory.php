<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Car;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition(): array
    {
        return [
            'license_plate' => strtoupper($this->faker->bothify('??-###-?')),
            'brand' => $this->faker->randomElement(['Volkswagen', 'BMW', 'Audi', 'Mercedes', 'Toyota']),
            'model' => $this->faker->word,
            'price' => $this->faker->numberBetween(1000, 50000),

            // Voeg deze velden toe om de database errors te voorkomen:
            'mileage' => $this->faker->numberBetween(0, 300000), // Kilometerstand
            'seats'   => $this->faker->randomElement([2, 4, 5, 7]),   // Aantal stoelen
            'doors'   => $this->faker->randomElement([2, 3, 4, 5]),   // Aantal deuren
            'production_year'    => $this->faker->numberBetween(2000, 2024),    // Bouwjaar

            'weight'          => $this->faker->numberBetween(800, 2500),
            'color'           => $this->faker->safeColorName(),
            // De koppeling met de User
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
        ];
    }
}
