<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'type' => $this->faker->randomElement(['Person', 'Cargo']),
            'ownership' => $this->faker->randomElement(['Company', 'Rental']),
            'status_id' => $this->faker->numberBetween(1, 3),
            'last_used_at' => $this->faker->dateTimeBetween('-3 month', 'now'),
        ];
    }
}
