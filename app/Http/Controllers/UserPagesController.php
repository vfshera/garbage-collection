<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Waste;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Actions\Fortify\UpdateUserProfileInformation;

class UserPagesController extends Controller
{
    
    public function dashboard(){


        $myOrders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        $latestOrders = $myOrders->take(8);
        $ordersCount = $myOrders->count();



        $myPayments = Payment::whereHas('order' , function($query){
            $query->forAuthUser();
        })->orderBy('created_at', 'DESC')->get();

        $latestPayments = $myPayments->take(8);
        $paymentsSum = $myPayments->sum('TransAmount');

        
        return view('user.dashboard' , compact(['latestOrders','ordersCount','latestPayments', 'paymentsSum']));
    }


     
    public function getOrderReport(Request $request){ 
        
        $reportType = "Order Report";
        
        
        if($request->has('status') && $request->get('status') == 1) {

            $reportType = "Paid Orders"; 
        }
        
        if($request->has('status') && $request->get('status')  == 0) {

            $reportType = "Unpaid Orders";

        } 

        $orders = Order::when($request->has('status'), function ($query) use ($request) {

            return $query->where('status', $request->get('status'));
            
         })->when(($request->has('from') && $request->from != null),function($query) use ($request) {

            return $query->where('created_at' ,'>=', date('Y-m-d', strtotime($request->from)));
            
         })->when(($request->has('to')  && $request->to != null),function($query) use ($request) {

            return $query->where('created_at' ,'<=', date('Y-m-d', strtotime($request->to)));

         })->with('waste','payment')->forAuthUser()->latest()->get();
         

        return view('user.order-report' , compact('orders', 'reportType'));
    }



     
    public function getPaymentReport(Request $request){     
               
        

        $payments = Payment::when(($request->has('from') && $request->from != null),function($query) use ($request) {

            return $query->where('created_at' ,'>=', date('Y-m-d', strtotime($request->from)));
            
         })->when(($request->has('to')  && $request->to != null),function($query) use ($request) {

            return $query->where('created_at' ,'<=', date('Y-m-d', strtotime($request->to)));

         })->whereHas('order' , function($query){
            
            return $query->where('user_id' , Auth::user()->id);

        })->latest()->get();
         

        return view('user.payment-report' , compact('payments'));
    }





    public function orders(Request $request){
        
        $orders = Order::when($request->has('status'), function ($query) use ($request) {

            return $query->where('status', $request->get('status'));
            
         })->with('waste')->forAuthUser()->orderBy('created_at','DESC')->paginate(8);
         
        
        $wastes = Waste::orderBy('created_at','DESC')->get();

        return view('orders' , compact(['orders', 'wastes']));
    }


    
    public function billing(){

        $orders = Auth::user()->orders()->paid()->with('payment')->paginate(8);

        
       $orderIDs = Auth::user()->orders()->paid()->get('id');


        $totalBill = Payment::whereIn('order_id',$orderIDs)->sum('TransAmount');
        
        return view('billing' , compact(['orders','totalBill']));
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