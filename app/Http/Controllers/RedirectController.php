<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    public function findHome(){

        $role = Auth::user()->role;

        if($role == '1'){
            
           return redirect()->route('admin.dashboard');

        }else if($role == '0'){

            return redirect()->route('user.dashboard');


        }

        
        return redirect()->back();
    }
}