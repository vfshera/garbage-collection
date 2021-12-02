<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Waste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPagesController extends Controller
{
    
    public function dashboard(){
        return view('user.dashboard');
    }

    public function orders(){
        $orders = Order::with('waste')->where('user_id', Auth::user()->id)->orderBy('created_at','DESC')->paginate(8);
        $wastes = Waste::orderBy('created_at','DESC')->get();

        return view('orders' , compact(['orders', 'wastes']));
    }

    public function billing(){
        return view('user.billing');
    }

    public function location(){

        $user = Auth::user();

        return view('user.location' , compact(['user']));
    }


}