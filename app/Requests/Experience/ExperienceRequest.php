<?php

namespace App\Requests\Experience;

use App\Requests\ApiRequest;

class ExperienceRequest extends ApiRequest
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
    public function rules(): array
    {
        return [
            'title' => 'required|min:3',
            'slug' => 'required|min:3',
            'is_active' => 'required|boolean',
            'image' => 'required',
            'description' => 'required'
        ];
    }
}
