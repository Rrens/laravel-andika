<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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
        $productNames = ['Laptop', 'Smartphone', 'Headphones', 'Camera', 'Smartwatch'];

        return [
            'name' => Arr::random($productNames),
            'price' => 10000,
            'is_sold' => 0,
            'discount' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
