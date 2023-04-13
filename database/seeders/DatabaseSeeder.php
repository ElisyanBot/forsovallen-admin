<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\FoodCategory::factory()->create([
            'name' => 'warmFood',
        ]);

        \App\Models\FoodCategory::factory()->create([
            'name' => 'coldFood',
        ]);

        \App\Models\FoodCategory::factory()->create([
            'name' => 'desserts',
        ]);

        \App\Models\FoodCategory::factory()->create([
            'name' => 'drinks',
        ]);
    }
}
