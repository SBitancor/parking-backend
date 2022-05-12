<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;


//PUBLIC ROUTES
//Route::resource('customers', CustomerController::class);
Route::get('customers', [CustomerController::class, 'index']);
Route::get('customers/{id}', [CustomerController::class, 'show']);
Route::get('customers/search/{name}', [CustomerController::class, 'search']);
Route::post('cashiers/register', [AuthController::class, 'register']);
Route::post('cashiers/login', [AuthController::class, 'login']);
Route::get('cashiers', [AuthController::class, 'index']);  //Get Cashier

Route::get('cashiers/{id}', [AuthController::class, 'show']);
Route::get('cashiers/search/{name}', [AuthController::class, 'search']);

//PROTECTED ROUTES
Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::post('customers', [CustomerController::class, 'store']);
    Route::put('customers/{id}', [CustomerController::class, 'update']);
    Route::put('customers/checkout/{id}', [CustomerController::class, 'checkout']);
    Route::delete('customers/{id}', [CustomerController::class, 'destroy']);
    Route::post('cashiers/logout', [AuthController::class, 'logout']);
    Route::delete('cashiers/{id}', [AuthController::class, 'destroy']);    //DElete Cashier

    Route::put('cashiers/{id}', [AuthController::class, 'update']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});