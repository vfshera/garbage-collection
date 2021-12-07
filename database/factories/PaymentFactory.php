<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => rand(1,3),
            'TransactionType' => 'Paybill',
            'TransID' => Str::random(10), //'4FNIN3UR11'
            'TransTime' => date('YmdHis' , strtotime(now())) ,//'20211115001105'
            'TransAmount' => rand(100,10000),
            'BusinessShortCode' => '600995',
            'BillRefNumber' => $this->faker->hexColor(),
            'InvoiceNumber' => rand(1,200),
            'OrgAccountBalance' => 98944,
            'ThirdPartyTransID' => NULL,
            'MSISDN' => '254712345678',
            'FirstName' => $this->faker->firstName(),
            'MiddleName' => $this->faker->lastName(),
            'LastName' => $this->faker->lastName(),
        ];
    }
}