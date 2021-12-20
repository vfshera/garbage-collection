<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\Waste;
use App\Services\Payment\MpesaPay;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller Creating  and Deleting Orders
 */
class OrderController extends Controller
{
    /**
 * Creating new order
 */
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


    /**
 * Order Payment View
 */
    public function payment(Order $order , Request $request){

        if(Auth::user()->id != $order->user_id){
            return redirect()->route('user.orders')->with('error','Route Prohibited!');
        }        

        return view('pay-order',compact(['order']));

    }



    /**
 * Creates Payment with MpesaPay::class
 */
    public function pay(Order $order ,Request $request , MpesaPay $mpesaPay){   
        
        $payingNumber = Auth::user()->phone;

        if($request->altPay){
            
            $payingNumber = $request->altPay;
        }

        try {

        // MPESA LOGIC
            $payResponse = $mpesaPay->stkPush(1, $payingNumber, $order->serial, "OrderPayment");

            // dd($payResponse);

            if ((env('MPESA_HANDLER') == 'safaricom' && $payResponse->ResponseCode != 0) || (env('MPESA_HANDLER') == 'reflector' && $payResponse->ResultCode != 0)) {
                
                return redirect()->back()->with('error', 'Transaction Failed!');
            }

            
        }catch(Exception $e){
            
            return redirect()->back()->with('error', 'Error Occured!'.$e->getMessage());

        }

        

        Transaction::firstOrCreate(
            ['order_id' => $order->id],
            [
                'MerchantRequestID' => $payResponse->MerchantRequestID,
                'CheckoutRequestID' => $payResponse->CheckoutRequestID,
                'Amount' => $order->cost
            ]
        );
        

        return redirect()->route('user.order.pay-confirm',[$order])->with('success','Confirm Payment on '.$payingNumber);
    }



    /**
 * Payment Confirmation View
 */
    public function confirm(Order $order ,Request $request){   
        
        return view('payment-confirm', compact('order'));
    }


    /**
 * Checks if Order is paid
 */
    public function checkPay(Order $order){   
        
        return response()->json(['isPaid' => $order->transaction->payment()->exists()]);
    }


   


/**
 * Deletes Order
 */
    public function destroy(Order $order){   
        
        $order->delete();

        return redirect()->back()->with('success','Order Deleted!');                                                                                                              

    }


}