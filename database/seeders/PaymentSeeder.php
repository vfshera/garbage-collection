<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
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
            $name = explode(' ', $order->user->name);
            $firstName = strtoupper($name[0]);
            $secName = strtoupper($name[1]);
            
            Payment::create([
                'order_id' => $order->id,
                'TransactionType' => 'Paybill',
                'TransID' => strtoupper(Str::random(10)), //'4FNIN3UR11'
                'TransTime' => date('YmdHis' , strtotime($order->created_at->addMinutes(mt_rand(10,60)))) ,//'20211115001105'
                'TransAmount' => $order->cost,
                'BusinessShortCode' => '600995',
                'BillRefNumber' => $order->serial,
                'InvoiceNumber' => $order->serial,
                'OrgAccountBalance' => 98944,
                'ThirdPartyTransID' => "1",
                'MSISDN' => '254712345678',
                'FirstName' => $firstName,
                'MiddleName' => $secName,
                'LastName' => $secName,
            ]);
        }

        

      
    }
}