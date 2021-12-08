<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topics = ["billing" , "request" , "service" ,"account" , "other"];

       Question::create([
            'topic' => $topics[rand(0 , count($topics) - 1)],
            'name' => "First User",
            'email' => "userone@mail.co.ke",
            'phone' => "254712345678",
            'message' => "How are payments done",
        ]);

       Question::create([
            'topic' => $topics[rand(0 , count($topics) - 1)],
            'name' => "Second User",
            'email' => "usertwo@mail.co.ke",
            'phone' => "254712345678",
            'message' => "Do you have offices in meru",
        ]);
    }
}