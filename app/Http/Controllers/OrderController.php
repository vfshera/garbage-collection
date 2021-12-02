<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request){

        $newOrder = $request->validate([
            "waste_id" => 'required',
            "pickup" => 'required',
            "weight" => 'required'
        ]);
            
        // Order::create($newOrder);

        return redirect()->back()->with('success','Order Created!');
        
    }

    public function update(Request $request){
     

        return redirect()->back()->with('success','Order Updated!');

    }

    public function destroy(){

        

        return redirect()->back()->with('success','Order Deleted!');                                                                                                              

    }


}