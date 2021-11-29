<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPagesController extends Controller
{
    
    public function dashboard(){
        return view('user.dashboard');
    }

    public function orders(){
        return view('user.orders');
    }

    public function billing(){
        return view('user.billing');
    }


}