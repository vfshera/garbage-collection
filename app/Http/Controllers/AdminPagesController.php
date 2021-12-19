<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Waste;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminPagesController extends Controller
{
    public function dashboard(){

        $orders = Order::orderBy('created_at', 'DESC')->get();
        $latestOrders = $orders->take(8);
        $ordersCount = $orders->count();



        $payments = Payment::orderBy('created_at', 'DESC')->get();

        $latestPayments = $payments->take(8);
        $paymentsSum = Transaction::completed()->sum('Amount');

        
        return view('admin.dashboard' , compact(['latestOrders','ordersCount','latestPayments', 'paymentsSum']));
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

         })->when(($request->has('forUser')  && $request->forUser != null),function($query) use ($request) {

            return $query->where('user_id' , $request->forUser);

         })->with('waste','transaction.payment')->latest()->get();
         


         $users = User::normalUsers()->get();


         
        return view('admin.order-report' , compact('orders', 'reportType','users'));
    }



     
    public function getPaymentReport(Request $request){     
               
        

        $payments = Payment::when(($request->has('from') && $request->from != null),function($query) use ($request) {

            return $query->where('created_at' ,'>=', date('Y-m-d', strtotime($request->from)));
            
         })->when(($request->has('to')  && $request->to != null),function($query) use ($request) {

            return $query->where('created_at' ,'<=', date('Y-m-d', strtotime($request->to)));

         })->when(($request->has('forUser')  && $request->forUser != null),function($query) use ($request) {

            return $query->whereHas('order',function($ord) use($request){
                return $ord->forUser($request->forUser);
            });

         })->latest()->get();
         
         $users = User::normalUsers()->get();


        return view('admin.payment-report' , compact('payments','users'));
    }






    public function users(){

        $users = User::normalUsers()->withCount('orders')->orderBy('created_at', 'DESC')->paginate(8);
        
        
         
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
    

    

    public function userOrders(Request $request, User $user){
        
       
        $orders = Order::forUser($user->id)->when($request->has('status'), function ($query) use ($request) {

           return $query->where('status', $request->get('status'));
            
         })->with('waste','user')->orderBy('created_at','DESC')->paginate(8);

         

        return view('orders' , compact(['orders','user']));
    }
    

    public function progress(Order $order){
        
       
      if($order->progress == 1) {

        $order->progress = 2;

      }
        
      if($order->progress == 2) {

          $order->progress = 1;

      }
        

      
      if($order->progress == '0') {

          return redirect()->back()->with('error','Progress Can not be changed on Unpaid Order!');
          
      }



      $order->save();
      
        return redirect()->back()->with('success','Order Progress changed!');
    }



    public function billing(){


        $orders = Order::paid()->with('transaction.payment')->orderBy('created_at')->paginate(8); 
        
        $totalBill = Transaction::completed()->sum('Amount');
        
        return view('billing' , compact(['orders','totalBill']));
    }


}