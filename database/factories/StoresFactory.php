<?php

namespace Database\Factories;

use App\Models\stores;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<stores>
 */
class StoresFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = stores::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'name' => fake()->company(),
            'address' => fake()->address(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
