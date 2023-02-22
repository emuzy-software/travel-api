<?php

namespace App\Requests\Booking;

use App\Requests\ApiRequest;

class BookingRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'phone_number' => 'required',
            'pickup_location' => 'required',
            'destination' => 'required',
            'hire_date' => 'required',
            'vehicle_type' => 'required',
        ];
    }
}
