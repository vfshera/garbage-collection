<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = Order::paid()->with('user')->get();


        foreach($orders as $order){

            Transaction::create(
                [
                    'order_id' => $order->id,             
                    'MerchantRequestID' => Str::random(28),
                    'CheckoutRequestID' => Str::random(18),
                    'Amount' => $order->cost
                ]
            );
        }

    }
}