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
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//PROTECTED ROUTES
Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::post('customers', [CustomerController::class, 'store']);
    Route::put('customers/{id}', [CustomerController::class, 'update']);
    Route::put('customers/checkout/{id}', [CustomerController::class, 'checkout']);
    Route::delete('customers/{id}', [CustomerController::class, 'destroy']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});