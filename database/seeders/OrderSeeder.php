<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Waste;
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

        $orders = [];

            foreach(range(0,10) as $orderObj){

                $status = rand(0,2);

                $progress = ($status == 1) ? rand(1,2) : 0; 
                
                $waste = Waste::findOrFail(mt_rand(1,11));

                $weight = mt_rand(2,99);


                array_push($orders, [
                    'weight' => $weight,
                    'user_id' => rand(2,3),
                    'waste_id' => $waste->id,
                    'pickup' => date('Y-m-d H:i:s', mt_rand(date('U' , strtotime(now())) , date('U' , strtotime(now()->addMonth())))),
                    'status' => $status,
                    'progress' => $progress,
                    'cost' => (int)$waste->cost * $weight,
                ]);
                
            }


            foreach($orders as $newOrder){

                Order::create($newOrder);
                
            }
        
        
      
    }
}