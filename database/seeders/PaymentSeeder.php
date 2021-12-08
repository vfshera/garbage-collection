<?php

namespace Database\Seeders;

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

        $faker = new \Faker\Generator;

        Payment::create([
            'order_id' => 2,
            'TransactionType' => 'Paybill',
            'TransID' => strtoupper(Str::random(10)), //'4FNIN3UR11'
            'TransTime' => date('YmdHis' , strtotime(now())) ,//'20211115001105'
            'TransAmount' => rand(100,10000),
            'BusinessShortCode' => '600995',
            'BillRefNumber' => strtoupper(Str::random(8)),
            'InvoiceNumber' => rand(1,200),
            'OrgAccountBalance' => 98944,
            'ThirdPartyTransID' => "1",
            'MSISDN' => '254712345678',
            'FirstName' => "User",
            'MiddleName' => "One",
            'LastName' => "Jnr",
        ]);

        Payment::create([
            'order_id' => 3,
            'TransactionType' => 'Paybill',
            'TransID' => strtoupper(Str::random(10)), //'4FNIN3UR11'
            'TransTime' => date('YmdHis' , strtotime(now())) ,//'20211115001105'
            'TransAmount' => rand(100,10000),
            'BusinessShortCode' => '600995',
            'BillRefNumber' => strtoupper(Str::random(8)),
            'InvoiceNumber' => rand(1,200),
            'OrgAccountBalance' => 98944,
            'ThirdPartyTransID' => "2",
            'MSISDN' => '254712345678',
            'FirstName' => "User",
            'MiddleName' => "One",
            'LastName' => "Jnr",
        ]);
    }
}