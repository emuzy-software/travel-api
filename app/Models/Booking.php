<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'name',
        'phone_number',
        'pickup_location',
        'destination',
        'hire_date',
        'vehicle_type',
        'is_active',
    ];

    protected $hidden = [
        'deleted_at'
    ];
}
