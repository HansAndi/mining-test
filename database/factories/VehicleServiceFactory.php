<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VehicleService>
 */
class VehicleServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vehicle_id' => $this->faker->unique()->numberBetween(1, 40),
            'service_date' => $this->faker->dateTimeBetween('now', '+6 month'),
        ];
    }
}
