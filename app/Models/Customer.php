<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'checkIn',
        'checkOut',
        'vehicleType',
        'vehiclePlate',
        'vehicleModel',
        'contactNumber',
        'price',
        'received',
        'change'
    ];
}
