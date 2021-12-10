<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            WasteSeeder::class,
            OrderSeeder::class,
            PaymentSeeder::class,
            QuestionSeeder::class
        ]);
       
    }
}