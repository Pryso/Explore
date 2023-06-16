<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(2)->create();
        Category::factory(1)->create();
        Category::factory()->create([
            'place' => 'STALCRAFT',
            'type' => 'Аккаунт',
        ]);
        Category::factory()->create([
            'place' => 'CS:GO',
            'type' => 'Аккаунт'
        ]);
        Product::factory(30)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }
}
