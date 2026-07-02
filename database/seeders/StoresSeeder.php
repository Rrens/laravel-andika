<?php

namespace Database\Seeders;

use App\Models\Stores;
use App\Models\User;
use Illuminate\Database\Seeder;

class StoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isNotEmpty()) {
            foreach ($users as $user) {
                stores::factory()->count(rand(1, 3))->create([
                    'user_id' => $user->id,
                ]);
            }

            Stores::factory()->count(5)->create(['user_id' => null]);
        } else {
            Stores::factory()->count(10)->create(['user_id' => null]);
        }
    }
}
