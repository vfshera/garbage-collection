<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Waste;
use Illuminate\Http\Request;

class AdminPagesController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }


    public function users(){

        $users = User::normalUsers()->orderBy('created_at', 'DESC')->paginate(8);
        
        return view('admin.users' , compact(['users']));
    }


    public function waste(){

        $wastes = Waste::orderBy('created_at','DESC')->paginate(8);

        return view('admin.waste' , compact(['wastes']));
    }


    

    public function orders(Request $request){
        
       
        $orders = Order::when($request->has('status'), function ($query) use ($request) {

           return $query->where('status', $request->get('status'));
            
         })->with('waste','user')->orderBy('created_at','DESC')->paginate(8);


        return view('orders' , compact(['orders']));
    }



    public function billing(){


        $orders = Order::paid()->with('payment')->orderBy('created_at')->paginate(8); 
        
        $totalBill = Payment::sum('TransAmount');
        
        return view('billing' , compact(['orders','totalBill']));
    }


}