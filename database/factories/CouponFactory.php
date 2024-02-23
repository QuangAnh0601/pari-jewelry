<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(4),
            'type' => $this->faker->randomElement(['buy', 'free']),
            'quantity' => $this->faker->numberBetween(20, 200),
            'out_of_date' => $this->faker->dateTimeBetween('now', '+30 days'),
            'discount_percent' => $this->faker->numberBetween(10, 100),
            'status' => $this->faker->randomElement(['Active', 'Not Active']),
            'create_by' => 1,
        ];
    }
}
