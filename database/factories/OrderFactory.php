<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'weight' => rand(2,9),
            'waste_id' => rand(1,11),
            'user_id' => 2,
            'cost' => rand(2,9) * rand(10 ,25),
            'pickup' => now()
        ];
    }
}