<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    
    public function index()
    {
        return Customer::all();
    }

    
    public function store(Request $request)
    {
        $request->request->add(['checkIn' => Carbon::now()]);   //Insert checkIn values
        $request->validate([
            'checkIn'=>'required',
            'vehicleType'=>'required',
            'vehiclePlate'=>'required',
            'vehicleModel'=>'required',
            'contactNumber'=>'required'
        ]);

        $query = Customer::create($request->all());

        if($query){
            return response()->json(['message'=>'Customer created Successfully'], 200);
        } else {
            return response()->json(['message'=>'Customer create failed'], 400);
        }
    }

    public function checkout(Request $request, $id)
    {
        // Get Check-in Value
        $checkIn = Customer::find($id)->value('checkIn');
        $checkIn = Carbon::parse($checkIn);     #Convert from String to Object
        
        //Calculate total hours of stay
        $hoursChecked = $checkIn->diffInHours(Carbon::now(), false);

        //Calculate total price
        if($hoursChecked == 0){
            $price = 20;
        } else {
            $price = 20 * $hoursChecked;
        }

        //Add Request for checkout and price put method
        $request->request->add(['checkOut' => Carbon::now()]);
        $request->request->add(['price' => $price]);

        //
        $customer = Customer::find($id);
        $customer->update($request->all());
        
        if($customer){
            return response()->json(['message'=>'Customer checkout successfully'], 200);
        } else {
            return response()->json(['message'=>'Customer checkout failed'], 400);
        }
    }

   
    public function show($id)
    {
        return Customer::find($id);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->update($request->all());

        if($customer){
            return response()->json(['message'=>'Customer updated successfully'], 200);
        } else {
            return response()->json(['message'=>'Customer update request failed'], 400);
        }
        return $customer;
    }

    public function destroy($id)
    {
        $query = Customer::destroy($id);

        if($query){
            return response()->json(['message'=>'Customer deleted successfully'], 200);
        } else {
            return response()->json(['message'=>'Customer delete request failed'], 400);
        }


    }

    public function search($vehicleModel)
    {
        return Customer::where('vehicleModel', 'like', '%'.$vehicleModel.'%')->get();
    }
}
