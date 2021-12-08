<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    
    public function store(Request $request){

       
        
        return redirect()->back()->with('success','Question Sent Successfully!');
    }
}