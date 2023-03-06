<?php

namespace App\Requests\Booking;

use App\Requests\ApiRequest;

class UpdateBookingRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'is_active' => 'required|boolean',
        ];
    }
}
