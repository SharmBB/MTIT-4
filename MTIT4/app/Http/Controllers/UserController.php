<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\Facades\Validator;
use DB;

class UserController extends Controller
{

    //add User
    function addUser(Request $req){

        $validator = Validator::make($req->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string',
            'password' => [
                'required',
                'string',
                'min:10',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ], 
            
        ]);

        if($validator->fails()){
            return response([
                'error' =>true,
                'message'=> $validator->errors()
            ]);
        }

        $user = new User;

        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
      

        $result = $user->save();

        $result = User::orderBy('id', 'DESC')->first();



        if($result){
            return response([
                'errorMessage'=>false,
                'message'=>"User Added Sucessfully"
              //  'user' => $result,
            ]);
        }
        
    }

        //get all users
        function get(){
        
            return User::all();
        }


        //update users
        function updateUser(Request $req){

            $user = User::find($req->id);
    
    
            if(!$user){
                return response([
                    'errorMessage' => true,
                    'message'=>'User not  Available !!!'
                ]);
            }
    
          
    
            $validator = Validator::make($req->all(), [
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'password' => [
                    'required',
                    'string',
                    'min:10',             // must be at least 10 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[@$!%*#?&]/', // must contain a special character
                ],
                
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            

            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->phone = $req->phone;
          
    
            $result = $user->save();
    
            
    
            if($result){
                return response([
                    'errorMessage'=>false,
                    'message'=>'User Updated Successfully!!!'
                ]);
            }
            else{
                return response([
                    'errorMessage' => true,
                    'message'=>'Failed'
                ]);
            }
    
        }

        //delete user
    function deleteUser(Request $req){
        $user = User::find($req->id);
        if(is_null($user)){
           
                return response([
                    'errorMessage' => true,
                    'message'=>'User is not Available !!!'
                ]);
            
        }
        $result=$user->delete();
        if($result){
            return response([
                'errorMessage'=>false,
                'message'=>'User Deleted Successfully!!!'
            ]);
        }
        else{
            return response([
                'errorMessage' => true,
                'message'=>'User Delete Failed !!!'
            ]);
        }
    }
}
