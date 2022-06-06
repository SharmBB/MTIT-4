<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\Facades\Validator;
use DB;


class PaymentController extends Controller
{
    // add Payment
    function addPayment(Request $req){

        $validator = Validator::make($req->all(), [
            'benefactor' => 'required|string',
            'payer' => 'required|string',
            'amount' => 'required|int',
            'accountNumber' => 'required|int',
            'bank' => 'required|string'
           
          
            
        ]);

        if($validator->fails()){
            return response([
                'error' =>true,
                'message'=> $validator->errors()
            ]);
        }

        $payment = new Payment;

        $payment->benefactor = $req->benefactor;
        $payment->payer = $req->payer;
        $payment->amount = $req->amount;
        $payment->accountNumber = $req->accountNumber;
        $payment->bank = $req->bank;
      

        $result = $payment->save();

        $result = Payment::orderBy('id', 'DESC')->first();



        if($result){
            return response([
                'errorMessage'=>false,
                'message'=>"Payment Added Sucessfully",
                'product' => $result,
            ]);
        }
        
    }

    //get payment
    function get(){
        
        return Payment::all();
    }


             //delete Payment
             function deletePayment(Request $req){
                $payment = Payment::find($req->id);
                if(is_null($payment)){
                   
                        return response([
                            'errorMessage' => true,
                            'message'=>'Payment ID is not Available !!!'
                        ]);
                    
                }
                $result=$payment->delete();
                if($result){
                    return response([
                        'errorMessage'=>false,
                        'message'=>'Payement Details Deleted Successfully!!!'
                    ]);
                }
                else{
                    return response([
                        'errorMessage' => true,
                        'message'=>'Product Delete Failed !!!'
                    ]);
                }
            }




              //Update Payment

    function updatePayment(Request $req){

        $payment = Payment::find($req->id);


        if(!$payment){
            return response([
                'errorMessage' => true,
                'message'=>'Payment ID not  Available !!!'
            ]);
        }

      

        $validator = Validator::make($req->all(), [
            'benefactor' => 'required|string',
            'payer' => 'required|string',
            'amount' => 'required|int',
            'accountNumber' => 'required|int',
            'bank' => 'required|string'
            
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        
        

        $payment->benefactor = $req->benefactor;
        $payment->payer = $req->payer;
        $payment->amount = $req->amount;
        $payment->accountNumber = $req->accountNumber;
        $payment->bank = $req->bank;
      

        $result = $payment->save();

        

        if($result){
            return response([
                'errorMessage'=>false,
                'message'=>'Payment Updated Successfully!!!'
            ]);
        }
        else{
            return response([
                'errorMessage' => true,
                'message'=>'Payment Failed !!!!'
            ]);
        }

    }


        
}
