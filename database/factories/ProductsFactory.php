<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'store_id' => 1,
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'price' => 10000,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
