<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;


/**
 * Controller for creating Inquires/Questions
 */
class QuestionController extends Controller
{
    /**
 * Creates an inquiry/Question
 */
    public function store(Request $request){

       $newQuestion = $request->validate([
        'topic' => 'required',
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'message' => 'required',
       ]);


       Question::create($newQuestion);
        
        return redirect()->back()->with('success','Question Sent Successfully!');
    }
}