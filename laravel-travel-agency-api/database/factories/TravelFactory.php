<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Travel>
 */
class TravelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'is_public' => random_int(0, 1),
            'name' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'number_of_days' => fake()->numberBetween(6, 21),
        ];
    }
}
