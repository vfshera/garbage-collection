<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Waste;
use App\Services\Payment\MpesaPay;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request){

        $newOrder = $request->validate([
            "waste_id" => 'required',
            "pickup" => 'required',
            "weight" => 'required'
        ]);
            
        $waste = Waste::where('id' ,$newOrder["waste_id"])->first();


        $totalCost = (int)$newOrder["weight"] *  (int)$waste->cost;

        $newOrder["cost"] = $totalCost;
        
        
        $newOrder["user_id"] = Auth::user()->id;       
        
        Order::create($newOrder);

        return redirect()->route('user.orders')->with('success','Order Created!');
        
    }

    public function payment(Order $order , Request $request){

        if(Auth::user()->id != $order->user_id){
            return redirect()->route('user.orders')->with('error','Route Prohibited!');
        }        

        return view('pay-order',compact(['order']));

    }

    public function pay(Order $order ,Request $request , MpesaPay $mpesaPay){   
        
        $payingNumber = Auth::user()->phone;

        if($request->altPay){
            
            $payingNumber = $request->altPay;
        }

        try {

        // MPESA LOGIC
            $payResponse = $mpesaPay->stkPush(1, $payingNumber, $order->serial, "OrderPayment");

        
            dd($payResponse);
            
            if ($payResponse->ResponseCode != 0) {
                
                return redirect()->back()->with('error', 'Transaction Failed!');
            }

            
        }catch(Exception $e){
            
            return redirect()->back()->with('error', 'Error Occured!'.$e->getMessage());

        }


        return redirect()->route('user.order.pay-confirm',[$order])->with('success','Confirm Payment on '.$payingNumber);
    }



    
    public function confirm(Order $order ,Request $request){   
        
        return view('payment-confirm', compact('order'));
    }


    public function checkPay(Order $order ,Request $request){   
        
        return response()->json(['isPaid' => $order->payment()->exists()]);
    }


   



    public function update(Request $request){
     

        return redirect()->back()->with('success','Order Updated!');

    }




    public function destroy(Order $order){   
        
        $order->delete();

        return redirect()->back()->with('success','Order Deleted!');                                                                                                              

    }


}