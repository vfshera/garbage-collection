<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Transaction;
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

        $transactions = Transaction::all();


        foreach($transactions as $trans){
            
            Payment::create([
                'transaction_id' => $trans->id,
                'TransactionCode' => strtoupper(Str::random(10)),
                'TransactionDate' => date('Ymdhis', strtotime(now())),
                'PhoneNumber' => '254712345678'
            ]);


            $trans->Status = 1;

            $trans->save();
        }
      
    }
}