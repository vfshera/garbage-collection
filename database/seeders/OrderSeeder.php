<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create([
            'weight' => rand(2,9),
            'waste_id' => rand(1,11),
            'user_id' => 2,
            'cost' => rand(2,9) * rand(10 ,25),
            'pickup' => now()
        ]);
        
        Order::create([
            'weight' => rand(2,9),
            'waste_id' => rand(1,11),
            'user_id' => 2,
            'cost' => rand(2,9) * rand(10 ,25),
            'pickup' => now(),
        ]);

        Order::create([
            'weight' => rand(2,9),
            'waste_id' => rand(1,11),
            'user_id' => 2,
            'cost' => rand(2,9) * rand(10 ,25),
            'pickup' => now()
        ]);
    }
}