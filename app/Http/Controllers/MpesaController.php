<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller
{
    
    public function stkpushCallback(Request $request){
        

        $response = json_decode($request->getContent());
        $resData =  $response->Body->stkCallback->CallbackMetadata;
        $resCode = $response->Body->stkCallback->ResultCode;
        $merchantRequestID =  $response->Body->stkCallback->MerchantRequestID;
        $checkoutRequestID = $response->Body->stkCallback->CheckoutRequestID;
        $resMessage = $response->Body->stkCallback->ResultDesc;
        $amountPaid = $resData->Item[0]->Value;
        $mpesaTransactionId = $resData->Item[1]->Value;
        $paymentDate = $resData->Item[3]->Value;
        $paymentPhoneNumber = $resData->Item[4]->Value;



        $trans = Transaction::where('MerchantRequestID',$merchantRequestID)->where('CheckoutRequestID',$checkoutRequestID)->first();

        Payment::create([
            'transaction_id' => $trans->id,
            'TransactionCode' => $mpesaTransactionId,
            'TransactionDate' => $paymentDate,
            'PhoneNumber' => $paymentPhoneNumber
        ]);


        $trans->Status = 1;

        $trans->save();

        $trans->order->update([
            'status' => 1,
            'progress' => 1
        ]);
        
    }



// ACCOUNT BALANCE
    public function balanceCallback(Request $request){
        Log::info("ACCOUNT BALANCE EndPoint Hit");
        Log::info($request->all());

        return [
            'ResultCode' => 0,
            'ResultDesc' => 'Accept Service',
            'ThirdPartyTransID' => 1996
        ];
    }


    
    public function balanceTimeOut(Request $request){
        Log::info("ACCOUNT BALANCE Queue Timeout EndPoint Hit");
        Log::info($request->all());
    }



//REVERSE TRANSACTION
    public function reverseCallback(Request $request){
        Log::info("Reverse EndPoint Hit");
        Log::info($request->all());

        return [
            'ResultCode' => 0,
            'ResultDesc' => 'Accept Service',
            'ThirdPartyTransID' => 1996
        ];
    }

    public function reverseTimeOut(Request $request){
        Log::info("Reverse Queue Timeout EndPoint Hit");
        Log::info($request->all());
    }






//TRANSACTION
    public function transactionCallback(Request $request){
        Log::info("TRANSACTION EndPoint Hit");
        Log::info($request->all());

        return [
            'ResultCode' => 0,
            'ResultDesc' => 'Accept Service',
            'ThirdPartyTransID' => 1996
        ];
    }

    public function transactionTimeOut(Request $request){
        Log::info("TRANSACTION Queue Timeout EndPoint Hit");
        Log::info($request->all());
    }





//B2C
    public function b2cCallback(Request $request){
        Log::info("B2C EndPoint Hit");
        Log::info($request->all());

        return [
            'ResultCode' => 0,
            'ResultDesc' => 'Accept Service',
            'ThirdPartyTransID' => 1996
        ];
    }

    public function b2cTimeOut(Request $request){
        Log::info("B2C Queue Timeout EndPoint Hit");
        Log::info($request->all());
    }




//REGISTER URLS
    public function confirmation(Request $request){
        Log::info("Confirm EndPoint Hit");
        Log::info($request->all());
    }


    public function validation(Request $request){
        Log::info("Validate EndPoint Hit");
        Log::info($request->all());

        return [
            'ResultCode' => 0,
            'ResultDesc' => 'Accept Service'
        ];
    }
}