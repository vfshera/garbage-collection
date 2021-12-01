<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WasteController extends Controller
{
    public function store(Request $request){

            dd($request->all());
            
        return "Waste Store";
    }

    public function update(){
        return "Waste Update";
    }

    public function destroy(){
        return "Waste Destroy";
    }



}