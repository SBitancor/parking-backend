<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function index()
    {
        return Cashier::all();
    }

    public function register(Request $request){

        $fields = $request->validate([
            'cashierName'=>'required|string',
            'contactEmail'=>'required|string|unique:cashiers,contactEmail',
            'contactNumber'=>'required|string|unique:cashiers,contactNumber',
            'username'=>'required|string|unique:cashiers,username',
            'password'=>'required|string|confirmed'

        ]);

        $cashier = Cashier::create([
            'cashierName'=>$fields['cashierName'],
            'contactEmail'=>$fields['contactEmail'],
            'contactNumber'=>$fields['contactNumber'],
            'username'=>$fields['username'],
            'password'=>bcrypt($fields['password'])
        ]);
        
        $token = $cashier->createToken('myapptoken')->plainTextToken;

        $response = [
            'cashier'=>$cashier,
            'token'=>$token
        ];

        return response($response, 201);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'contactEmail'=>'required|string',
            'password'=>'required|string'

        ]);

        // Check email
        $cashier = Cashier::where('contactEmail', $fields['contactEmail'])->first();

        //Check password
        if (!$cashier || !Hash::check($fields['password'], $cashier->password)){
            return response([
                'message'=>'bad credentials'
            ], 401);
        }

        $token = $cashier->createToken('myapptoken')->plainTextToken;

        $response = [
            'cashier'=>$cashier,
            'token'=>$token
        ];

        return response($response, 201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message'=>'Logged Out'
        ];
    }

    public function show($id)
    {
        return Cashier::find($id);
    }

    public function update(Request $request, $id)
    {

        $fields = $request->validate([
            'cashierName'=>'required|string',
            'contactEmail'=>'required|string|unique:cashiers,contactEmail',
            'contactNumber'=>'required|string|unique:cashiers,contactNumber',
            'username'=>'required|string|unique:cashiers,username',
            'password'=>'required|string|confirmed'

        ]);

        $cashier = Cashier::find($id);
        $cashier->update($request->all());

        if($cashier){
            return response()->json(['message'=>'Cashier updated successfully'], 200);
        } else {
            return response()->json(['message'=>'Cashier update request failed'], 400);
        }
        return $cashier;
    }

    public function search($cashierName)
    {
        return Cashier::where('cashierName', 'like', '%'.$cashierName.'%')->get();
    }

    public function destroy($id)
    {
        $query = Cashier::destroy($id);

        if($query){
            return response()->json(['message'=>'Cashier deleted successfully'], 200);
        } else {
            return response()->json(['message'=>'Cashier delete request failed'], 400);
        }


    }
}
