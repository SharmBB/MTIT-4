<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


    //User Management
    Route::post("addUser",[UserController::class,'addUser']);
    Route::get("get",[UserController::class,'get']);
    Route::put("updateUser",[UserController::class,'updateUser']);
    Route::delete("deleteUser",[UserController::class,'deleteUser']);

    //product Management
    Route::post("addProduct",[ProductController::class,'addProduct']);
    Route::get("getProduct",[ProductController::class,'get']);
    Route::delete("deleteProduct",[ProductController::class,'deleteProduct']);
    Route::put("update",[ProductController::class,'updateProduct']);


    //payment Management
    Route::post("add",[PaymentController::class,'addPayment']);
    Route::get("getPayment",[PaymentController::class,'get']);
    Route::delete("deletePayment",[PaymentController::class,'deletePayment']);
    Route::put("updatePayment",[PaymentController::class,'updatePayment']);


     //Order Management
     Route::post("addOrder",[OrderController::class,'addOrder']);
     Route::get("getOrders",[OrderController::class,'get']);
     Route::delete("deleteOrder",[OrderController::class,'deleteOrder']);
     Route::put("updateOrder",[OrderController::class,'updateOrder']);

    

