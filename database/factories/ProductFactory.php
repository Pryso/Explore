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
            'price'=> random_int(1,1000),
            'short_desc' => 'Имморталка на пуджа',
            'desc' => 'Продаю по дешевке всем покупать',
            'seller_id' => random_int(1,2),
            'account' => 'login:123123 pass:123123',
            'category_id' => random_int(1,3),
            'created_at'=>$this->faker->dateTimeBetween('-1 day' ),
            'updated_at'=>$this->faker->dateTimeBetween('-1 day'),

        ];
    }
}
