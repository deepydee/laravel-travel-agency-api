<?php

namespace Database\Factories;

use App\Models\Travel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $days = rand(6, 21);
        $startDate = fake()->dateTimeBetween('next Monday', 'next Monday +6 months');
        $endDate = fake()->dateTimeBetween($startDate, $startDate->format('Y-m-d H:i:s')." +$days days");

        return [
            'travel_id' => Travel::inRandomOrder()->first()->id,
            'name' => fake()->sentence(),
            'starting_date' => $startDate,
            'ending_date' => $endDate,
            'price' => rand(1000, 100000),
        ];
    }
}
