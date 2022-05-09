<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;


//PUBLIC ROUTES
//Route::resource('customers', CustomerController::class);
Route::get('customers', [CustomerController::class, 'index']);
Route::post('customers', [CustomerController::class, 'store']);
Route::get('customers/{id}', [CustomerController::class, 'show']);
Route::put('customers/{id}', [CustomerController::class, 'update']);
Route::delete('customers/{id}', [CustomerController::class, 'destroy']);
Route::get('customers/search/{name}', [CustomerController::class, 'search']);
Route::put('customers/checkout/{id}', [CustomerController::class, 'checkout']);

//PROTECTED ROUTES


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
