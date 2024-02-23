<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 1000000, 900000000),
            'cost' => function(array $attributes) {
                return $this->faker->randomFloat(2, 500000, $attributes['price']);
            },
            'description' => $this->faker->text,
            'material' => $this->faker->word,
            'weight' => $this->faker->numberBetween(50, 1000),
            'status' => $this->faker->randomElement(['In Stock', 'Out Of Stock', 'Expired']),
            'brand' => $this->faker->word,
            'visibility' => $this->faker->randomElement(['Display', 'Not Displayed']),
            'create_by' => 1

        ];
    }
}
