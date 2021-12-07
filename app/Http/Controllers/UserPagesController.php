<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use App\Models\Order;
use App\Models\Waste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPagesController extends Controller
{
    
    public function dashboard(){
        return view('user.dashboard');
    }

    public function orders(Request $request){
        
        $orders = Order::when($request->has('status'), function ($query) use ($request) {

            return $query->where('status', $request->get('status'));
            
         })->with('waste')->where('user_id', Auth::user()->id)->orderBy('created_at','DESC')->paginate(8);
         
        
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




    public function locationUpdate(Request $request , UpdateUserProfileInformation $updateInformation){

        $user = Auth::user();

        $updateInformation->updateLocation($user, $request->all());

        
        if(!$user->wasChanged()){

            return redirect()->back()->with('error','User Information Update Failed!');
            
        }

        return redirect()->back()->with('success','User Information Updated!');                                                                                                              

    }


}