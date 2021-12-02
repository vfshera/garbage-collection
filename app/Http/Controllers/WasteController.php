<?php

namespace App\Http\Controllers;

use App\Models\Waste;
use Illuminate\Http\Request;

class WasteController extends Controller
{
    public function store(Request $request){

        $newWaste = $request->validate([
            "title" => 'required|string',
            "cost" => 'required',
            "description" => 'required'
        ]);
            
        Waste::create($newWaste);

        return redirect()->back()->with('success','Waste Item Created!');
        
    }

    public function update(Request $request){
        $waste = Waste::findOrFail($request->id);

        $updatedFields = $request->validate([
            "title" => 'required|string',
            "cost" => 'required',
            "description" => 'required'
        ]);

        $waste->update($updatedFields);

        return redirect()->back()->with('success','Waste Item Updated!');

    }

    public function destroy(Waste $waste){

        $waste->delete();

        return redirect()->back()->with('success','Waste Item Deleted!');                                                                                                              

    }



}