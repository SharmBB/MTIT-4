<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\Facades\Validator;
use DB;



class ProductController extends Controller
{

    //add product
    function addProduct(Request $req){

        $validator = Validator::make($req->all(), [
            'productID' => 'required|string|unique:products',
            'productName' => 'required|string',
            'productType' => 'required|string',
            'price' => 'required|int',
            'Quantity' => 'required|int'
          
            
        ]);

        if($validator->fails()){
            return response([
                'error' =>true,
                'message'=> $validator->errors()
            ]);
        }

        $product = new Product;

        $product->productID = $req->productID;
        $product->productName = $req->productName;
        $product->productType = $req->productType;
        $product->price = $req->price;
        $product->Quantity = $req->Quantity;
      

        $result = $product->save();

        $result = Product::orderBy('id', 'DESC')->first();



        if($result){
            return response([
                'errorMessage'=>false,
                'message'=>"Product Added Sucessfully"
              //  'product' => $result,
            ]);
        }
        
    }
        //get products
        function get(){
        
            return Product::all();
        }

            //delete user
    function deleteProduct(Request $req){
        $product = Product::find($req->id);
        if(is_null($product)){
           
                return response([
                    'errorMessage' => true,
                    'message'=>'Product is not Available !!!'
                ]);
            
        }
        $result=$product->delete();
        if($result){
            return response([
                'errorMessage'=>false,
                'message'=>'Product Deleted Successfully!!!'
            ]);
        }
        else{
            return response([
                'errorMessage' => true,
                'message'=>'Product Delete Failed !!!'
            ]);
        }
    }

    //Update Products

    function updateProduct(Request $req){

        $product = Product::find($req->id);


        if(!$product){
            return response([
                'errorMessage' => true,
                'message'=>'Product ID not  Available !!!'
            ]);
        }

      

        $validator = Validator::make($req->all(), [
            'productID' => 'required|string',
            'productName' => 'required|string',
            'productType' => 'required|string',
            'price' => 'required|int',
            'Quantity' => 'required|int'
            
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        
        

        $product->productID = $req->productID;
        $product->productName = $req->productName;
        $product->productType = $req->productType;
        $product->price = $req->price;
        $product->Quantity = $req->Quantity;
      

        $result = $product->save();

        

        if($result){
            return response([
                'errorMessage'=>false,
                'message'=>'Prtoduct Updated Successfully!!!'
            ]);
        }
        else{
            return response([
                'errorMessage' => true,
                'message'=>'Failed'
            ]);
        }

    }


}
