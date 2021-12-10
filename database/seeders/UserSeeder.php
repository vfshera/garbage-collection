<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Admin One",
            'email' => "admin@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => '1',//admin
            'remember_token' => Str::random(10)
        ]);



        
        User::create([
            'name' => "User One",
            'email' => "user@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => '0', //user
            'remember_token' => Str::random(10),
            'phone' => "254712345678",
            'postal_code' => "60200",
            'address' => "972", 
            'county' => "Meru",
            'constituency' => "Nchiru",
            'town' => "Meru",
            'ward'=> "Nchiru",
            'village' => "Nchiru"
        ]);



        
        User::create([
            'name' => "John Doe",
            'email' => "jdoe@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => '0', //user
            'remember_token' => Str::random(10),
            'phone' => "254712345678",
            'postal_code' => "60200",
            'address' => "972", 
            'county' => "Nairobi",
            'constituency' => "Westlands",
            'town' => "Westlands",
            'ward'=> "Westlands",
            'village' => "Westlands"
        ]);
    }
}