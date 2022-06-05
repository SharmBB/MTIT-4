<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\Facades\Validator;
use DB;


class OrderController extends Controller
{
    function addOrder(Request $req){

        $validator = Validator::make($req->all(), [
            'productName' => 'required|string',
            'orderAddress' => 'required|string',
            'phoneNumber' => 'required|int',
            'email' => 'required|string',
            'totalCost' => 'required|int',
            'customer_name' => 'required|string'
           
          
            
        ]);

        if($validator->fails()){
            return response([
                'error' =>true,
                'message'=> $validator->errors()
            ]);
        }

        $order = new Order;

        $order->productName = $req->productName;
        $order->orderAddress = $req->orderAddress;
        $order->phoneNumber = $req->phoneNumber;
        $order->email = $req->email;
        $order->totalCost = $req->totalCost;
        $order->customer_name = $req->customer_name;
      

        $result = $order->save();

        $result = Order::orderBy('id', 'DESC')->first();



        if($result){
            return response([
                'errorMessage'=>false,
                'message'=>"Order Placed Sucessfully",
                'product' => $result,
            ]);
        }
        
    }

       //get
       function get(){
        
        return Order::all();
    }


    //delete Order
    function deleteOrder(Request $req){
        $order = Order::find($req->id);
        if(is_null($order)){
           
                return response([
                    'errorMessage' => true,
                    'message'=>'Order ID is not Available !!!'
                ]);
            
        }
        $result=$order->delete();
        if($result){
            return response([
                'errorMessage'=>false,
                'message'=>'Order  Deleted Successfully!!!'
            ]);
        }
        else{
            return response([
                'errorMessage' => true,
                'message'=>'Order Delete Failed !!!'
            ]);
        }
    }



    
              //Update Order

              function updateOrder(Request $req){

                $order = Order::find($req->id);
        
        
                if(!$order){
                    return response([
                        'errorMessage' => true,
                        'message'=>'Order ID not  Available !!!'
                    ]);
                }
        
              
        
                $validator = Validator::make($req->all(), [
                    'productName' => 'required|string',
                    'orderAddress' => 'required|string',
                    'phoneNumber' => 'required|int',
                    'email' => 'required|string',
                    'totalCost' => 'required|int',
                    'customer_name' => 'required|string'
                    
                ]);
        
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }
        
                
                
        
                $order->productName = $req->productName;
                $order->orderAddress = $req->orderAddress;
                $order->phoneNumber = $req->phoneNumber;
                $order->email = $req->email;
                $order->totalCost = $req->totalCost;
                $order->customer_name = $req->customer_name;
              
        
                $result = $order->save();
        
                
        
                if($result){
                    return response([
                        'errorMessage'=>false,
                        'message'=>'Order details Updated Successfully!!!'
                    ]);
                }
                else{
                    return response([
                        'errorMessage' => true,
                        'message'=>'Order Failed !!!!'
                    ]);
                }
        
            }
        
        

}
